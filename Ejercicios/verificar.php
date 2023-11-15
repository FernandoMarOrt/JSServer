<?php
$parametro1=$_REQUEST["nombre"];
$parametro2=$_REQUEST["clave"];

$respuesta= "";

    if($parametro1 == "Admin" && $parametro2 == "1234"){
        $respuesta=  "Usuario valido";
    }else{
        $respuesta=  "Usuario no valido";
    }

echo $respuesta;
?>