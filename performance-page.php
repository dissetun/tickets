<?php 

    session_start();
    include "core/connect.php";
    $link = mysqli_connect($host, $user, $password, $db_name); 
    $performanceID = $_GET["performance"];
    $query = "SELECT * FROM performances WHERE `Performance ID` = '$performanceID'";
    $today = date("Y-m-d H:i:s");
    $result = mysqli_query($link, $query);
    foreach($result as $row) {
        if((int)$row["Places number"] == 0 or (int)$row["Approved"] != 1 or $today > $row["Start date"]) {
            header("Location: index.php");
        }
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
                        <a href="index.php" class="new">Новинки</a>
                        <a href="performances.php" class="catalog nav-active">Представления</a>
                    </div>
                </div>
                <div class="logo-container">
                    <i style = "margin-right: 10px; font-size: 30px;" class="fa-solid fa-ticket"></i>
                    <p class="logo">Билеты</p>
                </div>
                <nav>
                    <a href="index.php" class="new">Новинки</a>
                    <a href="performances.php" class="catalog nav-active">Представления</a>
                </nav>
                <div class="user">
                    <a class="signin-button" href="signin.php">Войти</a>
                    <p class="user-login"></p>
                    <div class="user-image"></div>
                    <div style="left: 0; position: absolute; background-color: transparent; height: 60px; width: 100%; cursor: pointer;" class="user-menu-button"></div>
                    <div class="user-menu">
                        <div style="text-align: left; margin-right: auto; margin-left: auto; align-self: start;">
                            <a style="text-align: left;" id="personal-area" href="personal-area.php">Личный кабинет</a>
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
                        die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
                    else 
                        foreach($result as $row) {
                            $ticketsNumber = $row["Places number"];
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
                            $getAddressQuery = "SELECT Address FROM Platforms WHERE `Platform` = '$platform'";
                            $getAddressResult = mysqli_query($link, $getAddressQuery);
                            $address = "";
                            foreach($getAddressResult as $getAddressResultRow) {
                                $address = $getAddressResultRow["Address"];
                            }
                            $login = $_SESSION["login"];
                            $hallExistence = $row["Hall existence"];
                            echo 
                            '                                
                                <div data-login="'.$login.'" class="performance-thumbnail" style="background: url('.$row["Image path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                                    <p style="margin-top: auto; font-size: 20px;" class="performance-thumbnail-title">'.$row["Performance name"].'</p>
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
                            }
                            echo 
                            '
                                </div>
                            ';
                            $ticketBuyButtonStyle = "";
                            if((int)$hallExistence) {
                                $ticketBuyButtonStyle = "display: none;";
                            }
                            else {
                                $ticketBuyButtonStyle = "display: flex;";
                            }
                            if((int)$hallExistence) {
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
                            }
                            echo 
                            '
                                <div style="margin-top: 50px; margin-left: auto; display: none;" class="selected-place-info">
                                    <p style="font-weight: bold; font-size: 25px; margin-bottom: 10px;">Выбранный билет</p>
                                    <div style="">
                                    </div>
                                </div>
                            ';
                            echo 
                            '
                                <div style="margin-top: 50px;'.$ticketBuyButtonStyle.'" class="ticket-buy-button">
                                    <p>Купить билет</p>
                                </div>
                            ';
                        }
                    mysqli_close($link);
                ?>
            </div>
        </main>
 
        <dialog style="" id='ticket-buy-dialog' class="dialog">
            <div class='dialog-wrapper'>
                <div class='dialog-header'>
                    <p>Покупка билета</p>
                    <i class="fa-solid fa-xmark hide-dialog"></i>
                </div>
                <div style="display: flex; justify-content: center; align-items: center;" class='dialog-content'>
                    <?php 
                        require_once "core/connect.php";
                        $link = mysqli_connect($host, $user, $password, $db_name); 
                        $performanceID = $_GET["performance"];
                        $query = "SELECT * FROM performances WHERE `Performance ID` = '$performanceID'";
                        $result = mysqli_query($link, $query);
                        if(!$result) {
                            die("Произошла ошибка. Мы уже работаем над ее исправлением :).");
                        }
                        foreach($result as $row) {
                            $hallExistence = $row["Hall existence"];
                            $ticketsNumber = $row["Places number"];
                            if((int)$hallExistence == 0) {
                                $style = "font-weight: bold; margin-left: 5px; padding: 5px 10px; border-radius: 10px;";
                                $ticketPrice = $row["Ticket price"];
                                $ticketName = "Б-".$performanceID.'-'.$ticketsNumber;
                                $login = $_SESSION["login"];
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
                                echo 
                                "
                                    <div>
                                        <p style=''>Стоимость билета <span style='".$style."'>".$row["Ticket price"]." ₽</span></p>
                                        <p style='margin-top: 15px;'>Вы уверены, что хотите приобрести билет?</p>
                                        <div style='margin-top: 15px; display: flex; justify-content: right;'>
                                            <div data-performanceID='".$performanceID."' data-ticketName='".$ticketName."' data-hallExistence='".$hallExistence."' data-ticketsNumber='".$ticketsNumber."' data-login='".$login."' style='padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;' id='confirm-ticket-buy'>Да</div>
                                            <div style='margin-left: 20px; padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;' id='decline-ticket-buy'>Нет</div>
                                        </div>
                                    </div>
                                ";
                            }
                            else {
                                $login = $_SESSION["login"];
                                echo 
                                "
                                    <div>
                                        <p style=''>Стоимость билета <span style='".$style."'>".$row["Ticket price"]." ₽</span></p>
                                        <p style='margin-top: 15px;'>Вы уверены, что хотите приобрести билет?</p>
                                        <div style='margin-top: 15px; display: flex; justify-content: right;'>
                                            <div data-login='".$login."' style='padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;' id='confirm-ticket-buy'>Да</div>
                                            <div style='margin-left: 20px; padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;' id='decline-ticket-buy'>Нет</div>
                                        </div>
                                    </div>
                                ";
                            }
                        };  
                    ?>
                </div>
            </div>
        </dialog>

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

    // -------- basic dialog events --------

    $(".hide-dialog").click(function() {
        let dialogID = $(this).parent().parent().parent().attr("id");
        document.getElementById(dialogID).close();
    });

    // -------- session --------

    let sessionLogin = '<?php echo json_encode($_SESSION["login"])?>';
    if(sessionLogin != "null") {
        sessionLogin = sessionLogin.substring(1, sessionLogin.length - 1);
        $(".signin-button").css({"display":"none"});
        $(".user-login").text(sessionLogin);
        let roleName = '<?php echo json_encode($_SESSION["roleName"])?>';
        roleName = roleName.substring(1, roleName.length - 1);
        if(roleName == "Администратор") {
            $(".user-login").css({
                "padding":"3px 10px",
                "background-color":"crimson",
                "border-radius":"10px",
                "color":"white"
            });
            $("<a href='administration.php'>Управление</a>").insertAfter("#personal-area");
            $(".user-menu").css({"margin-top":"211px"});
        }
        if(roleName == "Модератор") {
            $(".user-login").css({
                "padding":"3px 10px",
                "background-color":"#cedcfb",
                "border-radius":"10px",
                "color":"black"
            });
            $("<a href='moderation.php'>Модерация</a>").insertAfter("#personal-area");
            $(".user-menu").css({"margin-top":"211px"});
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

    // -------- ticket-buy button --------

    $(".ticket-buy-button").click(function() {
        let hallExistence = document.querySelector("#places-config-menu-container");
        let login = $(".performance-thumbnail").attr("data-login");
        if(login == undefined)
            login = "";
        if(hallExistence == null) {
            if(login != "") {
                document.getElementById("ticket-buy-dialog").showModal();
            }
            else {
                document.getElementById("ticket-buy-dialog").showModal();
                $(".dialog-content").html(
                    "<p style='text-align: center;'>Для покупки билетов на представления вам необходимо войти в аккаунт.</p><a href='signin.php' style='border-radius: 10px; margin-top: 10px; padding: 5px 10px; background-color: black; color: white; cursor: pointer;'>Войти</a>"
                );
            }
        }
        else {
            if(login != "") {
                document.getElementById("ticket-buy-dialog").showModal();
                let placePrice = $(".place-selected").attr("data-placePrice");
                let performancePlaceID = $(".place-selected").attr("data-performancePlaceID");
                let placeName = $(".place-selected").attr("data-placeName");
                let performanceID = $(".place-selected").attr("data-performanceID");
                let placePriceStyle = "padding: 5px 10px; font-weight: bold; margin-left: 10px; border-radius: 10px;";
                if(placePrice <= 249) {
                    placePriceStyle += placePriceStyle + "background-color: gray; color: white;";
                }
                else if(placePrice <= 450) {
                    placePriceStyle = placePriceStyle + "background-color: #8aff73;";
                }
                else if(placePrice <= 650) {
                    placePriceStyle = placePriceStyle + " background-color: #80b1ff;";
                }
                else if(placePrice <= 1000) {
                    placePriceStyle = placePriceStyle + "background-color: #2e6dff; color: white;";
                }
                else if(placePrice <= 1300) {
                    placePriceStyle = placePriceStyle + "background-color: #ffe873;";
                }
                else if(placePrice <= 1700) {
                    placePriceStyle = placePriceStyle + "background-color: #ff9c38;";
                }
                else if(placePrice <= 2000) {
                    placePriceStyle = placePriceStyle + "background-color: #ff6363; color: white;";
                }
                else if(placePrice <= 2500 || placePrice > 2500) {
                    placePriceStyle = placePriceStyle + "background-color: crimson; color: white;";
                }
                let htmlToLoad = 
                `   
                    <div>
                        <p style=''>Стоимость билета <span style='` + placePriceStyle + `'>` + placePrice +` ₽</span></p>
                        <p style='margin-top: 15px;'>Вы уверены, что хотите приобрести билет?</p>
                        <div style='margin-top: 15px; display: flex; justify-content: right;'>
                            <div data-login='` + login +  `' style='padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;' id='confirm-ticket-buy'>Да</div>
                            <div style='margin-left: 20px; padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;' id='decline-ticket-buy'>Нет</div>
                        </div>
                    </div>
                `;
                $(".dialog-content").html(htmlToLoad);
            }
            else {
                document.getElementById("ticket-buy-dialog").showModal();
                $(".dialog-content").html(
                    "<p style='text-align: center;'>Для покупки билетов на представления вам необходимо войти в аккаунт.</p><a href='signin.php' style='border-radius: 10px; margin-top: 10px; padding: 5px 10px; background-color: black; color: white; cursor: pointer;'>Войти</a>"
                );
            }
        }
    });

    $(document).on("click", "#confirm-ticket-buy", function() {
        let login = $(".performance-thumbnail").attr("data-login");
        let hallExistenceCheck = document.querySelector("#places-config-menu-container");
        var MyDate = new Date();
        MyDate.setDate(MyDate.getDate());
        let today = MyDate.getFullYear() + "-" + ('0' + (MyDate.getMonth() + 1)).slice(-2) + '-' + ('0' + MyDate.getDate()).slice(-2) + " " + ('0' + MyDate.getHours()).slice(-2) + ':' + ('0' + MyDate.getMinutes()).slice(-2) + ':' + ('0' + MyDate.getSeconds()).slice(-2);
        if(!hallExistenceCheck) {
            let performanceID = $(this).attr("data-performanceID");
            let ticketName = $(this).attr("data-ticketName") + '-' + Date.now().toString();
            let hallExistence = parseInt($(this).attr("data-hallExistence"));
            let ticketsNumber = parseInt($(this).attr("data-ticketsNumber"));
            ticketsNumber = ticketsNumber - 1;
            let firstQuery = "INSERT INTO purchases (`Login`, `Ticket name`, `Performance ID`, `Date`) VALUES ('" + login + "', '" + ticketName + "', '" + performanceID + "', + '" + today + "')";
            let secondQuery = "UPDATE performances SET `Places number` = '" + ticketsNumber + "' WHERE `Performance ID` = '" + performanceID + "'";
            let checkType = "without hall";
            let checkQuery = "SELECT * FROM performances WHERE `Performance ID` = '" + performanceID + "'";
            $.ajax({
                type: "POST",
                url: "core/ticket-buy-query.php",
                data: {checkType: checkType, checkQuery: checkQuery, firstQuery: firstQuery, secondQuery: secondQuery, thirdQuery: ""},
                context: document.body,
                success: function(result) {
                    $(".dialog-content").html(result);
                }
            });
        }
        else {
            let placePrice = $(".place-selected").attr("data-placePrice");
            let performancePlaceID = $(".place-selected").attr("data-performancePlaceID");
            let placeName = $(".place-selected").attr("data-placeName");
            let performanceID = $(".place-selected").attr("data-performanceID");
            let ticketsNumber = parseInt($(".place-selected").attr("data-ticketsNumber"));
            let ticketName = "Б-" + performanceID + '-' + ticketsNumber + '-' + Date.now().toString(); 
            ticketsNumber = ticketsNumber - 1;
            let firstQuery = "INSERT INTO purchases (`Login`, `Ticket name`, `Performance-place ID`, `Date`) VALUES ('" + login + "', '" + ticketName + "', '" + performancePlaceID + "', '" + today + "')";
            let secondQuery = "UPDATE performances SET `Places number` = '" + ticketsNumber + "' WHERE `Performance ID` = '" + performanceID + "'";
            let thirdQuery = "UPDATE `performance-places` SET `Placeholder` = '" + login + "' WHERE `Performance-place ID` = '" + performancePlaceID + "'";
            let checkType = "with hall";
            let checkQuery = "SELECT * FROM `performance-places` WHERE `Performance-place ID` = '" + performancePlaceID + "'";
            $.ajax({
                type: "POST",
                url: "core/ticket-buy-query.php",
                data: {checkType: checkType, checkQuery: checkQuery, firstQuery: firstQuery, secondQuery: secondQuery, thirdQuery: thirdQuery},
                context: document.body,
                success: function(result) {
                    $(".dialog-content").html(result);
                }
            });
        }
    });

    $(document).on("click", "#decline-ticket-buy", function() {
        document.getElementById("ticket-buy-dialog").close();
    });

    $(document).on("click", "#page-refresh-button", function() {
        window.location.reload();
    });

    // -------- places events --------

    $(".places-config-menu-wrapper").on("click", ".places-row .place", function(event) {
        let placeholder = $(this).attr("data-placeholder");
        if(placeholder == "") {       
            if(!$(this).hasClass("place-selected")) {
                $(".place").each(function() {
                    $(this).removeClass("place-selected");
                });   
                $(this).addClass("place-selected");
                $(".selected-place-info").css({"display":"block"});
                let placePrice = $(this).attr("data-placePrice");
                let performancePlaceID = $(this).attr("data-performancePlaceID");
                let placeName = $(this).attr("data-placeName");
                let placePriceStyle = "padding: 5px 10px; font-weight: bold; margin-left: 10px; border-radius: 10px;";
                if(placePrice <= 249) {
                    placePriceStyle += placePriceStyle + "background-color: gray; color: white;";
                }
                else if(placePrice <= 450) {
                    placePriceStyle = placePriceStyle + "background-color: #8aff73;";
                }
                else if(placePrice <= 650) {
                    placePriceStyle = placePriceStyle + " background-color: #80b1ff;";
                }
                else if(placePrice <= 1000) {
                    placePriceStyle = placePriceStyle + "background-color: #2e6dff; color: white;";
                }
                else if(placePrice <= 1300) {
                    placePriceStyle = placePriceStyle + "background-color: #ffe873;";
                }
                else if(placePrice <= 1700) {
                    placePriceStyle = placePriceStyle + "background-color: #ff9c38;";
                }
                else if(placePrice <= 2000) {
                    placePriceStyle = placePriceStyle + "background-color: #ff6363; color: white;";
                }
                else if(placePrice <= 2500 || placePrice > 2500) {
                    placePriceStyle = placePriceStyle + "background-color: crimson; color: white;";
                }
                let htmlToLoad = 
                `
                    <div style='margin-bottom: 10px; display: flex; align-self: flex-start; align-items: center;'>
                        <p style='margin-left: auto; '>Место</p>
                        <p style='margin-left: auto; margin-left: 10px; background-color: black; color: white; font-weight: bold; padding: 5px 10px; border-radius: 10px;'>` + placeName + `</p>
                    </div>
                    <div style='display: flex; align-self: flex-start; align-items: center;'>
                        <p style='margin-left: auto;'>Цена</p>
                        <p style='margin-left: auto;` + placePriceStyle + `'>` + placePrice + ` ₽</p>
                    </div>
                `;
                $(".selected-place-info div").html(htmlToLoad);
                $(".ticket-buy-button").css({"display":"flex"});
            }
            else {
                $(this).removeClass("place-selected");
                $(".selected-place-info").css({"display":"none"});
                $(".ticket-buy-button").css({"display":"none"});
                $(".selected-place-info div").html("");
            }
        }
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