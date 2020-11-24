<!DOCTYPE HTML>

<?php
include("db.php");
?>

<html>
    <head>
        <title>Empleados - Sol de las Sierras</title>

        <?php
        include("mod-dependencies.php");
        ?>
    </head>

    <body>
        <?php
        // Modales
        include("modals/empleados-delete.php");
        include("modals/empleados-edit.php");

        // Navigation
        include("mod-header.php");
        ?>

        <div class="card m-3">
            <div class="card-header">
                Administrador de Empleados
            </div>
            <div class="card-body">
                <p>En esta sección se pueden agregar, modificar, eliminar o revisar empleados del hotel registrados en la base de datos.</p>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            Registrar nuevo empleado
                        </div>

                        <div class="card-body">
                            <div class="form p-3">
                                <form class="mw-25" method="POST">
                                    <div class="form-group row col-xs-4">
                                        <label for="nombre">Nombre</label>
                                        <input class="form-control" name="nombre" type="text">
                                        <small class="form-text text-muted">
                                            Nombre y apellido del empleado.
                                        </small>
                                    </div>
                                    <div class="form-group row col-xs-4">
                                        <label for="cargo">Cargo</label>
                                        <select class="form-control" name="cargo">
                                            <option value="Gerente General">Gerente General</option>
                                            <option value="Jefe de Marketing">Jefe de Marketing</option>
                                            <option value="Jefe de Mantenimiento">Jefe de Mantenimiento</option>
                                            <option value="Atención de Pasajeros">Atención de Pasajeros</option>
                                            <option value="Encargado de Compras">Encargado de Compras</option>
                                            <option value="Encargado de Personal">Encargado de Personal</option>
                                            <option value="Encargado de Reservas">Encargado de Reservas</option>
                                            <option value="Carpintero">Carpintero</option>
                                            <option value="Jardinero">Jardinero</option>
                                            <option value="Limpieza">Limpieza</option>
                                        </select>
                                        <small class="form-text text-muted">
                                            Cargo a cumplir dentro de la empresa.
                                        </small>
                                    </div>
                                    <div class="form-group row col-xs-4">
                                        <label for="documento">Número de Documento</label>
                                        <input class="form-control" name="documento" type="number" min="0">
                                        <small class="form-text text-muted">
                                            DNI, Pasaporte, CUIL, CUIT u otro.
                                        </small>
                                    </div>
                                    <div class="form-group row col-xs-4">
                                        <label for="legajo">Legajo</label>
                                        <input class="form-control" name="legajo" type="number">
                                    </div>
                                    <div class="form-group row col-xs-4">
                                        <div class="form-group">
                                            <label for="entrada">Horario de Entrada</label>
                                            <input class="form-control" name="entrada" type="time">
                                            <label for="salida">Horario de Salida</label>
                                            <input class="form-control" name="salida" type="time">
                                            <small class="form-text text-muted">
                                                Rango horario de jornada laboral.
                                            </small>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary mb-2" name="registrar" type="submit">Registrar Empleado</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Vista de Empleados
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Legajo</th>
                                        <th scope="col">Entrada</th>
                                        <th scope="col">Salida</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM empleados";
                                        $r = mysqli_query($db, $q);

                                        if ($r) {
                                            while ($row = $r->fetch_array()) {
                                                $id    = $row['id'];
                                                $name  = $row['nombre'];
                                                $cargo = $row['cargo'];
                                                $dni   = $row['documento'];
                                                $leg   = $row['legajo'];
                                                $en    = date('h:i A', strtotime($row['inicio_jornada']));
                                                $sa    = date('h:i A', strtotime($row['final_jornada']));

                                            ?>
                                                <tr>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $cargo; ?></td>
                                                    <td><?php echo $dni; ?></td>
                                                    <td><?php echo $leg; ?></td>
                                                    <td><?php echo $en; ?></td>
                                                    <td><?php echo $sa; ?></td>
                                                    <td>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#delete-modal"
                                                                data-id="<?php echo $id; ?>"
                                                                data-name="<?php echo $name; ?>">
                                                            <img src="img/icon/delete.svg" width="25px">
                                                        </button>
                                                        <button type="button" class="btn" data-toggle="modal" data-target="#edit-modal"
                                                                data-id="<?php echo $id; ?>"
                                                                data-name="<?php echo $name; ?>"
                                                                data-cargo="<?php echo $cargo; ?>"
                                                                data-dni="<?php echo $dni; ?>"
                                                                data-legajo="<?php echo $leg; ?>"
                                                                data-entry="<?php echo $row['inicio_jornada']; ?>"
                                                                data-exit="<?php echo $row['final_jornada']; ?>">
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
                </div>

                <script>
                    $("#edit-modal").on('show.bs.modal', function (e) {
                        let btn = $(e.relatedTarget);

                        let id    = btn.data('id'),
                            name  = btn.data('name'),
                            cargo = btn.data('cargo'),
                            dni   = btn.data('dni'),
                            leg   = btn.data('legajo'),
                            ent   = btn.data('entry'),
                            sal   = btn.data('exit');
                        
                        let modal = $(this);

                        modal.find('.modal-title').text(`Editando a ${name}`);

                        modal.find('#p-id').attr('value', id);
                        modal.find("input[name='nombre']").attr('value', name);
                        modal.find(`option[value='${cargo}']`).attr('selected', true);
                        modal.find("input[name='documento']").attr('value', dni);
                        modal.find("input[name='legajo']").attr('value', leg);
                        modal.find("input[name='entrada']").attr('value', ent);
                        modal.find("input[name='salida']").attr('value', sal);
                    });

                    $("#delete-modal").on('show.bs.modal', function (e) {
                        let btn = $(e.relatedTarget);

                        let id   = btn.data('id'),
                            name = btn.data('name');
                        
                        let modal = $(this);

                        modal.find('.modal-title').text(`Eliminando a ${name}`);
                        modal.find('.modal-body').html(`Esta por eliminar a <b>${name}</b>. ¿Está seguro?`);
                        modal.find('.delete-btn').text(`Si, eliminar a ${name}.`);

                        modal.find('#p-id').attr('value', id);
                    });
                </script>
            </div>
        </div>
    </body>
</html>

<?php

if (isset($_POST['editUser'])) {
    $id     = $_POST['id'];
    $name   = $_POST['nombre'];
    $cargo  = $_POST['cargo'];
    $dni    = $_POST['documento'];
    $legajo = $_POST['legajo'];
    $en     = $_POST['entrada'];
    $sa     = $_POST['salida'];

    $q = "UPDATE empleados SET nombre = '$name', cargo = '$cargo', documento = '$dni', legajo = $legajo, inicio_jornada = '$en', final_jornada = '$sa' WHERE id = $id";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteUser'])) {
    $id = $_POST['id'];

    $q = "DELETE FROM empleados WHERE id = $id";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['registrar'])) {
    $name   = $_POST['nombre'];
    $cargo  = $_POST['cargo'];
    $dni    = $_POST['documento'];
    $legajo = $_POST['legajo'];
    $en     = $_POST['entrada'];
    $sa     = $_POST['salida'];

    $q = "INSERT INTO empleados (nombre, cargo, documento, legajo, inicio_jornada, final_jornada) VALUES ('$name', '$cargo', '$dni', $legajo, '$en', '$sa')";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

?>