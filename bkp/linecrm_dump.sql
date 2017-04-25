-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 25 2017 г., 04:06
-- Версия сервера: 5.5.54-0+deb8u1
-- Версия PHP: 7.1.2RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `linecrm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cash`
--

CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(19) NOT NULL,
  `keyhist` int(19) NOT NULL,
  `coin` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cont`
--

CREATE TABLE IF NOT EXISTS `cont` (
  `id` bigint(19) unsigned NOT NULL,
  `fio` varchar(62) DEFAULT NULL,
  `whois` varchar(80) DEFAULT NULL,
  `organis` varchar(93) DEFAULT NULL,
  `emails` varchar(57) DEFAULT NULL,
  `telh` varchar(16) DEFAULT NULL,
  `fax` varchar(16) DEFAULT NULL,
  `mob2` varchar(16) DEFAULT NULL,
  `mob1` varchar(16) DEFAULT NULL,
  `addr` varchar(148) DEFAULT NULL,
  `addrh` varchar(100) DEFAULT NULL,
  `addrw` varchar(80) DEFAULT NULL,
  `web` varchar(43) DEFAULT NULL,
  `birth` char(10) DEFAULT NULL,
  `note` varchar(4000) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `cat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cont`
--

INSERT INTO `cont` (`id`, `fio`, `whois`, `organis`, `emails`, `telh`, `fax`, `mob2`, `mob1`, `addr`, `addrh`, `addrw`, `web`, `birth`, `note`, `foto`, `cat`) VALUES
(1, 'Митро Даш', 'такой парень', '', '', '+89438434334', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `hist`
--

CREATE TABLE IF NOT EXISTS `hist` (
  `keycont` int(19) NOT NULL,
  `dateconn` date DEFAULT NULL COMMENT 'дата',
  `talk` varchar(2000) DEFAULT NULL,
  `work` varchar(2000) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `ready` int(1) unsigned DEFAULT NULL,
  `id` bigint(19) NOT NULL,
  `schedule` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='для записи истории общения с соответствующим контактом';

--
-- Дамп данных таблицы `hist`
--

INSERT INTO `hist` (`keycont`, `dateconn`, `talk`, `work`, `status`, `ready`, `id`, `schedule`) VALUES
(1, '2017-04-25', 'Сделать сайт интертул', '', 0, 0, 1, '2017-04-25');

-- --------------------------------------------------------

--
-- Структура таблицы `impr`
--

CREATE TABLE IF NOT EXISTS `impr` (
  `id` int(19) NOT NULL,
  `todo` varchar(2000) NOT NULL,
  `when` datetime DEFAULT NULL,
  `fix` int(1) DEFAULT '0',
  `fixdate` date DEFAULT NULL,
  `rev` char(10) NOT NULL,
  `developerid` int(19) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `impr`
--

INSERT INTO `impr` (`id`, `todo`, `when`, `fix`, `fixdate`, `rev`, `developerid`) VALUES
(30, 'Доделать раздел "TO-DO linecrm" (задачи для разработки linecrm)', '2013-04-05 06:01:54', 1, '2013-04-05', '3.4', 0),
(31, 'Сделать раздел "Ошибки" (задачи для доработки linecrm)', '2013-04-05 06:18:43', 1, '2013-04-05', '3.5', 0),
(32, 'Доделать разделы:\r\n	"Товары" - выбираются все доступные товары с ценами для прайса;', '2013-04-05 06:19:13', 0, '2013-10-05', '5.2', 0),
(33, 'Сделать разделы:"Отчёты"-(выбирается тип отчета: денежные поступления(опция за нужный период),\r\n					 долги (кто сколько должен),\r\n					 активность клиентов(топ 100),\r\n					 СРЕДНЯЯ ДОХОДНОСТЬ С КЛИЕНТОВ ТОП20 (за месячный период),\r\n					 неактивные клиенты для обвона).\r\n	', '2013-04-05 06:20:00', 0, '2013-08-25', '4.1', 0),
(34, 'Доделать разделы:"Настройка"-(выбирается настройка интерфейса в котором есть раздел "TO-DO linecrm")', '2013-04-05 06:20:50', 1, '2013-04-09', '3.7', 0),
(35, 'Регистрацию нескольких пользователей с различными правами допуска,', '2013-04-05 06:21:17', 0, '2013-09-09', '5.1', 0),
(36, 'Занесение заказа и выдача акта выполненных работ по услуге,', '2013-04-05 06:21:35', 0, '2013-10-06', '5.3', 0),
(37, 'Перевести некоторый функционал на AJAX-технологию,', '2013-04-05 06:21:46', 0, '0000-00-00', '7', 0),
(38, 'Поддержка базы данных Oracle 9/10/11,', '2013-04-05 06:22:09', 0, '2013-08-23', '4', 0),
(39, 'Создание современного интерфейса для сайта (скорее всего на MODX),', '2013-04-05 06:22:25', 0, '0000-00-00', '8', 0),
(40, 'Проведение аналитики по различным критериям, в том числе и создание воронки продаж', '2013-04-05 06:22:35', 0, '0000-00-00', '8', 0),
(41, 'Импорт-экспорт, ETL технологии, отчёты - вот отсюда начнутся коммерческие релизы.', '2013-04-05 06:22:48', 0, '0000-00-00', '9', 0),
(42, 'Сделать процесс проекта для занесения инфы про прозвоненые номера и отосланные письма', '2013-04-05 06:27:32', 0, '2013-10-08', '5.7', 0),
(43, 'Создание почтового модуля.', '2013-04-05 08:52:50', 0, '2013-10-07', '5.4', 0),
(44, 'при редактировании истории не вносится сумма https://127.1/edittalk.php?id=108', '2013-04-07 14:17:30', 1, '0000-00-00', '', NULL),
(45, 'https://127.1/edittalk.php?id=116  не добавился соин на 120', '2013-04-09 00:31:01', 1, '0000-00-00', '', NULL),
(46, 'https://127.0.0.1/loginproc.phpWarning: mysqli::mysqli() [mysqli.mysqli]: (28000/1045): Access denied for user ''linecrm''@''localhost'' (using password: YES) in /var/www/linecrm/set_config.php on line 7Подключится к БД linecrm не удалось!', '2013-05-03 15:42:03', 1, '0000-00-00', '', NULL),
(47, 'ошибка bug https://127.0.0.1/loginproc.phpWarning: mysqli::mysqli() [mysqli.mysqli]:  --попало в два раздела одновременно', '2013-05-03 15:44:53', 1, '0000-00-00', '', NULL),
(49, 'когда пишешь новую историю  и сохраняешь её то она не закрывается и в поле статуса не стоит галочка', '2013-06-27 11:02:39', 1, '0000-00-00', '', NULL),
(50, 'добавить графу результат с графой под новым названием "заказ"', '2013-06-27 11:03:39', 1, '2013-06-30', '', NULL),
(51, 'не отобразился приход в 70 https://127.0.0.1/edittalk.php?id=141', '2013-07-26 00:30:58', 1, '2013-07-26', '', NULL),
(52, 'Перевод всего и вся на ООП PHP', '2013-08-16 17:10:56', 0, '2013-09-01', '5.0', NULL),
(53, '127.0.0.1/listtask.php Вы можете добавить новую запись. ЛИШНЕЕ!!!', '2013-08-30 21:32:33', 1, '2013-09-04', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--

CREATE TABLE IF NOT EXISTS `price` (
  `id` int(19) NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `descript` varchar(99) DEFAULT NULL,
  `state` varchar(12) DEFAULT NULL,
  `delivery` varchar(10) DEFAULT NULL,
  `warranty` varchar(6) DEFAULT NULL,
  `cost` int(7) DEFAULT NULL,
  `terms` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `price`
--

INSERT INTO `price` (`id`, `name`, `descript`, `state`, `delivery`, `warranty`, `cost`, `terms`) VALUES
(1, 'Диагностика', 'маркетинг бизнеса и потребностей клиента', '', '', '', 100, ''),
(3, 'Прототип сайта', 'версия сайта с демо данными для демо', '', '', '', 510, ''),
(4, 'Инфраструктура', 'подбор сервера и учет стоимост хостинга	', '', '', '', 1000, ''),
(5, 'Домен', 'исследование портфеля торговых марок и унакальности доменов', '', '', '', 1000, ''),
(6, 'Логотип', 'Дизайн логотипа с учетом матрицы бизнес услуг', '', '', '', 1000, ''),
(7, 'Пользователи', 'Определение целевой аудитории сайта', '', '', '', 1000, ''),
(8, 'Данные', 'Сбор существующих данных и подбор варианта размещения на сайте', '', '', '', 2000, 'c диска заказчика'),
(9, 'Сайт', 'Создание сайта и размещение на хостинге', '', '', '', 5000, 'программы freeware'),
(10, 'Обслуживание', 'настройка всех программ для работы сотрудников с сайтом', '', '', '', 1500, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(19) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `birth` date DEFAULT NULL,
  `province` varchar(14) DEFAULT NULL,
  `activity` varchar(14) DEFAULT NULL,
  `web` char(128) DEFAULT NULL,
  `pass` char(40) DEFAULT NULL,
  `tel` char(32) DEFAULT NULL,
  `email` varchar(25) NOT NULL DEFAULT 'none',
  `allow` int(1) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `tincoming` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `developer` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `birth`, `province`, `activity`, `web`, `pass`, `tel`, `email`, `allow`, `note`, `tincoming`, `developer`) VALUES
(1, 'adm', NULL, 'Город', 'web programmer', NULL, 'e1160de876256b53582c0eb4d44bd794', 'none', 'mailadmin@mail.com', 1, NULL, '2012-11-05 12:32:20', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cont`
--
ALTER TABLE `cont`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hist`
--
ALTER TABLE `hist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `impr`
--
ALTER TABLE `impr`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `cont`
--
ALTER TABLE `cont`
  MODIFY `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `hist`
--
ALTER TABLE `hist`
  MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `impr`
--
ALTER TABLE `impr`
  MODIFY `id` int(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT для таблицы `price`
--
ALTER TABLE `price`
  MODIFY `id` int(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(19) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
