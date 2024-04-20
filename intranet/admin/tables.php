<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-4">
                    <div class="col-9 pt-1">
                        <h6 class="mb-4">Mesas</h6>
                    </div>
                    <div class="col-3">
                        <button type="button" onclick="addTable();" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus me-2"></i>Agregar
                            mesa</button>
                    </div>
                </div>
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ubicación</th>
                            <th scope="col">Nombre</th>
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

function getTables() {
    api_post("tables/GetAllTables").then(res => {
        $("#table_data").html("");
        let items = "";
        res.forEach(i => {
            items += `<tr>
                        <th scope="row">${i.id}</th>
                        <td id="table_row_location_${i.id}">${i.location.name}</td>
                        <td id="table_row_name_${i.id}">${i.name}</td>
                        <td>
                            <button type="button" onclick="toggleTable(${i.id})" class="btn btn-sm btn-warning text-center text-white"><i class="fa fa-eye-slash"></i></button>
                            <button type="button" onclick="editTable(${i.id})" class="btn btn-sm btn-success text-center"><i class="fa fa-edit"></i></button>
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

function addTable() {
    $("#tableModal").modal("show");
}

let edit_table_id = 0;

function editTable(id) {
    edit_table_id = id;
    api_post("tables/GetTableById", {
        id
    }).then(res => {
        $("#name").val(res.name);
        $("#location_select").val(res.location_id);
        $("#tableModal").modal("show");
    });
}

function saveTable() {
    api_post("tables/SaveTable", {
        id:edit_table_id,
        name:$("#name").val(),
        location_id:$("#location_select").val()
    }).then(res=>{
        $("#table_row_location_"+edit_table_id).html($("#location_select option:selected").text());
        $("#table_row_name_"+edit_table_id).html($("#name").val());
        $("#name").val("");
        $("#location_select").val(0);
        $("#tableModal").modal("hide");
        if (edit_table_id!=0){
            getTables();
        }
        edit_table_id = 0;
        alert({title:"Listo!",text:"Guardado con éxito"});
    })
}

function getLocations(){
    api_select("location_select","catalogs/GetAllLocations");
}

$(() => {
    getTables();
    getLocations();
})
</script>