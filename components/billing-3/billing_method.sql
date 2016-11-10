
CREATE TABLE IF NOT EXISTS `billing_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` text COLLATE utf8_persian_ci NOT NULL,
  `unit` text COLLATE utf8_persian_ci NOT NULL,
  `terminal_id` text COLLATE utf8_persian_ci NOT NULL,
  `terminal_user` text COLLATE utf8_persian_ci NOT NULL,
  `terminal_pass` text COLLATE utf8_persian_ci NOT NULL,
  `c1` text COLLATE utf8_persian_ci NOT NULL,
  `c2` text COLLATE utf8_persian_ci NOT NULL,
  `c3` text COLLATE utf8_persian_ci NOT NULL,
  `c4` text COLLATE utf8_persian_ci NOT NULL,
  `c5` text COLLATE utf8_persian_ci NOT NULL,
  `hide` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=4 ;

INSERT INTO `billing_method` (`id`, `method`, `unit`, `terminal_id`, `terminal_user`, `terminal_pass`, `c1`, `c2`, `c3`, `c4`, `c5`, `hide`) VALUES
(1, 'mellat', '0.1', '111111', 'username00', '856305402', '', '', '', '', '', 0),
(2, 'manual1', '', '', '', '', 'بانک ملت', '1234567890', '6104666655554444', '', 'offline', 0),
(3, 'manual2', '', '', '', '', 'بانک صادرات', '8123212345', '6037691044443333', '', 'offline', 0);


--spi--
