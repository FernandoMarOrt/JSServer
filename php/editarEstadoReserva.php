<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: PUT"); 
header('Content-Type: application/json');

$_PUT = json_decode(file_get_contents("php://input"), true); 
require 'funciones.php';

$id_reserva = $_PUT['id_reserva'];
$estado = $_PUT['estado'];

try {
    $consulta = "UPDATE FERNANDO_reservas SET nombre=?, telefono=?, estado=? WHERE id_reserva=?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute(["", "", $estado, $id_reserva]);
    $respuesta["mensaje"] = "Reserva cancelada correctamente";
} catch (PDOException $e) {
    $respuesta["mensaje"] = "Error al cancelar la reserva: " . $e->getMessage();
}

echo json_encode($respuesta);
?>
