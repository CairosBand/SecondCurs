<?php
include 'DB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM customers WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['role_id'] === 1) {
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role_id']; 
            $_SESSION['first_name'] = $row['first_name']; 
            header('Location: admin_panel.php'); // Перенаправление на админ-панель для админа
            exit();
        } elseif (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role_id']; 
            $_SESSION['first_name'] = $row['first_name']; 
            header('Location: index.php'); // Перенаправление на главную страницу для пользователя
            exit();
        } else {
            $error = "Неправильный логин или пароль.";
        }
    } else {
        $error = "Неправильный логин или пароль.";
    }
}
?>
