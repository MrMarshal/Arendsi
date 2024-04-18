<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Guardar categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="row">
                        <div class="col-5 mt-2">
                            <label>Nombre:</label>
                        </div>
                        <div class="col-7 mt-2">
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-5 mt-2">
                            <label>Descripción:</label>
                        </div>
                        <div class="col-7 mt-2">
                            <textarea class="form-control" id="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="saveCategory();">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function saveCategory() {
    api_post("catalogs/SaveCategory",{
        id:edit_category_id,
        name: $("#name").val(),
        description: $("#description").val()
    }).then(res=>{
        alert({title:"Listo!",text:"Guardado con éxito"});
        $("#categoryModal").modal("hide");
        if (edit_category_id == 0) getCategories();
        else{   
            $("#category_row_name_"+edit_category_id).html($("#name").val());
            $("#category_row_description_"+edit_category_id).html($("#description").val());
        }
        edit_category_id = 0;
        $("#name").val("");
        $("#description").val("");
    });
}
</script>