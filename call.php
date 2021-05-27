<?php
    if(isset($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['vreg'])) {
        header('location: volreg.php'); 
        exit();
    }

    if(isset($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['vlog'])) {
        header('location: vollog.php'); 
        exit();
    }

    if (isset($_POST['ureg'])) {
        header('location: usersignup.php'); 
        exit();
    }

    if (isset($_POST['ulog'])) {
        header('location: userlogin.php'); 
        exit();
    }
?>