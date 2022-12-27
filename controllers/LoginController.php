<?php

namespace Controller;
use MVC\Router;
use Model\User;

class LoginController {

    public static function login( Router $router ) {

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "aut";
        }

        $router->render('auth/login', [
            'errors' => $errors
        ]);
    }

    public static function logout() {
        echo "Desde logout";
    }

}