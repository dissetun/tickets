<?php 
    include 'connect.php';
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $left = $_POST["left"];
    $query = "SELECT * FROM performances LIMIT $left, 6";
    $result = mysqli_query($link, $query);
    foreach($result as $row) {
        echo 
        '
            <a href="performance-page.php?performance='.$row["Performance name"].'" style = "background: url('.$row["Image path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="performance">
                <p>'.$row["Performance name"].'</p>
            </a>
        ';
    }
    mysqli_close($link);
?>
