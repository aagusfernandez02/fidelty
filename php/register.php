   
<?php
    session_start();

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    // echo $nombre." - ".$apellido." - ".$dni." - ".$fecha_nacimiento." - ".$email." - ".$password;

    include("./conexion.php");
    
    $consulta=mysqli_query($conexion, "SELECT * FROM socios WHERE dni = '$dni';");
    $resultado=mysqli_num_rows($consulta);

    if( $resultado!=0 ){
        // header("Location:../register_socio.html");
        $_SESSION['estado_registro'] = "ERROR";
        header("Location:../register_socio.php");
        // echo "Usuario registrado";
    } else {
        // header("Location:../login_socio.html");
        $_SESSION['estado_registro'] = "OK";
        $query = mysqli_query($conexion, "INSERT INTO socios VALUES('$dni','$nombre','$apellido','$fecha_nacimiento','$email','$password',0);");
        header("Location:../login_socio.php");
        // echo "No es un usuario registrado";
    }
?>

