<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-9 pt-1">
                        <h6 class="mb-4">Categorías</h6>
                    </div>
                    <div class="col-3">
                        <button type="button" onclick="addCategory();" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus me-2"></i>Agregar
                            categoría</button>
                    </div>
                </div>
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
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

function getCategories() {
    api_post("catalogs/GetAllCategories", {
        section: <?php echo $_GET['section']; ?>
    }).then(res => {
        $("#table_data").html("");
        let items = "";
        res.forEach(i => {
            items += `<tr>
                        <th scope="row">${i.id}</th>
                        <td id="category_row_name_${i.id}">${i.name}</td>
                        <td id="category_row_description_${i.id}">${i.description}</td>
                        <td>
                            <button type="button" onclick="" class="btn btn-sm btn-warning text-center text-white"><i class="fa fa-eye-slash"></i></button>
                            <button type="button" onclick="editCategory(${i.id})" class="btn btn-sm btn-success text-center"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>`;
        });
        $("#table_data").html(items);
        initDataTable();
    });
}

function initDataTable() {
    if (table != null) table.destroy();
    table = new DataTable('#data_table', {
        responsive: true
    });
}

function addCategory() {
    $("#categoryModal").modal("show");
}

let edit_category_id = 0;

function editCategory(id){
    edit_category_id = id;
    api_post("catalogs/GetCategoryById",{
        id
    }).then(res =>{
        $("#name").val(res.name);
        $("#description").val(res.description);
        $("#categoryModal").modal("show");
    });
}

$(() => {
    getCategories();
})
</script>