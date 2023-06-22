<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $hallID = $_POST["hallID"];
    $query = "SELECT * FROM places WHERE `Hall ID` = '$hallID'";
    $result = mysqli_query($link, $query);
    if(!$result) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");      
    }
    $i = 0;
    foreach($result as $row) {
        if(!($i % 10)) {
            echo
            "   
                <div class='places-row'>
            ";
        }   
        echo 
        "
            <div class='place'>
                <div class='place-info'>
                    <p class='place-info-title'>".$row["Place name"]."</p>
                    <label>Цена</label>
                    <div style='display: flex; justify-content: center; align-items: center; align-content: center;'>
                        <input value='0' name='place-price' type='number' min='0'></input>
                        <p style='margin-left: 5px;'>руб.</p>
                    </div>
                </div>
            </div>
        ";
        if(!(($i + 1) % 10)) {
            echo 
            "   
                </div>
            ";
        }
        $i++;
    }
    echo
    "
        <div class='scene'>
            <p>Сцена</p>
        </div>
    ";
    mysqli_close($link);
?>