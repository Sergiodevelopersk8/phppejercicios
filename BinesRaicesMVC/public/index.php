<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;

$propiedadcontorller = PropiedadController::class;

$router = new Router();
$router->get('/admin',[$propiedadcontorller, 'index']);
$router->get('/propiedades/crear',[$propiedadcontorller,'crear']);
$router->post('/propiedades/crear',[$propiedadcontorller,'crear']);
$router->get('/propiedades/actualizar',[$propiedadcontorller,'actualizar']);
$router->post('/propiedades/actualizar',[$propiedadcontorller,'actualizar']);
$router->post('/propiedades/eliminar',[$propiedadcontorller,'eliminar']);




$router->comprobarRutas();