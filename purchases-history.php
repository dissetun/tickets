<?php 

    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: index.php");
    }
?>

<html>

<!-- Head -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Билеты</title>
</head>

<!-- Body -->
<body>

    <div class="preloader">
        <div class="squares">
            <div class="square first-square"></div>
            <div class="square second-square"></div>
            <div class="square third-square"></div>
        </div>
    </div>

    <div class="wrapper">
        <header>
            <div class="header-wrapper">
                <div class = "nav-burger">
                    <div class="burger-icon">
                        <div class="burger-line"></div>
                        <div class="burger-line"></div>
                        <div class="burger-line"></div>
                    </div>
                    <div class="burger-list">
                        <a href="index.php" class="new">Новинки</a>
                        <a href="performances.php" class="catalog">Представления</a>
                    </div>
                </div>
                <div class="logo-container">
                    <i style = "margin-right: 10px; font-size: 30px;" class="fa-solid fa-ticket"></i>
                    <p class="logo">Билеты</p>
                </div>
                <nav>
                    <a href="index.php" class="new">Новинки</a>
                    <a href="performances.php" class="catalog">Представления</a>
                </nav>
                <div class="user">
                    <a class="signin-button" href="signin.php">Войти</a>
                    <p class="user-login"></p>
                    <div class="user-image"></div>
                    <div style="left: 0; position: absolute; background-color: transparent; height: 60px; width: 100%; cursor: pointer;" class="user-menu-button"></div>
                    <div class="user-menu">
                        <div style="text-align: left; margin-right: auto; margin-left: auto; align-self: start;">
                            <a style="text-align: left;" id="personal-area" href="personal-area.php">Личный кабинет</a>
                            <a style="text-align: left; color: white;" id="purchase-history" id="purchase-history-link" href="purchases-history.php" class="user-menu-link-active">Исторя покупок</a>
                            <p style="" id="logout">Выйти</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main style="margin-top: 150px; margin-bottom: 90px;">
            <div class='purchases-list-container'>
                <?php 
                    require_once "core/connect.php";
                    $link = mysqli_connect($host, $user, $password, $db_name);
                    $login = $_SESSION["login"];
                    $query = "SELECT * FROM purchases WHERE `Login` = '$login'";
                    $result = mysqli_query($link, $query);
                    if(!mysqli_num_rows($result)) {
                        echo 
                        "
                            <p class='purchases-list-logo'>История покупок пуста</p>
                        ";
                    }
                    else {
                        echo 
                        "
                            <p class='purchases-list-logo'>История покупок</p>
                        ";
                    }
                    foreach($result as $row) {
                        $performanceID = $row["Performance ID"];
                        $performancePlaceID = $row["Performance-place ID"];
                        $ticketPrice = "";
                        $performanceName = "";
                        $hall = "";
                        $platform = "";
                        $placeName = "";
                        $hallName = "";
                        if(!is_null($performancePlaceID)) {
                            $performanceID = "";
                            $placeID = "";
                            $query = mysqli_query($link, "SELECT * FROM `performance-places` WHERE `Performance-place ID` = '$performancePlaceID'");
                            foreach($query as $queryRow) {
                                $ticketPrice = $queryRow["Price"];
                                $performanceID = $queryRow["Performance ID"];
                                $placeID = $queryRow["Place ID"];
                            }
                            $hallID = "";
                            $placeQuery = mysqli_query($link, "SELECT * FROM places WHERE `Place ID` = '$placeID'");
                            foreach($placeQuery as $placeQueryRow) {
                                $placeName = $placeQueryRow["Place name"];
                                $hallID = $placeQueryRow["Hall ID"];
                            }
                            $hallQuery = mysqli_query($link, "SELECT * FROM halls WHERE `Hall ID` = '$hallID'");
                            foreach($hallQuery as $hallQueryRow) {
                                $hallName = $hallQueryRow["Hall name"];
                            }
                        }
                        else {
                            $query = mysqli_query($link, "SELECT * FROM performances WHERE `Performance ID` = '$performanceID'");
                            foreach($query as $queryRow) {
                                $ticketPrice = $queryRow["Ticket price"];
                                $platform = $queryRow["Platform"];
                            }
                        }
                        $getPerformanceNameQuery = mysqli_query($link, "SELECT * FROM performances WHERE `Performance ID` = '$performanceID'");
                        foreach($getPerformanceNameQuery as $getPerformanceNameQueryRow) {
                            $performanceName = $getPerformanceNameQueryRow["Performance name"];
                            $platform = $getPerformanceNameQueryRow["Platform"];
                        }
                        $ticketPrice = (int)$ticketPrice;
                        $style = "padding: 5px 10px; border-radius: 10px;";
                        if($ticketPrice <= 249) {
                            $style = $style." background-color: gray; color: white;";
                        }
                        else if($ticketPrice <= 450) {
                            $style = $style." background-color: #8aff73;";
                        }
                        else if($ticketPrice <= 650) {
                            $style = $style." background-color: #80b1ff;";
                        }
                        else if($ticketPrice <= 1000) {
                            $style = $style." background-color: #2e6dff; color: white;";
                        }
                        else if($ticketPrice <= 1300) {
                            $style = $style." background-color: #ffe873;";
                        }
                        else if($ticketPrice <= 1700) {
                            $style = $style." background-color: #ff9c38;";
                        }
                        else if($ticketPrice <= 2000) {
                            $style = $style." background-color: #ff6363; color: white;";
                        }
                        else if($ticketPrice <= 2500 || $ticketPrice > 2500) {
                            $style = $style." background-color: crimson; color: white;";
                        }
                        if(!is_null($performancePlaceID))
                            echo
                            "   
                                <div class='purchase'>
                                    <p style='text-align: center; align-self: flex-start; padding-bottom: 10px; border-bottom: 2px solid black;'>Билет <span style='font-weight: bold;'>".$row["Ticket name"]."</span></p>
                                    <p style='margin-top: 20px;'>Представление <span style='font-weight: bold;'>".$performanceName."</span></p>
                                    <p style='margin-top: 20px;'>Площадка <span style='font-weight: bold;'>".$platform."</span></p>
                                    <p style='margin-top: 20px;'>Место <span style='font-weight: bold;'>".$placeName."</span></p>
                                    <p style='margin-top: 20px;'>Зал <span style='font-weight: bold;'>".$hallName."</span></p>
                                    <p style='margin-top: 20px;'>Цена билета <span style='".$style."font-weight: bold;'>".$ticketPrice." ₽</span></p>
                                    <p style='margin-top: 20px;'>Дата покупки билета <span style='font-weight: bold;'>".$row["Date"]."</span></p>
                                </div>
                            ";
                        else {
                            echo
                            "   
                                <div class='purchase'>
                                    <p style='text-align: center; align-self: flex-start; padding-bottom: 10px; border-bottom: 2px solid black;'>Билет <span style='font-weight: bold;'>".$row["Ticket name"]."</span></p>
                                    <p style='margin-top: 20px;'>Представление <span style='font-weight: bold;'>".$performanceName."</span></p>
                                    <p style='margin-top: 20px;'>Площадка <span style='font-weight: bold;'>".$platform."</span></p>
                                    <p style='margin-top: 20px;'>Цена билета <span style='".$style."font-weight: bold;'>".$ticketPrice." ₽</span></p>
                                    <p style='margin-top: 20px;'>Дата покупки билета <span style='font-weight: bold;'>".$row["Date"]."</span></p>
                                </div>
                            ";
                        }
                    }
                    mysqli_close($link);
                ?>
            </div>
        </main>
 
        <footer>
            <div class="footer-info-container">
                <div class="footer-info-subcontainer">
                    <div class="footer-info-item">
                        <h1>Организаторам мероприятий</h1>
                        <a href="performance-add.php">Оставить заявку на проведение представления</a>
                        <a href="#">Площадки представлений</a>
                    </div>
                    <div class="footer-info-item">
                        <h1>Партнерам</h1>
                        <a href="#">Заключение сотрудничества</a>
                        <a href="#">Данные о компании</a>
                    </div>
                </div>
            </div>
            <div class="footer-corp-info">
                <p>@ 2022 - 2023 Tickets Inc.</p>
            </div>
        </footer>
    </div>
