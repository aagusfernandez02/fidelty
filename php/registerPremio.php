<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'sendemail/src/Exception.php';
require 'sendemail/src/PHPMailer.php';
require 'sendemail/src/SMTP.php';


session_start();
$descripcion = $_POST['descripcion'];
$nombre = $_POST['nombre'];
$saldo = $_POST['saldo'];
$img = $_POST['img'];
$proveedor = $_POST['proveedor'];


include("conexion.php");
$consulta = mysqli_query($conexion, "INSERT INTO premios(id, proveedor, saldo, img, nombre, descripcion) VALUES(NULL, '$proveedor', $saldo, '$img', '$nombre', '$descripcion');");
if (!isset($_POST['ingreso_con_punto_reposicion']) and !isset($_POST['ingreso_con_stock'])) {
} else if (!isset($_POST['ingreso_con_punto_reposicion']) and isset($_POST['ingreso_con_stock'])) {
    $stock = $_POST['stock'];
    $consulta = mysqli_query($conexion, "INSERT INTO premios(id, proveedor, saldo, stock, img, nombre, descripcion) VALUES(NULL, '$proveedor', $saldo, $stock, '$img', '$nombre', '$descripcion');");
} else if (!isset($_POST['ingreso_con_stock']) and isset($_POST['ingreso_con_punto_reposicion'])) {
    $punto_reposicion = $_POST['punto_reposicion'];
    $consulta = mysqli_query($conexion, "INSERT INTO premios(id, proveedor, saldo, punto_reposicion, img, nombre, descripcion) VALUES(NULL, '$proveedor', $saldo, $punto_reposicion, '$img', '$nombre', '$descripcion');");
} else {
    $stock = $_POST['stock'];
    $punto_reposicion = $_POST['punto_reposicion'];
    $consulta = mysqli_query($conexion, "INSERT INTO premios(id, proveedor, saldo, stock, punto_reposicion, img, nombre, descripcion) VALUES(NULL, '$proveedor', $saldo, $stock, $punto_reposicion, '$img', '$nombre', '$descripcion');");
}

// NOTIFICA A LOS SOCIOS DEL INGRESO DEL NUEVO PREMIO
$consulta = mysqli_query($conexion, "SELECT email FROM socios;");
$resultado = mysqli_num_rows($consulta);
if ($resultado > 0) {
    $email = mysqli_fetch_assoc($consulta);
    while ($email) {
        // Envia mail
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'af.agusfernandez02@gmail.com';
        $mail->Password = 'hgfdnesoxizvcxno';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('af.agusfernandez02@gmail.com');
        $mail->addAddress($email['email']);
        $mail->isHTML(true);
        $mail->Subject = "Fidelty - Ingreso nuevo premio";
        $mail->Body = "Hola, queriamos comunicarle que hemos incorporado un nuevo premio: <br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$nombre."</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;<em>".$descripcion."</em><br><br>Para canjearlo necesita " .$saldo." puntos. <br><br><img src='$img' alt='imagen premio'>";
        $mail->send();

        $email = mysqli_fetch_assoc($consulta);
    }
}

if (mysqli_affected_rows($conexion) > 0) {
    $_SESSION['estado_registro'] = "REGISTRO_PREMIO_OK";
    header("Location:../create_premio.php");
} else {
    $_SESSION['estado_registro'] = "REGISTRO_PREMIO_ERROR";
    header("Location:../create_premio.php");
}
?>

