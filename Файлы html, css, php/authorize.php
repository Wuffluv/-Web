<?php
session_start();
require_once 'connect.php';

$username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
$password = md5($_POST['password'] . "ghfdsfs543");

$result = mysqli_query($connect, "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'");

if ($result) {
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'] // Добавляем роль в сессию
        ];

        header('Location: index.php');
    } else {
        echo "Такой пользователь не найден";
    }
} else {
    echo "Ошибка при выполнении запроса: " . mysqli_error($connect);
}

mysqli_close($connect);
?>
