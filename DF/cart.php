<?php
include 'DB.php';
session_start();

// Добавление товара в корзину
if (isset($_GET['add_to_cart']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Получение информации о товаре
    $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверка, есть ли уже такой товар в корзине
    $existing_item_key = array_search($id, array_column($_SESSION['cart'], 'id'));

    if ($existing_item_key !== false) {
        // Увеличение количества товара, если он уже есть в корзине
        $_SESSION['cart'][$existing_item_key]['quantity']++;
    } else {
        // Добавление нового товара в корзину
        $product['quantity'] = 1;
        $_SESSION['cart'][] = $product;
    }
}

// Удаление товара из корзины
if (isset($_GET['remove_from_cart']) && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Удаление товара из корзины
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $id) {
            // Если количество больше 1, уменьшаем количество
            if ($item['quantity'] > 1) {
                $_SESSION['cart'][$key]['quantity']--;
            } else {
                // Если количество равно 1, удаляем товар из корзины
                unset($_SESSION['cart'][$key]);
            }
        }
    }
}

// Вывод товаров в корзине
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <style>
    
        .cart-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .cart-item img {
            max-width: 100%;
            height: auto;
        }

        .quantity-controls {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<!-- Ваша шапка -->

<div class="container">
    <h2>Корзина</h2>

    <?php
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            echo '<div class="cart-item">';
            echo '<img src="' . $item['image_url'] . '" alt="' . $item['name'] . '" width="100" height="100">';
            echo '<h3>' . $item['name'] . '</h3>';
            echo '<p>' . $item['description'] . '</p>';
            echo '<p>Цена: $' . $item['price'] . '</p>';
            echo '<p>Количество: ' . $item['quantity'] . '</p>';
        
            // Кнопки управления количеством
            echo '<div class="quantity-controls">';
            echo '<a href="../cart.php?add_to_cart=1&product_id=' . $item['id'] . '">Добавить еще</a>';
            echo '<a href="../cart.php?remove_from_cart=1&product_id=' . $item['id'] . '">Удалить</a>';
            echo '</div>';
        
            echo '</div>';
        
            $total_price += $item['price'] * $item['quantity'];
        }
    } else {
        echo "<p>Корзина пуста.</p>";
    }

    echo "<p><strong>Общая стоимость: ₽" . $total_price . "</strong></p>";
    ?>

</div>

<!-- Ваш подвал -->

</body>
</html>