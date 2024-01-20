
<?php
session_start();
require_once 'connect.php';

// Проверяем, является ли пользователь администратором
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        
        $newsText = "Текст новости для редактирования";

        
        echo '<form action="save_news.php" method="post">';
        echo '<textarea name="news_text" placeholder="Введите новость">' . $newsText . '</textarea>';
        echo '<button type="submit" id="save_news">Сохранить новость</button>';
        echo '</form>';
    }
} else {
    // Если пользователь не администратор, перенаправляем его на главную
    header('Location: index.php');
    exit();
}
?>
