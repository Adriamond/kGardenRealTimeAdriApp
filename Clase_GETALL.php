<?php
require 'Alumno.php';

if($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['idUser'])) {
        $idUser = $_GET['idUser'];

        $respuesta = Alumno::ObtenerTodasLasClases($idUser);

        $contenedor = array();

        if (count($respuesta) == 0) {
            echo json_encode(array('result' => 'Aún no ha registrado ningún alumno.'));
        } else if ($respuesta) {
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        }
    }
}
?>