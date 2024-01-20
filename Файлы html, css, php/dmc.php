<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'internet-games');

// Проверяем, является ли пользователь администратором
$is_admin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

// ID игры DMC
$game_id = 24;

// Запрашиваем информацию о DMC из базы данных
$query = "SELECT * FROM `game` WHERE `id` = $game_id";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
<head>
    <title>DMC</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" type="text/css" href="style4.css">
    <style>
        #boxgame {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 600px;
            margin: 20px auto;
        }

        #boxgame img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        #boxgame table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        #boxgame table, #boxgame th, #boxgame td {
            border: 1px solid #ddd;
        }

        #boxgame th, #boxgame td {
            padding: 10px;
            text-align: left;
        }

        #boxgame th {
            background-color: #f2f2f2;
        }

        #boxgame button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #boxgame button:hover {
            background-color: #45a049;
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
    
        <?php
        if ($result) {
            $cyberpunk_info = mysqli_fetch_assoc($result);

            // Проверяем, есть ли информация о Warframe
            if ($cyberpunk_info) {
                ?>
                <div id="boxgame">
                    <h2><?= $cyberpunk_info['Название'] ?></h2>
                    <img src="uploads\16.png" alt="<?= $cyberpunk_info['Название'] ?>">
                    <table>
                        <tr>
                            <th>Разработчик</th>
                            <td><?= $cyberpunk_info['Разработчик'] ?></td>
                        </tr>
                        <tr>
                            <th>Цена</th>
                            <td><?= $cyberpunk_info['Цена'] ?></td>
                        </tr>
                        <tr>
                            <th>Категория</th>
                            <td><?= $cyberpunk_info['Категория'] ?></td>
                        </tr>
                        <tr>
                            <th>Возраст</th>
                            <td><?= $cyberpunk_info['Возраст'] ?></td>
                        </tr>
                    </table>

                    <!-- Добавляем кнопку для добавления в корзину -->
                    <?php if (!$is_admin): ?>
                        <form action="add_to_cart.php" method="post">
                            <input type="hidden" name="game_id" value="<?= $cyberpunk_info['ID'] ?>">
                            <button type="submit">Добавить в корзину</button>
                        </form>
                    <?php endif; ?>
                </div>
                <?php
            } else {
                echo 'Информация о DMC не найдена.';
            }
        } else {
            echo 'Ошибка при запросе информации о DMC : ' . mysqli_error($connect);
        }
        ?>
    </div>            
</body>
</html>
