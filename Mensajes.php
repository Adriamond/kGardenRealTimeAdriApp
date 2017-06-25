<?php

require 'Database.php';

class Mensajes
{

    function construct()
    {
    }

    public static function CreateTable($NameTable)
    {
        try {
            $consultar = "CREATE TABLE $NameTable (id VARCHAR (50) PRIMARY KEY ,
      mensaje VARCHAR(500) NOT NULL,
      tipo_mensaje VARCHAR (10) NOT NULL,
      hora_del_mensaje TIMESTAMP NOT NULL,
      receptor VARCHAR(50))";

            $respuesta = Database::getInstance()->getDb()->prepare($consultar);
            $respuesta->execute(array());
            return 200;

        } catch (PDOException $exception) {
            return -1;
        }

    }


    public static function ObtenerDatosPorNombreUser($UserName)
    {
        try {

            $consultar = "SELECT * FROM tokenTable JOIN Usuarios ON(tokenTable.idUserToken = Usuarios.idUser) WHERE UserName = ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($UserName));

            $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $exception) {
            return -1;
        }
    }

    public static function EnviarMensaje($NameTable, $id, $mensaje, $tipo_mensaje, $hora_del_mensaje, $receptor)
    {
        try {
            $consultar = "INSERT INTO  $NameTable (id , mensaje, tipo_mensaje, hora_del_mensaje, receptor) VALUES (?,?,?,?,?)";
            $respuesta = Database::getInstance()->getDb()->prepare($consultar);
            $respuesta->execute(array($id, $mensaje, $tipo_mensaje, $hora_del_mensaje, $receptor));


            return 200;
        } catch (PDOException $exception) {
            return -1;
        }
    }

    public static function getTokenUser($idUserToken)
    {
        $consultar = "SELECT * FROM tokenTable WHERE idUserToken = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($idUserToken));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }

    public static function EnviarNotificacion($mensaje, $hora, $token, $emisor)
    {
        ignore_user_abort();
        ob_start();
        $url = 'https://fcm.googleapis.com/fcm/send';

        //$token = 'eqdGaPHh0Ks:APA91bEa8k6cvMX_5KzJ4VJdNQkpTDIPXOkeKAlVl1BwwLbRJ4jpr5Tgx1ffvnYQgqZ0Pyn7bnPMa3TIoGGNyUvXZrDYFYNEXTu5gC6tZE26jM9TlBbixW6upRoS2KTawKfIzmaRWiAe';


        $fields = array('to' => $token,
            'data' => array('mensaje' => $mensaje, 'hora' => $hora, 'cabecera' => $emisor_mensaje));

        define('GOOGLE_API_KEY', 'AIzaSyCN4usOxd_J967LpUI6HlF083peto1TqBE');

        $headers = array(
            'Authorization:key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === false)
            die('Curl failed ' . curl_error());
        curl_close($ch);
        return $result;
    }

    public static function ObtenerTodosLosMensajes($tableName, $receptor)
    {
        try {
            $consultar = "SELECT * from $tableName WHERE receptor = ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($receptor));

            $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $e) {
            return false;
        }

    }
}

?>