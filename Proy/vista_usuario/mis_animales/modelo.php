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
                "SELECT * FROM dueño D
                        INNER JOIN dueño_animal DA ON  DA.id_dueño = D.id_dueño
                        INNER JOIN animal A ON  A.id_animal = DA.id_animal
                        WHERE D.id_usuario = ".$_SESSION['id_usuario']." AND nombre LIKE '".$_POST['txtbuscar']."%'
                        AND fecha_devolucion IS NULL
                        ORDER BY nombre ASC"
            ) as $fila) {
                $registros[] = $fila;
            }
        } else {
            foreach ($this->mbd->query(
                "SELECT * FROM dueño D
                        INNER JOIN dueño_animal DA ON  DA.id_dueño = D.id_dueño
                        INNER JOIN animal A ON  A.id_animal = DA.id_animal
                        WHERE D.id_usuario = ".$_SESSION['id_usuario']."
                        AND fecha_devolucion IS NULL
                        ORDER BY nombre ASC"
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

    function existeDevolucion($id_dueñoanimal) {
        $stmt = $this->mbd->prepare("SELECT 1 FROM devolucion WHERE id_dueñoanimal = ?");
        $stmt->execute([$id_dueñoanimal]);
        return $stmt->fetch() !== false;
    }

    function buscarDevolucion($id_dueñoanimal) {
        $estados = [];
        foreach ($this->mbd->query("SELECT estado, id_dueñoanimal FROM devolucion WHERE id_dueñoanimal = $id_dueñoanimal
                                        ORDER BY fecha_solicitud DESC LIMIT 1;") as $estado) { 
            $estados[] = $estado;
        }
        return $estados;
    }
}
?>

