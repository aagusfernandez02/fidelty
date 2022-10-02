<?php 
session_start(); 
if( isset($_SESSION['estado']) && $_SESSION['estado'] == 'SOCIO_LOGGED' ){
    header("Location:../fidelty/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- TOASTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles_login_register.css">
    <title>Login</title>
</head>

<body>
    <h1 class="display-4 text-center mt-4 mb-4">Bienvenido a Fidelty!</h1>
    <div class="loginContainer">
        <!-- Solapas -->
        <div id="solapaSocio" class="loginContainer_solapa active"><a href="#">Socio</a></div>
        <div id="solapaComercio" class="loginContainer_solapa noActive"><a href="./login_comercio.html">Comercio</a></div>

        <!-- Container -->
        <form class="loginContainer_formularioContainer" method="post" action="php/loginSocio.php">
            <input type="text" name="dni" class="form-control" placeholder="Dni">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="login_registerSeccion">¿No formas parte de Fidelty? <a href="./register_socio.php">Registrate acá</a></span>

            <div class="loginContainer_formularioContainer_buttons">
                <button type="reset" class="btn btn-danger loginContainer_formularioContainer_clear">LIMPIAR</button>
                <button type="submit" class="btn btn-success loginContainer_formularioContainer_submit">INICIAR SESIÓN</button>
            </div>
        </form>
        <div class="admin_section">
            <a href="#">
                <i class="fa-solid fa-key admin_logo"></i>
                <a href="./login_admin.php">ADMIN</a>
            </a>
        </div>

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
        if( isset( $_SESSION['estado'] ) && $_SESSION['estado']=="REGISTRO_OK" ) {
            $_SESSION['estado'] = null;
            echo "<script>toastr.success('Usuario registrado correctamente')</script>";
        }
        if( isset( $_SESSION['estado'] ) && $_SESSION['estado']=="SOCIO_ERROR" ) {
            $_SESSION['estado'] = null;
            echo "<script>toastr.error('Credenciales incorrectas','ERROR')</script>";
        }
    ?>
</body>

</html>