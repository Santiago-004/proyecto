<?php

class modelo {                                        

    public  $mbd;
    
    function cn() {
        $this->mbd = new PDO('mysql:host=localhost;dbname=sghmac;port=3306', 'root', 'Torres18');
        $this->mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
 
    function buscar(){
        $registros = [];
        foreach ($this->mbd->query(
                "SELECT *, AD.id_dueño AS idD, AD.id_animal AS idA, U.id_usuario AS idU FROM adopcion AD
                    INNER JOIN animal A ON A.id_animal = AD.id_animal
                    INNER JOIN dueño D ON D.id_dueño = AD.id_dueño
                    INNER JOIN usuario U ON D.id_usuario = U.id_usuario
                    ORDER BY fecha_solicitud DESC"
            ) as $fila) {
                $registros[] = $fila;
            }
        return $registros;
    }

    function buscarUsuario($id_dueño) {
        $usuarios = [];
        foreach ($this->mbd->query("SELECT * FROM dueño D
                                        INNER JOIN usuario U ON U.id_usuario = D.id_usuario
                                        WHERE D.id_dueño = $id_dueño") as $usuario) { 
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    function buscarAnimal($id_animal) {
        $animales = [];
        foreach ($this->mbd->query("SELECT * FROM animal WHERE id_animal = $id_animal") as $animal) { 
            $animales[] = $animal;
        }
        return $animales;
    }

    function confirmarAdopcion($id_adopcion, $id_dueño, $id_animal, $id_usuario, $nombre) {
        $sql = "UPDATE adopcion SET estado = 'confirmado', fecha_adopcion = NOW() WHERE id_adopcion = ?";
        $stmt = $this->mbd->prepare($sql);
        $stmt->execute([$id_adopcion]);

        $sql2 = "UPDATE animal 
                SET con_dueño = 'S'
                WHERE id_animal = ?";
        $stmt2 = $this->mbd->prepare($sql2);
        $stmt2->execute([$id_animal]);

        $sql3 = "INSERT INTO dueño_animal (fecha, id_dueño, id_animal) VALUES (NOW(), ?, ?)";
        $stmt3 = $this->mbd->prepare($sql3);
        $stmt3->execute([$id_dueño, $id_animal]);

        $sql4 = "INSERT INTO notificacion (id_usuario, titulo, mensaje) 
                    VALUES (?, 'Confirmación de Adopción de $nombre', 
                            'Su solicitud para la adopción de $nombre ha sido confirmada.')";
        $stmt4 = $this->mbd->prepare($sql4);
        $stmt4->execute([$id_usuario]);
    }

    function cancelarAdopcion($id_adopcion, $id_usuario, $nombre) {
        $sql = "UPDATE adopcion SET estado = 'cancelado' WHERE id_adopcion = ?";
        $stmt = $this->mbd->prepare($sql);
        $stmt->execute([$id_adopcion]);

        $sql2 = "INSERT INTO notificacion (id_usuario, titulo, mensaje) 
                    VALUES (?, 'Rechazo de Solicitud de Adopción de $nombre', 
                            'Su solicitud para la adopción de $nombre ha sido rechazada.')";
        $stmt2 = $this->mbd->prepare($sql2);
        $stmt2->execute([$id_usuario]);
    }
}
?>

