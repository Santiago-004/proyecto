<?php 
include "modelo.php";
$modelo = new modelo();
$modelo->cn();

$registros = [];
$duenoanimales = $modelo->obtenerDuenoAnimal();
$animales = $modelo->obtenerAnimal();
$datosProcedimiento = null;
$tipo = null;
$notas = null;

if (isset($_POST["txtbuscar"])){
    $txtbuscar = $_POST["txtbuscar"];
} else {
    $txtbuscar ="";
}

$pdo = new PDO("mysql:host=localhost;dbname=sghmac", "root", "Torres18");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['editar'])) {
        $id = $_POST['editar'];
        $stmt = $pdo->prepare("SELECT *, U.id_usuario AS idUsuario, P.fecha AS fechaProced FROM procedimiento P
            LEFT JOIN dueño_animal DA ON P.id_dueñoanimal = DA.id_dueñoanimal 
            LEFT JOIN animal A ON A.id_animal = DA.id_animal 
            LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño 
            LEFT JOIN usuario U ON U.id_usuario = D.id_usuario 
            WHERE id_procedimiento = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $datosProcedimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['eliminar'])) {
        $id = $_POST['eliminar'];
        $stmt = $pdo->prepare("SELECT *, U.id_usuario AS idUsuario FROM procedimiento P
            LEFT JOIN dueño_animal DA ON P.id_dueñoanimal = DA.id_dueñoanimal 
            LEFT JOIN animal A ON A.id_animal = DA.id_animal 
            LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño 
            LEFT JOIN usuario U ON U.id_usuario = D.id_usuario 
            WHERE id_procedimiento = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $datosProcedimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['vertipo'])) {
        $id = $_POST['vertipo'];
        $stmt = $pdo->prepare("SELECT tipo FROM procedimiento WHERE id_procedimiento = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $tipo = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['vernotas'])) {
        $id = $_POST['vernotas'];
        $stmt = $pdo->prepare("SELECT notas FROM procedimiento WHERE id_procedimiento = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $notas = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (isset($_POST['confirmarI'])) {
        if($_POST['id_dueñoanimal'] != NULL) {
            if ($_POST['fecha_proxima'] != NULL) {
                $stmt = $pdo->prepare("INSERT INTO procedimiento (id_dueñoanimal, tipo, fecha, notas, fecha_proxima) 
                    VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['id_dueñoanimal'],
                    $_POST['tipo'],
                    $_POST['fecha'],
                    $_POST['notas'],
                    $_POST['fecha_proxima']
                ]);

                $stmtUsuario = $pdo->prepare("
                    SELECT U.id_usuario, A.nombre FROM dueño_animal DA
                    INNER JOIN dueño D ON DA.id_dueño = D.id_dueño
                    INNER JOIN usuario U ON D.id_usuario = U.id_usuario
                    INNER JOIN animal A ON DA.id_animal = A.id_animal
                    WHERE DA.id_dueñoanimal = ?
                ");
                $stmtUsuario->execute([$_POST['id_dueñoanimal']]);
                $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

                if ($usuario) {
                    $fechaProxima = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fecha_proxima']);
                    if (!$fechaProxima) {
                        $fechaProxima = new DateTime($_POST['fecha_proxima']);
                    }

                    $fechaProximaFecha = $fechaProxima->format('d/m/Y');
                    $fechaProximaHora = $fechaProxima->format('H:i');

                    $fechaSemana = (clone $fechaProxima)->modify('-7 days');
                    $fechaSemanaF = $fechaSemana->format('Y-m-d H:i:s');
                    $fechaDia = (clone $fechaProxima)->modify('-1 days');
                    $fechaDiaF = $fechaDia->format('Y-m-d H:i:s');

                    $nombre = $usuario['nombre'];
                    $idUsuario = $usuario['id_usuario'];
                    $fechaActual = new DateTime();

                    $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                        VALUES (?, ?, ?, NOW())");

                    $titulo = "Nuevo Procedimiento de \"$nombre\" Programado";
                    $mensaje = "Se programó un procedimiento para \"$nombre\" para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                    $stmt->execute([$idUsuario, $titulo, $mensaje]);

                    if ($fechaActual <= $fechaSemana) {
                        $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                            VALUES (?, ?, ?, ?)");

                        $titulo = "Faltan 7 Días para el Procedimiento de \"$nombre\"";
                        $mensaje = "Faltan 7 días para el procedimiento de \"$nombre\" programado para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                        $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaSemanaF]);
                    }
                    if ($fechaActual <= $fechaDia) {
                        $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                            VALUES (?, ?, ?, ?)");

                        $titulo = "Falta 1 Día para el Procedimiento de \"$nombre\"";
                        $mensaje = "Falta 1 día para el procedimiento de \"$nombre\" programado para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                        $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaDiaF]);
                    }
                }

            } else {
                $stmt = $pdo->prepare("INSERT INTO procedimiento (id_dueñoanimal, tipo, fecha, notas) 
                    VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['id_dueñoanimal'],
                    $_POST['tipo'],
                    $_POST['fecha'],
                    $_POST['notas']
                ]);
            }
        } else if($_POST['id_animal'] != NULL) {
            if($_POST['fecha_proxima'] != NULL) {
                $stmt = $pdo->prepare("INSERT INTO procedimiento (id_animal, tipo, fecha, notas, fecha_proxima) 
                    VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['id_animal'],
                    $_POST['tipo'],
                    $_POST['fecha'],
                    $_POST['notas'],
                    $_POST['fecha_proxima']
                ]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO procedimiento (id_animal, tipo, fecha, notas) 
                    VALUES (?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['id_animal'],
                    $_POST['tipo'],
                    $_POST['fecha'],
                    $_POST['notas']
                ]);
            }
        }

        $_SESSION['guardado'] = true;
    }

    if (isset($_POST['confirmarU'])) {
        $id_procedimiento = $_POST['id_procedimiento'];

        if($_POST['fecha_proxima'] != NULL) {
            $stmt = $pdo->prepare("UPDATE procedimiento SET 
                tipo = ?, 
                fecha = ?, 
                notas = ?, 
                fecha_proxima = ?
                WHERE id_procedimiento = ?");

            $stmt->execute([
                $_POST['tipo'],
                $_POST['fecha'],
                $_POST['notas'],
                $_POST['fecha_proxima'],
                $id_procedimiento
            ]);

            if($_POST['idUsuario'] != NULL) {
                $fechaProxima = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fecha_proxima']);
                if (!$fechaProxima) {
                    $fechaProxima = new DateTime($_POST['fecha_proxima']);
                }
                $fechaProximaFecha = $fechaProxima->format('d/m/Y');
                $fechaProximaHora = $fechaProxima->format('H:i');

                $fechaSemana = (clone $fechaProxima)->modify('-7 days');
                $fechaSemanaF = $fechaSemana->format('Y-m-d H:i:s');
                $fechaDia = (clone $fechaProxima)->modify('-1 days');
                $fechaDiaF = $fechaDia->format('Y-m-d H:i:s');

                $nombre = $_POST['nombre'];
                $idUsuario = $_POST['idUsuario'];
                $fechaActual = new DateTime();

                if($_POST['fechaAnterior'] != NULL) {
                    $fechaAnterior = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['fechaAnterior']);
                    if (!$fechaAnterior) {
                        $fechaAnterior = new DateTime($_POST['fechaAnterior']);
                    }

                    $fechaAnteriorFecha = $fechaAnterior->format('d/m/Y');
                    $fechaAnteriorHora = $fechaAnterior->format('H:i');

                    $stmt = $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ? AND mensaje LIKE '%".$fechaAnteriorFecha." a las ".$fechaAnteriorHora.".'");
                    $stmt->execute([$idUsuario]);
                }

                $stmt2 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                    VALUES (?, ?, ?, NOW())");

                $titulo = "Nuevo Procedimiento de \"$nombre\" Programado";
                $mensaje = "Se programó un procedimiento para \"$nombre\" para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                $stmt2->execute([$idUsuario, $titulo, $mensaje]);

                if ($fechaActual <= $fechaSemana) {
                    $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                        VALUES (?, ?, ?, ?)");

                    $titulo = "Faltan 7 Días para el Procedimiento de \"$nombre\"";
                    $mensaje = "Faltan 7 días para el procedimiento de \"$nombre\" programado para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                    $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaSemanaF]);
                }
                if ($fechaActual <= $fechaDia) {
                    $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                        VALUES (?, ?, ?, ?)");

                    $titulo = "Falta 1 Día para el Procedimiento de \"$nombre\"";
                    $mensaje = "Falta 1 día para el procedimiento de \"$nombre\" programado para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                    $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaDiaF]);
                }
            }
        } else {
            $stmt = $pdo->prepare("UPDATE procedimiento SET 
                tipo = ?, 
                fecha = ?, 
                notas = ?
                WHERE id_procedimiento = ?");

            $stmt->execute([
                $_POST['tipo'],
                $_POST['fecha'],
                $_POST['notas'],
                $id_procedimiento
            ]);
        }

        $_SESSION['editado'] = true;
    }

    if (isset($_POST['confirmarD'])) {
        $id = $_POST['id_procedimiento'];

        if($_POST['fechaProximaEliminar'] != NULL) {
            $fechaProxima = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['fechaProximaEliminar']);
            if (!$fechaProxima) {
                $fechaProxima = new DateTime($_POST['fechaProximaEliminar']);
            }

            $fechaProximaFecha = $fechaProxima->format('d/m/Y');
            $fechaProximaHora = $fechaProxima->format('H:i');
            $idUsuario = $_POST['idUsuario'];

            $stmt = $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ? AND mensaje LIKE '%".$fechaProximaFecha." a las ".$fechaProximaHora.".'");
            $stmt->execute([$idUsuario]);
        }

        $pdo->prepare("DELETE FROM procedimiento WHERE id_procedimiento = ?")->execute([$id]);

        $_SESSION['eliminado'] = true;
    }
}

$registros = $modelo->buscarProcedimientos($txtbuscar); 
include 'vista.php';
?>
