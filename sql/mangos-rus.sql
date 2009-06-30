-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Июл 01 2009 г., 02:13
-- Версия сервера: 5.1.32
-- Версия PHP: 5.2.9

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
-- Структура таблицы `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `name` varchar(50) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`name`, `value`) VALUES
('rev_orig', '26'),
('rev_rus', '27'),
('theme', 'default'),
('title', 'Mangos-Rus');

-- --------------------------------------------------------

--
-- Структура таблицы `config_db`
--

DROP TABLE IF EXISTS `config_db`;
CREATE TABLE IF NOT EXISTS `config_db` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_recalculate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `db` enum('mangos','scriptdev2') NOT NULL DEFAULT 'mangos',
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
(1, '2009-06-30 23:51:07', 'mangos', 'creature_ai_texts', 'creature_ai_texts', 1, 1, 559, NULL, NULL, 'В этой таблице содержаться тексты, использующиеся в скриптах eventai. Таблица отвечает за текст, тип отображения(сказать/прокричать/сделать жест) и соответствующие звуки или жесты.'),
(2, '2009-06-30 23:50:27', 'mangos', 'db_script_string', 'db_script_string', 0, 0, 316, NULL, NULL, 'Хранит тексты для скриптов.'),
(3, '2009-06-30 23:51:16', 'mangos', 'locales_achievement_reward', 'achievement_reward', 51, 51, 51, 'http://www.wowhead.com/?achievement=', 'http://ru.wowhead.com/?achievement=', 'Данная таблица содержит награды за достижения.'),
(4, '2009-07-01 00:19:57', 'mangos', 'locales_creature', 'creature_template', 19537, 19537, 27352, 'http://www.wowhead.com/?npc=', 'http://ru.wowhead.com/?npc=', 'Таблица используеться для предоставления переведенных названий существ клиентам с определенной локализацией.'),
(5, '2009-06-30 23:51:21', 'mangos', 'locales_gameobject', 'gameobject_template', 15026, 15026, 17017, 'http://www.wowhead.com/?object=', 'http://ru.wowhead.com/?object=', 'Таблица используеться для предоставления переведенных названий игровых объектов клиентам с определенной локализацией.'),
(6, '2009-06-30 23:51:24', 'mangos', 'locales_item', 'item_template', 31257, 31257, 32671, 'http://www.wowhead.com/?item=', 'http://ru.wowhead.com/?item=', 'Таблица используеться для предоставления переведенных названий предметов клиентам с определенной локализацией.'),
(7, '2009-06-30 23:51:27', 'mangos', 'locales_npc_option', 'npc_option', 48, 48, 48, NULL, NULL, 'Таблица используеться для предоставления переведенных диалогов НИП клиентам с определенной локализацией.'),
(8, '2009-06-30 23:51:30', 'mangos', 'locales_npc_text', 'npc_text', 3579, 3579, 5220, NULL, NULL, 'Таблица используеться для предоставления переведенных текстов НИП клиентам с определенной локализацией.'),
(9, '2009-06-30 23:51:32', 'mangos', 'locales_page_text', 'page_text', 1265, 1265, 1627, NULL, NULL, 'Таблица используеться для предоставления переведенных текстов, используемых в предметах, клиентам с определенной локализацией.'),
(10, '2009-06-30 23:50:50', 'mangos', 'locales_points_of_interest', 'points_of_interest', 0, 0, 125, NULL, NULL, 'Таблица используеться для предоставления переведенных названий целей поиска клиентам с определенной локализацией.'),
(11, '2009-06-30 23:51:38', 'mangos', 'locales_quest', 'quest_template', 8423, 3585, 8423, 'http://www.wowhead.com/?quest=', 'http://ru.wowhead.com/?quest=', 'Таблица используеться для предоставления переведенных квестов клиентам с определенной локализацией.'),
(12, '2009-06-30 23:51:40', 'mangos', 'mangos_string', 'mangos_string', 260, 260, 649, NULL, NULL, 'Cодержит все сообщения, посылаемые сервером игрокам. Основная цель таблицы - перевод этих сообщений.'),
(13, '2009-06-30 23:51:01', 'scriptdev2', 'custom_texts', 'custom_texts', 0, 0, 0, NULL, NULL, 'Таблица используеться для предоставления переведенных произвольных текстов в SD2 клиентам с определенной локализацией.'),
(14, '2009-06-30 23:51:46', 'scriptdev2', 'script_texts', 'script_texts', 1, 1, 1585, NULL, NULL, 'Таблица используеться для предоставления переведенных сообщений в SD2 клиентам с определенной локализацией.');

-- --------------------------------------------------------

--
-- Структура таблицы `config_table`
--

DROP TABLE IF EXISTS `config_table`;
CREATE TABLE IF NOT EXISTS `config_table` (
  `id_table` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `custom` enum('0','1') NOT NULL DEFAULT '0',
  `default` enum('0','1') NOT NULL DEFAULT '0',
  `row_orig_name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_table`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config_table`
