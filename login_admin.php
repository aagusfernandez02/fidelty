<?php 
    session_start(); 
    if( isset($_SESSION['estado']) && $_SESSION['estado'] == 'ADMIN' ){
        header("Location: index_admin.php");
    } else if( isset($_SESSION['estado']) && $_SESSION['estado'] == 'SOCIO' ){
        header("Location: index_socio.php");
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
    <div class="loginContainer adminContainer">
        <!-- Solapas -->
        <div id="solapaSocio" class="loginContainer_solapa adminSolapas noActive"><a href="login_socio.php">Socio</a></div>
        <div id="solapaComercio" class="loginContainer_solapa adminSolapas noActive"><a href="login_comercio.html">Comercio</a></div>

        <!-- Container -->
        <form class="loginContainer_formularioContainer" method="post" action="php/loginAdmin.php">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>

            <div class="loginContainer_formularioContainer_buttons">
                <button type="reset" class="btn btn-danger loginContainer_formularioContainer_clear">LIMPIAR</button>
                <button type="submit" class="btn btn-success loginContainer_formularioContainer_submit">INICIAR SESIÓN</button>
            </div>
        </form>

        <!-- <img src="https://cdn-icons-png.flaticon.com/512/2317/2317407.png" alt="imagen candado acceso" class="form_image"> -->
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
    if (isset($_SESSION['estado']) && $_SESSION['estado'] == "ADMIN_ERROR") {
        $_SESSION['estado'] = null;
        echo "<script>toastr.error('Credenciales incorrectas','ERROR')</script>";
    }
    ?>
</body>

</html>