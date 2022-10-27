<?php 
session_start();

if (isset($_GET['session_destroy']) && $_GET['session_destroy'] == 'true') {
    session_destroy();
    header("Location:../index.php");
}

if (isset($_GET['premio']) && $_GET['premio'] != '') {
    $id_premio = $_GET['premio'];
    include('conexion.php');
    $consulta = mysqli_query($conexion, "SELECT * FROM premios WHERE id='$id_premio';");
    $resultado = mysqli_num_rows($consulta);
    if($resultado > 0){
        $premio = mysqli_fetch_assoc($consulta);
        if( $premio['stock'] > 0 ){
            // Stock suficiente
            if( mysqli_query($conexion, "UPDATE premios SET premios.stock = premios.stock - 1 WHERE id = '$id_premio';") ){
                // Reducción stock hecha --> Registro canje y descuento puntos socio
                $_SESSION['estado_canje'] = "CANJE_OK";
                if( !mysqli_query($conexion,"INSERT INTO canjes(id_canje, id_premio, dni_socio) VALUES (NULL, ".$premio['id'].", ".$_SESSION['dni'].");") )
                    echo "Fallo guardando el canje";
                if( !mysqli_query($conexion,"UPDATE socios SET saldo=saldo-".$premio['saldo']." WHERE socios.dni = ".$_SESSION['dni']))
                    echo "Fallo descontando el saldo";
                if( mail($_SESSION['email'], "Fidelty - Canje premio - ".$premio['nombre'], "Hola ".$_SESSION['nombre'].", queriamos comunicarle que su canje del premio: '".$premio['nombre']." (".$premio['saldo']." puntos)' fue realizada correctamente y pronto nos comunicaremos con usted para continuar el proceso de entrega del premio.") ){
                    echo "EMAIL ENVIADO OK";
                } else {
                    echo "FALLO ENVIO EMAIL";
                }
                $_SESSION['actualizar_estado'] = true;
                echo $_SESSION['email'], "Fidelty - Canje premio - ".$premio['nombre'], "Hola ".$_SESSION['nombre'].", queriamos comunicarle que su canje del premio: '".$premio['nombre']." (".$premio['saldo']." puntos)' fue realizada correctamente y pronto nos comunicaremos con usted para continuar el proceso de entrega del premio.";
            } else {
                $_SESSION['estado_canje'] = "ERROR_REDUCCION_STOCK";
            }
            
        } else {
            // Stock insuficiente
            $_SESSION['estado_canje'] = "FALTA_STOCK";
        }
    }
    header("Location:../index_socio.php");
}


?>