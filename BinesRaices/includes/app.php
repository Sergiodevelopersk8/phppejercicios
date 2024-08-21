<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

/*conexion */
$db = conectarDB();

use App\Propiedad;


Propiedad::setDB($db);