<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-9 pt-1">
                        <h6 class="mb-4">Productos</h6>
                    </div>
                    <div class="col-3">
                        <button type="button" onclick="addProduct();" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus me-2"></i>Agregar
                            producto</button>
                    </div>
                </div>
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categorías</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Costo/Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table_data">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
let table = null;
let edit_product_id = 0;

function getProducts() {
    api_post("products/GetAllProducts", {
        section: <?php echo $_GET['section']; ?>
    }).then(res => {
        $("#table_data").html("");
        let items = "";
        res.forEach(i => {
            items += `<tr>
                        <th scope="row">${i.id}</th>
                        <td><img width="60px" src="${i.image?("<?php echo __ROOT__; ?>/assets/data/products/"+i.image.url):""}"></td>
                        <td>${i.category.name}${i.subcategory!=null?("/"+i.subcategory.name):""}</td>
                        <td>${i.name}</td>
                        <td>${i.description}</td>
                        <td>$${i.cost}/$${i.price}</td>
                        <td>${i.stock}</td>
                        <td>
                            <button type="button" onclick="editProduct(${i.id})" class="btn btn-sm btn-primary text-center"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-primary text-center"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
        });
        $("#table_data").html(items);
        initDataTable();
    })
}

function initDataTable() {
    if (table != null) table.destroy();
    table = new DataTable('#data_table', {
        responsive: true
    });
}

function addProduct() {
    $("#productModal").modal("show");
}

function getCategories() {
    api_post("categories/GetAllCategories", {
        section: <?php echo $_GET['section']; ?>
    }).then(res => {
        let categories = "<option value='0'>Elige una categoría</option>";
        res.forEach(c => {
            categories += `<option value="${c.id}">${c.name}</option>`;
        });
        $("#category_select").html(categories);
    });
}

function getSubcategories(def = 0) {
    api_post("categories/GetAllSubcategoriesByCategory", {
        category: $("#category_select").val()
    }).then(res => {
        let subcategories = "<option value='0'>Elige una subcategoría</option>";
        res.forEach(c => {
            subcategories += `<option value="${c.id}" ${def!=0 && def==c.id?"selected":""}>${c.name}</option>`;
        });
        $("#subcategory_select").html(subcategories);
    });
}

function setImagePreview() {
    $('#image_select').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}

function editProduct(id){
    edit_product_id = id;
    api_post("products/GetProductById",{
        id
    }).then(res=>{
        $("#name").val(res.name)
        $("#category_select").val(res.category_id)
        $("#cost").val(res.cost)
        $("#price").val(res.price)
        $("#stock").val(res.stock)
        $("#stock_min").val(res.stock_min)
        $("#description").val(res.description)
        $("#cui").val(res.code)
        $("#image_preview").attr("src",res.images!=null?("<?php echo __ROOT__; ?>/assets/data/products/"+res.images[0].url):null);
        getSubcategories(res.subcategory_id);
        $("#productModal").modal('show');
    });
}

$(() => {
    getProducts();
    getCategories();
    setImagePreview();
})
</script>