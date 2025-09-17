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

    $mostrarFormularioDueño = null;
    $datosDueño = null;
    $id_animal = null;

    $pdo = new PDO("mysql:host=localhost;dbname=sghmac", "root", "Torres18");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['adoptar']) && isset($_POST['id_animal'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $id_animal = $_POST['id_animal'];
            $nombre = $_POST['nombre'];

            $stmt = $pdo->prepare("SELECT * FROM dueño WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);

            if ($stmt->rowCount() > 0) {
                $mostrarFormularioDueño = false;
                $datosDueño = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $mostrarFormularioDueño = true;
            }
        }

        if (isset($_POST['nombres']) && isset($_POST['confirmar'])) {
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

            $id_dueño = $pdo->lastInsertId();
            $id_animal = $_POST['id_animal'];

            $stmt2 = $pdo->prepare("INSERT INTO adopcion (id_dueño, id_animal) VALUES (?, ?)");
            $stmt2->execute([$id_dueño, $id_animal]);

            $id_usuario = $_SESSION['id_usuario'];
            $nombre = $_POST['nombre'];

            $stmt3 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje) VALUES (?, 'En Proceso de Adopción de $nombre', 
                                        'Se ha mandado su solicitud para la adopción de $nombre, favor de esperar para la confirmación de su adopción.')");
            $stmt3->execute([$id_usuario]);
            $_SESSION['solicitud_enviada'] = true;
            $_SESSION['correo'] = $_POST['correo'];

            // header("Location: inicio.php?pagina=animal");
            // exit();
        }

        if (isset($_POST['id_dueño']) && isset($_POST['id_animal']) && isset($_POST['confirmar'])) {
            $id_dueño = $_POST['id_dueño'];
            $id_animal = $_POST['id_animal'];

            $stmt = $pdo->prepare("INSERT INTO adopcion (id_dueño, id_animal) VALUES (?, ?)");
            $stmt->execute([$id_dueño, $id_animal]);

            $id_usuario = $_SESSION['id_usuario'];
            $animal = $_POST['nombre'];

            $stmt2 = $pdo->prepare("INSERT INTO notificacion (id_usuario, titulo, mensaje) VALUES (?, 'En Proceso de Adopción de $animal', 
                                        'Se ha mandado su solicitud para la adopción de $animal, favor de esperar para la confirmación de su adopción.')");
            $stmt2->execute([$id_usuario]);
            $_SESSION['solicitud_enviada'] = true;

            // header("Location: inicio.php?pagina=animal");
            // exit();
        }
    }

    include 'vista.php';
?>
