<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Процессоры</title>
    <style>
        /* Стили для страницы "Процессоры" можно настроить по вашему усмотрению */
    </style>
</head>
<body>
    <header>
        <h1>Процессоры</h1>
    </header>
    <div class="container">
        <!-- Здесь вы можете использовать PHP для вывода карточек товаров из базы данных -->
<?php
$host = 'localhost';
$dbname = '20300_complekt';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
        try {
            // SQL-запрос для выбора процессоров
            $query = "SELECT * FROM Products WHERE category_id = 2"; // Предполагаем, что 1 - это ID категории "Процессоры"

            $stmt = $db->prepare($query);
            $stmt->execute();

            // Вывод карточек товаров
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="product-card">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" width="250" height="250">';
                echo '<h3>' . $row['name'] . '</h3>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p>Цена: $' . $row['price'] . '</p>';
                echo '<a href="#" class="details-button">Подробнее</a>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Ошибка выполнения запроса: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
