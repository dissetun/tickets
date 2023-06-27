<?php 
    session_start();
    include "connect.php";
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $link = mysqli_connect($host, $user, $password, $db_name);
    $performanceName = $_POST["performanceName"];
    $platform = $_POST["platform"];
    $hallExistence = $_POST["hallExistence"];
    $hallID = $_POST["hallID"];
    $genre = $_POST["genre"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $approved = 0;
    $description = $_POST["description"];
    $placesNumber = $_POST["placesNumber"];
    $ticketPrice = $_POST["ticketPrice"];
    $placesArray = json_decode($_POST["placesArray"]);
    $imagePath = $_POST["imagePath"];
    if($hallExistence == '0') {
        $query = "INSERT INTO performances (`Performance name`, `Platform`, `Hall existence`, `Genre`, `Description`, `Start date`, `End date`, `Approved`, `Places number`, `Ticket price`, `Image path`) VALUES ('$performanceName', '$platform', '$hallExistence', '$genre', '$description', '$startDate', '$endDate', '$approved', '$placesNumber', '$ticketPrice', '$imagePath')";
        $result = mysqli_query($link, $query);
    }
    else {
        $query = "INSERT INTO performances (`Performance name`, `Platform`, `Hall existence`, `Hall ID`, `Genre`, `Description`, `Start date`, `End date`, `Approved`, `Places number`, `Ticket price`, `Image path`) VALUES ('$performanceName', '$platform', '$hallExistence', '$hallID', '$genre', '$description', '$startDate', '$endDate', '$approved', '$placesNumber', '-1', '$imagePath')";
        $result = mysqli_query($link, $query);
        $lastID = mysqli_insert_id($link);

        // following code will generate places with defined price for each place and insert it into database ticket-db[performances]:

        for($i = 0; $i < count($placesArray); $i++) {
            $placeName = $placesArray[$i][0];
            $placePrice = $placesArray[$i][1];
            $placeIDQuery = "SELECT * FROM places WHERE `Hall ID` = '$hallID' and `Place name` = '$placeName'";
            $placeIDQueryResult = mysqli_query($link, $placeIDQuery);
            $placeID = "";
            foreach($placeIDQueryResult as $placeIDQueryResultRow) {
                $placeID = $placeIDQueryResultRow["Place ID"];
            }
            $insertQuery = "INSERT INTO `performance-places` (`Performance ID`, `Place ID`, `Price`) VALUES ('$lastID', '$placeID', '$placePrice')";
            $insertQueryResult = mysqli_query($link, $insertQuery);
            echo mysqli_error($link);
        }
    }
    echo 
    "
        <div style='display: flex; justify-content: center; align-items: center;'>
            <p style='text-align: center;'>Заявка на проведение представления отправлена</p>
            <i style='margin-left: 10px; font-size: 30px;' class='fa-regular fa-circle-check'></i>
        </div>
    ";
    mysqli_close($link);
    // echo $performanceName."\n".$hallExistence."\n".$hallID."\n".$genre."\n".$startDate."\n".$endDate."\n".$status."\n".$description."\n".$ticketCost."\n".$placesArray."\n".$imagePath;
?>