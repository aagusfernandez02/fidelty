<?php

session_start();
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'ADMIN') {
    header("Location: index.php");
}

include('php/conexion.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- TOASTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles_admin.css">
</head>

<body>
    <header>
        <h2 class="display-5 text-center"><a href="index_admin.php">Fidelty</a></h2>
        <a href="./php/funciones.php?session_destroy=true"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header>
    <a class="go_back" href="./index_admin.php">
        <i class="fa-solid fa-backward"></i>
        <div id="go_back_tooltip"> VOLVER</div>
    </a>
    <main class="main_register_comercio">
        <img src="https://webstockreview.net/images/classroom-clipart-garbage-can-7.png" alt="imagen representativa de un comercio" class="imagen_aux">
        <form class="regiter_comercio_form" method="post" action="php/deleteComercio.php">
            <h1 class="display-6 mb-3">ELIMINAR COMERCIO</h1>
            <div class="row mb-3">
                <label for="proveedor" class="col-form-label">Comercio</label>
                <?php
                $comercios = mysqli_query($conexion, "SELECT * FROM comercios");
                if (mysqli_num_rows($comercios) > 0) {
                    echo '<select class="form-select" name="cuit">';
                    $row = mysqli_fetch_assoc($comercios);
                    while ($row) {
                        echo '<option value="' . $row['cuit'] . '">' . $row['cuit'] . ' ('.$row['direccion'].')</option>';
                        $row = mysqli_fetch_assoc($comercios);
                    }
                    echo '</select>';
                } else echo 'No hay comercios registrados';
                ?>
            </div>
            <div class="loginContainer_formularioContainer_buttons">
                <!-- <button type="reset" class="btn btn-danger">LIMPIAR</button> -->
                <button type="submit" class="btn btn-danger" onclick="return confirm('??Estas seguro que desea eliminar el comercio?');">ELIMINAR</button>
            </div>
        </form>
    </main>

    <footer>
        <p class="footer_derechos">??Derechos reservados Agust??n Fernandez 2022-2023</p>
        <div class="footer_redes">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
        </div>
    </footer>
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
    if (isset($_SESSION['estado_delete']) && $_SESSION['estado_delete'] == "DELETE_COMERCIO_OK") {
        $_SESSION['estado_delete'] = null;
        echo "<script>toastr.success('Comercio retirado correctamente')</script>";
    }
    if (isset($_SESSION['estado_delete']) && $_SESSION['estado_delete'] == "DELETE_COMERCIO_ERROR") {
        $_SESSION['estado_delete'] = null;
        echo "<script>toastr.error('Comercio no existente','ERROR')</script>";
    }
    ?>
</body>

</html>