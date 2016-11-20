-- phpMyAdmin SQL Dump
-- version 4.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2016 at 02:19 PM
-- Server version: 5.6.28-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `LIVE_norinmadar.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_invoice`
--

CREATE TABLE IF NOT EXISTS `billing_invoice` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `method` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `transaction` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `billing_invoice`
--

INSERT INTO `billing_invoice` (`id`, `uid`, `order_id`, `cost`, `method`, `transaction`, `date`) VALUES
(1, 1, 0, 1000, 'manual3', '29038498457', 1478520000);

-- --------------------------------------------------------

--
-- Table structure for table `billing_method`
--

CREATE TABLE IF NOT EXISTS `billing_method` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `billing_method`
--

INSERT INTO `billing_method` (`id`, `method`, `unit`, `terminal_id`, `terminal_user`, `terminal_pass`, `c1`, `c2`, `c3`, `c4`, `c5`, `hide`) VALUES
(1, 'mellat', '0.1', '111111', 'username00', '856305402', '', '', '', '', '', 0),
(2, 'manual1', '', '', '', '', 'بانک ملت', '1234567890', '6104666655554444', '', 'offline', 1),
(3, 'manual2', '', '', '', '', 'بانک صادرات', '8123212345', '6037691044443333', '', 'offline', 1),
(4, 'manual3', '', '', '', '', 'بانک صادرات', '234584599848', '6037691044320099', '', 'offline', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE IF NOT EXISTS `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `cat` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `ord` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

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
(12, 'هیوندای', 0, 'brand', 0, 'data/cat/brand/0-baeae99903ae93e12e1e9aea391ccf50.png'),
(16, 'از طریق پست', 0, 'how_to_buy', 0, ''),
(17, 'نقدی', 0, 'how_to_buy', 0, ''),
(18, 'ولتاژ بالا', 0, 'main', 0, 'data/cat/main/0-0824ddb7276de048e150d80d11efdc3f.jpg'),
(19, 'ولتاژ پایین', 0, 'main', 0, 'data/cat/main/0-8e36bc2b550c579a6554327092b0ea76.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
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

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

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

CREATE TABLE IF NOT EXISTS `irtoya_staff` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL COMMENT 'نام محصول',
  `code` varchar(300) COLLATE utf8_persian_ci NOT NULL COMMENT 'کد محصول',
  `cat` int(11) NOT NULL COMMENT 'گروه',
  `technical_features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'مشخصات فنی',
  `number` int(11) NOT NULL COMMENT 'تعداد',
  `price` text COLLATE utf8_persian_ci NOT NULL COMMENT 'قیمت',
  `desc` text COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات',
  `product` text COLLATE utf8_persian_ci NOT NULL COMMENT 'عکس'
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irtoya_staff`
--

INSERT INTO `irtoya_staff` (`id`, `name`, `code`, `cat`, `technical_features`, `number`, `price`, `desc`, `product`) VALUES
(14, 'هدلایت موتوری MM3', '011', 18, ' قدرت : ٢٤ وات  ------          \r\nتعداد و نوع LED : ٣ عدد COB------\r\nروشنایی : ٢٤٠٠ لومن------\r\nرنگ LED : سفید ٦٥٠٠-٧٠٠٠ كلوین------\r\nولتاژ ورودی : ٨-٣٦ ولت\r\nفن دارد------\r\n', 1, ' ٣٥٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد.', ''),
(15, 'هدلایتMC1-2', '002', 19, 'قدرت : ٤٠وات\r\nتعداد و نوع LED : ٢عدد COB\r\nروشنایی : ٤٠٠٠ لومن\r\nرنگ LED : سفید ٦٥٠٠-٧٠٠٠ كلوین\r\nولتاژ ورودی : ٨-٣٦ ولت\r\nفن دارد\r\n', 5, '٧٦٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد.', ''),
(16, 'هدلایت موتوری 3 حالته', '003', 19, ' قدرت : ٨ وات\r\nتعداد و نوع LED : ٣عدد \r\nروشنایی : ١٦٠٠ لومن\r\nرنگ LED : سفید ٦٥٠٠-٧٠٠٠ كلوین\r\nولتاژ ورودی : ٨-٣٦ ولت\r\nسه رنگ  : آبی ، قرمز ، سفید\r\n\r\nفن ندارد\r\n', 5, ' ٣٥٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد.', ''),
(17, 'هدلایت موتوری 3 حالته', '004', 18, ' قدرت : ٨ وات\r\nتعداد و نوع LED : ٣عدد \r\nروشنایی : ١٦٠٠ لومن\r\nرنگ LED : سفید ٦٥٠٠-٧٠٠٠ كلوین\r\nولتاژ ورودی : ٨-٣٦ ولت\r\nسه رنگ  : آبی ، قرمز ، سفید\r\nفن ندارد\r\n', 2, '٢١٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد.', ''),
(18, 'هدلایت MG7', '005', 19, 'قدرت : ٤٠ وات\r\nتعداد و نوع LED : ٢طرف ٤ عدد ZEC CHIP\r\nروشنایی : ٤٠٠٠ لومن\r\nرنگ LED : سفید٣٠٠٠ -٧٠٠٠ كلوین\r\nولتاژ ورودی : ٨-٣٦ ولت\r\nفن ندارد\r\n', 5, '١،٦١٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد.', ''),
(19, 'هدلایت MG6', '006', 18, 'قدرت : ٤٨ وات\r\nتعداد و نوع LED : ٤طرف ٦ عدد PHILIPS CHIP \r\nروشنایی : ٤٨٠٠ لومن\r\nرنگ LED : سفید ٣٠٠٠-٧٠٠٠ كلوین\r\nولتاژ ورودی : ٩-٣٦ ولت\r\nفن دارد', 4, '٢.٥٠٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد', ''),
(20, 'هدلایت2-MC1', '007', 18, 'قدرت : ٣٠وات\r\nتعداد و نوع LED : ٢عدد COB\r\nروشنایی : ٣٠٠٠ لومن\r\nرنگ LED : سفید ٦٥٠٠-٧٠٠٠ كلوین\r\nولتاژ ورودی : ١٢-٢٤ ولت\r\nفن ندارد', 6, '٦٦٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد', ''),
(21, 'هدلایتMC1-1', '008', 18, 'قدرت : ٣٠وات\r\nتعداد و نوع LED : ٢عدد COB\r\nروشنایی : ٣٠٠٠ لومن\r\nرنگ LED : سفید ٦٥٠٠-٧٠٠٠ كلوین\r\nولتاژ ورودی : ١٢-٢٤ ولت\r\nفن ندارد', 8, ' ٦٦٠،٠٠٠ ریال', 'هدلایت خودرو چیست؟ ال ای دی هدلایت نسل جدید سیستم روشنایی خودرو می باشد که همانند زنون دارای نوری بیش از لامپ هالوژن بوده ولی به دلیل عدم استفاده از گاز در این نوع لامپ ها نیاز به شارژ ندارد', ''),
(22, 'دی لایت', '009', 19, 'دی لایت ٢٤ ولت ٦٠٠٠ كلوین\r\n', 7, ' ١٩٠،٠٠٠ ریال', 'دی لایت فیبر نوری طرح L با نوری بسیار درخشنده و خیره کننده.\r\nدی لایت به منظور جلب توجه عابرین پیاده و سایر خودرو ها در روز و شب مورد استفاده قرار میگیرد.\r\nنصب:\r\nقابل نصب در تمام خودرو ها\r\nنصب در داخل کاسه چراغ و بر روی سپر\r\nنصب به وسیله چسب دوطرفه\r\nمشخصات:\r\nضد آب\r\nنمونه درجه 1\r\nضخامت 5 میلیمتر\r\nدارای نور سفید(یخی) یکنواخت و یکدست\r\nهر بسته شامل 2 عدد دی لایت می باشد\r\nعمر مفید 50,000 ساعت\r\nبدون نویز و ارور در خودرو های روز دنیا', ''),
(23, 'دی لایت', '010', 19, 'دی لایت ٢٤ ولت ٦٠٠٠ كلوین ', 5, '٣٣٠،٠٠٠ ریال', 'دی لایت فیبر نوری طرح L با نوری بسیار درخشنده و خیره کننده.\r\nدی لایت به منظور جلب توجه عابرین پیاده و سایر خودرو ها در روز و شب مورد استفاده قرار میگیرد.\r\nنصب:\r\nقابل نصب در تمام خودرو ها\r\nنصب در داخل کاسه چراغ و بر روی سپر\r\nنصب به وسیله چسب دوطرفه\r\nمشخصات:\r\nضد آب\r\nنمونه درجه 1\r\nضخامت 5 میلیمتر\r\nدارای نور سفید(یخی) یکنواخت و یکدست\r\nهر بسته شامل 2 عدد دی لایت می باشد\r\nعمر مفید 50,000 ساعت\r\nبدون نویز و ارور در خودرو های روز دنیا', ''),
(24, 'لیزر فوگ لایت', '012', 18, 'طول 20mm\r\nعرض 15mm\r\nارتفاع 20mm\r\nولتاژ 12v\r\nتوان(وات) 0.7w\r\nضد آب هست\r\n', 5, '٢٩٠،٠٠٠ ریال', 'لیزر لایت در جاده های بارانی و مه آلود و همینطور جاده های تاریک به کمک شما آمده تا حریم امن پشت سر خود را برای سایر رانندگان مشخص کنید و باعث حفظ رعایت فاصله طولی شده که به ندرت در کشور ما رعایت می شود.\r\nرانندگان در هنگام تصادف از عقب کمترین نقش ممکن را داشته و این وسیله موجب هشدار به رانندگان پشت سر شما به منظور جلوگیری از نزدیک شدن بیش از حد به شما می شود.\r\nاین قطعه بسیار کوچک بوده و تقریبا اندازه یک دوربین دنده عقب است. در پشت خودرو می تواند در بالای پلاک یا زیر سپر و هر محل مناسبی بوسیله پیچ های 1 میل خود دستگاه نصب شود.\r\nنصب آسان و بسیار با دوام.\r\nپخش توسط آپشن بصورت انحصاری\r\nدارای توان خروجی 0.7 وات', '');

-- --------------------------------------------------------

--
-- Table structure for table `mailq`
--

CREATE TABLE IF NOT EXISTS `mailq` (
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

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `date` int(11) NOT NULL,
  `visit` int(11) NOT NULL,
  `pic` text COLLATE utf8_persian_ci NOT NULL,
  `tag` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `text`, `date`, `visit`, `pic`, `tag`) VALUES
(2, 'همکاری دانشگاه Politècnica de Catalunya در اسپانیا و شرکت Eolgreen منجر به طراحی و ساخت پایه های روشنایی ترکیبی با استفاده از انرژی باد و خورشید گردید.', '<p>ارتفاع این پایه ها معادل 10 متر ( 32.8 فوت) و سستم روشنایی آن توسط LED می باشد. جنس پره های توربین بادی در بالای چراغ از نوع کامپوزیت بوده و تولید برق با سرعت حداقل باد در حدود 1.7 متر بر ثانیه (5.6 ft) می باشد.</p>\r\n<p>حداکثر توان خروجی با سرعت توربین بین 10 تا 200 دور در دقیقه (RPM) در حدود 400 وات می باشد.</p>', 1479064845, 26, 'data/news/2/0-c16efc12468b6481436d094aa973509c.jpg', 'فروشگاه,لامپ'),
(4, 'تصمیم لندن برای گرم کردن خانه‌ها با گرمای مترو', '<p>هرکسی که سری به متروهای لندن زده باشد، احتمالا می&zwnj;داند که حرارت زیادی در آنجا وجود دارد، حتی در زمستان. این گرمای مجود در فضای زیر زمین هدر می&zwnj;رود درحالیکه انسان&zwnj;های بالای آن، برای گرم کردن خانه&zwnj;های خود با دشواری&zwnj;های خاصی مواجه هستند. این مسئله یک یده را به دنبال خود داشته است: &ldquo;استحصال انرژی گرمایی تونل&zwnj;های مترو برای گرم کردن ساکنان لندن&ldquo;.</p>', 1479300317, 19, 'data/news/4/0-19014015574491b777fed9cce4853aa3.jpg', 'فناوری,خودرو,مترو'),
(3, 'افتتاح بزرگ‌ترین نیروگاه خورشیدی فراساحلی در ژاپن', '<p dir="rtl">شرکت <a href="http://global.kyocera.com/news/2013/1101_nnms.html" target="_blank" rel="nofollow"><strong>Kyocera</strong></a> به تازگی&nbsp; طرح ایجاد بزرگ&zwnj;ترین<a href="http://ecogeek.ir/tag/solar-power-plant/" target="_blank"> نیروگاه خورشیدی </a>فراساحلی ژاپن را آغاز کرده است.<a href="http://ecogeek.ir/" target="_blank">انرژی پاک</a> تولید شده توسط نیروگاه 70 مگاواتی کاگوشیما ناناتسوجیما از طریق یک شرکت محلی برق، به شبکه برق ملی فروخته خواهد شد. با اینکه <a href="http://ecogeek.ir/category/energy/solar-energy-news/" target="_blank">انرژی خورشیدی</a> در مقیاس مفید در اول نوامبر 2013 راه افتاد ولی به طور رسمی در چهارم نوامبر افتتاح شد.</p>\r\n<p dir="rtl">Kyocera&nbsp; با همکاری شش شرکت دیگر برای راه اندازی این نیروگاه همکاری کرده است. این شرکت امیدوار است که این ریسک اخیر فراساحلی نمونه&zwnj;ای برای ژاپنی تمیزتر باشد. این نیروگاه خورشیدی طراحی شده تا ژاپن را به استفاده هرچه بیشتر از منابع انرژی&zwnj;های نو تشویق کند.</p>\r\n<p dir="rtl">ایجاد این نیروگاه به علت تجدید نظر در برنامه تعرفه تغذیه به شبکه برق (FIT= feed in tariff) ژاپن ممکن شد که در جولای 2012 بازسازی شد و به موجب آن، انرژی خورشیدی توانست جایگاه بهتری پیدا کند. تنظیمات تغذیه به شبکه برق، تجهیزات محلی را ملزم می&zwnj;کند تا 100 درصد انرژی حاصل از نیروگاه&zwnj;های خورشیدی که بیش از 10 کیلووات تولید می&zwnj;کنند را خریداری نمایند.</p>', 1479149142, 36, 'data/news/3/0-5e313ee0736adfe99df0d369932094f6.jpg', 'موتورسیکلت,لامپ نئون');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
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

CREATE TABLE IF NOT EXISTS `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `unitcost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `link` text COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `pic` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `name`, `link`, `description`, `pic`) VALUES
(16, '', '', '', 'data/slideshow/0-9447-2d109c8fdb3c7fa4c15010a678dfdc10.png'),
(17, '', '', '', 'data/slideshow/0-1408-d77562b888a91730cc38ecf42e58207a.png'),
(18, '', '', '', 'data/slideshow/0-5764-35791413e00fa7b0cc7a48fcc43dd2fd.png'),
(14, '', '', '', 'data/slideshow/0-7272-811df8a748bce9ddf134a8d63bc7a294.png'),
(15, '', '', '', 'data/slideshow/0-4981-e8f71144a0f354e76320bd3090a269b9.png'),
(13, '', '', '', 'data/slideshow/0-2996-32a0bc86899a3023791b34ef79b25595.png');

-- --------------------------------------------------------

--
-- Table structure for table `texty`
--

CREATE TABLE IF NOT EXISTS `texty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان لاتین',
  `name_fa` text COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان فارسی',
  `content` text COLLATE utf8_persian_ci NOT NULL COMMENT 'محتوا'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

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

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `permission` int(12) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `wallet_credit` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permission`, `name`, `tell`, `cell`, `wallet_credit`) VALUES
(1, 'admin', 'hellcat', 2, 'مدیریت سایت', '02166936950', '09127744129', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `_links`
--

CREATE TABLE IF NOT EXISTS `_links` (
  `_id` int(12) NOT NULL,
  `_url` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(50) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_priority` int(1) NOT NULL DEFAULT '0',
  `_status` int(1) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_links`
--

INSERT INTO `_links` (`_id`, `_url`, `_title`, `_type`, `_priority`, `_status`, `parent`) VALUES
(9, './about', 'درباره ما', 'index', 4, 1, 0),
(10, './contact', 'ارتباط با ما', 'index', 3, 1, 0),
(18, './home', 'صفحه اصلی', 'index', 1, 1, 0),
(16, './register', 'ثبت نام', 'index', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_pages`
--

CREATE TABLE IF NOT EXISTS `_pages` (
  `_page` int(11) NOT NULL,
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `meta_title` text COLLATE utf8_persian_ci NOT NULL COMMENT 'عنوان صفحه',
  `meta_kw` text COLLATE utf8_persian_ci NOT NULL COMMENT 'کلمات کلیدی',
  `meta_desc` text COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات'
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

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
(6, 'قوانین و مقرارت نورین مدار', '', '', ''),
(7, 'ضوابط حفظ حریم خصوصی', '', '', ''),
(153, 'خدمات پس از فروش', '', '', ''),
(109, 'نمایش محصول', '<?\r\necho table("irtoya_staff", $_REQUEST["id"], "name");\r\n?>', '<?\r\n$cat_text = cat_translate( table("irtoya_staff", $_REQUEST["id"], "cat") );\r\n$text = table("irtoya_staff", $_REQUEST["id"], "name");\r\n$text_col = $cat_text." ".$text;\r\n$text = str_replace( " " , "," , $text_col);\r\necho $text;\r\n?>', '<?\r\necho str_replace( "\\n", " " , table("irtoya_staff", $_REQUEST["id"], "desc")) ;\r\n?>'),
(66, 'سبد خرید', '', '', ''),
(58, 'ثبت نام', '', '', ''),
(59, 'ثبت نام #2', '', '', ''),
(60, 'ورود کاربر', '', '', ''),
(63, 'فراموشی کلمه عبور', '', '', ''),
(14, 'محیط کاربری', '', '', ''),
(51, 'اخبار سایت', '', '', ''),
(52, 'نمایش خبر', '<?\r\necho news_meta( "title" );\r\n?>', '<?\r\necho news_meta( "kw" );\r\n?>', '<?\r\necho news_meta( "desc" );\r\n?>'),
(160, 'راهنمای پرداخت آنلاین', '', '', ''),
(161, 'دسته بندی', '<?\r\necho cat_translate( $_REQUEST["cat_id"] );\r\n?>', '<?\r\n$text = cat_translate( $_REQUEST["cat_id"] );\r\n$text = str_replace( " " , "," , $text );\r\necho $text;\r\n?>', '<?\r\necho cat_translate( $_REQUEST["cat_id"] );\r\n?>');

-- --------------------------------------------------------

--
-- Table structure for table `_page_frames`
--

CREATE TABLE IF NOT EXISTS `_page_frames` (
  `_id` int(12) NOT NULL,
  `_position` varchar(50) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_priority` int(6) NOT NULL DEFAULT '0',
  `_func` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(25) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_data` text COLLATE utf8_persian_ci NOT NULL,
  `_framed` int(6) NOT NULL DEFAULT '0',
  `_status` int(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=10000007 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_page_frames`
--

INSERT INTO `_page_frames` (`_id`, `_position`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES
(10000001, 'top', 1, 'post', 'PHP5', 'this is the top title', '<?php\r\nf_front__f_html__TOP();\r\n?>', 0, 1),
(10000002, 'down', 2, 'post', 'PHP5', 'down...', '<?php\r\nf_front__f_html__DOWN();\r\n?>', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_page_layers`
--

CREATE TABLE IF NOT EXISTS `_page_layers` (
  `_id` int(11) NOT NULL,
  `_page` int(6) NOT NULL DEFAULT '0',
  `_priority` int(6) NOT NULL DEFAULT '0',
  `_func` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_type` varchar(25) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_title` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_data` text COLLATE utf8_persian_ci NOT NULL,
  `_framed` int(6) NOT NULL DEFAULT '0',
  `_status` int(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_page_layers`
--

INSERT INTO `_page_layers` (`_id`, `_page`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES
(2, 2, 1, 'contact_display', '', 'ارتباط با ما', '', 1, 1),
(20, 20, 1, 'faq_display', '', 'سوالات متداول', '', 1, 1),
(1, 1, 1, 'slideshow_display', '', 'نمایش اسلاید', '', 1, 1),
(3, 3, 1, 'post', 'HTML', 'درباره ما', '<p><strong>شركت نورين مدار</strong></p>\r\n<p>به طور متمرکز در زمینه فروش لوازم جانبی خودرو فعالیت داشته و توانسته در مدت حیات خود سهم قابل توجهی در بازار را به خود اختصاص دهد که این امر ناشی از قیمت مناسب، حذف واسطه ها، کیفیت خوب، خدمات شایسته و به روز بودن محصولات ميباشد &lrm;</p>\r\n<p><strong>رضایت شما، رمز ماندگاری ماست</strong>.</p>', 1, 1),
(4, 4, 1, 'post', 'HTML', 'راهنمای سایت', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(5, 5, 1, 'post', 'HTML', 'آموزش', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(6, 6, 1, 'post', 'HTML', 'قوانین و مقرارت نورین مدار', '<p><br /><br /></p>\r\n<center class="tx1">اين صفحه در حال طراحي ميباشد</center>\r\n<p><br /><br /></p>', 1, 1),
(7, 7, 1, 'post', 'HTML', 'ضوابط حفظ حریم خصوصی', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(52, 52, 1, 'news_display', '', 'نمایش خبر', '', 1, 1),
(51, 51, 1, 'news_list', '', 'اخبار سایت', '', 1, 1),
(101, 1, 4, 'news_list', '', 'خبرها', '', 1, 1),
(153, 153, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(168, 109, 1, 'is_display', 'HTML', 'نمایش محصول', '', 1, 1),
(66, 66, 1, 'post', 'PHP5', 'سبد خرید', '<?\r\norders_basket_list();\r\n?>', 1, 1),
(58, 58, 1, 'post', 'PHP5', 'ثبت نام', '<?\r\nusers_register_form();\r\n?>', 1, 1),
(59, 59, 1, 'post', 'PHP5', 'ثبت نام', '<?\r\nusers_register_do();\r\n?>', 1, 1),
(60, 60, 1, 'post', 'PHP5', 'ورود کاربر', '<?\r\nusers_login_form();\r\n?>', 1, 1),
(63, 63, 1, 'post', 'PHP5', 'فراموشی کلمه عبور', '<?\r\nusers_forgot_form();\r\n?>', 1, 1),
(14, 14, 1, 'post', 'PHP5', 'پنل کاربر', '<? userpanel_menu(); ?>\r\n<div class="userpanel_desk_container">\r\n    <? userpanel_desk(); ?>\r\n</div>', 1, 1),
(159, 1, 3, 'is_list', 'HTML', 'محصولات', '', 1, 1),
(162, 1, 2, 'cat_product_display', 'HTML', 'گروه محصولات', '', 1, 1),
(164, 160, 1, 'post', 'HTML', 'راهنمای پرداخت آنلاین', '<p><br /><br /></p>\r\n<center class="tx1">اين صفحه در حال طراحي ميباشد</center>\r\n<p><br /><br /></p>', 1, 1),
(167, 161, 3, 'is_list', 'HTML', 'محصولات', '', 1, 1),
(166, 161, 2, 'cat_product_display', 'HTML', 'گروه محصولات', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_temp`
--

CREATE TABLE IF NOT EXISTS `_temp` (
  `_key` varchar(250) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `_val` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `_temp`
--

INSERT INTO `_temp` (`_key`, `_val`) VALUES
('main_title', 'نورین مدار'),
('money_unit', 'ریال'),
('template', 'Default'),
('cu_company_tell', '(021) 66827225'),
('cu_company_fax', '(021) 66827225'),
('cu_company_addr', 'تهران'),
('websitedescription', 'فروش'),
('keywords', 'لامپ,LED,نور,چراغ'),
('about', 'تمامی حقوق برای مجموعه نورین مدار محفوظ است'),
('email_address_webadmin', 'info@norinmadar.com'),
('email_address_management', 'admin@norinmadar.com'),
('email_address_sell', 'sales@norinmadar.com'),
('email_address_support', 'support@norinmadar.com'),
('sms_state', '1'),
('webstatus_main', '1'),
('unsuccessful_attack', '195'),
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
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`), ADD UNIQUE KEY `code_2` (`code`);

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
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `texty`
--
ALTER TABLE `texty`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `billing_method`
--
ALTER TABLE `billing_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `irtoya_staff`
--
ALTER TABLE `irtoya_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `mailq`
--
ALTER TABLE `mailq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `texty`
--
ALTER TABLE `texty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `_links`
--
ALTER TABLE `_links`
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `_pages`
--
ALTER TABLE `_pages`
  MODIFY `_page` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `_page_frames`
--
ALTER TABLE `_page_frames`
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10000007;
--
-- AUTO_INCREMENT for table `_page_layers`
--
ALTER TABLE `_page_layers`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
