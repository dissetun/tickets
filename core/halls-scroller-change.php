<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $platform = $_POST["platform"];
    $query = "SELECT * FROM Halls WHERE `Platform` = '$platform'";
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) == 0) {
        echo "Залов нет";
        mysqli_close($link);
        die();
    }
    echo
    '
        <div class="custom-scroller-selected-option-container">
            <div class="custom-scroller-selected-option">
                <p>Выберите зал</p>
            </div>
            <div class="custom-scroller-list-caret">
                <i class="fa-solid fa-caret-down"></i>
            </div>
        </div>
        <div style="z-index: 999;" class="custom-scroller-list">
    ';
    $platformOptionId = 1;
    foreach($result as $row) {
        echo 
        "
            <div id='hallID-option-".$platformOptionId."' class='custom-scroller-option'>
                <p id='hallID=".$row["Hall ID"]."'>".$row['Hall name']."</p>
            </div>
        ";
        $platformOptionId++;
    }
    echo 
    '
        </div>
    ';
    mysqli_close($link);
?>