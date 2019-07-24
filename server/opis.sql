-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-11 04:35:00
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opis`
--

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_audit`
--

CREATE TABLE IF NOT EXISTS `op_admin_audit` (
  `id` mediumint(9) NOT NULL,
  `apply` tinyint(4) NOT NULL DEFAULT '0',
  `audit` tinyint(4) DEFAULT NULL,
  `apply_time` int(11) DEFAULT NULL,
  `audit_time` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_group`
--

CREATE TABLE IF NOT EXISTS `op_admin_group` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `op_admin_group`
--

INSERT INTO `op_admin_group` (`id`, `title`, `status`, `rules`) VALUES
(28, '超级管理组', 1, '85,86,87'),
(29, 'test', 1, '89,90');

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_group_access`
--

CREATE TABLE IF NOT EXISTS `op_admin_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `op_admin_group_access`
--

INSERT INTO `op_admin_group_access` (`uid`, `group_id`) VALUES
(1, 28),
(2, 29);

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_rule`
--

CREATE TABLE IF NOT EXISTS `op_admin_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `pid` smallint(5) NOT NULL COMMENT '父级ID',
  `sort` smallint(5) DEFAULT NULL COMMENT '排序',
  `condition` varchar(20) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- 转存表中的数据 `op_admin_rule`
--

INSERT INTO `op_admin_rule` (`id`, `name`, `title`, `type`, `status`, `pid`, `sort`, `condition`, `create_time`) VALUES
(95, 'Program/lists', '节目单列表', 1, 1, 91, NULL, NULL, NULL),
(96, 'Program/add', '增加节目单', 1, 1, 91, NULL, NULL, NULL),
(88, 'Media/index', '素材管理', 1, 1, 0, NULL, NULL, NULL),
(89, 'Media/lists', '素材列表', 1, 1, 88, NULL, NULL, NULL),
(90, 'Media/add', '增加素材', 1, 1, 88, NULL, NULL, NULL),
(91, 'Program', '节目编辑', 1, 1, 0, NULL, NULL, NULL),
(92, 'Device', '设备管理', 1, 1, 0, NULL, NULL, NULL),
(93, 'Publish', '发布管理', 1, 1, 0, NULL, NULL, NULL),
(94, 'Log', '日志管理', 1, 1, 0, NULL, NULL, NULL),
(97, 'Device/lists', '设备列表', 1, 1, 92, NULL, NULL, NULL),
(98, 'Publish/index', '发布节目', 1, 1, 93, NULL, NULL, NULL),
(99, 'Info/index', '发布信息', 1, 1, 93, NULL, NULL, NULL),
(100, 'Order/index', '发布指令', 1, 1, 93, NULL, NULL, NULL),
(101, 'Log/program', '节目日志', 1, 1, 94, NULL, NULL, NULL),
(102, 'Log/info', '信息日志', 1, 1, 94, NULL, NULL, NULL),
(103, 'Log/order', '指令日志', 1, 1, 94, NULL, NULL, NULL),
(104, 'Log/device', '设备日志', 1, 1, 94, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_user`
--

CREATE TABLE IF NOT EXISTS `op_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `account` varchar(32) DEFAULT NULL COMMENT '管理员账号',
  `password` varchar(36) DEFAULT NULL COMMENT '管理员密码',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `login_count` mediumint(8) NOT NULL COMMENT '登录次数',
  `email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账户状态，禁用为0   启用为1',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `op_admin_user`
--

INSERT INTO `op_admin_user` (`id`, `account`, `password`, `mobile`, `login_time`, `login_ip`, `login_count`, `email`, `status`, `create_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 1467961862, '127.0.0.1', 97, '', 1, 0),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', '', 1466997000, '127.0.0.1', 1, '', 1, 1466996982);

-- --------------------------------------------------------

--
-- 表的结构 `op_device`
--

CREATE TABLE IF NOT EXISTS `op_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `sub_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='设备表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `op_device`
--

INSERT INTO `op_device` (`id`, `p_id`, `name`, `type`, `sub_time`) VALUES
(1, -1, '设备列表', 1, 1466489407),
(17, 16, 'A出入口', 0, 1466489790),
(16, 14, '国家图书馆', 1, 1466489770),
(14, 1, '4号线', 1, 1466489736),
(15, 1, '6号线', 1, 1466489751),
(18, 16, 'B出入口', 0, 1467794280);

-- --------------------------------------------------------

--
-- 表的结构 `op_device_info`
--

CREATE TABLE IF NOT EXISTS `op_device_info` (
  `id` int(11) NOT NULL,
  `addr1` varchar(200) NOT NULL,
  `addr2` varchar(200) DEFAULT NULL,
  `mac` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `op_device_info`
--

INSERT INTO `op_device_info` (`id`, `addr1`, `addr2`, `mac`) VALUES
(17, '192.168.2.141', '192.168.8.101', '00:0b:ab:77:1c:f0'),
(18, '1111', '22222', '33333');

-- --------------------------------------------------------

--
-- 表的结构 `op_info`
--

CREATE TABLE IF NOT EXISTS `op_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `length` int(11) NOT NULL,
  `device` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sub_time` int(11) NOT NULL,
  `update` int(11) DEFAULT NULL,
  `del` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `op_info`
--

INSERT INTO `op_info` (`id`, `title`, `type`, `length`, `device`, `status`, `sub_time`, `update`, `del`, `content`) VALUES
(2, '222', 3, 30, '1,17,16,14', 1, 1466758692, NULL, NULL, '22222'),
(3, 'tttt', 1, 30, '1,17,16,14', 1, 1467794053, NULL, NULL, 'ddddd'),
(4, '111', 1, 30, '1,17,16,14,18', 1, 1467794301, NULL, NULL, '111111'),
(5, 'hhhh', 1, 30, '1,17,16,14,18', 1, 1467794394, 1467881272, NULL, 'hhhh'),
(6, 'ggg', 1, 30, '1,17,16,14,18', 1, 1467794467, NULL, NULL, 'gggg'),
(7, 'dd', 1, 30, '1,17,16,14,18', 1, 1467795080, NULL, NULL, '得到'),
(8, 'hh', 1, 30, '1,17,16,14,18', 1, 1467795212, NULL, NULL, 'hh'),
(9, 'ddddd', 1, 30, '1,17,16,14,18', 1, 1467795284, NULL, NULL, '点点点点点点'),
(10, 'ss', 1, 30, '1,17,16,14,18', 1, 1467795549, NULL, NULL, 'sss'),
(11, 'rr', 1, 30, '1,17,16,14,18', 1, 1467795716, NULL, NULL, 'rr'),
(12, 'rr', 1, 30, '1,17,16,14,18', 1, 1467795738, NULL, NULL, 'rr'),
(13, 'rr', 1, 30, '1,17,16,14,18', 1, 1467795943, NULL, NULL, 'rr'),
(14, 'rr', 1, 30, '1,17,16,14,18', 1, 1467795957, NULL, NULL, 'rr'),
(15, 'rr', 1, 30, '1,17,16,14,18', 1, 1467796287, NULL, NULL, 'rr'),
(16, 'rr', 1, 30, '1,17,16,14,18', 1, 1467796374, NULL, NULL, 'rr'),
(17, '111', 1, 30, '1,17,16,14', 1, 1467859518, NULL, NULL, '111111'),
(18, '2222', 1, 30, '1,17,16,14', 1, 1467859690, NULL, NULL, '2222'),
(19, 'rrr', 1, 30, '1,17,16,14', 1, 1467859810, NULL, NULL, 'rrrr'),
(20, 'gggg', 1, 30, '1,17,16,14', 1, 1467860026, NULL, NULL, 'gggggg'),
(21, '111', 1, 30, '1,17,16,14', 1, 1467861844, NULL, NULL, '111'),
(22, '111', 1, 1, '1,17,16,14', 1, 1467862961, NULL, NULL, '1111'),
(23, '1111', 1, 1, '1,17,16,14', 3, 1467863052, NULL, 1467946574, '11111'),
(24, '111', 1, 1, '1,17,16,14', 2, 1467863163, NULL, 1467882656, '1111'),
(27, 'ggg', 1, 30, '1,17,16,14,18', 1, 1467880832, 1467881353, NULL, 'ggg');

-- --------------------------------------------------------

--
-- 表的结构 `op_media`
--

CREATE TABLE IF NOT EXISTS `op_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(200) NOT NULL,
  `temp_name` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `sub_time` int(10) NOT NULL,
  `audit` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- 转存表中的数据 `op_media`
--

INSERT INTO `op_media` (`id`, `file_name`, `temp_name`, `type`, `size`, `sub_time`, `audit`) VALUES
(66, '11718674_103447288129_2.jpg', '146727553226345.jpg', 'jpg', '170924', 1467275532, NULL),
(65, 'zgxc1.mp4', '146649131228933.mp4', 'mp4', '15554651', 1466491312, NULL),
(63, '北京轨道交通发展纪实节选.mp4', '146535705630034.mp4', 'mp4', '13542016', 1465357056, NULL),
(64, 'jtlx60s.mp4', '146595767123775.mp4', 'mp4', '17250632', 1465957671, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `op_order`
--

CREATE TABLE IF NOT EXISTS `op_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sub_time` int(11) NOT NULL,
  `del` int(11) DEFAULT NULL,
  `device` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `op_order`
--

INSERT INTO `op_order` (`id`, `type`, `status`, `sub_time`, `del`, `device`) VALUES
(2, 1, 1, 1467344269, NULL, '1,17,16,14'),
(3, 1, 1, 1467344447, NULL, '1,17,16,14'),
(4, 1, 1, 1467344689, NULL, '1,17,16,14'),
(5, 1, 1, 1467344734, NULL, '1,17,16,14'),
(6, 1, 1, 1467344762, NULL, '1,17,16,14'),
(8, 1, 1, 1467359537, NULL, '1,17,16,14'),
(10, 1, 2, 1467601911, 1467884036, '1,17,16,14');

-- --------------------------------------------------------

--
-- 表的结构 `op_program`
--

CREATE TABLE IF NOT EXISTS `op_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `pro_list` text CHARACTER SET latin1 NOT NULL,
  `pro_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `op_program`
--

INSERT INTO `op_program` (`id`, `pro_name`, `pro_list`, `pro_time`) VALUES
(4, '111_20160615040330', '64,63', 1465977810);

-- --------------------------------------------------------

--
-- 表的结构 `op_publish`
--

CREATE TABLE IF NOT EXISTS `op_publish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device` text NOT NULL,
  `program_id` int(11) NOT NULL,
  `sub_time` int(11) NOT NULL,
  `del` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `op_publish`
--

INSERT INTO `op_publish` (`id`, `device`, `program_id`, `sub_time`, `del`, `status`) VALUES
(1, '1,17,16,14', 4, 1466651532, NULL, 1),
(2, '1,17,16,14', 4, 1466672053, 1467884162, 2),
(4, '1,17,16,14', 4, 1467966474, NULL, 1),
(5, '1,17,16,14', 4, 1467966536, NULL, 1),
(6, '1,17,16,14', 4, 1467966679, NULL, 1),
(7, '1,17,16,14', 4, 1467967214, NULL, 1),
(8, '1,17,16,14', 4, 1467967453, NULL, 1),
(9, '1,17,16,14', 4, 1467967519, NULL, 1),
(10, '1,17,16,14', 4, 1467967556, NULL, 1),
(11, '1,17,16,14', 4, 1467967698, NULL, 1),
(12, '1,17,16,14', 4, 1467967890, NULL, 1),
(13, '1,17,16,14', 4, 1467967928, NULL, 1),
(14, '1,17,16,14', 4, 1467967960, NULL, 1),
(15, '1,17,16,14', 4, 1467967994, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
