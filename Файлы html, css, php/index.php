<?php
session_start();
require_once 'connect.php';

// Проверяем, является ли пользователь администратором
$is_admin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу входа
    header('Location: login.html');
    exit();
}


// Обработка поискового запроса
if (isset($_POST['searching'])) {
    $search_query = mysqli_real_escape_string($connect, $_POST['searching']);
    
    
    
    $search_result = mysqli_query($connect, "SELECT * FROM `game` WHERE `Название` LIKE '%$search_query%'");

    // Проверка наличия результатов
    if ($search_result && mysqli_num_rows($search_result) > 0) {
        // Если найдены результаты, перенаправляем пользователя на страницу первой игры из результатов
        $first_game = mysqli_fetch_assoc($search_result);
        $game_id = $first_game['ID'];
        header("Location: game.php?id=$game_id");
        exit();
    } else {
        // Если ничего не найдено, вы можете вывести сообщение об этом или выполнить другие действия
        echo 'Ничего не найдено';
    }
}
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Главная страница</title>
    <link rel="stylesheet" href="style1.css">
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
            <form method="post" action="">
                <input id="search-txt" type="text" name="searching" placeholder="Введите название или категорию игры">  
                <button type="submit">Поиск</button>
            </form>          
        </div>
    </div>
	<div id="conteiner2">
			<?php
            	if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            ?>
			

		
			<table id = "game1">
				 <tr>
					 <th>Developer</th>
					 <th>Name</th>
					 <th>Price</th>
					 <th>Category</th>
					 <th>Age</th>
					 <th>ID</th>
				</tr>
				<?php

				$products = mysqli_query($connect, "SELECT * FROM `game`");

				$products = mysqli_fetch_all($products);
				foreach($products as $product){
					?>
					<tr id="table1">
						<td id="table2"><?= $product[0] ?></td>
						<td><?= $product[1] ?></td>
						<td><?= $product[2] ?></td>
						<td><?= $product[3] ?></td>
						<td><?= $product[4] ?></td>
						<td><?= $product[5] ?></td>
						<td id="change"><a href="update.php?id=<?= $product[5] ?>">Изменить</a></td>
						<td id="delete"><a href="delete.php?id=<?= $product[5] ?>">Удалить</a></td>
					</tr>
					<?php
				}
			?>
				
			</table>
			<h3>Добавить новый товар</h3>
			<form action = "create.php" method="post" id="table">
				<p>Разработчик</p>
				<input type="text" name="Developer">
				<p>Название</p>
				<input name = "Name"></textarea>
				<p>Цена</p>
				<input type = "number" name = "Price">
				<p>Категория</p>
				<input name = "Category">
				<p>Возраст</p>
				<input name = "Age"> 
			<br>
				<button type = "submit" id="add">Добавить продукт</button>
			</form>
			<?php
				} 
            ?>
	</div>
	<div id="conteiner3">
		<p><a href="">Новинки</a></p>
		<div id="buy1"><a href="rdr.php"><img src="uploads\10.png"></a></div>
		<div id="buy2"><a href="cyberpunk.php"><img src="uploads\6.png"></a></div>
		<div id="buy3"><a href="gow.php"><img src="uploads\8.png"></a></div>
		<div id="buy4"><a href="gt.php"><img src="uploads\7.png"></a></div>
		<div id="buy5"><a href="warframe.php"><img src="uploads\9.png"></a></div>					
	</div>
	<div id="conteiner4">
		<p><a href="">Скидки</a></p>
		<div id="sale1"><a href="ds.php"><img src="uploads\13.png"></a></div>
		<div id="sale2"><a href="detroit.php"><img src="uploads\12.png"></a></div>
		<div id="sale3"><a href="as.php"><img src="uploads\11.png"></a></div>
		<div id="sale4"><a href="valheim.php"><img src="uploads\15.png"></a></div>
		<div id="sale5"><a href="dmc.php"><img src="uploads\16.png"></a></div>					
	</div>

	<div id="conteiner5">
		<p><a href="">Новости мира игр</a></p>
		<div id="news1"><a href="">Сбор средств на русскую озвучку для Alan Wake 2 от GamesVoice успешно завершён. Сегодня завершились сборы в размере 972 тысяч рублей на создание русской озвучки для Alan Wake 2 от студии GamesVoice: команда получила необходимые средства для создания локализации. Для этого ей потребовалось несколько месяцев.
			Ранее GamesVoice говорили о том, что русская озвучка для Alan Wake 2 выйдет уже в 2024-м году. Алан Уэйка снова озвучит Сергей Пономарёв, который озвучил персонажа в оригинальной игре от данной студии. Так же студия пообещала, что попытается привлечь и других актеров из оригинальной игры.
			Сумма сборов не включала в себя озвучку дополнений, поскольку непонятно какого они будут масштаба. Студия уточнила, что если дополнения будут небольшими, то, возможно, удастся выполнить их за свой счёт, в противном случае потребуются дополнительные сборы или спонсорские взносы.
		<img src=""></a></div>
		<div id="news2">Для Mass Effect Legendary Edition вышел "Патч сообщества" 1.6 
			Команда разработчиков Mass Effect Community Patch Team выпустила новое обновление для Mass Effect Legendary Edition. Это обновление призвано исправить ряд проблем, которые были характерны для первого ремастера. Итак, давайте посмотрим на него.
			Патч 1.6 исправляет некоторые проблемы, например, когда визор и респиратор Шепарда накладываются друг на друга. Оно также гарантирует, что некоторые таланты теперь работают так, как нужно. Кроме того, появился скрипт, позволяющий избежать глюков в пользовательских диалогах для женщины-Шепа при использовании модов.
			И это еще не все. Теперь при смене оружия игра не будет убирать выделение на запрошенной силе. И да, Community Patch 1.6 также исправляет некоторые ошибки в различных квестах. Одним словом, последняя версия Community Patch привносит в игру множество QoL-улучшений.
		<a href=""><img src=""></a></div>
		<div id="news3">
				Наиболее интересной платформой для разработчиков является ПК 
				Как и каждый год, в рамках Game Developers Conference проводится соцопрос самых разных разработчиков в игровой индустрии. Свежий отчет был опубликован сегодня, и в нем содержится очень интересная информация о текущих тенденциях в среде разработчиков. В опросе, проводившемся с 11 по 29 октября 2023 года, приняли участие более 3000 представителей индустрии. Одной из обсуждаемых тем была тема любимых платформ разработчиков для создания своих игр.
				Согласно опросу GDC, на вопрос "Какая платформа (платформы) интересует вас как разработчика больше всего?" 62 % опрошенных выбрали ПК. На втором месте - PlayStation 5 с 41 % голосов, а на третьем - преемница Switch с 32 % голосов.
				Важно не забывать, что интерес к одной платформе не означает отсутствия интереса к другой, так как участникам опроса можно было выбрать более одного варианта. В любом случае, это говорит о том, что разработчики гораздо больше заинтересованы в ПК.
				Что же касается платформ, для которых они разрабатывают свой текущий проект, то здесь по-прежнему доминирует ПК: 66 % разработчиков создают игры для этой платформы. PS5 и Xbox Series X|S идут следом, набрав по 35 и 34% голосов соответственно. Примечательно, что 8% разработчиков уже работают над играми для преемницы Nintendo Switch. По слухам, анонс новой консоли Nintendo может состояться уже в этом году
		<a href=""><img src=""></a></div>
	</div>




</div>			


</body>
</html>