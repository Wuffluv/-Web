<?php

require_once 'connect.php';

$Developer = $_POST['Developer'];
$Name = $_POST['Name'];
$Price = $_POST['Price'];
$Category = $_POST['Category'];
$Age = $_POST['Age'];
$id = $_POST['ID'];

mysqli_query($connect, "UPDATE `game` SET 
    `Разработчик` = '$Developer', 
    `Название` = '$Name', 
    `Цена` = '$Price', 
    `Категория` = '$Category', 
    `Возраст` = '$Age' 
    WHERE `game`.`ID` = '$id'");

header('Location: index.php');
?>
