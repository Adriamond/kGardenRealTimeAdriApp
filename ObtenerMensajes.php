<?php
require 'Mensajes.php';

if($_SERVER['REQUEST_METHOD']=='GET'){

    if (isset($_GET['nameTable'])) {
        $nameTable = $_GET['nameTable'];
        $receptor = $_GET['receptor'];
        $respuesta = Mensajes::ObtenerTodosLosMensajes($nameTable, $receptor);

        $contenedor = array();

        if (count($respuesta) == 0)
        {
            echo json_encode(array('result' => 'Aún no ha registrado ningún alumno.'));
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