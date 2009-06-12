-- phpMyAdmin SQL Dump
-- version 3.2.0-rc1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 12 2009 г., 15:52
-- Версия сервера: 5.1.34
-- Версия PHP: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mangos-rus`
--

-- --------------------------------------------------------

--
-- Структура таблицы `config_db`
--

DROP TABLE IF EXISTS `config_db`;
CREATE TABLE IF NOT EXISTS `config_db` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_recalculate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `db` varchar(50) NOT NULL DEFAULT 'mangos',
  `name_rus` varchar(50) NOT NULL,
  `name_orig` varchar(50) NOT NULL,
  `row_rus` int(11) unsigned NOT NULL DEFAULT '0',
  `full_translate` int(11) unsigned NOT NULL DEFAULT '0',
  `row_orig` int(11) unsigned NOT NULL DEFAULT '0',
  `url_orig` varchar(50) DEFAULT NULL,
  `url_rus` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `config_db`
--

INSERT INTO `config_db` (`id`, `last_recalculate`, `db`, `name_rus`, `name_orig`, `row_rus`, `full_translate`, `row_orig`, `url_orig`, `url_rus`, `description`) VALUES
(1, '2009-06-12 15:38:11', 'mangos', 'creature_ai_texts', 'creature_ai_texts', 0, 0, 559, NULL, NULL, 'В этой таблице содержаться тексты, использующиеся в скриптах eventai. Таблица отвечает за текст, тип отображения(сказать/прокричать/сделать жест) и соответствующие звуки или жесты.'),
(2, '2009-06-12 15:38:20', 'mangos', 'locales_achievement_reward', 'achievement_reward', 0, 0, 52, NULL, NULL, 'Данная таблица содержит награды за достижения.'),
(3, '2009-06-12 15:38:30', 'mangos', 'locales_creature', 'creature_template', 19527, 19527, 26300, 'http://www.wowhead.com/?npc=', 'http://ru.wowhead.com/?npc=', 'Таблица используеться для предоставления переведенных названий существ клиентам с определенной локализацией.'),
(4, '2009-06-12 15:38:52', 'mangos', 'locales_gameobject', 'gameobject_template', 15008, 15008, 17004, 'http://www.wowhead.com/?object=', 'http://ru.wowhead.com/?object=', 'Таблица используеться для предоставления переведенных названий игровых объектов клиентам с определенной локализацией.'),
(5, '2009-06-12 15:39:16', 'mangos', 'locales_item', 'item_template', 31257, 31257, 31408, 'http://www.wowhead.com/?item=', 'http://ru.wowhead.com/?item=', 'Таблица используеться для предоставления переведенных названий предметов клиентам с определенной локализацией.'),
(6, '2009-06-12 15:39:54', 'mangos', 'locales_npc_option', 'npc_option', 48, 48, 48, NULL, NULL, 'Таблица используеться для предоставления переведенных диалогов НИП клиентам с определенной локализацией.'),
(7, '2009-06-12 15:40:04', 'mangos', 'locales_npc_text', 'npc_text', 3573, 3493, 5123, NULL, NULL, 'Таблица используеться для предоставления переведенных текстов НИП клиентам с определенной локализацией.'),
(8, '2009-06-12 15:40:23', 'mangos', 'locales_page_text', 'page_text', 1265, 1265, 1624, NULL, NULL, 'Таблица используеться для предоставления переведенных текстов, используемых в предметах, клиентам с определенной локализацией.'),
(9, '2009-06-12 15:40:34', 'mangos', 'locales_points_of_interest', 'points_of_interest', 0, 0, 125, NULL, NULL, 'Таблица используеться для предоставления переведенных названий целей поиска клиентам с определенной локализацией.'),
(10, '2009-06-12 15:41:36', 'mangos', 'locales_quest', 'quest_template', 8414, 4207, 8423, 'http://www.wowhead.com/?quest=', 'http://ru.wowhead.com/?quest=', 'Таблица используеться для предоставления переведенных квестов клиентам с определенной локализацией.'),
(11, '2009-06-12 15:41:55', 'mangos', 'db_script_string', 'db_script_string', 0, 0, 316, NULL, NULL, 'Хранит тексты для скриптов.'),
(12, '2009-06-12 15:42:00', 'mangos', 'mangos_string', 'mangos_string', 260, 260, 649, NULL, NULL, 'Cодержит все сообщения, посылаемые сервером игрокам. Основная цель таблицы - перевод этих сообщений.'),
(13, '2009-06-12 15:42:28', 'scriptdev2', 'custom_texts', 'custom_texts', 0, 0, 0, NULL, NULL, 'Таблица используеться для предоставления переведенных произвольных текстов в SD2 клиентам с определенной локализацией.'),
(14, '2009-06-12 15:42:31', 'scriptdev2', 'script_texts', 'script_texts', 1, 1, 1559, NULL, NULL, 'Таблица используеться для предоставления переведенных сообщений в SD2 клиентам с определенной локализацией.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
