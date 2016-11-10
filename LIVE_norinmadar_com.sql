-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2016 at 11:07 AM
-- Server version: 5.6.27
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LIVE_norinmadar.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_invoice`
--

CREATE TABLE `billing_invoice` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `method` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `transaction` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_method`
--

CREATE TABLE `billing_method` (
  `id` int(11) NOT NULL,
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
  `hide` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `billing_method`
--

INSERT INTO `billing_method` (`id`, `method`, `unit`, `terminal_id`, `terminal_user`, `terminal_pass`, `c1`, `c2`, `c3`, `c4`, `c5`, `hide`) VALUES
(1, 'mellat', '0.1', '111111', 'username00', '856305402', '', '', '', '', '', 0),
(2, 'manual1', '', '', '', '', 'بانک ملت', '1234567890', '6104666655554444', '', 'offline', 1),
(3, 'manual2', '', '', '', '', 'بانک صادرات', '8123212345', '6037691044443333', '', 'offline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `cat` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `ord` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`id`, `name`, `parent`, `cat`, `ord`, `logo`) VALUES
(1, 'سواری', 0, 'type', 0, ''),
(2, 'شاسی بلند', 0, 'type', 0, ''),
(5, 'ون', 0, 'type', 0, ''),
(8, 'تویوتا', 0, 'brand', 0, 'data/cat/brand/0-7dd58ba17134dbf76d5703999c65a8a6.png'),
(14, 'لکسوس', 0, 'brand', 0, 'data/cat/brand/0-1421e209270f68250a2fef1b81ac2fa9.png'),
(11, 'کیا', 0, 'brand', 0, 'data/cat/brand/0-538de897459e751e8c46343cc9fc5371.png'),
(12, 'هیوندای', 0, 'brand', 0, 'data/cat/brand/0-baeae99903ae93e12e1e9aea391ccf50.png');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `name`, `text`) VALUES
(1, 'اشتراک و عضویت در سایت چه تفاوت‌هایی با یکدیگر دارد؟', 'اشتراک در سایت امکان دریافت پیشنهادی روزانه را از طریق پست الکترونیک فراهم می‌کند. در حالی که با عضویت در سایت حساب مجزایی برای شخص شما روی وب‌سایت تعریف می‌شود که برای خرید یک نت برگ الزامی است.'),
(2, 'چگونه می‌توان از خدمات و محصولات به‌صورت مرتب و روزانه خبردار شد؟', 'کافی است در قسمت اشتراک سایت، ایمیل خود به همراه نام شهر یا شهرهای مورد‌نظر را وارد کنید تا از طریق سایت برای شما اشتراک ایجاد و تمام پیشنهادات روزانه به ایمیل شما فرستاده شود.');

-- --------------------------------------------------------

--
-- Table structure for table `irtoya_staff`
--

CREATE TABLE `irtoya_staff` (
  `id` int(11) NOT NULL,
  `code` varchar(300) COLLATE utf8_persian_ci NOT NULL COMMENT 'شماره فنی',
  `brand_en` text COLLATE utf8_persian_ci NOT NULL COMMENT 'برند لاتین',
  `brand_fa` text COLLATE utf8_persian_ci NOT NULL COMMENT 'برند فارسی',
  `name` text COLLATE utf8_persian_ci NOT NULL COMMENT 'نام قطعه',
  `year` text COLLATE utf8_persian_ci NOT NULL COMMENT 'سال تولید',
  `model_en` text COLLATE utf8_persian_ci NOT NULL COMMENT 'مدل لاتین',
  `model_fa` text COLLATE utf8_persian_ci NOT NULL COMMENT 'مدل فارسی',
  `quality` text COLLATE utf8_persian_ci NOT NULL COMMENT 'کیفیت',
  `price` text COLLATE utf8_persian_ci NOT NULL COMMENT 'قیمت',
  `desc` text COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailq`
--

CREATE TABLE `mailq` (
  `id` int(11) NOT NULL,
  `to` text COLLATE utf8_persian_ci NOT NULL,
  `subject` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `mail_from` text COLLATE utf8_persian_ci NOT NULL,
  `html` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `date` int(11) NOT NULL,
  `visit` int(11) NOT NULL,
  `pic` text COLLATE utf8_persian_ci NOT NULL,
  `tag` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `date_paid` int(11) NOT NULL,
  `date_sent` int(11) NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `unitcost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `texty`
--

CREATE TABLE `texty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان لاتین',
  `name_fa` text COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان فارسی',
  `content` text COLLATE utf8_persian_ci NOT NULL COMMENT 'محتوا'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `texty`
--

INSERT INTO `texty` (`id`, `name`, `name_fa`, `content`) VALUES
(1, 'orders_confirm_user_msg', 'متن ایمیل تایید سفارش به کاربر', 'سفارش یه شماره #{order_id} ثبت شد\r\n::::\r\nسلام\r\nسفارش شما به شماره #{order_id} ثبت شده است \r\nلطفا منتظر تایید مدیریت بمانید\r\nبا تشکر'),
(2, 'orders_confirm_user_sms', 'متن پیامک تایید سفارش به کاربر', 'کاربر گرامی\r\nسفارش شما به شماره #{order_id} ثبت شده است\r\nلطفا منتظر تایید مدیریت بمانید\r\nبا تشکر'),
(3, 'orders_confirm_admin_msg', 'متن ایمیل تایید سفارش به مدیریت', 'ثبت سفارش جدید توسط {user_name}\r\n::::\r\nسلام \r\nسفارش جدید توسط کاربر {user_name} ثبت شده است.\r\nدسترسی به جزئیات سفارش :\r\n{order_management_link}\r\nبا تشکر\r\n'),
(4, 'users_register_do_msg', 'ایمیل تایید ثبت نام کاربر', 'ثبت نام در {main_title}\r\n::::\r\nسلام\r\n\r\nکاربر گرامی، {user_name} عزیز، \r\nحساب کاربری شما با موفقیت ایجاد شد\r\nاطلاعات حساب شما به شرح زیر است : \r\nنام کاربری:‌ {username}\r\nگذرواژه: {password}\r\n\r\nورود به سایت :‌\r\n{_URL}/login\r\n\r\nبا تشکر\r\n'),
(5, 'users_register_do_sms', 'پیامک تایید ثبت نام کاربر', 'کاربر گرامی خوش آمدید\r\nثبت نام با موفقیت انجام شد\r\nنام کاربری: {username}\r\nکلمه عبور: {password}\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `permission` int(12) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `wallet_credit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permission`, `name`, `tell`, `cell`, `wallet_credit`) VALUES
(1, 'admin', 'hellcat', 2, 'مدیریت سایت', '02166936950', '09127744129', 0);

-- --------------------------------------------------------

--
-- Table structure for table `_links`
--

CREATE TABLE `_links` (
  `_id` int(12) NOT NULL,
  `_url` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(50) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_priority` int(1) NOT NULL DEFAULT '0',
  `_status` int(1) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_links`
--

INSERT INTO `_links` (`_id`, `_url`, `_title`, `_type`, `_priority`, `_status`, `parent`) VALUES
(9, './about', 'درباره ما', 'index', 7, 1, 0),
(10, './contact', 'ارتباط با ما', 'index', 6, 1, 0),
(11, '#', 'محصولات', 'index', 1, 1, 0),
(12, './orders-basket-confirm', 'سبد خرید', 'index', 4, 1, 0),
(13, './?page=108', 'محصولات', 'index', 5, 1, 0),
(15, './news', 'اخبار سایت', 'index', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_pages`
--

CREATE TABLE `_pages` (
  `_page` int(11) NOT NULL,
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `meta_title` text COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان صفحه',
  `meta_kw` text COLLATE utf8_persian_ci NOT NULL COMMENT 'کلمات کلیدی',
  `meta_desc` text COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_pages`
--

INSERT INTO `_pages` (`_page`, `_title`, `meta_title`, `meta_kw`, `meta_desc`) VALUES
(2, 'ارتباط با ما', '', '', ''),
(20, 'سوالات متداول', '', '', ''),
(1, 'صفحه اصلی', '', '', ''),
(3, 'درباره ما', '', '', ''),
(4, 'راهنمای سایت', '', '', ''),
(5, 'آموزش', '', '', ''),
(6, 'قوانین و مقرارت خودروپارس', '', '', ''),
(7, 'ضوابط حفظ حریم خصوصی', '', '', ''),
(153, 'خدمات پس از فروش', '', '', ''),
(154, 'نمایندگی ها', '', '', ''),
(155, 'امور مشتریان', '', '', ''),
(156, 'نمایش خودرو', '<?\r\necho irtoya_meta( "title" );\r\n?>', '<?\r\necho irtoya_meta( "kw" );\r\n?>', '<?\r\necho irtoya_meta( "desc" );\r\n?>'),
(157, 'مقایسه خودرو', '', '', ''),
(158, 'تویوتا کمری هایبرید', '', '', ''),
(108, 'فروشگاه قطعات خودرو', '', '', ''),
(109, 'نمایش قطعه', '<?\r\necho is_meta( "title" );\r\n?>', '<?\r\necho is_meta( "kw" );\r\n?>', '<?\r\necho is_meta( "desc" );\r\n?>'),
(66, 'سبد خرید', '', '', ''),
(58, 'ثبت نام', '', '', ''),
(59, 'ثبت نام #2', '', '', ''),
(60, 'ورود کاربر', '', '', ''),
(63, 'فراموشی کلمه عبور', '', '', ''),
(14, 'محیط کاربری', '', '', ''),
(51, 'اخبار سایت', '', '', ''),
(52, 'نمایش خبر', '<?\r\necho news_meta( "title" );\r\n?>', '<?\r\necho news_meta( "kw" );\r\n?>', '<?\r\necho news_meta( "desc" );\r\n?>');

-- --------------------------------------------------------

--
-- Table structure for table `_page_frames`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_page_frames`
--

INSERT INTO `_page_frames` (`_id`, `_position`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES
(10000001, 'top', 1, 'post', 'PHP5', 'this is the top title', '<?php\r\nf_front__f_html__TOP();\r\n?>', 0, 1),
(10000002, 'down', 2, 'post', 'PHP5', 'down...', '<?php\r\nf_front__f_html__DOWN();\r\n?>', 0, 1),
(10000006, 'down', 3, 'post', 'PHP5', '', '<!-- Begin WebGozar.com Counter code -->\r\n<script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3570224&amp;t=counter" ></script>\r\n<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3570224" target="_blank">&#1570;&#1605;&#1575;&#1585;</a></noscript>\r\n<!-- End WebGozar.com Counter code -->', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_page_layers`
--

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_page_layers`
--

INSERT INTO `_page_layers` (`_id`, `_page`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES
(2, 2, 1, 'contact_display', '', 'ارتباط با ما', '', 1, 1),
(20, 20, 1, 'faq_display', '', 'سوالات متداول', '', 1, 1),
(1, 1, 2, 'slidex_display', '', 'نمایش اسلاید', '', 1, 1),
(3, 3, 1, 'post', 'HTML', 'درباره ما', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(4, 4, 1, 'post', 'HTML', 'راهنمای سایت', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(5, 5, 1, 'post', 'HTML', 'آموزش', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(6, 6, 1, 'post', 'HTML', 'قوانین و مقرارت خودروپارس', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>\n', 1, 1),
(7, 7, 1, 'post', 'HTML', 'ضوابط حفظ حریم خصوصی', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(52, 52, 1, 'news_display', '', 'نمایش خبر', '', 1, 1),
(51, 51, 1, 'news_list', '', 'اخبار سایت', '', 1, 1),
(101, 1, 3, 'news_list_air', '', 'لیست تصویری خبر ها', '', 1, 1),
(153, 153, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(154, 154, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(155, 155, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(156, 156, 1, 'irtoya_display', '', 'نمایش خودرو', '', 1, 1),
(157, 157, 1, 'post', 'PHP5', 'مقایسه خودرو', '<?\r\nirtoya_compare();\r\n?>', 1, 1),
(158, 158, 1, 'post', 'HTML', 'نقد و بررسی: تویوتا کمری هایبرید ۲۰۱۵', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p style="text-align: right;"><span style="font-size: 12px;">در نگاه اول سه دلیل برای دوست داشتن این خودرو به ذهن می&zwnj;آید. اول این&zwnj;که استایل جدید front-end که تویوتا در آن به&zwnj;کاربرده است خوب به نظر می&zwnj;آید. دوم آنکه سیستم استریو JBL GreenEdge برای گوش دادن موسیقی و حتی پاسخ دادن به تماس&zwnj;های تلفن همراه نیز بسیار خوب عمل می&zwnj;کند , سوم آنکه فرمان پذیری این مدل از تویوتا بسیار بهینه&zwnj;تر از مدل&zwnj;های قبلی شده است.<img class="aligncenter size-full wp-image-3808" src="uploads/2015toyotacamry-004.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">البته در طول یک&zwnj;هفته&zwnj;ای که توانستیم این خودرو را از نزدیک بررسی کنیم دلایل متعدد دیگری نیز در این خصوص یافتیم که در ادامه بیشتر آن&zwnj;ها را بررسی خواهیم کرد؛ &nbsp;درواقع باید گفت که این آن تویوتا کمری نیست که به دنبالش بودید.<img class="aligncenter size-full wp-image-3816" src="uploads/2015toyotacamry-015.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">در تویوتا کمری مدل ۲۰۱۵ به&zwnj;روزرسانی&zwnj;های بسیار مهمی نسبت به سایر سدان ها میان اندازه تویوتا صورت گرفته است. این خودرو جدید دارای یک دستیار راننده جدید نیز هست که باعث می&zwnj;شود بتوانید ارتباط بهتری با Entune، سیستم یکپارچه نرم&zwnj;افزاری تویوتا داشته باشید. البته انتخاب&zwnj;های driveline تغییرات زیادی نکرده&zwnj;اند.</span></p>\r\n<h3 style="text-align: right;"><strong><span style="font-size: 12px;">به دنیای نرم&zwnj;افزار خوش&zwnj;آمدید</span></strong></h3>\r\n<p style="text-align: right;"><span style="font-size: 12px;">صفحه&zwnj;نمایش بزرگی ال سی دی در وسط داشبورد قرار دارد که کار با آن بسیار راحت است. البته باوجوداینکه تویوتا در لیست آپشن های خودرو به&zwnj;صراحت ذکر کرده است که این خودرو مجهز به Entune Premium JBL Audio with Navigation App Suite است اما کلید مربوط به ناوبری در آن دیده نمی&zwnj;شود. به&zwnj;جای آن کلید بزرگی به نام Apps وجود دارد که درواقع اصطلاح جدید ابداعی تویوتا برای انواع فناوری&zwnj;های نرم افزاری است که در اتاق خودرو از آن استفاده&zwnj;شده است.<img class="aligncenter size-full wp-image-3820" src="uploads/2015toyotacamry-020.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">با زدن این کلید سه صفحه آیکون را روبروی خود خواهید دید و زمانی که از طریق گوشی خودم به Entune متصل شدم توانستم بخش ناوبری را نیز در میان آن&zwnj;ها پیدا کنم. درواقع با این کار امکان حذف و اضافه نرم&zwnj;افزارها و امکانات به انواع خودروهای کمری تویوتا افزوده می&zwnj;شود که به&zwnj;این&zwnj;ترتیب نیاز به طراحی کلیدهای فیزیکی نیز در این خصوص دیده نمی&zwnj;شود.&nbsp;به نظر می&zwnj;رسد سیستم ناوبری این مدل نسبت به نسل قبلی کمری به&zwnj;روزتر شده باشد. اعلان&zwnj;های مربوط به ترافیک، تغییر مسیرهای برنامه&zwnj;ریزی&zwnj;شده، راهنمای مسیر، بهبودهای گرافیکی و مواردی ازاین&zwnj;دست همگی بهبودهای بسیار خوبی پیداکرده&zwnj;اند.<img class="aligncenter size-full wp-image-3825" src="uploads/2015toyotacamry-027.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">تمام برنامه&zwnj;هایی که در صفحه&zwnj;نمایش ال سی دی لمس می&zwnj;کنید به سرعت اجرا می&zwnj;شوند و کندی در اجرای آن&zwnj;ها دیده نمی&zwnj;شود. سازمان&zwnj;دهی و دسته&zwnj;بندی آیکون&zwnj;ها خوب انجام&zwnj;شده است با این&zwnj;که گرافیک آن&zwnj;ها هنوز جای کار بیشتری دارد. البته امکان سفارشی&zwnj;سازی نمایش این آیکون&zwnj;ها نیز وجود دارد.<img class="aligncenter size-full wp-image-3830" src="uploads/2015toyotacamry-036.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="505" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">تویوتا سامانه فرمان صوتی را هم در بخش Entune و هم در فرمان خودرو قرار داده است که با توجه به نوع زبان راننده به&zwnj;خوبی می&zwnj;تواند فرمان&zwnj;ها را دریافت و پردازش کند. از سوی دیگر سیستم یکپارچه Entune که تویوتا ارائه کرده است از طریق نصب اپلیکیشن های مخصوص آن در اندروید و iOS و حتی اتصال از طریق بلوتوث نیز به&zwnj;راحتی قابل&zwnj;کنترل و کار است. با این کار می&zwnj;توانیم از نرم&zwnj;افزارهایی چون Bing search, OpenTable, Yelp و HeartRadio در صفحه&zwnj;نمایش لمسی خودرو خود استفاده کنیم. باید گفت که نسل قبلی تویوتا کمری نیز به سیستم یکپارچه Entune مجهز بود اما بسیار خسته&zwnj;کننده و فاقد کار آیی لازم بود، مسئله ای که در نسل جدید تویوتا کمری با اعمال به&zwnj;روزرسانی&zwnj;ها و تغییر رابط کاربری به&zwnj;خوبی رفع شده است.</span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;"><a href="http://bamanbekhar.com/wp-content/uploads/2015/03/2015toyotacamry-044.jpg"><img class="aligncenter size-full wp-image-3833" src="uploads/2015toyotacamry-044.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="507" /></a></span></p>\r\n<p style="text-align: right;">&nbsp;</p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">اما جالب&zwnj;تر آنکه بسیاری از اپلیکیشن ها با سیستم ناوبری خودرو در ارتباط هستند، به&zwnj;طور مثال می&zwnj;توانید کلمه&zwnj;ای را در موتور جستجوی Bing، جستجو کنید و درنهایت نتیجه&zwnj;ای را که منطبق با مسیر و یا مقصد شماست انتخاب کنید. iHeartRadio هم به شما این امکان را می&zwnj;دهد تا بین لیستی از ایستگاه&zwnj;های رادیویی بین&zwnj;المللی به جستجو بپردازید. البته در کنار این&zwnj;ها تویوتا کمری دارای تمامی آپشن های صوتی معمول چون اتصال بلوتوث، اتصال به iOS، درگاه USB و رادیو HD هست. البته بااتصال بلوتوث تنها می&zwnj;توانید از طریق صفحه&zwnj;نمایش لمسی موسیقی موردنظر خود را متوقف کنید و یا به موسیقی بعدی بروید درحالی&zwnj;که با استفاده از درگاه USB امکانات کاملی از قبلی مدیریت آلبوم&zwnj;ها را برای شنیدن موسیقی دلخواه در اختیار خواهید داشت. از سوی دیگر این مدل تویوتا کمری نخستین مدل خودرویی است که دارای پد شارژ بی&zwnj;سیم Qi است. البته نمونه&zwnj;ای دیگر هم در سال ۲۰۱۳ در Toyota Avalon به کار گرفته&zwnj;شده بود. با داشتن این پد کاربر این امکان را پیدا می&zwnj;کند تا گوشی&zwnj;هایی که از این فناوری پشتیبانی می&zwnj;کند را روی آن قرار دهد و گوشی به&zwnj;صورت بی&zwnj;سیم شارژ شود. به&zwnj;طور مثال اگر گوشی هوشمند شما آیفون است نمی&zwnj;توانید از این فناوری استفاده کنید و قبل از آن باید قاب&zwnj;های سازگار با Qi که مخصوص گوشی&zwnj;های آیفون ساخته&zwnj;شده است را تهیه کنید.</span></p>\r\n<h3 style="text-align: right;"><strong><span style="font-size: 12px;">موتور خودرو</span></strong></h3>\r\n<p style="text-align: right;"><span style="font-size: 12px;">اما کمری ۲۰۱۵ در این خصوص آن&zwnj;چنان چیز جدیدی برای ارائه ندارد. موتور ۳٫۵ لیتری V-6 با سیستم ۶ دنده&zwnj;اتوماتیک ما را به&zwnj;خوبی به یاد نسل قبلی این خودرو خواهد انداخت؛ اما یکی از بهبودهای جزئی که در این نسل قابل اشاره است مقدار fuel economy 21 mpg برای رانندگی شهری و ۳۱ mpg در بزرگراه است.<img class="aligncenter size-full wp-image-3810" src="uploads/2015toyotacamry-006.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;">&nbsp;</p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">موتور تویوتا کمری ۲۰۱۵، ۲۶۸ اسب بخار قدرت دارد و حداکثر گشتاور آن ۲۴۸ pound-feet است. در رانندگی در بزرگراه این خودرو شتاب بسیار خوبی دارد؛ اما برگ برنده این مدل از کمری استفاده از سیستم هایبرید آن است که می&zwnj;تواند ۲۰۰ اسب بخار نیرو تولید کند و با آن به fuel economy میانگین ۴۰ mpg دستیابید. سیستم تعلیق خودرو بسیار نرم طراحی&zwnj;شده و در زمان رانندگی احساس بسیار خوبی خواهید داشت و خودرو هیچ&zwnj;گاه از کنترل راننده خارج نخواهد شد. البته تویوتا کمری یک خودروی اسپرت نیست و نباید انتظارت پایداری یک خودروی اسپرت را از آن داشت. اما دنده &zwnj;اتوماتیک این خودرو دارای دو حالت تعویض دنده خودکار معمولی و اسپرت است. البته به نظر نمی&zwnj;رسد که بسیاری از رانندگان از حالت اسپرت استفاده چندانی کنند؛ اما درست مثل بسیاری از خودروهای امروزی فرمان تویوتا کمری نیز دارای یک موتوربرقی است. موتوربرقی که در نسل های گذشته خودروهای تویوتا استفاده می&zwnj;شد سروصدای زیادی به همراه داشت که این موارد در این مدل رفع شده است. این ویژگی به&zwnj;خصوص در مسیرهای طولانی باعث عدم خستگی راننده می&zwnj;شود.<img class="aligncenter size-full wp-image-3815" src="uploads/2015toyotacamry-014.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;">&nbsp;</p>\r\n<p style="text-align: right;">اما مسئله جالب دیگری که در رانندگی با تویوتا کمری ۲۰۱۵ با آن روبرو خواهید شد فناوری دستیار راننده اختصاصی تویوتا است. مجموعه&zwnj;ای از امکانات که به آهستگی در حال ارائه در محصولات تویوتا هست. سیستم کروز کنترل انطباق پذیر که از فناوری رادار پیش برنده استفاده می&zwnj;کند امکانات بی&zwnj;نظیری را برای راننده فراهم می&zwnj;کند. زمانی که به ترافیک می&zwnj;رسید خودرو سرعت را با توجه به&zwnj;سرعت خودرو جلویی تنظیم می&zwnj;کند. این سیستم را در شرایط مختلف جاده و ترافیک تست کردیم و در تمامی آن&zwnj;ها سیستم به&zwnj;خوبی کار کرد.</p>\r\n<h3 style="text-align: right;"><span style="font-size: 12px;">جمع&zwnj;بندی:</span></h3>\r\n<p style="text-align: right;"><span style="font-size: 12px;">باید گفت که تویوتا کمری ۲۰۱۵ به خاطر استایل طراحی جدید، ابزارهای الکترونیکی درون اتاق خودرو و دستیار رانندگی اختصاصی تویوتا از هر نظر یک سدان محبوب به شمار می&zwnj;رود. از سوی دیگر اپلیکیشن های Entune به کاربر این امکان را می&zwnj;دهند به&zwnj;راحتی مقصد خود را پیدا کند و نزدیک&zwnj;تر ترین رستوران یا مرکز رفاهی را در مسیر خود تا رسیدن به مقصد پیدا کندو سیستم صوتی JBL GreenEdge که در این خودرو وجود دارد کیفیت صوت مطلوبی را برای این سدان میان اندازه به وجود آورده است.</span></p>\r\n</body>\r\n</html>', 1, 1),
(108, 108, 1, 'post', 'PHP5', 'فروشگاه قطعات خودرو', '<?\r\nis_list();\r\n?>', 1, 1),
(109, 109, 1, 'post', 'PHP5', 'نمایش قطعه', '<?\r\nis_display();\r\n?>', 0, 1),
(66, 66, 1, 'post', 'PHP5', 'سبد خرید', '<?\r\norders_basket_list();\r\n?>', 1, 1),
(58, 58, 1, 'post', 'PHP5', 'ثبت نام', '<?\r\nusers_register_form();\r\n?>', 1, 1),
(59, 59, 1, 'post', 'PHP5', 'ثبت نام', '<?\r\nusers_register_do();\r\n?>', 1, 1),
(60, 60, 1, 'post', 'PHP5', 'ورود کاربر', '<?\r\nusers_login_form();\r\n?>', 1, 1),
(63, 63, 1, 'post', 'PHP5', 'فراموشی کلمه عبور', '<?\r\nusers_forgot_form();\r\n?>', 1, 1),
(14, 14, 1, 'post', 'PHP5', 'پنل کاربر', '<? userpanel_menu(); ?>\r\n<div class="userpanel_desk_container">\r\n    <? userpanel_desk(); ?>\r\n</div>', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_temp`
--

CREATE TABLE `_temp` (
  `_key` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_val` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_temp`
--

INSERT INTO `_temp` (`_key`, `_val`) VALUES
('main_title', 'خودرو پارس'),
('money_unit', 'ریال'),
('template', 'Default'),
('cu_company_tell', '(071) 38307614 - 38317000- 38202904'),
('cu_company_fax', '(071) 38307614'),
('cu_company_addr', 'شیراز  - بلوار امیر کبیر - روبروی پمپ گاز '),
('websitedescription', 'فروش خودرو'),
('keywords', 'خودرو,ماشین,تولید,بازار'),
('about', 'تمامی حقوق برای مجموعه خودروپارس محفوظ است'),
('email_address_webadmin', 'info@khodropars.com'),
('email_address_management', 'admin@khodropars.com'),
('email_address_sell', 'sales@khodropars.com'),
('email_address_support', 'support@khodropars.com'),
('sms_state', '1'),
('webstatus_main', '1'),
('unsuccessful_attack', '182'),
('security_number', '671432'),
('user_noaccess_delay', '3600'),
('user_max_access', '200'),
('NeedToValidateBlogManager', '1'),
('UserInviteTemplateBody', ''),
('UserInviteTemplateTitle', ''),
('cache_filemtime', '1318826681');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_invoice`
--
ALTER TABLE `billing_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_method`
--
ALTER TABLE `billing_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irtoya_staff`
--
ALTER TABLE `irtoya_staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `code_2` (`code`);

--
-- Indexes for table `mailq`
--
ALTER TABLE `mailq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `texty`
--
ALTER TABLE `texty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `_links`
--
ALTER TABLE `_links`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `_pages`
--
ALTER TABLE `_pages`
  ADD PRIMARY KEY (`_page`);

--
-- Indexes for table `_page_frames`
--
ALTER TABLE `_page_frames`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `_page_layers`
--
ALTER TABLE `_page_layers`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `_temp`
--
ALTER TABLE `_temp`
  ADD PRIMARY KEY (`_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_invoice`
--
ALTER TABLE `billing_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `billing_method`
--
ALTER TABLE `billing_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `irtoya_staff`
--
ALTER TABLE `irtoya_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mailq`
--
ALTER TABLE `mailq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `texty`
--
ALTER TABLE `texty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `_links`
--
ALTER TABLE `_links`
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `_pages`
--
ALTER TABLE `_pages`
  MODIFY `_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `_page_frames`
--
ALTER TABLE `_page_frames`
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000007;
--
-- AUTO_INCREMENT for table `_page_layers`
--
ALTER TABLE `_page_layers`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;