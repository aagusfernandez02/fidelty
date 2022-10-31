<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'sendemail/src/Exception.php';
require 'sendemail/src/PHPMailer.php';
require 'sendemail/src/SMTP.php';

require('fpdf/fpdf.php');

include('conexion.php');

if( isset($_GET['proveedor']) and $_GET['proveedor']!="" ){
    // Un solo proveedor
    $proveedor = $_GET['proveedor'];
    // Obtener email proveedor
    $email = mysqli_query($conexion, "SELECT email FROM proveedores WHERE razon_social='$proveedor';");
    $email = mysqli_fetch_assoc($email);
    $email = $email['email'];
} 

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->SetFont('Arial','BI',16);
    $this->Cell(40,10,utf8_decode('Fidelty'));
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos, a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(70,10,utf8_decode('Pedidos de reposición'),1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

if( isset($email) ){
    // Un solo proveedor
    
    $query = "SELECT * FROM premios WHERE premios.punto_reposicion IS NOT NULL AND premios.stock < premios.punto_reposicion AND proveedor='$proveedor' ORDER BY proveedor";
    $consulta = mysqli_query($conexion,$query);

    $pdf = new PDF();
    $pdf ->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(120,10,'Premio',1,0,'C',0);
    $pdf->Cell(15,10,'Faltante',1,0,'C',0);
    $pdf->Cell(45,10,'Proveedor',1,1,'C',0);
    
    $pdf->SetFont('Arial','',9);
    $row = mysqli_fetch_assoc($consulta);
    while( $row ){
        $pdf->Cell(120,10,utf8_decode($row['nombre']),1,0,'C',0);
        $pdf->Cell(15,10,$row['punto_reposicion']-$row['stock'],1,0,'C',0);
        $pdf->Cell(45,10,utf8_decode($row['proveedor']),1,1,'C',0);
        $row = mysqli_fetch_assoc($consulta);
    }
    
    $doc = $pdf->Output("pedidos_reposicion.pdf","S");
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'af.agusfernandez02@gmail.com';
    $mail->Password = 'hgfdnesoxizvcxno';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('af.agusfernandez02@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "Fidelty - Pedidos de reposicion";
    $mail->Body = "Hola $proveedor, el equipo de Fidelty quería comunicarle que requerimos ingreso de stock de los premios adjuntos. <br><br>Cordiales saludos.";
    $mail->AddStringAttachment($doc, 'pedidos_reposicion.pdf');
    $mail->send();
    
    $pdf->Output();
} else {
    // Todos los proveedores
    $proveedores = mysqli_query($conexion,"SELECT DISTINCT proveedor FROM premios WHERE premios.punto_reposicion IS NOT NULL AND premios.stock < premios.punto_reposicion");
    $row = mysqli_fetch_assoc($proveedores);
    while( $row ){
        $proveedor = $row['proveedor'];
        $email = mysqli_query($conexion, "SELECT email FROM proveedores WHERE razon_social = '$proveedor';");
        $email = mysqli_fetch_assoc($email);
        $email = $email['email'];
        $query = "SELECT * FROM premios WHERE premios.punto_reposicion IS NOT NULL AND premios.stock < premios.punto_reposicion AND proveedor='$proveedor' ORDER BY proveedor";
        $consulta = mysqli_query($conexion,$query);

        $pdf = new PDF();
        $pdf ->AliasNbPages();
        $pdf->AddPage();
        
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(120,10,'Premio',1,0,'C',0);
        $pdf->Cell(15,10,'Faltante',1,0,'C',0);
        $pdf->Cell(45,10,'Proveedor',1,1,'C',0);
        
        $pdf->SetFont('Arial','',9);
        $row2 = mysqli_fetch_assoc($consulta);
        while( $row2 ){
            $pdf->Cell(120,10,utf8_decode($row2['nombre']),1,0,'C',0);
            $pdf->Cell(15,10,$row2['punto_reposicion']-$row2['stock'],1,0,'C',0);
            $pdf->Cell(45,10,utf8_decode($row2['proveedor']),1,1,'C',0);
            $row2 = mysqli_fetch_assoc($consulta);
        }
        
        $doc = $pdf->Output("pedidos_reposicion.pdf","S");
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'af.agusfernandez02@gmail.com';
        $mail->Password = 'hgfdnesoxizvcxno';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('af.agusfernandez02@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Fidelty - Pedidos de reposicion";
        $mail->Body = "Hola $proveedor, el equipo de Fidelty quería comunicarle que requerimos ingreso de stock de los premios adjuntos. <br><br>Cordiales saludos.";
        $mail->AddStringAttachment($doc, 'pedidos_reposicion.pdf');
        $mail->send();
    
        $row = mysqli_fetch_assoc($proveedores);
    }
    $query = "SELECT * FROM premios WHERE premios.punto_reposicion IS NOT NULL AND premios.stock < premios.punto_reposicion ORDER BY proveedor";
    $consulta = mysqli_query($conexion,$query);

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(120,10,'Premio',1,0,'C',0);
    $pdf->Cell(15,10,'Faltante',1,0,'C',0);
    $pdf->Cell(45,10,'Proveedor',1,1,'C',0);
    
    $pdf->SetFont('Arial','',9);
    $row = mysqli_fetch_assoc($consulta);
    while( $row ){
        $pdf->Cell(120,10,utf8_decode($row['nombre']),1,0,'C',0);
        $pdf->Cell(15,10,$row['punto_reposicion']-$row['stock'],1,0,'C',0);
        $pdf->Cell(45,10,utf8_decode($row['proveedor']),1,1,'C',0);
        $row = mysqli_fetch_assoc($consulta);
    }
    $pdf->Output();
}

?>