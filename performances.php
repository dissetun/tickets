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

        <section class="catalogue-section">
            <div class="catalogue-wrapper">
                <div class="catalogue-items">
                    <div class="filters">
                        <div class="filter">
                            <p>Жанры</p>
                        </div>
                        <div class="filter">
                            <p>Дата</p>
                        </div>
                    </div>
                    <div class="catalogue">
                        <?php 
                            include 'core/connect.php';
                            $link = mysqli_connect($host, $user, $password, $db_name); 
                            $query = "SELECT * FROM performances LIMIT 6";
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
                    </div>
                </div>
                <div class="show-more-container">
                    <div class="show-more-animation">
                        <div class="load-square"></div>
                    </div>
                    <button class="show-more">Показать еще</button>
                </div>
            </div>
        </section>

        <footer>
            <div class="footer-info-container">
                <div class="footer-info-subcontainer">
                    <div class="footer-info-item">
                        <h1>Организаторам мероприятий</h1>
                        <a href="performance-add.php">Отправить заявку на проведение мероприятия</a>
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

    const performancesCalculate = () => {
        $.ajax({
            type: "POST",
            url: "core/performances-calculate.php",
            data: {pages: $(".performance").length},
            context: document.body,
            success: function(result) {
                console.log(result);
                if(result == "Hide")
                    $(".show-more").css({"display":"none"});
            }
        });
    }

    performancesCalculate();

    $(".show-more").click(function() {
        $(this).css({
            'display':'none'
        });
        $(".show-more-animation").css({
            'display':'block'
        });
        const loadPages = () => {
            $(".show-more-animation").css({
                'display':'none'
            });
            $(".show-more").css({
                'display':'block'
            });
            $.ajax({
                type: "POST",
                url: "core/performances-load-request.php",
                data: {left: $(".performance").length},
                context: document.body,
                success: function(result) {
                    $(".catalogue").append(result);
                    performancesCalculate();
                }
            });
        }  
        performancesCalculate();
        setTimeout(() => loadPages(), 500);
    });

    $(".user-name").click(function() {
        $(".user-nav").css({
            'display':'flex'
        });
    });

    const filters = document.querySelectorAll(".filter");

    for(let filter of filters) {
        filter.addEventListener("click", () => {
            if(!filter.classList.contains("filter-active")) {
                for(let otherFilter of filters) {
                    if(otherFilter.classList.contains("filter-active"))
                        otherFilter.classList.remove("filter-active");
                }
                filter.classList.add("filter-active");
            }
            else {
                filter.classList.remove("filter-active");
            }
        });
    }

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
            $(".user-menu").css({"margin-top":"180px"});
        }
        if(roleName == "Модератор") {
            $(".user-login").css({
                "padding":"3px 10px",
                "background-color":"#cedcfb",
                "border-radius":"10px",
                "color":"black"
            });
            $("<a href='#'>Модерация</a>").insertAfter("#personal-area");
            $(".user-menu").css({"margin-top":"180px"});
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