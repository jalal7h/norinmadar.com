
CREATE TABLE IF NOT EXISTS `cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `cat` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ;

ALTER TABLE `cat` ADD `ord` INT NOT NULL AFTER `cat`;
ALTER TABLE `cat` ADD `logo` VARCHAR(255) NOT NULL AFTER `ord`;


--spi--
