<?php

namespace CitadelleDuVin\Domain;

class Comporte 
{

    
    /**
     * Command id.
     *
     * @var int
     */
    private $idCommand;

    /**
     * Command id.
     *
     * @var Produit
     */
    private $product;


     /**
     * Command quantity
     * 
     * @var int
     */
    private $quantity;
    

    /**
     * Command price.
     *
     * @var float
     */
    private $price;



    public function getId() {
        return $this->idCommand;
    }

    public function setId($id) {
        $this->idCommand = $id;
        return $this;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setProduct(Produit $product) {
        $this->product = $product;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }


}