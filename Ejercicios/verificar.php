<?php
$param1 = $_REQUEST["usuario"];
$param2 = $_REQUEST["clave"];


$param1 = strtolower($param1);


$respuesta = "";


if ($param1 !== "admin" || $param2 !== "1234") {

    $respuesta = "USUARIO NO VALIDO";
} else {
    $respuesta = "USUARIO VALIDO";
}


echo $respuesta ;
?>