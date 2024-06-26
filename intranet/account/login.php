<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-8 col-xl-8">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="index.html" class="">
                        <h3 class="text-primary">Administrador</h3>
                    </a>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="username">
                    <label for="floatingInput">Usuario</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button type="submit" class="btn btn-primary py-3 w-100 mb-4" onclick="login();">Acceder</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function login() {
        location.href = "<?php echo __ROOT__; ?>/main"
    }
</script>