   
<?php
    session_start();

    $nombre = $_POST['nombre']; // Recibe el ID
    $descripcion = $_POST['descripcion'];
    $saldo = $_POST['saldo'];
    $img = $_POST['img'];
    //$stock = $_POST['stock'];
    //$punto_reposicion = $_POST['punto_reposicion'];

    include("./conexion.php");
    $UPDATE_QUERY = 'UPDATE premios SET ';

   if( isset($_POST['descripcion']) and $_POST['descripcion']!=""  ){
    $descripcion = $_POST['descripcion'];
    $UPDATE_QUERY = $UPDATE_QUERY."premios.descripcion = '$descripcion',";
   }
   if( isset($_POST['punto_reposicion']) and $_POST['punto_reposicion']!=""  ){
    $punto_reposicion = $_POST['punto_reposicion'];
    $UPDATE_QUERY = $UPDATE_QUERY."premios.punto_reposicion = '$punto_reposicion',";
   }
   if( isset($_POST['saldo']) and $_POST['saldo']!=""  ){
    $saldo = $_POST['saldo'];
    $UPDATE_QUERY = $UPDATE_QUERY."premios.saldo = '$saldo',";
   }
   if( isset($_POST['img']) and $_POST['img']!=""  ){
    $img = $_POST['img'];
    $UPDATE_QUERY = $UPDATE_QUERY."premios.img = '$img',";
   }
   if( isset($_POST['stock']) and $_POST['stock']!=""  ){
    $stock = $_POST['stock'];
    $UPDATE_QUERY = $UPDATE_QUERY."premios.stock = '$stock',";
   }

   if($UPDATE_QUERY != 'UPDATE premios SET '){
        $UPDATE_QUERY = rtrim($UPDATE_QUERY, ',');
        $UPDATE_QUERY = $UPDATE_QUERY.' WHERE premios.id = '.$nombre.';';
           
        mysqli_query($conexion, $UPDATE_QUERY);
        if( mysqli_affected_rows ($conexion) > 0 ){
            $_SESSION['estado_update'] = "UPDATE_PREMIO_OK";
            header("Location:../edit_premio.php");
        } else {
            $_SESSION['estado_update'] = "UPDATE_PREMIO_ERROR";
            header("Location:../edit_premio.php");
        }
    } else {
        header("Location:../edit_premio.php");
    }
?>

