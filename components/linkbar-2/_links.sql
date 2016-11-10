
CREATE TABLE `_links` (
  `_id` int(12) NOT NULL,
  `_url` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(50) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_priority` int(1) NOT NULL DEFAULT '0',
  `_status` int(1) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO `_links` (`_id`, `_url`, `_title`, `_type`, `_priority`, `_status`, `parent`) VALUES
(9, './about', 'درباره ما', 'index', 6, 1, 0),
(10, './contact', 'ارتباط با ما', 'index', 7, 1, 0);

ALTER TABLE `_links`
  ADD PRIMARY KEY (`_id`);

ALTER TABLE `_links`
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT , AUTO_INCREMENT=11;



--spi--
