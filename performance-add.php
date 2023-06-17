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
                            <a style="text-align: left;" id="purchase-history" id="purchase-history-link" href="purchases-history.php">Исторя покупок</a>
                            <p style="" id="logout">Выйти</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main style="margin-top: 150px; margin-bottom: 90px; overflow-x: none;">
            <section class="form-container">
                <div class="image-field">
                    <div style="background-color: white; color: black; font-weight: bold; padding: 0px;" class="image-field-button">
                        <form id="file-form">
                            <input name="performance-img" type="file" style="display: none;"></input>
                            <p style="padding: 5px 10px;" class="select-image-button">Выбрать изображение</p>
                        </form>
                    </div>
                </div>
                <form>
                    <div class="form-element">
                        <label for="input-1">Название представления</label>
                        <input id="input-1" type="text" name="name">
                    </div>
                    <div class="form-elements-container">
                        <div class="form-elements-subcontainer">
                            <div class="form-element">
                                <p class="form-element-title">Площадка</p>
                                <div id="platform-scroller" style="align-self: start;" class="custom-scroller">
                                    <div class="custom-scroller-selected-option-container">
                                        <div class="custom-scroller-selected-option">
                                            <p>Выберите площадку</p>
                                        </div>
                                        <div class="custom-scroller-list-caret">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div style="z-index: 1000;" class="custom-scroller-list">
                                        <?php 
                                            include "core/connect.php";
                                            $link = mysqli_connect($host, $user, $password, $db_name); 
                                            $query = "SELECT * FROM platforms";
                                            $result = mysqli_query($link, $query);
                                            $platformOptionId = 1;
                                            foreach($result as $row) {
                                                echo 
                                                "
                                                    <div id='platform-option-".$platformOptionId."' class='custom-scroller-option'>
                                                        <p>".$row['Platform']."</p>
                                                    </div>
                                                ";
                                                $platformOptionId++;
                                            }
                                            mysqli_close($link);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none;" id="hall-scroller" class="form-element">
                                <p class="form-element-title">Зал</p>
                                <div id="hall-custom-scroller" style="align-self: start;" class="custom-scroller">
                                    <div class="custom-scroller-selected-option-container">
                                        <div class="custom-scroller-selected-option">
                                            <p>Выберите зал</p>
                                        </div>
                                        <div class="custom-scroller-list-caret">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div style="z-index: 999;" class="custom-scroller-list">
                                        <?php 
                                            include "core/connect.php";
                                            $link = mysqli_connect($host, $user, $password, $db_name); 
                                            $query = "SELECT * FROM Halls";
                                            $result = mysqli_query($link, $query);
                                            $platformOptionId = 1;
                                            foreach($result as $row) {
                                                echo 
                                                "
                                                    <div id='hallID-option-".$platformOptionId."' class='custom-scroller-option'>
                                                        <p>".$row['Hall name']."</p>
                                                    </div>
                                                ";
                                                $platformOptionId++;
                                            }
                                            mysqli_close($link);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-element">
                                <p class="form-element-title">Жанр</p>
                                <div id="genre-scroller" style="align-self: start;" class="custom-scroller">
                                    <div class="custom-scroller-selected-option-container">
                                        <div class="custom-scroller-selected-option">
                                            <p>Выберите жанр</p>
                                        </div>
                                        <div class="custom-scroller-list-caret">
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div style="z-index: 998;" class="custom-scroller-list">
                                        <?php 
                                            include "core/connect.php";
                                            $link = mysqli_connect($host, $user, $password, $db_name); 
                                            $query = "SELECT * FROM genres";
                                            $result = mysqli_query($link, $query);
                                            $platformOptionId = 1;
                                            foreach($result as $row) {
                                                echo 
                                                "
                                                    <div id='genre-option-".$platformOptionId."' class='custom-scroller-option'>
                                                        <p>".$row['Genre']."</p>
                                                    </div>
                                                ";
                                                $platformOptionId++;
                                            }
                                            mysqli_close($link);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex;" class="form-elements-subcontainer">
                            <div class="form-element">
                                <label style="margin-bottom: 0px;" for="input-2">Дата начала</label>
                                <input style="width: 100%; margin-top: 10px; margin-bottom: 22px;" id="input-2" type="datetime-local" name="name">
                            </div>
                            <div class="form-element">
                                <label style="margin-bottom: 0px;" for="input-3">Дата окончания</label>
                                <input style="width: 100%; margin-top: 10px;" id="input-3" type="datetime-local" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="form-element">
                        <p style="margin-bottom: 5px;">Описание</p>
                        <textarea></textarea>
                    </div>
                    <div style="margin-top: 30px; margin-bottom: 20px;" class="form-element">
                        <div class="form-button">Отправить заявку</div>
                    </div>
                </form>
            </section>
        </main>
 
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

    // -------- choose file --------

    $(".select-image-button").click(function() {
        $("input[name='performance-img']").click();
        $("input[name='performance-img']").change(function() {
            let form = document.querySelector("#file-form");
            $.ajax({
                type: "POST",
                url: "core/tmp-img.php",
                data: new FormData(form),
                processData: false,
                contentType: false,
                context: document.body,
                success: function(result) {
                    let url = result.replace("%20", ' ');
                    $('.image-field').css({
                        "background-image":"url(" + result + ")"
                    });
                }
            });
        });
    });

    // -------- custom scrollbar --------

    $(".custom-scroller").on('click', '.custom-scroller-selected-option-container', function() {
        if(!$(this).parent().find(".custom-scroller-list").hasClass("custom-scroller-list-active")) {
            $(this).parent().find(".fa-caret-down").css({"transform":"rotate(180deg)"});
            $(this).parent().find(".custom-scroller-list").addClass("custom-scroller-list-active");
        }
        else {
            $(this).parent().find(".fa-caret-down").css({"transform":"rotate(0deg)"});
            $(this).parent().find(".custom-scroller-list").removeClass("custom-scroller-list-active");
        }
    });

    $(".custom-scroller").on('click', '.custom-scroller-list .custom-scroller-option', function() {
        let fieldNameUntrimmed = $("#" + this.id).text();
        let fieldName = $.trim(fieldNameUntrimmed);
        if($(this).parent().parent().attr("id") == "platform-scroller") {
            if(fieldName.length > 30) {
                $(".form-elements-container").css({"flex-direction":"column"});
            }
            else if($(window).width() > 725) {
                $(".form-elements-container").css({"flex-direction":"row"});
            }
            $.ajax({
                type: "POST",
                url: "core/halls-scroller-change.php",
                data: {platform: fieldName},
                context: document.body,
                success: function(result) {
                    $("#hall-custom-scroller").html(result);
                }
            });
            $("#hall-scroller").css({"display":"flex"});
        }
        $(this).parent().removeClass("custom-scroller-list-active");
        $(this).parent().parent().find(".custom-scroller-selected-option-container").css({"background-color":"black"});
        $(this).parent(".custom-scroller-list").parent().find(".custom-scroller-selected-option p").text(fieldName);
        $(this).find(".fa-caret-down").css({"transform":"rotate(180deg)"});
    });

    if($(window).width() <= 725) {
        $(".form-elements-container").css({"flex-direction":"column"});
    }

    $(window).on("resize", function() {
        let fieldNameUntrimmed = $("#platform-scroller .custom-scroller-selected-option p").text();
        let fieldName = $.trim(fieldNameUntrimmed);
        if($(this).width() <= 725) {
            $(".form-elements-container").css({"flex-direction":"column"});
        }
        else {
            if(fieldName.length <= 30)
                $(".form-elements-container").css({"flex-direction":"row"});
        }
    });

    // -------- send request --------

    $(".form-button").click(function() {
        let next = true;
        if($("#input-1").val().length == 0) {
            $('#input-1').css({"border":"1px solid red"});
            next = false;
        }
        if($("#input-1").val().length > 50) {
            if(document.querySelector('#input1-error') == null) {
                $("<p style='color: red;' id='input1-error'>Длина названия превышает 50 символов</p>").insertAfter('#input-1');
                $('#input-1').css({"border":"1px solid red"});
            }
            next = false;
        }
        else if($("#input-1").val().length > 0) {
            if(document.querySelector('#input1-error') != null) {
                $("#input1-error").remove();
            }
            $('#input-1').css({"border":"1px solid black"});
        }
        $(".custom-scroller-selected-option").each(function() {
            if($(this).text().trim() == "Выберите площадку" || $(this).text().trim() == "Выберите зал" || $(this).text().trim() == "Выберите жанр") {
                $(this).parent().css({"background-color":"red"});
                next = false;
            }
            else {
                $(this).parent().css({"background-color":"black"});
            }
        });
        if($("#input-2").val().length == 0) {
            $('#input-2').css({"border":"1px solid red"});
            next = false;
        }
        if($("#input-3").val().length == 0) {
            $('#input-3').css({"border":"1px solid red"});
            next = false;
        }
        if($("textarea").val().length == 0) {
            $($("textarea")).css({"border":"1px solid red"});
            next = false;
        }
        if($("textarea").val().length > 350) {
            if(document.querySelector('#textarea-error') == null) {
                $("<p style='color: red; margin-top: 15px;' id='textarea-error'>Длина описания превышает 350 символов</p>").insertAfter('textarea');
                $('textarea').css({"border":"1px solid red"});
            }
            next = false;
        }
        else if($("textarea").val().length > 0) {
            if(document.querySelector('#input1-error') != null) {
                $("#textarea-error").remove();
            }
            $("textarea").css({"border":"1px solid black"});
        }
        console.log(next);
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
        window.location.reload();
    });

</script>

</html>