<?php 
    include "modelo.php";
    $modelo = new modelo();
    $modelo->cn();
    $registros = [];
    $datosAnimal = null;

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
            $stmt = $pdo->prepare("SELECT * FROM animal WHERE id_animal = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $datosAnimal = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['confirmarI'])) {
            if($_POST['vivo'] == 'N') {
                $stmt = $pdo->prepare("INSERT INTO animal (nombre, especie, raza, fecha_nacimiento, sexo, vivo, causa_muerte, fecha_muerte) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['especie'],
                    $_POST['raza'],
                    $_POST['fecha_nacimiento'],
                    $_POST['sexo'],
                    $_POST['vivo'],
                    $_POST['causa_muerte'],
                    $_POST['fecha_muerte']
                ]);
            } else if($_POST['vivo'] == 'S') {
                $stmt = $pdo->prepare("INSERT INTO animal (nombre, especie, raza, fecha_nacimiento, sexo, vivo) 
                                        VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['especie'],
                    $_POST['raza'],
                    $_POST['fecha_nacimiento'],
                    $_POST['sexo'],
                    $_POST['vivo']
                ]);
            }

            $_SESSION['guardado'] = true;
        }

        if (isset($_POST['confirmarU'])) {
            $id_animal = $_POST['id_animal'];
            
            if($_POST['vivo'] == 'N') {
                $stmt = $pdo->prepare("UPDATE animal SET 
                    nombre = ?, 
                    especie = ?, 
                    raza = ?, 
                    fecha_nacimiento = ?, 
                    sexo = ?, 
                    vivo = ?,
                    causa_muerte = ?,
                    fecha_muerte = ?
                    WHERE id_animal = ?");

                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['especie'],
                    $_POST['raza'],
                    $_POST['fecha_nacimiento'],
                    $_POST['sexo'],
                    $_POST['vivo'],
                    $_POST['causa_muerte'],
                    $_POST['fecha_muerte'],
                    $id_animal
                ]);
            } else if($_POST['vivo'] == 'S') {
                $stmt = $pdo->prepare("UPDATE animal SET 
                    nombre = ?, 
                    especie = ?, 
                    raza = ?, 
                    fecha_nacimiento = ?, 
                    sexo = ?, 
                    vivo = ?
                    WHERE id_animal = ?");

                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['especie'],
                    $_POST['raza'],
                    $_POST['fecha_nacimiento'],
                    $_POST['sexo'],
                    $_POST['vivo'],
                    $id_animal
                ]);
            }

            $_SESSION['editado'] = true;
        }

        if (isset($_POST['confirmarD'])) {
            $id = $_POST['id_animal'];

            $stmt = $pdo->prepare("SELECT id_dueñoanimal FROM dueño_animal WHERE id_animal = ?");
            $stmt->execute([$id]);
            $dueños = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            foreach ($dueños as $idDueñoAnimal) {
                $pdo->prepare("DELETE FROM devolucion WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM consulta WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM procedimiento WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
                $pdo->prepare("DELETE FROM vacunacion WHERE id_dueñoanimal = ?")->execute([$idDueñoAnimal]);
            }

            $pdo->prepare("DELETE FROM adopcion WHERE id_animal = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM consulta WHERE id_animal = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM procedimiento WHERE id_animal = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM vacunacion WHERE id_animal = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM dueño_animal WHERE id_animal = ?")->execute([$id]);
            $pdo->prepare("DELETE FROM animal WHERE id_animal = ?")->execute([$id]);
            
            $_SESSION['eliminado'] = true;
        }
    }

    $registros = $modelo->buscar();
    include 'vista.php';
?>
