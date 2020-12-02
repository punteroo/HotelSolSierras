<!-- Todo documento de HTML empieza con esta etiqueta, declara que se utilize la última versión de HTML disponible. -->

<!DOCTYPE HTML>

<!-- Incluimos el archivo .php que contiene la conexión a nuestra base de datos. Esto nos permite interactuar con la misma
     desde cualquier parte del archivo. -->
<?php
include("db.php");
?>

<html>
    <!-- El tag 'head' nos permite definir meta-datos de la página, como tambien importar librerias, imágenes, etcétera. -->
    <head>
        <title>Habitaciones - Sol de las Tierras</title>

        <?php
        // Incluimos las dependencias, estas serían Bootstrap y JQuery, además de otros elementos detallados en el documento.
        
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
                                                // $q = Código SQL para interactuar con la base. Aquí traemos todos los empleados registrados en
                                                //     la base de datos.
                                                // $r = Resultado del pedido a la base.
                                                $q = "SELECT id, nombre, descripcion FROM habitaciones_tipos";
                                                $r = mysqli_query($db, $q);

                                                // Si el resultado fue exitoso, empezar a listar los tipos de habitación en la tabla.
                                                if ($r) {
                                                    //  Iterar por todos los resultados obtenidos y declarar variables con sus valores correspondientes
                                                    // los cuales serán visualizados por el usuario.
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
                            // $q = Código SQL para interactuar con la base. Aquí traemos todos los empleados registrados en
                            //     la base de datos.
                            // $r = Resultado del pedido a la base.
                            $q = "SELECT * FROM habitaciones";
                            $r = mysqli_query($db, $q);
                            
                            // Si el resultado fue exitoso, empezar a listar las habitaciones en la tabla.
                            if ($r) {
                                //  Iterar por todos los resultados obtenidos y declarar variables con sus valores correspondientes
                                // los cuales serán visualizados por el usuario.
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
                                        // $q = Código SQL para interactuar con la base. Aquí traemos todos los empleados registrados en
                                        //     la base de datos.
                                        // $r = Resultado del pedido a la base.
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
                                                <!--
                                                Estos botones nos permiten ejecutar acciones sobre estos empleados.

                                                Los atributos data-* son valores importantes para transferir datos al modal
                                                una vez que el usuario pide visualizar el mismo cuando clickea el botón.

                                                Cada empleado tendrá uno de estos sets de botones, además de que este comentario
                                                estara repetido encima de cada set de botones para cada empleado.
                                                -->
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

                    <!-- JavaScript utilizado para pasar los datos dentro del atributo 'data' de cada uno de los botones al modal
                    una vez clickeado el botón. -->
                    <script>
                        // Cuando se clickea el modal...
                        $("#room-resume").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);

                            // Lista de datos en el botón.
                            let id     = btn.data('id'),
                                name   = btn.data('name'),
                                num    = btn.data('nro'),
                                type   = btn.data('type'),
                                status = btn.data('status');

                            // Objeto global del modal que se está abriendo.
                            let modal = $(this);

                            // Reemplazamos todos los valores del botón hacia adentro del modal.
                            modal.find(".modal-title").text(`Resumen Habitación N°${num}`);

                            modal.find('#p-id').attr('value', id);

                            modal.find("input[name='numero']").attr('value', num);
                            modal.find("input[name='nombre']").attr('value', name);
                            modal.find(`option[value='${type}']`).attr('selected', true);

                            //  Para definir el estado de la habitación, esta depende del valor del estado de la misma cargado en la base
                            // de datos. El texto impreso está dado por este JavaScript.
                            let phrases = ['LIBRE', 'RESERVADA', 'OCUPADA'];
                            let colors  = ['green', 'orange', 'red'];

                            modal.find('#estado').text(phrases[parseInt(status)]);
                            modal.find('#estado').css('color', colors[parseInt(status)]);

                            //  Para la tabla que muestra la reserva que ocupa esa habitación, hacemos una AJAX call a un pseudo API REST alojado
                            // en la carpeta 'api'. Estas "API REST" nos permiten obtener datos en formato JSON desde la base de datos, algo
                            // que normalmente JavaScript no puede realizar, entonces dejamos que PHP obtenga los datos y se los entregue a 
                            // esta función AJAX para que pueda trabajar sobre el mismo.
                            $.ajax({
                                // Link a la API REST que queremos consultar.
                                url: 'https://anarquiteam.000webhostapp.com/api/reservas.php?getRoom=' + id,
                                // Tipo de HTTP Request.
                                type: 'GET',
                                // ¿Éxito en la GET REQUEST?
                                success: function (data) {
                                    let json = data;

                                    // Cargamos la tabla con todos los datos que obtuvimos.
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

                        // Cuando se esconde el modal...
                        $("#room-resume").on('hidden.bs.modal', function (e) {
                            // Vaciamos el contenido de la tabla del modal, para cuando el usuario decida abrir otro modal.
                            $("#reservasTable").empty();
                        });

                        // Cuando se clickea el modal...
                        $("#edit-type").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);

                            // Lista de datos en el botón.
                            let id   = btn.data('id'),
                                name = btn.data('name'),
                                desc = btn.data('desc'),
                                cost = btn.data('cost');
                            
                            // Objeto global del modal que se está abriendo.
                            let modal = $(this);

                            // Reemplazamos todos los valores del botón hacia adentro del modal.
                            modal.find('.modal-title').text(`Editando ${name}`);

                            modal.find('#p-id').attr('value', id);
                            modal.find("input[name='nombre']").attr('value', name);
                            modal.find("input[name='costo']").attr('value', cost);
                            modal.find("textarea[name='desc']").html(desc);
                        });

                        // Cuando se clickea el modal...
                        $("#delete-type").on('show.bs.modal', function (e) {
                            let btn = $(e.relatedTarget);

                            // Lista de datos en el botón.
                            let id   = btn.data('id'),
                                name = btn.data('name');
                            
                            // Objeto global del modal que se está abriendo.
                            let modal = $(this);

                            // Reemplazamos todos los valores del botón hacia adentro del modal.
                            modal.find('.modal-title').text(`Eliminando ${name}...`);
                            modal.find('.modal-body').html(`Esta por eliminar el tipo de habitación "<b>${name}</b>", toda habitación con este tipo quedará sin el mismo. ¿Está seguro?`);
                            modal.find('.delete-btn').text(`Si, eliminar ${name}.`);

                            modal.find('#p-id').attr('value', id);
                        });
                    </script>
                </div>
            </div>
        </div>
    </body>
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