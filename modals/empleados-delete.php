<div class="modal fade" id="delete-modal" role="dialog" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            ...
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <form method="POST">
                    <input type="hidden" id="p-id" name="id">
                    <button type="submit" class="btn btn-primary delete-btn" name="deleteUser">Sí, eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>