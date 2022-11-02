<?php

session_start();
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'ADMIN') {
    header("Location: index.php");
}
include('php/conexion.php');

if (isset($_GET['cantidad']) and $_GET['cantidad'] != "") {
    $cantidad_premios = $_GET['cantidad'];
}
if (isset($_GET['proveedor']) and $_GET['proveedor'] != "") {
    $proveedor = $_GET['proveedor'];
}

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
        <a href="php/funciones.php?session_destroy=true"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header>
    <a class="go_back" href="index_admin.php">
        <i class="fa-solid fa-backward"></i>
        <div id="go_back_tooltip"> VOLVER</div>
    </a>
    <main class="d-flex flex-column justify-content-start align-items-center">
        <form class="regiter_comercio_form" method="get" action="registrar_remito.php">
            <h1 class="display-5 mb-3">REGISTRAR REMITO</h1>
            <div class="row justify-content-between align-items-center">
                <div class="col-5 row mb-3">
                    <label for="proveedor" class="col-sm-2 col-form-label">Proveedor</label>
                    <?php
                    $proveedores = mysqli_query($conexion, "SELECT * FROM proveedores");
                    if (mysqli_num_rows($proveedores) > 0) {
                        echo '<select class="form-select" name="proveedor">';
                        $row = mysqli_fetch_assoc($proveedores);
                        while ($row) {
                            if (isset($proveedor) and $proveedor == $row['id_proveedor']) {
                                echo '<option value="' . $row['id_proveedor'] . '" selected>' . $row['razon_social'] . '</option>';
                            }
                            echo '<option value="' . $row['id_proveedor'] . '">' . $row['razon_social'] . '</option>';
                            $row = mysqli_fetch_assoc($proveedores);
                        }
                        echo '</select>';
                    } else echo 'No hay proveedores registrados';
                    ?>
                </div>
                <div class="col-7 row mb-3">
                    <label for="cantidad" class="col-sm-5 col-form-label text-end">Cantidad premios</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="cantidad" min="1" value='<?php if (isset($cantidad_premios)) echo $cantidad_premios;                                                                      else echo 1; ?>'>
                    </div>
                </div>
            </div>

            <div class="loginContainer_formularioContainer_buttons mt-3">
                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-arrows-rotate"></i></button>
            </div>
        </form>
        <?php  if(isset($cantidad_premios)){
        echo 
        '<form class="regiter_comercio_form mt-5" method="post" action="php/registrar_premios_remito.php">
            <input value="' . $proveedor . '" name="proveedor" style="display:none;"></input>
            <div class="input-group mb-3">
                <span class="input-group-text">Imagen remito</span>
                <input required type="text" name="img" class="form-control" placeholder="https://www.urlHosting.com/imgRemito" aria-label="imagen remito">
            </div>';
            for ($i = 0; $i < $cantidad_premios; $i++) {
                $premios = mysqli_query($conexion, "SELECT premios.id, premios.saldo, premios.stock, premios.punto_reposicion, premios.img, premios.nombre, premios.descripcion, premios.proveedor FROM premios, proveedores WHERE premios.proveedor = proveedores.razon_social AND proveedores.id_proveedor=$proveedor;");
                if (mysqli_num_rows($premios) > 0) {
                    echo '<div class="row mb-3">';
                    echo '<div class="col-10"><select class="form-select" name="premio'.$i.'">';
                    $premio = mysqli_fetch_assoc($premios);
                    while ($premio) {
                        echo '<option value="' . $premio['id'] . '">' . $premio['nombre'] . '</option>';
                        $premio = mysqli_fetch_assoc($premios);
                    }
                    echo '</select></div>';
                    echo '<div class="col-2"><input type="number" class="form-control" name="cant_premio'.$i.'" min="1" value="1"></div>';
                    echo '</div>';
                }
            }
            echo '
            <div class="loginContainer_formularioContainer_buttons mt-3">
                <button type="submit" class="btn btn-success">REGISTRAR</button>
            </div>
        </form>
        ';
        }?>
        

    </main>

    <footer class="mt-3">
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
    if (isset($_SESSION['estado_registro']) && $_SESSION['estado_registro'] == "REGISTRO_REMITO_OK") {
        $_SESSION['estado_registro'] = null;
        echo "<script>toastr.success('Remito registrado correctamente')</script>";
    }
    ?>
</body>

</html>