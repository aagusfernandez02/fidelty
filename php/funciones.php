<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'sendemail/src/Exception.php';
require 'sendemail/src/PHPMailer.php';
require 'sendemail/src/SMTP.php';

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
                if( !mysqli_query($conexion,"INSERT INTO canjes(id_canje, id_premio, dni_socio, fecha) VALUES (NULL, ".$premio['id'].", ".$_SESSION['dni'].",CURRENT_DATE());") )
                    echo "Fallo guardando el canje";
                if( !mysqli_query($conexion,"UPDATE socios SET saldo=saldo-".$premio['saldo']." WHERE socios.dni = ".$_SESSION['dni']))
                    echo "Fallo descontando el saldo";
                
                // Inicio envio mail
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->SMTPAuth=true;
                $mail->Username='af.agusfernandez02@gmail.com';
                $mail->Password='hgfdnesoxizvcxno';
                $mail->SMTPSecure='ssl';
                $mail->Port=465;
                $mail->setFrom('af.agusfernandez02@gmail.com');
                $mail->addAddress($_SESSION['email']);
                $mail->isHTML(true);
                $mail->Subject="Fidelty - Canje premio - ".$premio['nombre'];
                $mail->Body="Hola ".$_SESSION['nombre'].", queriamos comunicarle que su canje del premio: '".$premio['nombre']." (".$premio['saldo']." puntos)' fue realizado correctamente y pronto nos comunicaremos con usted para continuar el proceso de entrega del premio.";
                $mail->send();
                // Fin envio mail

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