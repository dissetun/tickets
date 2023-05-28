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

    <div class="sign-container">
        <div class="sign-form-container">
            <div class="sign-special">
                <p>Посещайте новинки из мира театра, кино и музыки.</p>
            </div>
            <form class="sign-form" action="core/signup-request.php" method="post">
                <div class="message">
                    <p>Something</p>
                </div>
                <label for="name">Имя</label>
                <input type="text" name="name">
                <label for="surname">Фамилия</label>
                <input type="text" name="surname">
                <label for="login">Логин</label>
                <input type="text" name="login">
                <label for="email">Почта</label>
                <input type="email" name="email">
                <label for="password">Пароль</label>
                <input type="password" name="password">
                <label for="password-confirm">Подтвердите пароль</label>
                <input type="password" name="password-confirm">
                <button class="sign-button">Зарегистрироваться</button>
                <p>Уже зарегистрированы? - <a href="signin.php">Войти</a></p>
            </form>
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