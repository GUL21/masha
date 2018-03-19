-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 02 2018 г., 02:02
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `MASHA`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buy_products`
--

CREATE TABLE `buy_products` (
  `buy_id` int(11) NOT NULL,
  `buy_id_order` int(11) NOT NULL,
  `buy_id_product` int(11) NOT NULL,
  `buy_count_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buy_products`
--

INSERT INTO `buy_products` (`buy_id`, `buy_id_order`, `buy_id_product`, `buy_count_product`) VALUES
(11, 1, 1, 2),
(12, 2, 2, 5),
(13, 3, 1, 7),
(14, 4, 2, 1),
(15, 5, 2, 1),
(16, 5, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_id_product` int(11) NOT NULL,
  `cart_price` int(11) NOT NULL,
  `cart_count` int(11) NOT NULL DEFAULT '1',
  `cart_datetime` datetime NOT NULL,
  `cart_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_id_product`, `cart_price`, `cart_count`, `cart_datetime`, `cart_ip`) VALUES
(20, 1, 150, 3, '2018-03-01 14:39:07', '127.0.0.1'),
(21, 2, 60, 3, '2018-03-01 15:11:40', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `picture` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `praznik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `picture`, `type`, `praznik`) VALUES
(1, 'decorate.png', 'Украшения', 'Новый год'),
(2, 'toy.png', 'Игрушки', 'Новый год'),
(3, 'miha.png', 'Празничные игрушки', 'День влюблённых');

-- --------------------------------------------------------

--
-- Структура таблицы `celebrations`
--

CREATE TABLE `celebrations` (
  `cel_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `celebration` varchar(255) NOT NULL,
  `music` varchar(255) NOT NULL,
  `basket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `celebrations`
--

INSERT INTO `celebrations` (`cel_id`, `img`, `celebration`, `music`, `basket`) VALUES
(1, 'year.gif', 'Новый год', 'zima.mp3', 'sapog.png'),
(2, 'heart.gif', 'День влюблённых', 'love.wav', 'heart.png'),
(3, '8.gif', '8 марта', '8.mp3', '8.png'),
(4, 'easter.gif', 'Пасха', '', 'basket.png'),
(5, 'deti.gif', 'День защиты детей', '', 'motilek.png'),
(6, 'birth.gif', 'День рождения', 'birthday.mp3', 'podarok.png'),
(7, 'september.gif', 'День знаний', '', '1.png'),
(8, '19.gif', 'День Святого Николая', '', 'nikolay.png'),
(9, 'svadba.gif', 'Свадьба', '', 'kolca.png');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `order_confirmed` varchar(10) NOT NULL,
  `order_dostavka` varchar(255) NOT NULL,
  `order_pay` varchar(50) NOT NULL,
  `order_type_pay` varchar(100) NOT NULL,
  `order_fio` text NOT NULL,
  `order_address` text NOT NULL,
  `order_phone` varchar(50) NOT NULL,
  `order_note` text NOT NULL,
  `order_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `order_datetime`, `order_confirmed`, `order_dostavka`, `order_pay`, `order_type_pay`, `order_fio`, `order_address`, `order_phone`, `order_note`, `order_email`) VALUES
(1, '2018-02-26 13:23:15', '', 'Курьером', '', '', 'hntsxth', '', '', '', 'xfmmmxf'),
(2, '2018-02-26 16:46:56', '', '', '', '', '', '', '', '', ''),
(3, '2018-02-27 20:22:12', '', '', '', '', '', '', '', '', ''),
(4, '2018-03-01 13:10:00', '', '', '', '', '', '', '', '', ''),
(5, '2018-03-01 13:33:38', '', 'Курьером', '', '', 'Гулько Елена Владимировна', 'г. Бар, 2 отделение', '0985399377', 'Срочно!', 'elena@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `table_products`
--

CREATE TABLE `table_products` (
  `products_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '0',
  `type_tovara` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `table_products`
--

INSERT INTO `table_products` (`products_id`, `title`, `price`, `image`, `visible`, `type_tovara`) VALUES
(1, 'Украшенная бутылка шампанского', 150, 'butilka-1.png', 1, 'Украшения'),
(2, 'Игрушка на ёлку \"Птичка\"', 60, 'bird.png', 1, 'Игрушки');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buy_products`
--
ALTER TABLE `buy_products`
  ADD PRIMARY KEY (`buy_id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `celebrations`
--
ALTER TABLE `celebrations`
  ADD PRIMARY KEY (`cel_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `table_products`
--
ALTER TABLE `table_products`
  ADD PRIMARY KEY (`products_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buy_products`
--
ALTER TABLE `buy_products`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `celebrations`
--
ALTER TABLE `celebrations`
  MODIFY `cel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `table_products`
--
ALTER TABLE `table_products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
