<?php
require 'Token.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
    try{
        $Respuesta = Token::ObtenerTodosLosToken();
        echo 'Perfe';
        echo json_encode($Respuesta);
    }catch(PDOException $e){
        echo "Error";
    }
}
?>