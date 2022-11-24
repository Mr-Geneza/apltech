-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 23 2022 г., 01:21
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `appltech`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1668881668),
('m221119_180927_create_products_table', 1668929300);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `rrp_price` int DEFAULT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `category_name`, `brand_name`, `price`, `rrp_price`, `status`) VALUES
(1, 'Ноутбук Apple MacBook Air Space Gray M2 / 8ГБ / 256SSD / 13.6 / Mac OS Monterey', 'Ноутбуки', 'Apple', 799990, 899990, 1),
(2, 'Ноутбук Acer Predator Triton 300S PT314-51S-51NZ', 'ноутбуки', 'Acer', 549990, 649990, 1),
(3, 'Ноутбук Lenovo IdeaPad L3 I341TUW', 'ноутбуки', 'Lenovo', 209090, 309090, 1),
(4, 'Ноутбук Apple MacBook Pro 14″ M1 Pro/16GB/1TB SSD', 'ноутбуки', 'Apple', 1572990, 1672990, 1),
(5, 'Ноутбук Apple MacBook Pro 14″ M1 Pro/16GB/512GB SSD', 'ноутбуки', 'Apple', 1119990, 1219990, 1),
(6, 'Ноутбук Acer Aspire 3 A315-35-P5TY', 'ноутбуки', 'Acer', 159990, 259990, 1),
(7, 'Ноутбук Acer Swift 3 SF314-511', 'ноутбуки', 'Acer', 299990, 399990, 1),
(8, 'Ноутбук Acer Extensa 15 EX215-52', 'ноутбуки', 'Acer', 359990, 459990, 1),
(9, 'Ноутбук Lenovo Legion 5 15ACH6A', 'ноутбуки', 'Lenovo', 659990, 759990, 1),
(10, 'Ноутбук Lenovo IdeaPad Gaming 3 15ACH6', 'ноутбуки', 'Lenovo', 649990, 749990, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
