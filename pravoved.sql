-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               5.6.17-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных pravoved
CREATE DATABASE IF NOT EXISTS `pravoved` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pravoved`;


-- Дамп структуры для таблица pravoved.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `q_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `q_id` (`q_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_answers_question` FOREIGN KEY (`q_id`) REFERENCES `question` (`id`),
  CONSTRAINT `FK_answers_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.answers: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.city: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.question
CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `type` enum('pay','free') NOT NULL,
  `cost` int(10) unsigned DEFAULT NULL,
  `status` enum('new','paid','processing','close','delete') DEFAULT 'new',
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `own` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.question: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id`, `user_id`, `title`, `text`, `type`, `cost`, `status`, `date_add`) VALUES
	(1, 9, 'testTET', 'TE E TE E ET E ', 'pay', 0, 'new', '2015-09-06 19:59:59'),
	(2, 9, 'testTET', 'TE E TE E ET E ', 'pay', 0, 'paid', '2015-09-06 19:59:59'),
	(3, 9, 'testTET', 'TE E TE E ET E ', 'pay', 0, 'paid', '2015-09-06 19:59:59'),
	(4, 9, 'testTET', 'TE E TE E ET E ', 'pay', 0, 'new', '2015-09-06 19:59:59'),
	(5, 7, 'testTET123', 'TE E TE E ET E ', 'pay', 0, 'paid', '2015-09-06 19:59:59'),
	(6, 9, 'testTET', 'TE E TE E ET E ', 'pay', 0, 'new', '2015-09-06 19:59:59');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.question_option
CREATE TABLE IF NOT EXISTS `question_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `group` bigint(20) unsigned DEFAULT NULL,
  `cost` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question_option_question_option` (`group`),
  CONSTRAINT `FK_question_option_question_option` FOREIGN KEY (`group`) REFERENCES `question_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.question_option: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `question_option` DISABLE KEYS */;
INSERT INTO `question_option` (`id`, `name`, `description`, `group`, `cost`) VALUES
	(1, 'Количество юристов', NULL, NULL, NULL),
	(2, 'Один юрист', NULL, 1, NULL),
	(3, 'Два юриста', NULL, 1, 100),
	(4, 'Три юриста и более', NULL, 1, 300),
	(5, 'Приватный вопрос', NULL, NULL, 200),
	(6, 'Срочный вопрос', NULL, NULL, 300),
	(7, 'Мнение члена Экспертного совета', NULL, NULL, 200),
	(8, 'Уведомление об ответах по электронной почте', NULL, NULL, NULL);
/*!40000 ALTER TABLE `question_option` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.summary_question_option
CREATE TABLE IF NOT EXISTS `summary_question_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` bigint(20) unsigned NOT NULL,
  `option` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question` (`question`),
  KEY `option` (`option`),
  CONSTRAINT `option` FOREIGN KEY (`option`) REFERENCES `question_option` (`id`),
  CONSTRAINT `question` FOREIGN KEY (`question`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.summary_question_option: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `summary_question_option` DISABLE KEYS */;
INSERT INTO `summary_question_option` (`id`, `question`, `option`) VALUES
	(1, 2, 5),
	(2, 2, 6),
	(3, 3, 5),
	(4, 3, 6),
	(5, 4, 5),
	(6, 4, 6),
	(7, 5, 5),
	(8, 5, 6),
	(9, 6, 5),
	(10, 6, 6);
/*!40000 ALTER TABLE `summary_question_option` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.trans
CREATE TABLE IF NOT EXISTS `trans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `summ` decimal(10,2) NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.trans: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `trans` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `type` enum('client','jurist') NOT NULL,
  `status` enum('new','not_confirm','active','delete') NOT NULL DEFAULT 'new',
  `date_add` datetime NOT NULL,
  `hash` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`email`),
  KEY `type` (`type`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.users: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `phone`, `type`, `status`, `date_add`, `hash`) VALUES
	(1, '', '210065b335cd062bafdedf9a6e451f78', '', 'client', 'new', '2015-08-31 22:45:01', ''),
	(5, 'tes@test.ru', '209deb85ece03d00f4844ec3b347e5fa', '', 'jurist', 'new', '2015-08-31 22:59:17', ''),
	(7, 'tes@test.ua', 'a2ac8207aba60f05a412375cae41491e', '', 'client', 'new', '2015-08-31 23:03:03', ''),
	(8, 'test@test.ru', '4874324b96e47d09421855af2603cd01', '', 'jurist', 'active', '2015-09-02 20:38:50', '881c115711b6f858835c2043fe57126f'),
	(9, 'new@new.ru', '83ba752f1cd06150bcf7a717e31289f9458daf02', '', 'client', 'active', '2015-09-03 21:30:45', '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Дамп структуры для таблица pravoved.user_info
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `otchestvo` varchar(50) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `birtday` date DEFAULT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы pravoved.user_info: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` (`id`, `user_id`, `name`, `surname`, `otchestvo`, `sex`, `birtday`, `city_id`, `avatar`) VALUES
	(1, 1, '', NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 5, 'Имя', 'Фамилия', 'Отчество', NULL, NULL, NULL, NULL),
	(3, 7, 'test', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 8, 'Имя', 'Фамилия', 'Отчество', NULL, NULL, NULL, NULL),
	(5, 9, 'new', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
