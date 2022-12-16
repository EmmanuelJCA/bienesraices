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
}