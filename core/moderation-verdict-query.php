<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name);
    $query = $_POST["query"];
    $result = mysqli_query($link, $query);
    if(!$result) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    mysqli_close($link);
?>