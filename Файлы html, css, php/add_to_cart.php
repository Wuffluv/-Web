<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'internet-games');

// Проверяем, является ли пользователь администратором
$is_admin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

// Проверяем, есть ли параметр game_id в запросе
if (isset($_POST['game_id'])) {
    // Получаем game_id из запроса
    $game_id = $_POST['game_id'];

    // Получаем информацию о пользователе
    $user_id = $_SESSION['user']['id'];

    // Проверяем, не добавлен ли товар уже в корзину
    $check_query = "SELECT * FROM `cart` WHERE `user_id` = $user_id AND `game_id` = $game_id";
    $check_result = mysqli_query($connect, $check_query);

    if ($check_result && mysqli_num_rows($check_result) == 0) {
        // Если товар еще не добавлен, добавляем его в корзину
        $add_to_cart_query = "INSERT INTO `cart` (`user_id`, `game_id`) VALUES ($user_id, $game_id)";
        $add_to_cart_result = mysqli_query($connect, $add_to_cart_query);

        if ($add_to_cart_result) {
            echo 'Товар успешно добавлен в корзину!';
        } else {
            echo 'Ошибка при добавлении товара в корзину: ' . mysqli_error($connect);
        }
    } else {
        echo 'Товар уже добавлен в корзину!';
    }
} else {
    echo 'Некорректные параметры запроса.';
}
?>
