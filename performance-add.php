<?php 

    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: signin.php");
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
                        <form id="file-form" enctype="multipart/form-data">
                            <input id='file-input' name="performance-img" type="file" allow="image/png, image/gif, image/jpeg" style="display: none;"></input>
                            <p style="border-radius: 10px; box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.1); padding: 5px 10px;" class="select-image-button">Выбрать изображение</p>
                        </form>
                    </div>
                    <img src="img/default-image.jpg" id="image-field-img">
                    <!-- <img src="img/50fe4dc0897b938f8fc2ab8882842c3a.png" id="image-field-img"> -->
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
                            <div id="custom-option" style="display: none;" class="form-element">
                                <div class="form-element-title">Выбрать зал?</div>
                                <div class="custom-option-container">
                                    <div id="custom-option-element-yes" class="custom-option-element">Да</div>
                                    <div id="custom-option-element-no" class="custom-option-element custom-option-element-active">Нет</div>
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
                                <input style="width: 100%; margin-top: 10px; margin-bottom: 22px;" id="input-2" type="datetime-local" name="begin-date">
                            </div>
                            <div class="form-element">
                                <label style="margin-bottom: 0px;" for="input-3">Дата окончания</label>
                                <input style="width: 100%; margin-top: 10px;" id="input-3" type="datetime-local" name="end-date">
                            </div>
                        </div>
                    </div>
                    <div class="form-element">
                        <p style="margin-bottom: 5px;">Описание</p>
                        <textarea></textarea>
                    </div>
                    <div id="price-input" class="form-element">
                        <label style="margin-bottom: 5px; margin-top: 15px;" for="input-4">Цена билета</label>
                        <div style='display: flex; align-items: center; align-content: center;'>
                            <input value="0" min="0" style="max-width: 300px; width: 100%; margin-bottom: 0px;" id="input-4" type="number" name="place-price">
                            <p style="margin-left: 5px;">руб.</p>
                        </div>
                    </div>
                    <div id="places-config-menu-container" style="margin-top: 30px; display: none;" class="form-element">
                        <p class="form-element-title">Настройка мест</p>
                        <div class="places-config-menu">
                            <div class="places-config-menu-wrapper">
                            </div>
                        </div>
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

    // -------- choose file --------

    $(".select-image-button").click(function() {
        $("input[name='performance-img']").click();
        $("input[name='performance-img']").change(function() {
            let input = document.querySelector("#file-input");
            if(input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $("#image-field-img").attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
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
                    $("#places-config-menu-container").css({"display":"none"});
                    if(result != "Залов нет") {
                        $("#custom-option").css({"display":"flex"});
                        $("#hall-custom-scroller").html(result);
                        if($("#custom-option-element-yes").hasClass("custom-option-element-active"))
                            $("#hall-scroller").css({"display":"flex"});
                        else {
                            $("#hall-scroller").css({"display":"none"});
                        }
                    }
                    else {
                        $("#hall-scroller").css({"display":"none"});
                        $("#custom-option").css({"display":"none"});
                    }
                }
            });
        }
        else if($(this).parent().parent().attr("id") == "hall-custom-scroller") {
            let hallID = $(this).find("p").attr("id");
            $(this).parent().parent().find(".custom-scroller-selected-option").attr("id", "selected-" + hallID);
            $("#places-config-menu-container").css({"display":"flex"});
            hallID = hallID.replace("hallID=", "");
            $.ajax({
                type: "POST",
                url: "core/places-menu-output.php",
                data: {hallID: hallID},
                context: document.body,
                success: function(result) {
                    $(".places-config-menu-wrapper").html(result);
                }
            });
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

    // -------- custom option --------

    $(".custom-option-element").click(function() {
        if($(this).attr("id") == "custom-option-element-yes") {
            $("#hall-scroller").css({"display":"flex"});
            $("#custom-option-element-yes").addClass("custom-option-element-active");
            $("#custom-option-element-no").removeClass("custom-option-element-active");
            $("#price-input").css({"display":"none"});
            if($("#hall-scroller").find(".custom-scroller-selected-option").text().trim() != "Выберите зал") {
                // console.log($("#hall-scroller").find(".custom-scroller-selected-option").text().trim());
                $("#places-config-menu-container").css({"display":"flex"});
            }
        } 
        else {
            $("#hall-scroller").css({"display":"none"});
            $("#custom-option-element-no").addClass("custom-option-element-active");
            $("#custom-option-element-yes").removeClass("custom-option-element-active");
            $("#places-config-menu-container").css({"display":"none"});
            $("#price-input").css({"display":"flex"});
            // console.log($("#hall-scroller").find(".custom-scroller-selected-option").text().trim());
        }
    });

    // -------- place-config --------

    $(".places-config-menu-wrapper").on("click", ".places-row .place", function(event) {
        // console.log("something");
        if(event.target != event.currentTarget) {
            return;
        }
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

    $(".places-config-menu-wrapper").on("input", ".places-row .place .place-info input", function() {
        let price = parseInt($(this).val());
        // console.log(price);
        if(price <= 249 || price == NaN) {
            $(this).parent().parent().parent().css({"background-color":"gray"});
        }
        else if(price <= 450) {
            $(this).parent().parent().parent().css({"background-color":"#8aff73"});
        }
        else if(price <= 650) {
            $(this).parent().parent().parent().css({"background-color":"#80b1ff"});
        }
        else if(price <= 1000) {
            $(this).parent().parent().parent().css({"background-color":"#2e6dff"});
        }
        else if(price <= 1300) {
            $(this).parent().parent().parent().css({"background-color":"#ffe873"});
        }
        else if(price <= 1700) {
            $(this).parent().parent().parent().css({"background-color":"#ff9c38"});
        }
        else if(price <= 2000) {
            $(this).parent().parent().parent().css({"background-color":"#ff6363"});
        }
        else if(price <= 2500 || price > 2500) {
            $(this).parent().parent().parent().css({"background-color":"crimson"});
        }
    });  

    // -------- send request --------

    $(".form-button").click(function() {
        $("#add-confirm").remove();
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
            if($(this).text().trim() == "Выберите площадку" || $(this).text().trim() == "Выберите жанр") {
                $(this).parent().css({"background-color":"red"});
                next = false;
            }
            else {
                $(this).parent().css({"background-color":"black"});
            }
        });
        if($("#custom-option-element-no").hasClass("custom-option-element-active")) {
            // do nothing 
            true;
        }
        else {
            if($("#hall-scroller").find(".custom-scroller-selected-option").text().trim() == "Выберите зал") {
                $("#hall-scroller").find(".custom-scroller-selected-option-container").css({"background-color":"red"});
                next = false;
            }
            else {
                $("#hall-scroller").find(".custom-scroller-selected-option-container").css({"background-color":"black"});
            }
        }
        if($("#input-2").val().length == 0) {
            $('#input-2').css({"border":"1px solid red"});
            next = false;
        }
        else {
            $("#input-2").css({"border":"1px solid black"});
        }
        if($("#input-3").val().length == 0) {
            $('#input-3').css({"border":"1px solid red"});
            next = false;
        }
        if($("#input-3").val() <= $("#input-2").val()) {
            if(document.querySelector("#date-error") == null) {
                $("<p style='color: red;' id='date-error'>Дата окончания не может быть раньше даты начала</p>").insertAfter('#input-3');
                $("#input-3").css({"border":"1px solid red"});
            }
            next = false;
        }
        else {
            if(document.querySelector("#date-error") != null) {
                $("#date-error").remove();
            }
            if($("#input-3").val().length != 0)
                $("#input-3").css({"border":"1px solid black"});
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
        if(next) {
            let performanceName = $("#input-1").val();
            let platform = $("#platform-scroller").find(".custom-scroller-selected-option").text().trim();
            let hallExistence = 0;
            if($("#custom-option-element-yes").hasClass("custom-option-element-active")) {
                hallExistence = 1;
            }
            // let hallExistence = ($("#custom-option-element-yes").hasClass("custom-option-element-active") ? 1 : 0);
            let genre = $("#genre-scroller").find(".custom-scroller-selected-option").text().trim();
            let hallID = "undefined";
            let description = $("textarea").val();
            let startDate = $("#input-2").val();
            let endDate = $("#input-3").val();
            var placesArray = ["undefined"];
            let ticketPrice = "undefined";
            if(hallExistence) {
                hallID = $("#hall-scroller").find(".custom-scroller-selected-option").attr("id");
                hallID = hallID.replace("selected-hallID=", '');
                placesArray = [];
                $(".place").each(function() {
                    let placeName = $(this).find(".place-info-title").text().trim();
                    let placePrice = $(this).find("input[name='place-price']").val();
                    if(placePrice == null || placePrice == NaN || placePrice == "")
                        placePrice = 0;
                    placesArray.push([placeName, placePrice]);
                });
                // console.log(placesArray);
            }
            else {
                ticketPrice = $("#input-4").val();
            }
            // console.log(performanceName + "\n" + platform + "\n" + hallExistence + "\n" + genre + "\n" + hallID + "\n" + description + "\n" + beginDate + "\n" + endDate + "\n" + ticketCost + "\n" + placesArray + "\n");
            if(document.querySelector("#add-confirm") == null)
                $("<div id='add-confirm' style='margin-left: auto; margin-top: 20px;'><p>Вы уверены?</p><div style='display: flex; margin-top: 10px; justify-content: space-between;'><p id='add-confirm-yes' style='padding: 5px 10px; background-color: black; color: white; cursor: pointer; border-radius: 10px; margin-right: 10px;'>Да</p><p id='add-confirm-no' style='padding: 5px 10px; background-color: black; color: white; cursor: pointer; border-radius: 10px;'>Нет</p></div></div>").insertAfter(".form-button");
            let form = document.querySelector("#file-form");
            let imagePath = "undefined";
            $("#add-confirm-yes").click(function() {
                $.ajax({
                    type: "POST",
                    url: "core/performance-add-image-request.php",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    context: document.body,
                    success: function(result) {
                        imagePath = result;
                        if(imagePath == "Изображение не выбрано") {
                            imagePath = "img/default-image.jpg";
                        }
                        $.ajax({
                            type: "POST",
                            url: "core/performance-add-request.php",
                            data: {performanceName: performanceName, hallID: hallID, hallExistence: hallExistence, genre: genre, description: description, startDate: startDate, endDate: endDate, placesArray: JSON.stringify(placesArray), ticketPrice: ticketPrice, imagePath: imagePath},
                            context: document.body,
                            success: function(otherResult) {
                                console.log(otherResult);
                            }
                        });
                    }
                });
            });
            $("#add-confirm-no").click(function() {
                $("#add-confirm").remove();
            }); 
        }
        else {
            $("html, body").animate({
                scrollTop: $("#input-1").offset().top - 100
            }, 500);
        }
        // console.log(next ? "success" : "failure");
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


<!-- что осталось сделать:

1) добавить дефолтное изображение в папку с изображениями

2) добавить попуп виндоу (или че-нибудь похожее) при нажатии на кнопку отправить заявку, которое будет спрашивать пользователя, хочет ли он ее отправить

[опционально] 3) выделение групп мест

-->