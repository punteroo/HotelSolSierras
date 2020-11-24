<!DOCTYPE HTML>

<?php
include("db.php");
?>

<html>
    <head>
        <title>Habitaciones - Sol de las Tierras</title>

        <?php
        include("mod-dependencies.php");
        ?>
    </head>

    <body>
        <?php
        // Modales
        include("modals/habitacion-tipo-edit.php");
        include("modals/habitacion-tipo-delete.php");
        include("modals/habitacion-resumen.php");

        include("mod-header.php");
        ?>

        <div class="card m-3">
            <div class="card-header">
                Adminsitrador de Habitaciones
            </div>

            <div class="card-body">
                <p>En esta sección se pueden visualizar el estado de las habitaciones del hotel. Se pueden registrar nuevas habitaciones,
                modificar las existentes o eliminar aquellas que estén en desuso, mantenimiento, u otras razones.</p>
                <p>Los colores para diferenciar el estado de las habitaciones son <b style="color: green;">verdes</b> para las desocupadas,
                <b style="color: orange;">naranjas</b> para las reservadas y <b style="color: red;">rojo</b> para las ocupadas.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                            Registrar nueva habitación
                        </div>

                        <div class="card-body">
                            <div class="form p-3">
                                <form method="POST">
                                    <div class="form-group row">
                                        <label for="numero">Número</label>
                                        <input type="number" class="form-control" name="numero" min="0" step="1">
                                        <small class="form-text text-muted">
                                            Número característico de la habitación.
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre">
                                        <small class="form-text text-muted">
                                            Nombre característico de la habitación.
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <label for="desc">Descripción</label>
                                        <textarea class="form-control" name="desc" rows="4"></textarea>
                                        <small class="form-text text-muted">
                                            Descripción característica de la habitación.
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tipo">Tipo de Habitación</label>
                                        <select class="form-control" name="tipo">
                                            <?php
                                                $q = "SELECT id, nombre, descripcion FROM habitaciones_tipos";
                                                $r = mysqli_query($db, $q);

                                                if ($r) {
                                                    while ($row = $r->fetch_array()) {
                                                        $id   = $row['id'];
                                                        $name = $row['nombre'];
                                                        $desc = $row['descripcion'];
                                            ?>
                                                <option value="<?php echo $id; ?>" <?php if (strlen($desc) > 0) echo "title='$desc'"; ?>><?php echo $name; ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <small class="form-text text-muted">
                                            Tipo de esta habitación.
                                        </small>
                                    </div>

                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-primary" name="registerRoom">Registrar Habitación</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            Registrar tipo de habitación
                        </div>

                        <div class="card-body">
                            <div class="form p-3">
                                <form method="POST">
                                    <div class="form-group row">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre">
                                        <small class="form-text text-muted">
                                            Nombre del tipo de habitación.
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <label for="desc">Descripción</label>
                                        <textarea class="form-control" name="desc" rows="4"></textarea>
                                        <small class="form-text text-muted">
                                            Descripción característica de este tipo (opcional).
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cost">Precio</label>
                                        <input type="number" class="form-control" name="cost" min="0">
                                        <small class="form-text text-muted">
                                            Coste monetario de la habitación.
                                        </small>
                                    </div>

                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-primary" name="registerType">Registrar Tipo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-3">
                        <div class="card-header">
                            Estado de Habitaciones
                        </div>
                        
                        <div class="card-body">
                            <div class="container-fluid d-flex">
                        <?php
                            $q = "SELECT * FROM habitaciones";
                            $r = mysqli_query($db, $q);

                            if ($r) {
                                while ($row = $r->fetch_array()) {
                                    $id     = $row['id'];
                                    $num    = $row['numero'];
                                    $name   = $row['nombre'];
                                    $type   = $row['tipo'];
                                    $status = $row['estado'];
                        ?>
                                <div class="card mr-2 text-center text-white bg-<?php echo ($status == 0 ? "success" : ($status == 1 ? "warning" : "danger"));?>" style="width: 12rem;">
                                    <div class="card-header">
                                        <div class="text-white" data-toggle="tooltip" title="<?php echo $name; ?>">
                                            Habitación N°<?php echo $num; ?>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <p><b><?php echo ($status == 0 ? "LIBRE" : ($status == 1 ? "RESERVADA" : "OCUPADA"));?></b></p>
                                        <a href="#" class="text-white" data-toggle="modal" data-target="#room-resume"
                                            data-id="<?php echo $id; ?>"
                                            data-name="<?php echo $name; ?>"
                                            data-nro="<?php echo $num; ?>"
                                            data-type="<?php echo $type; ?>"
                                            data-status="<?php echo $status; ?>"
                                            title="Visualizar un resumen de esta habitación.">
                                            Ver resumen
                                        </a>
                                    </div>
                                </div>
                        <?php
                                }
                            }
                        ?>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Tipos de Habitaciones
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM habitaciones_tipos";
                                        $r = mysqli_query($db, $q);

                                        if ($r) {
                                            while ($row = $r->fetch_array()) {
                                                $id   = $row['id'];
                                                $name = $row['nombre'];
                                                $desc = $row['descripcion'];
                                                $cost = $row['costo'];
                                    ?>
                                        <tr>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $desc; ?></td>
                                            <td><?php echo '$' . $cost; ?></td>
                                            <td>
                                                <button type="button" class="btn" data-toggle="modal" data-target="#delete-type"
                                                        data-id="<?php echo $id; ?>"
                                                        data-name="<?php echo $name; ?>">
                                                    <img src="img/icon/delete.svg" width="25px">
                                                </button>
                                                <button type="button" class="btn" data-toggle="modal" data-target="#edit-type"
                                                        data-id="<?php echo $id; ?>"
                                                        data-name="<?php echo $name; ?>"
                                                        data-desc="<?php echo $desc; ?>"
                                                        data-cost="<?php echo $cost; ?>">
                                                    <img src="img/icon/edit.svg" width="25px">
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script>
                        $("#room-resume").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);

                            let id     = btn.data('id'),
                                name   = btn.data('name'),
                                num    = btn.data('nro'),
                                type   = btn.data('type'),
                                status = btn.data('status');

                            let modal = $(this);

                            modal.find(".modal-title").text(`Resumen Habitación N°${num}`);

                            modal.find('#p-id').attr('value', id);

                            modal.find("input[name='numero']").attr('value', num);
                            modal.find("input[name='nombre']").attr('value', name);
                            modal.find(`option[value='${type}']`).attr('selected', true);

                            let phrases = ['LIBRE', 'RESERVADA', 'OCUPADA'];
                            let colors  = ['green', 'orange', 'red'];

                            modal.find('#estado').text(phrases[parseInt(status)]);
                            modal.find('#estado').css('color', colors[parseInt(status)]);

                            $.ajax({
                                url: 'https://anarquiteam.000webhostapp.com/api/reservas.php?getRoom=' + id,
                                type: 'GET',
                                success: function (data) {
                                    let json = data;

                                    for (let i = 0; i < json.length; i++) {
                                        let tBody = modal.find("#reservasTable");

                                        let status = (json[i].estado == 1 ? "Pago" : "No Pago");
                                    
                                        let html = `<tr>
                                                        <td>${json[i].nombre}</td>
                                                        <td>${json[i].fecha}</td>
                                                        <td>${json[i].pasajeros}</td>
                                                        <td>${json[i].pension}</td>
                                                        <td>${status}</td>
                                                        <td>$${json[i].costo}</td>
                                                    </tr>`;
                                        
                                        tBody.append(html);
                                    }
                                }
                            })
                        });

                        $("#room-resume").on('hidden.bs.modal', function (e) {
                            $("#reservasTable").empty();
                        });

                        $("#edit-type").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);

                            let id   = btn.data('id'),
                                name = btn.data('name'),
                                desc = btn.data('desc'),
                                cost = btn.data('cost');
                            
                            let modal = $(this);

                            modal.find('.modal-title').text(`Editando ${name}`);

                            modal.find('#p-id').attr('value', id);
                            modal.find("input[name='nombre']").attr('value', name);
                            modal.find("input[name='costo']").attr('value', cost);
                            modal.find("textarea[name='desc']").html(desc);
                        });

                        $("#delete-type").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);

                            let id   = btn.data('id'),
                                name = btn.data('name');
                            
                            let modal = $(this);

                            modal.find('.modal-title').text(`Eliminando ${name}...`);
                            modal.find('.modal-body').html(`Esta por eliminar el tipo de habitación "<b>${name}</b>", toda habitación con este tipo quedará sin el mismo. ¿Está seguro?`);
                            modal.find('.delete-btn').text(`Si, eliminar ${name}.`);

                            modal.find('#p-id').attr('value', id);
                        });

                        $("#room-resume").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);
                        });
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

