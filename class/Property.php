<?php

namespace App;

class Property {

    // Base de datos
    protected static $db;
    protected static $dbColumns = ['id', 'title', 'price', 'image', 'description', 'bedrooms', 'bathrooms', 'parking', 'created', 'sellerId'];

    // Errores
    protected static $errors = [];

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

    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
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

    public function save() {

        // Sanitizar datos
        $attributes = $this->sanitizeAttributes();

        //Insertar en la base de datos
        $query = "INSERT INTO properties ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        return $result;

    }

    // Identificar y unir los atributos de la BDD
    public function attributes() {
        $attributes = [];
        foreach(self::$dbColumns as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];

        foreach($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }   
        
        return $sanitized;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    // Validacion
    public static function getErrors() {
        return self::$errors;
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