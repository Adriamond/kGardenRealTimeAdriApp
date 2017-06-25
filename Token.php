<?php

require 'Database.php';


class Token
{
    function _construct()
    {
    }

    public static function ObtenerTodosLosToken()
    {
        $consultar = "SELECT * FROM tokenTable";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute();

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }

    public static function ObtenerDatosPorNombre($token)
    {
        $consultar = "SELECT * FROM tokenTable WHERE Token = ?";
        //$consultar = "SELECT idUser ,UserName, UserPassword FROM Usuarios WHERE idUser = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($token));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }

    public static function ObtenerDatosPorIdToken($idToken)
    {
        $consultar = "SELECT * FROM tokenTable WHERE idToken = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($idToken));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }


    public static function ObtenerDatosPorIdUser($idUserToken)
    {
        $consultar = "SELECT * FROM tokenTable WHERE idUserToken = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($idUserToken));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }


    public static function InsertarNuevoToken($idUserToken, $token)
    {
        $consulta = "INSERT INTO tokenTable(idUserToken, token) VALUES(?,?)";

        try {
            $resultado = Database::getInstance()->getDb()->prepare($consulta);
            return $resultado->execute(array($idUserToken, $token));
        } catch (PDOException $e) {
            return false;
        }
    }


    public static function UpdateDatos($token, $idUserToken)
    {
            try {
                $consultar = "UPDATE tokenTable SET token = ? WHERE idUserToken = ?";
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($token, $idUserToken));
            } catch (PDOException $e) {
                return false;
            }
        }
}

?>