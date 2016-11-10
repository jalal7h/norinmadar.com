
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `permission` int(12) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `wallet_credit` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

INSERT INTO `users` (`id`, `username`, `password`, `permission`, `name`, `tell`, `cell`, `wallet_credit`) VALUES
(1, 'admin', 'admin', 2, 'مدیریت سایت', '02166936950', '09127744129', 0);


--spi--
