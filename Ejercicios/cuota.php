<?php
$param1 = $_REQUEST["capital"];
$param2 = $_REQUEST["interes"];
$param3 = $_REQUEST["plazo"];

$respuesta = "";

if($param1 === 0 || $param2 === 0 || $param3 === 0){

    $respuesta = "Introduzca todo los parametros";

}else{

    $respuesta = "Su cuota mensual sera de: ".($param1 * (1+($param2/100))) / $param3."€";
}


echo $respuesta;
?>