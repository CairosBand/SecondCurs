<?php 

include 'DB.php';
session_start();
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;1,300&display=swap" rel="stylesheet">
<link rel="icon" href="" type="image/x-icon">
</head>
<body>
<header>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
<div class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar-header">
                        <button class="navbar-toggle" data-target="#mobile_menu" data-toggle="collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="index.php" class="navbar-brand">DIGITAL FANTASY</a>
                    </div>
                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="1/processor.php">Процессоры</a></li>
                                    <li><a href="1/gpu.php">Видеокарты</a></li>
                                    <li><a href="1/motherboard.php">Материнские платы</a></li>
                                    <li><a href="1/ram.php">ОЗУ</a></li>
                                    <li><a href="1/cases.php">Корпуса</a></li>
                                    <li><a href="1/psu.php">Блоки питания</a></li>
                                    <li><a href="1/cooling.php">Охлаждение</a></li>
                                    <li><a href="1/ssd.php">SSD</a></li>
                                </ul>
                            </li>
                            <li><a href="ourus.php">О магазине</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li>
                        
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="cart.php"> Корзина</a></li>|
                            <?php 
                            if(isset($_SESSION['first_name'])){
                                echo '<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Выход <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="logout.php">Выход</a></li>
                                </ul>
                            </li>';
                            if ($isAdmin) {
                                echo '<li><a href="admin_panel.php">Админ-панель</a></li>';
                            }
                            }else{
                                echo '<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Вход / Регистрация <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="login.php">Вход</a></li>
                                    <li><a href="register.php">Регистрация</a></li>
                                </ul>
                            </li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </header>

    <div class="container">
    <h1>Выберите категорию товаров:</h1>
    <a href="1/processor.php" class="category-link">
        <img src="images/processor.jpg" alt="Процессоры" width="100" height="100">
        Процессоры
    </a>
    <a href="1/gpu.php" class="category-link">
        <img src="images/gpu.jpg" alt="Видеокарты" width="100" height="100">
        Видеокарты
    </a>
    <a href="1/motherboard.php" class="category-link">
        <img src="images/motherboard.jpg" alt="Материнские платы" width="100" height="100">
        Материнские платы
    </a>
    <a href="1/ram.php" class="category-link">
        <img src="images/ram.jpg" alt="ОЗУ" width="100" height="100">
        ОЗУ
    </a>
    <a href="1/cases.php" class="category-link">
        <img src="images/cases.jpg" alt="Корпуса" width="100" height="100">
        Корпуса
    </a>
    <a href="1/psu.php" class="category-link">
        <img src="images/psu.jpg" alt="Блоки питания" width="100" height="100">
        Блоки питания
    </a>
    <a href="1/cooling.php" class="category-link">
        <img src="images/cooling.jpg" alt="Охлаждение" width="100" height="100">
        Охлаждение
    </a>
    <a href="1/ssd.php" class="category-link">
        <img src="images/ssd.jpg" alt="SSD" width="100" height="100">
        SSD
    </a>
</div>
</body>
</html>


