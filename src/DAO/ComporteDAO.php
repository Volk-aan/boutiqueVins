<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Comporte;

class ComporteDAO extends DAO
{

    private $productDAO;
    private $panierDAO;

    public function setProductDAO(ProduitDAO $productDAO) {
        $this->productDAO = $productDAO;
    }

    public function setPanierDAO(PanierDAO $panierDAO) {
        $this->panierDAO = $panierDAO;
    }

    /**
     * Creates an comporte object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \CitadelleDuVin\Domain\Comporte
     */
    protected function buildDomainObject(array $row) {
        
        $comporte = new Comporte();
        $comporte->setId($row['ID_COMMANDE']);
        $comporte->setQuantity($row['QUANTITE']);
        $comporte->setPrice($row['PRIX']);
        $productId = $row['ID_PRODUIT'];
        $product = $this->productDAO->find($productId);
        $comporte->setProduct($product);
        
        return $comporte;
    }

    /**
     * Returns an product matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Produit|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from COMPORTE where ID_COMMANDE=?";
        $result = $this->getDb()->fetchAll($sql, array($id));
        // Convert query result to an array of domain objects
        $comporte = array();
        foreach ($result as $row) {
            $productId = $row['ID_PRODUIT'];
            $comporte[$productId] = $this->buildDomainObject($row);
        }

        return $comporte;
    }

    /**
     * Saves a cart into the database.
     *
     * @param \CitadelleDuVin\Domain\Comporte $cart The cart to save
     */

    public function save($cart, $idCommande) {
        $total=0;
        foreach ($cart as $product){
            $total = $total + ($product->getQuantity() * $product->getProduct()->getPrice());
            $productData = array(
                'ID_PRODUIT' => $product->getProduct()->getId(),
                'ID_COMMANDE' => $idCommande,
                'QUANTITE' => $product->getQuantity(),
                'PRIX' => $product->getProduct()->getPrice()
            );
            $this->getDb()->insert('COMPORTE', $productData);
        }

        return $total;
    }

}