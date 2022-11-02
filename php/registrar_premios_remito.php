<?php
session_start();

include("conexion.php");

echo 'Premios:<br>';
$proveedor = $_POST['proveedor'];
$img = $_POST['img'];
unset($_POST['proveedor']);
unset($_POST['img']);
$insert_pedido = mysqli_query($conexion, "INSERT INTO remitos(id_remito, id_proveedor, fecha, img) VALUES (NULL,$proveedor,CURRENT_DATE(),'$img');");
$id_pedido = mysqli_insert_id($conexion);

foreach (array_chunk($_POST, 2) as $key) {
    $insert_premio = mysqli_query($conexion,"INSERT INTO premios_en_remitos(id_remito, id_premio, cantidad) VALUES ($id_pedido, ".$key[0].", ".$key[1].");");
    $insert_stock_premio = mysqli_query($conexion,"UPDATE premios SET stock = stock+".$key[1]." WHERE id=".$key[0].";");
    $_SESSION['estado_registro'] = "REGISTRO_REMITO_OK";
    header("Location:../registrar_remito.php");
    // End group
}
?>
