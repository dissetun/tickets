<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $query = $_POST["query"];
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $result = mysqli_query($link, $query);
    echo mysqli_error($link);
    if(!$result) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    mysqli_close($link);
?>