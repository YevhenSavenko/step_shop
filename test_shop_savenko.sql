-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 15 2021 г., 17:51
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_shop_savenko`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin_role` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`customer_id`, `last_name`, `first_name`, `telephone`, `email`, `city`, `password`, `admin_role`) VALUES
(1, 'Півкач', 'Михайло', '+380501111111', 'mykhailo.pivkach@transoftgroup.com', 'Мукачево', '3fc0a7acf087f549ac2b266baf94b8b1', 1),
(2, 'test', 'test', '123', 'test@gmail.com', 'test', 'e20b5cdd013d652e5218da9ca0029c0a', 0),
(3, 'testtest', 'testdtest', '0313137862', 'testtest@gmail.com', 'Mukachevo', 'e6c1ef25b5bcaaacc285489eae10d5e1', 0),
(16, 'Savenko', 'Eugene', '+380999227744', 'zkhanter172@gmail.com007', 'Mukachevo', 'd59a62dc44f354b41469ac42b83ec0a5', 0),
(17, 'Levy', 'Viktor', '+380999227744', 'zkhanter172@gmail.com555', 'Kiev', 'd59a62dc44f354b41469ac42b83ec0a5', 0),
(18, 'Customer', 'Test', '+380999227744', 'customer@gmail.com', 'Chicago', 'd59a62dc44f354b41469ac42b83ec0a5', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `active`, `sort_order`) VALUES
(1, 'Товари', '/product/list', 1, 1),
(2, 'Клієнти', '/customer/list', 1, 2),
(3, 'Тест', '/test/test', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'pk',
  `customer_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fk',
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `first_name`, `last_name`, `telephone`, `email`, `address`, `total`, `date`) VALUES
(38, 18, 'Test', 'Customer', '+380999227744', 'customer@gmail.com', 'Chicago', '60100.00', '2021-06-15 15:45:38'),
(39, 17, 'Viktor', 'Levy', '+380999227744', 'zkhanter172@gmail.com555', 'Kiev', '60000.00', '2021-06-15 15:46:36'),
(40, 17, 'Viktor', 'Levy', '+380999227744', 'zkhanter172@gmail.com555', 'Kiev', '8995.34', '2021-06-15 15:47:10'),
(41, 16, 'Eugene', 'Savenko', '+380999227744', 'zkhanter172@gmail.com007', 'Mukachevo', '340.00', '2021-06-15 15:48:12');

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'pk',
  `order_id` int(11) UNSIGNED NOT NULL COMMENT 'fk',
  `product_id` int(11) UNSIGNED NOT NULL COMMENT 'fk',
  `qty_order` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='basket_product';

--
-- Дамп данных таблицы `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `qty_order`) VALUES
(1, 38, 64, 2),
(2, 38, 65, 1),
(3, 39, 65, 1),
(4, 40, 45, 1),
(5, 40, 68, 2),
(6, 40, 64, 2),
(7, 40, 67, 1),
(8, 41, 64, 2),
(9, 41, 68, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `qty` decimal(12,3) NOT NULL DEFAULT '0.000',
  `description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `qty`, `description`) VALUES
(3, 't00003', 'Телефон 3', '10798.80', '3.000', '<h1>Телефон 3</h1>'),
(45, 'ttt5555555555', 'MotorollaREd', '1355.34', '60.000', 'lorem'),
(63, 'ttt22007', 'Nokia', '2500.00', '10.000', 'Lorem2'),
(64, 'ttt000000', 'Аксесуар', '50.00', '5.000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad facilis officiis perspiciatis expedita totam quidem odit rerum nemo, a, voluptas, exercitationem voluptates laborum sed eum.\r\n'),
(65, 'ttt223456', 'Iphone 25', '60000.00', '60.000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad facilis officiis perspiciatis expedita totam quidem odit rerum nemo, a, voluptas, exercitationem voluptates laborum sed eum.'),
(66, 'ttt893244', 'New Phone', '5000.00', '10.000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad facilis officiis perspiciatis expedita totam quidem odit rerum nemo, a, voluptas, exercitationem voluptates laborum sed eum.'),
(67, 'ttt9034435', 'New Phone 2', '7300.00', '10.000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad facilis officiis perspiciatis expedita totam quidem odit rerum nemo, a, voluptas, exercitationem voluptates laborum sed eum.'),
(68, 'ttt55555553', 'Аксесуар 2', '120.00', '8.000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad facilis officiis perspiciatis expedita totam quidem odit rerum nemo, a, voluptas, exercitationem voluptates laborum sed eum.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'pk', AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'pk', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
