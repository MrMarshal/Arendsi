<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ADMIN - Arendsi</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo __ROOT__; ?>/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo __ROOT__; ?>/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo __ROOT__; ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo __ROOT__; ?>/assets/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?php echo __ROOT__; ?>/assets/js/api-post.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">
    window.alert = function(params) {
        if (!params.text) {
            let a = params;
            params = {
                text: a
            };
        }
        if (params.title == "Error") {
            params.icon = "error";
        }
        Swal.fire({
            title: params.title || "Alert",
            text: params.text || "Alert",
            confirmButtonText: params.button || "Okay", // Text on button
            icon: params.icon || "success", //built in icons: success, warning, error, info
            timer: params.time || 3000, //timeOut for auto-close
        });
    }
    window.error = (text) => alert({
        title: "Error",
        text
    });

    window.confirm = function(params) {
        if (!params.text) {
            let a = params;
            params = {
                text: a
            };
        }
        if (params.title == "Error") {
            params.icon = "error";
        }
        Swal.fire({
            title: params.title || "Confirm",
            icon: params.icon || "success",
            html: params.text || "Alert",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            reverseButtons: true,
            cancelButtonText: '' + (params.cancelBtn || "Cancel"),
            cancelButtonAriaLabel: 'Thumbs down',
            confirmButtonText: '' + (params.confirmBtn || "Confirm"),
            confirmButtonAriaLabel: 'Thumbs up, great!'
        }).then((result) => {
            if (result.isConfirmed) {
                params.confirm();
            }
        })
    }
    </script>

</head>

<body>
    <div class="container-xxl position-relative p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>