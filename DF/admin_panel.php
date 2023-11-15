<?php
session_start();
include 'DB.php';

// Проверка авторизации и роли пользователя
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 1) {
    header('Location: index.php'); // Перенаправление пользователя, если он не админ
    exit();
}

// Обработка добавления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    handleAddProduct();
}

// Обработка удаления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    handleDeleteProduct();
}

// Получение списка товаров
$products = getProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <!-- ... Ваши стили ... -->
</head>
<body>
    <h1>Админ-панель</h1>

    <!-- Форма добавления товара -->
    <form method="post" enctype="multipart/form-data">
        <h2>Добавить товар</h2>
        <label for="product_name">Название товара:</label>
        <input type="text" name="product_name" required>
        <label for="product_price">Цена товара:</label>
        <input type="number" name="product_price" required>
        <label for="product_image">Изображение товара:</label>
        <input type="file" name="product_image" accept="image/*" required>
        <label for="product_description">Описание товара:</label>
        <input type="text" name="description" required>
        <button type="submit" name="add_product">Добавить товар</button>
    </form>

    <!-- Таблица существующих товаров -->
    <h2>Текущие товары</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Изображение</th>
                <th>Удаление</th>
            </tr>
        </thead>
        <!-- Кнопка выхода -->
        <form method="post" action="logout.php" style="margin-top: 20px;">
            <button type="submit" name="logout">Выйти</button>
        </form>
        <a href="index.php" style="display: block; margin-top: 10px;">На главную страницу</a>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><img src="<?= $product['image_url'] ?>" alt="Изображение товара" style="max-width: 100px;"></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                            <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" name="delete_product">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php

// Функция обработки добавления товара
function handleAddProduct() {
    global $db;

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $uploadDir = 'uploads/'; // Папка для загрузки изображений
    $uploadFile = $uploadDir . basename($_FILES['product_image']['name']);

    if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFile)) {
        $stmt = $db->prepare("INSERT INTO products (name, price, image_url) VALUES (:name, :price, :image_url)");
        $stmt->bindParam(':name', $product_name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $product_price, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $uploadFile, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $error = "Ошибка при загрузке изображения.";
    }
}

// Функция обработки удаления товара
function handleDeleteProduct() {
    global $db;
    $product_id = $_POST['product_id'];

    $image_url = getImageUrl($product_id);

    if ($image_url && file_exists($image_url)) {
        unlink($image_url);
    }

    $stmt = $db->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
}

// Функция получения списка товаров
function getProducts() {
    global $db;

    $query = $db->query("SELECT * FROM products");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Функция получения URL изображения товара по его ID
function getImageUrl($product_id) {
    global $db;

    $stmt = $db->prepare("SELECT image_url FROM products WHERE id = :id");
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}
?>


   


