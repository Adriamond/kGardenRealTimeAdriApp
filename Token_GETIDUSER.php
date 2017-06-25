<?php
require 'Token.php';

if($_SERVER['REQUEST_METHOD']=='GET') {

    if (isset($_GET['idUserToken'])) {
        $identificador = $_GET['idUserToken'];

        $respuesta = Token::ObtenerDatosPorIdUser($identificador);

        if ($respuesta) {
            echo $respuesta["token"];
        } else {
            echo json_encode(array('result' => 'El token no existe'));
        }
    } else {
        echo json_encode(array('result' => 'No se ha especificado ningun identificador de token.'));
    }
}
?>