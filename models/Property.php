<?php

namespace Model;

class Property extends ActiveRecord {

    protected static $dbColumns = ['id', 'title', 'price', 'image', 'description', 'bedrooms', 'bathrooms', 'parking', 'created', 'sellerId'];

    protected static $table = 'properties';

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
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->bedrooms = $args['bedrooms'] ?? '';
        $this->bathrooms = $args['bathrooms'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->created = date('Y/m/d');
        $this->sellerId = $args['sellerId'] ?? '';

    }

    public function validate() {
        // Validaciones
        if(!$this->title) {
            self::$errors[] = "El Titulo es obligatorio";
        }
        if(!$this->price) {
            self::$errors[] = "El precio es obligatorio";
        }
        if(strlen($this->description) < 50) {
            self::$errors[] = "La descripcion debe contener al menos 50 caracteres";
        }
        if(!$this->bedrooms) {
            self::$errors[] = "El numero de habitaciones es obligatorio";
        }
        if(!$this->bathrooms) {
            self::$errors[] = "El numero de banios es obligatorio";
        }
        if(!$this->parking) {
            self::$errors[] = "El numero de estacionamientos es obligatorio";
        }
        if(!$this->sellerId) {
            self::$errors[] = "Debe seleccionar un vendedor";
        }
        if(!$this->image) {
            self::$errors[] = "La imagen es obligatoria";
        }

        return self::$errors;
    }

}