<?php
    require_once 'connect.php';

    $product_id = $_GET['id'];
    $product = mysqli_query($connect, "SELECT * FROM `game` WHERE `ID` = '$product_id'");
    $product = mysqli_fetch_assoc($product);
    

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Update product</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <form action="update1.php" method="post" id="tablechange">
        <p>Разработчик</p>
        <input type="text" name="Developer" value="<?= $product['Разработчик']?>">
        <p>Название</p>
        <input type="text" name="Name" value="<?= $product['Название']?>">
        <p>Цена</p>
        <input type="number" name="Price" value="<?= $product['Цена']?>">
        <p>Категория</p>
        <input type="text" name="Category" value="<?= $product['Категория']?>">
        <p>Возраст</p>
        <input type="text" name="Age" value="<?= $product['Возраст']?>">
        <input type="hidden" name="ID" value="<?= $product['ID']?>"> 
        <br>
        <button type="submit" id="add">Обновить продукт</button>
    </form>
</body>
</html>
