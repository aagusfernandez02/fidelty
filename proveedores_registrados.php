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
    <h1 class="display-4 text-center mt-4 mb-4">Proveedores registrados</h1>
    <main>
        <form class="searchbar_container" method="get" action="proveedores_registrados.php">
            <div class="searchbar">
                <input name="proveedor" type="text" class="form-control" placeholder="Razon social proveedor">
                <button type="submit" class="btn btn-light"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <?php  if(isset($_GET['proveedor']) AND $_GET['proveedor']!="") echo "<h6>Razon social: ".$_GET['proveedor']."</h6>" ?>
        <table class="tabla mt-4">
                <?php
                include("php/conexion.php");
                if (isset($_GET['proveedor']) and $_GET['proveedor'] != '') {
                    $result = mysqli_query($conexion, "SELECT * FROM proveedores WHERE razon_social LIKE '%".$_GET['proveedor']."%' ORDER BY razon_social");
                } else {
                    $result = mysqli_query($conexion, "SELECT * FROM proveedores ORDER BY razon_social");
                }
                if( mysqli_num_rows($result)>0 ){
                    echo "
                    <caption></caption>
                        <thead>
                            <tr>
                                <th>Razon social</th>
                                <th>Telefono</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>";
                    $row = mysqli_fetch_assoc($result);
                    while ($row) {
                        echo "
                            <tr>
                                <td>" . $row['razon_social'] . "</td>
                                <td>" . $row['telefono'] . "</td>
                                <td>" . $row['email'] . "</td>
                            </tr>
                        ";
                        $row = mysqli_fetch_assoc($result);
                    }
                    echo "</tbody>";
                } else {
                    echo "No hay proveedores registrados";
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
</body>

</html>