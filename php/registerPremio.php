   
<?php
    session_start();

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $saldo = $_POST['saldo'];
    $img = $_POST['img'];
    // $stock = $_POST['stock'];
    // $punto_reposicion = $_POST['punto_reposicion'];
    // $ingreso_con_stock = $_POST['ingreso_con_stock'];
    // $ingreso_con_punto_reposicion = $_POST['ingreso_con_punto_reposicion'];

    include("conexion.php");
    
   if( !isset($_POST['ingreso_con_punto_reposicion']) and !isset($_POST['ingreso_con_stock']) ){
       $consulta=mysqli_query($conexion, "INSERT INTO premios(id, saldo, img, nombre, descripcion) VALUES(NULL, $saldo, '$img', '$nombre', '$descripcion');");
    } else if( !isset($_POST['ingreso_con_punto_reposicion']) and isset($_POST['ingreso_con_stock']) ){
        $stock = $_POST['stock'];
        $consulta=mysqli_query($conexion, "INSERT INTO premios(id, saldo, stock, img, nombre, descripcion) VALUES(NULL, $saldo, $stock, '$img', '$nombre', '$descripcion');");
   } else if( !isset($_POST['ingreso_con_stock']) and isset($_POST['ingreso_con_punto_reposicion'])){
        $punto_reposicion = $_POST['punto_reposicion'];
        $consulta=mysqli_query($conexion, "INSERT INTO premios(id, saldo, punto_reposicion, img, nombre, descripcion) VALUES(NULL, $saldo, $punto_reposicion, '$img', '$nombre', '$descripcion');");
    } else {
        $stock = $_POST['stock'];
        $punto_reposicion = $_POST['punto_reposicion'];
        $consulta=mysqli_query($conexion, "INSERT INTO premios(id, saldo, stock, punto_reposicion, img, nombre, descripcion) VALUES(NULL, $saldo, $stock, $punto_reposicion, '$img', '$nombre', '$descripcion');");
   }

    if( mysqli_affected_rows ($conexion) > 0 ){
        $_SESSION['estado_registro'] = "REGISTRO_PREMIO_OK";
        header("Location:../create_premio.php");
    } else {
        $_SESSION['estado_registro'] = "REGISTRO_PREMIO_ERROR";
        header("Location:../create_premio.php");
    }
?>

