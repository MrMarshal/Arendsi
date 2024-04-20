<script src="<?php echo __ROOT__; ?>/assets/js/qr/qr-scanner.js"></script>


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
                                <div class="col-12 mt-2">
                                    <label>Descripción:</label>
                                </div>
                                <div class="col-12 mt-2">
                                    <textarea class="form-control" id="description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="image-container" style="height: 310px;overflow-y: scroll;">
                            <img src="" id="image_preview" style="width: 100%;">
                        </div>
                        <div>
                            <input type="file" id="image_select">
                        </div>
                        <fieldset class="container mt-4 pt-3">
                            <h6>Identificación QR</h6>
                            <div class="row">
                                <div class="col-4">
                                    <div style="width:120px;height: 120px;overflow: hidden;">
                                        <center>
                                            <video id="qr-scanner"
                                                style="width:240px;transform:translateX(-50%)"></video>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <label for="">Código de identificación:</label>
                                    <input type="text" class="form-control mt-2" id="cui">
                                    <label for="" id="qr-result" class="mt-2"></label>
                                </div>
                            </div>
                        </fieldset>
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
    api_post("products/SaveProduct", {
        id: edit_product_id,
        section_id: <?php echo $_GET['section']; ?>,
        name: $("#name").val(),
        category_id: $("#category_select").val(),
        subcategory_id: $("#subcategory_select").val(),
        cost: $("#cost").val(),
        price: $("#price").val(),
        stock: $("#stock").val(),
        stock_min: $("#stock_min").val(),
        description: $("#description").val(),
        code: $("#cui").val()
    }).then((result) => {
        edit_product_id = result.id;
        let imagenInput = $('#image_select')[0];
        if (imagenInput.files.length > 0) {
            api_post_file("files/UploadFile", imagenInput.files[0], {
                product_id: edit_product_id,
                folder: "products"
            }).then(res => {
                $("#image_select").val(null);
                $("#image_preview").attr("src", null);
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
        $("#cui").val("");
        $("#productModal").modal("hide");
    });
}
</script>

<script type="text/javascript">
var qrScanner = null;
var videoElement = null;

import('<?php echo __ROOT__; ?>/assets/js/qr/qr-scanner.js').then((module) => {
    videoElement = document.getElementById("qr-scanner");
    qrScanner = new QrScanner(videoElement, result => {
        console.log('decoded qr code:', result);
        qrScanner.stop();
        try {
            let res = JSON.parse(result);
            $("#cui").val(res.cui);
            $("#cui").css("border-color", "green");
            $("#cui").css("background-color", "#e1ffe1");
            $("#qr-result").html("CUI asignado correctamente");
            getProductByCode(res.cui);
        } catch (error) {
            $("#cui").css("border-color", "red");
            $("#cui").css("background-color", "#ffc5c5");
            console.log(error);
        }
        setTimeout(() => {
            $("#cui").css("border-color", "#ced4da");
            $("#cui").css("background-color", "white");
            startScanner();
        }, 500);
    });

    startScanner();
});

function startScanner() {
    if (qrScanner != null) {
        qrScanner.start().catch(err => console.error('Error starting the QR scanner:', err));
    }
    videoElement.style.transform = "scaleX(1)";
}

function getProductByCode(code) {
    api_post("products/getProductByCode", {
        code
    }).then(res => {
        console.log(res);
        if (res != null) {
            if (res.id != edit_product_id) {
                $("#cui").css("border-color", "red");
                $("#cui").css("background-color", "#ffc5c5");
                $("#qr-result").html(
                    "Ya hay un producto asignado a este QR, elige otro o da click en <a class='btn btn-link' onclick='removeCUIFromProduct(" +
                    res.id + ",\"" + code + "\")'>Quitar QR del otro producto</a>");
            }
        }
    })
}

function removeCUIFromProduct(id, code) {
    api_post("products/SaveProduct", {
        id,
        code: ""
    }).then(res => {
        $("#cui").val(code);
        $("#cui").css("border-color", "green");
        $("#cui").css("background-color", "#e1ffe1");
        $("#qr-result").html("CUI asignado correctamente");
        setTimeout(() => {
            $("#cui").css("border-color", "#ced4da");
            $("#cui").css("background-color", "white");
            $("#qr-result").html("");
            startScanner();
        }, 1500);
    })
}
</script>

<style>
#qr-scanner {
    transform: scale(3) translateX(-10%) !important;
}
</style>