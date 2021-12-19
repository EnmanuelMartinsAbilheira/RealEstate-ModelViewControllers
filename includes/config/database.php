<?php

function conectarDB():mysqli{
    //"ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '1911eelm2000'";
    $db = new mysqli('localhost:3306','root','1911eelm2000','bienesraices_crud');
    
    if (!$db) {
        echo 'error no se pudo conectar';
        exit;
    }
    return $db;
}