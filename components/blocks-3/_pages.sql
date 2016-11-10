
CREATE TABLE `_pages` (
  `_page` int(11) NOT NULL,
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `_pages`
  ADD PRIMARY KEY (`_page`),
  ADD UNIQUE KEY `_page` (`_page`);

ALTER TABLE `_pages`
  MODIFY `_page` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;



--spi--
