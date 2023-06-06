<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $login = $_POST["login"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $roleName = "Пользователь";
    $insertQuery = "INSERT INTO users (`Login`, `Name`, `Surname`, `Password`, `Email`, `Role name`) VALUES 
    ('$login', '$name', '$surname', '$password', '$email', '$roleName')";
    $result = mysqli_query($link, $insertQuery);
    if($result) {
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["email"] = $email;
        $_SESSION["roleName"] = $roleName;
        echo mysqli_error($link);
        echo "Регистрация прошла успешно";
    }
    else {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    mysqli_close($link);
    // $lastKey = array_key_last($_POST);
    // foreach($_POST as $key=>$value) {
    //     $insertQuery = $insertQuery."'$$value'";
    //     if($key != $lastKey) {
    //         $insertQuery = $insertQuery.', ';
    //     }
    // }
    // $insertQuery = $insertQuery.')';
    // $result = mysqli_query($link, $insertQuery);
?>