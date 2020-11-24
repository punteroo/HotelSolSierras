<div class="card">
    <div class="card-header">
        Registrar nuevo pasajero
    </div>

    <div class="card-body">
        <div class="form p-1">
            <form method="POST">
                <div class="form-group d-flex">
                    <div class="form-group mr-2">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" placeholder="Juan Olmedo" name="nombre">
                    </div>
                    <div class="form-group mr-2">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" placeholder="Pérez" name="apellido">
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="number" class="form-control" placeholder="24 / 37 ..." name="edad" min="0" step="1">
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="form-group mr-2">
                        <label for="tipo_doc">Tipo de Documento</label>
                        <select class="form-control" name="tipo_doc">
                            <option value="DNI">D.N.I.</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Part. Nacimiento">Partida de Nacimiento</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doc">Documento</label>
                        <input type="text" class="form-control" pattern="[0-9]{8}" placeholder="12345678" name="doc">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cel">Teléfono Celular</label>
                    <input type="text" class="form-control" placeholder="+54 9 3537 669229" name="cel">
                </div>
                <div class="form-group">
                    <label for="calle">Dirección</label>
                    <input type="text" class="form-control" placeholder="Av. de Mayo 315" name="calle">
                </div>
                <div class="form-group d-flex">
                    <div class="form-group mr-2">
                        <label for="piso">Piso</label>
                        <input type="number" class="form-control" min="0" name="piso">
                    </div>
                    <div class="form-group mr-2">
                        <label for="depto">Departamento</label>
                        <input type="number" class="form-control" min="0" name="depto">
                    </div>
                    <div class="form-group">
                        <label for="barrio">Barrio</label>
                        <input type="text" class="form-control" name="barrio">
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="form-group mr-2">
                        <label for="pais">Pais</label>
                        <?php include("mod-paises.php"); ?>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="text" class="form-control" placeholder="pasajero@dominio.extension" name="email">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="registerPassanger">Registrar Pasajero</button>
                </div>
            </form>
        </div>
    </div>
</div>