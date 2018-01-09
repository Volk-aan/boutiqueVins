<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Commande;

class CommandeDAO extends DAO
{
    private $comporteDAO;

    public function setComporteDAO(ComporteDAO $comporteDAO) {
        $this->comporteDAO = $comporteDAO;
    }

    /**
     * Creates an cart object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \CitadelleDuVin\Domain\Product
     */
    protected function buildDomainObject(array $row) {
        $commande = new Commande();
        $commande->setId($row['ID_COMMANDE']);    
        $commande->setUser($row['ID_CLIENT']);
        $commande->setPrice($row['PRIX_TOTAL']);
        $commande->setStatus($row['PAYE']);
        $commande->setDate($row['DATE']);

        return $commande;
    }


    /**
     * Return a list of all products.
     *
     * @return array A list of all products.
     */

    public function findAll() {
        $sql = "select * from COMMANDE";
        $result = $this->getDb()->fetchAll($sql);
        // Convert query result to an array of domain objects
        $commande = array();
        foreach ($result as $row) {
            $commandeId = $row['ID_COMMANDE'];
            $commande[$commandeId] = $this->buildDomainObject($row);
            $comporte = $this->comporteDAO->find($commandeId);
            $commande[$commandeId]->setList($comporte);
       }
        return $commande;
    }


    /**
     * Returns an product matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Produit|throws an exception if no matching article is found
     */
    public function findByUser($id) {
        $sql = "select * from COMMANDE where ID_CLIENT=?";
        $result = $this->getDb()->fetchAll($sql, array($id));
        // Convert query result to an array of domain objects
        $commande = array();

        foreach ($result as $row) {
            $commandeId = $row['ID_COMMANDE'];
            $commande[$commandeId] = $this->buildDomainObject($row);
            $comporte = $this->comporteDAO->find($commandeId);
            $commande[$commandeId]->setList($comporte);
       }
        return $commande;
    }

        /**
     * Returns a commande matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Commande|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from COMMANDE where ID_COMMANDE=?";
        $result = $this->getDb()->fetchAssoc($sql, array($id));
        // Convert query result to an array of domain objects
        $commande = $this->buildDomainObject($result);
        $commandeComporte = $this->comporteDAO->find($commande->getId());
        $commande->setList($commandeComporte);

        return $commande;
    }


    /**
     * Saves a cart into the database.
     *
     * @param \CitadelleDuVin\Domain\Panier $cart The cart to save
     */

    public function save(Commande $commande) {
        $cmdData = array(
            'ID_CLIENT' => $commande->getUser(),
            'PRIX_TOTAL' => $commande->getPrice(),
            'DATE' => $commande->getDate(),
            'PAYE' => $commande->getStatus()
            );
        $this->getDb()->insert('COMMANDE', $cmdData);
    }

    /**
     * Return a command.
     *
     * @return array A list of all products.
     */

    public function findIdCom($idCl,$date) {
        
        $sql = "select * from COMMANDE where ID_CLIENT = ? and DATE= ?";
        $result = $this->getDb()->fetchAssoc($sql, array($idCl, $date));

        return $this->buildDomainObject($result);
    }

    public function updateTotal(Commande $commande){
        $cmdData = array(
            'ID_COMMANDE' => $commande->getId(),
            'ID_CLIENT' => $commande->getUser(),
            'PRIX_TOTAL' => $commande->getPrice(),
            'DATE' => $commande->getDate(),
            'PAYE' => $commande->getStatus()
            );

            $this->getDb()->update('COMMANDE', $cmdData, array('ID_COMMANDE' => $commande->getId()));

    }

}