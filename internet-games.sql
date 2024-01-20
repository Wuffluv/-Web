-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 20 2024 г., 06:51
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `internet-games`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `game_id`, `quantity`) VALUES
(2, 19, 17, 1),
(5, 19, 16, 1),
(7, 21, 20, 1),
(14, 17, 14, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `developer`
--

CREATE TABLE `developer` (
  `Имя разработчика` text NOT NULL,
  `Название компании` text NOT NULL,
  `Игры` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE `game` (
  `Разработчик` text NOT NULL,
  `Название` text NOT NULL,
  `Цена` int(11) NOT NULL,
  `Категория` text NOT NULL,
  `Возраст` text NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`Разработчик`, `Название`, `Цена`, `Категория`, `Возраст`, `ID`) VALUES
('Rockstar', 'Red Dead Redemption 2', 3000, 'Action', '18+', 14),
('Sony', 'Gran Turismo 7', 4250, 'Tracer', '12+', 15),
('Sony', 'God of War', 3500, 'RPG', '16+', 16),
('CD Project RED', 'Cyberpunk 2077', 2700, 'RPG', '18+', 17),
('DE', 'Warframe', 1200, 'Action', '17+', 18),
('Ubisoft', 'Assasins Creed Unity', 2700, 'Stealth', '18+', 19),
('Aeron Gate', 'Valheim', 435, 'RPG', '16+', 20),
('Sony', 'Detroit Become Human', 4300, 'Filmic game', '17+', 21),
('FromSoftware inc', 'Dark Souls III', 3000, 'RPG', '18+', 22),
('Arkane Studios', 'Dishonored 2', 2599, 'Action', '18+', 23),
('CAPCOM', 'Devil May Cry 5', 3799, 'Slasher', '18+', 24);

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `game_id`, `quantity`, `total_price`, `timestamp`) VALUES
(1, 17, 16, 1, 0.00, '2024-01-20 05:09:06'),
(2, 17, 14, 1, 0.00, '2024-01-20 05:10:26'),
(3, 17, 14, 1, 0.00, '2024-01-20 05:11:50'),
(4, 17, 17, 1, 0.00, '2024-01-20 05:13:28');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(319) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'buyer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(17, 'wuffluv', 'wuffluv@yandex.ru', 'cdefe5127f4f35e86aab694556139f2e', 'buyer'),
(18, 'admin', 'admin@yandex.ru', 'cdefe5127f4f35e86aab694556139f2e', 'admin'),
(19, 'Endlesslyd', 'endlf@yadne.ru', 'cdefe5127f4f35e86aab694556139f2e', 'buyer'),
(20, 'Endlesslyd', 'vip.lelik@mail.ru', 'cdefe5127f4f35e86aab694556139f2e', 'buyer'),
(21, 'Nierds', 'ndisa@sa.ru', 'cdefe5127f4f35e86aab694556139f2e', 'buyer');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `game`
--
ALTER TABLE `game`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`ID`);

--
-- Ограничения внешнего ключа таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
