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
                "SELECT * FROM usuario WHERE nombre_usuario LIKE '".$_POST['txtbuscar']."%'"
            ) as $fila) {
                $registros[] = $fila;
            }
        } else {
            foreach ($this->mbd->query(
                "SELECT * FROM usuario"
            ) as $fila) {
                $registros[] = $fila;
            }
        }
        return $registros;
    }
}
?>

