-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 30 2024 г., 23:35
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hirmudeMaja`
--

-- --------------------------------------------------------

--
-- Структура таблицы `hirmumaja`
--

CREATE TABLE `hirmumaja` (
  `id` int(11) NOT NULL,
  `kasutajaId` int(35) DEFAULT NULL,
  `sisenes` datetime DEFAULT NULL,
  `lahkus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `hirmumaja`
--

INSERT INTO `hirmumaja` (`id`, `kasutajaId`, `sisenes`, `lahkus`) VALUES
(1, 1, '2024-03-20 05:32:31', '2024-03-21 23:01:47'),
(10, 1, '2024-03-24 15:39:05', '2024-03-28 23:30:18'),
(11, 1, '2024-03-24 22:32:14', '2024-03-28 23:30:17'),
(12, 1, '2024-03-28 23:30:01', '2024-03-28 23:30:15'),
(13, 1, '2024-03-29 17:47:05', NULL),
(14, 9, '2024-03-29 18:17:59', NULL),
(15, 1, '2024-03-31 00:29:08', '2024-03-31 00:29:17');

-- --------------------------------------------------------

--
-- Структура таблицы `kasutaja`
--

CREATE TABLE `kasutaja` (
  `id` int(11) NOT NULL,
  `login` varchar(35) DEFAULT NULL,
  `parool` varchar(50) DEFAULT NULL,
  `onAdmin` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `kasutaja`
--

INSERT INTO `kasutaja` (`id`, `login`, `parool`, `onAdmin`) VALUES
(1, 'maksim', 'suyMO8iwDz0vU', b'0'),
(5, 'admin', 'suyMO8iwDz0vU', b'1'),
(9, 'bogdan', 'su3M3NSSR9yO.', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `makseviis`
--

CREATE TABLE `makseviis` (
  `id` int(11) NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `nimi` varchar(35) DEFAULT NULL,
  `kuni` varchar(5) DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `kasutajaId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `makseviis`
--

INSERT INTO `makseviis` (`id`, `number`, `nimi`, `kuni`, `cvv`, `kasutajaId`) VALUES
(4, '3244 2344 4422 4432', 'art', '23/43', 342, 1),
(6, '2432 6465 3456 5464', 'MAKSI', '34/45', 243, 1),
(7, '3455 4564 4352 5435', 'Bogdan', '24/45', 244, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `pilet`
--

CREATE TABLE `pilet` (
  `id` int(11) NOT NULL,
  `kasutajaId` int(11) DEFAULT NULL,
  `nimi` varchar(35) DEFAULT NULL,
  `ostupaev` datetime DEFAULT NULL,
  `kehtivKuni` datetime DEFAULT NULL,
  `typp` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pilet`
--

INSERT INTO `pilet` (`id`, `kasutajaId`, `nimi`, `ostupaev`, `kehtivKuni`, `typp`) VALUES
(53, 1, 'maksim', NULL, '2025-03-30 21:22:34', 'lapse'),
(54, 1, 'maksim', NULL, '2025-03-30 21:22:34', 'lapse'),
(55, 1, 'maksim', NULL, '2024-09-30 21:23:09', 'soodus'),
(56, 9, 'bogdan', NULL, '2024-09-30 21:25:16', 'tavaline'),
(57, 9, 'bogdan', NULL, '2024-09-30 21:26:04', 'tavaline'),
(58, 9, 'bogdan', NULL, '2025-03-30 21:26:21', 'lapse'),
(59, 9, 'bogdan', NULL, '2024-10-01 00:28:29', 'soodus');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `hirmumaja`
--
ALTER TABLE `hirmumaja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kasutaja_hirmudemaja` (`kasutajaId`);

--
-- Индексы таблицы `kasutaja`
--
ALTER TABLE `kasutaja`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `makseviis`
--
ALTER TABLE `makseviis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kasutaja_makseviis` (`kasutajaId`);

--
-- Индексы таблицы `pilet`
--
ALTER TABLE `pilet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kasutaja_pilet` (`kasutajaId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `hirmumaja`
--
ALTER TABLE `hirmumaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `kasutaja`
--
ALTER TABLE `kasutaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `makseviis`
--
ALTER TABLE `makseviis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `pilet`
--
ALTER TABLE `pilet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `hirmumaja`
--
ALTER TABLE `hirmumaja`
  ADD CONSTRAINT `fk_kasutaja_hirmudemaja` FOREIGN KEY (`kasutajaId`) REFERENCES `kasutaja` (`id`);

--
-- Ограничения внешнего ключа таблицы `makseviis`
--
ALTER TABLE `makseviis`
  ADD CONSTRAINT `fk_kasutaja_makseviis` FOREIGN KEY (`kasutajaId`) REFERENCES `kasutaja` (`id`);

--
-- Ограничения внешнего ключа таблицы `pilet`
--
ALTER TABLE `pilet`
  ADD CONSTRAINT `fk_kasutaja_pilet` FOREIGN KEY (`kasutajaId`) REFERENCES `kasutaja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
