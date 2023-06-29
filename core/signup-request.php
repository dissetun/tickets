<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $login = $_POST["login"];
    $getUsersQuery = "SELECT * FROM users WHERE `Login` = '$login'";
    $getUsersResult = mysqli_query($link, $getUsersQuery);
    if(mysqli_num_rows($getUsersResult)) {
        echo "Логин занят";
        mysqli_close($link);
        die();
    }
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = md5($_POST["password"]);
    $email = $_POST["email"];
    $roleName = "Пользователь";
    $imagePath = "img/user-profile.png";
    $insertQuery = "INSERT INTO users (`Login`, `Name`, `Surname`, `Password`, `Email`, `Role name`, `Image path`) VALUES 
    ('$login', '$name', '$surname', '$password', '$email', '$roleName', '$imagePath')";
    $result = mysqli_query($link, $insertQuery);
    if($result) {
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $password;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
        $_SESSION["email"] = $email;
        $_SESSION["roleName"] = $roleName;
        $_SESSION["imagePath"] = $imagePath;
        echo mysqli_error($link);
        echo "Регистрация прошла успешно";
    }
    else {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    mysqli_close($link);
?>