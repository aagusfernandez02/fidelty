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
	    $_SESSION['email']=$respuesta['email'];
	    $_SESSION['saldo']=$respuesta['saldo'];
        $_SESSION['estado']='SOCIO';
        $_SESSION['pagina'] = 1;
        $_SESSION['dni'] = $dni;
        $_SESSION['password'] = $password;
        $cantidadPremios = mysqli_fetch_row(mysqli_query($conexion, "SELECT count(*) FROM premios ;"));
        $_SESSION['cantidad paginas'] = ceil($cantidadPremios[0] / 6);
        header("Location:../index_socio.php");
    } else {
        $_SESSION['estado'] = "SOCIO_ERROR";
        header("Location:../login_socio.php");
    }

?>