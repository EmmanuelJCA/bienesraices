<?php

namespace Controller;

use Model\Property;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PagesController {
    public static function index( Router $router ) {

        $properties = Property::get(3);
        $index = true;

        $router->render('pages/index', [
            'properties' => $properties,
            'index' => $index
        ]);
    }
    public static function aboutUs( Router $router ) {
        $router->render('pages/aboutUs');
    }
    public static function properties( Router $router ) {
        
        $properties = Property::all();
        $router->render('pages/properties', [
            'properties' => $properties
        ]);
    }
    public static function property( Router $router ) {

        // Validar ID
        $id = validateUrlId('properties');

        $property = Property::find($id);
        $router->render('pages/property', [
            'property' => $property
        ]);
    }
    public static function blog( Router $router ) {
        $router->render('pages/blog');
    }
    public static function blogPost ( Router $router ) {
        $router->render('pages/blogPost');
    }
    public static function contact( Router $router ) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Instancia de PHPMailer
            $mail = new PHPMailer();
        }

        $router->render('pages/contact', [

        ]);
    }
}