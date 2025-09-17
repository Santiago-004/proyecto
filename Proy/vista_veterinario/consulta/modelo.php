<?php

class modelo {                                        

    public  $mbd;
    
    function cn() {
        $this->mbd = new PDO('mysql:host=localhost;dbname=sghmac;port=3306', 'root', 'Torres18');
        $this->mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
 
    function buscar(){
        $registros = [];
        if (isset($_POST['btnbuscar'])) {
            foreach ($this->mbd->query(
                    "SELECT *, C.fecha AS fecha_consulta FROM consulta C
                        INNER JOIN dueño_animal DA ON C.id_dueñoanimal = DA.id_dueñoanimal
                        INNER JOIN dueño D ON D.id_dueño = DA.id_dueño
                        INNER JOIN animal A ON A.id_animal = DA.id_animal
                        WHERE A.nombre LIKE '".$_POST['txtbuscar']."%'
                    UNION
                    SELECT *, C.fecha AS fecha_consulta FROM consulta C
                        LEFT JOIN dueño_animal DA ON C.id_dueñoanimal = DA.id_dueñoanimal
                        LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño
                        INNER JOIN animal A ON A.id_animal = C.id_animal
                            WHERE A.nombre LIKE '".$_POST['txtbuscar']."%'"
            ) as $fila) {
                $registros[] = $fila;
            }
        } else {
            foreach ($this->mbd->query(
                "SELECT *, C.fecha AS fecha_consulta FROM consulta C
                    INNER JOIN dueño_animal DA ON C.id_dueñoanimal = DA.id_dueñoanimal
                    INNER JOIN dueño D ON D.id_dueño = DA.id_dueño
                    INNER JOIN animal A ON A.id_animal = DA.id_animal
                UNION
                SELECT *, C.fecha AS fecha_consulta FROM consulta C
                        LEFT JOIN dueño_animal DA ON C.id_dueñoanimal = DA.id_dueñoanimal
                        LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño
                        INNER JOIN animal A ON A.id_animal = C.id_animal"
            ) as $fila) {
                $registros[] = $fila;
            }
        }
        return $registros;
    }

    function obtenerDuenoAnimal() {
        $duenoanimales = [];
        foreach ($this->mbd->query("SELECT DA.id_dueñoanimal, D.nombres, D.apellido_paterno, D.apellido_materno, A.nombre
                                    FROM dueño_animal DA
                                    INNER JOIN (
                                        SELECT MAX(id_dueñoanimal) AS ultimo_id
                                        FROM dueño_animal
                                        GROUP BY id_animal
                                    ) ultimos ON ultimos.ultimo_id = DA.id_dueñoanimal
                                    INNER JOIN dueño D ON D.id_dueño = DA.id_dueño
                                    INNER JOIN animal A ON A.id_animal = DA.id_animal
                                    WHERE con_dueño = 'S'") as $duenoanimal) {
            $duenoanimales[] = $duenoanimal;
        }
        return $duenoanimales;
    }

    function obtenerAnimal() {
        $animales = [];
        foreach ($this->mbd->query("SELECT * FROM animal A
                                    WHERE con_dueño = 'N'") as $animal) {
            $animales[] = $animal;
        }
        return $animales;
    }
}
?>

