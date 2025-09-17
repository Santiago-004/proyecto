<?php 
    include "modelo.php";
    $modelo = new modelo();
    $modelo->cn();
    $registros = [];
    $datosUsuario = null;

    if (isset($_POST["txtbuscar"])) {
        $txtbuscar = $_POST["txtbuscar"];
    } else {
        $txtbuscar = "";
    }

    $pdo = new PDO("mysql:host=localhost;dbname=sghmac", "root", "Torres18");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['editar'])) {
            $id = $_POST['editar'];
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $datosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['confirmarI'])) {
            $stmt = $pdo->prepare("INSERT INTO usuario (nombre_usuario, contraseña, rol) 
                                        VALUES (?, ?, ?)");
            $stmt->execute([
                $_POST['nombre_usuario'],
                $_POST['contraseña'],
                $_POST['rol']
            ]);

            $_SESSION['guardado'] = true;
        }

        if (isset($_POST['confirmarU'])) {
            $id_usuario = $_POST['id_usuario'];
        
            $stmt = $pdo->prepare("UPDATE usuario SET 
                nombre_usuario = ?, 
                contraseña = ?, 
                rol = ?
                WHERE id_usuario = ?");

            $stmt->execute([
                $_POST['nombre_usuario'],
                $_POST['contraseña'],
                $_POST['rol'],
                $id_usuario
            ]);

            $_SESSION['editado'] = true;
        }

        if (isset($_POST['confirmarD'])) {
            $id = $_POST['id_usuario'];

            $stmt = $pdo->prepare("SELECT id_dueño FROM dueño WHERE id_usuario = ?");
            $stmt->execute([$id]);
            $dueños = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $stmt2 = $pdo->prepare("SELECT DA.id_dueñoanimal, DA.id_animal, DA.id_dueño 
                                    FROM dueño_animal DA
                                    INNER JOIN dueño D ON DA.id_dueño = D.id_dueño 
                                    WHERE D.id_usuario = ?");
            $stmt2->execute([$id]);
            $dueñosA = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dueñosA as $registro) {
                $idDueñoAnimal = $registro['id_dueñoanimal'];
                $idDueño = $registro['id_dueño'];
                $idAnimal = $registro['id_animal'];

                $pdo->prepare("DELETE FROM devolucion WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM consulta WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM procedimiento WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM vacunacion WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $stmt3 = $pdo->prepare("SELECT COUNT(*) FROM dueño_animal WHERE id_animal = ? AND id_dueñoanimal > ?");
                $stmt3->execute([$idAnimal, $idDueñoAnimal]);
                $conteo = $stmt3->fetchColumn();

                if ($conteo == 0) {
                    $pdo->prepare("UPDATE animal SET con_dueño = 'N' WHERE id_animal = ?")->execute([$idAnimal]);
                }

                $pdo->prepare("DELETE FROM dueño_animal WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
            }

            foreach ($dueños as $idDueño) {
                $pdo->prepare("DELETE FROM adopcion WHERE id_dueño = ?")->execute([$idDueño]);
                $pdo->prepare("DELETE FROM dueño WHERE id_dueño = ?")->execute([$idDueño]);
            }

            $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM usuario WHERE id_usuario = ?")->execute([$id]);
            
            $_SESSION['eliminado'] = true;
        }
    }

    $registros = $modelo->buscar();
    include 'vista.php';
?>
