<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginaController;

$propiedadContorller = PropiedadController::class;
$vendedorContorller = VendedorController::class;
$paginaController = PaginaController::class;


// zona privada
$router = new Router();
$router->get('/admin',[$propiedadContorller, 'index']);
$router->get('/propiedades/crear',[$propiedadContorller,'crear']);
$router->post('/propiedades/crear',[$propiedadContorller,'crear']);
$router->get('/propiedades/actualizar',[$propiedadContorller,'actualizar']);
$router->post('/propiedades/actualizar',[$propiedadContorller,'actualizar']);
$router->post('/propiedades/eliminar',[$propiedadContorller,'eliminar']);


$router->get('/vendedor/crear',[$vendedorContorller,'crear']);
$router->post('/vendedor/crear',[$vendedorContorller,'crear']);
$router->get('/vendedor/actualizar',[$vendedorContorller,'actualizar']);
$router->post('/vendedor/actualizar',[$vendedorContorller,'actualizar']);
$router->post('/vendedor/eliminar',[$vendedorContorller,'eliminar']);

// zona publica

$router->get('/',[$paginaController,'index']);
$router->get('/nosotros',[$paginaController,'nosotros']);
$router->get('/propiedades',[$paginaController,'propiedades']);
$router->get('/propiedad',[$paginaController,'propiedad']);
$router->get('/blog',[$paginaController,'blog']);
$router->get('/entrada',[$paginaController,'entrada']);
$router->get('/contacto',[$paginaController,'contacto']);
$router->post('/contacto',[$paginaController,'contacto']);



$router->comprobarRutas();