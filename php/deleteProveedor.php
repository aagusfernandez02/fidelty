   
<?php
    session_start();

    $proveedor = $_POST['proveedor'];

    include("conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM proveedores WHERE id_proveedor='$proveedor'");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
        $_SESSION['estado_delete'] = "DELETE_PROVEEDOR_OK";
        $consulta=mysqli_query($conexion, "DELETE FROM proveedores WHERE id_proveedor='$proveedor'");
        header("Location:../delete_proveedor.php");
    } else {
        $_SESSION['estado_delete'] = "DELETE_PROVEEDOR_ERROR";
        header("Location:../delete_proveedor.php");
    }
?>

