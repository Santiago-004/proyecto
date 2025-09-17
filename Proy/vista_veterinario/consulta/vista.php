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
        color: white;
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

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
<form action="" method="post" class="formulario-busqueda">
    <input type="hidden" name="pagina" value="consulta">
    <label for="">Nombre del Animal:</label>
    <input type="text" name="txtbuscar" value="<?php echo $txtbuscar; ?>" >
    <input type="submit" value="" name="btnbuscar"  id="btnBuscar" width=30px height=40px>
</form>

<form action="inicio.php?pagina=consulta" method="post">
    <input type="hidden" name="insertar" value="1">
    <button type="submit" class="insertar">Insertar</button>
</form>

<?php if($registros == NULL) { ?>
    <h1>No hay consultas registradas por el momento.</h1>
<?php } ?>

<?php if($registros != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th>ID</th>
                <th>Nombre del Dueño</th>
                <th>Nombre del Animal</th>
                <th>Fecha y Hora de la Consulta</th>
                <th>Motivo</th>
                <th>Diagnóstico</th>
                <th>Tratamiento</th>
                <th>Notas</th>
                <th>Fecha y Hora de la Próxima Consulta</th>
                <th></th>
                <th></th>
            </tr>
            
            <?php foreach ($registros as $registro) { ?>
            <tr>
                <td><?php echo $registro['id_consulta']; ?></td>
                <?php if($registro['nombres'] != NULL) {?><td><?php echo $registro['nombres']; ?> <?php echo $registro['apellido_paterno']; ?> <?php echo $registro['apellido_materno']; ?> <?php echo $registro['apellido_paterno']; ?> </td><?php } ?>
                <?php if($registro['nombres'] == NULL) {?><td>Sin dueño</td><?php } ?>
                <td><?php echo $registro['nombre']; ?></td>
                <td><?php $fechaConsulta = new DateTime($registro['fecha_consulta']); echo $fechaConsulta->format('d/m/Y - H:i');?></td>
                <td>
                    <form action="inicio.php?pagina=consulta" method="post" style="display:inline;">
                        <input type="hidden" name="vermotivo" value="<?= $registro['id_consulta']; ?>">
                        <button type="submit" class="btn">Ver Motivo</button>
                    </form>
                </td>
                <td>
                    <form action="inicio.php?pagina=consulta" method="post" style="display:inline;">
                        <input type="hidden" name="verdiagnostico" value="<?= $registro['id_consulta']; ?>">
                        <button type="submit" class="btn">Ver Diagnóstico</button>
                    </form>
                </td>
                <td>
                    <form action="inicio.php?pagina=consulta" method="post" style="display:inline;">
                        <input type="hidden" name="vertratamiento" value="<?= $registro['id_consulta']; ?>">
                        <button type="submit" class="btn">Ver Tratamiento</button>
                    </form>
                </td>
                <td>
                    <?php if($registro['notas'] != NULL) { ?>
                        <form action="inicio.php?pagina=consulta" method="post" style="display:inline;">
                            <input type="hidden" name="vernotas" value="<?= $registro['id_consulta']; ?>">
                            <button type="submit" class="btn">Ver Notas</button>
                        </form>
                    <?php } ?>
                </td>
                <td><?php if($registro['fecha_proxima'] != NULL) { $fechaConsulta = new DateTime($registro['fecha_proxima']); echo $fechaConsulta->format('d/m/Y - H:i'); } ?></td>
                <td>
                    <form action="inicio.php?pagina=consulta" method="post" style="display:inline;">
                        <input type="hidden" name="editar" value="<?= $registro['id_consulta']; ?>">
                        <button type="submit" class="editar">Editar</button>
                    </form>
                </td>
                <td>
                    <form action="inicio.php?pagina=consulta" method="post" style="display:inline;">
                        <input type="hidden" name="eliminar" value="<?= $registro['id_consulta']; ?>">
                        <button type="submit" class="eliminar">Eliminar</button>
                    </form>
                </td>
            </tr> 
            <?php } ?>
        </table> 
    </div> 
<?php }

