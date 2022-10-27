<?php
session_start();
if (!isset($_SESSION['estado']) || $_SESSION['estado'] != 'SOCIO') {
    header("Location: index.php");
} else {
    include("php/conexion.php");
    // Actualizar saldo
    // AGREGAR VARIABLE QUE CHEQUEE SI DEBE HACERLO (cuando se hizo un canje)
    if (isset($_SESSION['actualizar_estado']) && $_SESSION['actualizar_estado'] == true) {
        $dni = $_SESSION['dni'];
        $password = $_SESSION['password'];
        $consulta = mysqli_query($conexion, " SELECT * FROM socios WHERE dni = '$dni' AND password='$password';");
        $resultado = mysqli_num_rows($consulta);
        if ($resultado != 0) {
            $respuesta = mysqli_fetch_array($consulta);
            $_SESSION['saldo'] = $respuesta['saldo'];
            $_SESSION['actualizar_estado'] == false;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socio</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- TOASTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles_socio.css">
</head>

<body>
    <header>
        <h2 class="display-5 text-center"><a href="index_socio.php">Fidelty</a></h2>
        <div class="saludo">
            <h5>Hola <?php echo $_SESSION['nombre']?></h5>
            <span class="saludo_puntos">Tenes <strong><?php echo $_SESSION['saldo'] ?></strong> puntos</span>
        </div>
        <a href="php/funciones.php?session_destroy=true"><i class="fa-solid fa-right-from-bracket"></i></a>
    </header>
    <main class="main_socio">
        <form class="searchbar_container" method="get" action="index_socio.php">
            <div class="searchbar">
                <input name="premio" type="text" class="form-control" placeholder="Premio" value="<?php if(isset($_GET['premio'])){$_SESSION['pagina']=1; echo $_GET['premio'];}else{echo "";}?>">
                <button type="submit" class="btn btn-light"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <div class="container_premios">
            <?php
            $offset = ($_SESSION['pagina']-1)*6;
            $query = "SELECT * FROM premios ";
            if( isset($_GET['premio']) and $_GET['premio']!="" ){
                $query = $query." WHERE premios.nombre LIKE '%".$_GET['premio']."%'";
            }
            $query = $query." LIMIT 6 OFFSET $offset;";    
            $consulta = mysqli_query($conexion, $query);
            $resultado = mysqli_num_rows($consulta);
            if ($resultado != 0) {
                while ($row = mysqli_fetch_assoc($consulta)) {
                    $disabled = '';
                    if($row['saldo']>$_SESSION['saldo']) $disabled='disabled';
                    echo '
                    <form class="card" style="width: 18rem;" action="php/funciones.php" method="get" >
                        <input name="premio" value='.$row['id'],' style="display:none;">
                        <img src="'.$row['img'].'" class="card-img-top" alt="'.$row['nombre'].'">
                        <div class="card-body">
                            <h5 class="card-title">'.$row['nombre'].'</h5>
                            <p class="card-text">'.$row['descripcion'].'</p>
                            <button href="#" class="btn btn-success"'.$disabled.'> CANJEAR ('.$row['saldo'].' ptos)</button>
                        </div>
                    </form>
                    ';
                }
            } else {
                echo "No hay premios registrados";
            }
            ?>               
        </div>
        
        <div class="controles-paginacion">
            <a href="php/funciones.php?paginacion=prev"><i class="fa-solid fa-angle-left"></i></a>
            <?php echo "Pagina ".$_SESSION['pagina'].' de '.$_SESSION['cantidad paginas']?>
            <a href="php/funciones.php?paginacion=next"><i class="fa-solid fa-angle-right"></i></a>
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- TOASTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- JS -->
    <?php
    if (isset($_SESSION['estado_canje']) && $_SESSION['estado_canje'] == "CANJE_OK") {
        $_SESSION['estado_canje'] = null;
        echo "<script>toastr.success('Premio canjeado correctamente')</script>";
    }
    if (isset($_SESSION['estado_canje']) && $_SESSION['estado_canje'] == "FALTA_STOCK") {
        $_SESSION['estado_canje'] = null;
        echo "<script>toastr.error('Stock insuficiente','ERROR')</script>";
    }
    ?>
</body>

</html>