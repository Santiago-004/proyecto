<style>
    .notificacion {
        background-color: #eef0ff;
        border-left: 6px solid #1c1883;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
        position: relative;
    }

    .notificacion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 5px;
    }

    .notificacion-header h3 {
        margin: 0;
        font-size: 16px;
        color: #1c1883;
    }

    .notificacion-fecha {
        font-size: 13px;
        color: #666;
    }

    .notificacion-mensaje {
        font-size: 14px;
        color: #333;
        white-space: pre-wrap;
    }
</style>

<div class="modal-contenido">
     <br>
    <?php foreach ($registros as $registro) { 
        $fechaActual = new DateTime();
        $fecha = new DateTime($registro['fecha_envio']);
        if($fecha <= $fechaActual) {
    ?>
        <div class="notificacion">
            <div class="notificacion-header">
                <h3><?= $registro['titulo'] ?></h3>
                <span class="notificacion-fecha">
                    <?= $fecha->format('d/m/Y') ?> · <?= $fecha->format('H:i') ?>
                </span>
            </div>
            <div class="notificacion-mensaje">
        <?= $registro['mensaje'] ?>
            </div>
        </div>
    <?php }
    } 
    ?>

    <?php if($registros == NULL) { ?>
        <h1>No hay notificaciones por el momento.</h1>
    <?php } ?>
</div>