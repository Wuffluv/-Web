<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'internet-games');

if (!$connect) {
    echo 'Отсутствует подключение к базе данных';
}

// Проверяем, авторизован ли пользователь
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    // Запрашиваем информацию о корзине пользователя
    $user_id = $user['id'];

    // Обработка удаления товара из корзины
    if (isset($_POST['delete_item'])) {
        $delete_item_id = $_POST['delete_item_id'];

        $delete_query = "DELETE FROM cart WHERE id = $delete_item_id AND user_id = $user_id";
        $delete_result = mysqli_query($connect, $delete_query);

        if (!$delete_result) {
            echo 'Ошибка при удалении товара из корзины: ' . mysqli_error($connect);
        }
    }

    $query = "SELECT game.*, cart.id as cart_id, cart.quantity FROM cart
              JOIN game ON cart.game_id = game.id
              WHERE cart.user_id = $user_id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        $cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo 'Ошибка при запросе информации о корзине: ' . mysqli_error($connect);
    }
} else {
    // Если пользователь не авторизован, перенаправляем его на страницу входа
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Корзина</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" type="text/css" href="style4.css">
    <style>
        #boxcart {
            float: left;
            width: 50%;
        }

        #total {
            float: right;
            width: 40%;
            margin-top: 20px;
        }

        #total table {
            width: 100%;
            border-collapse: collapse;
        }

        #total table, #total th, #total td {
            border: 1px solid #ddd;
        }

        #total th, #total td {
            padding: 8px;
            text-align: left;
        }
    </style>
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
                <input id="search-txt" type="text" name="searching" placeholder="Введите название или категорию игры">
            </div>
        </div>

        <div id="boxcart">
            <h2>Корзина</h2>
            <table>
                <tr>
                    <th>Игра</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Действия</th>
                </tr>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?= $item['Название'] ?></td>
                        <td><?= $item['Цена'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="delete_item_id" value="<?= $item['cart_id'] ?>">
                                <input type="submit" name="delete_item" value="Удалить">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div id="total">
            <h2>Итоговая сумма</h2>
            <table>
                <tr>
                    <th>Итого</th>
                </tr>
                <tr>
                    <td>
                        <?php
                        $total_price = array_sum(array_column($cart_items, 'Цена'));
                        echo $total_price;
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
