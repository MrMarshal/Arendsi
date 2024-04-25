<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>

<nav class="fixed-top">
    <div class="p-2 container-fluid" style="background-color: #b59f5b">
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
       
        <div class="col-8">
            <div class="categories_selector_bar">
                <div class="categories_selector_inner_container">
                    <a data-filter="all" href="#category1">Todo</a>
                    <a data-filter=".category-a" href="#category1">Categoría 1</a>
                    <a data-filter=".category-b" href="#category2">Categoría 2</a>
                    <a data-filter=".category-c" href="#category3">Categoría 3</a>
                </div>
            </div>
            <div class="container category-product" id="categories_container">
                <div class="mix category-a product-card">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/00/Cappuccino_PeB.jpg" alt="Producto">
                    <div class="product-info">
                        <h3>Capuchino</h3>
                        <p>$60.XX</p>
                    </div>
                </div>
                <div class="mix category-b product-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfYXlOqhT4Qpm8UFqMvlkYWRYWSg2rNXC-_GWzE-tl4sGteSW_5GYwfHryRYkDbr2x7EA&usqp=CAU" alt="Producto">
                    <div class="product-info">
                        <h3>Capuchino Cream</h3>
                        <p>$60.XX</p>
                    </div>
                </div>
                <div class="mix category-c product-card">
                    <img src="https://www.tasteofhome.com/wp-content/uploads/2023/03/TOH-espresso-GettyImages-1291298315-JVcrop.jpg" alt="Producto">
                    <div class="product-info">
                        <h3>Espresso Doble</h3>
                        <p>$60.XX</p>
                    </div>
                </div>
                <div class="mix category-a product-card">
                    <img src="https://images.immediate.co.uk/production/volatile/sites/30/2020/08/flat-white-d8ada0f.jpg" alt="Producto">
                    <div class="product-info">
                        <h3>Flat white</h3>
                        <p>$60.XX</p>
                    </div>
                </div>
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
                        <div class="col-7" style="font-size: 15px;" ># cuenta</div>
                        <div class="col-5" style="font-size: 15px; text-align: right;">Total</div>
                        
                        <div class="col-7">
                            <select id="tables_select" class="form-select"></select>
                        </div>
                        <div class="col-5 " style="font-size: 20px; text-align: right;"><span id="order_total">$00.00</span>
                        </div>
                        <div class="row" style="margin-top: 5px; border-bottom: 1px solid white;">
                            <div class="col-2" style="font-size: 12px;">Uds.</div>
                            <div class="col-8" style="font-size: 12px;">Producto</div>
                        </div>
                        <div class="col-12 container" id="order_items_container">
                            <div class="row order_item">
                                <div class = "col-1 item_quantity">3</div>
                                <div class = "col-8 item_name"> Champurrado de chocolate <br> $50</div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-primary text-center"><i class="fa fa-trash"></i></button>
                                    </div>
                            </div>
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
        <div class="col-5 container blue-box">
            <div class="row">        
                <div class="col-5">
                    Codigo de barra o QR
                    <div class = "scanner"></div>
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
            <div class = "scanner"></div>
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
})

function showTable(id) {

}

function showCurrentOrder() {
    //order_items_container 
}
</script>

<!-- Categorizador de productos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
<script>
    var containerEl = document.querySelector('#categories_container');
    var mixer = mixitup(containerEl);
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
.item_viewed_content{
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

.categories_selector_inner_container a{
    padding: 5px;
}
.categories_selector_inner_container a:hover{
    padding: 5px;
    background-color: #557785;

}

.categories_selector_inner_container a.active{
    background-color: #386375;
    padding: 5px;
}

.category-product{
    background-color: #4f7f94;
    border-radius: 10px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    padding: 10px;
    margin-bottom:10px;
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

.article_image{
    position: absolute;
    width: 100%; 
    height: 100%;
    object-fit: cover;
    z-index: 1;
}
.text-content {
    z-index: 2; /* Garantiza que el texto esté encima de la imagen */
    color: white; /* Color del texto para mejor visibilidad */
    font-size: 10px;
}
.date, .title {
    backdrop-filter: blur(1px);
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semitransparente para mejorar legibilidad */
    padding: 5px 10px; /* Padding para el texto */
    border-radius: 5px; /* Bordes redondeados */
    text-align: left; /* Alineación del texto a la izquierda */
}

.form-select option{
    background-color: #004564;
    backdrop-filter: blur(1px);
}

.order_item{
    background-color:  #386375;
    border-radius: 5px;
    align-items: center;
    padding: 5px;
    margin: 5px;
}
.item_quantity{
    width: 25px; 
    height: 25px;
    background-color:#004564;
    text-align: center;
    border-radius: 5px;
    padding: 2px;
}
.item_name{
    font-size: 10px;
}
.action_btn{
    font-size: 15px;
    margin-top: 0px;
    margin-bottom: 10px;
}
.scanner {
    width: 150px;
    height: 150px;
    border: 3px solid white; /* Puedes ajustar el grosor del borde aquí */
    border-radius: 5px;
    margin-top: 5px  10px 10px 10px;
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
