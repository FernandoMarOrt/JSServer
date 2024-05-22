<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$_POST = json_decode(file_get_contents("php://input"), true);

// Depuración: Verificar los datos recibidos
var_dump($_POST);

require 'funciones.php';

if (isset($_POST['id_peluquero'], $_POST['id_dia'], $_POST['hora'], $_POST['estado'], $_POST['mes'])) {
    $id_peluquero = (int) $_POST['id_peluquero'];
    $id_dia = (int) $_POST['id_dia'];
    $hora = $_POST['hora'];
    $estado = (int) $_POST["estado"];
    $mes = $_POST['mes'];

    try {
        $consulta = "INSERT INTO FERNANDO_reservas (id_peluquero, id_dias, hora, estado, nombre, telefono, mes) VALUES ('$id_peluquero','$id_dia','$hora','$estado','','','$mes')";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $respuesta["mensaje"] = "Reserva insertada correctamente";
    } catch (PDOException $e) {
        $respuesta["mensaje"] = "Error al insertar reserva: " . $e->getMessage();
    }
} else {
    $respuesta["mensaje"] = "No se recibieron todos los datos necesarios para insertar la reserva";
}

echo json_encode($respuesta);
?>
