-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.62-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-03-03 17:28:57
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table wud.test_group
CREATE TABLE IF NOT EXISTS `test_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grp` int(10) unsigned NOT NULL,
  `user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table wud.test_message
CREATE TABLE IF NOT EXISTS `test_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grp` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table wud.test_messages_updated_group
CREATE TABLE IF NOT EXISTS `test_messages_updated_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `grp` int(10) unsigned NOT NULL,
  `updated` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table wud.test_messages_updated_user
CREATE TABLE IF NOT EXISTS `test_messages_updated_user` (
  `user` int(10) unsigned NOT NULL,
  `updated` enum('0','1') NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table wud.test_user
CREATE TABLE IF NOT EXISTS `test_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `online` smallint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
