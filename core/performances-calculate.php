<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $today = date("Y-m-d H:i:s");
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $left = $_POST["pages"];
    // $query = "SELECT * FROM performances WHERE `Approved` = '1' AND `Start date` > '$today' AND ((`Hall existence` = '0' AND `Places number` > '0') OR `Hall existence` = '1') LIMIT 6";
    $query = "SELECT COUNT(`performance id`) FROM performances WHERE `Approved` = '1' AND `Start date` > '$today' AND `Places number` > '0'";
    $result = mysqli_query($link, $query);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo ($row[0] - $left <= 0 ? "Hide" : "Show");
    mysqli_close($link);
?>
