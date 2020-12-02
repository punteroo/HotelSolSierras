<!DOCTYPE HTML>

<?php
include("db.php");
?>

<html>
    <head>
        <title>Reservas - Sol de las Tierras</title>

        <?php
        include("mod-dependencies.php");
        ?>
    </head>

    <body>
        <?php
        // Modals
        include("modals/reserva-delete.php");
        include("modals/reserva-edit.php");

        include("mod-header.php");
        ?>

        <div class="card m-3">
            <div class="card-header">
                Adminsitrador de Reservas
            </div>

            <div class="card-body">
                <p>En esta sección se registran reservas de pasajeros dentro del hotel.</p>
                <p>Se puede establecer una reserva sin pagar y marcarla luego como <b style="color: green">confirmada</b> una vez recibido
                el pago de dicho pasajero (seña). Cada reserva es asignada una o más habitaciones, y se debe marcar al pasajero (o los pasajeros)
                los cuales ocuparán dicha reserva.</p>
                <p>Para registrar una reserva, se puede utilizar únicamente al reservante hasta que se reciba el pago, y una vez abonado, 
                se puede editar la misma para agregar a los pasajeros restantes.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            Registrar una reserva
                        </div>

                        <div class="card-body">
                            <div class="form">
                                <form method="POST">
                                    <!-- Pasajero dueño de la reserva -->
                                    <div class="form-group">
                                        <label for="reservant">Pasajero Reservante</label>
                                        <select class="form-control" name="reservant">
                                            <?php
                                            $q = "SELECT id, nombre, apellido FROM pasajeros";
                                            $r = mysqli_query($db, $q);

                                            if ($r) {
                                                while ($row = $r->fetch_array()) {
                                                    $id      = $row['id'];
                                                    $name    = $row['nombre'];
                                                    $surname = $row['apellido'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $surname . ", " . $name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group d-flex justify-content-center">
                                        <div class="form-group mr-3" style="width: 13%;">
                                            <label for="cantidad">Pasajeros</label>
                                            <input type="number" class="form-control" name="cantidad" min="0" step="1" value="1">
                                        </div>
                                        <div class="form-group mr-3" style="width: 30%;">
                                            <label for="entrada">Fecha de Entrada</label>
                                            <input type="datetime-local" class="form-control" name="entrada" value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                        <div class="form-group mr-3" style="width: 30%;">
                                            <label for="salida">Fecha de Salida</label>
                                            <input type="datetime-local" class="form-control" name="salida">
                                        </div>
                                        <div class="form-group">
                                            <label for="pension">Pensión</label>
                                            <select class="form-control" name="pension">
                                                <option value="Media">Pensión Media</option>
                                                <option value="Completa">Pensión Completa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tabla de Habitaciones con detalles -->
                                    <div class="form-group">
                                        <label for="room">Habitación/es</label>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Número</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Tipo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $q = "SELECT * FROM habitaciones";
                                                $r = mysqli_query($db, $q);

                                                if ($r) {
                                                    while ($row = $r->fetch_array()) {
                                                        $id    = $row['id'];
                                                        $name  = $row['nombre'];
                                                        $nro   = $row['numero'];
                                                        $desc  = $row['descripcion'];
                                                        $type  = $row['tipo'];
                                                        $state = $row['estado'];

                                                        $q = "SELECT nombre FROM habitaciones_tipos WHERE id = $type";
                                                        $typeName = mysqli_query($db, $q)->fetch_object()->nombre;
                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" name="roomSelect[]" value="<?php echo $id; ?>" <?php if ($state > 0) echo "disabled"; ?>></td>
                                                    <td><?php echo $nro; ?></td>
                                                    <td><?php echo $name; ?></td>
                                                    <td><?php echo $desc; ?></td>
                                                    <td><?php echo $typeName; ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="registerReserva">Registrar Reserva</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Detalle de Reservas
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Reservante</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Habitación/es</th>
                                        <th scope="col">Pasajeros</th>
                                        <th scope="col">Pensión</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $q = "SELECT * FROM reservas";
                                    $r = mysqli_query($db, $q);

                                    if ($r) {
                                        while ($row = $r->fetch_array()) {
                                            $reserver = $row['cliente'];

                                            $q = "SELECT nombre, apellido FROM pasajeros WHERE id = $reserver";
                                            $res = mysqli_query($db, $q)->fetch_array();

                                            $name    = $res['nombre'];
                                            $surname = $res['apellido'];

                                            $id      = $row['id'];

                                            $fName = $surname . ", " . $name;

                                            $entry  = date("d/m", strtotime($row['entrada']));
                                            $salida = date("d/m", strtotime($row['salida']));

                                            $date = $entry . " - " . $salida;
                                            
                                            $pasajeros = $row['pasajeros'];
                                            $estado    = $row['estado'];
                                            $pension   = $row['pension'];
                                            $costo     = $row['costo'];
                                    ?>
                                        <tr>
                                            <td scope="col"><?php echo $fName; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td>
                                            <?php
                                                //  Para visualizar las habitaciones de la reserva tuvimos un pequeño problema, pueden ser más
                                                // de una.
                                                //
                                                //  En la tabla de los pasajeros existe una columna de nombre 'habitacion', esta tiene un formato
                                                // siguiente: id,id,id,id... siendo 'id' la ID de la habitación identificatoria.
                                                //
                                                //  Guardamos las habitaciones ocupadas de esta forma para luego "explotar" la cadena de
                                                // caractéres donde cada ID es separada por una ','. Obtenemos un arreglo de IDs de habitaciones
                                                // las cuales utilizamos para volver a llamar a la base de datos y preguntarle el número de esa
                                                // habitación y su nombre característico, el cuál se puede observar luego en la tabla web de las
                                                // reservas registradas.
                                                //
                                                //  El código debajo hace el procedimiento explicado.
                                                $rooms = explode(",", $row['habitacion']);

                                                for ($i = 0; $i < count($rooms); $i++) {
                                                    $idR = $rooms[$i];

                                                    $q = "SELECT numero, nombre FROM habitaciones WHERE id = $idR";
                                                    $res = mysqli_query($db, $q);

                                                    $res1 = $res->fetch_array();

                                                    $nro  = $res1['numero'];
                                                    $name = $res1['nombre'];
                                            ?>
                                                <p>Hab. <?php echo $nro; ?> (<?php echo $name; ?>)</p>
                                            <?php
                                                }
                                            ?>
                                            </td>
                                            <td><?php echo $pasajeros; ?></td>
                                            <td><?php echo $pension; ?></td>
                                            <td><?php echo ($estado == 0 ? "No Pago" : "Pagado");?></td>
                                            <td><?php echo "$" . $costo; ?></td>
                                            <td>
                                                <!--
                                                Estos botones nos permiten ejecutar acciones sobre estos empleados.

                                                Los atributos data-* son valores importantes para transferir datos al modal
                                                una vez que el usuario pide visualizar el mismo cuando clickea el botón.

                                                Cada empleado tendrá uno de estos sets de botones, además de que este comentario
                                                estara repetido encima de cada set de botones para cada empleado.
                                                -->
                                                <button type="button" class="btn" data-toggle="modal" data-target="#delete-reserva"
                                                        data-id="<?php echo $id; ?>"
                                                        data-name="<?php echo $name; ?>">
                                                    <img src="img/icon/delete.svg" width="25px">
                                                </button>
                                                <button type="button" class="btn" data-toggle="modal" data-target="#edit-reserva"
                                                        data-id="<?php echo $id; ?>"
                                                        data-name="<?php echo $surname . ", " . $name; ?>"
                                                        data-entrada="<?php echo date("Y-m-d", strtotime($row['entrada'])) . 'T' . date("h:i", strtotime($row['entrada']));?>"
                                                        data-salida="<?php echo date("Y-m-d", strtotime($row['salida'])) . 'T' . date("h:i", strtotime($row['salida']));?>"
                                                        data-passangers="<?php echo $pasajeros; ?>"
                                                        data-status="<?php echo $estado; ?>"
                                                        data-pension="<?php echo $pension; ?>"
                                                        data-cost="<?php echo $costo; ?>"
                                                        data-rooms="<?php echo $row['habitacion']; ?>">
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
            </div>
        </div>
    </body>
    
    <!-- JavaScript utilizado para pasar los datos dentro del atributo 'data' de cada uno de los botones al modal
    una vez clickeado el botón. -->
    <script>
    $("#edit-reserva").on('show.bs.modal', function (e) {
        let btn = $(e.relatedTarget);

        let id         = btn.data('id'),
            name       = btn.data('name'),
            entry      = btn.data('entrada'),
            exit       = btn.data('salida'),
            passangers = btn.data('passangers'),
            status     = btn.data('status'),
            pension    = btn.data('pension'),
            cost       = btn.data('cost'),
            rooms      = btn.data('rooms');

        let modal = $(this);

        modal.find('.modal-title').text(`Editando reserva de ${name}`);

        modal.find("input[name='id']").attr('value', id);

        modal.find("select[name='reserver'] option").html(name);
        modal.find("input[name='entrada']").attr('value', entry);
        modal.find("input[name='salida']").attr('value', exit);
        modal.find("input[name='pasajeros']").attr('value', passangers);
        modal.find(`input[value='${status}']`).attr('checked', true);
        modal.find("input[name='costo']").attr('value', cost);
        modal.find(`option[value='${pension}']`).attr('selected', true);

        let roomChecks = modal.find("input[name*='roomSelect[]']");

        roomChecks.each(function (e) {
            let check = $(this);

            let ids = rooms.toString().split(',');

            for (let i = 0; i < ids.length; i++) {
                if (check.attr('value') == ids[i]) {
                    check.prop('checked', true);
                    break;
                }
                else 
                    check.prop('checked', false);
            }
        });

        modal.find("input[name='roomSelect']").attr('value', rooms);
    });

    $("#delete-reserva").on('show.bs.modal', function (e) {
        let btn = $(e.relatedTarget);

        let id   = btn.data('id'),
            name = btn.data('name');
        
        let modal = $(this);

        modal.find('.modal-title').text(`Eliminando reserva de ${name}`);

        modal.find('.modal-body').html(`Esta por eliminar esta reserva. ¿Está seguro?`);
        modal.find('.delete-btn').text(`Si, eliminar.`);

        modal.find('#p-id').attr('value', id);
    });
    </script>
</html>

<?php

//  Debajo de todas las páginas donde hay interacción con la base de datos tenemos estas declaraciones.
//
//  PHP detecta si el usuario hizo un request HTTP POST (enviar datos a la página), si ese es el caso, procede a obtener la lista de datos
// que el formulario envió para luego ponerlos en una 'query' la cual será interpretada por la base de datos y hará la acción necesaria.
//
//  SELECT se utiliza para traer datos de una tabla desde la base, INSERT para insertar nuevos datos en una tabla, DELETE para eliminar datos
// de una tabla, y UPDATE para actualizar valores de un registro existente en una tabla de la base de datos.
//
//  Existen muchos otros statements de SQL para interactuar con la DB, todos estos han sido utilizados desde el conocimiento brindado por
// la documentación del lenguaje SQL: https://dev.mysql.com/doc/

if (isset($_POST['registerReserva'])) {
    $reserver   = $_POST['reservant'];
    $passangers = $_POST['cantidad'];
    $entry      = $_POST['entrada'];
    $exit       = $_POST['salida'];
    $pension    = $_POST['pension'];
    $rooms      = $_POST['roomSelect'];

    $roomStr = join(",", $rooms);

    $costo = 0;
    for ($i = 0; $i < count($rooms); $i++) {
        $id = $rooms[$i];

        $q = "SELECT tipo FROM habitaciones WHERE id = $id";
        $type = intval(mysqli_query($db, $q)->fetch_object()->tipo);

        $q = "SELECT costo FROM habitaciones_tipos WHERE id = $type";
        $price = intval(mysqli_query($db, $q)->fetch_object()->costo);

        $costo += $price;
    }

    $q = "SELECT edad FROM pasajeros WHERE id = $reserver";
    $age = mysqli_query($db, $q)->fetch_object()->edad;

    if (intval($age) < 3)
        $costo -= $costo * .15;

    $q = "INSERT INTO reservas (estado, cliente, entrada, salida, habitacion, pasajeros, pension, costo) " .
         "VALUES (0, $reserver, '$entry', '$exit', '$roomStr', '$passangers', '$pension', $costo)";
    
    foreach ($rooms as $room) {
        $q1 = "UPDATE habitaciones SET estado = 1 WHERE id = $room";
        mysqli_query($db, $q1);
    }

    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['editReserva'])) {
    $id         = $_POST['id'];
    $passangers = $_POST['pasajeros'];
    $entry      = $_POST['entrada'];
    $exit       = $_POST['salida'];
    $pension    = $_POST['pension'];
    $status     = $_POST['status'];
    $cost       = $_POST['costo'];
    $rooms      = $_POST['roomSelect'];

    $q = "UPDATE reservas SET " .
         "estado = $status, entrada = '$entry', salida = '$exit', habitacion = '$rooms', pasajeros = $passangers, pension = '$pension', " .
         "costo = $cost WHERE id = $id";
    
    $roomArr = explode(",", $rooms);

    foreach ($roomArr as $room) {
        $hState = ($status == 0 ? 1 : 2);

        $q1 = "UPDATE habitaciones SET estado = $hState WHERE id = $room";
        mysqli_query($db, $q1);
    }
    
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deleteReserva'])) {
    $id = $_POST['id'];

    $q = "SELECT habitacion FROM reservas WHERE id = $id";
    $rooms = explode(",", mysqli_query($db, $q)->fetch_object()->habitacion);

    foreach ($rooms as $room) {
        $q = "UPDATE habitaciones SET estado = 0 WHERE id = $room";
        mysqli_query($db, $q);
    }

    $q = "DELETE FROM reservas WHERE id = $id";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

?>