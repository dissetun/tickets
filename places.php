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

// ------- генерация мест для представлений -------
    // include "core/connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name);
    // $query = "SELECT * FROM performances";
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     $performanceID = $row["Performance ID"];
    //     $hallID = $row["Hall ID"];
    //     $getPlaceQuery = "SELECT * FROM Places WHERE `Hall ID` = '$hallID'";
    //     $getPlaceResult = mysqli_query($link, $getPlaceQuery);
    //     $priceList = [500, 600, 700, 800, 900, 1000];
    //     $priceListGaps = [100, 150, 200, 250, 300, 350];
    //     $price = $priceList[rand(0, 5)];
    //     $skippedPlaces = 0;
    //     foreach($getPlaceResult as $getPlaceResultRow) {
    //         $placeID = $getPlaceResultRow["Place ID"];
    //         $performancePlaceInsertQuery = "INSERT INTO `performance-places` (`Performance ID`, `Place ID`, `Price`, `Placeholder`, `Status`)
    //         VALUES ('$performanceID', '$placeID', '$price', 'biboslakaka', 0)";
    //         // echo $performanceID.' '.$placeID.' '.$price;
    //         // echo "<br>";
    //         $performancePlaceInsertQueryResult = mysqli_query($link, $performancePlaceInsertQuery);
    //         $skippedPlaces++;
    //         if($skippedPlaces % 10 == 0)
    //             $price += $priceListGaps[rand(0, 5)];
    //     }
    // }
    // mysqli_close($link); 

// ------- обновление изображения профиля -------
    // include "core/connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name);
    // $query = "SELECT * FROM platforms";
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     $platform = $row["Platform"];
    //     $otherQuery = "SELECT * FROM halls WHERE `Platform` = '$platform'";
    //     $otherResult = mysqli_query($link, $otherQuery);
    //     if(mysqli_num_rows($otherResult) > 0) {
    //         $updateQuery = "UPDATE platforms SET `Halls existence` = '1' WHERE `Platform` = '$platform'";
    //         $updateResult = mysqli_query($link, $updateQuery);
    //         echo "updated";
    //     }
    // }
    // mysqli_close($link);

// ------- рандомный статус заявки -------
    // include "core/connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name);
    // $query = "SELECT * FROM performances";
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     $performanceID = $row["Performance ID"];
    //     $approvedList = [-1, 0, 1];
    //     $approved = $approvedList[rand(0, 2)];
    //     $otherQuery = "UPDATE performances SET `Approved` = '$approved' WHERE `Performance ID` = '$performanceID'";
    //     $otherResult = mysqli_query($link, $otherQuery);
    //     echo mysqli_error($link);
    // }
    // mysqli_close($link);

// ------- (текущая дата) + (1 год) -------
    // include "core/connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name);
    // $query = "SELECT * FROM performances";
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     // $today = date("Y-m-d H:i:s", strtotime("+1 year"));
    //     $description = "There is a species of humans called hobbits which were very short and lived on an island in Indonesia thousands of years ago. Our house is a historic building and protected monument. Lets all just take a moment to breathe, please!";
    //     $otherQuery = "UPDATE performances SET `Description` = '$description'";
    //     $otherResult = mysqli_query($link, $otherQuery);
    //     echo mysqli_error($link);
    // }
    // mysqli_close($link);

// ------- platform identify -------
    // include "core/connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name);
    // $query = "SELECT * FROM performances";
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     $hallExistence = $row["Hall ID"];
    //     $performanceID = $row["Performance ID"];
    //     if($hallExistence != '0') {
    //         $hallID = $row["Hall ID"];
    //         $sQuery = "SELECT * FROM halls WHERE `Hall ID` = '$hallID'";
    //         $sQueryResult = mysqli_query($link, $sQuery);
    //         foreach($sQueryResult as $sRow) {
    //             $platform = $sRow["Platform"];
    //             $rQuery = "UPDATE performances SET `Platform` = '$platform', `Hall existence` = '1' WHERE `Performance ID` = '$performanceID'";
    //             $rQueryResult = mysqli_query($link, $rQuery);
    //         }
    //     }
    //     else {
    //         $dkaksion = "ДК \"Аксион\"";
    //         $rQuery = "UPDATE performances SET `Platform` = '$dkaksion' WHERE `Performance ID` = '$performanceID'";
    //         echo $rQuery;
    //         echo "<br>";
    //         $rQueryResult = mysqli_query($link, $rQuery);
    //     }
    //     echo mysqli_error($link);
    //     echo "<br>";
    // }
    // mysqli_close($link);
?>