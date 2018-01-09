<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Pays;

class PaysDAO extends DAO
{
    /**
     * Return a list of all lands.
     *
     * @return array A list of all lands.
     */
    public function findAll() {
        $sql = "select * from PAYS";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $lands = array();
        foreach ($result as $row) {
            $landId = $row['ID_PAYS'];
            $lands[$landId] = $this->buildDomainObject($row);
        }
        return $lands;
    }

    /**
     * Creates an Land object based on a DB row.
     *
     * @param array $row The DB row containing Land data.
     * @return \CitadelleDuVin\Domain\Pays
     */
    protected function buildDomainObject(array $row) {
        $land = new Pays();
        $land->setId($row['ID_PAYS']);
        $land->setName($row['NOM']);
        return $land;
    }

        /**
     * Returns an land matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Pays|throws an exception if no matching land is found
     */
    public function find($id) {
        $sql = "select * from PAYS where ID_PAYS=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No land matching id " . $id);
    }
    
}