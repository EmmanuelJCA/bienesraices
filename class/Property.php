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
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->bedrooms = $args['bedrooms'] ?? '';
        $this->bathrooms = $args['bathrooms'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->created = date('Y/m/d');
        $this->sellerId = $args['sellerId'] ?? 1;

    }

    public function save() {

        if(!is_null($this->id)) {
            $this->update();

        } else {
            $this->create();

        }
    }

    public function create() {

        // Sanitizar datos
        $attributes = $this->sanitizeAttributes();

        //Insertar en la base de datos
        $query = "INSERT INTO properties ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        // Mostrar mensaje de error en caso de que haya uno
        if($result) {
            // Redireccionar al usuario

            header('Location: /admin/index.php?result=1');
        }

    }

    public function update() {

        // Sanitizar datos
        $attributes = $this->sanitizeAttributes();

        $values = [];
        foreach($attributes as $key => $value) {
            $values [] = "{$key}='{$value}'";
        }

        $query = " UPDATE properties SET ";
        $query .= join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1 ";

        $result = self::$db->query($query);

        if($result) {
            // Redireccionar al usuario
            header('Location: /admin/index.php?result=2');
        }
    }

    public function delete() { 
        $query = "DELETE FROM properties WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        $result = self::$db->query($query);

        if($result) {
            $this->deleteImage();
            header('Location: /admin/index.php?result=3');
        }
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
        if(!is_null($this->id)) {
            $this->deleteImage();
        }

        $this->image = $image;
    }

    public function deleteImage() {
        // Comparar si existe el archivo
        $imageExists = file_exists(IMAGE_FOLDER . $this->image);
        if($imageExists) {
            debbug($imageExists);
            unlink(IMAGE_FOLDER2 . $this->image);
        }
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

    // Listar todas las propiedades
    public static function all() {
        $query = "SELECT * FROM properties";

        $result = self::querySQL($query);

        return $result;
    }

    // Encontrar una propiedad por su id
    public static function find($id) {
        $query = "SELECT * FROM properties WHERE id = ${id}";
        $result = self::querySQL($query);

        return array_shift($result);
    }

    public static function querySQL($query) {
        // Consultar la BDD
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($register = $result->fetch_assoc()){
            $array[] = self::createObject($register);
        }

        // Liberar memoria
        $result->free();


        // Retonar los resultados
        return $array;
    }

    protected static function createObject($register) {
        $object = new self;

        foreach($register as $key => $value) {
            if( property_exists( $object, $key ) ) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sync($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

}