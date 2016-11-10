
CREATE TABLE `_page_frames` (
  `_id` int(12) NOT NULL,
  `_position` varchar(50) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_priority` int(6) NOT NULL DEFAULT '0',
  `_func` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(25) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_data` text COLLATE utf8_persian_ci NOT NULL,
  `_framed` int(6) NOT NULL DEFAULT '0',
  `_status` int(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=10000005 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO `_page_frames` (`_id`, `_position`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES
(10000001, 'top', 1, 'post', 'PHP5', 'this is the top title', '<?php\r\nf_front__f_html__TOP();\r\n?>', 0, 1),
(10000002, 'down', 2, 'post', 'PHP5', 'down...', '<?php\r\nf_front__f_html__DOWN();\r\n?>', 0, 1),
(10000003, 'right', 1, 'post', 'HTML', 'test right', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>test right</p>\r\n</body>\r\n</html>', 1, 1),
(10000004, 'left', 1, 'post', 'HTML', 'test left', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>test left</p>\r\n</body>\r\n</html>', 1, 1);

ALTER TABLE `_page_frames` ADD PRIMARY KEY (`_id`);
ALTER TABLE `_page_frames` MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10000005;




--spi--
