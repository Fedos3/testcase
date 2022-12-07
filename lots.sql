-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.2.30
-- Время создания: Дек 07 2022 г., 09:30
-- Версия сервера: 5.7.37-40
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `f0750118_lots`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lots`
--

CREATE TABLE `lots` (
  `lotId` int(10) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startPrice` decimal(10,0) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`lotId`, `link`, `startPrice`, `date`, `status`, `number`) VALUES
(1, 'http://www.arbitat.ru//public/auctions/lots/view/55298/ ', '1469430', '2023-01-16 14:00:00', 'Прием заявок', 14118),
(1, 'http://www.arbitat.ru//public/auctions/lots/view/55299/ ', '1608926', '2023-01-16 14:00:00', 'Прием заявок', 14117),
(1, 'http://www.arbitat.ru//public/auctions/lots/view/55296/ ', '2926000', '2023-01-13 14:00:00', 'Прием заявок', 14115);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
