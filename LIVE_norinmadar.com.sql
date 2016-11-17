-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2016 at 11:16 AM
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

--
-- Dumping data for table `billing_invoice`
--

INSERT INTO `billing_invoice` (`id`, `uid`, `order_id`, `cost`, `method`, `transaction`, `date`) VALUES
(1, 1, 0, 1000, 'manual3', '29038498457', 1478520000);

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
(3, 'manual2', '', '', '', '', 'بانک صادرات', '8123212345', '6037691044443333', '', 'offline', 1),
(4, 'manual3', '', '', '', '', 'بانک صادرات', '234584599848', '6037691044320099', '', 'offline', 0);

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
(12, 'هیوندای', 0, 'brand', 0, 'data/cat/brand/0-baeae99903ae93e12e1e9aea391ccf50.png'),
(16, 'از طریق پست', 0, 'how_to_buy', 0, ''),
(17, 'نقدی', 0, 'how_to_buy', 0, ''),
(18, 'ولتاژ بالا ', 0, 'main', 0, ''),
(19, 'ولتاژ پایین', 0, 'main', 0, '');

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
  `name` text COLLATE utf8_persian_ci NOT NULL COMMENT 'نام محصول',
  `code` varchar(300) COLLATE utf8_persian_ci NOT NULL COMMENT 'کد محصول',
  `cat` int(11) NOT NULL COMMENT 'گروه',
  `technical_features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'مشخصات فنی',
  `number` int(11) NOT NULL COMMENT 'تعداد',
  `price` text COLLATE utf8_persian_ci NOT NULL COMMENT 'قیمت',
  `desc` text COLLATE utf8_persian_ci NOT NULL COMMENT 'توضیحات',
  `autoparts` text COLLATE utf8_persian_ci NOT NULL COMMENT 'عکس'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `irtoya_staff`
--

INSERT INTO `irtoya_staff` (`id`, `name`, `code`, `cat`, `technical_features`, `number`, `price`, `desc`, `autoparts`) VALUES
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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `text`, `date`, `visit`, `pic`, `tag`) VALUES
(2, 'همکاری دانشگاه Politècnica de Catalunya در اسپانیا و شرکت Eolgreen منجر به طراحی و ساخت پایه های روشنایی ترکیبی با استفاده از انرژی باد و خورشید گردید.', '<p>ارتفاع این پایه ها معادل 10 متر ( 32.8 فوت) و سستم روشنایی آن توسط LED می باشد. جنس پره های توربین بادی در بالای چراغ از نوع کامپوزیت بوده و تولید برق با سرعت حداقل باد در حدود 1.7 متر بر ثانیه (5.6 ft) می باشد.</p>\r\n<p>حداکثر توان خروجی با سرعت توربین بین 10 تا 200 دور در دقیقه (RPM) در حدود 400 وات می باشد.</p>', 1479064845, 25, 'data/news/2/0-c16efc12468b6481436d094aa973509c.jpg', '8787'),
(4, 'تصمیم لندن برای گرم کردن خانه‌ها با گرمای مترو', '<p>هرکسی که سری به متروهای لندن زده باشد، احتمالا می&zwnj;داند که حرارت زیادی در آنجا وجود دارد، حتی در زمستان. این گرمای مجود در فضای زیر زمین هدر می&zwnj;رود درحالیکه انسان&zwnj;های بالای آن، برای گرم کردن خانه&zwnj;های خود با دشواری&zwnj;های خاصی مواجه هستند. این مسئله یک یده را به دنبال خود داشته است: &ldquo;استحصال انرژی گرمایی تونل&zwnj;های مترو برای گرم کردن ساکنان لندن&ldquo;.</p>', 1479300317, 18, 'data/news/4/0-19014015574491b777fed9cce4853aa3.jpg', 'dfdfd'),
(3, 'افتتاح بزرگ‌ترین نیروگاه خورشیدی فراساحلی در ژاپن', '<p dir="rtl">شرکت <a href="http://global.kyocera.com/news/2013/1101_nnms.html" target="_blank" rel="nofollow"><strong>Kyocera</strong></a> به تازگی&nbsp; طرح ایجاد بزرگ&zwnj;ترین<a href="http://ecogeek.ir/tag/solar-power-plant/" target="_blank"> نیروگاه خورشیدی </a>فراساحلی ژاپن را آغاز کرده است.<a href="http://ecogeek.ir/" target="_blank">انرژی پاک</a> تولید شده توسط نیروگاه 70 مگاواتی کاگوشیما ناناتسوجیما از طریق یک شرکت محلی برق، به شبکه برق ملی فروخته خواهد شد. با اینکه <a href="http://ecogeek.ir/category/energy/solar-energy-news/" target="_blank">انرژی خورشیدی</a> در مقیاس مفید در اول نوامبر 2013 راه افتاد ولی به طور رسمی در چهارم نوامبر افتتاح شد.</p>\r\n<p dir="rtl">Kyocera&nbsp; با همکاری شش شرکت دیگر برای راه اندازی این نیروگاه همکاری کرده است. این شرکت امیدوار است که این ریسک اخیر فراساحلی نمونه&zwnj;ای برای ژاپنی تمیزتر باشد. این نیروگاه خورشیدی طراحی شده تا ژاپن را به استفاده هرچه بیشتر از منابع انرژی&zwnj;های نو تشویق کند.</p>\r\n<p dir="rtl">ایجاد این نیروگاه به علت تجدید نظر در برنامه تعرفه تغذیه به شبکه برق (FIT= feed in tariff) ژاپن ممکن شد که در جولای 2012 بازسازی شد و به موجب آن، انرژی خورشیدی توانست جایگاه بهتری پیدا کند. تنظیمات تغذیه به شبکه برق، تجهیزات محلی را ملزم می&zwnj;کند تا 100 درصد انرژی حاصل از نیروگاه&zwnj;های خورشیدی که بیش از 10 کیلووات تولید می&zwnj;کنند را خریداری نمایند.</p>', 1479149142, 28, 'data/news/3/0-5e313ee0736adfe99df0d369932094f6.jpg', '5454');

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
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `link` text COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `pic` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `name`, `link`, `description`, `pic`) VALUES
(1, 'اسلاید ۱ برای تست', 'http://google.com', 'یه توضیحاتی برای آزمایش', 'data/slideshow/0-4226-531bc77f5bdd5c5ebe587446dda7a2fc.jpg'),
(2, 'اسلاید دوم برای ازمایش مجدد', 'http://yahoo.com', 'توضیحاتی چند در مدح پروردگار', 'data/slideshow/0-3765-6a36ecf030777c5c3658dd0b7bf5b84e.jpg'),
(3, 'اسلاید سوم ۰۰۰', 'http://tech.yahoo.com', 'آزمایشی دگر', 'data/slideshow/0-8096-b578b24041bfaa27b10f9d83547b1233.jpg');

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
(1, 'admin', 'hellcat', 2, 'مدیریت سایت', '02166936950', '09127744129', 1000);

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
(17, './product', 'محصولات', 'index', 9, 1, 0),
(12, './orders-basket-confirm', 'سبد خرید', 'index', 4, 1, 0),
(16, './register', 'ثبت نام', 'index', 8, 1, 0);

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
(6, 'قوانین و مقرارت نورین مدار', '', '', ''),
(7, 'ضوابط حفظ حریم خصوصی', '', '', ''),
(153, 'خدمات پس از فروش', '', '', ''),
(154, 'نمایندگی ها', '', '', ''),
(155, 'امور مشتریان', '', '', ''),
(156, 'نمایش محصول', '<?\r\necho irtoya_meta( "title" );\r\n?>', '<?\r\necho irtoya_meta( "kw" );\r\n?>', '<?\r\necho irtoya_meta( "desc" );\r\n?>'),
(157, 'مقایسه محصول', '', '', ''),
(158, 'تویوتا کمری هایبرید', '', '', ''),
(108, 'محصولات ما', '', '', ''),
(109, 'نمایش قطعه', '<?\r\necho is_meta( "title" );\r\n?>', '<?\r\necho is_meta( "kw" );\r\n?>', '<?\r\necho is_meta( "desc" );\r\n?>'),
(66, 'سبد خرید', '', '', ''),
(58, 'ثبت نام', '', '', ''),
(59, 'ثبت نام #2', '', '', ''),
(60, 'ورود کاربر', '', '', ''),
(63, 'فراموشی کلمه عبور', '', '', ''),
(14, 'محیط کاربری', '', '', ''),
(51, 'اخبار سایت', '', '', ''),
(52, 'نمایش خبر', '<?\r\necho news_meta( "title" );\r\n?>', '<?\r\necho news_meta( "kw" );\r\n?>', '<?\r\necho news_meta( "desc" );\r\n?>'),
(159, 'محصولات', '', '', '');

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
(10000002, 'down', 2, 'post', 'PHP5', 'down...', '<?php\r\nf_front__f_html__DOWN();\r\n?>', 0, 1);

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
(1, 1, 1, 'slideshow_display', '', 'نمایش اسلاید', '', 1, 1),
(3, 3, 1, 'is_about', '', 'درباره ما', '', 1, 1),
(4, 4, 1, 'post', 'HTML', 'راهنمای سایت', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(5, 5, 1, 'post', 'HTML', 'آموزش', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(6, 6, 1, 'post', 'HTML', 'قوانین و مقرارت نورین مدار', '<p><br /><br /></p>\r\n<center class="tx1">اين صفحه در حال طراحي ميباشد</center>\r\n<p><br /><br /></p>', 1, 1),
(7, 7, 1, 'post', 'HTML', 'ضوابط حفظ حریم خصوصی', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(52, 52, 1, 'news_display', '', 'نمایش خبر', '', 1, 1),
(51, 51, 1, 'news_list', '', 'اخبار سایت', '', 1, 1),
(101, 1, 3, 'news_list', '', 'خبرها', '', 1, 1),
(153, 153, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(154, 154, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(155, 155, 1, 'post', 'HTML', 'بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>', 1, 1),
(156, 156, 1, 'irtoya_display', '', 'نمایش محصول', '', 1, 1),
(157, 157, 1, 'post', 'PHP5', 'مقایسه محصول', '<?\r\nirtoya_compare();\r\n?>', 1, 1),
(158, 158, 1, 'post', 'HTML', 'نقد و بررسی: تویوتا کمری هایبرید ۲۰۱۵', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p style="text-align: right;"><span style="font-size: 12px;">در نگاه اول سه دلیل برای دوست داشتن این خودرو به ذهن می&zwnj;آید. اول این&zwnj;که استایل جدید front-end که تویوتا در آن به&zwnj;کاربرده است خوب به نظر می&zwnj;آید. دوم آنکه سیستم استریو JBL GreenEdge برای گوش دادن موسیقی و حتی پاسخ دادن به تماس&zwnj;های تلفن همراه نیز بسیار خوب عمل می&zwnj;کند , سوم آنکه فرمان پذیری این مدل از تویوتا بسیار بهینه&zwnj;تر از مدل&zwnj;های قبلی شده است.<img class="aligncenter size-full wp-image-3808" src="uploads/2015toyotacamry-004.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">البته در طول یک&zwnj;هفته&zwnj;ای که توانستیم این خودرو را از نزدیک بررسی کنیم دلایل متعدد دیگری نیز در این خصوص یافتیم که در ادامه بیشتر آن&zwnj;ها را بررسی خواهیم کرد؛ &nbsp;درواقع باید گفت که این آن تویوتا کمری نیست که به دنبالش بودید.<img class="aligncenter size-full wp-image-3816" src="uploads/2015toyotacamry-015.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">در تویوتا کمری مدل ۲۰۱۵ به&zwnj;روزرسانی&zwnj;های بسیار مهمی نسبت به سایر سدان ها میان اندازه تویوتا صورت گرفته است. این خودرو جدید دارای یک دستیار راننده جدید نیز هست که باعث می&zwnj;شود بتوانید ارتباط بهتری با Entune، سیستم یکپارچه نرم&zwnj;افزاری تویوتا داشته باشید. البته انتخاب&zwnj;های driveline تغییرات زیادی نکرده&zwnj;اند.</span></p>\r\n<h3 style="text-align: right;"><strong><span style="font-size: 12px;">به دنیای نرم&zwnj;افزار خوش&zwnj;آمدید</span></strong></h3>\r\n<p style="text-align: right;"><span style="font-size: 12px;">صفحه&zwnj;نمایش بزرگی ال سی دی در وسط داشبورد قرار دارد که کار با آن بسیار راحت است. البته باوجوداینکه تویوتا در لیست آپشن های خودرو به&zwnj;صراحت ذکر کرده است که این خودرو مجهز به Entune Premium JBL Audio with Navigation App Suite است اما کلید مربوط به ناوبری در آن دیده نمی&zwnj;شود. به&zwnj;جای آن کلید بزرگی به نام Apps وجود دارد که درواقع اصطلاح جدید ابداعی تویوتا برای انواع فناوری&zwnj;های نرم افزاری است که در اتاق خودرو از آن استفاده&zwnj;شده است.<img class="aligncenter size-full wp-image-3820" src="uploads/2015toyotacamry-020.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">با زدن این کلید سه صفحه آیکون را روبروی خود خواهید دید و زمانی که از طریق گوشی خودم به Entune متصل شدم توانستم بخش ناوبری را نیز در میان آن&zwnj;ها پیدا کنم. درواقع با این کار امکان حذف و اضافه نرم&zwnj;افزارها و امکانات به انواع خودروهای کمری تویوتا افزوده می&zwnj;شود که به&zwnj;این&zwnj;ترتیب نیاز به طراحی کلیدهای فیزیکی نیز در این خصوص دیده نمی&zwnj;شود.&nbsp;به نظر می&zwnj;رسد سیستم ناوبری این مدل نسبت به نسل قبلی کمری به&zwnj;روزتر شده باشد. اعلان&zwnj;های مربوط به ترافیک، تغییر مسیرهای برنامه&zwnj;ریزی&zwnj;شده، راهنمای مسیر، بهبودهای گرافیکی و مواردی ازاین&zwnj;دست همگی بهبودهای بسیار خوبی پیداکرده&zwnj;اند.<img class="aligncenter size-full wp-image-3825" src="uploads/2015toyotacamry-027.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">تمام برنامه&zwnj;هایی که در صفحه&zwnj;نمایش ال سی دی لمس می&zwnj;کنید به سرعت اجرا می&zwnj;شوند و کندی در اجرای آن&zwnj;ها دیده نمی&zwnj;شود. سازمان&zwnj;دهی و دسته&zwnj;بندی آیکون&zwnj;ها خوب انجام&zwnj;شده است با این&zwnj;که گرافیک آن&zwnj;ها هنوز جای کار بیشتری دارد. البته امکان سفارشی&zwnj;سازی نمایش این آیکون&zwnj;ها نیز وجود دارد.<img class="aligncenter size-full wp-image-3830" src="uploads/2015toyotacamry-036.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="505" /></span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">تویوتا سامانه فرمان صوتی را هم در بخش Entune و هم در فرمان خودرو قرار داده است که با توجه به نوع زبان راننده به&zwnj;خوبی می&zwnj;تواند فرمان&zwnj;ها را دریافت و پردازش کند. از سوی دیگر سیستم یکپارچه Entune که تویوتا ارائه کرده است از طریق نصب اپلیکیشن های مخصوص آن در اندروید و iOS و حتی اتصال از طریق بلوتوث نیز به&zwnj;راحتی قابل&zwnj;کنترل و کار است. با این کار می&zwnj;توانیم از نرم&zwnj;افزارهایی چون Bing search, OpenTable, Yelp و HeartRadio در صفحه&zwnj;نمایش لمسی خودرو خود استفاده کنیم. باید گفت که نسل قبلی تویوتا کمری نیز به سیستم یکپارچه Entune مجهز بود اما بسیار خسته&zwnj;کننده و فاقد کار آیی لازم بود، مسئله ای که در نسل جدید تویوتا کمری با اعمال به&zwnj;روزرسانی&zwnj;ها و تغییر رابط کاربری به&zwnj;خوبی رفع شده است.</span></p>\r\n<p style="text-align: right;"><span style="font-size: 12px;"><a href="http://bamanbekhar.com/wp-content/uploads/2015/03/2015toyotacamry-044.jpg"><img class="aligncenter size-full wp-image-3833" src="uploads/2015toyotacamry-044.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="507" /></a></span></p>\r\n<p style="text-align: right;">&nbsp;</p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">اما جالب&zwnj;تر آنکه بسیاری از اپلیکیشن ها با سیستم ناوبری خودرو در ارتباط هستند، به&zwnj;طور مثال می&zwnj;توانید کلمه&zwnj;ای را در موتور جستجوی Bing، جستجو کنید و درنهایت نتیجه&zwnj;ای را که منطبق با مسیر و یا مقصد شماست انتخاب کنید. iHeartRadio هم به شما این امکان را می&zwnj;دهد تا بین لیستی از ایستگاه&zwnj;های رادیویی بین&zwnj;المللی به جستجو بپردازید. البته در کنار این&zwnj;ها تویوتا کمری دارای تمامی آپشن های صوتی معمول چون اتصال بلوتوث، اتصال به iOS، درگاه USB و رادیو HD هست. البته بااتصال بلوتوث تنها می&zwnj;توانید از طریق صفحه&zwnj;نمایش لمسی موسیقی موردنظر خود را متوقف کنید و یا به موسیقی بعدی بروید درحالی&zwnj;که با استفاده از درگاه USB امکانات کاملی از قبلی مدیریت آلبوم&zwnj;ها را برای شنیدن موسیقی دلخواه در اختیار خواهید داشت. از سوی دیگر این مدل تویوتا کمری نخستین مدل خودرویی است که دارای پد شارژ بی&zwnj;سیم Qi است. البته نمونه&zwnj;ای دیگر هم در سال ۲۰۱۳ در Toyota Avalon به کار گرفته&zwnj;شده بود. با داشتن این پد کاربر این امکان را پیدا می&zwnj;کند تا گوشی&zwnj;هایی که از این فناوری پشتیبانی می&zwnj;کند را روی آن قرار دهد و گوشی به&zwnj;صورت بی&zwnj;سیم شارژ شود. به&zwnj;طور مثال اگر گوشی هوشمند شما آیفون است نمی&zwnj;توانید از این فناوری استفاده کنید و قبل از آن باید قاب&zwnj;های سازگار با Qi که مخصوص گوشی&zwnj;های آیفون ساخته&zwnj;شده است را تهیه کنید.</span></p>\r\n<h3 style="text-align: right;"><strong><span style="font-size: 12px;">موتور خودرو</span></strong></h3>\r\n<p style="text-align: right;"><span style="font-size: 12px;">اما کمری ۲۰۱۵ در این خصوص آن&zwnj;چنان چیز جدیدی برای ارائه ندارد. موتور ۳٫۵ لیتری V-6 با سیستم ۶ دنده&zwnj;اتوماتیک ما را به&zwnj;خوبی به یاد نسل قبلی این خودرو خواهد انداخت؛ اما یکی از بهبودهای جزئی که در این نسل قابل اشاره است مقدار fuel economy 21 mpg برای رانندگی شهری و ۳۱ mpg در بزرگراه است.<img class="aligncenter size-full wp-image-3810" src="uploads/2015toyotacamry-006.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;">&nbsp;</p>\r\n<p style="text-align: right;"><span style="font-size: 12px;">موتور تویوتا کمری ۲۰۱۵، ۲۶۸ اسب بخار قدرت دارد و حداکثر گشتاور آن ۲۴۸ pound-feet است. در رانندگی در بزرگراه این خودرو شتاب بسیار خوبی دارد؛ اما برگ برنده این مدل از کمری استفاده از سیستم هایبرید آن است که می&zwnj;تواند ۲۰۰ اسب بخار نیرو تولید کند و با آن به fuel economy میانگین ۴۰ mpg دستیابید. سیستم تعلیق خودرو بسیار نرم طراحی&zwnj;شده و در زمان رانندگی احساس بسیار خوبی خواهید داشت و خودرو هیچ&zwnj;گاه از کنترل راننده خارج نخواهد شد. البته تویوتا کمری یک خودروی اسپرت نیست و نباید انتظارت پایداری یک خودروی اسپرت را از آن داشت. اما دنده &zwnj;اتوماتیک این خودرو دارای دو حالت تعویض دنده خودکار معمولی و اسپرت است. البته به نظر نمی&zwnj;رسد که بسیاری از رانندگان از حالت اسپرت استفاده چندانی کنند؛ اما درست مثل بسیاری از خودروهای امروزی فرمان تویوتا کمری نیز دارای یک موتوربرقی است. موتوربرقی که در نسل های گذشته خودروهای تویوتا استفاده می&zwnj;شد سروصدای زیادی به همراه داشت که این موارد در این مدل رفع شده است. این ویژگی به&zwnj;خصوص در مسیرهای طولانی باعث عدم خستگی راننده می&zwnj;شود.<img class="aligncenter size-full wp-image-3815" src="uploads/2015toyotacamry-014.jpg" alt="۲۰۱۵ Toyota Camry" width="900" height="506" /></span></p>\r\n<p style="text-align: right;">&nbsp;</p>\r\n<p style="text-align: right;">اما مسئله جالب دیگری که در رانندگی با تویوتا کمری ۲۰۱۵ با آن روبرو خواهید شد فناوری دستیار راننده اختصاصی تویوتا است. مجموعه&zwnj;ای از امکانات که به آهستگی در حال ارائه در محصولات تویوتا هست. سیستم کروز کنترل انطباق پذیر که از فناوری رادار پیش برنده استفاده می&zwnj;کند امکانات بی&zwnj;نظیری را برای راننده فراهم می&zwnj;کند. زمانی که به ترافیک می&zwnj;رسید خودرو سرعت را با توجه به&zwnj;سرعت خودرو جلویی تنظیم می&zwnj;کند. این سیستم را در شرایط مختلف جاده و ترافیک تست کردیم و در تمامی آن&zwnj;ها سیستم به&zwnj;خوبی کار کرد.</p>\r\n<h3 style="text-align: right;"><span style="font-size: 12px;">جمع&zwnj;بندی:</span></h3>\r\n<p style="text-align: right;"><span style="font-size: 12px;">باید گفت که تویوتا کمری ۲۰۱۵ به خاطر استایل طراحی جدید، ابزارهای الکترونیکی درون اتاق خودرو و دستیار رانندگی اختصاصی تویوتا از هر نظر یک سدان محبوب به شمار می&zwnj;رود. از سوی دیگر اپلیکیشن های Entune به کاربر این امکان را می&zwnj;دهند به&zwnj;راحتی مقصد خود را پیدا کند و نزدیک&zwnj;تر ترین رستوران یا مرکز رفاهی را در مسیر خود تا رسیدن به مقصد پیدا کندو سیستم صوتی JBL GreenEdge که در این خودرو وجود دارد کیفیت صوت مطلوبی را برای این سدان میان اندازه به وجود آورده است.</span></p>\r\n</body>\r\n</html>', 1, 1),
(108, 108, 1, 'post', 'PHP5', 'محصولات ما', '<?\r\nis_list();\r\n?>', 1, 1),
(109, 109, 1, 'post', 'PHP5', 'نمایش قطعه', '<?\r\nis_display();\r\n?>', 0, 1),
(66, 66, 1, 'post', 'PHP5', 'سبد خرید', '<?\r\norders_basket_list();\r\n?>', 1, 1),
(58, 58, 1, 'post', 'PHP5', 'ثبت نام', '<?\r\nusers_register_form();\r\n?>', 1, 1),
(59, 59, 1, 'post', 'PHP5', 'ثبت نام', '<?\r\nusers_register_do();\r\n?>', 1, 1),
(60, 60, 1, 'post', 'PHP5', 'ورود کاربر', '<?\r\nusers_login_form();\r\n?>', 1, 1),
(63, 63, 1, 'post', 'PHP5', 'فراموشی کلمه عبور', '<?\r\nusers_forgot_form();\r\n?>', 1, 1),
(14, 14, 1, 'post', 'PHP5', 'پنل کاربر', '<? userpanel_menu(); ?>\r\n<div class="userpanel_desk_container">\r\n    <? userpanel_desk(); ?>\r\n</div>', 1, 1),
(159, 1, 2, 'is_list', 'HTML', 'محصولات', '', 1, 1),
(161, 159, 1, 'is_list', '', 'محصولات ما', '', 1, 1);

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
('main_title', 'نورین مدار'),
('money_unit', 'ریال'),
('template', 'Default'),
('cu_company_tell', '(021) 66827225'),
('cu_company_fax', '(021) 66827225'),
('cu_company_addr', 'تهران'),
('websitedescription', 'فروش قطعات'),
('keywords', 'قطعه,ماشین,تولید,بازار'),
('about', 'تمامی حقوق برای مجموعه نورین مدار محفوظ است'),
('email_address_webadmin', 'info@norinmadar.com'),
('email_address_management', 'admin@norinmadar.com'),
('email_address_sell', 'sales@norinmadar.com'),
('email_address_support', 'support@norinmadar.com'),
('sms_state', '1'),
('webstatus_main', '1'),
('unsuccessful_attack', '192'),
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
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `billing_method`
--
ALTER TABLE `billing_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `mailq`
--
ALTER TABLE `mailq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `_pages`
--
ALTER TABLE `_pages`
  MODIFY `_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `_page_frames`
--
ALTER TABLE `_page_frames`
  MODIFY `_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000007;
--
-- AUTO_INCREMENT for table `_page_layers`
--
ALTER TABLE `_page_layers`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
