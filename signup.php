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
                    <form class="sign-form" action="core/signup-request.php" method="post">
                        <div class="message">
                            <p>Something</p>
                        </div>
                        <label for="name">Имя <span style = "color: crimson;">*</span></label>
                        <input type="text" name="name">
                        <label for="surname">Фамилия <span style = "color: crimson;">*</span></label>
                        <input type="text" name="surname">
                        <label for="login">Логин <span style = "color: crimson;">*</span></label>
                        <input type="text" name="login">
                        <label for="email">Почта <span style = "color: crimson;">*</span></label>
                        <input type="email" name="email">
                        <label for="password">Пароль <span style = "color: crimson;">*</span></label>
                        <input type="password" name="password">
                        <label for="password-confirm">Подтвердите пароль <span style = "color: crimson;">*</span></label>
                        <input type="password" name="password-confirm">
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

</script>

</html>