<?php
    session_start();

    $dni = $_POST['dni'];
    $cuit = $_SESSION['cuit'];
    $monto = $_POST['monto'];

    include("conexion.php");
    $consulta=mysqli_query($conexion, "SELECT * FROM socios WHERE dni = '$dni';");
    $resultado=mysqli_num_rows($consulta);
    if( $resultado!=0 ){
        // Calculo los puntos que representan ese monto
        if(isset($GLOBALS['porcentaje_reintegro']) and $GLOBALS['porcentaje_reintegro']!=""){
            $saldo = $monto*($GLOBALS['porcentaje_reintegro']/100.0);
        } else {
            $saldo = $monto*(25.0/100.0); //POR DEFAULT REINTEGRA UN 25%
        }
        $consulta=mysqli_query($conexion, "UPDATE socios SET saldo = saldo+$saldo WHERE dni=$dni;");
        if($consulta){
            // SALDO DESCONTADO OK
            $_SESSION['estado'] = "COMPRA_OK";
            $_SESSION['monto-compra'] = $saldo;
            
            // REGISTRAR EN TABLA
            mysqli_query($conexion, "INSERT INTO compras (id_compra, fecha, importe, cuit_comercio, dni_socio) VALUES (0,CURRENT_DATE(), $monto, '$cuit', $dni)");
        
            header("Location: ../index_comercio.php"); 
        } else{
            $_SESSION['estado'] = "COMPRA_ERROR_BD";
            header("Location: ../index_comercio.php");
        }
    } else {
        // No hay socio con ese DNI
        $_SESSION['estado'] = "COMPRA_ERROR";
        header("Location: ../index_comercio.php");
    }
?>
