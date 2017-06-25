<?php
require 'Token.php';

if($_SERVER['REQUEST_METHOD']=='GET') {

    if (isset($_GET['idToken'])) {
        $identificador = $_GET['idToken'];

        $respuesta = Token::ObtenerDatosPorIdToken($identificador);

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