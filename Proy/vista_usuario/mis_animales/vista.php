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
    <input type="hidden" name="pagina" value="mis_animales">
    <label for="">Nombre del Animal:</label>
    <input type="text" name="txtbuscar" id="" value="<?php echo $txtbuscar; ?>" >
    <input type="submit" value="" name="btnbuscar"  id="btnBuscar" width=30px height=40px>
</form>
<form action="inicio.php?pagina=mis_animales" method="post">
    <input type="hidden" name="insertar" value="1">
    <button type="submit" class="insertar">Añadir Nuevo Animal de Compañía</button>
</form>
<?php if($registros == NULL) { ?>
    <h1>No has adoptado ningún animal por el momento.</h1>
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
                <th>Devolución</th>
                <th>Editar</th>
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
                            <form action="inicio.php?pagina=mis_animales" method="post" style="display:inline;">
                                <input type="hidden" name="animal" value="<?= $registro['id_animal']; ?>">
                                <button type="submit" class="btn">Ver Vacunas</button>
                            </form>
                        </td>
                        <td>
                            <form action="inicio.php?pagina=mis_animales" method="post" style="display:inline;">
                                <input type="hidden" name="animalc" value="<?= $registro['id_animal']; ?>">
                                <button type="submit" class="btn">Ver Consultas</button>
                            </form>
                        </td>
                        <td>
                            <form action="inicio.php?pagina=mis_animales" method="post" style="display:inline;">
                                <input type="hidden" name="animalp" value="<?= $registro['id_animal']; ?>">
                                <button type="submit" class="btn">Ver Procedimientos</button>
                            </form>
                        </td>
                        <?php if (!in_array($registro['id_dueñoanimal'], $devolucionesExistentes) && $registro['por_usuario'] == 'N') { ?>
                            <td>
                                <form action="inicio.php?pagina=mis_animales" method="post" style="display:inline;">
                                    <input type="hidden" name="id_animal" value="<?= $registro['id_animal']; ?>">
                                    <input type="hidden" name="nombre" value="<?= $registro['nombre']; ?>">
                                    <input type="hidden" name="solicitud" value="1">
                                    <button type="submit" class="btn">Solicitar Devolución</button>
                                </form>
                            </td>
                            <td></td>
                        <?php } 
                        if  (in_array($registro['id_dueñoanimal'], $devolucionesExistentes) && $registro['por_usuario'] == 'N')  { 
                            foreach ($estados as $estado) {
                                if  (($estado['id_dueñoanimal'] == $registro['id_dueñoanimal']) && $estado['estado'] == 'pendiente') { ?>
                                    <td><em class="enviado">Solicitud Enviada</em></td>
                                    <td></td>
                        <?php   } 
                            }      
                        } if  (in_array($registro['id_dueñoanimal'], $devolucionesExistentes) && $registro['por_usuario'] == 'N')  { 
                            foreach ($estados as $estado) {
                                if  (($estado['id_dueñoanimal'] == $registro['id_dueñoanimal']) && $estado['estado'] == 'cancelado') { ?>
                                    <td><em class="cancelado">Solicitud Rechazada</em></td>
                                    <td></td>
                        <?php   } 
                            }      
                        } 
                        if  ($registro['por_usuario'] == 'S')  { ?>
                            <td></td>
                            <td>
                                <form action="inicio.php?pagina=mis_animales" method="post" style="display:inline;">
                                    <input type="hidden" name="editar" value="<?= $registro['id_animal']; ?>">
                                    <button type="submit" class="editar">Editar</button>
                                </form>
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

if (isset($_POST['solicitud'])){
    $id_animal = $_POST['id_animal'];
?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
        <h2>Confirmación de Devolución</h2>
        <p>¿Desea mandar una solicitud para la devolución del animal?</p>
        <form action="inicio.php?pagina=mis_animales" method="post">
            <input type="hidden" name="id_animal" value="<?= $id_animal ?>">
            <input type="hidden" name="nombre" value="<?= $nombre ?>">
            <input type="hidden" name="confirmar" value="1">
            <button type="submit" class="btn">Confirmar</button>
        </form>
  </div>
</div>
<?php } 

if (isset($_SESSION['solicitud_enviada']) && $_SESSION['solicitud_enviada'] === true): ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Solicitud enviada!</h2>
            <p>Se ha mandado correctamente su solicitud de devolución.<br>
               Favor de devolver su animal de compañía.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=mis_animales';
        }
    </script>
<?php unset($_SESSION['solicitud_enviada']); endif; 

if (isset($_POST['insertar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Inserción de Datos de un Animal</h2>
    <form action="inicio.php?pagina=mis_animales" method="post">
        <input type="hidden" name="confirmarI" value="1">
        <label for="nombre">Nombre del Animal:</label>
        <input type="text" name="nombre" required> <br>

        <label for="especie">Especie:</label>
        <select name="especie" required>
            <option value=""></option>
            <option value="Ave">Ave</option>
            <option value="Gato">Gato</option>
            <option value="Perro">Perro</option>
            <option value="Pez">Pez</option>
            <option value="Reptil">Reptil</option>
        </select> <br>

        <label for="raza">Raza:</label>
        <input type="text" name="raza" required> <br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required> <br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value=""></option>
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
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
    <h2>Edición de Datos del Animal</h2>
    <form action="inicio.php?pagina=mis_animales" method="post">
        <input type="hidden" name="confirmarU" value="1">
        <input type="hidden" name="id_animal" value="<?= $datosAnimal['id_animal'] ?>" required> <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $datosAnimal['nombre'] ?>" required> <br>

        <label for="especie">Especie:</label>
        <select name="especie" required>
            <option value=""></option>
            <option value="Ave" <?php if ($datosAnimal['especie'] == 'Ave') { echo 'selected'; } ?>>Ave</option>
            <option value="Gato" <?php if ($datosAnimal['especie'] == 'Gato') { echo 'selected'; } ?>>Gato</option>
            <option value="Perro" <?php if ($datosAnimal['especie'] == 'Perro') { echo 'selected'; } ?>>Perro</option>
            <option value="Pez" <?php if ($datosAnimal['especie'] == 'Pez') { echo 'selected'; } ?>>Pez</option>
            <option value="Reptil" <?php if ($datosAnimal['especie'] == 'Reptil') { echo 'selected'; } ?>>Reptil</option>
        </select> <br>

        <label for="raza">Raza:</label>
        <input type="text" name="raza" value="<?= $datosAnimal['raza'] ?>" required> <br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= $datosAnimal['fecha_nacimiento'] ?>" required> <br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value=""></option>
            <option value="Macho" <?php if ($datosAnimal['sexo'] == 'Macho') echo 'selected'; ?>>Macho</option>
            <option value="Hembra" <?php if ($datosAnimal['sexo'] == 'Hembra') echo 'selected'; ?>>Hembra</option>
        </select> <br>

        <button type="submit">Guardar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_SESSION['guardado']) && $_SESSION['guardado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos del Animal Guardados!</h2>
            <p>Se han guardado correctamente los datos del animal.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=mis_animales';
        }
    </script>
<?php 
    unset($_SESSION['guardado']); 
} 

if (isset($_SESSION['editado']) && $_SESSION['editado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos del Animal Actualizados!</h2>
            <p>Se han actualizado correctamente los datos del animal.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=mis_animales';
        }
    </script>
<?php 
    unset($_SESSION['editado']); 
} ?>

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