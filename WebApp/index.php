<?php 
    session_start();
    ob_start();
    include('inc/cfg.php');
    include('inc/func.php');

    $count = checkLogin($con);

    if($count == 1) {
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php");
        exit;
    }

?>