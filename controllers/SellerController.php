<?php

namespace Controller;
use MVC\Router;
use Model\Seller;

class SellerController {

    public static function create(Router $router) {

        $seller = new Seller();

        // Arreglos con mensajes de errores
        $errors = Seller::getErrors();

        // Ejecutar el codigo despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Crear una nueva instancia
            $seller = new Seller($_POST['seller']);

            $errors = $seller->validate();

            if(empty($errors)) {
                $seller->save();
            }
        }

        $router->render('sellers/create', [
            'seller' => $seller,
            'errors' => $errors
        ]);
    }
}