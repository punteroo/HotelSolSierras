<div class="modal fade" id="edit-passanger" role="dialog" tabindex="-1" aria-labelledby="edit-passanger" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editando</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST">
                <input type="hidden" id="p-id" name="id">
                <div class="modal-body">
                    <div class="form-group d-flex">
                        <div class="form-group mr-2">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" placeholder="Juan Olmedo" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" placeholder="Pérez" name="apellido">
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
                            <input type="text" class="form-control" placeholder="Centro" name="barrio">
                        </div>
                    </div>
                    <div class="form-group d-flex">
                        <div class="form-group mr-2">
                            <label for="pais">Pais</label>
                            <?php include("mod-paises.php"); ?>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control" placeholder="Córdoba" name="ciudad">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="text" class="form-control" placeholder="pasajero@dominio.extension" name="email">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editPassanger">Aceptar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>