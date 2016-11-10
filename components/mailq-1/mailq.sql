
CREATE TABLE `mailq` (
  `id` int(11) NOT NULL,
  `to` text COLLATE utf8_persian_ci NOT NULL,
  `subject` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `mail_from` text COLLATE utf8_persian_ci NOT NULL,
  `html` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `mailq`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mailq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

