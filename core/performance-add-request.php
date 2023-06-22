<?php 
    session_start();
    include "connect.php";
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    $link = mysqli_connect($host, $user, $password, $db_name);
    $performanceName = $_POST["performanceName"];
    $hallExistence = $_POST["hallExistence"];
    $hallID = $_POST["hallID"];
    $genre = $_POST["genre"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $status = 0;
    $approved = 0;
    $description = $_POST["description"];
    $ticketPrice = $_POST["ticketPrice"];
    $placesArray = json_decode($_POST["placesArray"]);
    $imagePath = $_POST["imagePath"];
    if(!$hallExistence) {
        $query = "INSERT INTO performances (`Performance name`, `Hall existence`, `Genre`, `Description`, `Start date`, `End date`, `Status`, `Approved`, `Ticket price`, `Image path`) VALUES ('$performanceName', '$hallExistence', '$genre', '$description', '$startDate', '$endDate', '$status', '$approved', '$ticketPrice', '$imagePath')";
        $result = mysqli_query($link, $query);
        echo mysqli_error($link);
    }
    else {
        $query = "INSERT INTO performances (`Performance name`, `Hall existence`, `Hall ID`, `Genre`, `Description`, `Start date`, `End date`, `Status`, `Approved`, `Ticket price`, `Image path`) VALUES ('$performanceName', '$hallExistence', '$hallID', '$genre', '$description', '$startDate', '$endDate', '$status', '$approved', '-1', '$imagePath')";
        $result = mysqli_query($link, $query);
        echo mysqli_error($link);

        // following code will generate places with defined price for each place and insert it into database ticket-db[performances]:

        // for($i = 0; $i < count($placesArray); $i++) {
        //     $placeQuery = "INSERT INTO `performance-place`";
        // }
    }
    mysqli_close($link);
    // echo $performanceName."\n".$hallExistence."\n".$hallID."\n".$genre."\n".$startDate."\n".$endDate."\n".$status."\n".$description."\n".$ticketCost."\n".$placesArray."\n".$imagePath;
?>