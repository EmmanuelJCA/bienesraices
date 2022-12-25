<?php

require_once __DIR__ . '/../includes/app.php';

use Controller\PagesController;
use MVC\Router;
use Controller\PropertyController;
use Controller\SellerController;

$router = new Router();

$router->get('/admin', [PropertyController::class, 'index']);

/** ADMIN ROUTES */
// Property crud routes
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/create', [PropertyController::class, 'create']);
$router->get('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/update', [PropertyController::class, 'update']);
$router->get('/properties/delete', [PropertyController::class, 'delete']);

// Seller crud routes
$router->get('/sellers/create', [SellerController::class, 'create']);
$router->post('/sellers/create', [SellerController::class, 'create']);
$router->get('/sellers/update', [SellerController::class, 'update']);
$router->post('/sellers/update', [SellerController::class, 'update']);
$router->get('/sellers/delete', [SellerController::class, 'delete']);
/** END ADMIN ROUTES */

/** PAGES ROUTES */
$router->get('/', [PagesController::class, 'index']);
$router->get('/aboutUs', [PagesController::class, 'aboutUs']);
$router->get('/properties', [PagesController::class, 'properties']);
$router->get('/property', [PagesController::class, 'property']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/blogPost', [PagesController::class, 'blogPost']);
$router->get('/contact', [PagesController::class, 'contact']);
$router->post('/contact', [PagesController::class, 'contact']);
/** END PAGES ROUTES */

$router->checkRoutes();