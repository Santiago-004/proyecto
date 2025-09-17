<?php 
    include "modelo.php";
    $modelo = new modelo();
    $modelo->cn();
    $registros = [];
    $duenoanimales = $modelo->obtenerDuenoAnimal();
    $animales = $modelo->obtenerAnimal();
    $datosConsulta = null;
    $motivo = null;
    $diagnostico = null;
    $tratamiento = null;
    $notas = null;

    if (isset($_POST["txtbuscar"])){
        $txtbuscar = $_POST["txtbuscar"];
    }    
    else {
        $txtbuscar ="";
    }

    $pdo = new PDO("mysql:host=localhost;dbname=sghmac", "root", "Torres18");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['editar'])) {
            $id = $_POST['editar'];
            $stmt = $pdo->prepare("SELECT *, U.id_usuario AS idUsuario, C.fecha AS fechaConsulta FROM consulta C
                                    LEFT JOIN dueño_animal DA ON C.id_dueñoanimal = DA.id_dueñoanimal 
                                    LEFT JOIN animal A ON A.id_animal = DA.id_animal 
                                    LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño 
                                    LEFT JOIN usuario U ON U.id_usuario = D.id_usuario 
                                    WHERE id_consulta = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $datosConsulta = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['eliminar'])) {
            $id = $_POST['eliminar'];
            $stmt = $pdo->prepare("SELECT *, U.id_usuario AS idUsuario FROM consulta C
                                    LEFT JOIN dueño_animal DA ON C.id_dueñoanimal = DA.id_dueñoanimal 
                                    LEFT JOIN animal A ON A.id_animal = DA.id_animal 
                                    LEFT JOIN dueño D ON D.id_dueño = DA.id_dueño 
                                    LEFT JOIN usuario U ON U.id_usuario = D.id_usuario 
                                    WHERE id_consulta = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $datosConsulta = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['vermotivo'])) {
            $id = $_POST['vermotivo'];
            $stmt = $pdo->prepare("SELECT motivo FROM consulta WHERE id_consulta = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $motivo = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['verdiagnostico'])) {
            $id = $_POST['verdiagnostico'];
            $stmt = $pdo->prepare("SELECT diagnostico FROM consulta WHERE id_consulta = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $diagnostico = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['vertratamiento'])) {
            $id = $_POST['vertratamiento'];
            $stmt = $pdo->prepare("SELECT tratamiento FROM consulta WHERE id_consulta = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $tratamiento = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        if (isset($_POST['vernotas'])) {
            $id = $_POST['vernotas'];
            $stmt = $pdo->prepare("SELECT notas FROM consulta WHERE id_consulta = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $notas = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
   
        $mostrarModalEditar = false;

        if (isset($_POST['confirmarI'])) {
            if($_POST['id_dueñoanimal'] != NULL) {
                if ($_POST['fecha_proxima'] != NULL) {
                    $stmt = $pdo->prepare("INSERT INTO consulta (id_dueñoanimal, fecha, motivo, diagnostico, tratamiento, notas, fecha_proxima) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $_POST['id_dueñoanimal'],
                        $_POST['fecha'],
                        $_POST['motivo'],
                        $_POST['diagnostico'],
                        $_POST['tratamiento'],
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
                        $fechaProxima = DateTime::createFromFormat('d/m/Y H:i', $_POST['fecha_proxima']);
                        if (!$fechaProxima) {
                            $fechaProxima = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fecha_proxima']);
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
                        
                        $titulo = "Nueva Consulta de \"$nombre\" Programada";
                        $mensaje = "Se programó una consulta para \"$nombre\" para la fecha $fechaProximaFecha a las $fechaProximaHora.";
                        
                        $stmt->execute([$idUsuario, $titulo, $mensaje]);

                        if ($fechaActual <= $fechaSemana) {
                            $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                                VALUES (?, ?, ?, ?)");
                            
                            $titulo = "Faltan 7 Días para la Consulta de \"$nombre\"";
                            $mensaje = "Faltan 7 días para la consulta de \"$nombre\" programada para la fecha $fechaProximaFecha a las $fechaProximaHora.";
                            
                            $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaSemanaF]);
                        }
                        if ($fechaActual <= $fechaDia) {
                            $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                                VALUES (?, ?, ?, ?)");
                            
                            $titulo = "Falta 1 Día para la Consulta de \"$nombre\"";
                            $mensaje = "Falta 1 día para la consulta de \"$nombre\" programada para la fecha $fechaProximaFecha a las $fechaProximaHora.";
                            
                            $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaDiaF]);
                        }
                    }
                }
                else {
                    $stmt = $pdo->prepare("INSERT INTO consulta (id_dueñoanimal, fecha, motivo, diagnostico, tratamiento, notas) 
                                            VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $_POST['id_dueñoanimal'],
                        $_POST['fecha'],
                        $_POST['motivo'],
                        $_POST['diagnostico'],
                        $_POST['tratamiento'],
                        $_POST['notas']
                    ]);
                }
            } 
            else if($_POST['id_animal'] != NULL) {
                if($_POST['fecha_proxima'] != NULL) {
                    $stmt = $pdo->prepare("INSERT INTO consulta (id_animal, fecha, motivo, diagnostico, tratamiento, notas, fecha_proxima) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $_POST['id_animal'],
                        $_POST['fecha'],
                        $_POST['motivo'],
                        $_POST['diagnostico'],
                        $_POST['tratamiento'],
                        $_POST['notas'],
                        $_POST['fecha_proxima']
                    ]);
                } 
                else {
                    $stmt = $pdo->prepare("INSERT INTO consulta (id_animal, fecha, motivo, diagnostico, tratamiento, notas) 
                                            VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $_POST['id_animal'],
                        $_POST['fecha'],
                        $_POST['motivo'],
                        $_POST['diagnostico'],
                        $_POST['tratamiento'],
                        $_POST['notas']
                    ]);
                }
            }

            $_SESSION['guardado'] = true;
        }

        if (isset($_POST['confirmarU'])) {
            $id_consulta = $_POST['id_consulta'];
            
            if($_POST['fecha_proxima'] != NULL) {
                $stmt = $pdo->prepare("UPDATE consulta SET 
                    fecha = ?, 
                    motivo = ?, 
                    diagnostico = ?, 
                    tratamiento = ?, 
                    notas = ?,
                    fecha_proxima = ?
                    WHERE id_consulta = ?");

                $stmt->execute([
                    $_POST['fecha'],
                    $_POST['motivo'],
                    $_POST['diagnostico'],
                    $_POST['tratamiento'],
                    $_POST['notas'],
                    $_POST['fecha_proxima'],
                    $id_consulta
                ]);

                if($_POST['idUsuario'] != NULL) {
                    $fechaProxima = DateTime::createFromFormat('d/m/Y H:i', $_POST['fecha_proxima']);

                    if (!$fechaProxima) {
                        $fechaProxima = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fecha_proxima']);
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
                            $fechaAnterior = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fechaAnterior']);
                        }

                        $fechaAnteriorFecha = $fechaAnterior->format('d/m/Y');
                        $fechaAnteriorHora = $fechaAnterior->format('H:i');

                        $stmt = $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ? AND mensaje LIKE '%".$fechaAnteriorFecha." a las ".$fechaAnteriorHora.".'");
                        $stmt->execute([$idUsuario]);
                    }

                    $stmt2 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                            VALUES (?, ?, ?, NOW())");

                    $titulo = "Nueva Consulta de \"$nombre\" Programada";
                    $mensaje = "Se programó una consulta para \"$nombre\" para la fecha $fechaProximaFecha a las $fechaProximaHora.";
                    
                    $stmt2->execute([$idUsuario, $titulo, $mensaje]);

                    if ($fechaActual <= $fechaSemana) {
                        $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                            VALUES (?, ?, ?, ?)");

                        $titulo = "Faltan 7 Días para la Consulta de \"$nombre\"";
                        $mensaje = "Faltan 7 días para la consulta de \"$nombre\" programada para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                        $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaSemanaF]);
                    }
                    if ($fechaActual <= $fechaDia) {
                        $stmt = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje, fecha_envio) 
                                            VALUES (?, ?, ?, ?)");

                        $titulo = "Falta 1 Día para la Consulta de \"$nombre\"";
                        $mensaje = "Falta 1 día para la consulta de \"$nombre\" programada para la fecha $fechaProximaFecha a las $fechaProximaHora.";

                        $stmt->execute([$idUsuario, $titulo, $mensaje, $fechaDiaF]);
                    }
                }
            }
            else {
                $stmt = $pdo->prepare("UPDATE consulta SET 
                    fecha = ?, 
                    motivo = ?, 
                    diagnostico = ?, 
                    tratamiento = ?, 
                    notas = ?
                    WHERE id_consulta = ?");

                $stmt->execute([
                    $_POST['fecha'],
                    $_POST['motivo'],
                    $_POST['diagnostico'],
                    $_POST['tratamiento'],
                    $_POST['notas'],
                    $id_consulta
                ]);
            }

            $_SESSION['editado'] = true;
        }

        if (isset($_POST['confirmarD'])) {
            $id = $_POST['id_consulta'];

            if($_POST['fechaProximaEliminar'] != NULL) {
                $fechaProxima = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['fechaProximaEliminar']);
                if (!$fechaProxima) {
                    $fechaProxima = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['fechaProximaEliminar']);
                }

                $fechaProximaFecha = $fechaProxima->format('d/m/Y');
                $fechaProximaHora = $fechaProxima->format('H:i');
                $idUsuario = $_POST['idUsuario'];

                $stmt = $pdo->prepare("DELETE FROM notificacion WHERE id_usuario = ? AND mensaje LIKE '%".$fechaProximaFecha." a las ".$fechaProximaHora.".'");
                $stmt->execute([$idUsuario]);
            }
        
            $pdo->prepare("DELETE FROM consulta WHERE id_consulta = ?")->execute([$id]);
            
            $_SESSION['eliminado'] = true;
        }
    }

    $registros = $modelo->buscar();
    include 'vista.php';
?>
