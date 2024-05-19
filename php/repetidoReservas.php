<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$_POST = json_decode(file_get_contents("php://input"), true);

require 'funciones.php';

// Obtener los datos de la reserva a verificar
$id_peluquero = $_POST['id_peluquero'];
$id_dia = $_POST['id_dia'];
$hora = $_POST['hora'];
$mes = $_POST['mes'];

try {
    // Consulta SQL para verificar si la reserva está duplicada
    $sql = "SELECT COUNT(*) AS count FROM reservas WHERE id_peluquero = :id_peluquero AND id_dia = :id_dia AND hora = :hora AND mes = :mes";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_peluquero', $id_peluquero);
    $stmt->bindParam(':id_dia', $id_dia);
    $stmt->bindParam(':hora', $hora);
    $stmt->bindParam(':mes', $mes);
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // La reserva está duplicada
        echo json_encode(array("duplicada" => true));
    } else {
        // La reserva no está duplicada
        echo json_encode(array("duplicada" => false));
    }
} catch(PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;

?>
