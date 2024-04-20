<div class="modal fade" id="tableModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tableModalLabel">Guardar mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label>Ubicación:</label>
                        </div>
                        <div class="col-6 mt-2">
                            <select id="location_select" class="form-control"></select>
                        </div>
                        <div class="col-6 mt-2">
                            <label>Nombre:</label>
                        </div>
                        <div class="col-6 mt-2">
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="saveTable();">Guardar</button>
            </div>
        </div>
    </div>
</div>