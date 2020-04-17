<?php
@include_once("controller/_Configuration.php");
@include_once("controller/_ValidSession_Logout.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/media/logos/logo_deza_ico.png">

    <title>Deza | Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/pages/login/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form id="form" class="form-signin">
        <img class="mb-4" src="assets/media/logos/logo_deza_full.png" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Por favor Ingrese</h1>
        <label for="inputEmail" class="sr-only">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="clave" name="clave" class="form-control" placeholder="Password">
        <input type="hidden" id="action" name="action" value="login">
        <!-- <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div> -->
        <button type="submit" class="btn btn-lg btn-primary btn-block" id="btnIngresar">Ingresar</button>
        <p class="mt-5 mb-3 text-muted">2020 © Sky Technologies</p>
    </form>
    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "metal": "#c4c5d6",
                    "light": "#ffffff",
                    "accent": "#00c5dc",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995",
                    "focus": "#9816f4"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>
    <!-- end::Global Config -->
    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="assets/js/scripts.bundle.js" type="text/javascript"></script>
    <script src="assets/js/pages/components/bootbox/bootbox.all.min.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->
    <script>
        $("#form").validate({
            rules: {
                usuario: {
                    required: true,
                    maxlength: 20
                },
                clave: {
                    required: true,
                    maxlength: 20
                }
            },
            submitHandler: function(form) {
                login();
            }
        });

        function login() {
            postJSONForm("_Login_C.php", "form", function(data) {
                if (!validErrorResponse(data)) {
                    dataResponse = JSON.parse(data)[0];
                    if (typeof dataResponse === 'undefined') {
                        $("#btnIngresar").before('<div class="error invalid-feedback" style="display: block; font-size: 15px;">Usuario o Password Incorrecto.</div>');
                    } else {
                        location.href = "admin.php";
                    }
                }
            });
        }
    </script>
</body>

</html>