<?php

//include el header
require 'includes/app.php';

$db = conectarDB();

$errores = [];


//autenticar usuario
if($_SERVER['REQUEST_METHOD']== 'POST'){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

$email = mysqli_real_escape_string( $db,filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));


$password = mysqli_real_escape_string( $db,$_POST['password']);

if(!$email){

    $errores[] = "El email es obligatorio o no es valido";
}

if(!$password){
    $errores[] = "El password es obligatorio ";
}

if(empty($error)){
//revisar si existe

$query = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($db, $query);
// var_dump($resultado);

if($resultado->num_rows){
//revisa si el password es correcto
$usuario = mysqli_fetch_assoc($resultado);

//verificar si el passwor es correcto o no
$aut = password_verify($password , $usuario['password']);

if($aut){
    //autenticar al usuario
    session_start();

    $_SESSION['usuario'] = $usuario['email'];
    $_SESSION['login'] = true;

    header('Location: /udemyphpcurso/BinesRaices/admin');


}else{
    $errores[] = "el password es incorrecto";
}


}
else{
$errores [] = "El usuario no existe";
}


}



}



incluirTemplate('header');
?>


<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

<?php foreach($errores as $error): ?>

<div class="alerta error">
    <?php echo $error; ?>
</div>
    <?php endforeach; ?>

<form method= "POST" class="formulario">
<fieldset>
    <legend>Email y Password</legend>

    
    <label for="email">Email</label>
    <input type="text" name="email" placeholder="Tu Email" id="email">
    
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Tu Password" id="password" require>
    
    <input type="submit" value="Iniciar Sesión" class="boton boton-verde" require>
    
</fieldset>


</form>


</main>

<?php
incluirTemplate('footer');
?>