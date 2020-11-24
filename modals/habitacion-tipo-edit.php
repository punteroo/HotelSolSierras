<div class="modal fade" id="edit-type" role="dialog" tabindex="-1" aria-labelledby="edit-type" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input class="form-control" name="nombre" type="text">
                    </div>
                    <div class="form-group">
                        <label for="documento">Costo</label>
                        <input class="form-control" name="costo" type="number" min="0" step="50">
                    </div>
                    <div class="form-group">
                        <label for="desc">Descripción</label>
                        <textarea class="form-control" name="desc" rows="4"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editType">Aceptar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>