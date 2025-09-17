<?php
session_start();
if (!isset($_SESSION["nombre_usuario"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SGHMAC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap solo CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .nav-link {
            color: #333;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #0d6efd;
        }

        .usuario-cuenta {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            text-align: right;
            font-size: 0.875rem;
            color: #495057;
        }

        .usuario-cuenta p {
            margin: 0;
        }

        .logout {
            width: 28px;
            height: 28px;
            margin-left: 10px;
        }

        .contenedor {
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .bienvenida {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
            max-width: 900px;
            width: 100%;
        }

        .bienvenida h2 {
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 20px;
        }

        .bienvenida h1 {
            font-size: 2.5rem;
            font-style: italic;
            color: #343a40;
        }

        .nombre, .correo {
            margin: 0;
            font-size: 14px;
        }

        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .bienvenida h1 {
                font-size: 2rem;
            }

            .bienvenida h2 {
                font-size: 1.5rem;
            }

            .contenedor {
                padding: 20px 10px;
            }

            .navbar-nav {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 300px) {
            .usuario-cuenta {
                flex-direction: column;
                align-items: flex-end;
                margin-left: 100%;
            }

            .logout {
                margin-left: 0;
                margin-top: 5px;
            }
        }
    </style>
</head>

<?php if ($_SESSION["rol"] == 'admin') { ?>
<body>
    <nav class="navbar navbar-expand-lg px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio.php">SGHMAC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="?pagina=animal">Animales</a></li>
                    <li class="nav-item"><a class="nav-link" href="?pagina=dueño">Dueños</a></li>
                    <li class="nav-item"><a class="nav-link" href="?pagina=usuario">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="?pagina=adopcion">Solicitudes de Adopción</a></li>
                    <li class="nav-item"><a class="nav-link" href="?pagina=devolucion">Solicitudes de Devolución</a></li>
                </ul>
                <div class="usuario-cuenta d-flex align-items-center">
                    <div>
                        <p class="nombre"><?= $_SESSION["nombre_usuario"] ?></p>
                    </div>
                    <a href="logout.php">
                        <img class="logout" src="img/logout2.png" alt="Logout">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?php
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
            $permitidas = ['animal','dueño', 'usuario', 'adopcion', 'devolucion'];

            if (in_array($pagina, $permitidas)) {
                include "vista_admin/$pagina/controlador.php";
            } else {
                echo "<p class='text-danger text-center mt-4'>Página no permitida.</p>";
            }
        } else {
            echo "<div class='contenedor'>
                    <div class='bienvenida'>
                        <h2>Bienvenido administrador al</h2>
                        <h1><em>Sistema de Gestión de Historial Médico para Animales de Compañía</em></h1>
                    </div>
                </div>";
        }
    ?>
</body>
<?php } ?>


<?php if ($_SESSION["rol"] == 'veterinario') { ?>
    <body>
        <nav class="navbar navbar-expand-lg px-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio.php">SGHMAC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContenido">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="?pagina=animal">Animales</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pagina=consulta">Consultas</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pagina=procedimiento">Procedimientos</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pagina=vacunacion">Vacunaciones</a></li>
                    </ul>
                    <div class="usuario-cuenta d-flex align-items-center">
                        <div>
                            <p class="nombre"><?= $_SESSION["nombre_usuario"] ?></p>
                        </div>
                        <a href="logout.php">
                            <img class="logout" src="img/logout2.png" alt="Logout">
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <?php
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
                $permitidas = ['animal', 'consulta', 'procedimiento', 'vacunacion'];

                if (in_array($pagina, $permitidas)) {
                    include "vista_veterinario/$pagina/controlador.php";
                } else {
                    echo "<p class='text-danger text-center mt-4'>Página no permitida.</p>";
                }
            } else {
                echo "<div class='contenedor'>
                        <div class='bienvenida'>
                            <h2>Bienvenido veterinario al</h2>
                            <h1><em>Sistema de Gestión de Historial Médico para Animales de Compañía</em></h1>
                        </div>
                    </div>";
            }
        ?>
    </body>
<?php } ?>


<?php if ($_SESSION["rol"] == 'usuario') { ?>
    <body>
        <nav class="navbar navbar-expand-lg px-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio.php">SGHMAC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContenido">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="?pagina=animal">Animales de Compañía Disponibles</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pagina=mis_animales">Mis Animales de Compañía</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pagina=notificaciones">Notificaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="?pagina=cuenta">Cuenta</a></li>
                    </ul>
                    <div class="usuario-cuenta d-flex align-items-center">
                        <div>
                            <p class="nombre"><?= $_SESSION["nombre_usuario"] ?></p>
                            <p class="correo"><?= $_SESSION["correo"] ?></p>
                        </div>
                        <a href="logout.php">
                            <img class="logout" src="img/logout2.png" alt="Logout">
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <?php
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
                $permitidas = ['animal', 'mis_animales', 'notificaciones', 'cuenta'];

                if (in_array($pagina, $permitidas)) {
                    include "vista_usuario/$pagina/controlador.php";
                } else {
                    echo "<p class='text-danger text-center mt-4'>Página no permitida.</p>";
                }
            } else {
                echo "<div class='contenedor'>
                        <div class='bienvenida'>
                            <h2>Bienvenido usuario al</h2>
                            <h1><em>Sistema de Gestión de Historial Médico para Animales de Compañía</em></h1>
                        </div>
                    </div>";
            }
        ?>
    </body>
<?php } ?>
