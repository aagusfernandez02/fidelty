   
<?php
    session_start();

    $cuit = $_POST['cuit'];

    include("./conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM `comercios` WHERE `cuit`='$cuit'");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
        $_SESSION['estado_delete'] = "DELETE_COMERCIO_OK";
        $consulta=mysqli_query($conexion, "DELETE FROM `comercios` WHERE `cuit`='$cuit'");
        header("Location:../delete_comercio.php");
    } else {
        $_SESSION['estado_delete'] = "DELETE_COMERCIO_ERROR";
        header("Location:../delete_comercio.php");
    }
?>

