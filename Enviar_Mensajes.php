<?php

require 'Mensajes.php';


date_default_timezone_set('Europe/Madrid');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);

    $emisor = $datos["emisor"];
    $receptor = $datos["receptor"];
    $mensaje = $datos["mensaje"];
    $token_receptor_table = Mensajes::ObtenerDatosPorNombreUser($receptor);
    $token_receptor = $token_receptor_table["token"];

    $nameTableEmisor = 'msgs_' . $emisor;
    $nameTableReceptor = 'msgs_' . $receptor;

    $respuesta_Create_Table = Mensajes::CreateTable($nameTableEmisor);
    $respuesta_Create_Table = Mensajes::CreateTable($nameTableReceptor);

    $fechaActual = getdate();
    $segundos = $fechaActual['seconds'];
    $minutos = $fechaActual['minutes'];
    $hora = $fechaActual['hours'];
    $dia = $fechaActual['mday'];
    $mes = $fechaActual['mon'];
    $anyo = $fechaActual['year'];


    $id_emisor = $emisor . $dia . $mes . $anyo . $hora . $minutos . $segundos;
    $id_receptor = $emisor . $dia . $mes . $anyo . $hora . $minutos . $segundos;

    $hora_mensaje = date('Y-m-d G:i:s');


    //MEE - Mensaje Emisor Enviado
    //MRE - Mensaje Receptor Enviado
    $MEE = false;
    $MRE = false;

    $respuestaEnviarMensajeEmisor = Mensajes::EnviarMensaje($nameTableEmisor, $id_emisor, $mensaje, 1, $hora_mensaje, $receptor);
    if ($respuestaEnviarMensajeEmisor == 200) {
        $MRE = true;
    } elseif ($respuestaEnviarMensajeEmisor == -1) {
        $MRE = false;
    }


    $respuestaEnviarMensajeReceptor = Mensajes::EnviarMensaje($nameTableReceptor, $id_receptor, $mensaje, 2, $hora_mensaje,  $emisor);
    if ($respuestaEnviarMensajeReceptor == 200) {
        $MEE = true;
    } elseif ($respuestaEnviarMensajeReceptor == -1) {
        $MEE = false;
    }


    if ($MEE && $MRE) {
        Mensajes::EnviarNotificacion($mensaje, $hora_mensaje, $token_receptor ,$emisor);
    }
}

?>