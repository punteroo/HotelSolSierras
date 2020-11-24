<div class="modal fade" id="room-resume" role="dialog" tabindex="-1" aria-labelledby="room-resume" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="min-width: 42% !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resumen Habitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <form method="POST">
                        <input type="hidden" id="p-id" name="id">
                        <div class="d-flex ml-2">
                            <div class="form-group mr-3">
                                <label for="numero">Número</label>
                                <input type="number" class="form-control" name="numero" min="0" step="1">
                            </div>
                            <div class="form-group mr-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre">
                            </div>
                            <div class="form-group mr-3">
                                <label for="tipo">Tipo de Habitación</label>
                                <select class="form-control" name="tipo">
                                    <?php
                                    $q = "SELECT * FROM habitaciones_tipos";

                                    $r = mysqli_query($db, $q);

                                    if ($r) {
                                        while ($row = $r->fetch_array()) {
                                            $id   = $row['id'];
                                            $name = $row['nombre'];
                                    ?>
                                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <p id="estado"></p>
                            </div>
                        </div>
                        
                        <div class="row justify-content-center mb-2">
                            <button type="submit" class="btn btn-success" name="editRoom">Aceptar Cambios</button>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Reservante</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Pasajeros</th>
                                <th scope="col">Pensión</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Costo</th>
                            </tr>
                        </thead>

                        <tbody id="reservasTable">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <form method="POST">
                    <input type="hidden" id="p-id" name="id">
                    <button type="submit" class="btn" name="deleteRoom" data-toggle="tooltip" title="Borra esta habitación.">
                        <img src="img/icon/delete.svg" width="25px">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>