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
            <div style = "max-width: 543.39px;" class="sign-container">
                <div class="sign-form-container">
                    <div class="sign-special">
                        <p>Посещайте новинки из мира театра, кино и музыки.</p>
                    </div>
                    <form class="sign-form">
                        <div class="message">
                            <p>Something</p>
                        </div>
                        <label for="login">Логин</label>
                        <input id="input-1" type="text" name="login">
                        <label for="password">Пароль</label>
                        <input id="input-2" type="password" name="password">
                        <button class="sign-button">Войти</button>
                        <p>Нет аккаунта? - <a href="signup.php">Зарегистрироваться</a></p>
                    </form>
                </div>
                <a href="index.php" class="to-main-button">Вернуться на главную страницу</a>
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

    $(".sign-button").click(function(event) {
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
        if(nextStep) {
            $.ajax({
                type: "POST",
                url: "core/signin-request.php",
                data: {
                    login: $("input[name='login']").val(),
                    password: $("input[name='password']").val()
                },
                context: document.body,
                success: function(result) {
                    if(result == "Авторизация прошла успешно") {
                        window.location.replace("index.php");
                    }
                    else {
                        $("input[name='login']").css({"border":"1px solid red"});
                        $("input[name='password']").css({"border":"1px solid red"});
                        if(document.querySelector(".authorization-error") == null) {
                            $("<div style = 'color: red; margin-bottom: 15px;' class = 'authorization-error'></div>").insertAfter($("input[name='password']"));
                            $(".authorization-error").text("Неверные логин или пароль");
                        }
                    }
                }
            });
        }
    });

</script>

</html>