<style>
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

    .formulario-busqueda input[type="text"] {
        padding: 8px;
        border: 1px solid #bbb;
        border-radius: 8px;
        max-width: 300px;
        flex: 1 1 auto;
    }

    #btnBuscar {
        background-image: url('./img/buscar.png');
        background-size: cover;
        width: 25px;
        height: 25px;
        border: none;
        cursor: pointer;
        white-space: nowrap;
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

    .btn, .insertar {
        background-color: #1c1883;
    }

    .btn:hover, .insertar:hover {
        background-color: #2d27b4;
    }

    .editar {
        background-color: #188323ff;
    }

    .editar:hover {
        background-color: #27b440;
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
    .modal-contenido input[type="text"],
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

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
<form action="" method="post" class="formulario-busqueda">
    <input type="hidden" name="pagina" value="dueño">
    <label for="">Nombre del Dueño:</label>
    <input type="text" name="txtbuscar" id="" value="<?php echo $txtbuscar; ?>" >
    <input type="submit" value="" name="btnbuscar"  id="btnBuscar" width=30px height=40px>
</form>
<form action="inicio.php?pagina=dueño" method="post">
    <input type="hidden" name="insertar" value="1">
    <button type="submit" class="insertar">Insertar</button>
</form>

<?php if($registros == NULL) { ?>
    <h1>No hay dueños registrados por el momento.</h1>
<?php } ?>

<?php if($registros != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th>ID</th>
                <th>Nombre(s)</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Usuario</th>
                <th></th>
                <th></th>
            </tr>
            
            <?php foreach ($registros as $registro) { ?>
                <tr>
                    <td><?php echo $registro['id_dueño']; ?></td>
                    <td><?php echo $registro['nombres']; ?></td>
                    <td><?php echo $registro['apellido_paterno']; ?></td>
                    <td><?php echo $registro['apellido_materno']; ?></td>
                    <td><?php echo $registro['telefono']; ?></td>
                    <td><?php echo $registro['correo']; ?></td>
                    <td><?php echo $registro['direccion']; ?></td>
                    <td><?php echo $registro['nombre_usuario']; ?></td>
                    <td>
                        <form action="inicio.php?pagina=dueño" method="post" style="display:inline;">
                            <input type="hidden" name="editar" value="<?= $registro['id_dueño']; ?>">
                            <button type="submit" class="editar">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form action="inicio.php?pagina=dueño" method="post" style="display:inline;">
                            <input type="hidden" name="eliminar" value="<?= $registro['id_dueño']; ?>">
                            <button type="submit" class="eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr> 
            <?php } ?>
        </table> 
    </div> 
<?php } ?>
<br>

<?php if (isset($_POST['insertar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Inserción de Datos de un Dueño</h2>
    <form action="inicio.php?pagina=dueño" method="post">
        <input type="hidden" name="confirmarI" value="1">
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

        <label for="id_usuario">Usuario:</label>
        <select name="id_usuario" required>
            <option value=""></option>
            <?php foreach ($usuarios as $usuario) { ?>
                <option value="<?= $usuario["id_usuario"] ?>"><?= $usuario["nombre_usuario"] ?></option>
            <?php } ?>
        </select> <br>

        <button type="submit">Guardar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_POST['editar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Edición de Datos del Dueño</h2>
    <form action="inicio.php?pagina=dueño" method="post">
        <input type="hidden" name="confirmarU" value="1">
        <input type="hidden" name="id_dueño" value="<?= $datosDueño['id_dueño'] ?>" required> <br>
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

if (isset($_POST['eliminar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Eliminación de Datos del Dueño</h2>
    <form action="inicio.php?pagina=dueño" method="post">
        <input type="hidden" name="confirmarD" value="1">
        <input type="hidden" name="id_dueño" value="<?= $_POST['eliminar'] ?>" required> <br>
        <p>¿Está seguro de eliminar los datos de este dueño?</p>
        <button type="submit">Confirmar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_SESSION['guardado']) && $_SESSION['guardado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos del Dueño Guardados!</h2>
            <p>Se han guardado correctamente los datos del dueño.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=dueño';
        }
    </script>
<?php 
    unset($_SESSION['guardado']); 
} 

if (isset($_SESSION['editado']) && $_SESSION['editado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos del Dueño Actualizados!</h2>
            <p>Se han actualizado correctamente los datos del dueño.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=dueño';
        }
    </script>
<?php 
    unset($_SESSION['editado']); 
} 

if (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos del Dueño Eliminados!</h2>
            <p>Se han eliminado correctamente los datos del dueño.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=dueño';
        }
    </script>
<?php 
    unset($_SESSION['eliminado']); 
}
?>


<script>
    function abrirFormulario() {
        document.getElementById('formularioModal').style.display = 'block';
    }

    function cerrarFormulario() {
        document.getElementById('formularioModal').style.display = 'none';
    }

    function enviarFormulario() {
        cerrarFormulario();
        return true;
    }

    function cerrarModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>