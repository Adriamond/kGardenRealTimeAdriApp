<?php
require 'Alumno.php';

if($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['idAlumno'])) {
        $idAlumno = $_GET['idAlumno'];
        $respuesta = Alumno::ObtenerProfesorPorIdAlumno($idAlumno);

        $contenedor = array();

        if (count($respuesta) == 0)
        {
            echo json_encode(array('result' => 'El alumno no tiene ningún profesor asignado.'));
        }
        else if ($respuesta) {
            $contenedor["data"] = $respuesta;
            echo json_encode($contenedor);
        } else {
            echo json_encode(array('result' => 'El usuario no existe'));
        }
    }
}
?>