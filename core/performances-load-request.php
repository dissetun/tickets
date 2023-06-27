<?php 
    session_start();
    if(!isset($_POST)) {
        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
    }
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $left = $_POST["left"];
    $today = date("Y-m-d H:i:s");
    // $query = "SELECT * FROM performances WHERE `Approved` = '1' AND `Start date` > '$today' LIMIT $left, 6";
    $query = "SELECT * FROM performances WHERE `Approved` = '1' AND `Start date` > '$today' AND `Places number` > '0' LIMIT $left, 6";
    $result = mysqli_query($link, $query);
    foreach($result as $row) {
        $performanceID = $row["Performance ID"];
        $monthName = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа",
        "Сентября", "Октября", "Ноября", "Декабря"];
        // отформатированные данные даты начала представления
        $startDate = new DateTime((string)$row["Start date"]);
        $startDay = $startDate->format('d');
        $startMonth = $startDate->format('m');
        $startHours = $startDate->format('H');
        $startMinutes = $startDate->format('i');
        $minPrice = "undefined";
        if(!((int)$row["Hall existence"])) {
            $minPrice = $row["Ticket price"];
        }
        else {
            $minPriceQuery = "SELECT MAX(`Price`) AS `Min price` FROM `performance-places` WHERE `Performance ID` = '$performanceID'";
            $minPriceQueryResult = mysqli_query($link, $minPriceQuery);
            foreach($minPriceQueryResult as $minPriceQueryRow) {
                $minPrice = "от ".$minPriceQueryRow["Min price"];
            }
        }
        echo 
        '
            <div>
                <a href="performance-page.php?performance='.$row["Performance ID"].'" style = "background: url('.$row["Image path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="performance">
                    <p class="performance-name-title">'.$row["Performance name"].'</p>
                </a>
                <div style="display: flex; margin-top: 10px; margin-bottom: 10px; align-items: center;">
                <p>'.(int)$startDay." ".$monthName[(int)$startMonth - 1].", ".$startHours.":".$startMinutes.'</p>
                <p style="margin-left: 5px;">●</p>
                <p style="padding: 2px 10px; background-color: #4a4a4a; color: white; margin-left: 5px; border-radius: 10px;">'.$minPrice.' ₽</p>
                </div>
            </div>
        ';
        // echo 
        // '
        //     <a href="performance-page.php?performance='.$row["Performance ID"].'" class="performance" style="padding: 0px;">
        //         <img class="performance-img" src="'.$row["Image path"].'" style="display: block; object-fit: cover; width: 100%; height: 100%;">
        //         <p style="position: absolute;" class="performance-name-title">'.$row["Performance name"].'</p>
        //     </a>
        // ';
    }
    mysqli_close($link);
?>

<script>
    $(document).ready(function() {
        BackgroundCheck.init({
            targets: $(this).find(".performance-name-title"),
            images: $(this).find(".performance")
        });
    });
</script>