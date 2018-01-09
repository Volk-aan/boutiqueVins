<?php

namespace CitadelleDuVin\DAO;

use CitadelleDuVin\Domain\Pages;

class PagesDAO extends DAO
{
    /**
     * Return a list of all colors.
     *
     * @return array A list of all color.
     */
    public function findAll() {
        $sql = "select * from PAGES";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $pages = array();
        foreach ($result as $row) {
            $pageId = $row['ID_PAGE'];
            $pages[$pageId] = $this->buildDomainObject($row);
        }
        return $pages;
    }

    /**
     * Creates an Color object based on a DB row.
     *
     * @param array $row The DB row containing Color data.
     * @return \CitadelleDuVin\Domain\Couleur
     */
    protected function buildDomainObject(array $row) {
        $page = new Pages();
        $page->setId($row['ID_PAGE']);
        $page->setName($row['NOM']);
        $page->setContent($row['TEXTE']);
        return $page;
    }

        /**
     * Returns an color matching the supplied id.
     *
     * @param integer $id
     *
     * @return \CitadelleDuVin\Domain\Couleur|throws an exception if no matching color is found
     */
    public function find($id) {
        $sql = "select * from PAGES where ID_PAGE=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No page matching id " . $id);
    }

         /**
     * Update page
     *
     * @param \CitadelleDuVin\Domain\Pages $cart The cart to save
     */
    public function update(Pages $page) {
        $pageData = array(
            'ID_PAGE' => $page->getId(),
            'TEXTE' => $page->getContent(),
            'NOM' => $page->getName()
            );
                $this->getDb()->update('PAGES', $pageData, array('ID_PAGE' => $page->getId() ));

    }

    public function save(Pages $page) {
        $pageData = array(
            'ID_PAGE' => $page->getId(),
            'TEXTE' => $page->getContent(),
            'NOM' => $page->getName()
            );

        if ($page->getId()) {
            // The comment has already been saved : update it
            $this->getDb()->update('PAGES', $pageData, array('ID_PAGE' => $page->getId()));
        } else {
            // The comment has never been saved : insert it
            $this->getDb()->insert('PAGES', $pageData);
            // Get the id of the newly created comment and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $page->setId($id);
        }
    }
    
    
}