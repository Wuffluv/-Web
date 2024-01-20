    <?php
    session_start();
    require_once 'connect.php';

    $Developer = $_POST['Developer'];
    $Name = $_POST['Name'];
    $Price = $_POST['Price'];
    $Category = $_POST['Category'];
    $Age = $_POST['Age'];
    $id = $_POST['ID'];

    mysqli_query($connect, "INSERT INTO `game` (`Разработчик`, `Название`, `Цена`, `Категория`, `Возраст`, `ID` ) VALUES ('$Developer', '$Name', '$Price', '$Category', '$Age', '$ID')");

    mysqli_close($connect);

    header('Location: index.php');

    ?>
