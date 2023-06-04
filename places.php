<?php 
// ------- places generator -------
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

// ------- performances generator -------
    // include "connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name);
    // $images = ["852489cbad1b3eb5aec1c4dabd24877f.jpg", 
    // "50fe4dc0897b938f8fc2ab8882842c3a.png", 
    // "59559cf94971ed1382b0b0869f1bf57e.jpeg", 
    // "1637694504_69-gamerwall-pro-p-golubie-oboi-minimalizm-oboi-na-rabochii-s-73.jpg", 
    // "7448170f4820a39d1208e02595c49f84.jpg", 
    // "968fbedfa320f3b9827f72a9b464e9bc.jpg",
    // "431960_screenshots_20200107140618_1.jpg",
    // "1660811115_57-kartinkin-net-p-estetichnie-oboi-s-kuromi-krasivo-70.jpg",
    // "calm-aesthetic-5niukfhg2d68xqks.jpg",
    // "147642-vetv-rastsvet-lepestok-vesna-tsvetok-3840x2160.jpg"];
    // $hallsQuery = "SELECT * FROM halls";
    // $hallsQueryResult = mysqli_query($link, $hallsQuery);
    // $halls = [];
    // foreach($hallsQueryResult as $row) {
    //     array_push($halls, $row["Hall ID"]);
    // }
    // $genresQuery = "SELECT * FROM genres";
    // $genresQueryResult = mysqli_query($link, $genresQuery);
    // $genres = [];
    // foreach($genresQueryResult as $row) {
    //     array_push($genres, $row["Genre"]);
    // }
    // for($i = 11; $i < 21; $i++) {
    //     $numberOfWords = rand(1, 3);
    //     $performanceName = "";
    //     for($j = 0; $j < $numberOfWords; $j++) {
    //         $uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    //         $alphabet = "abcdefghijklmnopqrstuvwxyz";
    //         $currentAlphabet = str_shuffle($alphabet);
    //         $currentWord = substr($currentAlphabet, 0, rand(5, 13));
    //         if($j > 0)
    //             $performanceName = $performanceName.' '.$uppercase[rand(0, 25)].$currentWord;
    //         else 
    //             $performanceName = $uppercase[rand(0, 25)].$currentWord;
    //     }
    //     $hallID = $halls[rand(0, 5)];
    //     $genre = $genres[rand(0, 11)];
    //     $startDate = date('2015-01-'.(string)(1 + $i).' 10:00:00');
    //     $endDate = date('2015-01-'.(string)(1 + $i).' 12:00:00');
    //     $status = 0;
    //     $imagePath = "img/".$images[$i - 11];
    //     $query = "INSERT INTO performances (`Performance name`, `Hall ID`, `Genre`, `Start date`,
    //     `End date`, `Status`, `Image path`) VALUES ('$performanceName', '$hallID', '$genre', '$startDate', 
    //     '$endDate', '$status', '$imagePath')";
    //     $performanceInsertResult = mysqli_query($link, $query);
    //     echo mysqli_error($link);
    //     echo "<br>";
    // }
    // mysqli_close($link);
?>