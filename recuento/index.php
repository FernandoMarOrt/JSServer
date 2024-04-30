<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header('Content-Type: application/json');

$data = file_get_contents('php://input');
$decodedData = json_decode($data, true);

$archivoRecuento = 'recuento.txt';

$contenidoActual = file_get_contents($archivoRecuento);
$valoresActuales = explode('||', $contenidoActual);

if (empty($valoresActuales) || count($valoresActuales) !== 6) {
    echo json_encode(['mensaje' => 'Error en el formato del archivo']);
    exit();
}

$nuevosValores = $decodedData['array'];

for ($i = 0; $i < 6; $i++) {
    $valoresActuales[$i] += $nuevosValores[$i];
}

$nuevoContenido = implode('||', $valoresActuales);

file_put_contents($archivoRecuento, $nuevoContenido);

echo json_encode(['mensaje' => 'Datos guardados correctamente', 'nuevosValores' => $valoresActuales]);
?>
