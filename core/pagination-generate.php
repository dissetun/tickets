<?php 
    session_start();
    include "connect.php";
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $link = mysqli_connect($host, $user, $password, $db_name);
    $query = "SELECT * FROM ".$_POST["tableName"];
    $result = mysqli_query($link, $query);
    if(!$result) {
        mysqli_close($link);
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $numOfElements = mysqli_num_rows($result);
    $numOfPages = $numOfElements / 8 + ($numOfElements > 8 ? $numOfPages % 8 != 0 : 0);
    for($i = 0; $i < $numOfPages; $i++) {
        echo 
        "   
            <div class='pagination-page'>".($i + 1)."</div>
        ";
    }
    mysqli_close($link);
?>