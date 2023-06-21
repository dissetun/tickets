<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $path = 'img/'.time().str_replace(' ', '', $_FILES["performance-img"]["name"]);
    if(!move_uploaded_file($_FILES["performance-img"]["tmp_name"], "../".$path)) {
        die("Изображение не выбрано");
    }
    echo $path;
?>