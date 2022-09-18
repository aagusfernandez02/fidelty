<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- TOASTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Home</title>
</head>

<body>
    <?php 
        if( isset($_SESSION['nombre']) && $_SESSION['nombre'] != "ERROR" ){
            echo "Hola ".$_SESSION['nombre']." su saldo es de: ".$_SESSION['saldo'];
        }
    ?>
    <h1>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam optio sapiente dicta quod debitis pariatur nobis magni minima sint quo earum voluptatibus, asperiores, saepe aut, maxime a ullam nihil tempore iste ducimus tempora cupiditate quidem voluptates nemo. Sed, non accusantium debitis ipsa ipsam nam natus voluptas voluptatum qui eligendi quasi!</h1>

    <!-- BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- TOASTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- JS -->
    <?php 
        if( isset( $_SESSION['estado_registro'] ) && $_SESSION['estado_registro']=="OK" ) {
            $_SESSION['estado_registro'] = null;
            echo "<script>toastr.success('Usuario registrado correctamente')</script>";
        }
    ?>
</body>

</html>