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

    .formulario-busqueda select {
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
    <input type="hidden" name="pagina" value="animal">
    <label for="">Especie del Animal:</label>
    <select name="txtbuscar" id="">
        <option value="">Todos</option>
        <option value="Ave" <?php if ($txtbuscar == 'Ave') { echo 'selected';} ?>>Ave</option>
        <option value="Gato" <?php if ($txtbuscar == 'Gato') { echo 'selected';} ?>>Gato</option>
        <option value="Perro" <?php if ($txtbuscar == 'Perro') { echo 'selected';} ?>>Perro</option>
        <option value="Pez" <?php if ($txtbuscar == 'Pez') { echo 'selected';} ?>>Pez</option>
        <option value="Reptil" <?php if ($txtbuscar == 'Reptil') { echo 'selected';} ?>>Reptil</option>
    </select>
    <input type="submit" value="" name="btnbuscar"  id="btnBuscar" width=30px height=40px>
</form>

<?php if($registros == NULL) { ?>
    <h1>No hay animales de compañía disponibles por el momento.</h1>
<?php } ?>

<?php if($registros != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th>Nombre de Animal</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th>Historial de Vacunas</th>
                <th>Historial de Consultas</th>
                <th>Historial de Procedimientos</th>
                <th>Adopción</th>
            </tr>
            
            <?php foreach ($registros as $registro) { ?>
                <?php if($registro['vivo'] == 'S') { ?>
                    <tr>
                        <td><?php echo $registro['nombre']; ?></td>
                        <td><?php echo $registro['especie']; ?></td>
                        <td><?php echo $registro['raza']; ?></td>
                        <?php $fechaNacimiento = new DateTime($registro['fecha_nacimiento']); ?>
                        <td><?php echo $fechaNacimiento->format('d/m/Y') ?></td>
                        <td><?php echo $registro['sexo']; ?></td>
                        <td>
                            <form action="inicio.php?pagina=animal" method="post" style="display:inline;">
                                <input type="hidden" name="animal" value="<?= $registro['id']; ?>">
                                <button type="submit" class="btn">Ver Vacunas</button>
                            </form>
                        </td>
                        <td>
                            <form action="inicio.php?pagina=animal" method="post" style="display:inline;">
                                <input type="hidden" name="animalc" value="<?= $registro['id']; ?>">
                                <button type="submit" class="btn">Ver Consultas</button>
                            </form>
                        </td>
                        <td>
                            <form action="inicio.php?pagina=animal" method="post" style="display:inline;">
                                <input type="hidden" name="animalp" value="<?= $registro['id']; ?>">
                                <button type="submit" class="btn">Ver Procedimientos</button>
                            </form>
                        </td>
                        <?php if($registro['estado'] == NULL || ($registro['estado'] == 'cancelado' && $registro['id_usuario'] != $_SESSION['id_usuario'])) { ?>
                            <td>
                                <form action="inicio.php?pagina=animal" method="post" style="display:inline;">
                                    <input type="hidden" name="id_animal" value="<?= $registro['id']; ?>">
                                    <input type="hidden" name="nombre" value="<?= $registro['nombre']; ?>">
                                    <input type="hidden" name="adoptar" value="1">
                                    <button type="submit" class="btn">Adoptar</button>
                                </form>
                            </td>
                        <?php } ?>
                        <?php if($registro['estado'] == 'pendiente') { ?>
                            <td>
                                <em>En Proceso</em>
                            </td>
                        <?php } ?>
                        <?php if($registro['estado'] == 'cancelado' && $registro['id_usuario'] == $_SESSION['id_usuario']) { ?>
                            <td>
                                <em class="cancelado">Cancelado</em>
                            </td>
                        <?php } ?>
                    </tr> 
                <?php } ?>
            <?php } ?>
        </table> 
    </div>
<?php } ?>
<br>

<?php if(isset($_POST['animal']) && $vacunaciones != NULL){ ?>
    <div id="modalVacunas" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalVacunas')">&times;</span>
            <h2>Historial de Vacunación</h2>
            <?php foreach ($vacunaciones as $registro){ ?>
                <div class="reporte">
                    <?php $fechaAplicacion = new DateTime($registro['fecha_aplicacion']); ?>
                    <p><strong>Fecha de Aplicación:</strong> <?= $fechaAplicacion->format('d/m/Y') ?></p>
                    <p><strong>Vacuna:</strong> <?= $registro['nombre_vacuna'] ?></p>
                    <p><strong>Descripción:</strong> <?= $registro['descripcion'] ?></p>
                    <?php if($registro['fecha_proxima'] != NULL) {
                        $fechaProxima = new DateTime($registro['fecha_proxima']);
                    ?>
                        <p><strong>Fecha de la Próxima Vacunación:</strong> <?= $fechaProxima->format('d/m/Y') ?></p>
                    <?php } ?>
                    <hr>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } 

if(isset($_POST['animal']) && $vacunaciones == NULL){ ?>
    <div id="modalVacunas" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalVacunas')">&times;</span>
            <h2>No hay registros de vacunas de este animal.</h2>
        </div>
    </div>
<?php } 

if(isset($_POST['animalc']) && $consultas != NULL) { ?>
    <div id="modalConsultas" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalConsultas')">&times;</span>
            <h2>Historial de Consultas</h2>
            <?php foreach ($consultas as $registro) {?>
                <div class="reporte">
                    <?php
                        $fecha = new DateTime($registro['fecha']);
                    ?>
                    <p><strong>Fecha de la Consulta:</strong> <?= $fecha->format('d/m/Y') ?></p>
                    <p><strong>Hora de la Consulta:</strong> <?= $fecha->format('H:i') ?></p>
                    <p><strong>Motivo:</strong> <?= $registro['motivo'] ?></p>
                    <p><strong>Diagnóstico:</strong> <?= $registro['diagnostico'] ?></p>
                    <p><strong>Tratamiento:</strong> <?= $registro['tratamiento'] ?></p>
                    <?php if($registro['notas'] != NULL) { ?><p><strong>Notas:</strong> <?= $registro['notas'] ?></p><?php } ?>
                    <?php if($registro['fecha_proxima'] != NULL) {
                        $fechaProxima = new DateTime($registro['fecha_proxima']);
                    ?>
                        <p><strong>Fecha y Hora de la Próxima Consulta:</strong> <?= $fechaProxima->format('d/m/Y') ?> <?= $fechaProxima->format('H:i') ?></p>
                    <?php } ?>
                    <hr>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } 

if(isset($_POST['animalc']) && $consultas == NULL){ ?>
    <div id="modalConsultas" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalConsultas')">&times;</span>
            <h2>No hay registros de consultas de este animal.</h2>
        </div>
    </div>
<?php } 

if(isset($_POST['animalp']) && $procedimientos != NULL){ ?>
    <div id="modalProcedimientos" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalProcedimientos')">&times;</span>
            <h2>Historial de Procedimientos</h2>
            <?php foreach ($procedimientos as $registro) {?>
                <div class="reporte">
                    <?php $fecha = new DateTime($registro['fecha']); ?>
                    <p><strong>Fecha del Procedimiento:</strong> <?= $fecha->format('d/m/Y') ?></p>
                    <p><strong>Hora:</strong> <?= $fecha->format('H:i') ?></p>
                    <p><strong>Tipo:</strong> <?= $registro['tipo'] ?></p>
                    <?php if($registro['notas'] != NULL) { ?><p><strong>Notas:</strong> <?= $registro['notas'] ?></p><?php } ?>
                    <?php if($registro['fecha_proxima'] != NULL) {
                        $fechaProxima = new DateTime($registro['fecha_proxima']);
                    ?>
                        <p><strong>Fecha y Hora del Próximo Procedimiento:</strong> <?= $fechaProxima->format('d/m/Y') ?> <?= $fechaProxima->format('H:i') ?></p>
                    <?php } ?>
                    <hr>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } 

if(isset($_POST['animalp']) && $procedimientos == NULL){ ?>
    <div id="modalProcedimientos" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalProcedimientos')">&times;</span>
            <h2>No hay registros de procedimientos de este animal.</h2>
        </div>
    </div>
<?php }

if (isset($_POST['adoptar'])): ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>

    <?php if ($mostrarFormularioDueño): ?>
        <h2>Registro de Datos</h2>
        <p>Registre sus datos para completar la solicitud para la adopción.</p>
        <form action="inicio.php?pagina=animal" method="post">
            <input type="hidden" name="id_animal" value="<?= $id_animal ?>">
            <input type="hidden" name="nombre" value="<?= $nombre ?>">
            <input type="hidden" name="confirmar" value="1">
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

    <?php else: ?>
        <h2>Confirmar Adopción</h2>
        <p>Verifique sus datos para completar la adopción.</p>
        <p><strong>Nombre:</strong> <?= $datosDueño['nombres'] ?> <?= $datosDueño['apellido_paterno'] ?> <?= $datosDueño['apellido_materno'] ?></p>
        <p><strong>Teléfono:</strong> <?= $datosDueño['telefono'] ?></p>
        <p><strong>Correo:</strong> <?= $datosDueño['correo'] ?></p>
        <p><strong>Dirección:</strong> <?= $datosDueño['direccion'] ?></p>

        <form action="inicio.php?pagina=animal" method="post">
            <input type="hidden" name="id_dueño" value="<?= $datosDueño['id_dueño'] ?>">
            <input type="hidden" name="id_animal" value="<?= $id_animal ?>">
            <input type="hidden" name="nombre" value="<?= $nombre ?>">
            <input type="hidden" name="confirmar" value="1">
            <button type="submit">Confirmar Adopción</button>
        </form>
    <?php endif; ?>
  </div>
</div>
<?php endif; 

if (isset($_SESSION['solicitud_enviada']) && $_SESSION['solicitud_enviada'] === true): ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Solicitud enviada!</h2>
            <p>Se ha mandado correctamente su solicitud de adopción.<br>
               Favor de esperar una respuesta sobre su solicitud.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=animal';
        }
    </script>
<?php unset($_SESSION['solicitud_enviada']); endif; ?>

<script>
    function abrirFormulario(idAnimal) {
        document.getElementById('formularioModal').style.display = 'block';
        document.getElementById('id_animal').value = idAnimal;
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

