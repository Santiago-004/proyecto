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
    <input type="hidden" name="pagina" value="vacunacion">
    <label for="">Nombre del Animal:</label>
    <input type="text" name="txtbuscar" value="<?= $txtbuscar; ?>">
    <input type="submit" value="" name="btnbuscar" id="btnBuscar">
</form>

<form action="inicio.php?pagina=vacunacion" method="post">
    <input type="hidden" name="insertar" value="1">
    <button type="submit" class="insertar">Insertar</button>
</form>

<?php if (empty($registros)) { ?>
    <h1>No hay vacunaciones registradas por el momento.</h1>
<?php } else { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Nombre del Dueño</th>
                <th>Nombre del Animal</th>
                <th>Fecha de Vacunación</th>
                <th>Vacuna</th>
                <th>Descripcion</th>
                <th>Fecha de la Próxima Vacunación</th>
                <th></th>
                <th></th>
            </tr>

            <?php foreach ($registros as $registro) { ?>
                <tr>
                    <td><?= $registro['id_vacunacion']; ?></td>
                    <td><?= $registro['nombres'] ? $registro['nombres'] . ' ' . $registro['apellido_paterno'] . ' ' . $registro['apellido_materno'] : 'Sin dueño'; ?></td>
                    <td><?= $registro['nombre']; ?></td>
                    <td><?= (new DateTime($registro['fecha_aplicacion']))->format('d/m/Y'); ?></td>
                    <td>
                        <form action="inicio.php?pagina=vacunacion" method="post" style="display:inline;">
                            <input type="hidden" name="vervacuna" value="<?= $registro['id_vacunacion']; ?>">
                            <button type="submit" class="btn">Ver Vacuna</button>
                        </form>
                    </td>
                    <td>
                        <?php if (!empty($registro['descripcion'])) { ?>
                            <form action="inicio.php?pagina=vacunacion" method="post" style="display:inline;">
                                <input type="hidden" name="verdescripcion" value="<?= $registro['id_vacunacion']; ?>">
                                <button type="submit" class="btn">Ver Descripcion</button>
                            </form>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if (!empty($registro['fecha_proxima'])) {
                            echo (new DateTime($registro['fecha_proxima']))->format('d/m/Y');
                        } ?>
                    </td>
                    <td>
                        <form action="inicio.php?pagina=vacunacion" method="post" style="display:inline;">
                            <input type="hidden" name="editar" value="<?= $registro['id_vacunacion']; ?>">
                            <button type="submit" class="editar">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form action="inicio.php?pagina=vacunacion" method="post" style="display:inline;">
                            <input type="hidden" name="eliminar" value="<?= $registro['id_vacunacion']; ?>">
                            <button type="submit" class="eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>

<?php if (isset($_POST['insertar'])) { ?>
    <div id="formularioModal" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
            <h2>Inserción de Datos de una Vacunación</h2>
            <form action="inicio.php?pagina=vacunacion" method="post">
                <input type="hidden" name="confirmarI" value="1">
                <label>Dueño y Animal:</label>
                <select name="id_dueñoanimal" id="id_dueñoanimal">
                    <option value=""></option>
                    <?php foreach ($duenoanimales as $d) { ?>
                        <option value="<?= $d['id_dueñoanimal'] ?>">Dueño: <?= $d['nombres'] ?> <?= $d['apellido_paterno'] ?> <?= $d['apellido_materno'] ?>, Animal: <?= $d['nombre'] ?></option>
                    <?php } ?>
                </select> <br>

                <label>Animal:</label>
                <select name="id_animal" id="id_animal">
                    <option value=""></option>
                    <?php foreach ($animales as $a) { ?>
                        <option value="<?= $a['id_animal'] ?>"><?= $a['nombre'] ?></option>
                    <?php } ?>
                </select> <br>

                <label>Fecha Vacunación:</label>
                <input type="date" name="fecha_aplicacion" required> <br>

                <label>Tipo de Vacuna:</label>
                <input type="text" name="nombre_vacuna" required> <br>

                <label>Descripción:</label>
                <textarea name="descripcion" required></textarea> <br>

                <label>Fecha de la Próxima Vacunación:</label>
                <input type="date" name="fecha_proxima"> <br>

                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
<?php } 

if (isset($_POST['editar'])) {
    $fecha_aplicacion = !empty($datosVacunacion['fecha_aplicacion']) ? date('Y-m-d', strtotime($datosVacunacion['fecha_aplicacion'])) : '';
    $fecha_proxima = !empty($datosVacunacion['fecha_proxima']) ? date('Y-m-d', strtotime($datosVacunacion['fecha_proxima'])) : '';
?>
    <div id="formularioModal" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
            <h2>Edición de Datos de la Vacunación</h2>
            <form action="inicio.php?pagina=vacunacion" method="post">
                <input type="hidden" name="confirmarU" value="1">
                <input type="hidden" name="id_vacunacion" value="<?= $datosVacunacion['id_vacunacion'] ?>">
                <input type="hidden" name="idUsuario" value="<?= $datosVacunacion['idUsuario'] ?>">
                <input type="hidden" name="fechaAnterior" value="<?= $datosVacunacion['fecha_proxima'] ?>">
                <input type="hidden" name="nombre" value="<?= $datosVacunacion['nombre'] ?>">
                <label>Fecha de Vacunación:</label>
                <input type="date" name="fecha_aplicacion" value="<?= $fecha_aplicacion ?>" required> <br>

                <label>Tipo de Vacuna:</label>
                <input type="text" name="nombre_vacuna" value="<?= $datosVacunacion['nombre_vacuna'] ?>" required> <br>

                <label>Descripción:</label>
                <textarea name="descripcion" required><?= $datosVacunacion['descripcion'] ?></textarea> <br>

                <label>Fecha Próxima Vacunación:</label>
                <input type="date" name="fecha_proxima" value="<?= $fecha_proxima ?>"> <br>

                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
<?php } 

if (isset($_POST['eliminar'])) { ?>
    <div id="formularioModal" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
            <h2>Eliminación de Datos de la Vacunación</h2>
            <form action="inicio.php?pagina=vacunacion" method="post">
                <input type="hidden" name="confirmarD" value="1">
                <input type="hidden" name="id_vacunacion" value="<?= $_POST['eliminar'] ?>">
                <p>¿Está seguro de eliminar los datos de esta vacunación?</p>
                <button type="submit">Confirmar</button>
            </form>
        </div>
    </div>
<?php } 

if (isset($_POST['vervacuna']) && isset($vacuna)) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Tipo de Vacuna</h2>
    <textarea readonly><?= $vacuna['nombre_vacuna'] ?? '' ?></textarea>
  </div>
</div>
<?php } 

if (isset($_POST['verdescripcion']) && isset($descripcion)) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Descripción</h2>
    <textarea readonly><?= $descripcion['descripcion'] ?? '' ?></textarea>
  </div>
</div>
<?php } 

if (isset($_SESSION['guardado']) && $_SESSION['guardado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de la Vacunación Guardados!</h2>
            <p>Se han guardado correctamente los datos de la vacunación.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=vacunacion';
        }
    </script>
<?php unset($_SESSION['guardado']); } 
 
if (isset($_SESSION['editado']) && $_SESSION['editado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de la Vacunación Actualizados!</h2>
            <p>Se han actualizado correctamente los datos de la vacunación.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=vacunacion';
        }
    </script>
<?php unset($_SESSION['editado']); } 

if (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos de la Vacunación Eliminados!</h2>
            <p>Se han eliminado correctamente los datos de la vacunación.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=vacunacion';
        }
    </script>
<?php unset($_SESSION['eliminado']); } ?>

<script>
    function cerrarFormulario() {
        document.getElementById('formularioModal').style.display = 'none';
    }

    const selectDuenoAnimal = document.getElementById('id_dueñoanimal');
    const selectAnimal = document.getElementById('id_animal');

    selectDuenoAnimal.addEventListener('change', function () {
        if (this.value !== '') selectAnimal.value = '';
    });

    selectAnimal.addEventListener('change', function () {
        if (this.value !== '') selectDuenoAnimal.value = '';
    });
</script>
