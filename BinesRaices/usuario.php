<?php

//importar la conexion

require 'includes/config/database.php';
$db = conectarDB();

//crear un email y password
$email = "correo@correo.com";
$password="123456";

$password_hash = password_hash($password, PASSWORD_BCRYPT);


//Query para crear el usuario
$query = "INSERT INTO usuarios (email,password) VALUES ('$email','$password_hash');";





//Agregar a la base de datos
mysqli_query($db,$query);