
CREATE TABLE IF NOT EXISTS `texty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان',
  `content` text COLLATE utf8_persian_ci NOT NULL COMMENT 'محتوا',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=3 ;

INSERT INTO `texty` (`id`, `name`, `content`) VALUES
(1, 'users_register_do_msg', 'ثبت نام در {main_title}\r\n::::\r\nسلام\r\n\r\nکاربر گرامی، {user_name} عزیز، \r\nحساب کاربری شما با موفقیت ایجاد شد\r\nاطلاعات حساب شما به شرح زیر است : \r\nنام کاربری:‌ {username}\r\nگذرواژه: {password}\r\n\r\nورود به سایت :‌\r\n{_URL}/login\r\n\r\nبا تشکر\r\n'),
(2, 'users_register_do_sms', 'کاربر گرامی خوش آمدید\r\nثبت نام با موفقیت انجام شد\r\nنام کاربری: {username}\r\nکلمه عبور: {password}\r\n');


--spi--
