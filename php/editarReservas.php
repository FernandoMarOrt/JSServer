<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT"); 
header('Content-Type: application/json');

$_PUT = json_decode(file_get_contents("php://input"), true); 
require 'funciones.php';

$id_reserva = $_PUT['id_reserva'];
$nombre = $_PUT['nombre']; 
$telefono = $_PUT['telefono'];
$estado = $_PUT['estado'];

try {
    $consulta = "UPDATE FERNANDO_reservas SET nombre=?, telefono=?, estado=? WHERE id_reserva=?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$nombre, $telefono, $estado, $id_reserva]);
    $respuesta["mensaje"] = "Acceso correcto";
} catch (PDOException $e) {
    $conexion = null;
    $sentencia = null;
    $respuesta["mensaje"] = "No se pudo insertar";
}
echo json_encode($respuesta);
?>
