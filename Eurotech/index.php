<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        @media (max-width: 620px) {
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

        /* @media (max-width: 300px) {
            .usuario-cuenta {
                flex-direction: column;
                align-items: flex-end;
                margin-left: 100%;
            }

            .logout {
                margin-left: 0;
                margin-top: 5px;
            }
        } */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg px-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Eurotech/">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido" aria-controls="navbarContenido" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContenido">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="?page=BluSeal">BluSeal</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=Cables">Cables</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=Tapes">Tapes</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="?page=Tapes PPAP M">Tapes PPAPs Missing 2025</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="?page=Tubes">Tubes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $allowed = ['BluSeal', 'Cables', 'Tapes', 'Tubes', 'Tapes PPAP M'];

            if (in_array($page, $allowed)) {
                include "$page/controller.php";
            } else {
                echo "<p class='text-danger text-center mt-4'>You don't have permission for this page.</p>";
            }
        } else {
            echo "<div class='contenedor'>
                        <div class='bienvenida'>
                            <h2>Welcome</h2>
                        </div>
                    </div>";
        }
    ?>
</body>
</html>