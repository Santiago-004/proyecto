<?php

class modelo {                                        

    public  $mbd;
    public  $editar = ["id_dueño" => '', "nombres" => '', "apellido_paterno" => '', "apellido_materno" => '', "telefono" => '', "correo" => '', "direccion" => '', "id_usuario" => ''];

    function cn() {
        $this->mbd = new PDO('mysql:host=localhost;dbname=sghmac;port=3306', 'root', 'Torres18');
        $this->mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
 
    function buscar(){
        $registros = [];
        if (isset($_POST['btnbuscar'])) {
            foreach ($this->mbd->query(
                "SELECT * FROM dueño D
                    INNER JOIN usuario U ON D.id_usuario = U.id_usuario
                    WHERE CONCAT_WS(' ', D.nombres, D.apellido_paterno, D.apellido_materno) LIKE '%".$_POST['txtbuscar']."%'"
            ) as $fila) {
                $registros[] = $fila;
            }
        } else {
            foreach ($this->mbd->query(
                "SELECT * FROM dueño D
                    INNER JOIN usuario U ON D.id_usuario = U.id_usuario"
            ) as $fila) {
                $registros[] = $fila;
            }
        }
        return $registros;
    }

    function obtenerUsuario() {
        $usuarios = [];
        foreach ($this->mbd->query("SELECT * FROM usuario U
                                        WHERE NOT EXISTS (
                                        SELECT 1
                                        FROM dueño D
                                        WHERE D.id_usuario = U.id_usuario)
                                        AND rol != 'admin' AND rol != 'veterinario';") as $usuario) {
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    function obtenerUsuarioE($id) {
        $usuarioE = [];
        foreach ($this->mbd->query("SELECT * FROM usuario U
                                        WHERE id_usuario = ".$id) as $usuario) {
            $usuarioE[] = $usuario;
        }
        return $usuarioE;
    }
}
?>

