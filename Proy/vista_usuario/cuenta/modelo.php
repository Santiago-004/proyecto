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
                "SELECT * FROM dueño D
                    INNER JOIN usuario U ON U.id_usuario = D.id_usuario
                    WHERE D.id_usuario = ".$_SESSION['id_usuario']
            ) as $fila) {
                $registros[] = $fila;
            }
        return $registros;
    }
}
?>

