<?php 
    include "modelo.php";

    $modelo = new modelo();
    $modelo->cn();
    $devoluciones = [];
    $usuarios = [];
    $animales = [];
   
    if (isset($_POST['usuario'])) {
        $usuarios = $modelo->buscarUsuario($_POST['usuario']);
    }
    if (isset($_POST['animal'])) {
        $animales = $modelo->buscarAnimal($_POST['animal']);
    }
    if (isset($_POST['confirmado']) && isset($_POST['idAnimal']) && isset($_POST['idDueñoAnimal']) && isset($_POST['idUsuario']) && isset($_POST['nombreA'])) {
        $modelo->confirmarDevolucion($_POST['confirmado'], $_POST['idAnimal'], $_POST['idDueñoAnimal'], $_POST['idUsuario'], $_POST['nombreA']);
    }
    if (isset($_POST['cancelado']) && isset($_POST['idUsuario']) && isset($_POST['nombreA'])) {
        $modelo->cancelarDevolucion($_POST['cancelado'], $_POST['idUsuario'], $_POST['nombreA']);
    }

   
    $registros = $modelo->buscarDevoluciones();

    include 'vista.php';
?>
