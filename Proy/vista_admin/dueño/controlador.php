<?php 
    include "modelo.php";
    $modelo = new modelo();
    $modelo->cn();
    $registros = [];
    $datosDueño = null;
    $usuarios = $modelo->obtenerUsuario();
    $usuarioE = [];


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
            $stmt = $pdo->prepare("SELECT * FROM dueño WHERE id_dueño = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $datosDueño = $stmt->fetch(PDO::FETCH_ASSOC);
                
            }
            $modelo->obtenerUsuarioE($datosDueño['id_usuario']);
        }

        if (isset($_POST['confirmarI'])) {
            $stmt = $pdo->prepare("INSERT INTO dueño (nombres, apellido_paterno, apellido_materno, telefono, correo, direccion, id_usuario) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['nombres'],
                $_POST['apellido_paterno'],
                $_POST['apellido_materno'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion'],
                $_POST['id_usuario']
            ]);

            $_SESSION['guardado'] = true;
        }

        if (isset($_POST['confirmarU'])) {
            $id_dueño = $_POST['id_dueño'];
            
            $stmt = $pdo->prepare("UPDATE dueño SET 
                nombres = ?, 
                apellido_paterno = ?, 
                apellido_materno = ?, 
                telefono = ?, 
                correo = ?, 
                direccion = ?
                WHERE id_dueño = ?");

            $stmt->execute([
                $_POST['nombres'],
                $_POST['apellido_paterno'],
                $_POST['apellido_materno'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion'],
                $id_dueño
            ]);

            $_SESSION['editado'] = true;
        }

        if (isset($_POST['confirmarD'])) {
            $id = $_POST['id_dueño'];

            $stmt = $pdo->prepare("SELECT DA.id_dueñoanimal, DA.id_animal, D.id_usuario FROM dueño_animal DA
                                    INNER JOIN dueño D ON DA.id_dueño = D.id_dueño WHERE D.id_dueño = ?");
            $stmt->execute([$id]);
            $dueñosAnimales = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dueñosAnimales as $da) {
                $idDueñoAnimal = $da['id_dueñoanimal'];
                $idUsuario = $da['id_usuario'];
                $idAnimal = $da['id_animal'];

                $pdo->prepare("DELETE FROM devolucion WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM consulta WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM procedimiento WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM vacunacion WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ?")->execute([$idUsuario]);

                $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM dueño_animal WHERE id_animal = ? AND id_dueñoanimal > ?");
                $stmt2->execute([$idAnimal, $idDueñoAnimal]);
                $conteo = $stmt2->fetchColumn();

                if ($conteo == 0) {
                    $pdo->prepare("UPDATE animal SET con_dueño = 'N' WHERE id_animal = ?")->execute([$idAnimal]);
                }

                $pdo->prepare("DELETE FROM dueño_animal WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
            }

            $pdo->prepare("DELETE FROM adopcion WHERE id_dueño = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM dueño WHERE id_dueño = ?")->execute([$id]);
            
            
            $_SESSION['eliminado'] = true;
        }
    }

    $registros = $modelo->buscar();
    include 'vista.php';
?>
