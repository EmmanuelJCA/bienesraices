<?php

namespace App;

class Property {

    // Base de datos
    protected static $db;

    public $id;
    public $title;
    public $price;
    public $image;
    public $description;
    public $bedrooms;
    public $bathrooms;
    public $parking;
    public $created;
    public $sellerId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? 'image.jpg';
        $this->description = $args['description'] ?? '';
        $this->bedrooms = $args['bedrooms'] ?? '';
        $this->bathrooms = $args['bathrooms'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->created = date('Y/m/d');
        $this->sellerId = $args['sellerId'] ?? '';

    }

    public function save() {

        //Insertar en la base de datos
        $query = "INSERT INTO properties (title, price, image, description, bedrooms, bathrooms, parking, created, seller_id) VALUES ( '$this->title', '$this->price', '$this->image', '$this->description', '$this->bedrooms', '$this->bathrooms', '$this->parking', '$this->created', '$this->sellerId')";

        $result = self::$db->query($query);

        debbug($result);
    }

    public static function setDB($database) {
        self::$db = $database;
    }

}