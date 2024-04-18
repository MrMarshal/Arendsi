<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoryModalLabel">Guardar subcategoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="row">
                        <div class="col-6 mt-2">
                            <label>Categoría:</label>
                        </div>
                        <div class="col-6 mt-2">
                            <select id="category_select" class="form-control"></select>
                        </div>
                        <div class="col-6 mt-2">
                            <label>Nombre:</label>
                        </div>
                        <div class="col-6 mt-2">
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="col-6 mt-2">
                            <label>Descripción:</label>
                        </div>
                        <div class="col-6 mt-2">
                            <textarea class="form-control" id="description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="saveSubcategory();">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function saveSubcategory() {
    api_post("catalogs/SaveSubcategory", {
        id: edit_subcategory_id,
        category_id: $("#category_select").val(),
        name: $("#name").val(),
        description: $("#description").val()
    }).then(res => {
        alert({
            title: "Listo!",
            text: "Guardado con éxito"
        });
        $("#subcategoryModal").modal("hide");
        if (edit_subcategory_id==0) getSubcategories();
        else{
            $("#subcategory_row_category_" + edit_subcategory_id).html($("#category_select  option:selected").text());
            $("#subcategory_row_name_" + edit_subcategory_id).html($("#name").val());
            $("#subcategory_row_description_" + edit_subcategory_id).html($("#description").val());
        }
        edit_subcategory_id = 0;
        $("#category_select").val(0);
        $("#name").val("");
        $("#description").val("");
    });
}
</script>

<script type="text/javascript">
function getCategories() {
    api_post("catalogs/GetAllCategories", {
        section: <?php echo $_GET['section']; ?>
    }).then(res => {
        let categories = "<option value='0'>Elige una categoría</option>";
        res.forEach(c => {
            categories += `<option value="${c.id}">${c.name}</option>`;
        });
        $("#category_select").html(categories);
    });
}

$(() => {
    getCategories();
})
</script>