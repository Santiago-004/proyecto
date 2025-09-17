<?php 
include "modelo.php";
$modelo = new modelo();
$modelo->cn();

$registros = [];
$duenoanimales = $modelo->obtenerDuenoAnimal();
$animales = $modelo->obtenerAnimales();


$datosVacunacion = null;
$descripcion = null;

if (isset($_POST["txtbuscar"])){
    $txtbuscar = $_POST["txtbuscar"];
} else {
    $txtbuscar = "";
}

$pdo = new PDO("mysql:host=localhost;dbname=sghmac", "root", "Torres18");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['editar'])) {
        $id = $_POST['editar'];
        $stmt = $pdo->prepare("SELECT *, U.id_usuario AS idUsuario
                               FROM vacunacion V
                               LEFT JOIN dueño_animal DA ON V.id_dueñoanimal = DA.id_dueñoanimal
                               LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño
                               LEFT JOIN animal A ON A.id_animal = DA.id_animal
                               LEFT JOIN usuario U ON U.id_usuario = D.id_usuario 
                               WHERE id_vacunacion = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $datosVacunacion = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['eliminar'])) {
        $id = $_POST['eliminar'];
        $stmt = $pdo->prepare("SELECT *, U.id_usuario AS idUsuario
                               FROM vacunacion V
                               LEFT JOIN dueño_animal DA ON V.id_dueñoanimal = DA.id_dueñoanimal
                               LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño
                               LEFT JOIN animal A ON A.id_animal = DA.id_animal
                               LEFT JOIN usuario U ON U.id_usuario = D.id_usuario 
                               WHERE id_vacunacion = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $datosVacunacion = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['verdescripcion'])) {
        $id = $_POST['verdescripcion'];
        $stmt = $pdo->prepare("SELECT descripcion FROM vacunacion WHERE id_vacunacion = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $descripcion = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['vervacuna'])) {
        $id = $_POST['vervacuna'];
        $stmt = $pdo->prepare("SELECT nombre_vacuna FROM vacunacion WHERE id_vacunacion = ?");
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) {
            $vacuna = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $vacuna = null;
        }
    }

    if (isset($_POST['confirmarI'])) {
        $sql = "INSERT INTO vacunacion (id_dueñoanimal, nombre_vacuna, descripcion, fecha_aplicacion, fecha_proxima, id_animal)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['id_dueñoanimal'] ?: null,
            $_POST['nombre_vacuna'],
            $_POST['descripcion'],
            $_POST['fecha_aplicacion'],
            $_POST['fecha_proxima'] ?: null,
            $_POST['id_animal'] ?: null
        ]);

        
        $idDueñoAnimal = $_POST['id_dueñoanimal'] ?: null;

        if ($idDueñoAnimal) {
            $stmtUsuario = $pdo->prepare("
                SELECT U.id_usuario, A.nombre FROM dueño_animal DA
                INNER JOIN dueño D ON DA.id_dueño = D.id_dueño
                INNER JOIN usuario U ON D.id_usuario = U.id_usuario
                INNER JOIN animal A ON DA.id_animal = A.id_animal
                WHERE DA.id_dueñoanimal = ?
            ");
            $stmtUsuario->execute([$idDueñoAnimal]);
            $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

            if ($usuario && $_POST['fecha_proxima'] != NULL) {
                $fechaProxima = isset($_POST['fecha_proxima'])
                    ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_proxima'])
                    : null;

                if ($fechaProxima instanceof DateTime) {
                    $fechaSemana = (clone $fechaProxima)->modify('-7 days');
                    $fechaDia = (clone $fechaProxima)->modify('-1 days');

                    $fechaProximaStr = $fechaProxima->format('Y-m-d');
                    $fechaSemanaStr = $fechaSemana->format('Y-m-d');
                    $fechaDiaStr = $fechaDia->format('Y-m-d');
                }

                $nombre = $usuario['nombre'];
                $idUsuario = $usuario['id_usuario'];
                $fechaActual = new DateTime();

                $stmt2 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                                VALUES (?, ?, ?, NOW())");

                $titulo = "Nueva Vacunación de \"$nombre\" Programada";
                $mensaje = "Se programó una vacunación para \"$nombre\" para la fecha $fechaProximaStr.";
                        
                $stmt2->execute([$idUsuario, $titulo, $mensaje]);

                if ($fechaActual <= $fechaSemana) {
                    $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                                VALUES (?, ?, ?, ?)");

                    $titulo = "Faltan 7 Días para la Vacunación de \"$nombre\"";
                    $mensaje = "Faltan 7 días para la vacunación de \"$nombre\" programada para la fecha $fechaProximaStr.";

                    $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaSemanaStr]);
                }
                if ($fechaActual <= $fechaDia) {
                    $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                                VALUES (?, ?, ?, ?)");

                    $titulo = "Falta 1 Día para la Vacunación de \"$nombre\"";
                    $mensaje = "Falta 1 día para la vacunación de \"$nombre\" programada para la fecha $fechaProximaStr.";

                    $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaDiaStr]);
                }
            }
        }

        $_SESSION['guardado'] = true;
    }

    if (isset($_POST['confirmarU'])) {
        $sql = "UPDATE vacunacion SET
                    nombre_vacuna = ?,
                    descripcion = ?,
                    fecha_aplicacion = ?,
                    fecha_proxima = ?
                WHERE id_vacunacion = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['nombre_vacuna'],
            $_POST['descripcion'],
            $_POST['fecha_aplicacion'],
            $_POST['fecha_proxima'] ?: null,
            $_POST['id_vacunacion']
        ]);

        if($_POST['idUsuario'] != NULL && $_POST['fecha_proxima'] != NULL) {
            $fechaProxima = isset($_POST['fecha_proxima'])
                ? DateTime::createFromFormat('Y-m-d', $_POST['fecha_proxima'])
                : null;

            if ($fechaProxima instanceof DateTime) {
                $fechaSemana = (clone $fechaProxima)->modify('-7 days');
                $fechaDia = (clone $fechaProxima)->modify('-1 days');

                $fechaProximaStr = $fechaProxima->format('Y-m-d');
                $fechaSemanaStr = $fechaSemana->format('Y-m-d');
                $fechaDiaStr = $fechaDia->format('Y-m-d');
            }

            $nombre = $_POST['nombre'];
            $idUsuario = $_POST['idUsuario'];
            $fechaActual = new DateTime();

            if($_POST['fechaAnterior'] != NULL) {
                $fechaAnterior = isset($_POST['fechaAnterior'])
                    ? DateTime::createFromFormat('Y-m-d', $_POST['fechaAnterior'])
                    : null;
                
                if ($fechaAnterior instanceof DateTime) {
                    $fechaAnteriorStr = $fechaAnterior->format('Y-m-d');
                }

                $stmt = $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ? AND mensaje LIKE '%".$fechaAnteriorStr.".'");
                $stmt->execute([$idUsuario]);
            }

            $stmt2 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                            VALUES (?, ?, ?, NOW())");

            $titulo = "Nueva Vacunación de \"$nombre\" Programada";
            $mensaje = "Se programó una vacunación para \"$nombre\" para la fecha $fechaProximaStr.";
                    
            $stmt2->execute([$idUsuario, $titulo, $mensaje]);

            if ($fechaActual <= $fechaSemana) {
                $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                            VALUES (?, ?, ?, ?)");

                $titulo = "Faltan 7 Días para la Vacunación de \"$nombre\"";
                $mensaje = "Faltan 7 días para la vacunación de \"$nombre\" programada para la fecha $fechaProximaStr.";

                $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaSemanaStr]);
            }
            if ($fechaActual <= $fechaDia) {
                $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                            VALUES (?, ?, ?, ?)");

                $titulo = "Falta 1 Día para la Vacunación de \"$nombre\"";
                $mensaje = "Falta 1 día para la vacunación de \"$nombre\" programada para la fecha $fechaProximaStr.";

                $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaDiaStr]);
            }
        }

        $_SESSION['editado'] = true;
    }

    if (isset($_POST['confirmarD'])) {
        $id = $_POST['id_vacunacion'];
        
        $stmt = $pdo->prepare("DELETE FROM vacunacion WHERE id_vacunacion = ?");
        $stmt->execute([$id]);

        $_SESSION['eliminado'] = true;
    }
}

$registros = $modelo->buscar($txtbuscar);

include 'vista.php';
?>
