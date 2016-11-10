
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `table` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `table_id` int(11) NOT NULL,
  `user_name` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `user_email` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `date` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;


--spi--
