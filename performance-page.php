<?php 

    session_start();

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
                        <div style="margin-right: auto; margin-left: auto; align-self: start;">
                            <a href="#">Личный кабинет</a>
                            <a href="#">Исторя покупок</a>
                            <a style = "color: crimson;" href="#">Выйти</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="performance-page-wrapper">
                <?php 
                    include 'core/connect.php';
                    $link = mysqli_connect($host, $user, $password, $db_name); 
                    $name = $_GET["performance"];
                    $query = "SELECT * FROM performances WHERE `Performance name` = '$name'";
                    $result = mysqli_query($link, $query);
                    if(!$result)
                        die("error occured");
                    else 
                        foreach($result as $row) {
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
                            $hall = $row["Hall ID"];
                            $getPlatformQuery = "SELECT Platform FROM halls WHERE `Hall ID` = '$hall'";
                            $getPlatformResult = mysqli_query($link, $getPlatformQuery);
                            $platform = "";
                            foreach($getPlatformResult as $getPlatformResultRow) {
                                $platform = $getPlatformResultRow["Platform"];
                            }
                            // поулчение адреса площадки, на которой будет проведено прсдетавление
                            $getAddressQuery = "SELECT Address from Platforms WHERE `Platform` = '$platform'";
                            $getAddressResult = mysqli_query($link, $getAddressQuery);
                            $address = "";
                            foreach($getAddressResult as $getAddressResultRow) {
                                $address = $getAddressResultRow["Address"];
                            }
                            echo 
                            '
                                <div class="performance-thumbnail" style = "background: url('.$row["Image path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                                    <div class="performance-thumbnail-elements">
                                        <div class="performance-thumbnail-name">
                                            <p>'.$row["Performance name"].'</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="performance-description-title">Описание представления</p>
                                <p class="performance-description">Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.</p>
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
                                </div>
                                <div class="ticket-buy-button">
                                    <p>Купить билет</p>
                                </div>
                            ';
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
                        <a href="#">Отправить заявку на проведение мероприятия</a>
                        <a href="#">Площадки мероприятий</a>
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

    // addEventListener("resize", () => {
    //     let titleLength = $(".performance-thumbnail-name p").width();
    //     let thumbnailWidth = $(".performance-thumbnail").width();
    //     let buttonWidth = $(".ticket-buy-button").width();
    //     if(titleLength + buttonWidth + 40 >= thumbnailWidth) {
    //         $(".performance-thumbnail-elements").css({
    //             "flex-direction": "column",
    //             "justify-content": "start",
    //             "align-items": "start"
    //         });
    //         $(".ticket-buy-button").css({"margin-top": "10px"});
    //     }
    //     else {
    //         $(".performance-thumbnail-elements").css({
    //             "flex-direction": "row",
    //             "justify-content": "space-between",
    //             "align-items": "center"
    //         });
    //         $(".ticket-buy-button").css({"margin-top": "0px"});
    //     }
    // });

    window.onload = function() {
        setTimeout(() => disablePreloader(), 500);
    }

    let sessionLogin = '<?php echo json_encode($_SESSION["login"])?>';
    if(sessionLogin != "null") {
        sessionLogin = sessionLogin.substring(1, sessionLogin.length - 1);
        $(".signin-button").css({"display":"none"});
        $(".user-login").text(sessionLogin);
        let imagePath = '<?php echo json_encode($_SESSION["imagePath"])?>';
        imagePath = "url(" + imagePath.substring(1, imagePath.length - 1) + ")";
        $(".user-image").css({
            "display":"block",
            "background-image":imagePath
        });
        $(".user-menu-button").css({
            "display":"block"
        });
    }

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

</script>

</html>