if (isset($_POST['registerRoom'])) {
    $num = $_POST['numero'];
    $name = $_POST['nombre'];
    $desc = $_POST['desc'];
    $type = $_POST['tipo'];

    $q = "INSERT INTO habitaciones (nombre, numero, descripcion, tipo, estado) VALUES ('$name', $num, '$desc', $type, 0)";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['editRoom'])) {
    $id   = $_POST['id'];
    $num  = $_POST['numero'];
    $name = $_POST['nombre'];
    $type = $_POST['tipo'];

    $q = "UPDATE habitaciones SET numero = $num, nombre = '$name', tipo = $type WHERE id = $id";

    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteRoom'])) {
    $id = $_POST['id'];

    $q = "DELETE FROM habitaciones WHERE id = $id";

    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['registerType'])) {
    $name = $_POST['nombre'];
    $desc = $_POST['desc'];
    $cost = $_POST['cost'];

    $q = "INSERT INTO habitaciones_tipos (nombre, descripcion, costo) VALUES ('$name', '$desc', $cost)";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['editType'])) {
    $id   = $_POST['id'];
    $name = $_POST['nombre'];
    $desc = $_POST['desc'];
    $cost = $_POST['costo'];

    $q = "UPDATE habitaciones_tipos SET nombre = '$name', descripcion = '$desc', costo = $cost WHERE id = $id";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteType'])) {
    $id = $_POST['id'];

    $q = "DELETE FROM habitaciones_tipos WHERE id = $id";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

?>