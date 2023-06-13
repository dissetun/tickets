<?php 
    session_start();
    include "connect.php";
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $link = mysqli_connect($host, $user, $password, $db_name);
    $columnNamesQuery = "SHOW COLUMNS FROM ".$_POST["tableName"];
    $columnNamesResult = mysqli_query($link, $columnNamesQuery);
    if(!$columnNamesResult) {
        mysqli_close($link);
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $query = "SELECT * FROM ".$_POST["tableName"];
    $columnNames = [];
    while ($row = mysqli_fetch_array($columnNamesResult)) {
        array_push($columnNames, $row["Field"]);
    }
    if(count($columnNames)) {
        $query = $query." WHERE ";
        for($i = 0; $i < count($columnNames); $i++) {
            $searchField = $_POST["searchField"];
            $query = $query."`".$columnNames[$i]."` LIKE '%$searchField%'";
            if($i < count($columnNames) - 1) {
                $query = $query." OR ";
            }
        }
    }
    $result = mysqli_query($link, $query);
    $numOfElements = mysqli_num_rows($result);
    $numOfPages = $numOfElements / 8 + ($numOfElements > 8 ? $numOfPages % 8 != 0 : 0);
    for($i = 0; $i < ceil($numOfPages); $i++) {
        echo 
        "   
            <div class='pagination-page'>".($i + 1)."</div>
        ";
    }
    mysqli_close($link);
?>