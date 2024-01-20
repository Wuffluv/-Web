<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING) : '';
    $password = isset($_POST['password']) ? filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING) : '';
    $role = 'buyer'; // По умолчанию устанавливаем роль "покупатель"

    if (mb_strlen($username) < 5 || mb_strlen($username) > 30) {
        echo "Недопустимая длина логина";
        exit();
    } else if (mb_strlen($email) < 5 || mb_strlen($email) > 319) {
        echo "Недопустимая длина почты";
        exit();
    } else if (mb_strlen($password) < 3 || mb_strlen($password) > 100) {
        echo "Недопустимая длина пароля (от 3 до 100 символов)";
        exit();
    }

    $password = md5($password . "ghfdsfs543");

    $mysql = new mysqli('localhost', 'root', '', 'internet-games');

    $mysql->query("INSERT INTO `user` (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')");

    $mysql->close();

    header('Location: index.php');
} else {
    // Если форма не была отправлена методом POST
    echo "Недопустимый метод запроса";
}
?>
