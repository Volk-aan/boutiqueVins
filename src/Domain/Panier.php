<?php

namespace CitadelleDuVin\Domain;

class Panier 
{
    /**
     * Cart id product.
     *
     * @var Produit
     */
    private $product;

    /**
     * Cart user.
     *
     * @var int
     */
    private $user;

    /**
     * Cart product.
     *
     * @var int
     */
    private $quantity;

    public function getProduct() {
        return $this->product;
    }

    public function setProduct(Produit $product) {
        $this->product = $product;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
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