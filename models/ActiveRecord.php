<?php

namespace Model;

class ActiveRecord {

    // Base de datos
    protected static $db;
    protected static $dbColumns = [];

    protected static $table = '';

    // Errores
    protected static $errors = [];

    public static function setDB($database) {
        self::$db = $database;
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
        $query = "INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        // Mostrar mensaje de error en caso de que haya uno
        if($result) {
            // Redireccionar al usuario

            header('Location: /admin?result=1');
        }

    }

    public function update() {

        // Sanitizar datos
        $attributes = $this->sanitizeAttributes();

        $values = [];
        foreach($attributes as $key => $value) {
            $values [] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1 ";

        $result = self::$db->query($query);

        if($result) {
            // Redireccionar al usuario
            header('Location: /admin?result=2');
        }
    }

    public function delete() { 
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        $result = self::$db->query($query);

        if($result) {
            $this->deleteImage();
            header('Location: /admin?result=3');
        }
    }

    // Identificar y unir los atributos de la BDD
    public function attributes() {
        $attributes = [];
        foreach(static::$dbColumns as $column) {
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
            unlink(IMAGE_FOLDER . $this->image);
        }
    }

    // Validacion
    public static function getErrors() {
        return static::$errors;
    }

    public function validate() {
        static::$errors = [];
        return static::$errors;
    }

    // Listar todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$table;

        $result = self::querySQL($query);

        return $result;
    }

    // Listar cantidad especifica de propiedades
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $limit;

        $result = self::querySQL($query);

        return $result;
    }

    // Encontrar una propiedad por su id
    public static function find($id) {

        $query = "SELECT * FROM " . static::$table . " WHERE id = " . self::$db->escape_string($id);
        $result = self::querySQL($query);

        return array_shift($result);
    }

    public static function querySQL($query) {
        // Consultar la BDD
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($register = $result->fetch_assoc()){
            $array[] = static::createObject($register);
        }

        // Liberar memoria
        $result->free();


        // Retonar los resultados
        return $array;
    }

    protected static function createObject($register) {
        $object = new static;

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