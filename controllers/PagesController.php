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

            $response = $_POST['contact'];

            // Instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '006414b68dde94';
            $mail->Password = '78adeeb6b77276';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el envio del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienesraices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';
            
            // Habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $content = '<html>';
            $content .= '<p>Tienes un nuevo mensaje</p>';
            $content .= '<p>Nombre: ' . $response['name'] . '</p>';
            $content .= '<p>Email: ' . $response['email'] . '</p>';
            $content .= '<p>Telefono: ' . $response['phone'] . '</p>';
            $content .= '<p>Mensaje: ' . $response['message'] . '</p>';
            $content .= '<p>Asunto: ' . $response['type'] . '</p>';
            $content .= '<p>Presupuesto: ' . $response['budget'] . '$</p>';
            $content .= '<p>Preferencia de contacto: ' . $response['contact'] . '</p>';
            $content .= '<p>Fecha para contacto: ' . $response['date'] . '</p>';
            $content .= '<p>Hora: ' . $response['hour'] . '</p>';
            $content .= '</html>';

            $mail->Body = $content;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el email
            if($mail->send()) {
                echo "Mensaje enviado correctamente";
            } else {
                echo "El mensaje no se envio";
            }
        }

        $router->render('pages/contact', [

        ]);
    }
}