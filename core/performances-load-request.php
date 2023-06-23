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
    $query = "SELECT * FROM performances WHERE `Approved` = '1' AND `Start date` > '$today' AND ((`Hall existence` = '0' AND `Places number` > '0') OR `Hall existence` = '1') LIMIT $left, 6";
    $result = mysqli_query($link, $query);
    foreach($result as $row) {
        echo 
        '
            <a href="performance-page.php?performance='.$row["Performance ID"].'" style = "background: url('.$row["Image path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="performance">
                <p class="performance-name-title">'.$row["Performance name"].'</p>
            </a>
        ';
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