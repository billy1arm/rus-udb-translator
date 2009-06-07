-- phpMyAdmin SQL Dump
-- version 3.2.0-rc1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 07 2009 г., 23:20
-- Версия сервера: 5.0.77
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
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`name`, `value`) VALUES
('rev_orig', '11'),
('rev_rus', '16'),
('theme', 'default'),
('title', 'Mangos-Rus');

-- --------------------------------------------------------

--
-- Структура таблицы `config_db`
--

DROP TABLE IF EXISTS `config_db`;
CREATE TABLE IF NOT EXISTS `config_db` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `last_recalculate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `db` varchar(50) NOT NULL default 'mangos',
  `name_rus` varchar(50) NOT NULL,
  `name_orig` varchar(50) NOT NULL,
  `row_rus` int(11) unsigned NOT NULL default '0',
  `full_translate` int(11) unsigned NOT NULL default '0',
  `row_orig` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `config_db`
--

INSERT INTO `config_db` (`id`, `last_recalculate`, `db`, `name_rus`, `name_orig`, `row_rus`, `full_translate`, `row_orig`) VALUES
(1, '2009-06-07 23:07:01', 'mangos', 'creature_ai_texts', 'creature_ai_texts', 0, 0, 559),
(2, '2009-06-07 23:13:44', 'mangos', 'locales_achievement_reward', 'achievement_reward', 0, 0, 9),
(3, '2009-06-07 23:07:09', 'mangos', 'locales_creature', 'creature_template', 19527, 19527, 26300),
(4, '2009-06-07 23:07:16', 'mangos', 'locales_gameobject', 'gameobject_template', 15008, 15008, 17004),
(5, '2009-06-07 23:07:19', 'mangos', 'locales_item', 'item_template', 31257, 31257, 31408),
(6, '2009-06-07 23:07:22', 'mangos', 'locales_npc_option', 'npc_option', 48, 48, 48),
(7, '2009-06-07 23:07:25', 'mangos', 'locales_npc_text', 'npc_text', 5120, 5120, 5123),
(8, '2009-06-07 23:11:20', 'mangos', 'locales_page_text', 'page_text', 1265, 1265, 1624),
(9, '2009-06-07 23:07:36', 'mangos', 'locales_points_of_interest', 'points_of_interest', 0, 0, 125),
(10, '2009-06-07 23:07:43', 'mangos', 'locales_quest', 'quest_template', 8414, 8414, 8423),
(11, '2009-06-07 23:07:45', 'mangos', 'localized_texts', 'localized_texts', 1, 1, 177),
(12, '2009-06-07 23:07:48', 'mangos', 'mangos_string', 'mangos_string', 260, 260, 649),
(13, '2009-06-07 23:08:11', 'scriptdev2', 'custom_texts', 'custom_texts', 0, 0, 0),
(14, '2009-06-07 23:08:14', 'scriptdev2', 'script_texts', 'script_texts', 1, 1, 1516);

-- --------------------------------------------------------

--
-- Структура таблицы `config_table`
--

DROP TABLE IF EXISTS `config_table`;
CREATE TABLE IF NOT EXISTS `config_table` (
  `id_table` int(11) NOT NULL,
  `name` varchar(50) NOT NULL default '',
  `custom` tinyint(1) NOT NULL default '0',
  `default` tinyint(1) NOT NULL default '0',
  `row_orig_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id_table`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config_table`
--

INSERT INTO `config_table` (`id_table`, `name`, `custom`, `default`, `row_orig_name`) VALUES
(1, 'content', 0, 1, 'content_default'),
(2, 'subject', 0, 0, 'subject'),
(2, 'text', 0, 0, 'text'),
(3, 'name', 0, 0, 'name'),
(3, 'subname', 0, 0, 'subname'),
(4, 'name', 0, 0, 'name'),
(4, 'castbarcaption', 0, 0, 'castBarCaption'),
(5, 'name', 0, 0, 'name'),
(5, 'description', 0, 0, 'description'),
(6, 'option_text', 0, 0, 'option_text'),
(6, 'box_text', 0, 0, 'box_text'),
(7, 'Text0_0', 0, 0, 'text0_0'),
(7, 'Text0_1', 0, 0, 'text0_1'),
(7, 'Text1_0', 0, 0, 'text1_0'),
(7, 'Text1_1', 0, 0, 'text1_1'),
(7, 'Text2_0', 0, 0, 'text2_0'),
(7, 'Text2_1', 0, 0, 'text2_1'),
(7, 'Text3_0', 0, 0, 'text3_0'),
(7, 'Text3_1', 0, 0, 'text3_1'),
(7, 'Text4_0', 0, 0, 'text4_0'),
(7, 'Text4_1', 0, 0, 'text4_1'),
(7, 'Text5_0', 0, 0, 'text5_0'),
(7, 'Text5_1', 0, 0, 'text5_1'),
(7, 'Text6_0', 0, 0, 'text6_0'),
(7, 'Text6_1', 0, 0, 'text6_1'),
(7, 'Text7_0', 0, 0, 'text7_0'),
(7, 'Text7_1', 0, 0, 'text7_1'),
(8, 'Text', 0, 0, 'text'),
(9, 'icon_name', 0, 0, 'icon_name'),
(10, 'Title', 0, 0, 'Title'),
(10, 'Details', 0, 0, 'Details'),
(10, 'Objectives', 0, 0, 'Objectives'),
(10, 'OfferRewardText', 0, 0, 'OfferRewardText'),
(10, 'RequestItemsText', 0, 0, 'RequestItemsText'),
(10, 'EndText', 0, 0, 'EndText'),
(10, 'ObjectiveText1', 0, 0, 'ObjectiveText1'),
(10, 'ObjectiveText2', 0, 0, 'ObjectiveText2'),
(10, 'ObjectiveText3', 0, 0, 'ObjectiveText3'),
(10, 'ObjectiveText4', 0, 0, 'ObjectiveText4'),
(11, 'locale_0,locale_8', 1, 0, 'locale_0'),
(12, 'content', 0, 1, 'content_default'),
(13, 'content', 0, 1, 'content_default'),
(14, 'content', 0, 1, 'content_default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
