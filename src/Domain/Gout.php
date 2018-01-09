<?php

namespace CitadelleDuVin\Domain;

class Gout 
{
    /**
     * Taste id.
     *
     * @var integer
     */
    private $id;

    /**
     * Taste name.
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