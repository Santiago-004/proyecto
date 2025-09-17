<style>
    #btnbuscar {
        background-image: url('/img/buscar.png');
        background-size:cover ; 
        color: transparent;
        width: 20px; 
        height: 20px; 
        border: none; 
        cursor: pointer; 
    }
    img {
        background-size:cover ; 
        color: transparent;
        width: 20px; 
        height: 20px; 
        border: none; 
        cursor: pointer; 
    }
</style>

<?php 
    include "modelo.php";

    $modelo = new modelo();
    $modelo->cn();
    $notificaciones = [];
    
    if (isset($_POST["txtbuscar"])){
        $txtbuscar = $_POST["txtbuscar"];
    }    
    else {
        $txtbuscar ="";
    }

    $registros = $modelo->buscar();

    include 'vista.php';
?>
