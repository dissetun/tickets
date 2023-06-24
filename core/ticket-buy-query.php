<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $firstQuery = $_POST["firstQuery"];
    $secondQuery = $_POST["secondQuery"];
    if(!$result) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    mysqli_close($link);
?>