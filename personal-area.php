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
                    <i style="margin-right: 10px; font-size: 30px;" class="fa-solid fa-ticket"></i>
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
                    <div style = "margin-top: 164px;" class="user-menu">
                        <div style="margin-right: auto; margin-left: auto; align-self: start;">
                            <a id="personal-area-link" href="personal-area.php" class="user-menu-link-active">Личный кабинет</a>
                            <a style="margin-left: 10px;" id="purchase-history-link" href="purchases-history.php">Исторя покупок</a>
                            <p style="margin-left: 10px;" id="logout">Выйти</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main style="margin-top: 150px; margin-bottom: 90px;">
            <?php 
                echo 
                "
                    <div class='user-profile-container'>
                        <p class='user-profile-title user-profile-data-title'>Данные пользователя</p>
                        <div class='data-container'>
                            <div class='image-login-container'>
                                <div style='background-image: url(".$_SESSION["imagePath"].");' class='user-profile-image'></div>
                                <div class='user-profile-login'>".$_SESSION["login"]."</div>
                            </div>
                            <form class='data-form'>
                                <label for='input-1'>Имя</label>
                                <input value='".$_SESSION["name"]."' id='input-1' type='text' name='name'>
                                <label for='input-2'>Фамилия</label>
                                <input value='".$_SESSION["surname"]."' id='input-2' type='text' name='surname'>
                                <button class='data-form-button user-profile-form-button'>Изменить</button>
                            </form>
                        </div>
                    </div>
                    <div class='user-profile-container'>
                        <p class='user-profile-title'>Изменение пароля</p>
                        <form class='password-form'>
                            <label for='input-3'>Новый пароль</label>
                            <input id='input-3' type='password' name='new-password'>
                            <label for='input-4'>Повторите новый пароль</label>
                            <input id='input-4' type='password' name='new-password-confirm'>
                            <label for='input-5'>Текущий пароль</label>
                            <input id='input-5' type='password' name='opld-password-confirm'>
                            <button class='password-form-button user-profile-form-button'>Изменить</button>
                        </form>
                    </div>
                ";
            ?>
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

    let sessionLogin = '<?php echo json_encode($_SESSION["login"])?>';
    if(sessionLogin != "null") {
        sessionLogin = sessionLogin.substring(1, sessionLogin.length - 1);
        $(".signin-button").css({"display":"none"});
        $(".user-login").text(sessionLogin);
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

    $(".user-profile-form-button").click(function(event) {
        event.preventDefault();
    });

</script>