--

INSERT INTO `config_table` (`id_table`, `name`, `custom`, `default`, `row_orig_name`, `description`) VALUES
(1, 'content', '0', '1', 'content_default', 'Отсутствует.'),
(2, 'content', '0', '1', 'content_default', 'Отсутствует.'),
(3, 'subject', '0', '0', 'subject', 'Отсутствует.'),
(3, 'text', '0', '0', 'text', 'Отсутствует.'),
(4, 'name', '0', '0', 'name', 'Отсутствует.'),
(4, 'subname', '0', '0', 'subname', 'Отсутствует.'),
(5, 'name', '0', '0', 'name', 'Отсутствует.'),
(5, 'castbarcaption', '0', '0', 'castBarCaption', 'Отсутствует.'),
(6, 'name', '0', '0', 'name', 'Отсутствует.'),
(6, 'description', '0', '0', 'description', 'Отсутствует.'),
(7, 'option_text', '0', '0', 'option_text', 'Отсутствует.'),
(7, 'box_text', '0', '0', 'box_text', 'Отсутствует.'),
(8, 'Text0_0', '0', '0', 'text0_0', 'Отсутствует.'),
(8, 'Text0_1', '0', '0', 'text0_1', 'Отсутствует.'),
(8, 'Text1_0', '0', '0', 'text1_0', 'Отсутствует.'),
(8, 'Text1_1', '0', '0', 'text1_1', 'Отсутствует.'),
(8, 'Text2_0', '0', '0', 'text2_0', 'Отсутствует.'),
(8, 'Text2_1', '0', '0', 'text2_1', 'Отсутствует.'),
(8, 'Text3_0', '0', '0', 'text3_0', 'Отсутствует.'),
(8, 'Text3_1', '0', '0', 'text3_1', 'Отсутствует.'),
(8, 'Text4_0', '0', '0', 'text4_0', 'Отсутствует.'),
(8, 'Text4_1', '0', '0', 'text4_1', 'Отсутствует.'),
(8, 'Text5_0', '0', '0', 'text5_0', 'Отсутствует.'),
(8, 'Text5_1', '0', '0', 'text5_1', 'Отсутствует.'),
(8, 'Text6_0', '0', '0', 'text6_0', 'Отсутствует.'),
(8, 'Text6_1', '0', '0', 'text6_1', 'Отсутствует.'),
(8, 'Text7_0', '0', '0', 'text7_0', 'Отсутствует.'),
(8, 'Text7_1', '0', '0', 'text7_1', 'Отсутствует.'),
(9, 'Text', '0', '0', 'text', 'Отсутствует.'),
(10, 'icon_name', '0', '0', 'icon_name', 'Отсутствует.'),
(11, 'Title', '0', '0', 'Title', 'Отсутствует.'),
(11, 'Details', '0', '0', 'Details', 'Отсутствует.'),
(11, 'Objectives', '0', '0', 'Objectives', 'Отсутствует.'),
(11, 'OfferRewardText', '0', '0', 'OfferRewardText', 'Отсутствует.'),
(11, 'RequestItemsText', '0', '0', 'RequestItemsText', 'Отсутствует.'),
(11, 'EndText', '0', '0', 'EndText', 'Отсутствует.'),
(11, 'ObjectiveText1', '0', '0', 'ObjectiveText1', 'Отсутствует.'),
(11, 'ObjectiveText2', '0', '0', 'ObjectiveText2', 'Отсутствует.'),
(11, 'ObjectiveText3', '0', '0', 'ObjectiveText3', 'Отсутствует.'),
(11, 'ObjectiveText4', '0', '0', 'ObjectiveText4', 'Отсутствует.'),
(12, 'content', '0', '1', 'content_default', 'Отсутствует.'),
(13, 'content', '0', '1', 'content_default', 'Отсутствует.'),
(14, 'content', '0', '1', 'content_default', 'Отсутствует.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
