<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Couleur;

class CouleurDAO extends DAO
{
    /**
     * Return a list of all colors.
     *
     * @return array A list of all color.
     */
    public function findAll() {
        $sql = "select * from COULEURS";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $colors = array();
        foreach ($result as $row) {
            $colorId = $row['ID_COULEUR'];
            $colors[$colorId] = $this->buildDomainObject($row);
        }
        return $colors;
    }

    /**
     * Creates an Color object based on a DB row.
     *
     * @param array $row The DB row containing Color data.
     * @return \CitadelleDuVin\Domain\Couleur
     */
    protected function buildDomainObject(array $row) {
        $color = new Couleur();
        $color->setId($row['ID_COULEUR']);
        $color->setName($row['NOM']);
        return $color;
    }

        /**
     * Returns an color matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Couleur|throws an exception if no matching color is found
     */
    public function find($id) {
        $sql = "select * from COULEURS where ID_COULEUR=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No color matching id " . $id);
    }
    
}