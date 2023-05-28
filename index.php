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
                    <a href="index.php" class="new nav-active">Новинки</a>
                    <a href="performances.php" class="catalog">Представления</a>
                </nav>
                <div class="user">
                    <a href="signin.php">Войти</a>
                    <div class="user-image"></div>
                </div>
            </div>
        </header>

        <main>
            <div class="slider-container">
                <div class="slider single-item">
                    <!-- <div class = "s-item">
                        <div style = "background: url('https://a-static.besthdwallpaper.com/balcony-lofi-wallpaper-2880x1800-106546_8.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="s-inner">
                            <p>Название какого-то представления</p>
                        </div>
                    </div>
                    <div class = "s-item">
                        <div style = "background: url('https://i.pinimg.com/originals/12/06/c4/1206c4735023fbaee13ad4a8d7802491.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="s-inner">
                            <p>Название какого-то представления</p>
                        </div>
                    </div>
                    <div class = "s-item">
                        <div style = "background: url('https://i.pinimg.com/originals/8c/9c/4f/8c9c4f9d9305496ae5164b271ca4be03.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="s-inner">
                            <p>Название какого-то представления</p>
                        </div>
                    </div>
                    <div class = "s-item">
                        <div style = "background: url('https://i.pinimg.com/originals/54/ab/2c/54ab2cc173d3b381a0202ef39453d20d.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="s-inner">
                            <p>Название какого-то представления</p>
                        </div>
                    </div>
                    <div class = "s-item">
                        <div style = "background: url('https://wallpaper-4k-hd.com/wp-content/uploads/2022/05/gray-zip-up-jacket-astronaut-universe-digital-art-artwork-spacesuit-wallpaper-4.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="s-inner">
                            <p>Название какого-то представления</p>
                        </div>
                    </div> -->
                    <?php 
                        include 'connect.php';
                        $link = mysqli_connect($host, $user, $password, $db_name); 
                        $query = "SELECT * FROM performances LIMIT 7";
                        $result = mysqli_query($link, $query);
                        foreach($result as $row) {
                            echo 
                            '
                                <div class = "s-item">
                                    <div style = "background: url('.$row[path].'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="s-inner">
                                        <p>'.$row[name].'</p>
                                    </div>
                                </div>
                            ';
                        }
                        mysqli_close($link);
                    ?>
                </div>
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