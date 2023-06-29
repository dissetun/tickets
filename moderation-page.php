<?php 

    session_start();
    if(!isset($_SESSION["login"]) or $_SESSION["roleName"] != "Модератор") {
        header("Location: index.php");
    }
    // include "connect.php";
    // $link = mysqli_connect($host, $user, $password, $db_name); 
    // $performanceID = $_GET["performance"];
    // $query = "SELECT * FROM performances WHERE `Performance ID` = '$performanceID'";
    // $today = date("Y-m-d H:i:s");
    // $result = mysqli_query($link, $query);
    // foreach($result as $row) {
    //     if(((int)$row["Hall existence"] == 0 and (int)$row["Places number"] == 0) or (int)$row["Approved"] != 1 or $today > $row["Start date"]) {
    //         header("Location: index.php");
    //     }
    // }

?>

<html>

<!-- Head -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="background-check.min.js"></script>
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
                        <a href="index.php" class="new nav-active">Новинки</a>
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
                            <a style="text-align: center; color: white;" id="moderation" href="moderation.php" class="user-menu-link-active">Модерация</a>
                            <a style="text-align: left;" id="purchase-history" id="purchase-history-link" href="purchases-history.php">Исторя покупок</a>
                            <p style="" id="logout">Выйти</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="performance-page-wrapper">
                <?php 
                    require_once 'core/connect.php';
                    $link = mysqli_connect($host, $user, $password, $db_name); 
                    $name = $_GET["performance"];
                    $query = "SELECT * FROM performances WHERE `Performance ID` = '$name'";
                    $result = mysqli_query($link, $query);
                    if(!$result)
                        die("error occured");
                    else 
                        foreach($result as $row) {
                            $performanceID = $_GET["performance"];
                            $monthName = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа",
                                    "Сентября", "Октября", "Ноября", "Декабря"];
                            // отформатированные данные даты начала представления
                            $startDate = new DateTime((string)$row["Start date"]);
                            $startDay = $startDate->format('d');
                            $startMonth = $startDate->format('m');
                            $startHours = $startDate->format('H');
                            $startMinutes = $startDate->format('i');
                            // отформатированные данные даты окончания представления
                            $endDate = new DateTime((string)$row["End date"]);
                            $endDay = $endDate->format('d');
                            $endMonth = $endDate->format('m');
                            $endHours = $endDate->format('H');
                            $endMinutes = $endDate->format('i');
                            // получение площадки, на которой будет проведено представление
                            $platform = $row["Platform"];
                            // поулчение адреса площадки, на которой будет проведено прсдетавление
                            $getAddressQuery = "SELECT Address from Platforms WHERE `Platform` = '$platform'";
                            $getAddressResult = mysqli_query($link, $getAddressQuery);
                            $address = "";
                            foreach($getAddressResult as $getAddressResultRow) {
                                $address = $getAddressResultRow["Address"];
                            }
                            $statusSubclass = "";
                            if($_GET["status"] == "Одобрена") {
                                $statusSubclass = "moderation-page-status-accepted";
                            }
                            else if($_GET["status"] == "Отклонена") {
                                $statusSubclass = "moderation-page-status-declined";
                            }
                            else {
                                $statusSubclass = "moderation-page-status-unapproved";
                            }
                            echo 
                            '
                                <div class="go-back-to-requests"">
                                    <div style="display: flex;">
                                        <i style="margin-top: 0px; font-size: 20px;" class="fa-solid fa-arrow-left-long"></i>
                                        <a style="margin-left: 10px;">Вернуться к заявкам</a>
                                    </div>
                                </div>
                                <div class="performance-thumbnail" style = "background: url('.$row["Image path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                                <p style="margin-top: auto; font-size: 30px;" class="performance-thumbnail-title">'.$row["Performance name"].'</p>
                                </div>
                                <p class="performance-description-title">Описание представления</p>
                                <p style="display: inline-block; word-break: break-all;" class="performance-description">'.$row["Description"].'</p>
                                <div class="performance-data">  
                                    <div class="performance-data-item">
                                        <p>Жанр</p>
                                        <div class="performance-data-item-element"><span>'.$row["Genre"].'</span></div>
                                    </div>
                                    <div class="performance-data-item">
                                        <p>Начало</p>
                                        <div class="performance-data-item-element"><span>'.(int)$startDay." ".$monthName[(int)$startMonth - 1]." ".$startHours.":".$startMinutes.'</span></div>
                                    </div>
                                    <div class="performance-data-item">
                                        <p>Окончание</p>
                                        <div class="performance-data-item-element"><span>'.(int)$endDay." ".$monthName[(int)$endMonth - 1]." ".$endHours.":".$endMinutes.'</span></div>
                                    </div>
                                    <div class="performance-data-item">
                                        <p>Площадка</p>
                                        <div class="performance-data-item-element"><span>'.$platform.'</span></div>
                                        <div class="performance-data-item-element"><span>'.$address.'</span></div>
                                    </div>
                            ';
                            $hallExistence = $row["Hall existence"];
                            if(!((int)$hallExistence)) {
                                $infoTicketPrice = $row["Ticket price"];
                                $style = "";
                                $priceStyle = "padding: 5px 10px; border-radius: 10px; font-weight: bold;";
                                if($infoTicketPrice <= 249) {
                                    $priceStyle = $priceStyle."background-color: gray; color: white;";
                                }
                                else if($infoTicketPrice <= 450) {
                                    $priceStyle = $priceStyle."background-color: #8aff73;";
                                }
                                else if($infoTicketPrice <= 650) {
                                    $priceStyle = $priceStyle."background-color: #80b1ff;";
                                }
                                else if($infoTicketPrice <= 1000) {
                                    $priceStyle = $priceStyle."background-color: #2e6dff; color: white;";
                                }
                                else if($infoTicketPrice <= 1300) {
                                    $priceStyle = $priceStyle."background-color: #ffe873;";
                                }
                                else if($infoTicketPrice <= 1700) {
                                    $priceStyle = $priceStyle."background-color: #ff9c38;";
                                }
                                else if($infoTicketPrice <= 2000) {
                                    $priceStyle = $priceStyle."background-color: #ff6363; color: white;";
                                }
                                else if($infoTicketPrice <= 2500 || $infoTicketPrice > 2500) {
                                    $priceStyle = $priceStyle."background-color: crimson; color: white;";
                                }
                                echo
                                '
                                    <div class="performance-data-item">
                                        <p>Цена билета</p>
                                        <div style="'.$priceStyle.'" class="performance-data-item-element"><span>'.$infoTicketPrice.' ₽</span></div>
                                    </div>
                                ';
                                echo 
                                '
                                    <div class="performance-data-item">
                                        <p>Статус заявки</p>
                                        <div class="'.$statusSubclass.'"><span>'.$_GET["status"].'</span></div>
                                    </div>
                                ';
                                echo "</div>";
                                if($_GET["status"] == "Одобрена") {
                                    echo 
                                    '
                                        <div id="performance-id='.$_GET["performance"].'" class="moderation-verdict-buttons">
                                            <p style="margin-left: auto;" id="moderation-decline-button">Отклонить заявку</p>
                                        </div>
                                    ';
                                }
                                else if($_GET["status"] == "Отклонена") {
                                    echo 
                                    '
                                        <div id="performance-id='.$_GET["performance"].'" class="moderation-verdict-buttons">
                                            <p style="margin-left: auto;" id="moderation-approve-button">Одобрить заявку</p>
                                        </div>
                                    ';
                                }
                                else {
                                    echo 
                                    '
                                        <div id="performance-id='.$_GET["performance"].'" class="moderation-verdict-buttons">
                                            <p id="moderation-decline-button">Отклонить заявку</p>
                                            <p id="moderation-approve-button">Одобрить заявку</p>
                                        </div>
                                    ';
                                }
                            }
                            else {
                                echo 
                                '
                                    <div class="performance-data-item">
                                        <p>Статус заявки</p>
                                        <div class="'.$statusSubclass.'"><span>'.$_GET["status"].'</span></div>
                                    </div>
                                ';
                                echo "</div>";
                                echo 
                                '
                                    <div id="places-config-menu-container" style="margin-top: 30px; display: flex;" class="form-element">
                                        <p style="font-size: 25px; font-weight: bold;" class="form-element-title">Схема зала</p>
                                        <div class="places-config-menu">
                                            <div class="places-config-menu-wrapper">
                                            
                                ';
                                $placesQuery = "SELECT * FROM `performance-places` WHERE `Performance ID` = '$performanceID'";
                                $placesResult = mysqli_query($link, $placesQuery);
                                if(!$placesResult) {
                                    die("Произошла ошибка. Мы уже работаем над ее исправлением :).");      
                                }
                                $i = 0;
                                $num_rows = mysqli_num_rows($placesResult);
                                foreach($placesResult as $placesRow) {
                                    if(!($i % 10)) {
                                        echo
                                        "   
                                            <div class='places-row'>
                                        ";
                                    }   
                                    $price = (int)$placesRow["Price"];
                                    $style = "";
                                    $priceStyle = "padding: 5px 10px; border-radius: 10px; font-weight: bold;";
                                    if($price <= 249) {
                                        $style = "background-color: gray;";
                                        $priceStyle = $priceStyle."background-color: gray; color: white;";
                                    }
                                    else if($price <= 450) {
                                        $style = "background-color: #8aff73;";
                                        $priceStyle = $priceStyle."background-color: #8aff73;";
                                    }
                                    else if($price <= 650) {
                                        $style = "background-color: #80b1ff;";
                                        $priceStyle = $priceStyle."background-color: #80b1ff;";
                                    }
                                    else if($price <= 1000) {
                                        $style = "background-color: #2e6dff;";
                                        $priceStyle = $priceStyle."background-color: #2e6dff; color: white;";
                                    }
                                    else if($price <= 1300) {
                                        $style = "background-color: #ffe873;";
                                        $priceStyle = $priceStyle."background-color: #ffe873;";
                                    }
                                    else if($price <= 1700) {
                                        $style = "background-color: #ff9c38;";
                                        $priceStyle = $priceStyle."background-color: #ff9c38;";
                                    }
                                    else if($price <= 2000) {
                                        $style = "background-color: #ff6363;";
                                        $priceStyle = $priceStyle."background-color: #ff6363; color: white;";
                                    }
                                    else if($price <= 2500 || $price > 2500) {
                                        $style = "background-color: crimson;";
                                        $priceStyle = $priceStyle."background-color: crimson; color: white;";
                                    }
                                    $placeholder = $placesRow["Placeholder"];
                                    if($placeholder != null) {
                                        $style = "background-color: black;";
                                    }
                                    $placeName = "";
                                    $placeID = $placesRow["Place ID"];
                                    $performancePlaceID = $placesRow["Performance-place ID"];
                                    $performanceID = $_GET["performance"];
                                    $placeNameQuery = "SELECT * FROM places WHERE `Place ID` = '$placeID'";
                                    $placeNameQueryResult = mysqli_query($link, $placeNameQuery);
                                    foreach($placeNameQueryResult as $placeNameQueryResultRow) {
                                        $placeName = $placeNameQueryResultRow["Place name"];
                                    }
                                    if($placeholder == null)
                                        echo 
                                        "
                                            <div data-ticketsNumber='".$ticketsNumber."' data-placeholder='".$placeholder."' data-performanceID='".$performanceID."' data-performancePlaceID='".$performancePlaceID."' data-placeName='".$placeName."' data-placePrice='".$price."' style='".$style."' class='place'>
                                                <div class='place-info'>
                                                    <p class='place-info-title'>".$placeName."</p>
                                                    <div style='display: flex; justify-content: center; align-items: center;'>
                                                        <p style='text-align: center; ".$priceStyle."'>".$price." ₽</p>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                    else 
                                        echo 
                                        "
                                            <div data-placeholder='".$placeholder."' style='".$style."' class='place'>
                                                <div class='place-info'>
                                                    <p class='place-info-title'>".$placeName."</p>
                                                    <div>
                                                        <p style='text-align: center;'>Место занято</p>
                                                    </div>
                                                </div>
                                            </div>
                                        ";

                                    if(!(($i + 1) % 10) or $i == $num_rows - 1) {
                                        echo 
                                        "   
                                            </div>
                                        ";
                                    }
                                    $i++;
                                }
                                echo
                                "
                                    <div class='scene'>
                                        <p>Сцена</p>
                                    </div>
                                ";
                                echo 
                                '
                                            </div>
                                        </div>
                                    </div>
                                ';
                                if($_GET["status"] == "Одобрена") {
                                    echo 
                                    '
                                        <div style="margin-top: 25px;" id="performance-id='.$_GET["performance"].'" class="moderation-verdict-buttons">
                                            <p style="margin-left: auto;" id="moderation-decline-button">Отклонить заявку</p>
                                        </div>
                                    ';
                                }
                                else if($_GET["status"] == "Отклонена") {
                                    echo 
                                    '
                                        <div style="margin-top: 25px;" id="performance-id='.$_GET["performance"].'" class="moderation-verdict-buttons">
                                            <p style="margin-left: auto;" id="moderation-approve-button">Одобрить заявку</p>
                                        </div>
                                    ';
                                }
                                else {
                                    echo 
                                    '
                                        <div style="margin-top: 25px;" id="performance-id='.$_GET["performance"].'" class="moderation-verdict-buttons">
                                            <p id="moderation-decline-button">Отклонить заявку</p>
                                            <p id="moderation-approve-button">Одобрить заявку</p>
                                        </div>
                                    ';
                                }
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
        document.querySelector(".preloader").style.display = "none";
    }

    window.onload = function() {
        setTimeout(() => disablePreloader(), 500);
    }

    // -------- background-check --------

    $(document).ready(function() {
        BackgroundCheck.init({
            targets: ".performance-thumbnail-title",
            images: ".performance-thumbnail"
        });
        const backgrouncCheckInterval = setInterval(function() {
            BackgroundCheck.refresh();
        }, 250); 
    });
    
    // -------- session --------

    let sessionLogin = '<?php echo json_encode($_SESSION["login"])?>';
    if(sessionLogin != "null") {
        sessionLogin = sessionLogin.substring(1, sessionLogin.length - 1);
        $(".signin-button").css({"display":"none"});
        $(".user-login").text(sessionLogin);
        let roleName = '<?php echo json_encode($_SESSION["roleName"])?>';
        roleName = roleName.substring(1, roleName.length - 1);
        console.log(roleName);
        if(roleName == "Модератор") {
            $(".user-login").css({
                "padding":"3px 10px",
                "background-color":"#cedcfb",
                "border-radius":"10px",
                "color":"black"
            });
            $(".user-menu").css({"margin-top":"222px"});
        }
        let imagePath = '<?php echo json_encode($_SESSION["imagePath"])?>';
        imagePath = "url(" + imagePath.substring(1, imagePath.length - 1) + ")";
        $(".user").css({"min-width":"160px"});
        $(".user-image").css({
            "display":"block",
            "background-image":imagePath
        });
        $(".user-menu-button").css({
            "display":"block"
        });
    }

    // -------- click events --------

    $("#moderation-approve-button").click(function() {
        let performanceID = $(this).parent().attr("id");
        performanceID = performanceID.replace("performance-id=", "");
        let query = "UPDATE performances SET `Approved` = '1' WHERE `Performance ID` = " + "'" + performanceID + "'";
        $.ajax({
            type: "POST",
            url: "core/moderation-verdict-query.php",
            context: document.body,
            data: {query: query},
            success: function(result) {
                console.log(result);
            }
        });
        window.location.replace("moderation-page.php?performance=" + performanceID + "&status=" + "Одобрена");
    });

    $("#moderation-decline-button").click(function() {
        let performanceID = $(this).parent().attr("id");
        performanceID = performanceID.replace("performance-id=", "");
        let query = "UPDATE performances SET `Approved` = '-1' WHERE `Performance ID` = " + "'" + performanceID + "'";
        $.ajax({
            type: "POST",
            url: "core/moderation-verdict-query.php",
            context: document.body,
            data: {query: query},
            success: function(result) {
                console.log(result);
            }
        });
        window.location.replace("moderation-page.php?performance=" + performanceID + "&status=" + "Отклонена");
    });

    $(".go-back-to-requests").click(function() {
        window.location.replace("moderation.php");
    });

    // -------- all burger-menus --------

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

    $(".places-config-menu-wrapper").on("mouseover", ".places-row .place", function(event) {
        let current = $(this);
        if(!current.hasClass("place-active")) {
            current.find(".place-info").css({"display":"flex"});
            current.addClass("place-active");
        }
        else {
            current.removeClass("place-active");
            current.find(".place-info").css({"display":"none"});
        }
    });

    $(".places-config-menu-wrapper").on("mouseout", ".places-row .place", function(event) {
        let current = $(this);
        current.removeClass("place-active");
        current.find(".place-info").css({"display":"none"});
    });

    $("#logout").click(function() {
        $.ajax({
            type: "POST",
            url: "core/logout.php",
            context: document.body,
            success: function(result) {
            }
        });
        setTimeout(() => {
            window.location.reload();
        }, 150);
    });

</script>

</html>