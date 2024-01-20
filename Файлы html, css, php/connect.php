<?php


$connect = mysqli_connect('localhost', 'root', '', 'internet-games');

if (!$connect){
	echo 'Отсуствует подключение к базе данных';
}

?>