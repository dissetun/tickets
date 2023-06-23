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
            <div class="admin-panel-container">
                <div class="custom-scroller">
                    <div class="custom-scroller-selected-option-container">
                        <div id="users" class="custom-scroller-selected-option">
                            <p>Пользователи</p>
                        </div>
                        <div class="custom-scroller-list-caret">
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
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
                <div class="search-field-container">
                    <i id="search-field-focus-button" class="fa-solid fa-magnifying-glass"></i>
                    <input class="search-field" type="text" name="search-field">
                </div>
                <section class="table-container">
                    <?php 
                        require_once "core/connect.php";
                        $link = mysqli_connect($host, $user, $password, $db_name); 
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($link, $query);
                        echo 
                        "
                            <table>
                                <tr>
                                    <th>Логин</th>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Почта</th>
                                    <th>Роль</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                        ";
                        foreach($result as $row) {
                            echo 
                            '
                                <tr>
                                    <td>'.$row["Login"].'</td>
                                    <td>'.$row["Name"].'</td>
                                    <td>'.$row["Surname"].'</td>
                                    <td>'.$row["Email"].'</td>
                                    <td>'.$row["Role name"].'</td>
                                    <td id="delete-users" class="delete-button" style="text-align: right;"><i class="fa-solid fa-trash-can"></i></td>
                                    <td id="edit-users" class="edit-button" style="text-align: right;"><i class="fa-solid fa-pencil"></i></td>
                                </tr>
                            ';
                        }
                        echo 
                        "
                            </table>
                        ";
                    ?>
                </section>
                <div class="pagination">
                    <?php 
                        require_once "core/connect.php";
                        $link = mysqli_connect($host, $user, $password, $db_name);
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($link, $query);
                        $numOfElements = mysqli_num_rows($result);
                        $numOfPages = $numOfElements / 8 + ($numOfElements % 8 != 0 and $numOfElements > 8);
                        for($i = 0; $i < $numOfPages; $i++) {
                            if(!$i)
                                echo 
                                "   
                                    <div class='pagination-page pagination-page-active'>".($i + 1)."</div>
                                ";
                            else
                                echo
                                "
                                    <div class='pagination-page'>".($i + 1)."</div>
                                ";
                        }
                    ?>
                </div>
            </div>
            <dialog id='delete-dialog' class="dialog">
                <div class='dialog-wrapper'>
                    <div class='dialog-header'>
                        <p>Подтвердите действие</p>
                        <i class="fa-solid fa-xmark hide-dialog"></i>
                    </div>
                    <div class='dialog-content'>
                        <p id="data-object" data-tableName="" data-mainColumnValue="" style="display: hide;"></p>
                        <p style="margin-top: auto; margin-bottom: auto;">Вы уверены, что хотите удалить запись из таблицы?</p>
                        <div style="display: flex; margin-top: 20px; margin-left: auto; margin-top: auto;">
                            <div style="padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;" id='confirm-delete'>Да</div>
                            <div style="margin-left: 20px; padding: 5px 10px; background-color: black; color: white; border-radius: 10px; cursor: pointer;" id='decline-delete'>Нет</div>
                        <div>
                    </div>
                </div>
            </dialog>
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
        $(".user-login").css({
            "padding":"3px 10px",
            "background-color":"crimson",
            "border-radius":"10px",
            "color":"white"
        });
        $(".user-menu").css({"margin-top":"222px"});
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

    $(".custom-scroller-list .custom-scroller-option").click(function() {
        let tableNameText = $("#" + this.id).text().trim();
        $(".custom-scroller-selected-option p").text(tableNameText);
        $(".custom-scroller-selected-option").attr('id', this.id);
        // $(".fa-caret-down").css({"display":"block", "margin-bottom":"4px"});
        $(".fa-caret-down").css({"transform":"rotate(0deg)"});
        // $(".fa-caret-up").css({"display":"none"});
        $(".custom-scroller-list").removeClass("custom-scroller-list-active");
        let pageNumber = parseInt($(this).text());
        let tableName = $(".custom-scroller-selected-option").attr("id");
        let searchField = $(".search-field").val();
        $.ajax({
            type: "POST",
            url: "core/table-generate.php",
            data: {tableName: tableName, pageNumber: pageNumber, searchField: searchField},
            context: document.body,
            success: function(result) {
                $(".table-container").html(result);
                if(result == "Ничего не найдено") {
                    $(".table-container").html("<div><p style='text-align: center;'>Ничего не найдено</p></div>");
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "core/pagination-generate.php",
            data: {tableName: tableName, pageNumber: pageNumber, searchField: searchField},
            context: document.body,
            success: function(result) {
                $(".pagination").html(result);
            }
        });
    });

    // -------- table-events --------

    $(document).on("click", ".delete-button", function() {
        document.getElementById("delete-dialog").showModal();
        let tableName = $(this).attr("id").replace("delete-", "");
        let tableMainColumnValue = $(this).parent().find("td:first-child").text().trim();
        $("#data-object").attr("data-tableName", tableName);
        $("#data-object").attr("data-mainColumnValue", tableMainColumnValue);
    });

    // -- dialog basic events --

    $(".hide-dialog").click(function() {
        let dialogID = $(this).parent().parent().parent().attr("id");
        document.getElementById(dialogID).close();
    });

    $("#decline-delete").click(function() {
        let dialogID = $(this).parent().parent().parent().parent().attr("id");
        document.getElementById(dialogID).close();
    });

    $("#confirm-delete").click(function() {
        let tableName = $("#data-object").attr("data-tablename");
        let tableMainColumnValue = $("#data-object").attr("data-maincolumnvalue");
        let query = "";
        if(tableName == "users") {
            query = "DELETE FROM users WHERE `Login` = '" + tableMainColumnValue + "'"; 
        }
        else if(tableName == "performances") {
            query = "DELETE FROM performances WHERE `Performance ID` = '" + tableMainColumnValue + "'"; 
        }
        else if(tableName == "platforms") {
            query = "DELETE FROM platforms WHERE `Platform` = '" + tableMainColumnValue + "'"; 
        }
        else if(tableName == "genres") {
            query = "DELETE FROM genres WHERE `Genre` = '" + tableMainColumnValue + "'"; 
        }
        $.ajax({
            type: "POST",
            url: "core/table-delete-request.php",
            data: {query: query},
            context: document.body,
            success: function(result) {
            }
        });
        let pageNumber = parseInt($(".pagination-page-active").text());
        tableName = $(".custom-scroller-selected-option").attr("id");
        let searchField = $(".search-field").val();
        $.ajax({
            type: "POST",
            url: "core/table-generate.php",
            data: {tableName: tableName, pageNumber: pageNumber, searchField: searchField},
            context: document.body,
            success: function(result) {
                $(".table-container").html(result);
            }
        });
        let dialogID = $(this).parent().parent().parent().parent().attr("id");
        document.getElementById(dialogID).close();
    });

    $(document).on("click", ".edit-button", function() {
        let tableName = $(this).attr("id").replace("edit-", "");
        let tableMainColumnValue = $(this).parent().find("td:first-child").text().trim();
        console.log(tableMainColumnValue);
    });

    // -------- search-bar --------

    $("#search-field-focus-button").click(function() {
        $(".search-field").trigger("focus");
    });

    $(".search-field").on("input", function() {
        console.log($(".search-field").val());
        let pageNumber = parseInt($(this).text());
        let tableName = $(".custom-scroller-selected-option").attr("id");
        let searchField = $(".search-field").val();
        $.ajax({
            type: "POST",
            url: "core/table-generate.php",
            data: {tableName: tableName, pageNumber: pageNumber, searchField: searchField},
            context: document.body,
            success: function(result) {
                $(".table-container").html(result);
                if(result == "Ничего не найдено") {
                    $(".table-container").html("<div><p style='text-align: center;'>Ничего не найдено</p></div>");
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "core/pagination-generate.php",
            data: {tableName: tableName, pageNumber: pageNumber, searchField: searchField},
            context: document.body,
            success: function(result) {
                $(".pagination").html(result);
            }
        });
    });

    // -------- pagination --------

    $(".pagination").on('click', '.pagination-page', function() {
        $(".pagination").on('load', $('.pagination-page').each(function() {
            $(this).css({"background-color":"black", "color":"white"});
            $(this).removeClass("pagination-page-active");
        }));
        $(this).addClass("pagination-page-active");
        $(this).css({"background-color":"#cedcfb", "color":"black"});
        let pageNumber = parseInt($(this).text());
        let tableName = $(".custom-scroller-selected-option").attr("id");
        let searchField = $(".search-field").val();
        $.ajax({
            type: "POST",
            url: "core/table-generate.php",
            data: {tableName: tableName, pageNumber: pageNumber, searchField: searchField},
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

</html>