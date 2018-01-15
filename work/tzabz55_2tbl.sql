-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 21 2017 г., 15:05
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tzabz55`
--

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `parent_id`, `position`, `salary`, `created_at`, `updated_at`) VALUES
(1, 0, 'председатель правления', 5000, NULL, NULL),
(2, 1, 'зам. председателя правления 1', 2500, NULL, NULL),
(3, 1, 'зам. председателя правления 2', 2500, NULL, NULL),
(4, 1, 'зам. председателя правления 3', 2500, NULL, NULL),
(5, 1, 'зам. председателя правления 4', 2500, NULL, NULL),
(6, 1, 'зам. председателя правления 5', 2500, NULL, NULL),
(7, 2, 'начальник валютного департамента', 1500, NULL, NULL),
(8, 3, 'начальник финансового департамента', 1500, NULL, NULL),
(9, 4, 'начальник департамента по юр лицам', 1500, NULL, NULL),
(10, 5, 'начальник департамента по физ лицам и чп', 1500, NULL, NULL),
(11, 6, 'начальник департамента по филиалам', 1500, NULL, NULL),
(12, 7, 'нач. валютного отдела 1', 1000, NULL, NULL),
(13, 7, 'нач. валютного отдела 2', 1000, NULL, NULL),
(14, 7, 'нач. валютного отдела 3', 1000, NULL, NULL),
(15, 8, 'нач. финансового отдела 1', 1000, NULL, NULL),
(16, 8, 'нач. финансового отдела 2', 1000, NULL, NULL),
(17, 8, 'нач. финансового отдела 3', 1000, NULL, NULL),
(18, 9, 'нач. отдела по юр лицам 1', 1000, NULL, NULL),
(19, 9, 'нач. отдела по юр лицам 2', 1000, NULL, NULL),
(20, 9, 'нач. отдела по юр лицам 3', 1000, NULL, NULL),
(21, 10, 'нач. отдела по физ лицам и чп 1', 1000, NULL, NULL),
(22, 10, 'нач. отдела по физ лицам и чп 2', 1000, NULL, NULL),
(23, 10, 'нач. отдела по физ лицам и чп 3', 1000, NULL, NULL),
(24, 11, 'нач. отдела 1 филиалов', 1000, NULL, NULL),
(25, 11, 'нач. отдела 2 филиалов', 1000, NULL, NULL),
(26, 11, 'нач. отдела 3 филиалов', 1000, NULL, NULL),
(27, 12, 'старший менеджер валютного отдела 1', 600, NULL, NULL),
(28, 12, 'менеджер валютного отдела 1', 500, NULL, NULL),
(29, 12, 'бухгалтер валютного отдела 1', 600, NULL, NULL),
(30, 13, 'старший менеджер валютного отдела 2', 600, NULL, NULL),
(31, 13, 'менеджер валютного отдела 2', 500, NULL, NULL),
(32, 13, 'бухгалтер валютного отдела 2', 600, NULL, NULL),
(33, 14, 'старший менеджер валютного отдела 3', 600, NULL, NULL),
(34, 14, 'менеджер валютного отдела 3', 500, NULL, NULL),
(35, 14, 'бухгалтер валютного отдела 3', 600, NULL, NULL),
(36, 15, 'старший менеджер финансового отдела 1', 600, NULL, NULL),
(37, 15, 'менеджер финансового отдела 1', 500, NULL, NULL),
(38, 15, 'бухгалтер финансового отдела 1', 600, NULL, NULL),
(39, 16, 'старший менеджер финансового отдела 2', 600, NULL, NULL),
(40, 16, 'менеджер финансового отдела 2', 500, NULL, NULL),
(41, 16, 'бухгалтер финансового отдела 2', 600, NULL, NULL),
(42, 17, 'старший менеджер финансового отдела 3', 600, NULL, NULL),
(43, 17, 'менеджер финансового отдела 3', 500, NULL, NULL),
(44, 17, 'бухгалтер финансового отдела 3', 600, NULL, NULL),
(45, 18, 'старший менеджер отдела юр. лиц 1', 600, NULL, NULL),
(46, 18, 'менеджер менеджер отдела юр. лиц 1', 500, NULL, NULL),
(47, 18, 'бухгалтер отдела юр. лиц 1', 600, NULL, NULL),
(48, 19, 'старший менеджер отдела юр. лиц 2', 600, NULL, NULL),
(49, 19, 'менеджер менеджер отдела юр. лиц 2', 500, NULL, NULL),
(50, 19, 'бухгалтер отдела юр. лиц 2', 600, NULL, NULL),
(51, 20, 'старший менеджер отдела юр. лиц 3', 600, NULL, NULL),
(52, 20, 'менеджер менеджер отдела юр. лиц 3', 500, NULL, NULL),
(53, 20, 'бухгалтер отдела юр. лиц 3', 600, NULL, NULL),
(54, 21, 'старший менеджер отдела физ. лиц и чп 1', 600, NULL, NULL),
(55, 21, 'менеджер отдела физ. лиц и чп 1', 500, NULL, NULL),
(56, 21, 'бухгалтер отдела физ. лиц и чп 1', 600, NULL, NULL),
(57, 22, 'старший менеджер отдела физ. лиц и чп 2', 600, NULL, NULL),
(58, 22, 'менеджер отдела физ. лиц и чп 2', 500, NULL, NULL),
(59, 22, 'бухгалтер отдела физ. лиц и чп 2', 600, NULL, NULL),
(60, 23, 'старший менеджер отдела физ. лиц и чп 3', 600, NULL, NULL),
(61, 23, 'менеджер отдела физ. лиц и чп 3', 500, NULL, NULL),
(62, 23, 'бухгалтер отдела физ. лиц и чп 3', 600, NULL, NULL),
(63, 24, 'старший менеджер отдела 1 филиалов', 500, NULL, NULL),
(64, 24, 'менеджер отдела 1 филиалов', 450, NULL, NULL),
(65, 24, 'бухгалтер отдела 1 филиалов', 500, NULL, NULL),
(66, 25, 'старший менеджер отдела 2 филиалов', 500, NULL, NULL),
(67, 25, 'менеджер отдела 2 филиалов', 450, NULL, NULL),
(68, 25, 'бухгалтер отдела 2 филиалов', 500, NULL, NULL),
(69, 26, 'старший менеджер отдела 3 филиалов', 500, NULL, NULL),
(70, 26, 'менеджер отдела 3 филиалов', 450, NULL, NULL),
(71, 26, 'бухгалтер отдела 3 филиалов', 500, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employed_at` date NOT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT для таблицы `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
