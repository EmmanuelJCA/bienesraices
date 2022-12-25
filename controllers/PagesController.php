<?php

namespace Controller;

use Model\Property;
use MVC\Router;

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
    public static function properties(  ) {
        echo "Desde properties";
    }
    public static function property(  ) {
        echo "Desde property";
    }
    public static function blog(  ) {
        echo "Desde blog";
    }
    public static function blogPost (  ) {
        echo "Desde blogPost";
    }
    public static function contact(  ) {
        echo "Desde contact";
    }
}