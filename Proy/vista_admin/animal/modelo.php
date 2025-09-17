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
                "SELECT * FROM animal WHERE especie LIKE '".$_POST['txtbuscar']."%'"
            ) as $fila) {
                $registros[] = $fila;
            }
        } else {
            foreach ($this->mbd->query(
                "SELECT * FROM animal"
            ) as $fila) {
                $registros[] = $fila;
            }
        }
        return $registros;
    }
}
?>

