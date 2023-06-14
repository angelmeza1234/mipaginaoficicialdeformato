<?php
$server = 'localhost'; 
$db = 'app';
$usuario = 'root';
$password = '';
try{
    $conexion = new PDO("mysql:host= $server; dbname = $db", $usuario, $password);
    echo "conectado con exito";
}catch (PDOException $pe) {
    die("Could not connect to the database $db :" . $pe->getMessage());
}