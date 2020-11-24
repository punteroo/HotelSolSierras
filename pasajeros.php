<!DOCTYPE HTML>

<?php
include("db.php");
?>

<html>
    <head>
        <title>Pasajeros - Sol de las Tierras</title>

        <?php
        include("mod-dependencies.php");
        ?>
    </head>

    <body>
        <?php
        // Modals
        include("modals/pasajero-delete.php");
        include("modals/pasajero-edit.php");

        include("mod-header.php");
        ?>

        <div class="card m-3">
            <div class="card-header">
                Adminsitrador de Pasajeros
            </div>

            <div class="card-body">
                <p>En esta sección se pueden visualizar los datos de los pasajeros, buscar uno específico, registrar nuevos pasajeros
                del hotel, eliminar o editar los mismos.</p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?php
                        include("cards/pasajero-register.php");
                    ?>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Lista de Pasajeros
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group ml-4 d-flex">
                                    <input type="text" class="form-control" name="search" placeholder="Buscar pasajero...">
                                    <img src="img/search.svg" width="22px" class="ml-2">
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre Completo</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Residencia</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">País</th>
                                        <th scope="col">Ciudad</th>
                                        <th scope="col">E-Mail</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM pasajeros";
                                        $r = mysqli_query($db, $q);

                                        if ($r) {
                                            while ($row = $r->fetch_array()) {
                                                $id       = $row['id'];
                                                $name     = $row['nombre'];
                                                $surname  = $row['apellido'];
                                                $age      = $row['edad'];
                                                $document = $row['documento'];
                                                $docType  = $row['tipo_documento'];
                                                $celular  = $row['telefono'];
                                                $street   = $row['calle'];
                                                $depto    = $row['departamento'];
                                                $floor    = $row['piso'];
                                                $hood     = $row['barrio'];
                                                $country  = $row['pais'];
                                                $city     = $row['ciudad'];
                                                $email    = $row['email'];
                                    ?>
                                    <tr id="passanger" data-name="<?php echo $name . " " . $surname; ?>">
                                        <td scope="col"><?php echo $surname . ", " . $name; ?></td>
                                        <td><?php echo $age; ?></td>
                                        <td><?php echo $document . " (" . $docType . ")"; ?></td>
                                        <td><?php echo $street . " (" .
                                                    ($depto != NULL ? ("Dpto. " . $depto . ", ") : "") .
                                                    ($floor != NULL ? ("Piso " . $floor . ", ") : "") .
                                                    ($hood != NULL ? ("Barrio " . $hood) : "") .
                                                    ")"; ?></td>
                                        <td><?php echo $celular; ?></td>
                                        <td><?php echo $country; ?></td>
                                        <td><?php echo $city; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td>
                                            <button type="button" class="btn" data-toggle="modal" data-target="#delete-passanger"
                                                    data-id="<?php echo $id; ?>"
                                                    data-name="<?php echo $name; ?>">
                                                <img src="img/icon/delete.svg" width="25px">
                                            </button>
                                            <button type="button" class="btn" data-toggle="modal" data-target="#edit-passanger"
                                                    data-id="<?php echo $id; ?>"
                                                    data-name="<?php echo $name; ?>"
                                                    data-surname="<?php echo $surname; ?>"
                                                    data-edad="<?php echo $age; ?>"
                                                    data-doc="<?php echo $document; ?>"
                                                    data-doctype="<?php echo $docType; ?>"
                                                    data-cel="<?php echo $celular; ?>"
                                                    data-street="<?php echo $street; ?>"
                                                    data-depto="<?php echo $depto; ?>"
                                                    data-floor="<?php echo $floor; ?>"
                                                    data-hood="<?php echo $hood; ?>"
                                                    data-country="<?php echo $country; ?>"
                                                    data-city="<?php echo $city; ?>"
                                                    data-email="<?php echo $email; ?>">
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

    <script>
        $("input[name='search']").on('input', function (e) {
            let query = $(this).val();

            let empty = false;
            if (query.length < 1)
                empty = true;
            
            $("*#passanger").each(function (item) {
                let jItem = $(this);

                console.log(jItem);
                let sName = jItem.data('name').toString().toLowerCase();

                if (empty)
                    jItem.css('display', 'table-row');
                else {
                    if (sName.includes(query.toLowerCase()))
                        jItem.css('display', 'table-row');
                    else
                        jItem.css('display', 'none');
                }
            });
        });
    </script>

    <script>
    $("#edit-passanger").on('show.bs.modal', function (e) {
        let btn = $(e.relatedTarget);

        let id      = btn.data('id'),
            name    = btn.data('name'),
            surname = btn.data('surname'),
            age     = btn.data('edad'),
            doc     = btn.data('doc'),
            docType = btn.data('doctype'),
            phone   = btn.data('cel'),
            street  = btn.data('street'),
            depto   = btn.data('depto'),
            floor   = btn.data('floor'),
            hood    = btn.data('hood'),
            country = btn.data('country'),
            city    = btn.data('city'),
            email   = btn.data('email');
        
        let modal = $(this);

        modal.find('.modal-title').text(`Editando a ${surname}, ${name}`);

        modal.find('#p-id').attr('value', id);

        modal.find("input[name='nombre']").attr('value', name);
        modal.find("input[name='apellido']").attr('value', surname);
        modal.find("input[name='edad']").attr('value', age);
        modal.find("input[name='doc']").attr('value', doc);
        modal.find(`option[value='${docType}']`).attr('selected', true);
        modal.find("input[name='cel']").attr('value', phone);
        modal.find("input[name='calle']").attr('value', street);
        modal.find("input[name='piso']").attr('value', floor);
        modal.find("input[name='depto']").attr('value', depto);
        modal.find("input[name='barrio']").attr('value', hood);
        modal.find(`option[value='${city}']`).attr('selected', true);
        modal.find("input[name='ciudad']").attr('value', city);
        modal.find("input[name='email']").attr('value', email);
    });

    $("#delete-passanger").on('show.bs.modal', function (e) {
        let btn = $(e.relatedTarget);

        let id   = btn.data('id'),
            name = btn.data('name');
        
        let modal = $(this);

        modal.find('.modal-title').text(`Eliminando a ${name}`);

        modal.find('.modal-body').html(`Esta por eliminar al pasajero "<b>${name}</b>", toda reserva asignada con este pasajero será afectada. ¿Está seguro?`);
        modal.find('.delete-btn').text(`Si, eliminar a ${name}.`);

        modal.find('#p-id').attr('value', id);
    });
    </script>
</html>

<?php

if (isset($_POST['registerPassanger'])) {
    $name    = $_POST['nombre'];
    $surname = $_POST['apellido'];
    $age     = $_POST['edad'];
    $docType = $_POST['tipo_doc'];
    $doc     = $_POST['doc'];
    $phone   = $_POST['cel'];
    $street  = $_POST['calle'];
    $floor   = $_POST['piso'];
    $depto   = $_POST['depto'];
    $hood    = $_POST['barrio'];
    $city    = $_POST['ciudad'];
    $country = $_POST['pais'];
    $email   = $_POST['email'];

    $q = "INSERT INTO pasajeros " .
    "(nombre, apellido, edad, tipo_documento, documento, telefono, calle, piso, departamento, barrio, pais, ciudad, email) " .
    "VALUES " .
    "('$name', '$surname', $age, '$docType', $doc, '$phone', '$street', $floor, $depto, '$hood', '$country', '$city', '$email')";

    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['editPassanger'])) {
    $id      = $_POST['id'];
    $name    = $_POST['nombre'];
    $surname = $_POST['apellido'];
    $age     = $_POST['edad'];
    $docType = $_POST['tipo_doc'];
    $doc     = $_POST['doc'];
    $phone   = $_POST['cel'];
    $street  = $_POST['calle'];
    $floor   = $_POST['piso'];
    $depto   = $_POST['depto'];
    $hood    = $_POST['barrio'];
    $city    = $_POST['ciudad'];
    $country = $_POST['pais'];
    $email   = $_POST['email'];

    $q = "UPDATE pasajeros SET " .
         "nombre = '$name', apellido = '$surname', edad = $age, tipo_documento = '$docType', documento = '$doc', telefono = '$phone', " .
         "calle = '$street', departamento = '$depto', piso = '$floor', barrio = '$hood', pais = '$country', ciudad = '$city', email = '$email' " .
         "WHERE id = $id";
    
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['deletePassanger'])) {
    $id = $_POST['id'];

    $q = "DELETE FROM pasajeros WHERE id = $id";
    mysqli_query($db, $q);

    echo "<meta http-equiv='refresh' content='0'>";
}

?>