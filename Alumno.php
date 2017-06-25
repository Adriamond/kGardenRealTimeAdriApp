<?php

require 'Database.php';


class Alumno
{
    function _construct()
    {
    }

    public static function ObtenerTodasLasClases($idUser)
    {

        $consultar = "SELECT * FROM clase WHERE idProfesor = ?";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($idUser));

        $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $tabla;
    }


    public static function ObtenerTodosLosAlumnos($idUser)
    {
        $consultar = "SELECT * FROM alumno";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute(array($idUser));

        $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $tabla;

    }


    public static function ObtenerTodosLosAlumnosUsuario($idUser)
    {
        try {
            $consultar = "SELECT idAlumno, alumno.nombreApel, alumno.cumple, nombreClase  FROM alumno 
JOIN Usuarios ON (idUser = idFamilia) 
JOIN clase ON (alumno.idClase=clase.idClase) 
WHERE idUser = ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($idUser));

            $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $e) {
            return false;
        }
    }


    public static function ObtenerProfesorPorIdAlumno($idAlumno)
    {
        try {
            $consultar = "
        SELECT Usuarios.idUser, Usuarios.nombreApel, Usuarios.UserName, alumno.nombreApel from clase join alumno on (clase.idClase = alumno.idClase)
join Usuarios ON (clase.idProfesor = Usuarios.idUser) where alumno.idAlumno = ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($idAlumno));

            $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function ObtenerAlumnosPorClase($idClase)
    {
        try {
            $consultar = "Select Usuarios.idUser, Usuarios.UserName, alumno.nombreApel, alumno.cumple from Usuarios join 
alumno on (idFamilia = idUser) join clase on (alumno.idClase = clase.idClase) where clase.idClase =  ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($idClase));

            $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $e) {
            return false;
        }


    }

    public static function ObtenerTodasLasGuarderias()
    {
        $consultar = "SELECT * FROM guarderia";

        $resultado = Database::getInstance()->getDb()->prepare($consultar);

        $resultado->execute();

        $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $tabla;

    }

    public static function ObtenerClasesPorGuarde($nombreGuarderia)
    {
        try {
            $consultar = "SELECT guarderia.nombreGuarderia, clase.idClase, clase.nombreClase from clase join guarderia on (clase.idClaseGuarderia = guarderia.idGuarderia) where nombreGuarderia = ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($nombreGuarderia));

            $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function ObtenerIdClasePorNombre($nombreClase)
    {
        try {
            $consultar = "SELECT idClase from clase WHERE nombreClase = ?";

            $resultado = Database::getInstance()->getDb()->prepare($consultar);

            $resultado->execute(array($nombreClase));

            $tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);

            return $tabla;
        } catch (PDOException $e) {
            return false;
        }
    }
}
