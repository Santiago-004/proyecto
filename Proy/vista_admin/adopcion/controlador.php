<?php 
    include "modelo.php";

    $modelo = new modelo();
    $modelo->cn();
    $usuarios = [];
    $animales = [];
    
    if (isset($_POST['usuario'])) {
        $usuarios = $modelo->buscarUsuario($_POST['usuario']);
    }
    if (isset($_POST['animal'])) {
        $animales = $modelo->buscarAnimal($_POST['animal']);
    }
    if (isset($_POST['confirmado']) && isset($_POST['idDueño']) && isset($_POST['idAnimal']) && isset($_POST['idUsuario']) && isset($_POST['nombreA'])) {
        $modelo->confirmarAdopcion($_POST['confirmado'], $_POST['idDueño'], $_POST['idAnimal'], $_POST['idUsuario'], $_POST['nombreA']);
    }
    if (isset($_POST['cancelado']) && isset($_POST['idUsuario']) && isset($_POST['nombreA'])) {
        $modelo->cancelarAdopcion($_POST['cancelado'], $_POST['idUsuario'], $_POST['nombreA']);
    }

    $registros = $modelo->buscar();

    include 'vista.php';
?>
