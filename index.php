<?php 

session_start(); 


if( isset($_SESSION['estado']) ){
    $estado = $_SESSION['estado'];
    switch($estado){
        case 'SOCIO':
            header("Location: index_socio.php");
            // header("Location:../index_socio.php");
            break;
        case 'ADMIN':
            header("Location: index_admin.php");
            break;
        case 'COMERCIO':
            header("Location: index_comercio.php");
        break;
            header("Location: login_socio.php");
    }

} else {
    header("Location: login_socio.php");
}
