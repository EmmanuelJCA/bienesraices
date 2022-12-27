<?php

namespace MVC;

class Router {

    public $routesGET = [];
    public $routesPOST = [];

    public function get($url, $fn) {
        $this->routesGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->routesPOST[$url] = $fn;
    }
    
    public function checkRoutes() {

        session_start();

        $auth = $_SESSION['logged'] ?? null;

        // Arreglo para rutas protegidas
        $protectedRoutes = ['/admin', '/properties/create', '/properties/updaye', '/properties/delete', '/sellers/create', '/sellers/update', '/sellers/delete'];

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'GET') {
            $fn = $this->routesGET[$currentUrl] ?? null;
        } else {
            $fn = $this->routesGET[$currentUrl] ?? null;
        }

        if(in_array($currentUrl, $protectedRoutes) && !$auth) {
            header('Location: /login');
        }
        
        if($fn) {
            // La url existe y hay una funcion asociada
            call_user_func($fn, $this);

        } else {
            echo "Pagina No Encontrada";
        }
    }

    public function render($view, $data = []) {

        foreach($data as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";

        $content = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }

}