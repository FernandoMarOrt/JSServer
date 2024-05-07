<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$_POST = json_decode(file_get_contents("php://input"), true);

require 'funciones.php';

if (isset($_POST['id_peluquero'], $_POST['id_dia'], $_POST['hora'], $_POST['estado'])) {
    $id_peluquero = $_POST['id_peluquero'];
    $id_dia = $_POST['id_dia']; // Corregir nombre de la variable
    $hora = $_POST['hora'];
    $estado = $_POST["estado"];

    try {
        // Consulta de inserción con sentencia preparada
        $consulta = "INSERT INTO FERNANDO_reservas (id_peluquero, id_dias, hora, estado, nombre, telefono) VALUES ('$id_peluquero','$id_dia','$hora','$estado','','')";
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
