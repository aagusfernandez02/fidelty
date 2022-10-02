<?php 
session_start();

if (isset($_GET['session_destroy'])) {
    session_destroy();
    header("Location:../index.php");
}
?>