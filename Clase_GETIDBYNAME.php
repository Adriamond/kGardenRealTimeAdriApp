<?php
require 'Alumno.php';

if($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['nombreClase'])) {
        $nombreClase = $_GET['nombreClase'];
        $respuesta = Alumno::ObtenerIdClasePorNombre($nombreClase);

        $contenedor = array();

        if (count($respuesta) == 0)
        {
            echo json_encode(array('result' => 'Esta clase está cerrada.'));
        }
        else if ($respuesta) {
            echo json_encode(array('result' => $respuesta));
        } else {
            echo json_encode(array('result' => 'Error'));
        }
    }
}
?>