<div class="modal fade" id="edit-modal" role="dialog" tabindex="-1" aria-labelledby="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editando</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST">
                <input type="hidden" name="editUser" value="1">
                <input type="hidden" id="p-id" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" name="nombre" type="text">
                    </div>
                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                        <label for="documento">Número de Documento</label>
                        <input class="form-control" name="documento" type="number">
                    </div>
                    <div class="form-group">
                        <label for="legajo">Legajo</label>
                        <input class="form-control" name="legajo" type="number">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="entrada">Horario de Entrada</label>
                            <input class="form-control" name="entrada" type="time">
                            <label for="salida">Horario de Salida</label>
                            <input class="form-control" name="salida" type="time">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editUser">Aceptar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>