<?php 
session_start();

if (isset($_GET['session_destroy']) && $_GET['session_destroy'] == 'true') {
    session_destroy();
    header("Location:../index.php");
}

if (isset($_GET['paginacion']) && $_GET['paginacion'] == 'next') {
    if ($_SESSION['pagina'] < $_SESSION['cantidad paginas'])
        $_SESSION['pagina'] += 1 ;
    header("Location:../index_socio.php");
}
if (isset($_GET['paginacion']) && $_GET['paginacion'] == 'prev') {
    if($_SESSION['pagina'] > 1)
        $_SESSION['pagina'] -= 1 ;
    header("Location:../index_socio.php");
}

if (isset($_GET['premio']) && $_GET['premio'] != '') {
    $id_premio = $_GET['premio'];
    include('./conexion.php');
    $consulta = mysqli_query($conexion, "SELECT * FROM premios WHERE id='$id_premio';");
    $resultado = mysqli_num_rows($consulta);
    if($resultado > 0){
        $premio = mysqli_fetch_assoc($consulta);
        if( $premio['stock'] > 0 ){
            // Stock suficiente
            if( mysqli_query($conexion, "UPDATE premios SET premios.stock = premios.stock - 1 WHERE id = '$id_premio';") ){
                $_SESSION['estado_canje'] = "CANJE_OK";
                // Reducción stock hecha
                if( !mysqli_query($conexion,"INSERT INTO canjes(id_canje, id_premio, dni_socio) VALUES (NULL, ".$premio['id'].", ".$_SESSION['dni'].");") )
                    echo "Fallo guardando el canje";
                if( mail($_SESSION['email'], "Fidelty - Canje premio - ".$premio['nombre'], "Hola ".$_SESSION['nombre'].", queriamos comunicarle que su canje del premio: '".$premio['nombre']." (".$premio['saldo']." puntos)' fue realizada correctamente y pronto nos comunicaremos con usted para continuar el proceso de entrega del premio.") ){
                    echo "EMAIL ENVIADO OK";
                } else {
                    echo "FALLO ENVIO EMAIL";
                }
                echo $_SESSION['email'], "Fidelty - Canje premio - ".$premio['nombre'], "Hola ".$_SESSION['nombre'].", queriamos comunicarle que su canje del premio: '".$premio['nombre']." (".$premio['saldo']." puntos)' fue realizada correctamente y pronto nos comunicaremos con usted para continuar el proceso de entrega del premio.";
            } else {
                $_SESSION['estado_canje'] = "ERROR_REDUCCION_STOCK";
            }
            
        } else {
            // Stock insuficiente
            $_SESSION['estado_canje'] = "FALTA_STOCK";
        }
    }
    // header("Location:../index_socio.php");
}


?>