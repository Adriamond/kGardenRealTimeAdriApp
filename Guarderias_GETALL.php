<?php
require 'Alumno.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $contenedor = array();
    try {
        $respuesta = Alumno::ObtenerTodasLasGuarderias();

        if ($respuesta) {
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        }
    } catch (PDOException $e) {
        echo "Error";
    }
}
?>