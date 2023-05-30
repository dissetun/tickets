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
                <div class="logo-container">
                    <i style = "margin-right: 10px; font-size: 30px;" class="fa-solid fa-ticket"></i>
                    <p class="logo">Билеты</p>
                </div>
                <nav>
                    <a href="index.php" class="new">Новинки</a>
                    <a href="performances.php" class="catalog">Представления</a>
                </nav>
                <div class="user">
                    <a href="signin.php">Войти</a>
                    <div class="user-image"></div>
                </div>
            </div>
        </header>

        <main>
            <div class="performance-page-wrapper">
                <?php 
                    include 'connect.php';
                    $link = mysqli_connect($host, $user, $password, $db_name); 
                    $name = $_GET["performance"];
                    $query = "SELECT * FROM performances WHERE `name` = '$name'";
                    $result = mysqli_query($link, $query);
                    if(!$result)
                        die("error occured");
                    else 
                        foreach($result as $row)
                            echo 
                            '
                                <div class="performance-thumbnail" style = "background: url('.$row["path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                                    <div class="performance-thumbnail-elements">
                                        <div class="performance-thumbnail-name">
                                            <p>'.$row["name"].'</p>
                                        </div>
                                        <div class="ticket-buy-button">
                                            <p>Купить билет</p>
                                        </div>
                                    </div>
                                </div>
                                <p style = "font-weight: bold; font-size: 25px; margin-top: 30px; margin-bottom: 30px;">Описание представления</p>
                                <p class="performance-description">Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти предложений в абзаце, что позволяет сделать текст более привлекательным и живым для визуально-слухового восприятия.</p>
                            ';
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
        document.querySelector(".preloader").style.visibility = "hidden";
    }

    addEventListener("resize", () => {
        let titleLength = $(".performance-thumbnail-name p").width();
        let thumbnailWidth = $(".performance-thumbnail").width();
        let buttonWidth = $(".ticket-buy-button").width();
        if(titleLength + buttonWidth + 40 >= thumbnailWidth) {
            $(".performance-thumbnail-elements").css({
                "flex-direction": "column",
                "justify-content": "start",
                "align-items": "start"
            });
            $(".ticket-buy-button").css({"margin-top": "10px"});
        }
        else {
            $(".performance-thumbnail-elements").css({
                "flex-direction": "row",
                "justify-content": "space-between",
                "align-items": "center"
            });
            $(".ticket-buy-button").css({"margin-top": "0px"});
        }
    });

    window.onload = function() {
        setTimeout(() => disablePreloader(), 500);
    }

    $(document).ready(function() {
        $(".single-item").slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveWidth: true
        });
    });

</script>

</html>