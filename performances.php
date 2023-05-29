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
                <div class="logo-container">
                    <i style = "margin-right: 10px; font-size: 30px;" class="fa-solid fa-ticket"></i>
                    <p class="logo">Билеты</p>
                </div>
                <nav>
                    <a href="index.php" class="new">Новинки</a>
                    <a href="performances.php" class="catalog nav-active">Представления</a>
                </nav>
                <div class="user">
                    <a href="signin.php">Войти</a>
                    <div class="user-image"></div>
                </div>
                <!-- <div style = "position: relative;" class="user">
                    <?php  
                        echo '<p class="user-name" href="">Войти</p>';
                    ?>
                    <div class="user-image"></div>
                    <div style = "background-color: white; z-index: 99999999; border-radius: 0px 0px 10px 10px; display: none; flex-direction: column; justify-content: center; align-items: center; position: absolute; height: 250px; width: 150px; z-index: -1; top: 50%; left: 50%; transform: translate(-50%, -50%); box-shadow: 0px 2px 10px 1px rgba(0, 0, 0, 0.1);" class="user-nav">
                        <div style = "margin-top: 145px; display: flex; flex-direction: column;" class="user-nav-items">
                            <a style = "margin-right: auto;" class="user-nav-item" href = "#">Личный кабинет</a>
                            <a style = "margin-right: auto; margin-top: 10px;" class="user-nav-item" href = "#">История покупок</a>
                            <a style = "margin-right: auto; margin-top: 10px;" class="user-nav-item" href = "#">Настройки</a>
                        </div>
                    </div>
                </div> -->
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
                            include 'connect.php';
                            $link = mysqli_connect($host, $user, $password, $db_name); 
                            $query = "SELECT * FROM performances LIMIT 9";
                            $result = mysqli_query($link, $query);
                            foreach($result as $row) {
                                echo 
                                '
                                    <a href="performance-page.php?performance='.$row["name"].'" style = "background: url('.$row["path"].'); background-size: cover; background-repeat: no-repeat; background-position: center;" class="performance">
                                        <p href="performance-page.php?id='.$row["name"].'">'.$row["name"].'</p>
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
                        <a href="#">Отправить заявку на проведение мероприятия</a>
                        <a href="#">Площадки мероприятий</a>
                    </div>
                    <div class="footer-info-item">
                        <h1>Партнерам</h1>
                        <a href="#">Заключение сотрудничества</a>
                        <a href="#">Данные о компании</a>
                    </div>
                    <!-- <div class="footer-info-item">
                        <h1>Организаторам мероприятий</h1>
                        <a href="#">Отправить заявку на проведение мероприятия</a>
                        <a href="#">Действие, которое могут совершить организаторы</a>
                    </div> -->
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

    const windowRedirect = (id) => {
        $.ajax({
            url: "https://jsonplaceholder.typicode.com/posts/1",
            type: "GET",
            success: function (data) {
                console.log(data);
            }
        });
    }

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
            $(".sub").each(function(index) {
                $(this).css({
                    'display':'flex'
                });
            });
        }
        setTimeout(() => loadPages(), 500);
    });

    // $(".user-name").click(function() {
    //     $(".user-nav").css({
    //         'display':'flex'
    //     });
    // });

    // const filters = document.querySelectorAll(".filter");

    // for(let filter of filters) {
    //     filter.addEventListener("click", () => {
    //         if(!filter.classList.contains("filter-active")) {
    //             for(let otherFilter of filters) {
    //                 if(otherFilter.classList.contains("filter-active"))
    //                     otherFilter.classList.remove("filter-active");
    //             }
    //             filter.classList.add("filter-active");
    //         }
    //         else {
    //             filter.classList.remove("filter-active");
    //         }
    //     });
    // }

</script>

</html>