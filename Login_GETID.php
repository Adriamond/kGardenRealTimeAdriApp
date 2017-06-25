<?php
require 'Login.php';

if($_SERVER['REQUEST_METHOD']=='GET') {

    if (isset($_GET['idUser'])) {
        $identificador = $_GET['idUser'];

        $respuesta = Registro::ObtenerDatosPorId($identificador);
        $contenedor = array();

        if ($respuesta) {
            $contenedor["result"] = "CC";
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        } else {
            echo json_encode(array('result' => 'El usuario no existe'));
        }
    } else {
        echo json_encode(array('result' => 'No se ha especificado ningun identificador de usuario.'));
    }
}
?>