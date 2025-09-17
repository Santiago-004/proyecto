<?php 
    include "modelo.php";

    $modelo = new modelo();
    $modelo->cn();
    $registros = [];
    $datosDueño = null;
    
    $pdo = new PDO("mysql:host=localhost;dbname=sghmac", "root", "Torres18");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['editar'])) {
            $id_usuario = $_SESSION['id_usuario'];

            $stmt = $pdo->prepare("SELECT * FROM dueño WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);

            if ($stmt->rowCount() > 0) {
                $datosDueño = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['confirmar'])) {
            $stmt = $pdo->prepare("UPDATE dueño SET 
                nombres = ?, 
                apellido_paterno = ?, 
                apellido_materno = ?, 
                telefono = ?, 
                correo = ?, 
                direccion = ?
                WHERE id_usuario = ?");

            $stmt->execute([
                $_POST['nombres'],
                $_POST['apellido_paterno'],
                $_POST['apellido_materno'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion'],
                $_SESSION["id_usuario"]  
            ]);

            $_SESSION['editado'] = true;
            $_SESSION['correo'] = $_POST['correo'];

            // header("Location: inicio.php?pagina=cuenta");
            // exit();
        }

        if (isset($_POST['confirmarRegistro'])) {
            $stmt = $pdo->prepare("INSERT INTO dueño (nombres, apellido_paterno, apellido_materno, telefono, correo, direccion, id_usuario)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['nombres'],
                $_POST['apellido_paterno'],
                $_POST['apellido_materno'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion'],
                $_SESSION["id_usuario"]
            ]);
            
            $_SESSION['creado'] = true;
            $_SESSION['correo'] = $_POST['correo'];

            // header("Location: inicio.php?pagina=cuenta");
            // exit();
        }
    }

    $registros = $modelo->buscar();

    include 'vista.php';
?>
