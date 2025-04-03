<?php
function conectarDB() : mysqli{
    $db = mysqli_connect('localhost','root','root','bienesraices_db',3307);

    if(!$db){
        echo 'No se conecto';
        exit;
    }
    return $db;

}
