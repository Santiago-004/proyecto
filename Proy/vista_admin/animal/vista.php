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

<form action="inicio.php?pagina=animal" method="post">
    <input type="hidden" name="insertar" value="1">
    <button type="submit" class="insertar">Insertar</button>
</form>

<?php if($registros == NULL) { ?>
    <h1>No hay animales de compañía registrados por el momento.</h1>
<?php } ?>

<?php if($registros != NULL) { ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>    
                <th>ID</th>
                <th>Nombre de Animal</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th></th>
                <th></th>
            </tr>
            
            <?php foreach ($registros as $registro) { ?>
                <tr>
                    <td><?php echo $registro['id_animal']; ?></td>
                    <td><?php echo $registro['nombre']; ?></td>
                    <td><?php echo $registro['especie']; ?></td>
                    <td><?php echo $registro['raza']; ?></td>
                    <?php $fechaNacimiento = new DateTime($registro['fecha_nacimiento']); ?>
                    <td><?php echo $fechaNacimiento->format('d/m/Y') ?></td>
                    <td><?php echo $registro['sexo']; ?></td>
                    <td>
                        <form action="inicio.php?pagina=animal" method="post" style="display:inline;">
                            <input type="hidden" name="editar" value="<?= $registro['id_animal']; ?>">
                            <button type="submit" class="editar">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form action="inicio.php?pagina=animal" method="post" style="display:inline;">
                            <input type="hidden" name="eliminar" value="<?= $registro['id_animal']; ?>">
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
    <h2>Inserción de Datos de un Animal</h2>
    <form action="inicio.php?pagina=animal" method="post">
        <input type="hidden" name="confirmarI" value="1">
        <label for="nombre">Nombre:</label>
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

        <label for="vivo">Vivo:</label>
        <select name="vivo" id="selectVivo" required onchange="controlarCamposMuerte()">
            <option value=""></option>
            <option value="S">Sí</option>
            <option value="N">No</option>
        </select> <br>

        <div id="camposMuerte">
            <label for="causa_muerte">Causa de Muerte:</label>
            <textarea name="causa_muerte" id="causaMuerte"></textarea> <br> <br>

            <label for="fecha_muerte">Fecha de Muerte:</label>
            <input type="date" name="fecha_muerte" id="fechaMuerte"> <br> <br>
        </div>

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
    <form action="inicio.php?pagina=animal" method="post">
        <input type="hidden" name="confirmarU" value="1">
        <input type="hidden" name="id_animal" value="<?= $datosAnimal['id_animal'] ?>" required>
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

        <label for="vivo">Vivo:</label>
        <select name="vivo" id="selectVivo" required onchange="controlarCamposMuerte()">
            <option value=""></option>
            <option value="S" <?php if ($datosAnimal['vivo'] == 'S') echo 'selected'; ?>>Sí</option>
            <option value="N" <?php if ($datosAnimal['vivo'] == 'N') echo 'selected'; ?>>No</option>
        </select> <br>

        <div id="camposMuerte">
            <label for="causa_muerte">Causa de Muerte:</label>
            <textarea name="causa_muerte" id="causaMuerte"><?= $datosAnimal['causa_muerte'] ?></textarea> <br>

            <label for="fecha_muerte">Fecha de Muerte:</label>
            <input type="date" name="fecha_muerte" id="fechaMuerte" value="<?= $datosAnimal['fecha_muerte'] ?>"> <br>
        </div>

        <button type="submit">Guardar</button>
    </form>
  </div>
</div>
<?php }

if (isset($_POST['eliminar'])) { ?>
<div id="formularioModal" class="modal" style="display:block;">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarFormulario()">&times;</span>
    <h2>Eliminación de Datos del Animal</h2>
    <form action="inicio.php?pagina=animal" method="post">
        <input type="hidden" name="confirmarD" value="1">
        <input type="hidden" name="id_animal" value="<?= $_POST['eliminar'] ?>" required> <br>
        <p>¿Está seguro de eliminar los datos de este animal?</p>
        <button type="submit">Confirmar</button>
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
            window.location.href = window.location.href.split('?')[0] + '?pagina=animal';
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
            window.location.href = window.location.href.split('?')[0] + '?pagina=animal';
        }
    </script>
<?php 
    unset($_SESSION['editado']); 
} 

if (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] === true) { ?>
    <div id="modalExito" class="modal" style="display:block;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalExito()">&times;</span>
            <h2>¡Datos del Animal Eliminados!</h2>
            <p>Se han eliminado correctamente los datos del animal.</p>
        </div>
    </div>
    <script>
        function cerrarModalExito() {
            document.getElementById('modalExito').style.display = 'none';
            window.location.href = window.location.href.split('?')[0] + '?pagina=animal';
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

    function controlarCamposMuerte() {
        const selectVivo = document.getElementById("selectVivo");
        const camposMuerte = document.getElementById("camposMuerte");
        const causaMuerte = document.getElementById("causaMuerte");
        const fechaMuerte = document.getElementById("fechaMuerte");

        if (selectVivo.value === "N") {
            camposMuerte.style.display = "block";
        } else {
            camposMuerte.style.display = "none";
            causaMuerte.value = "";
            fechaMuerte.value = "";
        }
    }

    window.onload = controlarCamposMuerte;
</script>