<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $path = 'tmp-img/'.time().str_replace(' ', '', $_FILES["performance-img"]["tmp_name"]);
    if(!move_uploaded_file($_FILES["performance-img"]["tmp_name"], "../".$path)) {
        die("Ошибка");
    }
    echo $path;
?>