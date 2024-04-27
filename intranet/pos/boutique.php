<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>


<nav class="fixed-top">
    <div class="p-2 container-fluid" style="background-color: #b59f5b">
        <div class="row">
            <div class="col-8">
                <div class="dropdown">
                    <h3 class="dropdown-toggle" type="button" id="sectionBtn" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Arensdi Boutique
                    </h3>
                    <div class="dropdown-menu" aria-labelledby="sectionBtn">
                        <a class="dropdown-item" href="<?php echo __ROOT__; ?>/cafe"
                            style="color:#000000 !important;">Pétalos café</a>
                    </div>
                </div>
            </div>
            <div class="col-2 pt-2">
                <span id="date"></span>
            </div>
            <div class="col-2 pt-2 text-right">
                <h6>
                    <div class="dropdown">
                        <h6 class="dropdown-toggle" type="button" id="userBtn" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user mr-3"></i>
                            <span id="user_name">Eduardo López</span>
                        </h6>
                        <div class="dropdown-menu" aria-labelledby="userBtn">
                            <a class="dropdown-item" href="#" style="color:#000000 !important;">Cerrar sesión</a>
                        </div>
                    </div>
                </h6>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid pt-5 mt-5">
    <div class="row h-100 justify-content-center">

        <div class="col-8">
            <div class="categories_selector_bar">
                <div class="categories_selector_inner_container" id="categories_container">
                </div>
            </div>
            <div class="container category-product" id="products_container">

            </div>



            <div class="item_viewed_title_container">
                <h4 class="item_viewed_title">Sugerencias</h4>
            </div>
            <div class="item_viewed_slider_container">
                <div class="owl-carousel owl-theme item_viewed_slider" id="bestsellers_container">

                </div>
            </div>

        </div>
        <div class="col-4">
            <fieldset>
                <div class="container blue-box">
                    <div class="row">
                        <div class="col-7" style="font-size: 15px;">
                            <!--# cuenta-->
                        </div>
                        <div class="col-5" style="font-size: 15px; text-align: right;">Total</div>

                        <div class="col-7">
                            <!--<select id="tables_select" class="form-select"></select>-->
                        </div>
                        <div class="col-5 " style="font-size: 20px; text-align: right;">
                            $<span id="order_total"></span>
                        </div>
                        <div class="row" style="margin-top: 5px; border-bottom: 1px solid white;">
                            <div class="col-2" style="font-size: 12px;">Uds.</div>
                            <div class="col-8" style="font-size: 12px;">Producto</div>
                        </div>
                        <div class="row" id="order_items_container">

                        </div>
                        <div class="col-6">
                            <a class="btn action_btn btn-danger w-100 mt-2" onclick="cancelOrder();">Cancelar</a>
                        </div>
                        <div class="col-6">
                            <a class="btn action_btn btn-success w-100 mt-2" onclick="chargeOrder();">Cobrar</a>
                        </div>

                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row h-100 justify-content-center">
        <div class="item_viewed_title_container">
            <h5 class="item_viewed_title">Buscar Producto</h5>
        </div>
        <div class="col-5 container blue-box" id="qr_reader_result">
            <div class="row">
                <div class="col-5">
                    Codigo QR
                    <div style="width:175px;height: 150px;overflow: hidden;margin-top:10px">
                        <video id="qr-scanner"></video>
                    </div>
                </div>
                <div class="col-4">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion">
                    <br>
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio">
                    <a class="btn action_btn btn-primary w-70 mt-2" onclick="chargeOrder();">Buscar</a>
                </div>
            </div>

        </div>
        <div class="col-5 container blue-box">
            Resultado de busqueda
            <div class="scanner"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
let orders = [];
let current_order = 0;
let products = [];
let categories = [];


api_post("tables/GetAllTables").then(res => {
    tables = res;
    let tables_s = "";
    res.forEach(t => {
        tables_s += `<option value="${t.id}">${t.name}</option>`;
        $("#tables_" + t.location_id).append(`
                <a onclick="showTable(${t.id})" class="btn btn-outline-info">${t.name}</a>
            `);
    });
    $("#tables_select").html(tables_s);
});

function getCategories() {
    api_post("categories/GetAllCategories", {
        section: 2
    }).then(res => {
        console.log("Categories");
        console.log(res);
        categories = res;
        let cats = `<a data-filter="all">Todo</a>`;
        categories.forEach(cat => {
            cats += `<a data-filter=".category-${cat.id}">${cat.name}</a>`;
        });
        $("#categories_container").html(cats);
        var containerEl = document.querySelector('#products_container');
        var mixer = mixitup(containerEl);
    });
}

