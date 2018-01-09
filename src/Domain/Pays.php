<?php

namespace CitadelleDuVin\Domain;

class Pays 
{
    /**
     * Land id.
     *
     * @var integer
     */
    private $id;

    /**
     * Land name.
     *
     * @var string
     */
    private $name;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
}