<style>
    .tarjeta-usuario {
        background-color:rgb(249, 249, 249);
        border-radius: 12px;
        padding: 30px 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.38);
        max-width: 500px;
        margin: 40px auto;
        font-family: 'Segoe UI', sans-serif;
    }

    .tarjeta-usuario h2 {
        color: #1c1883;
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .info-usuario .fila {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-usuario .label {
        color: #1c1883;
        font-weight: bold;
        min-width: 150px;
        display: inline-block;
    }



    .formulario-busqueda {
        margin: 20px 0;
        padding: 20px;
        background-color: #f1f2fb;
        border: 1px solid #ddd;
        border-radius: 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    .formulario-busqueda label {
        font-weight: bold;
        color: #1c1883;
        flex: 1 1 100%;
    }

    .formulario-busqueda select {
        padding: 8px;
        border: 1px solid #bbb;
        border-radius: 8px;
        max-width: 300px;
        flex: 1 1 auto;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 10;
        padding-top: 80px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-contenido {
        background-color: #fff;
        margin: auto;
        padding: 20px;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        position: relative;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        max-height: 90vh;
        overflow-y: auto;
    }

    .cerrar {
        color: #aaa;
        position: absolute;
        right: 20px;
        top: 10px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    table th, table td {
        padding: 10px;
        text-align: left;
    }

    table th {
        background-color: #1c1883;
        color: white;
    }

    table td {
        border-bottom: 1px solid #eaeaea;
    }

    table tr:hover {
        background-color: #f5f5f5;
    }
    
    .editar {
        width: 100%;
    } 

    .btn, .insertar, .editar, .eliminar {
        color: white;
        padding: 8px 14px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
        font-size: 14px;
    }

    .btn, .insertar, .editar {
        background-color: #1c1883;
    }

    .btn:hover, .insertar:hover, .editar:hover {
        background-color: #2d27b4;
        color: white;
    }

    .eliminar {
        background-color: #bb1616ff;
    }

    .eliminar:hover {
        background-color: #d72323;
    }

    .reporte {
        padding: 10px;
        margin-bottom: 10px;
        border-left: 5px solid #1c1883;
        background-color: #f9f9ff;
        border-radius: 6px;
    }

    .reporte p {
        margin: 4px 0;
        font-size: 15px;
    }

    .cancelado {
        color: red;
    }

    .modal-contenido h2, .modal-contenido h3 {
        color: #1c1883;
        margin-bottom: 10px;
    }

    .modal-contenido form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .modal-contenido label {
        font-weight: bold;
        color: #1c1883;
    }

    .modal-contenido input[type="date"],
    .modal-contenido input[type="datetime-local"],
    .modal-contenido input[type="text"],
    .modal-contenido input[type="password"],
    .modal-contenido input[type="tel"],
    .modal-contenido input[type="email"],
    .modal-contenido select,
    .modal-contenido textarea {
        padding: 8px 10px;
        border: 1px solid #bbb;
        border-radius: 8px;
        width: 100%;
        font-size: 14px;
    }

    .modal-contenido textarea {
        resize: vertical;
        min-height: 60px;
    }

    .modal-contenido form button[type="submit"] {
        background-color: #1c1883;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
        display: block;
        margin-top: 20px;
    }

    .modal-contenido button[type="submit"]:hover {
        background-color: #2d27b4;
    }

    .modal-contenido p {
        font-size: 15px;
        margin: 6px 0;
    }

    @media (max-width: 768px) {
        .btn, .insertar, .editar, .eliminar {
            width: 100%;
            margin-bottom: 8px;
        }

        form[style*="display:inline"] {
            display: block !important;
            margin-bottom: 10px;
        }

        .modal-contenido {
            padding: 15px;
        }

        table th, table td {
            font-size: 13px;
        }

        .modal-contenido form {
            gap: 6px;
        }

        .modal-contenido h2 {
            padding: 0% 10% 0% 10%;
        }
    }

    @media (max-width: 500px) {
        .info-usuario .fila {
            flex-direction: column;
            align-items: flex-start;
            word-wrap: break-word;
            word-break: break-word;
        }

        .info-usuario .label {
            margin-bottom: 4px;
        }

        .modal-contenido {
            width: 95%;
            max-width: 95%;
            padding: 15px;
        }

        .modal-contenido form button[type="submit"] {
            width: 100%;
        }
    }
</style>

<?php foreach ($registros as $registro) { ?>
<div class="tarjeta-usuario">
    <h2>Datos de la Cuenta</h2>
    <div class="info-usuario">
        <div class="fila"><span class="label">Nombre(s):</span><span><?= $registro['nombres'] ?></span></div>
        <div class="fila"><span class="label">Apellido Paterno:</span><span><?= $registro['apellido_paterno'] ?></span></div>
        <?php if($registro['apellido_materno'] != NULL) { ?>
            <div class="fila"><span class="label">Apellido Materno:</span><span><?= $registro['apellido_materno'] ?></span></div>
        <?php } ?>
        <div class="fila"><span class="label">Teléfono:</span><span><?= $registro['telefono'] ?></span></div>
        <div class="fila"><span class="label">Correo:</span><span><?= $registro['correo'] ?></span></div>
        <div class="fila"><span class="label">Dirección:</span><span><?= $registro['direccion'] ?></span></div>
        <form action="inicio.php?pagina=cuenta" method="post">
            <input type="hidden" name="editar" value="1"> <br>
            <button type="submit" class="editar">Editar Datos</button>
        </form>
    </div>
</div>
<?php } 

if ($registros == NULL) { ?>
    <div class="modal-contenido">
        <h2>Registro de Datos de la Cuenta</h2>
        <p>Favor de llenar los datos para completar su cuenta.</p>
        <form action="inicio.php?pagina=cuenta" method="post">
            <input type="hidden" name="confirmarRegistro" value="1">
            <label for="nombres">Nombre(s):</label>
            <input type="text" name="nombres" required> <br>

            <label for="apellido_paterno">Apellido Paterno:</label>
            <input type="text" name="apellido_paterno" required> <br>

            <label for="apellido_materno">Apellido Materno:</label>
            <input type="text" name="apellido_materno"> <br>

            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" required> <br>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" required> <br>

            <label for="direccion">Dirección:</label>
            <textarea name="direccion" required></textarea> <br>
            <button type="submit">Guardar</button>
        </form>
    </div>
<?php } 

if (isset($_POST['editar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Edición de Datos de la Cuenta</h2>
    <form action="inicio.php?pagina=cuenta" method="post">
        <input type="hidden" name="confirmar" value="1">
        <label for="nombres">Nombre(s):</label>
        <input type="text" name="nombres" value="<?= $datosDueño['nombres'] ?>" required> <br>

        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" value="<?= $datosDueño['apellido_paterno'] ?>" required> <br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" value="<?= $datosDueño['apellido_materno'] ?>"> <br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" value="<?= $datosDueño['telefono'] ?>" required> <br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?= $datosDueño['correo'] ?>" required> <br>

        <label for="direccion">Dirección:</label>
        <textarea name="direccion" required><?= $datosDueño['direccion'] ?></textarea> <br>
        <button type="submit">Guardar</button>
    </form>
  </div>
</div>
<?php } 

if (isset($_SESSION['editado']) && $_SESSION['editado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de Cuenta Actualizados!</h2>
            <p>Se han actualizado correctamente los datos de su cuenta.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=cuenta';
        }
    </script>
<?php 
    unset($_SESSION['editado']); 
}

if (isset($_SESSION['creado']) && $_SESSION['creado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de Cuenta Guardados!</h2>
            <p>Su cuenta se creado exitosamente.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
        }
    </script>
<?php 
        unset($_SESSION['creado']); 
    }
?>

<script>
    function abrirFormulario(idAnimal) {
        document.getElementById('formularioModal').style.display = 'block';
    }

    function cerrarFormulario() {
        document.getElementById('formularioModal').style.display = 'none';
    }

    function enviarFormulario() {
        cerrarFormulario();
        return true;
    }
</script>