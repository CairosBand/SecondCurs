<?php
include 'DB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Пароли не совпадают.";
        header('Location: register.php?error=' . $error);
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO customers (first_name, email, last_name, password, role_id) VALUES (:first_name, :email, :last_name, :password, 2)");
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            header('Location: login.php'); 
            exit();
        } else {
            $error = "Ошибка при регистрации. Пожалуйста, попробуйте снова.";
            header('Location: register.php?error=' . $error);
            exit();
        }
    }
}
?>