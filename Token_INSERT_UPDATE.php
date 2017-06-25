<?php
require 'Token.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);
    $respuesta = Token::InsertarNuevoToken($datos["idUserToken"], $datos["token"]);

        if ($respuesta) {
            echo json_encode(array('result' => 'Token insertados'));



    } else {
        Token::UpdateDatos($datos["token"], $datos["idUserToken"]);
            echo json_encode(array('result' => - 'Token se intentó actualizar'));
    }
}

?>