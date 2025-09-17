<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Clínica tecnm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #dfe6e9, #81ecec);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .decor-img {
            position: absolute;
            z-index: 0;
            opacity: 0.5;
            pointer-events: none;
        }

        /* Imagen izquierda (perrito) */
        .perrito {
            bottom: 20px;
            left: 50px;
            width: 250px;
        }

        /* Imagen derecha (gatito) */
        .gatito {
            top: 20px;
            right: 50px;
            width: 230px;
        }

        .welcome-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 25px rgba(0,0,0,0.25);
            text-align: center;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .welcome-box h1 {
            color: #0984e3;
            margin-bottom: 1rem;
        }

        .welcome-box p {
            color: #333;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            margin: 0.5rem;
            padding: 0.75rem 1.5rem;
            background-color: #0984e3;
            color: white;
            border: none;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #74b9ff;
        }

        .logo {
            width: 90px;
            display: block;
            margin: 0 auto 20px;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- Imagenes decorativas más visibles y grandes -->
    <img src="img/pet2.jpg" class="decor-img perrito" alt="Perrito decorativo">
    <img src="img/pet.jpg" class="decor-img gatito" alt="Gatito decorativo">

    <div class="welcome-box">
        <img src="img/veterinario.jpg" alt="Veterinaria Logo" class="logo">
        <h1>Bienvenido a clinica del tecnm </h1>
        <p>Gestión de pacientes y dueños para tu clínica veterinaria 🐶🐱</p>
        <a href="login.php" class="btn">Entrar</a>
    </div>

</body>
</html>
