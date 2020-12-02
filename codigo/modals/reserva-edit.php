<div class="modal fade" id="edit-reserva" role="dialog" tabindex="-1" aria-labelledby="edit-reserva" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editando</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST">
                <input type="hidden" id="p-id" name="id">
                <input type="hidden" name="roomSelect">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="reserver">Reservante</label>
                        <select class="form-control" name="reserver" disabled>
                            <option selected></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="habitacion">Habitación/es</label>
                        
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
                                    <td><input type="checkbox" value="<?php echo $id; ?>" <?php if ($state > 0) echo "disabled"; ?>></td>
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
                    <div class="form-group d-flex">
                        <div class="form-group mr-3">
                            <label for="entrada">Fecha de Ingreso</label>
                            <input type="datetime-local" class="form-control" name="entrada">
                        </div>
                        <div class="form-group">
                            <label for="salida">Fecha de Egreso</label>
                            <input type="datetime-local" class="form-control" name="salida">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pasajeros">Pasajeros</label>
                        <input class="form-control" name="pasajeros" type="number">
                    </div>
                    <div class="form-group">
                        <label for="pension">Pensión</label>
                        <select class="form-control" name="pension">
                            <option value="Media">Pensión Media</option>
                            <option value="Completa">Pensión Completa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="checkers">¿Pago?</label>
                        <div class="checkers">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1">
                                <label for="1" class="form-check-label">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0">
                                <label for="0" class="form-check-label">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="costo">Costo</label>
                        <input type="number" class="form-control" name="costo">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editReserva">Aceptar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>