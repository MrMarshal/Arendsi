<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>

<nav class="fixed-top">
    <div class="p-4 container-fluid" style="background-color: #b59f5b">
        <div class="row">
            <div class="col-8">
                <div class="dropdown">
                    <h3 class="dropdown-toggle" type="button" id="sectionBtn" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Pétalos Café
                    </h3>
                    <div class="dropdown-menu" aria-labelledby="sectionBtn">
                        <a class="dropdown-item" href="#" style="color:#000000 !important;">Arendsi Boutique</a>
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
        <div class="col-8" id="tables_container">
            <h4>Interior</h4>
            <div id="tables_1"></div>
            <h4>Exterior</h4>
            <div id="tables_2"></div>
        </div>
        <div class="col-4">
            <h4>En barra</h4>
            <div id="tables_3"></div>
            <br>
            <a onclick="newOrder()" class="btn btn-success">Nueva Cuenta</a>
        </div>
        <div class="col-8">
            <div class="item_viewed_title_container">
                <h3 class="item_viewed_title">Más vendidos</h3>
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
                        <div class="col-7 pt-2">
                            <select id="tables_select" class="form-control"></select>
                        </div>
                        <div class="col-5">
                            Total<br><span id="order_total">$00.00</span>
                        </div>
                        <div class="col-12" id="order_items_container"></div>
                        <div class="col-12">
                            <a class="btn btn-outline-primary w-100 mt-2" onclick="closeOrdes();">Cerrar Cuenta</a>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-outline-secondary w-100 mt-2" onclick="printOrder();">Imprimir</a>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-outline-success w-100 mt-2" onclick="chargeOrder();">Cobrar</a>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-outline-danger w-100 mt-2" onclick="cancelOrder();">Cancelar</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<script type="text/javascript">
let tables = [];
let current_table = 0;

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

api_post("products/GetBestsellers").then(res => {
    let prods = "";
    res.forEach(p => {
        prods += `<div class="owl-item">
                        <div
                            class="item_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="item_viewed_image"><img
                                    src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560924153/alcatel-smartphones-einsteiger-mittelklasse-neu-3m.jpg"
                                    alt=""></div>
                            <div class="item_viewed_content text-center">
                                <div class="item_viewed_price">$${p.price}</div>
                                <div class="item_viewed_name"><a href="#">${p.name}</a></div>
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
})

function showTable(id) {

}

function showCurrentOrder() {
    //order_items_container 
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

<style>
body {
    background-color: #004564 !important;
}

* {
    color: white !important;
}

.blue-box {
    background-color: #4f7f94;
    border-radius: 10px;
    color: white;
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
    padding: 30px;
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
    max-width: 100%
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
</style>