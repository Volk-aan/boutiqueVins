<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Produit;

class ProduitDAO extends DAO
{

    /**
     * @var \CitadelleDuVin\DAO\CouleurDAO
     */
    private $colorDAO;

    private $landDAO;

    private $tasteDAO;

    public function setLandDAO(PaysDAO $landDAO) {
        $this->landDAO = $landDAO;
    }

    public function setColorDao(CouleurDAO $colorDAO) {
        $this->colorDAO = $colorDAO;
    }

    public function setTasteDAO(GoutDAO $tasteDAO) {
        $this->tasteDAO = $tasteDAO;
    }


    /**
     * Return a list of all products.
     *
     * @return array A list of all products.
     */

    public function findAll() {
        
        $sql = "select * from PRODUITS where SUPPRIME = 0";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $products = array();
        foreach ($result as $row) {
            $productId = $row['ID_PRODUIT'];
            $products[$productId] = $this->buildDomainObject($row);
        }
        return $products;
    }

    /**
     * Creates an Product object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \CitadelleDuVin\Domain\Product
     */
    protected function buildDomainObject(array $row) {
        
        $product = new Produit();
        $product->setId($row['ID_PRODUIT']);
        $product->setName($row['NOM']);
        $product->setDescription($row['DESCRIPTION']);
        $product->setAlcool($row['DEGRE_ALCOOL']);
        $product->setYear($row['MILLESIME']);
        $product->setTemperature($row['TEMP_SERVICE']);
        $product->setStock($row['STOCK']);
        $product->setBio($row['BIO']);
        $product->setPicture($row['PHOTO']);
        $product->setPrice($row['PRIX']);

        if (array_key_exists('ID_PAYS', $row)) {
            $landId = $row['ID_PAYS'];
            $land = $this->landDAO->find($landId);
            $product->setLand($land);
        }

        if (array_key_exists('ID_COULEUR', $row)) {
            $colorId = $row['ID_COULEUR'];
            $color = $this->colorDAO->find($colorId);
            $product->setColor($color);
        }

        if (array_key_exists('ID_GOUT', $row)) {
            $tasteId = $row['ID_GOUT'];
            $taste = $this->tasteDAO->find($tasteId);
            $product->setTaste($taste);
        }

        return $product;
    }

        /**
     * Returns an product matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Produit|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from PRODUITS where ID_PRODUIT=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No product matching id " . $id);
    }    

    public function save(Produit $produit) {
        $produitData = array(
            'ID_PRODUIT' => $produit->getId(),
            'ID_PAYS' => $produit->getLand()->getId(),
            'ID_GOUT' => $produit->getTaste()->getId(),
            'ID_COULEUR' => $produit->getColor()->getId(),
            'NOM' => strtoupper($produit->getName()),
            'DESCRIPTION' => $produit->getDescription(),
            'DEGRE_ALCOOL' => $produit->getAlcool(),
            'MILLESIME' => $produit->getYear(),
            'TEMP_SERVICE' => $produit->getTemperature(),
            'STOCK' => $produit->getStock(),
            'BIO' => $produit->getBio(),
            'PRIX' => $produit->getPrice(),
            'PHOTO' => $produit->getPicture()
            
            );

        if ($produit->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('PRODUITS', $produitData, array('ID_PRODUIT' => $produit->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('PRODUITS', $produitData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $produit->setId($id);
        }
    }
    public function delete(Produit $produit) {
        $produitData = array(
            'ID_PRODUIT' => $produit->getId(),
            'ID_PAYS' => $produit->getLand()->getId(),
            'ID_GOUT' => $produit->getTaste()->getId(),
            'ID_COULEUR' => $produit->getColor()->getId(),
            'NOM' => $produit->getName(),
            'DESCRIPTION' => $produit->getDescription(),
            'DEGRE_ALCOOL' => $produit->getAlcool(),
            'MILLESIME' => $produit->getYear(),
            'TEMP_SERVICE' => $produit->getTemperature(),
            'STOCK' => $produit->getStock(),
            'BIO' => $produit->getBio(),
            'PRIX' => $produit->getPrice(),
            'PHOTO' => $produit->getPicture(),
            'SUPPRIME' => 1            
            );

        if ($produit->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('PRODUITS', $produitData, array('ID_PRODUIT' => $produit->getId()));
        }
    }




}