<?php
session_start();
require 'conexion.php';

if (isset($_POST['btn_login'])) {
    $usuario = $_POST["nombre_usuario"];
    $clave = $_POST["contraseña"];

    $sql = "SELECT U.*, D.correo FROM usuario U
            LEFT JOIN dueño D ON D.id_usuario = U.id_usuario
            WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usuario]);

    $usuarioBD = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioBD && ($clave === $usuarioBD['contraseña'])) {
        $_SESSION["nombre_usuario"] = $usuarioBD['nombre_usuario'];
        $_SESSION["rol"] = $usuarioBD['rol'];
        $_SESSION["id_usuario"] = $usuarioBD['id_usuario'];
        $_SESSION["correo"] = $usuarioBD['correo'];
        header("Location: inicio.php");
        exit;
    } else {
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}

if (isset($_POST['btn_registro'])) {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contraseña = $_POST["contraseña"];

    $verificar = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE nombre_usuario = ?");
    $verificar->execute([$nombre_usuario]);

    if ($verificar->fetchColumn() > 0) {
        $error = "Este nombre de usuario ya está registrado.";
    } else {
        $stmt = $conn->prepare("INSERT INTO usuario (nombre_usuario, contraseña) VALUES (?, ?)");
        if ($stmt->execute([$nombre_usuario, $contraseña])) {
            $sql = "SELECT U.*, D.correo FROM usuario U
                    LEFT JOIN dueño D ON D.id_usuario = U.id_usuario
                    WHERE nombre_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre_usuario]);

            $usuarioBD = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION["nombre_usuario"] = $usuarioBD['nombre_usuario'];
            $_SESSION["rol"] = $usuarioBD['rol'];
            $_SESSION["id_usuario"] = $usuarioBD['id_usuario'];
            $_SESSION["correo"] = $usuarioBD['correo'];
            header("Location: inicio.php");
            exit;
        } else {
            $error = "Error al registrar usuario.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login / Registro</title>
    <!-- Bootstrap 5 SOLO CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 1rem;
        }

        .login-box {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 420px;
        }

        .login-box h2 {
            text-align: center;
            color: #2d3436;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1b63e1;
        }

        .btn-outline-primary {
            border-color: #2575fc;
            color: #2575fc;
        }

        .btn-outline-primary:hover {
            background-color: #2575fc;
            color: #fff;
        }

        .form-label {
            font-weight: 500;
        }

        .error {
            background-color: #ffe6e6;
            color: #d63031;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 1.5rem;
            }

            .login-box h2 {
                font-size: 1.5rem;
            }

            .form-label {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
    <h2>Bienvenido</h2>

    <?php if (isset($error)) : ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Usuario</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contraseña" class="form-label">Contraseña</label>
            <input type="password" name="contraseña" id="contraseña" class="form-control" required>
        </div>

        <div class="d-grid gap-2">
            <input type="submit" name="btn_login" class="btn btn-primary" value="Iniciar sesión">
            <input type="submit" name="btn_registro" class="btn btn-outline-primary" value="Registrarse">
        </div>
    </form>
</div>
</body>
</html>