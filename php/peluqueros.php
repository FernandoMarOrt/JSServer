<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$_POST = json_decode(file_get_contents("php://input"), true);

require 'funciones.php';

try {
    $consulta = "select * from FERNANDO_peluqueros";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (PDOException $e) {
    $conexion = null;
    $sentencia = null;
    die(error_page("Error", "<h1>Error</h1><p>No he podido conectarse a la base de datos: " . $e->getMessage() . "</p>"));
}

$peluqeros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($peluqeros);
