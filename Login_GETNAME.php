<?php
require 'Login.php';

if($_SERVER['REQUEST_METHOD']=='GET') {

    if (isset($_GET['userName']) && isset($_GET['userPassword']) && $_GET['userPassword'] != "" && $_GET['userName'] != "") {
        $userName = $_GET['userName'];
        $userPassword = $_GET['userPassword'];

        $respuesta = Registro::ObtenerDatosPorNombrePass($userName, $userPassword);
        $contenedor = array();
        if ($respuesta) {
            $contenedor["result"] = "CC";
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        } else {
            echo json_encode(array('result' => 'Usuario o contraseña incorrectos'));
        }
    } else {
        echo json_encode(array('result' => 'Introduzca su nombre y contraseña.'));
    }
}
?>