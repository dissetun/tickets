<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $left = $_POST["pages"];
    $query = "SELECT COUNT(`performance id`) FROM performances";
    $result = mysqli_query($link, $query);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo ($row[0] - $left <= 0 ? "Hide" : "Show");
    mysqli_close($link);
?>
