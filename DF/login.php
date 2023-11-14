<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма Авторизации</title>
</head>
<body>
    <h2>Авторизация</h2>
    <form action="Log.php" method="post">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <input type="submit" value="Войти">
    </form>
</body>
</html>
