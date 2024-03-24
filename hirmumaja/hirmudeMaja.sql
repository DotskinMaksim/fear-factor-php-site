-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 24 2024 г., 16:06
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
(10, 1, '2024-03-24 15:39:05', NULL);

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
(5, 'admin', 'suyMO8iwDz0vU', b'1');

-- --------------------------------------------------------

--
-- Структура таблицы `pilet`
--

CREATE TABLE `pilet` (
  `id` int(11) NOT NULL,
  `kasutajaId` int(11) DEFAULT NULL,
  `nimi` varchar(35) DEFAULT NULL,
  `ostupaev` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pilet`
--

INSERT INTO `pilet` (`id`, `kasutajaId`, `nimi`, `ostupaev`) VALUES
(25, 1, 'maksim', '2024-03-24 15:37:45'),
(26, 1, 'maksim', '2024-03-24 15:37:45'),
(27, 1, 'maksim', '2024-03-24 15:37:45');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `kasutaja`
--
ALTER TABLE `kasutaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `pilet`
--
ALTER TABLE `pilet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `hirmumaja`
--
ALTER TABLE `hirmumaja`
  ADD CONSTRAINT `fk_kasutaja_hirmudemaja` FOREIGN KEY (`kasutajaId`) REFERENCES `kasutaja` (`id`);

--
-- Ограничения внешнего ключа таблицы `pilet`
--
ALTER TABLE `pilet`
  ADD CONSTRAINT `fk_kasutaja_pilet` FOREIGN KEY (`kasutajaId`) REFERENCES `kasutaja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
