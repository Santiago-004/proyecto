<style>
    .solicitud {
        background-color: #eef0ff;
        border-left: 6px solid #1c1883;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
        position: relative;
    }

    .solicitud-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 5px;
    }

    .solicitud-header h3 {
        margin: 0;
        font-size: 16px;
        color: #1c1883;
    }

    .solicitud-fecha {
        font-size: 13px;
        color: #666;
    }

    .solicitud-mensaje {
        font-size: 14px;
        color: #333;
        white-space: pre-wrap;
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
        width: 50%;
        position: relative;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        max-height: 80vh;
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

    .reporte {
        padding: 10px;
        margin-bottom: 10px;
        border-left: 5px solid #1c1883;
        background-color: #f9f9ff;
        border-radius: 6px;
        padding-bottom: 10px;
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

    .modal-contenido input[type="text"],
    .modal-contenido input[type="tel"],
    .modal-contenido input[type="email"],
    .modal-contenido textarea {
        padding: 8px 10px;
        border: 1px solid #bbb;
        border-radius: 8px;
        width: 100%;
        max-width: 100%;
        font-size: 14px;
    }

    .modal-contenido textarea {
        resize: vertical;
        min-height: 60px;
    }

    .btn {
        background-color: #1c1883;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
        display: block;
        margin: 20px auto 0 auto; 
    }

    .btn:hover {
        background-color: #2d27b4;
    }

    .modal-contenido p {
        font-size: 15px;
        margin: 6px 0;
    }

    .btn-confirmar {
        background-color: #218318ff;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
        display: block;
        margin: 20px auto 0 auto; 
    }

    .btn-confirmar:hover {
        background-color: #2cb427ff;
    }

    .btn-cancelar {
        background-color: #b11111ff;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
        display: block;
        margin: 20px auto 0 auto; 
    }

    .btn-cancelar:hover {
        background-color: #d31d1dff;
    }

    .solicitudR {
        background-color: #ffeeeeff;
        border-left: 6px solid #bc1e1eff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
        position: relative;
    }

    .solicitudR-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 5px;
    }

    .solicitudR-header h3 {
        margin: 0;
        font-size: 16px;
        color: #bc1e1eff;
    }

    .solicitudC {
        background-color: #f4ffeeff;
        border-left: 6px solid #48bc1eff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
        position: relative;
    }

    .solicitudC-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 5px;
    }

    .solicitudC-header h3 {
        margin: 0;
        font-size: 16px;
        color: #7dbc1eff;
    }

    .acciones-formularios {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 10px;
    }

    .select-filtro {
        padding: 10px 14px;
        font-size: 15px;
        border: 2px solid #1c1883;
        border-radius: 8px;
        background-color: #eef0ff;
        color: #1c1883;
        margin: 10px 0 20px 0;
        font-weight: bold;
        cursor: pointer;
    }

    .select-filtro:focus {
        outline: none;
        border-color: #2d27b4;
    }

    @media (max-width: 768px) {
        .solicitud-header,
        .solicitudR-header,
        .solicitudC-header {
            flex-direction: column;
            align-items: stretch;
            position: relative;
        }

        .solicitud-fecha {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 13px;
            padding: 5px;
        }

        .solicitud-header h3,
        .solicitudR-header h3,
        .solicitudC-header h3 {
            margin-right: 40%;
        }

        .modal-contenido {
            width: 90%;
            padding: 15px;
        }

        .acciones-formularios {
            flex-direction: column;
            align-items: stretch;
        }

        .acciones-formularios form {
            width: 100%;
        }

        .btn,
        .btn-confirmar,
        .btn-cancelar {
            width: 100%;
            margin: 10px 0 0 0;
            font-size: 14px;
        }

        .select-filtro {
            width: 100%;
            font-size: 14px;
        }

        label[for="filtroEstado"] {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .modal-contenido form {
            gap: 6px;
        }

        .modal-contenido input[type="text"],
        .modal-contenido input[type="tel"],
        .modal-contenido input[type="email"],
        .modal-contenido textarea {
            font-size: 13px;
            padding: 7px 9px;
        }

        .modal-contenido p {
            font-size: 13px;
        }

        .modal-contenido h2 {
            padding: 0% 10% 0% 10%;
        }
    }
</style>
<br>
<label for="filtroEstado" style="font-weight: bold; color: #1c1883; font-size: 20px;"><strong>Filtrar por estado:</strong></label>
<select id="filtroEstado" onchange="filtrarSolicitudes()" class="select-filtro">
    <option value="pendiente" selected>Pendientes</option>
    <option value="confirmado">Confirmados</option>
    <option value="cancelado">Cancelados</option>
</select>

<?php foreach ($registros as $registro) { 
    if($registro['estado'] == 'pendiente') {
        $fecha = new DateTime($registro['fecha_solicitud']); ?>
        <div class="solicitud">
            <div class="solicitud-header">
                <h3>Solicitud de Devolución de "<?= $registro['nombre_animal'] ?>"</h3>
                <span class="solicitud-fecha">
                    <?= $fecha->format('d/m/Y') ?> · <?= $fecha->format('H:i') ?>
                </span>
            </div>
            <div class="solicitud-mensaje">
        El usuario <b><?= $registro['nombre_dueño'] ?></b> ha enviado una solicitud para devolver al animal <b>"<?= $registro['nombre_animal'] ?>"</b>.
            </div>
            <div class="acciones-formularios">
                <form action="inicio.php?pagina=devolucion" method="post">
                    <input type="hidden" name="usuario" value="<?= $registro['idD']; ?>">
                    <button type="submit" class="btn">Ver Datos del Usuario</button>
                </form>
                <form action="inicio.php?pagina=devolucion" method="post">
                    <input type="hidden" name="animal" value="<?= $registro['idA']; ?>">
                    <button type="submit" class="btn">Ver Datos del Animal</button>
                </form>
                <form action="inicio.php?pagina=devolucion" method="post">
                    <input type="hidden" name="idDueñoAnimal" value="<?= $registro['idDA']; ?>">
                    <input type="hidden" name="idAnimal" value="<?= $registro['idA']; ?>">
                    <input type="hidden" name="idUsuario" value="<?= $registro['idU']; ?>">
                    <input type="hidden" name="nombreA" value="<?= $registro['nombre_animal']; ?>">
                    <input type="hidden" name="confirmado" value="<?= $registro['id_devolucion']; ?>">
                    <button type="submit" class="btn-confirmar">Confirmar Devolución</button>
                </form>
                <form action="inicio.php?pagina=devolucion" method="post">
                    <input type="hidden" name="idUsuario" value="<?= $registro['idU']; ?>">
                    <input type="hidden" name="nombreA" value="<?= $registro['nombre_animal']; ?>">
                    <input type="hidden" name="cancelado" value="<?= $registro['id_devolucion']; ?>">
                    <button type="submit" class="btn-cancelar">Cancelar Devolución</button>
                </form>
            </div>
        </div>
<?php } 
} 

foreach ($registros as $registro) { 
    if($registro['estado'] == 'cancelado') {
        $fecha = new DateTime($registro['fecha_solicitud']); ?>
        <div class="solicitudR">
            <div class="solicitudR-header">
                <h3>Devolución Cancelada</h3>
                <span class="solicitud-fecha">
                    <?= $fecha->format('d/m/Y') ?> · <?= $fecha->format('H:i') ?>
                </span>
            </div>
            <div class="solicitud-mensaje">
        Se canceló la solicitud de devolución del animal <b>"<?= $registro['nombre_animal'] ?>"</b> enviada por <b><?= $registro['nombre_dueño'] ?></b>.
            </div>
        </div>
<?php } 
} 

foreach ($registros as $registro) { 
    if($registro['estado'] == 'confirmado') {
        $fecha = new DateTime($registro['fecha_solicitud']); ?>
        <div class="solicitudC">
            <div class="solicitudC-header">
                <h3>Devolución Confirmada</h3>
                <span class="solicitud-fecha">
                    <?= $fecha->format('d/m/Y') ?> · <?= $fecha->format('H:i') ?>
                </span>
            </div>
            <div class="solicitud-mensaje">
        Se confirmó la devolución del animal <b>"<?= $registro['nombre_animal'] ?>"</b> realizada por <b><?= $registro['nombre_dueño'] ?></b>.
            </div>
        </div>
<?php } 
} 

if(isset($_POST['usuario']) && $usuarios != NULL){ ?>
    <div id="modalUsuario" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalUsuario')">&times;</span>
            <h2>Datos del Usuario</h2>
            <?php foreach ($usuarios as $registro){ ?>
                <div class="reporte">
                    <p><strong>Nombre de Usuario:</strong> <?= $registro['nombre_usuario'] ?></p>
                    <p><strong>Nombre(s):</strong> <?= $registro['nombres'] ?></p>
                    <p><strong>Apellido Paterno:</strong> <?= $registro['apellido_paterno'] ?></p>
                    <?php if($registro['apellido_materno'] != NULL) { ?> 
                        <p><strong>Apellido Materno:</strong> <?= $registro['apellido_materno'] ?></p>
                    <?php } ?> 
                    <p><strong>Teléfono:</strong> <?= $registro['telefono'] ?></p>
                    <p><strong>Correo:</strong> <?= $registro['correo'] ?></p>
                    <p><strong>Dirección:</strong> <?= $registro['direccion'] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php if(isset($_POST['animal']) && $animales != NULL){ ?>
    <div id="modalAnimal" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalAnimal')">&times;</span>
            <h2>Datos del Animal</h2>
            <?php foreach ($animales as $registro){ ?>
                <div class="reporte">
                    <p><strong>Nombre:</strong> <?= $registro['nombre'] ?></p>
                    <p><strong>Especie:</strong> <?= $registro['especie'] ?></p>
                    <p><strong>Raza:</strong> <?= $registro['raza'] ?></p>
                    <p><strong>Sexo:</strong> <?= $registro['sexo'] ?></p>
                    <?php $fecha = new DateTime($registro['fecha_nacimiento']); ?>
                    <p><strong>Fecha de Nacimiento:</strong> <?= $fecha->format('d/m/Y') ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php if(isset($_POST['confirmado'])){ ?>
    <div id="modalConfirmado" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalConfirmado')">&times;</span>
            <h2>Confirmación de la devolución.</h2>
            <p>Se ha confirmado la devolución.</p>
        </div>
    </div>
<?php } ?>

<?php if(isset($_POST['cancelado'])){ ?>
    <div id="modalCancelado" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('modalCancelado')">&times;</span>
            <h2>Cancelación de la devolución.</h2>
            <p>Se ha cancelado la devolución.</p>
        </div>
    </div>
<?php } ?>

<script>
    function cerrarModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
        filtrarSolicitudes(); 
    });

    function filtrarSolicitudes() {
        const estadoSeleccionado = document.getElementById('filtroEstado').value;
        const pendientes = document.querySelectorAll('.solicitud');
        const confirmadas = document.querySelectorAll('.solicitudC');
        const canceladas = document.querySelectorAll('.solicitudR');

        function mostrar(lista, mostrar) {
            lista.forEach(item => {
                item.style.display = mostrar ? 'block' : 'none';
            });
        }

        mostrar(pendientes, estadoSeleccionado === 'pendiente');
        mostrar(confirmadas, estadoSeleccionado === 'confirmado');
        mostrar(canceladas, estadoSeleccionado === 'cancelado');
    }
</script>