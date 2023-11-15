<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Охлаждение</title>
    <style>
        /* Стили для страницы "Процессоры" можно настроить по вашему усмотрению */
    </style>
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
                        <a href="../index.php" class="navbar-brand">DIGITAL FANTASY</a>
                    </div>

                    <div class="navbar-collapse collapse" id="mobile_menu">
                        <ul class="nav navbar-nav">
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="processor.php">Процессоры</a></li>
                                    <li><a href="gpu.php">Видеокарты</a></li>
                                    <li><a href="motherboard.php">Материнские платы</a></li>
                                    <li><a href="ram.php">ОЗУ</a></li>
                                    <li><a href="cases.php">Корпуса</a></li>
                                    <li><a href="psu.php">Блоки питания</a></li>
                                    <li><a href="cooling.php">Охлаждение</a></li>
                                    <li><a href="ssd.php">SSD</a></li>
                                </ul>
                            </li>
                            <li><a href="../ourus.php">О магазине</a></li>
                            <li><a href="../contacts.php">Контакты</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li>
                        
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="cart.php"> Корзина</a></li>
                            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Вход / Регистрация <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../login.php">Вход</a></li>
                                    <li><a href="../register.php">Регистрация</a></li>
                                </ul>
                            </li>
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
        <!-- Здесь вы можете использовать PHP для вывода карточек товаров из базы данных -->
<?php 
include '../DB.php';
            // SQL-запрос для выбора процессоров
            $query = "SELECT * FROM products WHERE category_id = 5"; // Предполагаем, что 2 - это ID категории "Корпуса"

            $stmt = $db->prepare($query);
            $stmt->execute();

            // Вывод карточек товаров
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="product-card">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" width="250" height="250">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>Цена: $' . $row['price'] . '</p>';
                echo '<a href="../cart.php?add_to_cart=1&product_id=' . $row['id'] . '" class="details-button">В корзину</a>';
                echo '</div>';
            }
?>
    </div>
</body>
</html>