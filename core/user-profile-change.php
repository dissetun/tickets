<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include "connect.php";
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $queryType = $_POST["queryType"];
    if($queryType == "profile") {
        $newName = $_POST["newName"];
        $newSurname = $_POST["newSurname"];
        $login = $_SESSION["login"];
        $newImage = $_POST["newImage"];
        $query = "UPDATE users SET `Name` = '$newName', `Surname` = '$newSurname', `Image path` = '$newImage' WHERE `Login` = '$login'";
        $result = mysqli_query($link, $query);
        if(!$result) {
            die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
        }
        echo "Успешно";
        $_SESSION["name"] = $newName;
        $_SESSION["surname"] = $newSurname;
        $_SESSION["imagePath"] = $newImage;
        mysqli_close($link);
    }
    if($queryType == "password") {
        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $login = $_SESSION["login"];
        $query = "SELECT `Password` FROM users WHERE `login` = '$login'";
        $result = mysqli_query($link, $query);
        if(!$result) {
            die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
        }
        foreach($result as $row) {
            if($oldPassword != $row["Password"]) {
                echo "Пароли не совпадают";
                mysqli_close($link);
                die();
            }
            else {
                echo "Успешно";
                $updateQuery = "UPDATE users SET `Password` = '$newPassword' WHERE `Login` = '$login'";
                $updateQueryResult = mysqli_query($link, $updateQuery);
                $_SESSION["password"] = $newPassword;
            }
        }
    }
    if($queryType == "email") {
        $newEmail = $_POST["newEmail"];
        $login = $_SESSION["login"];
        $query = "SELECT `Email` FROM users WHERE `Email` = '$newEmail'";
        $result = mysqli_query($link, $query);
        if(!$result) {
            die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
        }
        if($result->num_rows != 0 and $_SESSION["email"] != $newEmail) {
            echo "Почта уже используется";
            mysqli_close($link);
            die();
        }
        $emailUpdateQuery = "UPDATE users SET `Email` = '$newEmail' WHERE `Login` = '$login'";
        echo mysqli_error($link);
        $emailUpdateResult = mysqli_query($link, $emailUpdateQuery);
        if(!$emailUpdateQuery) {
            die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
        }
        echo "Успешно";
        $_SESSION["email"] = $newEmail;
        mysqli_close($link);
    }
?>