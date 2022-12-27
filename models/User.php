<?php

namespace Model;

class User extends ActiveRecord {

    // Base de datos
    protected static $table = 'users';
    protected static $dbColums = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }
}