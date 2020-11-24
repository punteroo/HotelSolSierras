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
        <title>Empleados - Sol de las Sierras</title>

        <?php
        // Incluimos las dependencias, estas serían Bootstrap y JQuery, además de otros elementos detallados en el documento.

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
                                        // $q = Código SQL para interactuar con la base. Aquí traemos todos los empleados registrados en
                                        //     la base de datos.
                                        // $r = Resultado del pedido a la base.

                                        $q = "SELECT * FROM empleados";
                                        $r = mysqli_query($db, $q);
                                        
                                        // Si el resultado fue exitoso, empezar a listar los empleados en la tabla.
                                        if ($r) {
                                            //  Iterar por todos los resultados obtenidos y declarar variables con sus valores correspondientes
                                            // los cuales serán visualizados por el usuario.
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
                                                        <!--
                                                            Estos botones nos permiten ejecutar acciones sobre estos empleados.

                                                            Los atributos data-* son valores importantes para transferir datos al modal
                                                           una vez que el usuario pide visualizar el mismo cuando clickea el botón.

                                                            Cada empleado tendrá uno de estos sets de botones, además de que este comentario
                                                           estara repetido encima de cada set de botones para cada empleado.
                                                         -->
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
                
                <!-- JavaScript utilizado para pasar los datos dentro del atributo 'data' de cada uno de los botones al modal
                    una vez clickeado el botón. -->
                <script>
                    // Cuando se clickea el modal...
                    $("#edit-modal").on('show.bs.modal', function (e) {
                        let btn = $(e.relatedTarget);

                        // Lista de datos en el botón.
                        let id    = btn.data('id'),
                            name  = btn.data('name'),
                            cargo = btn.data('cargo'),
                            dni   = btn.data('dni'),
                            leg   = btn.data('legajo'),
                            ent   = btn.data('entry'),
                            sal   = btn.data('exit');
                        
                        // Objeto global del modal que se está abriendo.
                        let modal = $(this);

                        // Reemplazamos todos los valores del botón hacia adentro del modal.
                        modal.find('.modal-title').text(`Editando a ${name}`);

                        modal.find('#p-id').attr('value', id);
                        modal.find("input[name='nombre']").attr('value', name);
                        modal.find(`option[value='${cargo}']`).attr('selected', true);
                        modal.find("input[name='documento']").attr('value', dni);
                        modal.find("input[name='legajo']").attr('value', leg);
                        modal.find("input[name='entrada']").attr('value', ent);
                        modal.find("input[name='salida']").attr('value', sal);
                    });

                    // Cuando se clickea el modal...
                    $("#delete-modal").on('show.bs.modal', function (e) {
                        let btn = $(e.relatedTarget);

                        // Lista de datos en el botón.
                        let id   = btn.data('id'),
                            name = btn.data('name');
                        
                        // Objeto global del modal que se está abriendo.
                        let modal = $(this);

                        // Reemplazamos todos los valores del botón hacia adentro del modal.
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