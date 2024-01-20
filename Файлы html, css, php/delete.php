<?php

require_once 'connect.php';

$id = $_GET['id'];

mysqli_query($connect, "DELETE FROM `game` WHERE `game`.`ID` = '$id'");

header('Location: index.php');

?>