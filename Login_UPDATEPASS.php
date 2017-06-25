<?php
require 'Login.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents("php://input"), true);
    $respuesta = Registro::UpdateDatos( $datos["UserPassword"], $datos["idUser"], $datos["OldUserPassword"]);

    if ($respuesta) {
        echo "datos insertados";

    } else {
        echo "datos no insertados";
    }
}

?>