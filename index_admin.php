<?php 

session_start(); 
if( !isset($_SESSION['estado']) || $_SESSION['estado'] != 'ADMIN' ){
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
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles_admin.css">
</head>

<body>
    <header>
        <h2 class="display-5 text-center"><a href="index_admin.php">Fidelty</a></h2>
        <a href="php/funciones.php?session_destroy=true"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header>
    <main class="main_admin">
        <img class="imagen_aux" src="img/admin.png" alt="Imagen representativa de un administrador">
        <div class="admin-options-container">
            <h1 class="display-6 text-center">OPCIONES DE ADMINISTRADOR</h1>
            <ul style="list-style:none;">
                <li class="fw-bold lead">- Premios</li>
                <li><a href="create_premio.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crear premio</a></li>
                <li><a href="tabla_premios.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ver/editar/eliminar premios</a></li>
                <li class="fw-bold lead">- Proveedores</li>
                <li><a href="proveedores_registrados.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proveedores registrados</a></li>
                <li><a href="create_proveedor.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrar proveedor</a></li>
                <li><a href="delete_proveedor.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar proveedor</a></li>
                <li class="fw-bold lead">- Comercios</li>
                <li><a href="register_comercio.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrar comercio</a></li>
                <li><a href="delete_comercio.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar comercio</a></li>
                <li><a href="actividad_red.php" class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actividad de la red</a></li>
                <li class="fw-bold lead"><a href="canjes_socios.php">- Canjes socios</a></li>
                <li class="fw-bold lead"><a href="premios_debajo_reposicion.php">- Premios debajo del punto de reposici??n</a></li>
                <li class="fw-bold lead"><a href="registrar_remito.php">- Registrar remitos</a></li>
            </ul>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>