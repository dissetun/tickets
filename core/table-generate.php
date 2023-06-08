<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include "connect.php";
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $tableName = $_POST["tableName"];
    if($tableName == "genres") {
        echo 
        "   
            <table>
                <tr>
                    <th style='border-radius: 10px;'>Жанр</th>
                </tr>
        ";
    }
    if($tableName == "performances") {
        echo 
        "
            <table>
                <tr>
                    <th>ID Представления</th>
                    <th>Название</th>
                    <th>ID Зала</th>
                    <th>Жанр</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                    <th>Статус</th>
                </tr>
        ";
    }
    if($tableName == "platforms") {
        echo 
        "
            <table>
                <tr>
                    <th>Название</th>
                    <th>Адрес</th>
                </tr>
        ";
    }
    if($tableName == "users") {
        echo 
        "
            <table>
                <tr>
                    <th>Логин</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Почта</th>
                    <th>Роль</th>
                </tr>
        ";
    }
    $query = $_POST["query"];
    $result = mysqli_query($link, $query);
    $blockedKeys = ["Image path", "Password"];
    foreach($result as $row) {
        echo
        "
            <tr>
        ";
        $keys = array_keys($row);
        foreach($keys as $key) {
            if(in_array($key, $blockedKeys)) {
                continue;
            }
            if($key == "Status") {
                if($row[$key] == 0)
                    echo
                    "
                        <td>Не проведено</td>
                    ";
                continue;
            }
            echo 
            "
                <td>".$row[$key]."</td>
            ";
        }
        echo 
        "
            </tr>
        ";
    }
    mysqli_close($link);
?>