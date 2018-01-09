<?php

namespace CitadelleDuVin\Domain;

class Pages 
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

    /**
     * Taste texte.
     *
     * @var string
     */
    private $content;

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

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
}