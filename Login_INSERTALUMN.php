<?php
require 'Login.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);

    $respuesta = Registro::InsertarNuevoAlumno($datos["idFamilia"], $datos["idClase"], $datos["nombreApel"], $datos["cumple"]);

    if ($respuesta) {
        echo json_encode(array('result' => 'Usuario creado'));
    } else if ($respuesta === "23000") {
        echo json_encode(array('result' => 'El nombre de usuario ya existe'));
    } else if ($respuesta === "23") {
        echo json_encode(array('result' => 'El correo electrónico ya está en uso'));
    } else {
        echo json_encode(array('result' => 'Error no controlado, inténtelo más tarde'));
    }
}
?>