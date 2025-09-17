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
    $registros = [];
    $vacunaciones = [];
    $consultas = [];
    $procedimientos = [];
    $datosAnimal = null;
    
    if (isset($_POST["txtbuscar"])){
        $txtbuscar = $_POST["txtbuscar"];
    }    
    else {
        $txtbuscar ="";
    }

    if (isset($_POST['animal'])) {
        $vacunaciones = $modelo->buscarVacunaciones($_POST['animal']);
    }
    if(isset($_POST['animalc'])){ 
        $consultas = $modelo->buscarConsultas($_POST['animalc']);
    }
    if(isset($_POST['animalp'])){ 
        $procedimientos = $modelo->buscarProcedimientos($_POST['animalp']);
    }
    
    $registros = $modelo->buscar();

    $devolucionesExistentes = [];

    foreach ($registros as $registro) {
        if ($modelo->existeDevolucion($registro['id_dueñoanimal'])) {
            $devolucionesExistentes[] = $registro['id_dueñoanimal'];
            $estados = $modelo->buscarDevolucion($registro['id_dueñoanimal']);
        }
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

        if(isset($_POST['solicitud'])) {
            $nombre = $_POST['nombre'];
        }
        
        if (isset($_POST['confirmar'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $id_animal = $_POST['id_animal'];
            $nombre = $_POST['nombre'];

            $stmt = $pdo->prepare("SELECT * FROM dueño D
                                        INNER JOIN dueño_animal DA ON DA.id_dueño = D.id_dueño 
                                        WHERE D.id_usuario = ? AND DA.id_animal = ? AND fecha_devolucion IS NULL");
            $stmt->execute([$id_usuario, $id_animal]);

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($resultado) {
                $id_dueñoanimal = $resultado['id_dueñoanimal'];

                $stmt2 = $pdo->prepare("INSERT INTO devolucion (id_dueñoanimal)
                                    VALUES (?)");
                $stmt2->execute([$id_dueñoanimal]);

                $stmt3 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje) VALUES (?, 'En Proceso de Devolución de $nombre', 
                                            'Se ha mandado su solicitud para la devolución de $nombre.')");
                $stmt3->execute([$id_usuario]);

                $_SESSION['solicitud_enviada'] = true;
            }
        }

        if (isset($_POST['confirmarI'])) {
            $stmt = $pdo->prepare("INSERT INTO animal (nombre, especie, raza, fecha_nacimiento, sexo, con_dueño, vivo) 
                                        VALUES (?, ?, ?, ?, ?, 'S', 'S')");
            $stmt->execute([
                $_POST['nombre'],
                $_POST['especie'],
                $_POST['raza'],
                $_POST['fecha_nacimiento'],
                $_POST['sexo']
            ]);

            $id_animal = $pdo->lastInsertId();
            $id_usuario = $_SESSION["id_usuario"];

            $stmt2 = $pdo->prepare("SELECT id_dueño FROM dueño WHERE id_usuario = ?");
            $stmt2->execute([$id_usuario]);
            $dueño = $stmt2->fetch(PDO::FETCH_ASSOC);
            $id_dueño = $dueño['id_dueño'];

            $stmt3 = $pdo->prepare("INSERT INTO dueño_animal (fecha, id_dueño, id_animal, por_usuario) 
                                        VALUES (NOW(), ?, ?, 'S')");
            $stmt3->execute([
                $id_dueño,
                $id_animal
            ]);

            $_SESSION['guardado'] = true;
        }

        if (isset($_POST['confirmarU'])) {
            $id_animal = $_POST['id_animal'];
            
            
            $stmt = $pdo->prepare("UPDATE animal SET 
                nombre = ?, 
                especie = ?, 
                raza = ?, 
                fecha_nacimiento = ?, 
                sexo = ?
                WHERE id_animal = ?");

            $stmt->execute([
                $_POST['nombre'],
                $_POST['especie'],
                $_POST['raza'],
                $_POST['fecha_nacimiento'],
                $_POST['sexo'],
                $id_animal
            ]);

            $_SESSION['editado'] = true;
        }
    }

    include 'vista.php';
?>