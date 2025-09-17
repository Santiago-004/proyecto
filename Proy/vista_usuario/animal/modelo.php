<?php

class modelo {                                        

    public  $mbd;
    public  $editar = ["id_animal" => '', "nombre" => '', "especie" => '', "raza" => '', "fecha_nacimiento" => '', "sexo" => ''];

    function cn() {
        $this->mbd = new PDO('mysql:host=localhost;dbname=sghmac;port=3306', 'root', 'Torres18');
        $this->mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
 
    function buscar(){
        $registros = [];
        if (isset($_POST['btnbuscar'])) {
            foreach ($this->mbd->query(
                "WITH ultima_adopcion AS (
                    SELECT AD.*
                    FROM adopcion AD
                    INNER JOIN (
                        SELECT id_animal, MAX(fecha_solicitud) AS fecha_solicitud
                        FROM adopcion
                        GROUP BY id_animal
                    ) ult ON AD.id_animal = ult.id_animal AND AD.fecha_solicitud = ult.fecha_solicitud
                )

                SELECT A.id_animal AS id, A.*, AD.*, D.*
                FROM animal A
                LEFT JOIN ultima_adopcion AD ON A.id_animal = AD.id_animal
                LEFT JOIN dueño D ON D.id_dueño = AD.id_dueño
                WHERE A.con_dueño = 'N'
                AND (
                    AD.estado IS NULL
                    OR (AD.estado IN ('pendiente', 'cancelado') AND D.id_usuario = ".$_SESSION['id_usuario'].")
                    OR (AD.estado = 'cancelado' AND D.id_usuario != ".$_SESSION['id_usuario'].")
                ) AND especie LIKE '".$_POST['txtbuscar']."%'
                ORDER BY A.nombre ASC"
            ) as $fila) {
                $registros[] = $fila;
            }
        } else {
            foreach ($this->mbd->query(
                "WITH ultima_adopcion AS (
                    SELECT AD.*
                    FROM adopcion AD
                    INNER JOIN (
                        SELECT id_animal, MAX(fecha_solicitud) AS fecha_solicitud
                        FROM adopcion
                        GROUP BY id_animal
                    ) ult ON AD.id_animal = ult.id_animal AND AD.fecha_solicitud = ult.fecha_solicitud
                )

                SELECT A.id_animal AS id, A.*, AD.*, D.*
                FROM animal A
                LEFT JOIN ultima_adopcion AD ON A.id_animal = AD.id_animal
                LEFT JOIN dueño D ON D.id_dueño = AD.id_dueño
                WHERE A.con_dueño = 'N'
                AND (
                    AD.estado IS NULL
                    OR (AD.estado IN ('pendiente', 'cancelado') AND D.id_usuario = ".$_SESSION['id_usuario'].")
                    OR (AD.estado = 'cancelado' AND D.id_usuario != ".$_SESSION['id_usuario'].")
                )
                ORDER BY A.nombre ASC"
            ) as $fila) {
                $registros[] = $fila;
            }
        }
        return $registros;
    }

    function buscarVacunaciones($id_animal) {
        $vacunaciones = [];
        foreach ($this->mbd->query("SELECT * FROM vacunacion WHERE id_animal = $id_animal
                                        UNION
                                    SELECT V.* FROM vacunacion V
                                        INNER JOIN dueño_animal DA ON DA.id_dueñoanimal = V.id_dueñoanimal
                                        WHERE DA.id_animal = $id_animal
                                        ORDER BY fecha_aplicacion DESC") as $vacunacion) { 
            $vacunaciones[] = $vacunacion;
        }
        return $vacunaciones;
    }
    
    function buscarConsultas($id_animal) {
        $consultas = [];
        foreach ($this->mbd->query("SELECT * FROM consulta WHERE id_animal = $id_animal
                                        UNION
                                    SELECT C.* FROM consulta C
                                        INNER JOIN dueño_animal DA ON DA.id_dueñoanimal = C.id_dueñoanimal
                                        WHERE DA.id_animal = $id_animal
                                        ORDER BY fecha DESC") as $consulta) { 
            $consultas[] = $consulta;
        }
        return $consultas;
    }

    function buscarProcedimientos($id_animal) {
        $procedimientos = [];
        foreach ($this->mbd->query("SELECT * FROM procedimiento WHERE id_animal = $id_animal
                                        UNION
                                    SELECT P.* FROM procedimiento P
                                        INNER JOIN dueño_animal DA ON DA.id_dueñoanimal = P.id_dueñoanimal
                                        WHERE DA.id_animal = $id_animal
                                        ORDER BY fecha DESC") as $procedimiento) { 
            $procedimientos[] = $procedimiento;
        }
        return $procedimientos;
    }
}
?>

