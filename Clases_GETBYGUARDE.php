<?php
require 'Alumno.php';

if($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['nombreGuarderia'])) {
       $nombreGuarderia = $_GET['nombreGuarderia'];
        $respuesta = Alumno::ObtenerClasesPorGuarde($nombreGuarderia);

        $contenedor = array();

        if (count($respuesta) == 0)
        {
            echo json_encode(array('result' => 'Esta guardería está cerrada.'));
        }
        else if ($respuesta) {
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        } else {
            echo json_encode(array('result' => 'La guardería no existe'));
        }
    }
}
?>