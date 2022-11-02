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
    <a class="go_back" href="premios_debajo_reposicion.php">
        <i class="fa-solid fa-backward"></i>
        <div id="go_back_tooltip"> VOLVER</div>
    </a>
    <h1 class="display-4 text-center mt-4 mb-4">Pedidos de reposición</h1>
    <main>
        <table class="tabla mt-4">
                <?php
                include("php/conexion.php");

                $result = mysqli_query($conexion,"SELECT DISTINCT proveedor FROM premios WHERE premios.punto_reposicion IS NOT NULL AND premios.stock < premios.punto_reposicion");
                
                if( mysqli_num_rows($result)>0 ){
                    echo "
                    <div class='d-flex'>
                        <button type='button' class='btn btn-success me-3'><a href='php/pdfPedidosReposicion.php' target='_blank'>VER TODOS</a></button>
                        <button type='button' class='btn btn-success'><a href='php/pdfPedidosReposicion.php?send_email=true' target='_blank'>GENERAR Y ENVIAR TODOS</a></button>
                    </div>
                    <caption>Proveedores con faltante</caption>
                    <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Ver pedido</th>
                            <th>Generar y enviar pedido</th>
                        </tr>
                    </thead>
                    <tbody>";
                    $row = mysqli_fetch_assoc($result);
                    while ($row) {
                        echo "
                            <tr>
                                <td>" . $row['proveedor'] . "</td>
                                <td><button type='button' class='btn btn-light'><a href='php/pdfPedidosReposicion.php?send_email=false&proveedor=".$row['proveedor']."' target='_blank'>VER</a></button></td>
                                <td><button type='button' class='btn btn-light'><a href='php/pdfPedidosReposicion.php?send_email=true&proveedor=".$row['proveedor']."' target='_blank'>GENERAR Y ENVIAR</a></button></td>
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