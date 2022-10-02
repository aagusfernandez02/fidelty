<?php
    session_start();

    $dni = $_POST['dni'];
    $password = md5($_POST['password']);

    include("./conexion.php");
    
    $consulta=mysqli_query($conexion, " SELECT * FROM socios WHERE dni = '$dni' AND password='$password';");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
	
        $respuesta=mysqli_fetch_array($consulta);
	    $_SESSION['nombre']=$respuesta['nombre'];
	    $_SESSION['saldo']=$respuesta['saldo'];
        $_SESSION['estado']='SOCIO_LOGGED';
        header("Location:../index.php");
    } else {
        $_SESSION['estado'] = "SOCIO_ERROR";
        header("Location:../login_socio.php");
    }

?>