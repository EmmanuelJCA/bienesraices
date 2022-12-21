<?php

namespace App;

class Seller extends ActiveRecord {

    protected static $dbColumns = ['id', 'name', 'surname', 'phone'];
    protected static $table = 'sellers';


    public $id;
    public $name;
    public $surname;
    public $phone;

    public function __construct($args = [])
    {
        $this->id = $args['id'];
        $this->name = $args['name'];
        $this->surname = $args['surname'];
        $this->phone = $args['phone'];
    }

    public function validate() {
        // Validaciones
        if(!$this->name) {
            self::$errors[] = "El Nombre es obligatorio";
        }
        if(!$this->surname) {
            self::$errors[] = "El Apellido es obligatorio";
        }
        if(!$this->phone) {
            self::$errors[] = "El Telefono es obligatorio";
        }
        if(!preg_match('/[0-9]{10}/', $this->phone)) {
            self::$errors[] = "Formato no valido";
        }

        return self::$errors;
    }
}