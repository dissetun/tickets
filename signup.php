<?php 

    session_start();
    if(isset($_SESSION["login"])) {
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

        <main style = "margin-top: 0px;">
            <div style = "max-width: 510.14px;" class="sign-container">
                <div class="sign-form-container">
                    <div class="sign-special">
                        <p>Посещайте новинки из мира театра, кино и музыки.</p>
                    </div>
                    <form class="sign-form">
                        <div class="message">
                            <p>Something</p>
                        </div>
                        <label for="input-1">Имя <span style = "color: crimson;">*</span></label>
                        <input id="input-1" type="text" name="name">
                        <label for="input-2">Фамилия <span style = "color: crimson;">*</span></label>
                        <input id="input-2" type="text" name="surname">
                        <label for="input-3">Логин <span style = "color: crimson;">*</span></label>
                        <input id="input-3" type="text" name="login">
                        <label for="input-4">Почта <span style = "color: crimson;">*</span></label>
                        <input id="input-4" type="email" name="email">
                        <label for="input-5">Пароль <span style = "color: crimson;">*</span></label>
                        <input id="input-5" type="password" name="password">
                        <label for="input-6">Подтвердите пароль <span style = "color: crimson;">*</span></label>
                        <input id="input-6" type="password" name="password-confirm">
                        <button class="sign-button">Зарегистрироваться</button>
                        <p>Уже зарегистрированы? - <a href="signin.php">Войти</a></p>
                    </form>
                </div>
                <a style="margin-left: auto; margin-top: 15px;" href="index.php" class="to-main-button">Вернуться на главную страницу</a>
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

    <div class="preloader">
        <div class="squares">
            <div class="square first-square"></div>
            <div class="square second-square"></div>
            <div class="square third-square"></div>
        </div>
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

    $(".sign-button").click(function(event) {
        event.preventDefault();
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $(".sign-button").click(function() {
        let nextStep = true;
        $("input").each(function(index) {
            let data = "" + $("#" + this.id.toString()).val();
            if(data == "") {
                $("#" + this.id.toString()).css({"border":"1px solid red"});
                nextStep = false;
            }
            else
                $("#" + this.id.toString()).css({"border":"1px solid black"}); 
        }); 
        // проверка логина
        if($("input[name='login']").val().length < 8) {
            $("input[name='login']").css({"border":"1px solid red"});
            if(document.querySelector(".login-message") == null) {
                $("<div style = 'color: red; margin-bottom: 15px;' class = 'login-message'></div>").insertAfter($("input[name='login']"));
                $(".login-message").text("Минимальная длина логина составляет 8 символов");
            }
            nextStep = false;
        }
        else {
            if(document.querySelector(".login-message") != null) {
                $(".login-message").remove();
                $("input[name='login']").css({"border":"1px solid black"});
            }
        }
        // проверка почты
        if(!isEmail($("input[name='email']").val())) {
            $("input[name='email']").css({"border":"1px solid red"});
            if(document.querySelector(".email-message") == null) {
                $("<div style = 'color: red; margin-bottom: 15px;' class = 'email-message'></div>").insertAfter($("input[name='email']"));
                $(".email-message").text("Email указан некорректно");
            }
            nextStep = false;
        }
        else {
            if(document.querySelector(".email-message") != null) {
                $(".email-message").remove();
                $("input[name='email']").css({"border":"1px solid black"});
            }
        }
        // проверка пароля
        if($("input[name='password'").val().length < 8) {
            $("input[name='password']").css({"border":"1px solid red"});
            if(document.querySelector(".password-message") == null) {
                $("<div style = 'color: red; margin-bottom: 15px;' class = 'password-message'></div>").insertAfter($("input[name='password']"));
                $(".password-message").text("Минимальная длина пароля составляет 8 символов");
            }
            nextStep = false;
        }
        else {
            if(document.querySelector(".password-message") != null) {
                $(".password-message").remove();
                $("input[name='password']").css({"border":"1px solid black"});
            }
        }
        // проверка повтора пароля
        if($("input[name='password'").val() != $("input[name='password-confirm']").val()) {
            $("input[name='password-confirm']").css({"border":"1px solid red"});
            if(document.querySelector(".password-confirm-message") == null) {
                $("<div style = 'color: red; margin-bottom: 15px;' class = 'password-confirm-message'></div>").insertAfter($("input[name='password-confirm']"));
                $(".password-confirm-message").text("Пароли не совпадают");
            }
            nextStep = false;
        }
        else {
            if(document.querySelector(".password-confirm-message") != null) {
                $(".password-confirm-message").remove();
                $("input[name='password-confirm']").css({"border":"1px solid black"});
            }
        }
        // отправка данных на сервер
        if(nextStep) {
            $.ajax({
                type: "POST",
                url: "core/signup-request.php",
                data: {
                    name: $("input[name='name']").val(),
                    surname: $("input[name='surname']").val(),
                    login: $("input[name='login']").val(),
                    email: $("input[name='email']").val(),
                    password: $("input[name='password']").val(),
                    passwordConfirm: $("input[name='password-confirm']").val()
                },
                context: document.body,
                success: function(result) {
                    console.log(result);
                    if(result == "Регистрация прошла успешно") {
                        window.location.replace("index.php");
                    }
                    else {
                        if(document.querySelector(".registration-error") == null) {
                            $("<div style = 'color: red; margin-bottom: 15px;' class = 'registration-error'></div>").insertAfter($("input[name='login']"));
                            $(".registration-error").text("Логин занят");
                        }
                    }
                }
            });
        }
    });

</script>

</html>