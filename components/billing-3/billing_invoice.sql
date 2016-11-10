
CREATE TABLE IF NOT EXISTS `billing_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `method` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `transaction` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

ALTER TABLE `billing_invoice` ADD PRIMARY KEY (`id`);
ALTER TABLE `billing_invoice` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



--spi--
