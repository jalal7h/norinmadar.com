
CREATE TABLE `_page_layers` (
  `_id` int(11) NOT NULL,
  `_page` int(6) NOT NULL DEFAULT '0',
  `_priority` int(6) NOT NULL DEFAULT '0',
  `_func` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(25) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_data` text COLLATE utf8_persian_ci NOT NULL,
  `_framed` int(6) NOT NULL DEFAULT '0',
  `_status` int(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `_page_layers`
  ADD PRIMARY KEY (`_id`);

ALTER TABLE `_page_layers`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;




--spi--
