<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $login = $_POST["login"];
    $password = md5($_POST["password"]);
    $query = "SELECT * FROM Users WHERE `Login` = '$login' and `Password` = '$password'";
    $result = mysqli_query($link, $query); 
    if($result) {
        $resultArray = mysqli_fetch_array($result);
        if($resultArray[0] == $login and $resultArray[3] == $password) {
            $_SESSION["login"] = $resultArray[0];
            $_SESSION["password"] = $resultArray[3];
            $_SESSION["name"] = $resultArray[1];
            $_SESSION["surname"] = $resultArray[2];
            $_SESSION["email"] = $resultArray[4];
            $_SESSION["roleName"] = $resultArray[5];
            $_SESSION["imagePath"] = $resultArray[6];
            mysqli_close($link);
            echo "Авторизация прошла успешно";
        }
        else {
            mysqli_close($link);
            die("Неверные логин или пароль");
        }
    }
    else {
        mysqli_close($link);
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
?>