api_post("products/GetActiveProducts", {
    section: 2
}).then(res => {
    getCategories();
    products = res;
    let prods = "";
    res.forEach(p => {
        prods += `<div class="mix category-${p.category.id} product-card" onclick="addProduct(${p.id})">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/00/Cappuccino_PeB.jpg" alt="Producto">
                    <div class="product-info">
                        <h3>${p.name}</h3>
                        <p>$${p.price}</p>
                    </div>
                </div>`;
    });

    $("#products_container").html(prods);
});

api_post("products/GetBestsellers", {
    section: 2
}).then(res => {
    let prods = "";
    res.forEach(p => {
        prods += `<div class="owl-item" onclick="addProduct(${p.id})">
                        <div
                            class="item_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product-card">
                                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924153/alcatel-smartphones-einsteiger-mittelklasse-neu-3m.jpg" alt="Producto">
                                <div class="product-info">
                                    <h3>${p.name}</h3>
                                    <p>$${p.price}</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
    });

    $("#bestsellers_container").html(prods);

    if ($('.item_viewed_slider').length) {
        var viewedSlider = $('.item_viewed_slider');
        viewedSlider.owlCarousel({
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 6000,
            nav: false,
            dots: false,
            responsive: {
                991: {
                    items: 8
                }
            }
        });
    }
});

function addProduct(id) {
    console.log(products)
    let product = products.find(x => x.id == id);
    console.log(product);
    if (!orders[current_order]) orders[current_order] = [];
    let index = orders[current_order].findIndex(x => x.product_id == id);
    if (index != -1) {
        orders[current_order][index].quantity++;
    } else {
        orders[current_order].push({
            product_id: id,
            quantity: 1,
            product
        });
    }
    printCurrentOrder();
}

function printCurrentOrder() {
    let ords = "";
    let total = 0;
    orders[current_order].forEach((o, index) => {
        ords += `<div class="container mx-0 px-0" id="order_item_${index}">
                    <div class="row order_item">
                        <div id="order_item_quantity_${index}" class="col-1 item_quantity">${o.quantity}</div>
                        <div class="col-3 px-0 ml-4">
                            <button type="button" onclick="increaseQuantity(${index})" class="btn btn-sm btn-success text-center" style="margin-left:2px;"><i class="fa fa-plus"></i></button>
                            <button type="button" onclick="decreaseQuantity(${index})" class="btn btn-sm btn-primary text-center" style="margin-left:5px;"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="col-6 item_name px-0">${o.product.name} <br> $${o.product.price}</div>
                        <div class="col-1">
                            <button type="button" onclick="deleteOrder(${index})" class="btn btn-sm btn-danger text-center"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>`;
        total += Number(o.product.price) * Number(o.quantity);
    });

    $("#order_total").html(total);

    $("#order_items_container").html(ords);
}

function decreaseQuantity(index) {
    if (orders[current_order][index].quantity == 1) {
        deleteOrder(index);
    } else {
        orders[current_order][index].quantity--;
        printCurrentOrder();
    }
}

function increaseQuantity(index) {
    console.log("Increasing quantity");
    orders[current_order][index].quantity++;
    printCurrentOrder();
}

function deleteOrder(index) {
    confirm({
        title: "Eliminar",
        text: "¿Seguro que deseas eliminar esta orden?",
        confirm: res => {
            orders[current_order].splice(index, 1);
            printCurrentOrder();
        }
    });
}
</script>


<script type="text/javascript">
function obtenerFechaActual() {
    // Retorna la fecha actual en el formato "Martes, 16 de Abril"
    const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
        'Noviembre', 'Diciembre'
    ];
    const fecha = new Date();
    const diaSemana = dias[fecha.getDay()];
    const diaMes = fecha.getDate();
    const mes = meses[fecha.getMonth()];

    return `${diaSemana}, ${diaMes} de ${mes}`;
}


$(document).ready(function() {

    $("#date").html(obtenerFechaActual());
});
</script>

<script type="text/javascript">
var qrScanner = null;
var videoElement = null;

import('<?php echo __ROOT__; ?>/assets/js/qr/qr-scanner.js').then((module) => {
    videoElement = document.getElementById("qr-scanner");
    qrScanner = new QrScanner(videoElement, result => {
        qrScanner.stop();
        try {
            let res = JSON.parse(result);
            console.log(res);
            $("#qr_reader_result").css("border-color", "#84bd84");
            $("#qr_reader_result").css("background-color", "#84bd84");
            getProductByCode(res.cui);
        } catch (error) {
            $("#qr_reader_result").css("border-color", "red");
            $("#qr_reader_result").css("background-color", "#894848");
            console.log(error);
        }
        setTimeout(() => {
            $("#qr_reader_result").css("border-color", "#4f7f94");
            $("#qr_reader_result").css("background-color", "#4f7f94");
            startScanner();
        }, 500);
    });

    startScanner();
});

function getProductByCode(code) {
    console.log(code);
    let product = products.find(x => x.code == code);
    if (product) {
        addProduct(product.id);
    } else {
        $("#qr_reader_result").css("border-color", "red");
        $("#qr_reader_result").css("background-color", "#894848");
        error("Producto no registrado en sistema");
        setTimeout(() => {
            $("#qr_reader_result").css("border-color", "#4f7f94");
            $("#qr_reader_result").css("background-color", "#4f7f94");
            startScanner();
        }, 500);
    }
}

function startScanner() {
    if (qrScanner != null) {
        qrScanner.start().catch(err => console.error('Error starting the QR scanner:', err));
    }
    videoElement.style.transform = "scaleX(1)";
}
</script>

<style>
body {
    background-color: #004564 !important;
}

* {
    color: white !important;
}

.swal2-content * {
    color: #545454 !important;
}

.swal2-header * {
    color: #545454 !important;
}

.blue-box {
    background-color: #4f7f94;
    border-radius: 10px;
    color: white;
    padding-top: 5px;
    padding-bottom: 10px;
}

.fixed-top * {
    color: white !important;
}

.change-section-btn {
    border-radius: 50%;
    /*background-color: white;*/
    color: #000000;
    width: 50px;
    height: 50px;
}

#order_items_container {
    height: 250px;
    overflow-y: scroll;
}

#tables_select {
    background-color: transparent !important;

}
</style>

<style>
.item_viewed_nav_container {
    position: absolute;
    right: -5px;
    bottom: 14px
}

.item_viewed_slider_container {
    padding-top: 13px;
    background-color: #4f7f94;
    border-radius: 10px;
    padding: 20px;
}

.item_viewed_item {
    width: 100%;
    border-radius: 2px;
    padding: 0px;
}

.item_viewed_image {
    width: 80px;
    height: 80px;
}

.item_viewed_image img {
    display: block;
    max-width: 100%;
    border-radius: 10px 10px 0px 0px;
}

.item_viewed_content {
    background-color: #386375;
    border-radius: 0px 0px 10px 10px;
}

.item_viewed_price span {
    position: relative;
    font-size: 12px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.6);
    margin-left: 8px
}

.item_viewed_price span::after {
    display: block;
    position: absolute;
    top: 6px;
    left: -2px;
    width: calc(100% + 4px);
    height: 1px;
    background: #8d8d8d;
    content: ''
}

.item_viewed_name a {
    font-size: 10px;
    color: #000000;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.categories_selector_bar {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
}

.categories_selector_inner_container {
    background-color: #4f7f94;
    padding: 5px;
    display: flex;
    align-items: center;
    border-radius: 5px;
}

.categories_selector_inner_container a {
    padding: 5px;
}

.categories_selector_inner_container a:hover {
    padding: 5px;
    background-color: #557785;

}

.categories_selector_inner_container a.active {
    background-color: #386375;
    padding: 5px;
}

.category-product {
    background-color: #4f7f94;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    padding: 10px;
    margin-bottom: 10px;
    gap: 5px;

}


.article_card {
    position: relative;
    width: 80px;
    height: 80px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    border-radius: 5px;

}

.article_image {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

.text-content {
    z-index: 2;
    /* Garantiza que el texto esté encima de la imagen */
    color: white;
    /* Color del texto para mejor visibilidad */
    font-size: 10px;
}

.date,
.title {
    backdrop-filter: blur(1px);
    background-color: rgba(0, 0, 0, 0.5);
    /* Fondo oscuro semitransparente para mejorar legibilidad */
    padding: 5px 10px;
    /* Padding para el texto */
    border-radius: 5px;
    /* Bordes redondeados */
    text-align: left;
    /* Alineación del texto a la izquierda */
}

.form-select option {
    background-color: #004564;
    backdrop-filter: blur(1px);
}

#order_items_container {
    display: block;
}

.order_item {
    background-color: #386375;
    border-radius: 5px;
    align-items: center;
    padding: 5px;
    margin-top: 5px;
}

.item_quantity {
    width: 25px;
    height: 25px;
    background-color: #004564;
    text-align: center;
    border-radius: 5px;
    padding: 2px;
}

.item_name {
    font-size: 10px;
}

.action_btn {
    font-size: 15px;
    margin-top: 0px;
    margin-bottom: 10px;
}

.scanner {
    width: 150px;
    height: 150px;
    border: 3px solid white;
    /* Puedes ajustar el grosor del borde aquí */
    border-radius: 5px;
    margin-top: 5px 10px 10px 10px;
}

/* Clases para el card de los productos */
.product-card {
    width: 80px;
    height: 80px;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
    display: flex;
}

.product-card img {
    flex: 1;
    width: auto;
    height: auto;
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.product-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    padding: 5px;
    box-sizing: border-box;
    text-align: center;
}

.product-info h3,
.product-info p {
    margin: 0;
    font-size: 10px;
    line-height: 1.2;
}
</style>

<style>
#qr-scanner {
    transform: scale(3) translateX(-10%) !important;
}
</style>