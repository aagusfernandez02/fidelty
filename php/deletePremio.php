   
<?php
    session_start();

    $id = $_GET['id-premio']; // Recibe el ID

    include("conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM premios WHERE id='$id'");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado !=0 ){
        $_SESSION['estado_delete'] = "DELETE_PREMIO_OK";
        $consulta=mysqli_query($conexion, "DELETE FROM premios WHERE id='$id'");
        header("Location:../tabla_premios.php");
    } else {
        $_SESSION['estado_delete'] = "DELETE_PREMIO_ERROR";
        header("Location:../tabla_premios.php");
    }
?>

