
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `date_paid` int(11) NOT NULL,
  `date_sent` int(11) NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--spi--
