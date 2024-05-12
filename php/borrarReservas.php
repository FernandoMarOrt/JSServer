<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: DELETE"); 
header('Content-Type: application/json');

require 'funciones.php';

// Obtener el ID de la reserva a eliminar desde la URL
$id_reserva = $_GET['id_reserva'];

try {
    // Preparar y ejecutar la consulta de eliminación
    $consulta = "DELETE FROM FERNANDO_reservas WHERE id_reserva=?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$id_reserva]);

    // Verificar si se eliminó correctamente
    $filas_afectadas = $sentencia->rowCount();
    if ($filas_afectadas > 0) {
        $respuesta["mensaje"] = "Reserva eliminada correctamente";
    } else {
        $respuesta["mensaje"] = "No se encontró ninguna reserva con ese ID";
    }
} catch (PDOException $e) {
    // Manejar cualquier error de base de datos
    $respuesta["mensaje"] = "Error al eliminar la reserva: " . $e->getMessage();
}

// Devolver la respuesta como JSON
echo json_encode($respuesta);
?>
