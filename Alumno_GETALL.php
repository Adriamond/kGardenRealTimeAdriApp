<?php
require 'Alumno.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
    try{
        $Respuesta = Alumno::ObtenerTodosLosAlumnos();
        echo json_encode($Respuesta);
    }catch(PDOException $e){
        echo "Error";
    }
}
?>