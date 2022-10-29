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
            <ul>
                <li><a href="create_premio.php" class="lead">Crear premio</a></li>
                <li><a href="tabla_premios.php" class="lead">Ver/editar/eliminar premios</a></li>
                <li><a href="register_comercio.php" class="lead">Registrar comercio</a></li>
                <li><a href="delete_comercio.php" class="lead">Dar de baja comercio</a></li>
                <li><a href="canjes_socios.php" class="lead">Canjes socios</a></li>
                <li><a href="delete_comercio.php" class="lead">Actividades red</a></li>
            </ul>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>