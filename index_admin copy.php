<?php 

session_start(); 
if( !isset($_SESSION['estado']) || $_SESSION['estado'] != 'ADMIN' ){
    header("Location:../login_admin.php");
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
    <link rel="stylesheet" href="css/styles_tabla.css">
</head>

<body>
    <header>
        <h2 class="display-5 text-center"><a href="index_admin.php">Fidelty</a></h2>
        <a href="php/funciones.php?session_destroy=true"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header>
    <main class="main_admin">
    <table class="demo">
        <caption>Premios</caption>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Saldo</th>
                <th>Stock</th>
                <th>Pto. reposicion</th>
                <th>Imagen</th>
                <th>EDITAR</th>
                <th>ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include("php/conexion.php");
                $result = mysqli_query($conexion, "SELECT * FROM premios");
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo "
                        <tr>
                            <td>".$row['nombre']."</td>
                            <td>".$row['descripcion']."</td>
                            <td>".$row['stock']."</td>
                            <td>".$row['saldo']."</td>
                            <td>".$row['punto_reposicion']."</td>
                            <td><button type='button' class='btn btn-secondary'><a href=''>VER</a></button></td>
                            <td><button type='button' class='btn btn-success'><a href='edit_premio.php?id-premio=".$row['id']."'>EDITAR</a></button></td>
                            <td><button type='button' class='btn btn-danger'><a href=''>ELIMINAR</a></button></td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>