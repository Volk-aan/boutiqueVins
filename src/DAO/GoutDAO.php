<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Gout;

class GoutDAO extends DAO
{
    /**
     * Return a list of all tastes.
     *
     * @return array A list of all tastes.
     */
    public function findAll() {
        $sql = "select * from GOUTS";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $tastes = array();
        foreach ($result as $row) {
            $tasteId = $row['ID_GOUT'];
            $tastes[$tasteId] = $this->buildDomainObject($row);
        }
        return $tastes;
    }

    /**
     * Creates an Land object based on a DB row.
     *
     * @param array $row The DB row containing Taste data.
     * @return \CitadelleDuVin\Domain\Gout
     */
    protected function buildDomainObject(array $row) {
        $taste = new Gout();
        $taste->setId($row['ID_GOUT']);
        $taste->setName($row['NOM']);
        return $taste;
    }

        /**
     * Returns an taste matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Gout|throws an exception if no matching taste is found
     */
    public function find($id) {
        $sql = "select * from GOUTS where ID_GOUT=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No taste matching id " . $id);
    }
    
}