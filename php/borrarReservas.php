<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: DELETE"); 
header('Content-Type: application/json');

require 'funciones.php';


$id_reserva = $_GET['id_reserva'];

try {
  
    $consulta = "DELETE FROM FERNANDO_reservas WHERE id_reserva=?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$id_reserva]);

    //Si se elimina bien informo
    $filas_afectadas = $sentencia->rowCount();
    if ($filas_afectadas > 0) {
        $respuesta["mensaje"] = "Reserva eliminada correctamente";
    } else {
        $respuesta["mensaje"] = "No se encontró ninguna reserva con ese ID";
    }
} catch (PDOException $e) {
    
    $respuesta["mensaje"] = "Error al eliminar la reserva: " . $e->getMessage();
}


echo json_encode($respuesta);
?>
