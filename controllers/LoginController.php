<?php

namespace Controller;
use MVC\Router;
use Model\User;

class LoginController {

    public static function login( Router $router ) {

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new User($_POST);

            $errors = $auth->validate();

            if(empty($errors)) {

                // Verificar si el usuario existe
                $result = $auth->userExists();

                if(!$result) {
                    // Verificar si el usuario existe
                    $errors = User::getErrors();
                } else {
                    // Verificar el password
                    $authenticated = $auth->checkPassword($result);

                    if($authenticated) {
                    // Autenticar al usuario
                        $auth->authenticate();
                    } else {
                        $errors = User::getErrors();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errors' => $errors
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

}