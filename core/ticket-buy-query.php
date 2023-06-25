<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $checkType = $_POST["checkType"];
    $checkQuery = $_POST["checkQuery"];
    if($checkType == "without hall") {
        $checkQueryResult = mysqli_query($link, $checkQuery);
        foreach($checkQueryResult as $checkQueryRow) {
            if($checkQueryRow["Places number"] <= 0) {
                echo 
                "
                    <div style='display: flex; justify-content: center; align-items: center;'>
                        <p style='text-align: center;'>К сожалению, билеты закончились. Этот билет был последним, и вы не успели его купить.</p>
                    </div>
                ";
                mysqli_close($link);
                die();
            }
        }
    }
    else {
        $checkQueryResult = mysqli_query($link, $checkQuery);
        foreach($checkQueryResult as $checkQueryRow) {
            if(!is_null($checkQueryRow['Placeholder'])) {
                echo 
                "
                    <div style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                        <p style='text-align: center;'>Кто-то уже купил этот билет. Для просмотра текущей схемы зала обновите страницу.</p>
                        <p id='page-refresh-button' style='margin-top: 10px; padding: 5px 10px; background-color: black; color: white; border-radius: 10px;'>Обновить страницу</p>
                    </div>
                ";
                mysqli_close($link);
                die();
            }
        }
    }
    $firstQuery = $_POST["firstQuery"];
    $secondQuery = $_POST["secondQuery"];
    $thirdQuery = $_POST["thirdQuery"];
    $firstResult = mysqli_query($link, $firstQuery);
    if(!$firstResult) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $secondResult = mysqli_query($link, $secondQuery);
    if(!$secondResult) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    if($thirdQuery != "") {
        $thirdResult = mysqli_query($link, $thirdQuery);
        if(!$thirdResult) {
            die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
        }
    }
    echo 
    "
        <div style='display: flex; justify-content: center; align-items: center;'>
            <p style='text-align: center;'>Билет успешно вами приобретен, подробности в истории покупок.</p>
            <i style='margin-left: 10px; font-size: 30px;' class='fa-regular fa-circle-check'></i>
        </div>
    ";
    mysqli_close($link);
?>