<?php

session_start();
$razon_social = $_POST['razon_social'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

include("conexion.php");

$consulta = mysqli_query($conexion, "SELECT * FROM proveedores WHERE razon_social='$razon_social';");
$resultado=mysqli_num_rows($consulta);
if( $resultado > 0 ){
    $_SESSION['estado_registro'] = "REGISTRO_PROVEEDOR_ERROR_RAZON_SOCIAL";
    header("Location:../create_proveedor.php");
} else {
    $consulta = mysqli_query($conexion, "INSERT INTO proveedores(id_proveedor, razon_social, telefono, email) VALUES(NULL, '$razon_social', '$telefono', '$email');");
    if( $consulta ){
        $_SESSION['estado_registro'] = "REGISTRO_PROVEEDOR_OK";
        header("Location:../create_proveedor.php");
    } else {
        $_SESSION['estado_registro'] = "REGISTRO_PROVEEDOR_ERROR";
        header("Location:../create_proveedor.php");
    }
}
?>

