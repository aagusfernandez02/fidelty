<?php
    session_start();

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    include("conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM `administradores` WHERE username='$username' AND password='$password';");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
	    $_SESSION['estado']="ADMIN";
        header("Location:../index_admin.php");
    } else {
        $_SESSION['estado_admin']="ADMIN_ERROR";
        header("Location:../login_admin.php");
    }

?>