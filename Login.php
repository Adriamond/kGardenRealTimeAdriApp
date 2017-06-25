<?php

require 'Database.php';


class Registro
{
    function _construct()
    {
    }

    public static function ObtenerTodosLosUsuarios()
    {
        $consultar = "SELECT * FROM Usuarios";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute();

        $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $tabla;

    }

    public static function ObtenerDatosPorNombre($userName)
    {
        $consultar = "SELECT * FROM Usuarios WHERE UserName = ?";
        //$consultar = "SELECT idUser ,UserName, UserPassword FROM Usuarios WHERE idUser = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($userName));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }
    public static function ObtenerDatosPorNombrePass($userName, $userPassword)
    {
        $consultar = "SELECT * FROM Usuarios WHERE UserName = ? AND UserPassword = ?";
        //$consultar = "SELECT idUser ,UserName, UserPassword FROM Usuarios WHERE idUser = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($userName, $userPassword));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }



    public static function ObtenerDatosPorId($idUser)
    {
        $consultar = "SELECT * FROM Usuarios WHERE $idUser = ?";
        //$consultar = "SELECT idUser ,UserName, UserPassword FROM Usuarios WHERE idUser = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($idUser));

        $tabla = $resultado->fetch(PDO::FETCH_ASSOC);

        return $tabla;

    }


    public static function InsertarNuevoDato($UserName, $UserPassword, $nombreApel, $email, $cumple, $telefono, $tipoUsu)
    {
        $consulta = "INSERT INTO Usuarios(UserName , UserPassword, nombreApel, email, cumple, telefono, tipoUsu) VALUES(?,?,?,?,?,?,?)";

        try {
            $resultado = Database::getInstance()->getDb()->prepare($consulta);
            return $resultado->execute(array($UserName, $UserPassword, $nombreApel, $email, $cumple, $telefono, $tipoUsu));
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'email') !== false)
                return "23";
            elseif ($e->getCode() == "23000") {
                return "23000";
            }
        }
    }
    public static function InsertarNuevoAlumno($idFamilia, $UidClase, $nombreApel, $cumple)
    {
        $consulta = "INSERT INTO alumno(idFamilia , idClase, nombreApel, cumple) VALUES(?,?,?,?)";

        try {
            $resultado = Database::getInstance()->getDb()->prepare($consulta);
            return $resultado->execute(array($idFamilia, $UidClase, $nombreApel, $cumple));
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'email') !== false)
                return "23";
            elseif ($e->getCode() == "23000") {
                return "23000";
            }
        }
    }

    public static function UpdateDatos($UserPassword, $idUser, $OldUserPassword)
    {

        if (self::ObtenerDatosPorId($idUser)) {
            try {
                $consultar = "UPDATE Usuarios SET UserPassword = ? WHERE idUser = ? AND UserPassword = ?";
                $resultado = Database::getInstance()->getDb()->prepare($consultar);
                return $resultado->execute(array($UserPassword, $idUser, $OldUserPassword));
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }

    }
}

?>