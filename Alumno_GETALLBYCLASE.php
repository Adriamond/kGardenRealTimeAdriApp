<?php
require 'Alumno.php';

if($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['idClase'])) {
        $idClase = $_GET['idClase'];

        $respuesta = Alumno::ObtenerAlumnosPorClase($idClase);

        $contenedor = array();

        if (count($respuesta) == 0) {
            echo json_encode(array('result' => 'Error.'));
        } else if ($respuesta) {
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        }
    }
}
?>