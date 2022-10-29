<?php

session_start();
if (!isset($_SESSION['estado']) and $_SESSION['estado'] != 'COMERCIO') {
    header("Location: index.php");
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comercio</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- TOASTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles_comercio.css">
</head>

<body>
    <header>
        <h2 class="display-5 text-center"><a href="index_admin.php">Fidelty</a></h2>
        <a href="php/funciones.php?session_destroy=true"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header>
    <a class="go_back" href="index_admin.php">
        <i class="fa-solid fa-backward"></i><div id="go_back_tooltip"> VOLVER</div>
    </a>
    <main class="">
        <form class="form_ingreso_venta" method="post" action="">
            <h1 class="display-6 mb-3">REGISTRAR COMPRA</h1>
            <div class="row mb-3">
                <label for="nombre" class="col-sm-2 col-form-label">DNI Socio</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nombre" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="monto" class="col-sm-2 col-form-label">Monto ($)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="monto" placeholder="$15000" required>
                </div>
            </div>
            <div class="formularioContainer_buttons">
                <button type="reset" class="btn btn-danger">LIMPIAR</button>
                <button type="submit" class="btn btn-success">REGISTRAR</button>
            </div>
        </form>
    </main>

    <footer>
        <p class="footer_derechos">©Derechos reservados Agustín Fernandez 2022-2023</p>
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