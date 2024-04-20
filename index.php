<?php
    require 'flight/Flight.php';
    include "classes/LoadModels.php";

   $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

   $whitelist = array(
       '127.0.0.1',
       '::1'
   );

   if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        define('__ROOT__', "https://drjuanjerezano.com/v2");
    }else{
        define('__ROOT__', "http://localhost/sinergia/web/arendsi");
    }

    ini_set('session.gc_maxlifetime', 999999999);
    session_set_cookie_params(999999999); 
    session_start();


    Flight::route("/api/@controller/@action",function($controller,$action)
    {
        $admin = new Model();
        $p = json_decode(file_get_contents("php://input"),true);
        if (!empty($p)) $_POST = $p; 
        if (!empty($_POST)) $data = new Request($_POST);
        else $data = new Request($_GET); 
        echo json_encode($admin->$controller->$action($data));
    });

    Flight::route('/', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('index', ['title' => 'Administrador']);
    });

    Flight::route('/login', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('account/login', ['title' => 'Iniciar Sesión',"navbar"=>false]);
    });

    Flight::route('/main', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('dashboard/index', ['title' => 'Elegir',"navbar"=>false]);
    });

    Flight::route('/pos', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('pos/index', ['title' => 'Elegir',"navbar"=>false]);
    });

    Flight::route('/cafe', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('pos/cafe', ['title' => 'Elegir',"navbar"=>false]);
    });

    Flight::route('/boutique', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('pos/boutique', ['title' => 'Elegir',"navbar"=>false]);
    });



    Flight::route('/admin', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('admin/index', ['title' => 'Elegir']);
    });


    Flight::route('/admin/sales', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('dashboard/sales', ['title' => 'Elegir',"navbar"=>false]);
    });

    Flight::route('/admin/stock', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('admin/stock', ['title' => 'Stock']);
        /*if ($_GET['section']==1){
            Flight::modal("stock_coffe");
        }*/
        //if ($_GET['section']==2){
            Flight::modal("stock_boutique");
        //}
    });

    Flight::route('/admin/categories', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('admin/categories', ['title' => 'Categories']);
        Flight::modal("categories");
    });

    Flight::route('/admin/subcategories', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('admin/subcategories', ['title' => 'Subcategories']);
        Flight::modal("subcategories");        
    });


    Flight::route('/admin/tables', function () {
        Flight::set('flight.views.path', 'intranet');
        Flight::render('admin/tables', ['title' => 'Mesas']);
        Flight::modal("tables");
    });



    Flight::start();

?>