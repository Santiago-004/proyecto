<?php

class modelo {

    public $mbd;

    function cn() {
        $this->mbd = new PDO('mysql:host=localhost;dbname=sghmac;port=3306', 'root', 'Torres18');
        $this->mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    
function buscarDevoluciones() {
    $registros = [];
    foreach ($this->mbd->query(
        "SELECT *, DA.id_dueño AS idD, U.id_usuario AS idU, DA.id_animal AS idA, DV.id_dueñoanimal AS idDA,
                CONCAT(D.nombres, ' ', D.apellido_paterno, ' ', IFNULL(D.apellido_materno, '')) AS nombre_dueño,
                A.nombre AS nombre_animal
            FROM devolucion DV
            INNER JOIN dueño_animal DA ON DA.id_dueñoanimal = DV.id_dueñoanimal
            INNER JOIN dueño D ON D.id_dueño = DA.id_dueño
            INNER JOIN animal A ON A.id_animal = DA.id_animal
            INNER JOIN usuario U ON D.id_usuario = U.id_usuario
            ORDER BY DV.fecha_solicitud DESC"
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


    function confirmarDevolucion($id_devolucion, $id_animal, $id_dueñoanimal, $id_usuario, $nombre) {
        $sql = "UPDATE devolucion SET estado = 'confirmado', fecha_devolucion = NOW() WHERE id_devolucion = ?";
        $stmt = $this->mbd->prepare($sql);
        $stmt->execute([$id_devolucion]);
        
        $sql2 = "UPDATE animal SET con_dueño = 'N' WHERE id_animal = ?";
        $stmt2 = $this->mbd->prepare($sql2);
        $stmt2->execute([$id_animal]);

        $sql3 = "UPDATE dueño_animal SET fecha_devolucion = (SELECT fecha_devolucion FROM devolucion WHERE id_devolucion = ?) WHERE id_dueñoanimal = ?";
        $stmt3 = $this->mbd->prepare($sql3);
        $stmt3->execute([$id_devolucion, $id_dueñoanimal]);

        $sql4 = "INSERT INTO notificacion (id_usuario, titulo, mensaje)
                 VALUES (?, 'Confirmación de Devolución de $nombre',
                            'Su solicitud para la devolución de $nombre ha sido confirmada.')";
        $stmt4 = $this->mbd->prepare($sql4);
        $stmt4->execute([$id_usuario]);
    }

    function cancelarDevolucion($id_devolucion, $id_usuario, $nombre) {
        $sql = "UPDATE devolucion SET estado = 'cancelado' WHERE id_devolucion = ?";
        $stmt = $this->mbd->prepare($sql);
        $stmt->execute([$id_devolucion]);

        $sql2 = "INSERT INTO notificacion (id_usuario, titulo, mensaje)
                 VALUES (?, 'Cancelación de Devolución de $nombre',
                            'Su solicitud para la devolución de $nombre ha sido cancelada.')";
        $stmt2 = $this->mbd->prepare($sql2);
        $stmt2->execute([$id_usuario]);
    }
}
?>
