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

    public function validate()
    {
        if(!$this->email) {
            self::$errors[] = 'El email es obligatorio';
        }
        if(!$this->password) {
            self::$errors[] = 'El password es obligatorio';
        }

        return self::$errors;
    }

    public function userExists() {
        // Revisar si existe el usuario
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

        $result = self::$db->query($query);

        if(!$result->num_rows) {
            self::$errors[] = 'El usuario no existe';
            return;
        }

        return $result;
    }

    public function checkPassword($result) {
        $user = $result->fetch_object();

        $authenticated = password_verify($this->password, $user->password);

        if(!$authenticated) {
            self::$errors[] = 'El password es incorrecto';
        }

        return $authenticated;

    }

    public function authenticate() {
        session_start();

        // Llenar el arreglo de session
        $_SESSION['user'] = $this->email;
        $_SESSION['logged'] = true;
        
        header('Location: /admin');
    }
}