<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include "connect.php";
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $tableName = $_POST["tableName"];
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
    $pageNumber = (int)$_POST["pageNumber"];
    if($_POST["pageNumber"] >= 1)
        $pageNumber -= 1;
    $query = $query." LIMIT ".($pageNumber * 8).", 8";
    $result = mysqli_query($link, $query);
    if(!mysqli_num_rows($result)) {
        echo("<div style=''><p>Ничего не найдено</p></div>");
        mysqli_close($link);
        die();
    }
    if($tableName == "genres") {
        echo 
        "   
            <table>
                <tr>
                    <th>Жанр</th>
                    <th></th>
                    <th></th>
                </tr>
        ";
    }
    if($tableName == "performances") {
        echo 
        "
            <table>
                <tr>
                    <th>ID</th>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Площадка</th>
                    <th>Наличие зала</th>
                    <th>ID Зала</th>
                    <th>Жанр</th>
                    <th style='display: inline-block; word-break: break-word; min-width: 250px; max-width: 400px; width: 100%;'>Описание</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                    <th>Статус</th>
                    <th>Одобрено</th>
                    <th>Цена билета</th>                    
                    <th></th>
                    <th></th>
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
                    <th>Наличие зала</th>
                    <th></th>
                    <th></th>
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
                    <th></th>
                    <th></th>
                </tr>
        ";
    }
    $blockedKeys = ["Image path", "Password"];
    foreach($result as $row) {
        echo
        "
            <tr>
        ";
        $keys = array_keys($row);
        $i = 1;
        $imagePath = $row["Image path"];
        foreach($keys as $key) {
            if($i == 2 and $tableName == "performances") {
                echo 
                "
                    <td>
                        <img style='border-radius: 10px; width: 250; height: 175px; object-fit: cover;' src='".$imagePath."'>
                    </td>
                "; 
            }
            if(in_array($key, $blockedKeys)) {
                continue;
            }
            // if($key == "Status") {
            //     if($row[$key] == 0)
            //         echo
            //         "
            //             <td>Не проведено</td>
            //         ";
            //     continue;
            // }
            echo 
            "
                <td>".$row[$key]."</td>
            ";
            ++$i;
        }
        echo 
        "   
                <td id='delete-".$tableName."' class='delete-button' style='text-align: right;'><i class='fa-solid fa-trash-can'></i></td>
                <td id='edit-".$tableName."' class='edit-button' style='text-align: right;'><i class='fa-solid fa-pencil'></i></td>
            </tr>
        ";
    }
    mysqli_close($link);
?>