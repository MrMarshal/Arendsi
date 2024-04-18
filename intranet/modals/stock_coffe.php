<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Guardar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="col-6">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 mt-2">
                                    <label>Nombre:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Categoría:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <select id="category_select" onchange="getSubcategories()"
                                        class="form-control"></select>
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Subcategoría:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <select id="subcategory_select" class="form-control"></select>
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Costo:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="number" class="form-control" id="cost">
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Precio:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="number" class="form-control" id="price">
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Stock:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="number" class="form-control" id="stock">
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Stock mínimo:</label>
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="number" class="form-control" id="stock_min">
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
                    <div class="col-6">
                        <div class="image-container" style="height: 360px;overflow-y: scroll;">
                            <img src="" id="image_preview" style="width: 100%;">
                        </div>
                        <div>
                            <input type="file" id="image_select">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="saveProduct();">Guardar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function saveProduct() {
    api_post("products/SaveProductCoffe", {
        id: edit_product_id,
        name: $("#name").val(),
        category_id: $("#category_select").val(),
        subcategory_id: $("#subcategory_select").val(),
        cost: $("#cost").val(),
        price: $("#price").val(),
        stock: $("#stock").val(),
        stock_min: $("#stock_min").val(),
        description: $("#description").val(),
    }).then((result) => {
        edit_product_id = result.id;
        let imagenInput = $('#image_select')[0];
        if (imagenInput.files.length > 0) {
            api_post_file("files/UploadFile", imagenInput.files[0] ,{
                product_id: edit_product_id,
                folder:"products"
            });
        }
        edit_product_id = 0;
        $("#name").val("");
        $("#category_select").val(0);
        $("#subcategory_select").val(null);
        $("#cost").val(0);
        $("#price").val(0);
        $("#stock").val(0);
        $("#stock_min").val(0);
        $("#description").val("");
    });
}
</script>