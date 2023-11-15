<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма Регистрации</title>
</head>
<body>
    <h2>Регистрация</h2>
    <form action="Reg.php" method="post">
        <label for="first_name">Имя:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="last_name">Фамилия:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <label for="confirm_password">Подтвердите пароль:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br><br>

        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>