</body>

<script>

    const disablePreloader = () => {
        document.querySelector(".preloader").style.opacity = "0";
        document.querySelector(".preloader").style.visibility = "hidden";
    }

    window.onload = function() {
        setTimeout(() => disablePreloader(), 500);
    }

    // -------- session --------

    let sessionLogin = '<?php echo json_encode($_SESSION["login"])?>';
    if(sessionLogin != "null") {
        sessionLogin = sessionLogin.substring(1, sessionLogin.length - 1);
        $(".signin-button").css({"display":"none"});
        $(".user-login").text(sessionLogin);
        let roleName = '<?php echo json_encode($_SESSION["roleName"])?>';
        roleName = roleName.substring(1, roleName.length - 1);
        console.log(roleName);
        if(roleName == "Администратор") {
            $(".user-login").css({
                "padding":"3px 10px",
                "background-color":"crimson",
                "border-radius":"10px",
                "color":"white"
            });
            $("<a href='administration.php'>Управление</a>").insertAfter("#personal-area");
            $(".user-menu").css({"margin-top":"222px"});
        }
        else if(roleName == "Модератор") {
            $(".user-login").css({
                "padding":"3px 10px",
                "background-color":"#cedcfb",
                "border-radius":"10px",
                "color":"black"
            });
            $("<a href='moderation.php'>Модерация</a>").insertAfter("#personal-area");
            $(".user-menu").css({"margin-top":"222px"});
        }
        else {
            $(".user-menu").css({"margin-top":"195px"});
        }
        let imagePath = '<?php echo json_encode($_SESSION["imagePath"])?>';
        imagePath = "url(" + imagePath.substring(1, imagePath.length - 1) + ")";
        $(".user").css({"min-width":"165px"});
        $(".user-image").css({
            "display":"block",
            "background-image":imagePath
        });
        $(".user-menu-button").css({
            "display":"block"
        });
    }

    // -------- all burger menus --------

    $(".burger-icon").click(function() {
        if(!$(".burger-list").hasClass("burger-active")) {
            $(".burger-list").addClass("burger-active");
        }
        else $(".burger-list").removeClass("burger-active");
    });

    $(".user-menu-button").click(function() {
        if(!$(".user-menu").hasClass("user-menu-active")) {
            $(".user-menu").addClass("user-menu-active");
        }
        else $(".user-menu").removeClass("user-menu-active");
    });

    $("#logout").click(function() {
        $.ajax({
            type: "POST",
            url: "core/logout.php",
            context: document.body,
            success: function(result) {
            }
        });
        window.location.reload();
    });

</script>

</html>