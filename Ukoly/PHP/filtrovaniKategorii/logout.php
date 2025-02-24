<?php
session_start();

if(isset($_POST)){
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

?>