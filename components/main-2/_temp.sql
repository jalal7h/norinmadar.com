
CREATE TABLE `_temp` (
  `_key` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_val` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

ALTER TABLE `_temp`
  ADD PRIMARY KEY (`_key`);

INSERT INTO `_temp` (`_key`, `_val`) VALUES
('main_title', 'سیستم مدیریت محتوا'),
('money_unit', 'تومان'),
('template', 'Default'),

('cu_company_tell', '(21) 22443355'),
('cu_company_fax', '(21) 22332222'),
('cu_company_addr', 'ستارخان، برق آلستوم، مجتمع توحید'),

('websitedescription', 'مدیریت محتوا'),
('keywords', 'مدیریت,محتوا,نرم افزار'),
('about', 'شرکت گسترش پولاد مهستان'),

('email_address_webadmin', 'info@parsunix.com'),
('email_address_management', 'admin@parsunix.com'),
('email_address_sell', 'sales@parsunix.com'),
('email_address_support', 'support@parsunix.com'),

('sms_state', '1'),
('webstatus_main', '1'),

('unsuccessful_attack', '173'),
('security_number', '671432'),
('user_noaccess_delay', '3600'),
('user_max_access', '200'),
('NeedToValidateBlogManager', '1'),
('UserInviteTemplateBody', ''),
('UserInviteTemplateTitle', ''),
('cache_filemtime', '1318826681');


--spi--
