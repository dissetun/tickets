<?php 
    session_start();
    include "connect.php";
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $link = mysqli_connect($host, $user, $password, $db_name);
    print_r($_POST["formData"][$_FILES]);
?>