<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles_login_register.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- TOASTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Login</title>
</head>

<body>
    <h1 class="display-4 text-center mt-4 mb-4">Bienvenido a Fidelty!</h1>
    <div class="loginContainer">
        <!-- Solapas -->
        <div id="solapaSocio" class="loginContainer_solapa active"><a href="#">Socio</a></div>
        <div id="solapaComercio" class="loginContainer_solapa noActive"><a href="./login_comercio.html">Comercio</a></div>

        <!-- Container -->
        <form class="registerContainer_formularioContainer" method="post" action="./php/register.php">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nombre</span>
                <input required type="text" class="form-control" name="nombre">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Apellido</span>
                <input required type="text" class="form-control" name="apellido">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">DNI</span>
                <input required type="text" class="form-control" name="dni" maxlength="8">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                <input required type="email" class="form-control" name="email">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de nacimiento</span>
                <input required type="date" class="form-control" name="fecha_nacimiento">
            </div>
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Contraseña</span>
                <input required type="password" class="form-control" name="password">
            </div>
            <span class="login_registerSeccion">¿Ya sos parte de Fidelty? <a href="./login_socio.php">Inicia sesión</a></span>
            <div class="loginContainer_formularioContainer_buttons">
                <button type="reset" class="btn btn-danger loginContainer_formularioContainer_clear">Limpiar</button>
                <button type="submit" class="btn btn-success loginContainer_formularioContainer_submit">Registrarse</button>
            </div>
        </form>

    </div>
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/8d1cfe94fb.js" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- TOASTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- JS -->
    <?php 
        if( isset( $_SESSION['estado'] ) && $_SESSION['estado']=="REGISTRO_ERROR" ) {
            $_SESSION['estado'] = null;
            echo "<script>toastr.error('Usuario ya registrado','ERROR')</script>";
        }
    ?>
</body>

</html>