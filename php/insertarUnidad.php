<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

require 'funciones.php';

$response = array();

if (isset($data['id_peluquero'], $data['id_dias'], $data['hora'], $data['estado'], $data['mes'])) {
    $id_peluquero = (int) $data['id_peluquero'];
    $id_dias = (int) $data['id_dias'];
    $hora = $data['hora'];
    $estado = (int) $data["estado"];
    $mes = $data['mes'];

        // Insertar la reserva
        $consulta = "INSERT INTO FERNANDO_reservas (id_peluquero, id_dias, hora, estado, nombre, telefono, mes) VALUES (:id_peluquero, :id_dias, :hora, :estado, '', '', :mes)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bindParam(':id_peluquero', $id_peluquero);
        $sentencia->bindParam(':id_dias', $id_dias);
        $sentencia->bindParam(':hora', $hora);
        $sentencia->bindParam(':estado', $estado);
        $sentencia->bindParam(':mes', $mes);
        $sentencia->execute();

        $response["mensaje"] = "Reserva insertada correctamente";

} else {
    $response["mensaje"] = "No se recibieron todos los datos necesarios para insertar la reserva";
}

echo json_encode($response);
?>
