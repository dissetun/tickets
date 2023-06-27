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
                        <div style="text-align: left; margin-right: auto; margin-left: auto; align-self: start;">
                            <a style="text-align: left; color: white;" id="personal-area" href="personal-area.php" class="user-menu-link-active">Личный кабинет</a>
                            <a style="text-align: left;" id="purchase-history" id="purchase-history-link" href="purchases-history.php">Исторя покупок</a>
                            <p id="logout">Выйти</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- <img style='background-image: url(".$_SESSION["imagePath"].");' class='user-profile-image'> -->

        <main style="margin-top: 150px; margin-bottom: 90px;">
            <?php 
                echo 
                "
                    <div class='user-profile-container'>
                        <p class='user-profile-title user-profile-data-title'>Профиль пользователя</p>
                        <div class='data-container'>
                            <div class='image-login-container'>
                                <img src='".$_SESSION["imagePath"]."' class='user-profile-image'>
                                <form id='file-form' enctype='multipart/form-data'>
                                    <input value='".$_SESSION["imagePath"]."' id='file-input' name='user-profile-image' type='file' allow='image/png, image/gif, image/jpeg' style='display: none;'></input>
                                </form>
                                <p style='margin: 10px 0px;' class='user-profile-login'>".$_SESSION["login"]."</p>
                            </div>
                            <form class='data-form'>
                                <label for='input-1'>Имя</label>
                                <input value='".$_SESSION["name"]."' id='input-1' type='text' name='name'>
                                <label for='input-2'>Фамилия</label>
                                <input value='".$_SESSION["surname"]."' id='input-2' type='text' name='surname'>
                                <button id='data-form-button' class='user-profile-form-button'>Сохранить</button>
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
                            <button id='password-form-button' class='user-profile-form-button'>Сменить пароль</button>
                        </form>
                    </div>
                    <div class='user-profile-container'>
                        <p class='user-profile-title'>Почта</p>
                        <form class='email-form'>
                            <input value='".$_SESSION["email"]."' id='input-6' type='email' name='email'>
                            <button id='email-form-button' class='user-profile-form-button'>Сменить почту</button>
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
            $(".user-menu").css({"margin-top":"194px"});
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

    // -------- choose file --------

    $(".user-profile-image").click(function() {
        $("input[name='user-profile-image']").click();
        $("input[name='user-profile-image']").change(function() {
            let input = document.querySelector("#file-input");
            if(input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $(".user-profile-image").attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    // -------- personal-area buttons events --------

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $(".user-profile-form-button").click(function(event) {
        event.preventDefault();
        let buttonType = this.id;
        if(buttonType == "data-form-button") {
            let send = true;
            if($("#input-1").val().length == 0 || $("#input-1").val().length > 50) {
                $("#input-1").css({"border-color":"red"});
                send = false;
            }
            if($("#input-2").val().length == 0 || $("#input-2").val().length > 50) {
                $("#input-2").css({"border-color":"red"});
                send = false;
            }
            if(send) {
                let form = document.querySelector("#file-form");
                $.ajax({
                    type: "POST",
                    url: "core/user-add-image-request.php",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    context: document.body,
                    success: function(result) {
                        let imagePath = result;
                        // console.log(imagePath);
                        // if(imagePath == "Изображение не выбрано") {
                        //     imagePath = "img/default-image.jpg";
                        // }
                        $.ajax({
                            type: "POST",
                            url: "core/user-profile-change.php",
                            data: {queryType: "profile", newName: $("#input-1").val(), newSurname: $("#input-2").val(), newImage: imagePath},
                            context: document.body,
                            success: function(result) {
                                if(result == "Успешно") {
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
            }
        }
        if(buttonType == "password-form-button") {
            let send = true;
            if($("#input-3").val().length < 8 || $("#input-3").val().length > 50) {
                $("#input-3").css({"border-color":"red"});
                send = false;
            }
            else {
                $("#input-3").css({"border-color":"black"});
            }
            if($("#input-4").val().length < 8 || $("#input-4").val().length > 50) {
                $("#input-4").css({"border-color":"red"});
                send = false;
            }
            else {
                $("#input-4").css({"border-color":"black"});
            }
            if($("#input-5").val().length == 0) {
                $("#input-5").css({"border-color":"red"});
                send = false;
            }
            else {
                if(document.querySelector("#old-password-error-message") == null)
                    $("#input-5").css({"border-color":"black"});
            }
            if($("#input-3").val() != $("#input-4").val()) {
                if(document.querySelector("#new-password-error-message") == null) {
                    $("<p id='new-password-error-message' style='color: crimson; margin-bottom: 20px;'>Пароли не совпадают</p>").insertAfter("#input-4");
                }
                $("#input-4").css({"border-color":"red"});
                send = false;
            }
            else {
                if(document.querySelector("#new-password-error-message") != null) {
                    $("#new-password-error-message").remove();
                }
                if($("#input-4").val().length >= 8 && $("#input-4").val().length <= 50)
                    $("#input-4").css({"border-color":"black"});
            }
            if(send) {
                $.ajax({
                    type: "POST",
                    url: "core/user-profile-change.php",
                    data: {queryType: "password", newPassword: $("#input-3").val(), oldPassword: $("#input-5").val()},
                    context: document.body,
                    success: function(result) {
                        if(result == "Пароли не совпадают") {
                            if(document.querySelector("#old-password-error-message") == null) {
                                $("<p id='old-password-error-message' style='color: crimson; margin-bottom: 20px;'>Неправильный пароль</p>").insertAfter("#input-5");
                            }
                            $("#input-5").css({"border-color":"red"});
                        }
                        if(result == "Успешно") {
                            window.location.reload();
                        }
                    }
                });
            }
        }
        if(buttonType == "email-form-button") {
            let send = true;
            if($("#input-6").val().length == 0) {
                $("#input-6").css({"border-color":"red"});
            }
            else {
                if(document.querySelector("#email-error-message") == null) {
                    $("#input-6").css({"border-color":"black"});
                }
            }
            if(!isEmail($("#input-6").val())) {
                if(document.querySelector("#email-error-message") == null)
                    $("<p id='email-error-message' style='color: crimson; margin-bottom: 20px;'>Email указан некорректно</p>").insertAfter("#input-6");
                $("#input-6").css({"border-color":"red"});
                send = false;
            }
            if(send) {
                $.ajax({
                    type: "POST",
                    url: "core/user-profile-change.php",
                    data: {queryType: "email", newEmail: $("#input-6").val()},
                    context: document.body,
                    success: function(result) {
                        console.log(result);
                        if(result == "Успешно") {
                            window.location.reload();
                        }
                    }
                });
            }
        }
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

    $(".user-profile-form-button").click(function(event) {
        event.preventDefault();
    });

</script>