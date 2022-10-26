   
<?php
    session_start();

    $cuit = $_POST['cuit'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    include("conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM comercios WHERE cuit = '$cuit';");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
        $_SESSION['estado_registro'] = "REGISTRO_COMERCIO_ERROR";
        header("Location:../register_comercio.php");
        // echo "Usuario registrado";
    } else {
        $_SESSION['estado_registro'] = "REGISTRO_COMERCIO_OK";
        $query = mysqli_query($conexion, "INSERT INTO comercios VALUES('NULL','$cuit','$direccion','$email','$password');");
        header("Location:../register_comercio.php");
    }
?>

