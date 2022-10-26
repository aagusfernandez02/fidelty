<?php 

session_start(); 


if( isset($_SESSION['estado']) ){
    $estado = $_SESSION['estado'];
    switch($estado){
        case 'SOCIO':
            header("Location:../fidelty/index_socio.php");
            // header("Location:../index_socio.php");
            break;
        case 'ADMIN':
            header("Location:../fidelty/index_admin.php");
            break;
        default:
            header("Location:../fidelty/login_socio.php");
    }

} else {
    header("Location:../fidelty/login_socio.php");
}
    
    
?>