if (isset($_POST['insertar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Inserción de Datos de una Consulta</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <input type="hidden" name="confirmarI" value="1">
        <label for="id_dueñoanimal">Dueño y animal:</label>
        <select name="id_dueñoanimal" id="id_dueñoanimal">
            <option value=""></option>
            <?php foreach ($duenoanimales as $duenoanimal) { ?>
                <option value="<?= $duenoanimal["id_dueñoanimal"] ?>">Dueño: <?= $duenoanimal["nombres"] ?> <?= $duenoanimal["apellido_paterno"] ?> <?= $duenoanimal["apellido_materno"] ?>, Animal: <?= $duenoanimal["nombre"] ?></option>
            <?php } ?>
        </select> <br> <br>

        <label for="id_animal">Animal:</label>
        <select name="id_animal" id="id_animal">
            <option value=""></option>
            <?php foreach ($animales as $animal) { ?>
                <option value="<?= $animal["id_animal"] ?>"> <?= $animal["nombre"] ?></option>
            <?php } ?>
        </select> <br> <br>

        <label for="fecha">Fecha y Hora de Consulta:</label>
        <input type="datetime-local" name="fecha" required> <br>

        <label for="motivo">Motivo:</label>
        <textarea name="motivo" required></textarea> <br>

        <label for="diagnostico">Diagnóstico:</label>
        <textarea name="diagnostico" required></textarea> <br>

        <label for="tratamiento">Tratamiento:</label>
        <textarea name="tratamiento" required></textarea> <br>

        <label for="notas">Notas:</label>
        <textarea name="notas"></textarea> <br>

        <label for="fecha_proxima">Fecha y Hora de la Próxima Consulta:</label>
        <input type="datetime-local" name="fecha_proxima"> <br>

        <button type="submit">Guardar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_POST['editar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Edición de Datos de la Consulta</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <input type="hidden" name="confirmarU" value="1">
        <input type="hidden" name="id_consulta" value="<?= $datosConsulta['id_consulta'] ?>" required>
        <input type="hidden" name="idUsuario" value="<?= $datosConsulta['idUsuario'] ?>">
        <input type="hidden" name="fechaAnterior" value="<?= $datosConsulta['fecha_proxima'] ?>">
        <input type="hidden" name="nombre" value="<?= $datosConsulta['nombre'] ?>">
        <label for="fecha">Fecha y Hora de Consulta:</label>
        <input type="datetime-local" name="fecha" value="<?= $datosConsulta['fechaConsulta'] ?>" required> <br>

        <label for="motivo">Motivo:</label>
        <textarea name="motivo" required><?= $datosConsulta['motivo'] ?></textarea> <br>

        <label for="diagnostico">Diagnóstico:</label>
        <textarea name="diagnostico" required><?= $datosConsulta['diagnostico'] ?></textarea> <br>

        <label for="tratamiento">Tratamiento:</label>
        <textarea name="tratamiento" required><?= $datosConsulta['tratamiento'] ?></textarea> <br>

        <label for="notas">Notas:</label>
        <textarea name="notas"><?= $datosConsulta['notas'] ?></textarea> <br>

        <label for="fecha_proxima">Fecha y Hora de la Próxima Consulta:</label>
        <input type="datetime-local" name="fecha_proxima" value="<?= $datosConsulta['fecha_proxima'] ?>"> <br>

        <button type="submit">Guardar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_POST['eliminar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Eliminación de Datos de la Consulta</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <input type="hidden" name="idUsuario" value="<?= $datosConsulta['idUsuario'] ?>">
        <input type="hidden" name="fechaProximaEliminar" value="<?= $datosConsulta['fecha_proxima'] ?>">
        <input type="hidden" name="confirmarD" value="1">
        <input type="hidden" name="id_consulta" value="<?= $_POST['eliminar'] ?>" required>
        <p>¿Está seguro de eliminar los datos de esta consulta?</p>
        <button type="submit">Confirmar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_SESSION['guardado']) && $_SESSION['guardado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de la Consulta Guardados!</h2>
            <p>Se han guardado correctamente los datos de la consulta.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=consulta';
        }
    </script>
<?php 
    unset($_SESSION['guardado']); 
} 

if (isset($_SESSION['editado']) && $_SESSION['editado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de la Consulta Actualizados!</h2>
            <p>Se han actualizado correctamente los datos de la consulta.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=consulta';
        }
    </script>
<?php 
    unset($_SESSION['editado']); 
} 

if (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de la Consulta Eliminados!</h2>
            <p>Se han eliminado correctamente los datos de la consulta.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=consulta';
        }
    </script>
<?php 
    unset($_SESSION['eliminado']); 
}

if (isset($_POST['vermotivo'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Motivo de la Consulta</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <textarea name="" id="" readonly><?= $motivo['motivo'] ?></textarea>
    </form>
  </div>
</div>
<?php } 

if (isset($_POST['verdiagnostico'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Diagnóstico</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <textarea name="" id="" readonly><?= $diagnostico['diagnostico'] ?></textarea>
    </form>
  </div>
</div>
<?php }

if (isset($_POST['vertratamiento'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Tratamiento</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <textarea name="" id="" readonly><?= $tratamiento['tratamiento'] ?></textarea>
    </form>
  </div>
</div>
<?php }

if (isset($_POST['vernotas'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Notas de la Consulta</h2>
    <form action="inicio.php?pagina=consulta" method="post">
        <textarea name="" id="" readonly><?= $notas['notas'] ?></textarea>
    </form>
  </div>
</div>
<?php } ?>

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

    const selectDuenoAnimal = document.getElementById('id_dueñoanimal');
    const selectAnimal = document.getElementById('id_animal');

    selectDuenoAnimal.addEventListener('change', function () {
        if (this.value !== '') {
            selectAnimal.value = '';
        }
    });

    selectAnimal.addEventListener('change', function () {
        if (this.value !== '') {
            selectDuenoAnimal.value = '';
        }
    });
</script>