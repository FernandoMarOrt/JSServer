<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$_POST = json_decode(file_get_contents("php://input"), true);

require 'funciones.php';

// Verificar si se recibieron los datos necesarios para la edición
if (isset($_POST['id']) && isset($_POST['campo1']) && isset($_POST['campo2'])) {
    $id = $_POST['id'];
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];

    try {
        // Preparar la consulta de actualización
        $consulta = "UPDATE tu_tabla SET campo1 = :campo1, campo2 = :campo2 WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bindParam(':id', $id);
        $sentencia->bindParam(':campo1', $campo1);
        $sentencia->bindParam(':campo2', $campo2);
        
        // Ejecutar la consulta
        $sentencia->execute();

        // Responder con un mensaje de éxito
        echo json_encode(array("message" => "Datos actualizados correctamente"));
    } catch (PDOException $e) {
        // Responder con un mensaje de error
        echo json_encode(array("error" => "Error al actualizar datos: " . $e->getMessage()));
    }
} else {
    // Responder con un mensaje de error si faltan datos
    echo json_encode(array("error" => "Faltan datos para la actualización"));
}
