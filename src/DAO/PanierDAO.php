<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Panier;

class PanierDAO extends DAO
{

    private $productDAO;

    public function setProductDAO(ProduitDAO $productDAO) {
        $this->productDAO = $productDAO;
    }



    /**
     * Creates an cart object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \CitadelleDuVin\Domain\Product
     */
    protected function buildDomainObject(array $row) {
        
        $panier = new Panier();
        $panier->setQuantity($row['QUANTITE']);
        $panier->setUser($row['ID_CLIENT']);
        $productId = $row['ID_PRODUIT'];
        $product = $this->productDAO->find($productId);
        $panier->setProduct($product);
        
        return $panier;
    }

    /**
     * Returns an product matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Produit|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from ATTENTE where ID_CLIENT=?";
        $result = $this->getDb()->fetchAll($sql, array($id));
        // Convert query result to an array of domain objects
        $panier = array();
        foreach ($result as $row) {
            $productId = $row['ID_PRODUIT'];
            $panier[$productId] = $this->buildDomainObject($row);
        }

        return $panier;
    }

    /**
     * Saves a cart into the database.
     *
     * @param \CitadelleDuVin\Domain\Panier $cart The cart to save
     */

    public function save(Panier $cart) {
        $cartData = array(
            'ID_PRODUIT' => $cart->getProduct()->getId(),
            'ID_CLIENT' => $cart->getUser(),
            'QUANTITE' => $cart->getQuantity()
            );

            $sql = "select * from ATTENTE where ID_CLIENT=? AND ID_PRODUIT = ?";
            $updt_qt = "update ATTENTE set QUANTITE = ? WHERE ID_CLIENT=? AND ID_PRODUIT = ?";

            $row = $this->getDb()->fetchAssoc($sql, array($cartData['ID_CLIENT'],$cartData['ID_PRODUIT']));
            if ($row){
                $cartData['QUANTITE']=$row['QUANTITE']+1;
                $this->getDb()->update('ATTENTE', $cartData, array('ID_PRODUIT' => $cart->getProduct()->getId(), 'ID_CLIENT'=>$cart->getUser() ));
            }
            else{
                $cartData['QUANTITE']=1; 
                $this->getDb()->insert('ATTENTE', $cartData);
            }
    }

     /**
     * Decrease product's quantity into the database.
     *
     * @param \CitadelleDuVin\Domain\Panier $cart The cart to save
     */
    public function decreaseQuantity(Panier $cart) {
        $cartData = array(
            'ID_PRODUIT' => $cart->getProduct()->getId(),
            'ID_CLIENT' => $cart->getUser(),
            'QUANTITE' => 0
            );

            $sql = "select * from ATTENTE where ID_CLIENT=? AND ID_PRODUIT = ?";
            $updt_qt = "update ATTENTE set QUANTITE = ? WHERE ID_CLIENT=? AND ID_PRODUIT = ?";

            $row = $this->getDb()->fetchAssoc($sql, array($cartData['ID_CLIENT'],$cartData['ID_PRODUIT']));
            if($row){
                $cartData['QUANTITE']=$row['QUANTITE']-1;
                if($cartData['QUANTITE']<1){
                    $this->getDb()->delete('ATTENTE', array('ID_PRODUIT' => $cart->getProduct()->getId(), 'ID_CLIENT'=>$cart->getUser() ));
                }
                else{
                    $this->getDb()->update('ATTENTE', $cartData, array('ID_PRODUIT' => $cart->getProduct()->getId(), 'ID_CLIENT'=>$cart->getUser() ));
                }
            }
    }
     /**
     * Increase product's quantity into the database.
     *
     * @param \CitadelleDuVin\Domain\Panier $cart The cart to save
     */
    public function increaseQuantity(Panier $cart) {
        $cartData = array(
            'ID_PRODUIT' => $cart->getProduct()->getId(),
            'ID_CLIENT' => $cart->getUser(),
            'QUANTITE' => 0
            );

            $sql = "select * from ATTENTE where ID_CLIENT=? AND ID_PRODUIT = ?";
            $updt_qt = "update ATTENTE set QUANTITE = ? WHERE ID_CLIENT=? AND ID_PRODUIT = ?";

            $row = $this->getDb()->fetchAssoc($sql, array($cartData['ID_CLIENT'],$cartData['ID_PRODUIT']));
            if($row){
                $cartData['QUANTITE']=$row['QUANTITE']+1;
                    $this->getDb()->update('ATTENTE', $cartData, array('ID_PRODUIT' => $cart->getProduct()->getId(), 'ID_CLIENT'=>$cart->getUser() ));
            }
    }

    /*
    *** Vide le panier du client
    ** @var $id_user = identifiant du client
    ** @table ATTENTE = contient le panier des clients
    */
    public function clearCart($id_user) {
            $sql = "delete from ATTENTE WHERE ID_CLIENT=?";    
            $this->getDb()->delete('ATTENTE', array('ID_CLIENT'=>$id_user));

    }

    /**
     * Returns an product matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Produit|throws an exception if no matching article is found
     */
    public function qtCart($id) {
        $sql = "select SUM(QUANTITE) as 'total' from ATTENTE where ID_CLIENT=?";
        $result = $this->getDb()->fetchAssoc($sql, array($id));
        
        // Convert query result to an array of domain objects
        if($result){
            foreach ($result as $row) {
                if($row>0){
                    $qtPanier = $row;
                }
                else{
                    $qtPanier= 0 ;
                }
                
            }
        }
        return $qtPanier;
        
    }

}