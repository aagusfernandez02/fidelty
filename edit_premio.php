<?php

session_start();
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'ADMIN') {
    header("Location: index.php");
}

if( isset($_GET['id-premio']) and $_GET['id-premio']!="" ){
    include('php/conexion.php');
    $consulta_premio_editar = mysqli_query($conexion, "SELECT * FROM premios WHERE id=".$_GET['id-premio']);
    $resultado_premio_editar = mysqli_num_rows($consulta_premio_editar);
    if($resultado_premio_editar > 0){
        $premio_editar = mysqli_fetch_assoc($consulta_premio_editar);
    }
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
    <a class="go_back" href="tabla_premios.php">
        <i class="fa-solid fa-backward"></i><div id="go_back_tooltip"> VOLVER</div>
    </a>
    <main class="main_register_comercio">
        <!-- <img src="img/canje.png" alt="imagen representativa de un canje" class="imagen_aux"> -->
        <img src="<?php echo $premio_editar['img']; ?>" alt="imagen representativa del canje" class="imagen_aux">
        <form class="regiter_comercio_form" method="post" action=<?php if(isset($_GET['id-premio']) and $_GET['id-premio']!="")echo "php/editPremio.php?id-premio=".$_GET['id-premio']; else echo "php/editPremio.php"; ?>>
            <h1 class="display-5 mb-3">EDITAR PREMIO</h1>
            <div class="row mb-3">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo '<input type="text" class="form-control" name="nombre" disabled value="'.$premio_editar['nombre'].'">';
                    else 
                        echo '<input type="text" class="form-control" disabled name="nombre">';
                ?>
            </div>
            <div class="row mb-3">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo "<textarea type='text' class='form-control' name='descripcion' style='resize: none'>".$premio_editar['descripcion']."</textarea>";
                    else 
                        echo "<textarea type='text' class='form-control' name='descripcion' style='resize: none'></textarea>";
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="saldo" class="col-sm-2 col-form-label">Saldo</label>
                <div class="col-sm-10">
                    <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo '<input type="number" class="form-control" name="saldo" value="'.$premio_editar['saldo'].'">';
                    else 
                        echo '<input type="number" class="form-control" name="saldo">';
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="img" class="col-sm-2 col-form-label">Imagen</label>
                <div class="col-sm-10">
                    <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo '<input type="text" class="form-control" name="img" value="'.$premio_editar['img'].'">';
                    else 
                        echo '<input type="text" class="form-control" name="img">';
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                <div class="col-sm-10">
                    <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo '<input id="input_stock" type="number" class="form-control" name="stock" value='.$premio_editar['stock'].'>';
                    else 
                        echo '<input id="input_stock" type="number" class="form-control" name="stock" >';
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="punto_reposicion" class="col-sm-2 col-form-label">Pto. repos.</label>
                <div class="col-sm-10">
                    <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo '<input id="input_punto_reposicion" type="number" class="form-control" name="punto_reposicion" value="'.$premio_editar['punto_reposicion'].'">';
                    else 
                        echo '<input id="input_punto_reposicion" type="number" class="form-control" name="punto_reposicion">';
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="proveedor" class="col-sm-2 col-form-label">Proveedor</label>
                <div class="col-sm-10">
                    <?php 
                    if( isset($_GET['id-premio']) and $_GET['id-premio']!="")
                        echo '<input type="text" class="form-control" name="proveedor" value="'.$premio_editar['proveedor'].'">';
                    else 
                        echo '<input type="text" class="form-control" name="proveedor">';
                    ?>
                </div>
            </div>
            <div class="loginContainer_formularioContainer_buttons">
                <button type="reset" class="btn btn-danger">LIMPIAR</button>
                <button type="submit" class="btn btn-success">EDITAR</button>
            </div>
        </form>
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