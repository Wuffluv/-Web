<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'internet-games');

if (!$connect) {
    echo 'Отсутствует подключение к базе данных';
    exit();
}

// Проверяем, является ли пользователь администратором
$is_admin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

// Проверяем, авторизован ли пользователь
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $user_id = $user['id'];
    $query = "SELECT `username`, `email`, `password` FROM `user` WHERE `id` = ?";

    // Подготавливаем запрос
    $stmt = mysqli_prepare($connect, $query);

    // Привязываем параметры
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    // Выполняем запрос
    mysqli_stmt_execute($stmt);

    // Получаем результаты
    mysqli_stmt_bind_result($stmt, $name, $email, $password);

    // Извлекаем результаты
    mysqli_stmt_fetch($stmt);

    // Закрываем запрос
    mysqli_stmt_close($stmt);
} else {
    // Если пользователь не авторизован, перенаправляем его на страницу входа
    header('Location: login.html');
    exit();
}

// Обработка выхода из аккаунта
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.html');
    exit();
}

// Если администратор, запросим информацию о покупках
if ($is_admin) {
    // Запросим общую выручку
    $query_total_revenue = "SELECT SUM(game.Цена) AS total_revenue
                            FROM cart
                            JOIN game ON cart.game_id = game.id";
    
    $result_total_revenue = mysqli_query($connect, $query_total_revenue);
    
    // Проверим, удалось ли выполнить запрос
    if ($result_total_revenue) {
        $total_revenue = mysqli_fetch_assoc($result_total_revenue)['total_revenue'];
    } else {
        echo 'Ошибка при запросе общей выручки: ' . mysqli_error($connect);
    }

    // Запросим информацию о покупках
    $query_purchases = "SELECT user.username, game.Название, game.Цена
                        FROM user
                        JOIN cart ON user.id = cart.user_id
                        JOIN game ON cart.game_id = game.id";

    $result_purchases = mysqli_query($connect, $query_purchases);
}
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" type="text/css" href="style4.css">
</head>
<body>
    <div id="main_conteiner">
        <a href="index.php"><img id="logo" src="Курсовая/logo.jpg"></a>
        <div id="conteiner1">        
        <div id="header">        
                <div><a href="newgames.php">Новинки</a></div>
                <div><a href="sales.php">Скидки</a></div>
                <div><a href="cart.php">Корзина</a></div>
                <div><a href="profile.php">Личный кабинет</a></div>            
        </div>
            <a href=""><img id="iconsearch" src="Курсовая/search.jpg"></a>
            <div id="search">
                <input id="search-txt"  type="text" name="searching" placeholder="Введите название или категорию игры">            
            </div>
        </div>

        <div id="boxaccount">
            <h2>Информация о пользователе</h2>
            <table>
                <tr>
                    <td>Имя:</td>
                    <td><?= $name ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?= $email ?></td>
                </tr>
                <tr>
                    <td>Пароль:</td>
                    <td><?= $password ?></td>
                </tr>
                
            </table>
            <form method="post">
                <input type="submit" name="logout" value="Выйти из аккаунта">
            </form>
        </div>  

        <?php if ($is_admin && isset($total_revenue) && isset($result_purchases)): ?>
            <div id="purchase-history">
                <h2>Информация о покупках пользователей</h2>
                <p>Общая выручка: ₽<?= $total_revenue ?></p>
                <table>
                    <tr>
                        <th>Пользователь</th>
                        <th>Игра</th>
                        <th>Цена</th>
                    </tr>
                    <?php while ($purchase = mysqli_fetch_assoc($result_purchases)): ?>
                        <tr>
                            <td><?= $purchase['username'] ?></td>
                            <td><?= $purchase['Название'] ?></td>
                            <td><?= $purchase['Цена'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
