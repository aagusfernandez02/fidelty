<?php
    session_start();

    $cuit = $_POST['cuit'];
    $password = md5($_POST['password']);

    include("conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM comercios WHERE cuit = '$cuit' AND password='$password';");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
        $respuesta=mysqli_fetch_array($consulta);
	    $_SESSION['cuit']=$respuesta['cuit'];
	    $_SESSION['direccion']=$respuesta['direccion'];
	    $_SESSION['email']=$respuesta['email'];
        $_SESSION['password'] = $password;
        $_SESSION['estado']='COMERCIO';
        header("Location: ../index_comercio.php");
    } else {
        $_SESSION['estado'] = "COMERCIO_ERROR";
        header("Location: ../login_comercio.php");
    }
?>
