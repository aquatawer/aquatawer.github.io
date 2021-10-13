-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 13 2021 г., 09:12
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sport`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abonement`
--

CREATE TABLE `abonement` (
  `id_abon` int(11) NOT NULL,
  `id_tarif` int(11) NOT NULL,
  `data_sozd` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_okon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `abonement`
--

INSERT INTO `abonement` (`id_abon`, `id_tarif`, `data_sozd`, `data_okon`) VALUES
(2, 2, '09.09.2021', '09.11.2021'),
(3, 3, '15.08.2021', '15.11.2021'),
(4, 1, '10.12.2021', '12.11.2021'),
(5, 2, '10.10.2021', '01.01.1970'),
(6, 4, '10.10.2021', '10.04.2022'),
(7, 4, '10.10.2021', '10.04.2022');

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id_cl` int(11) NOT NULL,
  `fam` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imya` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otch` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_roj` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomer_tel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tr` int(11) DEFAULT NULL,
  `id_abon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id_cl`, `fam`, `imya`, `otch`, `data_roj`, `pol`, `nomer_tel`, `id_tr`, `id_abon`) VALUES
(3, 'Васильев', 'Максим', 'Петрович', '05.11.1999', 'мужской', '89877866941', NULL, 2),
(4, 'Клименко', 'Данил', 'Олегович', '07.21.1999', 'мужской', '89992347683', NULL, 3),
(5, 'Заяц', 'Роза', 'Максимовна', '11.19.2001', 'женский', '89677460832', 2, 4),
(6, 'Касаткин', 'Александр', 'Сергеевич', '20.04.1999', 'мужской', '89347268365', 1, 5),
(7, 'Маглели', 'Илья', 'Олегович', '03.07.2001', 'мужской', '89990372001', 1, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `srok` int(11) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `name`, `opis`, `srok`, `cena`) VALUES
(1, 'Light', 'Свободное посещение, срок на один месяц', 1, 4000),
(2, 'Medium', 'Свободное посещение, на срок 2 месяца', 2, 7000),
(3, 'Medium ', 'Свободное посещение, на срок 3 месяцев', 3, 10000),
(4, 'Full', 'Свободное посещение, на срок полу года', 6, 14000);

-- --------------------------------------------------------

--
-- Структура таблицы `trener`
--

CREATE TABLE `trener` (
  `id_tr` int(11) NOT NULL,
  `fam_tr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imya_tr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otch_tr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_roj_tr` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pol_tr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `trener`
--

INSERT INTO `trener` (`id_tr`, `fam_tr`, `imya_tr`, `otch_tr`, `data_roj_tr`, `pol_tr`) VALUES
(1, 'Васильев', 'Александр', 'Александрович', '12.30.2001', 'мужской'),
(2, 'Ломакина', 'Адель', 'Олеговна', '02.20.1999', 'женский');

-- --------------------------------------------------------

--
-- Структура таблицы `uchet`
--

CREATE TABLE `uchet` (
  `id_zon` int(11) NOT NULL,
  `id_cl` int(11) NOT NULL,
  `data_poseh` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `uchet`
--

INSERT INTO `uchet` (`id_zon`, `id_cl`, `data_poseh`) VALUES
(1, 3, '06.10.2021'),
(2, 4, '06.10.2021'),
(3, 2, '10.10.2021'),
(4, 4, '10.10.2021'),
(5, 5, '10.10.2021'),
(6, 4, '10.11.2021'),
(7, 3, '10.11.2021'),
(8, 3, '10.12.2021'),
(9, 6, '10.12.2021'),
(10, 7, '10.12.2021'),
(11, 3, '10.13.2021'),
(12, 6, '10.13.2021'),
(13, 7, '10.13.2021'),
(14, 4, '10.13.2021');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abonement`
--
ALTER TABLE `abonement`
  ADD PRIMARY KEY (`id_abon`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_cl`),
  ADD KEY `id_abon` (`id_abon`);

--
-- Индексы таблицы `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Индексы таблицы `trener`
--
ALTER TABLE `trener`
  ADD PRIMARY KEY (`id_tr`);

--
-- Индексы таблицы `uchet`
--
ALTER TABLE `uchet`
  ADD PRIMARY KEY (`id_zon`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abonement`
--
ALTER TABLE `abonement`
  MODIFY `id_abon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id_cl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `trener`
--
ALTER TABLE `trener`
  MODIFY `id_tr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `uchet`
--
ALTER TABLE `uchet`
  MODIFY `id_zon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
