<?php 
    // include "connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name); 
    // $query = "SELECT * FROM halls";
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     $nums = [20, 30, 40, 50, 60];
    //     $placesCount = $nums[rand(0, 4)];
    //     for($i = 1; $i <= $placesCount; $i++) { 
    //         $curlink = mysqli_connect($host, $user, $password, $db_name);
    //         $placeName = $row["Hall name"]."-".(string) $i;
    //         $hallID = $row["Hall ID"];
    //         $placeInsertQuery = "INSERT INTO places (`Hall ID`, `Place name`) VALUES ('$hallID', '$placeName')";
    //         $resultPlaceInsert = mysqli_query($curlink, $placeInsertQuery);
    //         mysqli_close($curlink);
    //     }
    // }
    // mysqli_close($link);
    include "connect.php";
    $link = mysqli_connect($host, $user, $password, $db_name);
    $images = ["image093-17.jpg", "eyxswv45a1u5qcv5.jpg", 
    "dom-les-art-gory-reka-voda.jpg", "cute-aesthetic-backgrounds.jpg", 
    "cloud-binary-0-1-rain.jpg", "blood-red-moon-minimalist-laptop-art-uldv54uwdrwa8xz8.jpg",
    "1624921325_24-phonoteka_org-p-oboi-na-rabochii-stol-yaponiya-samurai-kra-25.jpg",
    "335255-minimal-wallpaper-2560x1600-large-resolution.jpg",
    "147502-emmer-pastelnye_plyazh-rozh-rastenie-rnga-1920x1080.jpg",
    "90s-anime-aesthetic-wric2do30b1rjds3.jpg"];
    $titles = ["Выставка ползучих гадов", "Гибернация древних существ", "Газонокосильщик", "whoami?",
    "[ДАННЫЕ УДАЛЕНЫ]", "Деревянная ложка на деревянном столе", "Щекотливые вопросы", "Райский ад", 
    "Ананта-Шеша", "Крестовые походцы"];
    $hallsQuery = "SELECT * FROM halls";
    $hallsQueryResult = mysqli_query($link, $hallsQuery);
    $halls = [];
    foreach($hallsQueryResult as $row) {
        array_push($halls, $row["Hall ID"]);
    }
    $genresQuery = "SELECT * FROM genres";
    $genresQueryResult = mysqli_query($link, $genresQuery);
    $genres = [];
    foreach($genresQueryResult as $row) {
        array_push($genres, $row["Genre"]);
    }
    for($i = 0; $i < 10; $i++) {
        $performanceName = $titles[$i];
        $hallID = $halls[rand(0, 5)];
        $genre = $genres[rand(0, 11)];
        $startDate = date('2015-'.(string)(1 + $i).'-01 10:00:00');
        $endDate = date('2015-'.(string)(1 + $i).'-01 12:00:00');
        $status = 0;
        $imagePath = "img/".$images[$i];
        $query = "INSERT INTO performances (`Performance name`, `Hall ID`, `Genre`, `Start date`,
        `End date`, `Status`, `Image path`) VALUES ('$performanceName', '$hallID', '$genre', '$startDate', 
        '$endDate', '$status', '$imagePath')";
        $performanceInsertResult = mysqli_query($link, $query);
        echo mysqli_error($link);
        echo "<br>";
    }
    mysqli_close($link);
?>