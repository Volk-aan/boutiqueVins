<?php

namespace CitadelleDuVin\Domain;

class Produit 
{
    /**
     * Product id.
     *
     * @var integer
     */
    private $id;

    /**
     * Product name.
     *
     * @var string
     */
    private $name;

    /**
     * Product description.
     *
     * @var string
     */
    private $description;


    /**
     * Product taste
     * 
     * @var string
     */
    private $taste;

    /**
     * Product color
     * 
     * @var string
     */
    private $color;

    /**
     * Product alcool
     * 
     * @var string
     */
    private $alcool;

    /**
     * Product temperature
     * 
     * @var string
     */
    private $temperature;

     /**
     * Product stock
     * 
     * @var int
     */
    private $stock;

     /**
     * Product is bio
     * 
     * @var int
     */
    private $bio;

    /**
     * Product picture
     * 
     * @var string
     */
    private $picture;
    
    
    /**
     * Product year
     *
     * @var string
     */
    private $year;
    
    
    /**
     * Product land
     *
     * @var string
     */
    private $land;
    
    /**
     * Product price
     *
     * @var double
     */
    private $price;
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return the $taste
     */
    public function getTaste()
    {
        return $this->taste;
    }

    /**
     * @param string $taste
     */
    public function setTaste(Gout $taste)
    {
        $this->taste = $taste;
    }

    /**
     * @return the $color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(Couleur $color)
    {
        $this->color = $color;
    }

    /**
     * @return the $alcool
     */
    public function getAlcool()
    {
        return $this->alcool;
    }

    /**
     * @param string $alcool
     */
    public function setAlcool($alcool)
    {
        $this->alcool = $alcool;
    }

    /**
     * @return the $temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param string $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return the $stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param number $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return the $bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param number $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return the $picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
    /**
     * @return the $year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }
    
    /**
     * @return the $land
     */
    public function getLand()
    {
        return $this->land;
    }

    /**
     * @param string $land
     */
    public function setLand(Pays $land)
    {
        $this->land = $land;
    }

    /**
     * @return the $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}