<?php

namespace CitadelleDuVin\Domain;

class Commande 
{
    /**
     * Command id.
     *
     * @var int
     */
    private $id;

    /**
     * Command consummer.
     *
     * @var int
     */
    private $user;

    /**
     * Command price.
     *
     * @var float
     */
    private $price;

    /**
     * List product
     * 
     * @var array
     */
    private $list=array();


    /**
     * Command status
     * 
     * @var int
     */
    private $status;

    /**
     * Command date
     *
     * @var date
     * 
     */
    private $date;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getList() {
        return $this->list;
    }

    public function setList(array $list){
        $this->list = $list;
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
        return $this;
    }

}