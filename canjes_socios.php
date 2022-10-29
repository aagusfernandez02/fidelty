<?php

session_start();
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'ADMIN') {
    header("Location: index.php");
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
    <link rel="stylesheet" href="css/styles_canjes.css">
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
    <main class="main_admin_canjes-socios">
        <form class="searchbar_container" method="get" action="canjes_socios.php">
            <div class="searchbar">
                <input name="socio" type="text" class="form-control" placeholder="DNI socio">
                <button type="submit" class="btn btn-light"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <?php  if(isset($_GET['socio']) AND $_GET['socio']!="") echo "<h6>DNI: ".$_GET['socio']."</h6>" ?>
        <table class="tabla mt-4">
                <?php
                include("php/conexion.php");
                if (isset($_GET['socio']) and $_GET['socio'] != '') {
                    $result = mysqli_query($conexion, "SELECT c.fecha, c.dni_socio, p.nombre FROM premios p, canjes c WHERE p.id = c.id_premio AND c.dni_socio ='" . $_GET['socio'] . "' ORDER BY c.fecha DESC");
                } else {
                    $result = mysqli_query($conexion, "SELECT c.fecha, c.dni_socio, p.nombre FROM premios p, canjes c WHERE p.id = c.id_premio ORDER BY c.dni_socio");
                }
                if( mysqli_num_rows($result)>0 ){
                    echo "
                    <caption>Canjes</caption>
                        <thead>
                            <tr>
                                <th>Fecha canje</th>
                                <th>DNI socio</th>
                                <th>Premio</th>
                            </tr>
                        </thead>
                        <tbody>";
                    $row = mysqli_fetch_assoc($result);
                    while ($row) {
                        echo "
                            <tr>
                                <td>" . $row['fecha'] . "</td>
                                <td>" . $row['dni_socio'] . "</td>
                                <td>" . $row['nombre'] . "</td>
                            </tr>
                        ";
                        $row = mysqli_fetch_assoc($result);
                    }
                    echo "</tbody>";
                } else {
                    echo "No hay premios registrados";
                }
                ?>
        </table>
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
    <?php
    if (isset($_SESSION['estado_delete']) && $_SESSION['estado_delete'] == "DELETE_PREMIO_OK") {
        $_SESSION['estado_delete'] = null;
        echo "<script>toastr.success('Premio eliminado correctamente')</script>";
    }
    if (isset($_SESSION['estado_delete']) && $_SESSION['estado_delete'] == "DELETE_PREMIO_ERROR") {
        $_SESSION['estado_delete'] = null;
        echo "<script>toastr.error('Error en la eliminación del premio','ERROR')</script>";
    }
    if (isset($_SESSION['estado_update']) && $_SESSION['estado_update'] == "UPDATE_PREMIO_OK") {
        $_SESSION['estado_update'] = null;
        echo "<script>toastr.success('Premio actualizado correctamente')</script>";
    }
    if (isset($_SESSION['estado_update']) && $_SESSION['estado_update'] == "UPDATE_PREMIO_ERROR") {
        $_SESSION['estado_update'] = null;
        echo "<script>toastr.error('Error en la actualización del premio','ERROR')</script>";
    }
    ?>
</body>

</html>