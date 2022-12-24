<?php

namespace Controller;
use MVC\Router;
use Model\Property;
use Model\Seller;
use Intervention\Image\ImageManagerStatic as Image;

class PropertyController {
    public static function index(Router $router) {

        $properties = Property::all();

        // Muestra mensaje condicional
        $result = $_GET['result'] ?? null;

        $router->render('properties/admin', [
            'properties' => $properties,
            'result' => $result
        ]);
    }

    public static function create(Router $router) {

        $property = new Property();
        $sellers = Seller::all();

        // Arreglos con mensajes de errores
        $errors = Property::getErrors();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $property = new Property($_POST['property']);
    
            /** SUBIDA DE ARCHIVOS */
    
            // Generar un nombre unico
            $imageName = md5( uniqid( rand(), true) )  . ".jpg";
            
            // Realiza un resize a la imagen con intervention
            if($_FILES['property']['tmp_name']['image']) {
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
                $property->setImage($imageName);
            }
    
            $errors = $property->validate();
    
            // Realizar INSERT si no hay errores
            if(empty($errors)) {
    
                // Crear carpeta para subir imagenes
                if(!is_dir(IMAGE_FOLDER)) {
                    mkdir(IMAGE_FOLDER);
                }
    
                // Guardar la imagen en el servidor
                $image->save(IMAGE_FOLDER . $imageName);
    
                // Guardar en la base de datos
                $property->save();
                
            }
            
        }

        $router->render('properties/create', [
            'property' => $property,
            'sellers' => $sellers,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router) {

        $id = validateUrlId('/admin');
        $property = Property::find($id);

        $sellers = Seller::all();

        $errors = Property::getErrors();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            // Asignar atributos
            $args = $_POST['property'];
    
            $property->sync($args);
    
            $errors = $property->validate();
    
            /** SUBIDA DE ARCHIVOS */
    
            // Generar un nombre unico
            $imageName = md5( uniqid( rand(), true) )  . ".jpg";
    
            // Realiza un resize a la imagen con intervention
            if($_FILES['property']['tmp_name']['image']) {
                $image = Image::make($_FILES['property']['tmp_name']['image'])->fit(800, 600);
                $property->setImage($imageName);
            }
    
            // Realizar INSERT si no hay errores
            if(empty($errors)) {
                if($_FILES['property']['tmp_name']['image']) {
                $image->save(IMAGE_FOLDER . $imageName);
                }
                
                $result =  $property->save();
            }
        }

        $router->render('/properties/update',[
            'property' => $property,
            'errors' => $errors,
            'sellers' => $sellers
        ]);
    }

    public static function delete() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
    }
}