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
        $consulta = mysqli_query($conexion, "SELECT * FROM socios WHERE dni = '$dni' AND password='$password';");
        $resultado = mysqli_num_rows($consulta);
        if ($resultado != 0) {
            $respuesta = mysqli_fetch_array($consulta);
            $_SESSION['saldo'] = $respuesta['saldo'];
            $_SESSION['actualizar_estado'] == false;
        }
    }
}

include("php/conexion.php");
if(isset($_GET['premio']) AND $_GET['premio']!=""){
    $premios = mysqli_query($conexion, "SELECT * FROM premios WHERE nombre LIKE '%".$_GET['premio']."%'");
} else {
    $premios = mysqli_query($conexion, "SELECT * FROM premios");
}
$premios_x_pag = 6;
$paginas = ceil(mysqli_num_rows($premios) / $premios_x_pag);
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
    <?php
    // PAGINACION
    if(!isset($_GET['pagina']) || $_GET['pagina']=='') $_GET['pagina']=1;
    if($_GET['pagina']>$paginas) $_GET['pagina']=$paginas;
    if($_GET['pagina']<=0) $_GET['pagina']=1;
    ?>
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
                <input name="premio" type="text" class="form-control" placeholder="Premio" value="<?php if(isset($_GET['premio'])) echo $_GET['premio']; else echo ""; ?>">
                <button type="submit" class="btn btn-light"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
        <div class="container_premios">
            <?php
            $iniciar = ($_GET['pagina']-1)*$premios_x_pag;
            if(isset($_GET['premio']) AND $_GET['premio']!=""){
                $premios_pag = mysqli_query($conexion, "SELECT * FROM premios WHERE nombre LIKE '%".$_GET['premio']."%' LIMIT $iniciar,$premios_x_pag");
            } else {            
            $premios_pag = mysqli_query($conexion, "SELECT * FROM premios LIMIT $iniciar,$premios_x_pag");
            }
            if( mysqli_num_rows($premios_pag)>0 ){
                $premio = mysqli_fetch_assoc($premios_pag);
                while($premio){
                    $disabled = '';
                    if($premio['saldo']>$_SESSION['saldo']) $disabled='disabled';
                    echo '
                    <form class="card" style="width: 18rem;" action="php/funciones.php" method="get" >
                        <input name="premio" value='.$premio['id'],' style="display:none;">
                        <img src="'.$premio['img'].'" class="card-img-top" alt="'.$premio['nombre'].'">
                        <div class="card-body">
                            <h5 class="card-title">'.$premio['nombre'].'</h5>
                            <p class="card-text">'.$premio['descripcion'].'</p>
                            <button href="#" class="btn btn-success"'.$disabled.'> CANJEAR ('.$premio['saldo'].' ptos)</button>
                        </div>
                    </form>
                    ';
                    $premio = mysqli_fetch_assoc($premios_pag);
                }
            } else {
                echo "No hay premios registrados";
            }
            ?>               
        </div>
        <nav aria-label="Page navigation example"  class="controles-paginacion">
            <ul class="pagination">
                <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled':'' ?>">
                <a class="page-link" href="index_socio.php?pagina=<?php echo $_GET['pagina']-1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <?php for($i=0; $i<$paginas; $i++): ?>
                <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active':'' ?>">
                    <a class="page-link" href="index_socio.php?pagina=<?php echo $i+1; ?>">
                        <?php echo $i+1; ?>
                    </a>
                </li>
                <?php endfor ?>
                <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled':'' ?>">
                <a class="page-link" href="index_socio.php?pagina=<?php echo $_GET['pagina']+1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
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