<?php 

    session_start();
    if(!isset($_SESSION["login"]) or $_SESSION["roleName"] != "Администратор") {
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
                            <a style="text-align: left;" id="personal-area" href="personal-area.php">Личный кабинет</a>
                            <a style="text-align: center; color: white;" id="administration" href="administration.php" class="user-menu-link-active">Управление</a>
                            <a style="text-align: left;" id="purchase-history" id="purchase-history-link" href="purchases-history.php">Исторя покупок</a>
                            <p style="" id="logout">Выйти</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main style="margin-top: 150px; margin-bottom: 90px;">
            <div class="custom-scroller">
                <div class="custom-scroller-option custom-scroller-selected-option">
                    <p>Пользователи</p>
                    <i style="display: none;" class="fa-solid fa-caret-up"></i>
                    <i style="margin-bottom: 4px;" class="fa-solid fa-caret-down"></i>
                </div>
                <div class="custom-scroller-list">
                    <div id="users" class="custom-scroller-option">
                        <p>Пользователи</p>
                    </div>
                    <div id="performances" class="custom-scroller-option">
                        <p>Представления</p>
                    </div>
                    <div id="platforms" class="custom-scroller-option">
                        <p>Площадки</p>
                    </div>
                    <div id="genres" class="custom-scroller-option">
                        <p>Жанры</p>
                    </div>
                </div>
            </div>
            <section class="table-container">
                <?php 
                    include "core/connect.php";
                    $link = mysqli_connect($host, $user, $password, $db_name); 
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($link, $query);
                    echo 
                    "
                        <table>
                            <tr>
                                <th>Login</th>
                                <th>Name</th>
                                <th>Surname</th>
                            </tr>
                    ";
                    foreach($result as $row) {
                        echo 
                        '
                            <tr>
                                <td>'.$row["Login"].'</td>
                                <td>'.$row["Name"].'</td>
                                <td>'.$row["Surname"].'</td>
                            </tr>
                        ';
                    }
                    echo 
                    "
                        </table>
                    ";
                ?>
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

    let sessionLogin = '<?php echo json_encode($_SESSION["login"])?>';
    if(sessionLogin != "null") {
        sessionLogin = sessionLogin.substring(1, sessionLogin.length - 1);
        $(".signin-button").css({"display":"none"});
        $(".user-login").text(sessionLogin);
        let roleName = '<?php echo json_encode($_SESSION["roleName"])?>';
        roleName = roleName.substring(1, roleName.length - 1);
        console.log(roleName);
        $(".user-login").css({
            "padding":"3px 10px",
            "background-color":"crimson",
            "border-radius":"10px",
            "color":"white"
        });
        $(".user-menu").css({"margin-top":"190px"});
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

    // -------- custom-scroller --------

    $(".custom-scroller-selected-option").click(function() {
        if(!$(".custom-scroller-list").hasClass("custom-scroller-list-active")) {
            $(".fa-caret-down").css({"display":"none"});
            $(".fa-caret-up").css({"display":"block"});
            $(".custom-scroller-list").addClass("custom-scroller-list-active");
        }
        else {
            $(".fa-caret-down").css({"display":"block", "margin-bottom":"4px"});
            $(".fa-caret-up").css({"display":"none"});
            $(".custom-scroller-list").removeClass("custom-scroller-list-active");
        }
    });

    $(".custom-scroller-list .custom-scroller-option").click(function() {
        let tableName = $("#" + this.id).text().trim();
        $(".custom-scroller-selected-option p").text(tableName);
        $(".fa-caret-down").css({"display":"block", "margin-bottom":"4px"});
        $(".fa-caret-up").css({"display":"none"});
        $(".custom-scroller-list").removeClass("custom-scroller-list-active");
        let query = "SELECT * FROM " + this.id + "";
        $.ajax({
            type: "POST",
            url: "core/table-generate.php",
            data: {query: query, tableName: this.id},
            context: document.body,
            success: function(result) {
                $(".table-container").html(result);
            }
        });
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