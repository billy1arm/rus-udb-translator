-- phpMyAdmin SQL Dump
-- version 3.2.0-rc1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 07 2009 г., 03:16
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
('title', 'Mangos-Rus'),
('rev_orig', '11'),
('rev_rus', '16');

-- --------------------------------------------------------

--
-- Структура таблицы `config_db`
--

DROP TABLE IF EXISTS `config_db`;
CREATE TABLE IF NOT EXISTS `config_db` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `db` varchar(50) NOT NULL default 'mangos',
  `name_rus` varchar(50) NOT NULL,
  `name_orig` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `config_db`
--

INSERT INTO `config_db` (`id`, `db`, `name_rus`, `name_orig`) VALUES
(1, 'mangos', 'creature_ai_texts', 'creature_ai_texts'),
(2, 'mangos', 'locales_achievement_reward', 'achievement_reward'),
(3, 'mangos', 'locales_creature', 'creature_template'),
(4, 'mangos', 'locales_gameobject', 'gameobject_template'),
(5, 'mangos', 'locales_item', 'item_template'),
(6, 'mangos', 'locales_npc_option', 'npc_option'),
(7, 'mangos', 'locales_npc_text', 'npc_text'),
(8, 'mangos', 'locales_page_text', 'page_text'),
(9, 'mangos', 'locales_points_of_interest', 'points_of_interest'),
(10, 'mangos', 'locales_quest', 'quest_template'),
(11, 'mangos', 'localized_texts', 'localized_texts'),
(12, 'mangos', 'mangos_string', 'mangos_string'),
(13, 'scriptdev2', 'custom_texts', 'custom_texts'),
(14, 'scriptdev2', 'script_texts', 'script_texts');

-- --------------------------------------------------------

--
-- Структура таблицы `config_table`
--

DROP TABLE IF EXISTS `config_table`;
CREATE TABLE IF NOT EXISTS `config_table` (
  `id_table` int(11) NOT NULL,
  `name` varchar(50) NOT NULL default '',
  `custom` bit(1) NOT NULL default b'0',
  `default` bit(1) NOT NULL default b'0',
  `name_orig` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id_table`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config_table`
--

INSERT INTO `config_table` (`id_table`, `name`, `custom`, `default`, `name_orig`) VALUES
(1, 'content', b'0', b'1', 'content_default'),
(2, 'subject', b'0', b'0', 'subject'),
(2, 'text', b'0', b'0', 'text'),
(3, 'name', b'0', b'0', 'name'),
(3, 'subname', b'0', b'0', 'subname'),
(4, 'name', b'0', b'0', 'name'),
(4, 'castbarcaption', b'0', b'0', 'castBarCaption'),
(5, 'name', b'0', b'0', 'name'),
(5, 'description', b'0', b'0', 'description'),
(6, 'option_text', b'0', b'0', 'option_text'),
(6, 'box_text', b'0', b'0', 'box_text'),
(7, 'Text0_0', b'0', b'0', 'text0_0'),
(7, 'Text0_1', b'0', b'0', 'text0_1'),
(7, 'Text1_0', b'0', b'0', 'text1_0'),
(7, 'Text1_1', b'0', b'0', 'text1_1'),
(7, 'Text2_0', b'0', b'0', 'text2_0'),
(7, 'Text2_1', b'0', b'0', 'text2_1'),
(7, 'Text3_0', b'0', b'0', 'text3_0'),
(7, 'Text3_1', b'0', b'0', 'text3_1'),
(7, 'Text4_0', b'0', b'0', 'text4_0'),
(7, 'Text4_1', b'0', b'0', 'text4_1'),
(7, 'Text5_0', b'0', b'0', 'text5_0'),
(7, 'Text5_1', b'0', b'0', 'text5_1'),
(7, 'Text6_0', b'0', b'0', 'text6_0'),
(7, 'Text6_1', b'0', b'0', 'text6_1'),
(7, 'Text7_0', b'0', b'0', 'text7_0'),
(7, 'Text7_1', b'0', b'0', 'text7_1'),
(8, 'Text', b'0', b'0', 'text'),
(9, 'icon_name', b'0', b'0', 'icon_name'),
(10, 'Title', b'0', b'0', 'Title'),
(10, 'Details', b'0', b'0', 'Details'),
(10, 'Objectives', b'0', b'0', 'Objectives'),
(10, 'OfferRewardText', b'0', b'0', 'OfferRewardText'),
(10, 'RequestItemsText', b'0', b'0', 'RequestItemsText'),
(10, 'EndText', b'0', b'0', 'EndText'),
(10, 'ObjectiveText1', b'0', b'0', 'ObjectiveText1'),
(10, 'ObjectiveText2', b'0', b'0', 'ObjectiveText2'),
(10, 'ObjectiveText3', b'0', b'0', 'ObjectiveText3'),
(10, 'ObjectiveText4', b'0', b'0', 'ObjectiveText4'),
(11, 'locale', b'1', b'1', 'locale_0'),
(12, 'content', b'0', b'1', 'content_default'),
(13, 'content', b'0', b'1', 'content_default'),
(14, 'content', b'0', b'1', 'content_default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
