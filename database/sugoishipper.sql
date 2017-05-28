-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2017 at 07:18 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugoishipper`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_foods`
--

CREATE TABLE `comment_foods` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_posts`
--

CREATE TABLE `comment_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `ordered` int(11) DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `comments` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `delete_flg` tinyint(4) NOT NULL DEFAULT '0',
  `create_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_restaurant` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `material`, `price`, `avatar`, `type`, `ordered`, `likes`, `comments`, `created_at`, `deleted_at`, `delete_flg`, `create_by`, `updated_at`, `id_restaurant`, `deleted_by`) VALUES
(7, 'Lẩu dê Hà Nội', 'Lẩu dê Hà Nội', 550000, 'PlSpOBOpEIQCM.jpg', 1, 0, 0, 0, '2017-05-07 08:24:51', '2017-05-13 17:26:24', 0, 'restaurent123', '0017-05-22 16:47:57', 22, 22),
(8, 'Lẩu Cua Khôi - Trần Hưng Đạo', 'cua, nuoc lau', 300000, 'hvVPgShSgCmNa.jpg', 1, 0, 0, 0, '2017-05-07 08:30:41', '2017-05-18 02:08:21', 0, 'restaurent123', '0017-05-22 16:49:32', 22, 22),
(38, 'Miến Cua tay cầm', 'Miến Cua tay cầm', 300000, 'aRNxhCxTvCRu7.jpg', 1, 0, 0, 0, '2017-05-07 20:46:11', NULL, 0, 'restaurent12', '0017-05-22 16:55:08', 22, 0),
(39, 'Hồng trà việt quất dâu tây', 'Hồng trà việt quất dâu tây', 39000, 'QBB1lD9blUFJW.jpg', 2, 0, 0, 0, '2017-05-07 20:46:54', '2017-05-21 10:05:25', 0, 'restaurent12', '0017-05-22 16:57:13', 22, 1),
(40, 'Machiato matcha + thạch trân châu', 'Machiato matcha + thạch trân châu', 30000, 'f4r8lq58CmQkc.jpg', 2, 0, 0, 0, '2017-05-07 21:04:37', '2017-05-22 03:24:25', 0, 'restaurent12', '0017-05-22 16:57:46', 22, 1),
(41, 'Machiato trà xanh (M)', 'Machiato trà xanh (M)', 35000, 'JuZy70GeeAtlj.jpg', 2, 0, 0, 0, '2017-05-07 21:28:49', NULL, 0, 'restaurent12', '0017-05-22 16:58:30', 22, 0),
(42, 'Trà đen kem sữa', 'Trà đen kem sữa', 20000, 'o4lKYFlkHDxFR.jpg', 2, 0, 0, 0, '2017-05-07 23:14:41', NULL, 0, 'restaurent12', '0017-05-22 16:59:06', 22, 0),
(43, 'Trà đào kem sữa', 'Trà đào kem sữa', 20000, 'H6k7ws0gGsuA1.jpg', 2, 0, 0, 0, '2017-05-07 23:15:10', NULL, 0, 'restaurent12', '0017-05-22 16:59:40', 22, 0),
(44, 'Trà xoài', 'Trà xoài', 12000, 'heQrr6ZEGQr6Y.jpg', 2, 0, 0, 0, '2017-05-08 00:11:29', NULL, 0, 'restaurent12', '0017-05-22 17:00:21', 22, 0),
(45, 'Cua sốt fomai', 'Cua sốt fomai', 150000, 'aTRUcrqKQ8vyS.jpg', 1, 4, 0, 0, '2017-05-13 00:51:06', '2017-05-16 06:05:51', 0, 'restaurent123', '0017-05-22 16:51:16', 22, 22),
(46, 'nghêu hấp xả', 'nghêu hấp xả', 100000, 'gsCacSXniBvpb.jpg', 1, 0, 0, 0, '2017-05-17 19:06:46', NULL, 0, 'restaurent123', '0017-05-22 16:51:47', 22, NULL),
(47, 'sò huyết nướng', 'sò huyết nướng', 120000, 'FHTBkiCwfTEne.jpg', 1, 0, 0, 0, '2017-05-17 19:26:28', '2017-05-18 02:27:50', 0, 'restaurent123', '0017-05-22 16:52:29', 22, 22);

-- --------------------------------------------------------

--
-- Table structure for table `food_type_details`
--

CREATE TABLE `food_type_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food_type_details`
--

INSERT INTO `food_type_details` (`id`, `name`) VALUES
(1, 'Đồ ăn'),
(2, 'Đồ uống'),
(3, 'Đồ ăn vặt'),
(4, 'Hoa quả');

-- --------------------------------------------------------

--
-- Table structure for table `like_comment_foods`
--

CREATE TABLE `like_comment_foods` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_comment_food` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_comment_posts`
--

CREATE TABLE `like_comment_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_comment_post` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_foods`
--

CREATE TABLE `like_foods` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_posts`
--

CREATE TABLE `like_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `id_post_user` int(11) NOT NULL,
  `sends_object` tinyint(4) NOT NULL,
  `receive_object` tinyint(4) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `delete_at` datetime NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onlines`
--

CREATE TABLE `onlines` (
  `id_user` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `id_receipt` int(11) NOT NULL,
  `ghi_chu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('doanhongha1994hedspik57@gmail.com', '151ffff389bdcb0525a148aea45ff89214d62219d9472d2d987e5f0defa97420', '2016-12-25 19:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL,
  `delete_flg` tinyint(4) NOT NULL DEFAULT '0',
  `delete_at` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `title`, `avatar`, `slug`, `content`, `seen`, `active`, `user_id`, `delete_flg`, `delete_at`, `delete_by`) VALUES
(1, '2016-12-29 02:49:40', '2017-05-22 09:20:49', 'Lẩu dê Hà Nội', 'chLIjv75s6zeFx1.jpg', 'lau-de-ha-noi', '<p>Đ&acirc;y l&agrave; m&oacute;n d&acirc;n nhậu rất th&iacute;ch n&egrave;, nhưng lẩu d&ecirc; thường ăn sau c&aacute;c m&oacute;n nướng n&ecirc;n m&ugrave;a h&egrave; th&igrave; cũng hơi n&oacute;ng thật. Qu&aacute;n lẩu d&ecirc; Nhất Ly l&agrave; chuỗi nh&agrave; h&agrave;ng được biết đến nhiều nhất khi nhắc tới m&oacute;n n&agrave;y. Ưu điểm của qu&aacute;n l&agrave; rộng r&atilde;i, kh&ocirc;ng gian tho&aacute;ng đ&atilde;ng, địa chỉ n&agrave;o chỗ để xe cũng kh&aacute; thoải m&aacute;i, nh&acirc;n vi&ecirc;n ngoan, nhiệt t&igrave;nh, phục vụ nhanh nhẹn. Chất lượng m&oacute;n ăn th&igrave; ch&iacute; &iacute;t cũng xếp trong top 10 ở H&agrave; Nội rồi. Nhược điểm của qu&aacute;n n&agrave;y l&agrave; c&oacute; nhiều chi nh&aacute;nh kh&aacute;c nhau n&ecirc;n chắc c&oacute; sự lu&acirc;n chuyển bếp trưởng c&aacute;c chi nh&aacute;nh n&ecirc;n thỉnh thoảng thấy chỗ n&agrave;y ngon hơn chỗ kia t&yacute; ch&uacute;t. Hoặc cũng c&oacute; thể t&acirc;m trạng khi ăn của m&igrave;nh cũng g&acirc;y ảnh hưởng.</p>\r\n\r\n<p><em>Địa chỉ: 167 T&acirc;y Sơn, H1 Giải Ph&oacute;ng (gần bệnh viện Bạch Mai). Trước m&igrave;nh hay ăn ở H&agrave;ng C&oacute;t nhưng giờ qu&aacute;n đ&oacute; đ&atilde; đ&oacute;ng cửa.</em></p>\r\n\r\n<p>Ngo&agrave;i lẩu d&ecirc; Nhất Ly, c&ograve;n c&oacute; nhiều qu&aacute;n lẩu d&ecirc; kh&aacute;c được đ&aacute;nh gi&aacute; cao, v&iacute; dụ như qu&aacute;n Đ&ocirc;ng Giang ở KĐT Việt Hưng, c&oacute; m&oacute;n &ldquo;Ủ trấu&rdquo; được nhiều người th&iacute;ch. V&agrave; c&oacute; qu&aacute;n Hải tr&ecirc;n đường 5, qu&atilde;ng Tr&acirc;u Quỳ, khu vực đ&oacute; c&oacute; mấy qu&aacute;n liền nhưng qu&aacute;n Hải l&agrave; qu&aacute;n ngon nhất. Hai qu&aacute;n n&agrave;y được d&acirc;n nhậu đ&aacute;nh gi&aacute; cao hơn so với Nhất Ly nhưng 2 qu&aacute;n n&agrave;y đều hơi xa trung t&acirc;m th&agrave;nh phố n&ecirc;n việc đi lại c&oacute; vẻ kh&ocirc;ng được thuận tiện bằng.</p>\r\n\r\n<p><a href="http://toidi.net/wp-content/uploads/2014/01/lau-ech-ha-noi-ngon.jpg"><img alt="lau ech ha noi ngon" src="http://toidi.net/wp-content/uploads/2014/01/lau-ech-ha-noi-ngon.jpg" style="height:334px; width:500px" /></a></p>\r\n', 0, 1, 22, 0, '2017-05-13 09:54:51', 22),
(2, '2016-12-29 02:49:40', '2017-05-22 09:37:35', 'Lẩu ếch', 'r75jal4XTLUKDKi.jpg', 'lau-ech', '<p>Lẩu ếch l&agrave; một m&oacute;n ăn lạ miệng do nước d&ugrave;ng được chế biến kh&aacute;c kh&aacute;c biệt so với c&aacute;c loại lẩu th&ocirc;ng thường. Lẩu ếch c&oacute; nhiều c&aacute;ch chế biến kh&aacute;c nhau như: lẩu ếch măng, lẩu ếch l&aacute; giang, lẩu ếch sa tế, lẩu ếch củ chuối&hellip; nhưng ở H&agrave; Nội th&igrave; lẩu ếch măng l&agrave; phổ biến nhất. Trước đ&acirc;y c&oacute; qu&aacute;n lẩu ếch Ng&acirc;n B&eacute;o ở hồ Tr&uacute;c Bạch l&agrave; qu&aacute;n đ&ocirc;ng nhất, nhiều người đ&aacute;nh gi&aacute; ngon nhưng gần đ&acirc;y th&igrave; gi&aacute; kh&aacute; đắt, nếu đi 2-3 người th&igrave; đ&acirc;y kh&ocirc;ng phải sự lựa chọn ph&ugrave; hợp. Ngo&agrave;i ra, cũng c&oacute; một v&agrave;i ph&agrave;n n&agrave;n về chất lượng đi xuống hay nh&acirc;n vi&ecirc;n phục vụ chậm&hellip; C&aacute; nh&acirc;n m&igrave;nh th&igrave; thấy qu&aacute;n Lẩu ếch số 5 L&ograve; Đ&uacute;c chất lượng c&oacute; vẻ ổn định hơn, lẩu ở đ&acirc;y c&oacute; gi&aacute; t&ugrave;y theo số người, 300k cho 2 -3 người hoặc 500k cho 4-5 người. Ngo&agrave;i ra, c&aacute;c m&oacute;n như ếch rang muối cũng kh&aacute; ngon. Xem b&agrave;i review chi tiết về qu&aacute;n&nbsp;<a href="http://toidi.net/nha-hang-quan-ngon/lau-ech-lo-duc-5-lo-duc-ha-noi.html" target="_blank">Lẩu Ếch 5 L&ograve; Đ&uacute;c</a></p>\r\n\r\n<p>Mới đ&acirc;y c&oacute; qu&aacute;n&nbsp;<em>Lẩu ếch H&agrave; My, số 70 ng&otilde; 36 Giang Văn Minh</em>&nbsp;cũng nhận được nhiều phản hồi tốt, gi&aacute; cả b&igrave;nh d&acirc;n. Qu&aacute;n mới mở, kh&aacute; rộng r&atilde;i v&agrave; sạch sẽ hơn so với qu&aacute;n ở L&ograve; Đ&uacute;c, qu&aacute;n trong ng&otilde; n&ecirc;n cũng để xe được ngay trước cửa chứ kh&ocirc;ng phải đi gửi xe ở chỗ kh&aacute;c.</p>\r\n\r\n<p><a href="http://toidi.net/wp-content/uploads/2015/09/lau-oc-ha-noi.jpg"><img alt="lẩu ốc hà nội" src="http://toidi.net/wp-content/uploads/2015/09/lau-oc-ha-noi.jpg" style="height:380px; width:500px" /></a></p>\r\n', 0, 1, 22, 0, '2017-03-20 15:18:58', 1),
(3, '2016-12-29 02:49:40', '2017-03-20 08:19:08', 'Post 3', '', 'post-3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quantum Aristoxeni ingenium consumptum videmus in musicis? Longum est enim ad omnia respondere, quae a te dicta sunt. Nec tamen ullo modo summum pecudis bonum et hominis idem mihi videri potest. Deinde disputat, quod cuiusque generis animantium statui deceat extremum. </p>\n\n<p>Bonum integritas corporis: misera debilitas. Ne in odium veniam, si amicum destitero tueri. Qui potest igitur habitare in beata vita summi mali metus? Ut non sine causa ex iis memoriae ducta sit disciplina. Dulce amarum, leve asperum, prope longe, stare movere, quadratum rotundum. Sed quae tandem ista ratio est? Immo vero, inquit, ad beatissime vivendum parum est, ad beate vero satis. </p>\n\n<p>Qui potest igitur habitare in beata vita summi mali metus? Universa enim illorum ratione cum tota vestra confligendum puto. <a href=''http://loripsum.net/'' target=''_blank''>Quare ad ea primum, si videtur;</a> Parvi enim primo ortu sic iacent, tamquam omnino sine animo sint. Ut proverbia non nulla veriora sint quam vestra dogmata. </p>\n\n<p>Venit ad extremum; Utinam quidem dicerent alium alio beatiorem! Iam ruinas videres. Traditur, inquit, ab Epicuro ratio neglegendi doloris. In qua quid est boni praeter summam voluptatem, et eam sempiternam? Hoc est non dividere, sed frangere. Ut enim consuetudo loquitur, id solum dicitur honestum, quod est populari fama gloriosum. Illud mihi a te nimium festinanter dictum videtur, sapientis omnis esse semper beatos; Que Manilium, ab iisque M. </p>\n\n<p>Tibi hoc incredibile, quod beatissimum. Cum id fugiunt, re eadem defendunt, quae Peripatetici, verba. Aufert enim sensus actionemque tollit omnem. Graccho, eius fere, aequalí? <a href=''http://loripsum.net/'' target=''_blank''>Tum ille timide vel potius verecunde: Facio, inquit.</a> Nam et complectitur verbis, quod vult, et dicit plane, quod intellegam; Cupit enim dícere nihil posse ad beatam vitam deesse sapienti. Sed tempus est, si videtur, et recta quidem ad me. </p>\n\n<p>Habent enim et bene longam et satis litigiosam disputationem. An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? Huius, Lyco, oratione locuples, rebus ipsis ielunior. Universa enim illorum ratione cum tota vestra confligendum puto. Inde sermone vario sex illa a Dipylo stadia confecimus. Unum est sine dolore esse, alterum cum voluptate. </p>\n\n<p><a href=''http://loripsum.net/'' target=''_blank''>Scrupulum, inquam, abeunti;</a> Facit igitur Lucius noster prudenter, qui audire de summo bono potissimum velit; Non est ista, inquam, Piso, magna dissensio. Iam contemni non poteris. Id Sextilius factum negabat. <a href=''http://loripsum.net/'' target=''_blank''>Age sane, inquam.</a> Quorum altera prosunt, nocent altera. An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat? </p>\n\n<p><a href=''http://loripsum.net/'' target=''_blank''>Tria genera bonorum;</a> Aliter enim nosmet ipsos nosse non possumus. Duo Reges: constructio interrete. Quodsi ipsam honestatem undique pertectam atque absolutam. Habent enim et bene longam et satis litigiosam disputationem. </p>\n\n', 0, 1, 2, 0, '2017-03-20 15:19:08', 1),
(4, '2016-12-29 02:49:40', '2017-03-20 08:29:23', 'Post 4', '', 'post-4', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod autem ratione actum est, id officium appellamus. Hoc loco tenere se Triarius non potuit. Animi enim quoque dolores percipiet omnibus partibus maiores quam corporis. <a href=''http://loripsum.net/'' target=''_blank''>Invidiosum nomen est, infame, suspectum.</a> Sed ne, dum huic obsequor, vobis molestus sim. Sed non alienum est, quo facilius vis verbi intellegatur, rationem huius verbi faciendi Zenonis exponere. Duo Reges: constructio interrete. Commoda autem et incommoda in eo genere sunt, quae praeposita et reiecta diximus; Avaritiamne minuis? Dici enim nihil potest verius. </p>\n\n<p>Ut placet, inquit, etsi enim illud erat aptius, aequum cuique concedere. Putabam equidem satis, inquit, me dixisse. Habes, inquam, Cato, formam eorum, de quibus loquor, philosophorum. Portenta haec esse dicit, neque ea ratione ullo modo posse vivi; Quis enim redargueret? Nam Pyrrho, Aristo, Erillus iam diu abiecti. Quid dubitas igitur mutare principia naturae? Quamquam id quidem, infinitum est in hac urbe; Et quod est munus, quod opus sapientiae? </p>\n\n<p><a href=''http://loripsum.net/'' target=''_blank''>Non est igitur voluptas bonum.</a> Pauca mutat vel plura sane; Aliter homines, aliter philosophos loqui putas oportere? <a href=''http://loripsum.net/'' target=''_blank''>Optime, inquam.</a> Proclivi currit oratio. Quamquam te quidem video minime esse deterritum. Cum id fugiunt, re eadem defendunt, quae Peripatetici, verba. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Nec vero sum nescius esse utilitatem in historia, non modo voluptatem. </p>\n\n<p>Sed eum qui audiebant, quoad poterant, defendebant sententiam suam. Aufert enim sensus actionemque tollit omnem. Conferam avum tuum Drusum cum C. Hanc ergo intuens debet institutum illud quasi signum absolvere. <a href=''http://loripsum.net/'' target=''_blank''>Quid adiuvas?</a> Confecta res esset. Age nunc isti doceant, vel tu potius quis enim ista melius? An vero displicuit ea, quae tributa est animi virtutibus tanta praestantia? <a href=''http://loripsum.net/'' target=''_blank''>Peccata paria.</a> Familiares nostros, credo, Sironem dicis et Philodemum, cum optimos viros, tum homines doctissimos. </p>\n\n<p>Indicant pueri, in quibus ut in speculis natura cernitur. Audio equidem philosophi vocem, Epicure, sed quid tibi dicendum sit oblitus es. Comprehensum, quod cognitum non habet? Et homini, qui ceteris animantibus plurimum praestat, praecipue a natura nihil datum esse dicemus? Quis est enim, in quo sit cupiditas, quin recte cupidus dici possit? <a href=''http://loripsum.net/'' target=''_blank''>In schola desinis.</a> Ita graviter et severe voluptatem secrevit a bono. Cur id non ita fit? Omnia contraria, quos etiam insanos esse vultis. Sin laboramus, quis est, qui alienae modum statuat industriae? </p>\n\n<p>Quamvis enim depravatae non sint, pravae tamen esse possunt. Si quicquam extra virtutem habeatur in bonis. Multa sunt dicta ab antiquis de contemnendis ac despiciendis rebus humanis; Nunc haec primum fortasse audientis servire debemus. Illa sunt similia: hebes acies est cuipiam oculorum, corpore alius senescit; At ego quem huic anteponam non audeo dicere; Virtutis, magnitudinis animi, patientiae, fortitudinis fomentis dolor mitigari solet. Quis animo aequo videt eum, quem inpure ac flagitiose putet vivere? Videmusne ut pueri ne verberibus quidem a contemplandis rebus perquirendisque deterreantur? </p>\n\n<p>Eorum enim omnium multa praetermittentium, dum eligant aliquid, quod sequantur, quasi curta sententia; Invidiosum nomen est, infame, suspectum. At iste non dolendi status non vocatur voluptas. Indicant pueri, in quibus ut in speculis natura cernitur. Sic enim censent, oportunitatis esse beate vivere. Sed in rebus apertissimis nimium longi sumus. Quid de Platone aut de Democrito loquar? Restinguet citius, si ardentem acceperit. Videamus igitur sententias eorum, tum ad verba redeamus. </p>\n\n<p>Te ipsum, dignissimum maioribus tuis, voluptasne induxit, ut adolescentulus eriperes P. Profectus in exilium Tubulus statim nec respondere ausus; Nec tamen ullo modo summum pecudis bonum et hominis idem mihi videri potest. Quamvis enim depravatae non sint, pravae tamen esse possunt. Moriatur, inquit. Cur tantas regiones barbarorum pedibus obiit, tot maria transmisit? Sic enim maiores nostri labores non fugiendos tristissimo tamen verbo aerumnas etiam in deo nominaverunt. Nunc haec primum fortasse audientis servire debemus. Quis istud possit, inquit, negare? Inde igitur, inquit, ordiendum est. </p>\n\n', 0, 1, 2, 0, '2017-03-20 15:29:23', 1),
(5, '2016-12-29 02:49:40', '2017-05-18 00:16:11', 'hongha199432323231212', '', 'hongha199432323231212', '<p><img alt="" src="http://localhost/umaimono/uploads/images/bbq/250px-French_horn_front.png" style="height:178px; width:250px" />&aacute;dasdasd</p>\r\n', 0, 0, 2, 0, '2017-05-18 07:16:11', 1),
(6, '2016-12-28 20:48:26', '2017-04-03 19:05:20', 'xxxxxxxxxxx', '', 'hongha1', 'xxxxxxxxxxxxxxxxxxxxxxxx', 0, 0, 2, 0, '2017-04-04 02:05:20', 20),
(7, '2016-12-31 03:07:35', '2017-05-13 10:21:11', 'doan hong ha', '', 'doan-hong-ha', 'honghadoan', 0, 0, 2, 0, '2017-05-13 17:21:11', 22),
(8, '2017-01-12 23:06:52', '2017-05-13 10:21:29', 'post 1201', '', 'post-1201', '<p>bao cao project 2</p>\r\n', 0, 0, 9, 0, '2017-05-13 17:21:29', 22),
(9, '2017-01-12 23:09:34', '2017-05-22 09:38:31', 'Lẩu ốc', 'XPTeRNK7zJNBhgh.jpg', 'lau-oc', '<p>Lẩu ốc lại l&agrave; một đặc sản kh&aacute;c ở l&agrave;ng Khương Thượng. Đ&acirc;y cũng l&agrave; l&agrave;ng nổi tiếng với m&oacute;n b&uacute;n ốc dấm bỗng n&ecirc;n theo thời gian c&oacute; nhiều m&oacute;n hơn từ ốc xuất ph&aacute;t từ l&agrave;ng n&agrave;y cũng l&agrave; điều dễ hiểu. Qu&aacute;n nổi tiếng nhất cũng l&agrave; qu&aacute;n B&uacute;n ốc b&agrave; Lương, theo chủ qu&aacute;n th&igrave; m&oacute;n n&agrave;y đ&atilde; c&oacute; 42 năm rồi nhưng v&igrave; qu&aacute;n nằm trong l&agrave;ng n&ecirc;n &iacute;t được biết tới. Ngo&agrave;i lẩu ốc c&ograve;n c&oacute; chả ốc, nem ốc, ốc cuốn l&aacute; lốt. M&igrave;nh cũng c&oacute; người nh&agrave; trong l&agrave;ng n&ecirc;n mới biết tới qu&aacute;n n&agrave;y c&aacute;ch đ&acirc;y v&agrave;i năm.</p>\r\n\r\n<p>Lẩu ốc với nước d&ugrave;ng được chế biến tương tự như m&oacute;n b&uacute;n ốc dấm n&ecirc;n c&oacute; vị chua cay nhưng thanh của dấm bỗng. C&aacute;c m&oacute;n ăn k&egrave;m cũng rất phong ph&uacute; như ốc nhồi, chả ốc, mọc ốc, đậu r&aacute;n, chuối xanh, thịt ba chỉ&hellip;</p>\r\n\r\n<p>Địa chỉ của qu&aacute;n&nbsp;<em>B&uacute;n ốc B&agrave; Lương l&agrave; số 34 ng&otilde; 191 Khương Thượng</em>.</p>\r\n\r\n<p>Hiện nay c&oacute; nhiều qu&aacute;n bắt đầu phục vụ m&oacute;n lẩu ốc n&agrave;y nhưng để c&oacute; hương vị như qu&aacute;n b&agrave; Lương th&igrave; c&oacute; lẽ l&agrave; chưa qu&aacute;n n&agrave;o l&agrave;m được</p>\r\n\r\n<p><img alt="quán lẩu ngon hà nội" src="http://toidi.net/wp-content/uploads/2015/09/quan-lau-ha-noi-ngon.jpg" /></p>\r\n', 0, 0, 22, 0, '2017-05-13 10:14:32', 22),
(10, '2017-02-06 18:28:57', '2017-05-18 00:16:09', 'sdfsfd', '', 'sdfsfd', 'sdfsfd', 0, 0, 1, 0, '2017-05-18 07:16:09', 1),
(11, '2017-02-07 00:10:01', '2017-05-18 00:16:07', 'poasasas', '', 'poasasas', 'asdasd', 0, 0, 1, 0, '2017-05-18 07:16:07', 1),
(12, '2017-03-19 09:20:40', '2017-05-22 09:39:36', 'Lẩu gà', 'MpGTHuo1qxeoULq.jpg', 'lau-ga', '<p>Một trong những m&oacute;n&nbsp;<a href="http://toidi.net/am-thuc-2/lau-ngon-ha-noi.html" target="_blank">lẩu ngon H&agrave; Nội</a>&nbsp;phổ biến nhất c&oacute; lẽ phải kể đến lẩu g&agrave;, đ&acirc;y l&agrave; m&oacute;n dễ chế biến ngon, chỉ cần nguy&ecirc;n vật liệu ngon th&igrave; ngay cả tại nh&agrave; bạn cũng c&oacute; thể nấu được một nồi lẩu ngon. Tuy nhi&ecirc;n, c&aacute;c qu&aacute;n lẩu g&agrave; vẫn c&oacute; c&aacute;ch chế biến kh&aacute;c biệt để thu h&uacute;t thực kh&aacute;ch. V&iacute; dụ như qu&aacute;n 52 Trần Nh&acirc;n T&ocirc;ng nổi tiếng với m&oacute;n lẩu g&agrave; đồi dấm bỗng, qu&aacute;n chỉ mở cửa chiều tối. Hay qu&aacute;n G&agrave; Hỏa L&ograve; cũng phục vụ m&oacute;n lẩu n&agrave;y nhưng kh&ocirc;ng gian rộng r&atilde;i hơn hẳn ở 2 địa chỉ số số 347 v&agrave; 374/20 đường &Acirc;u Cơ.</p>\r\n\r\n<p>Lẩu g&agrave; l&aacute; ngải th&igrave; mời c&aacute;c bạn thưởng thức ở số 43 Cửa Bắc, qu&aacute;n Nem nướng Xu&acirc;n Dần. Đi ăn lẩu g&agrave; ở qu&aacute;n nem nướng th&igrave; nghe c&oacute; vẻ hơi v&ocirc; l&yacute; nhưng đ&uacute;ng l&agrave; lẩu g&agrave; l&aacute; ngải ở qu&aacute;n n&agrave;y rất ngon, g&agrave; tươi ngon, con nhỏ khoảng dưới 1kg, khi kh&aacute;ch gọi mới l&agrave;m g&agrave; n&ecirc;n đợi hơi l&acirc;u. Qu&aacute;n ph&ugrave; hợp đi &iacute;t người, buổi trưa c&oacute; nhiều d&acirc;n văn ph&ograve;ng ăn trưa ở đ&acirc;y.</p>\r\n\r\n<p>Thời tiết m&ugrave;a đ&ocirc;ng th&igrave; th&iacute;ch hợp nhất l&agrave; lẩu g&agrave; thuốc bắc. M&oacute;n n&agrave;y c&aacute;c bạn c&oacute; thể gh&eacute; Ngự Mi&ecirc;u Qu&aacute;n ở 195 phố Quan Hoa hoặc Qu&aacute;n Kiến ở 143 Nghi T&agrave;m.</p>\r\n\r\n<p>Ngo&agrave;i ra, c&ograve;n c&oacute; c&aacute;c loại lẩu g&agrave; nấm, lẩu g&agrave; l&aacute; giang, lẩu g&agrave; măng cay&hellip; m&agrave; mỗi kiểu đều c&oacute; n&eacute;t hấp dẫn ri&ecirc;ng biệt.</p>\r\n\r\n<p><img src="http://toidi.net/wp-content/uploads/2015/09/lau-chao-ha-noi.jpg" /></p>\r\n', 0, 0, 22, 0, '2017-05-13 10:15:34', 22),
(13, '2017-03-19 09:20:54', '2017-05-18 00:16:04', 'x1111111111111111111111', '', 'x1111111111111111111111', 'x11111111111111111111111', 0, 0, 1, 0, '2017-05-18 07:16:04', 1),
(15, '2017-03-20 08:55:33', '2017-05-18 00:16:26', 'post 123', '', 'post-123', '', 0, 0, 1, 0, '2017-05-18 07:16:26', 1),
(16, '2017-04-04 19:10:11', '2017-05-18 00:16:44', 'doan hong had', '', 'doan-hong-had', '<ol>\r\n	<li>adadas<strong>&aacute;dadadadasd<s>&aacute;dasdadasdadasd&aacute;dadad</s></strong></li>\r\n	<li><strong><s>&aacute;dasdasdasd</s></strong></li>\r\n	<li><strong><s>&aacute;dadasdddddddddd</s></strong></li>\r\n	<li><strong><s>ẳerwefwfewfwe</s></strong>a</li>\r\n	<li>&aacute;dadadad</li>\r\n	<li>&aacute;dadad</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>&aacute;dada&aacute;dadasd</li>\r\n	<li>&aacute;dad</li>\r\n	<li>&aacute;dasd</li>\r\n	<li>ad</li>\r\n	<li>adas</li>\r\n	<li>da</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n', 0, 0, 1, 0, '2017-05-18 07:16:44', 1),
(17, '2017-04-09 19:54:33', '2017-05-18 00:16:29', 'ádasdasdas', 'Di6u3fR7drbq.jpg', 'adasdasdas', '<p><img alt="" src="/images/images/225.jpg" style="height:225px; width:225px" />&aacute;ddsdadsadsdadsda</p>\n\n<p>&aacute;dadadasd</p>\n\n<p>&aacute;dasdasdasd</p>\n\n<p>&aacute;dadsasdasdasda</p>\n', 0, 0, 1, 0, '2017-05-18 07:16:29', 1),
(18, '2017-04-09 20:07:45', '2017-05-22 09:40:28', 'Lẩu cháo', 'QdsMbWAUzmuqwYO.jpg', 'lau-chao', '<p>Đ&acirc;y l&agrave; một m&oacute;n lẩu rất đặc biệt, thay v&igrave; c&oacute; một nồi nước lẩu để nh&uacute;ng c&aacute;c m&oacute;n ăn k&egrave;m th&igrave; l&agrave; một nồi ch&aacute;o lo&atilde;ng. Ch&aacute;o được nấu bằng nước xương v&agrave; nh&uacute;ng c&aacute;c loại nguy&ecirc;n liệu như c&aacute;, t&ocirc;m, mực, chim&hellip; c&ugrave;ng với c&aacute;c loại nấm n&ecirc;n đến cuối c&ugrave;ng ăn ch&aacute;o th&igrave; c&aacute;c bạn sẽ thấy cực kỳ ngon.</p>\r\n\r\n<p>Lẩu ch&aacute;o c&oacute; nguồn gốc từ Quảng Ch&acirc;u, Trung Quốc v&agrave;o những ng&agrave;y trời qu&aacute; lạnh th&igrave; việc ăn ch&aacute;o trong khi n&oacute; vẫn được nấu tr&ecirc;n bếp quả l&agrave; một sự thưởng thức tinh tế. Nhưng về đến Việt Nam th&igrave; theo m&igrave;nh đ&acirc;y chẳn qua l&agrave; ch&aacute;o nhưng ăn theo c&aacute;ch thức của c&aacute;c m&oacute;n lẩu để thực kh&aacute;ch c&oacute; thời gian ngồi lai rai, n&oacute;i chuyện th&igrave; ch&iacute;nh x&aacute;c hơn. Tất cả c&aacute;c m&oacute;n ch&aacute;o đều c&oacute; thể biến th&agrave;nh lẩu.</p>\r\n\r\n<p>Qu&aacute;n lẩu ch&aacute;o chim ở nh&agrave; h&agrave;ng Nam Dương tửu qu&aacute;n ở 21 H&ograve;e Nhai l&agrave; một địa chỉ đ&aacute;ng để thử. Gi&aacute; khoảng 350k nồi/2-3 người ăn. Lẩu ch&aacute;o c&aacute; quả th&igrave; c&oacute; nh&agrave; h&agrave;ng Ngon ở 51 Nguyễn Cao. Ngo&agrave;i c&aacute; cắt kh&uacute;c cho v&agrave;o ch&aacute;o c&ograve;n c&oacute; c&aacute; cuốn nấm kim ch&acirc;m cũng kh&aacute; hấp dẫn.</p>\r\n\r\n<p>Nếu muốn c&oacute; kh&ocirc;ng gian &ldquo;sang chảnh&rdquo; hơn th&igrave; bạn c&oacute; thể chọn Lẩu ch&aacute;o số 6 Thụy Khu&ecirc;, đ&acirc;y l&agrave; nh&agrave; h&agrave;ng chuy&ecirc;n phục vụ c&aacute;c m&oacute;n lẩu ch&aacute;o theo phong c&aacute;ch Quảng Ch&acirc;u. M&igrave;nh ăn lẩu ch&aacute;o hải sản ở đ&acirc;y kh&aacute; h&agrave;i l&ograve;ng, kh&ocirc;ng gian đẹp, rộng r&atilde;i, phục vụ cũng rất chu đ&aacute;o. Mỗi b&agrave;n tr&ograve;n, xoay được đều c&oacute; 1 nh&acirc;n vi&ecirc;n phục vụ suốt cả buổi. Nhưng đi k&egrave;m theo đ&oacute; tất nhi&ecirc;n gi&aacute; cũng cao hơn c&aacute;c nơi kh&aacute;c. C&oacute; thể gọi 1 nồi 600k cho 2-3 người v&agrave; gọi k&egrave;m th&ecirc;m v&agrave;i m&oacute;n vặt nếu muốn.</p>\r\n\r\n<p>Ngo&agrave;i ra, hiện nay c&ograve;n c&oacute; rất nhiều c&aacute;c m&oacute;n lẩu ch&aacute;o kh&aacute;c nhau như lẩu ch&aacute;o l&ograve;ng, lẩu ch&aacute;o sườn&hellip;</p>\r\n\r\n<p><a href="http://toidi.net/wp-content/uploads/2015/09/lau-rieu-cua-ha-noi.jpg"><img alt="lẩu riêu cua hà nội" src="http://toidi.net/wp-content/uploads/2015/09/lau-rieu-cua-ha-noi.jpg" style="height:332px; width:500px" /></a></p>\r\n', 0, 0, 22, 0, '2017-05-13 10:16:14', 22),
(19, '2017-04-16 20:29:08', '2017-05-18 00:16:41', 'ssdasdadasd', 'noavatar.png', 'ssdasdadasd', '<p>asdasdasdasdasd</p>\r\n', 0, 0, 1, 0, '2017-05-18 07:16:41', 1),
(20, '2017-04-16 20:29:54', '2017-05-18 00:16:31', 'fsfsfsfds', 'noavatar.png', 'fsfsfsfds', '<p>sdfsdfsfs</p>\r\n', 0, 0, 1, 0, '2017-05-18 07:16:31', 1),
(21, '2017-04-16 20:31:21', '2017-05-08 02:07:30', 'asdasdasdasd', 'noavatar.png', 'asdasdasdasd', '<p>asdadasdada</p>\r\n', 0, 0, 24, 0, '2017-05-08 09:07:30', 24),
(22, '2017-04-16 20:33:07', '2017-05-18 00:16:39', 'doan hong aha 1212121', 'noavatar.png', 'doan-hong-aha-1212121', '<p>asdadada</p>\r\n', 0, 0, 24, 0, '2017-05-18 07:16:39', 1),
(23, '2017-04-16 20:52:09', '2017-05-18 00:16:37', 'asdasdasdsd', 'noavatar.png', 'asdasdasdsd', '<p>asdadasdasd</p>\r\n', 0, 0, 1, 0, '2017-05-18 07:16:37', 1),
(24, '2017-04-16 20:53:03', '2017-04-16 20:53:03', 'qweqe', 'noavatar.png', 'qweqe', '<p>cczczxcz</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(25, '2017-04-16 21:01:50', '2017-05-18 00:16:34', 'doan hong ha lop viet nhat k57 bach khoa ha noi', 'Di6u3fR7drbq.jpg', 'adadasd', '<p>asdadadadasd</p>\r\n', 0, 0, 24, 0, '2017-05-18 07:16:34', 1),
(26, '2017-05-03 23:16:40', '2017-05-22 09:41:15', 'Lẩu riêu cua', 'nTcix1962lxRiDK.jpg', 'lau-rieu-cua', '<p>Một trong những m&oacute;n lẩu m&agrave; người d&acirc;n H&agrave; Nội đ&ocirc;ng hay h&egrave; đều th&iacute;ch đ&oacute; l&agrave; lẩu ri&ecirc;u cua v&igrave; c&aacute;i vị thanh m&aacute;t của n&oacute;. Hải Ph&ograve;ng th&igrave; nổi tiếng với m&oacute;n lẩu cua đồng ăn k&egrave;m đồ nh&uacute;ng l&agrave; chả l&aacute; lốt, mọc nấm&hellip; rất đặc trưng nhưng lẩu ri&ecirc;u cua H&agrave; Nội th&igrave; c&oacute; phong c&aacute;ch kh&aacute;c. Lẩu ri&ecirc;u cua bắp b&ograve; hay lẩu ri&ecirc;u cua sườn sụn&hellip; l&agrave; để chỉ những m&oacute;n c&oacute; thể ăn k&egrave;m với m&oacute;n lẩu n&agrave;y. M&oacute;n n&agrave;y c&oacute; nước d&ugrave;ng l&agrave; đặc biệt nhất, nước d&ugrave;ng phải c&oacute; vị ngọt của cua đồng, vị chua chua của dấm bỗng, m&agrave;u sắc bắt mắt từ gạch cua th&igrave; mới đạt y&ecirc;u cầu.</p>\r\n\r\n<p>M&oacute;n ăn n&agrave;y l&agrave; một trong những m&oacute;n ăn mang đậm phong c&aacute;ch ẩm thực của người miền Bắc v&agrave; được phục vụ ở hầu như c&aacute;c qu&aacute;n lẩu. Nhưng qu&aacute;n được nhiều người biết đến nhất l&agrave; qu&aacute;n lẩu ri&ecirc;u cua ở 66 Ph&oacute; Đức Ch&iacute;nh, ngồi trong s&acirc;n trường, x&eacute;t về vị tr&iacute; th&igrave; kh&ocirc;ng được &ldquo;s&aacute;ng choang&rdquo; v&agrave; &ldquo;vệ sinh&rdquo; như c&aacute;c qu&aacute;n kh&aacute;c.</p>\r\n\r\n<p>Nếu c&aacute;c bạn muốn c&oacute; một kh&ocirc;ng gian lịch sự hơn, c&oacute; thể chọn Qu&aacute;n S&agrave;nh ở số 8 ng&otilde; 97 Phạm Ngọc Thạch. Chỗ ngồi ở đ&acirc;y tho&aacute;ng, đẹp hơn, nh&acirc;n vi&ecirc;n nhanh nhẹn, phục vụ tốt v&agrave; gi&aacute; cao hơn một ch&uacute;t.</p>\r\n\r\n<p><img alt="lẩu bò nhúng dấm hà nội" src="http://toidi.net/wp-content/uploads/2015/09/Lau-Bo-Ha-Noi.jpg" /></p>\r\n', 0, 0, 22, 0, '2017-05-18 08:26:59', 22),
(32, '2017-05-08 01:01:28', '2017-05-08 01:01:28', 'post 1  2', 'no-image.jpg', 'post-1-2', '<p>&aacute;dadasd</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(33, '2017-05-08 01:04:31', '2017-05-20 20:42:06', 'post 1  ', 'no-image.jpg', 'post-12', '<p>zxczczxc</p>\r\n', 0, 0, 24, 0, '2017-05-21 03:42:06', 1),
(34, '2017-05-08 01:10:17', '2017-05-08 01:10:17', 'ádadasdas', 'ikpeRDO5Hwtq.jpg', 'adadasdas', '<p>&aacute;dasdasdas</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(35, '2017-05-08 01:24:47', '2017-05-08 01:24:47', 'ádadasdassd', 'ykGpRhDFduhb.png', 'adadasdassd', '<p>&aacute;dadasda</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(36, '2017-05-10 00:44:16', '2017-05-10 00:44:16', 'nônnonono', 'WyrwqdnO8kzZ.jpg', 'nonnonono', '<p>&aacute;dasdasdasd</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(37, '2017-05-10 01:05:27', '2017-05-10 01:05:27', 'ádasda', 'BH3Kge6qRvHk.jpg', 'adasda', '<p>&aacute;dasdasd</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(38, '2017-05-10 01:05:43', '2017-05-21 02:59:17', 'ádasdas', 'SJcwDUXcwKcd.jpg', 'adasdas', '<p>&aacute;dasdasdasd</p>\r\n', 0, 0, 24, 0, '2017-05-21 09:59:17', 1),
(39, '2017-05-10 01:08:19', '2017-05-10 01:08:19', 'ưerwerwer', 'K4PE7MUyQpp5.jpg', 'uerwerwer', '<p>ưerwerwerw</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(40, '2017-05-10 01:15:30', '2017-05-10 01:15:30', 'sdfsdfsdfs', 'RlXRwYSqDF5w.jpg', 'sdfsdfsdfs', '<p>sdfsdfsdfsdf</p>\r\n', 0, 0, 24, 0, NULL, NULL),
(41, '2017-05-13 00:51:23', '2017-05-22 09:41:52', 'Lẩu bò nhúng dấm', 'OnjL9E8cE12FDtg.jpg', 'lau-bo-nhung-dam', '<p>Lẩu b&ograve; nh&uacute;ng dấm l&agrave; một m&oacute;n v&agrave;i năm gần đ&acirc;y mới trở n&ecirc;n phổ biến. Nước d&ugrave;ng nh&igrave;n kh&ocirc;ng được bắt mắt như c&aacute;c loại lẩu kh&aacute;c, nh&igrave;n m&agrave;u sắc nhạt nh&ograve;a, nguy&ecirc;n vật liệu th&igrave; &iacute;t ỏi, chỉ thấy c&oacute; kh&uacute;c sả, v&agrave;i l&aacute;t dứa v&agrave; h&agrave;nh t&acirc;y. Nhưng khi c&aacute;c bạn thưởng thức th&igrave; lại thấy &ldquo;nh&igrave;n vậy chứ kh&ocirc;ng phải vậy&rdquo;. Nhờ việc chế biến nước lẩu từ c&aacute;c nguy&ecirc;n vật liệu kể tr&ecirc;n c&ugrave;ng với dấm bỗng, vị của nồi nước lẩu thơm nhẹ, thanh thanh m&agrave; kh&ocirc;ng ng&aacute;n. Phần nh&uacute;ng của m&oacute;n n&agrave;y t&ugrave;y qu&aacute;n m&agrave; c&oacute; &iacute;t hoặc nhiều c&aacute;c loại thịt b&ograve; kh&aacute;c nhau, c&oacute; bắp b&ograve;, thăn b&ograve;, ba chỉ b&ograve;, gầu b&ograve;, g&acirc;n b&ograve;&hellip; Một v&agrave;i nh&agrave; h&agrave;ng hạng sang th&igrave; sử dụng b&ograve; Mỹ hoặc b&ograve; &Uacute;c thay thế. Tất cả c&aacute;c loại thịt b&ograve; đều được cuốn b&aacute;nh tr&aacute;ng c&ugrave;ng với dứa, chuối xanh, khế, x&agrave; l&aacute;ch, c&aacute;c loại rau&hellip; v&agrave; chấm một loại nước chấm đặc biệt t&ugrave;y nh&agrave; h&agrave;ng.</p>\r\n\r\n<p>Qu&aacute;n nổi tiếng nhất l&agrave; B&ograve; nh&uacute;ng dấm 999 ở 99 Trần Xu&acirc;n Soạn , qu&aacute;n b&igrave;nh d&acirc;n, gi&aacute; cả rẻ n&ecirc;n rất đ&ocirc;ng kh&aacute;ch. C&aacute;c qu&aacute;n b&ograve; nh&uacute;ng dấm thường b&aacute;n theo suất, khoảng 100k/ người chứ kh&ocirc;ng b&aacute;n theo nồi như c&aacute;c m&oacute;n lẩu kh&aacute;c.</p>\r\n\r\n<p>Qu&aacute;n ở cạnh nh&agrave; thờ Cửa Bắc tr&ecirc;n phố Nguyễn Biểu cũng ngon v&agrave; m&igrave;nh thấy c&oacute; vẻ sạch sẽ hơn. Hoặc qu&aacute;n B&ograve; nh&uacute;ng dấm 90 T&ocirc; Hiến Th&agrave;nh.</p>\r\n\r\n<p>Ở 70 Đốc Ngữ cũng c&oacute; một qu&aacute;n m&agrave; cả d&acirc;n Bắc hay d&acirc;n du lịch trong Nam ra đều khen. C&aacute;c bạn c&oacute; thể thử qua xem sao nh&eacute;.</p>\r\n\r\n<p><a href="http://toidi.net/wp-content/uploads/2015/09/lau-vit-ha-noi.jpg"><img alt="lẩu vịt hà nội" src="http://toidi.net/wp-content/uploads/2015/09/lau-vit-ha-noi.jpg" style="height:500px; width:500px" /></a></p>\r\n', 0, 0, 22, 0, NULL, NULL),
(42, '2017-05-13 02:47:44', '2017-05-22 09:42:39', 'Lẩu vịt Hà Nội', '1IIzOknMWMaFiSe.jpg', 'lau-vit-ha-noi', '<p>Nhắc đến lẩu vịt th&igrave; chắc chắn ai cũng nghĩ tới lẩu vịt om sấu, nhưng ngo&agrave;i ra c&ograve;n c&oacute; m&oacute;n lẩu vịt nấu chao cũng ngon kh&ocirc;ng k&eacute;m. H&agrave; Nội nổi tiếng với m&oacute;n Vịt cỏ V&acirc;n Đ&igrave;nh n&ecirc;n theo đ&oacute; c&aacute;c m&oacute;n lẩu vịt cũng bắt đầu nở rộ trong những năm gần đ&acirc;y. C&oacute; rất nhiều c&aacute;c qu&aacute;n vịt ở H&agrave; Nội m&agrave; đ&ocirc;ng người ăn đều khen ngon nhưng nhiều qu&aacute;n m&igrave;nh thấy phục vụ qu&aacute; l&acirc;u năm rồi m&agrave; kh&ocirc;ng c&oacute; cải tiến, n&acirc;ng cấp g&igrave; về vệ sinh, vị tr&iacute;, chỗ ngồi th&agrave;nh ra nh&igrave;n l&uacute;c n&agrave;o cũng thấy &ldquo;lem nhem&rdquo; v&agrave; m&igrave;nh sẽ kh&ocirc;ng giới thiệu những qu&aacute;n đ&oacute;. Thường th&igrave; kh&aacute;ch chả ai đi ăn mỗi lẩu vịt bao giờ, m&agrave; phải bắt đầu từ vịt nướng, vịt luộc, tiết canh vịt&hellip; th&agrave;nh ra c&aacute;c qu&aacute;n vịt lại cạnh tranh nhau về số lượng c&aacute;c m&oacute;n ăn.</p>\r\n\r\n<p>Qu&aacute;n Vịt 43 Thi S&aacute;ch nổi tiếng với số lượng c&aacute;c m&oacute;n từ vịt. Ngo&agrave;i lẩu vịt om sấu, lẩu vịt om măng c&aacute;c bạn c&oacute; thể thử nộm ch&acirc;n vịt r&uacute;t xương, vịt chi&ecirc;n vừng&hellip; cũng rất ngon.</p>\r\n\r\n<p>B&ecirc;n kia cầu Chương Dương cũng c&oacute; 1 qu&aacute;n chuy&ecirc;n Vịt, số 4 Nguyễn Văn Cừ, qu&aacute;n rộng r&atilde;i, thoải m&aacute;i, gi&aacute; cả cũng hợp l&yacute;.</p>\r\n\r\n<p>C&ograve;n lẩu vịt nấu chao theo phong c&aacute;ch miền T&acirc;y th&igrave; mời c&aacute;c bạn thử ở qu&aacute;n Xưa 104A Ngọc Kh&aacute;nh, Giảng V&otilde;.</p>\r\n\r\n<p><img alt="lẩu thái hà nội" src="http://toidi.net/wp-content/uploads/2015/09/lau-thai-ha-noi.jpg" /></p>\r\n', 0, 0, 22, 0, NULL, NULL),
(43, '2017-05-13 02:47:52', '2017-05-22 09:43:26', 'Lẩu Thái', 'hlABv3bBJr6LWj0.jpg', 'lau-thai', '<p>Lẩu Th&aacute;i tuy l&agrave; một m&oacute;n du nhập từ Th&aacute;i Lan v&agrave;o Việt Nam nhưng hiện nay m&oacute;n n&agrave;y rất được ưa chuộng ở H&agrave; Nội. C&oacute; thể n&oacute;i n&oacute; giống như lẩu thập cẩm vậy v&igrave; đa dạng c&aacute;c loại đồ nh&uacute;ng nhưng nước lẩu đậm đ&agrave; hơn nhờ hương vị Th&aacute;i đặc trưng; chua, cay, ngọt.</p>\r\n\r\n<p>Trước đ&acirc;y muốn ăn lẩu Th&aacute;i th&igrave; cứ l&ecirc;n Vincom chuỗi nh&agrave; h&agrave;ng Thai Express, kh&ocirc;ng gian sạch sẽ, gi&aacute; cả b&igrave;nh d&acirc;n, hương vị hợp khẩu vị người Việt. Nhưng giờ đ&atilde; c&oacute; rất nhiều địa chỉ phục vụ m&oacute;n lẩu Th&aacute;i n&agrave;y.</p>\r\n\r\n<p>Nh&agrave; H&agrave;ng Sawasdee c&oacute; kh&ocirc;ng gian đặc Th&aacute;i v&agrave; đồ ăn cũng thuần Th&aacute;i hơn kiểu Thai Express.</p>\r\n\r\n<p>Ăn lẩu Th&aacute;i kiểu buffet th&igrave; c&aacute;c bạn c&oacute; thể chọn Siamese, c&oacute; cả buffet c&aacute;c m&oacute;n nướng nữa trong Royal City. Nhưng việc gửi xe rồi t&igrave;m chỗ th&igrave; hơi c&aacute;ch r&aacute;ch. C&aacute;c gia đ&igrave;nh đưa con đi khu vui chơi trong đ&oacute; cả ng&agrave;y rồi ăn lu&ocirc;n trong đ&oacute; th&igrave; tiện hơn</p>\r\n\r\n<p><img src="http://toidi.net/wp-content/uploads/2015/09/lau-nam-ha-noi.jpg" /></p>\r\n', 0, 0, 22, 0, '2017-05-21 09:56:41', 1),
(44, '2017-05-13 07:26:30', '2017-05-22 09:44:35', 'Lẩu nấm', 'mX6CwQhx4qG8c2p.jpg', 'lau-nam', '<p>Lẩu nấm l&agrave; m&oacute;n số 10 trong danh s&aacute;ch c&aacute;c m&oacute;n&nbsp;<a href="http://toidi.net/am-thuc-2/lau-ngon-ha-noi.html" target="_blank">lẩu ngon H&agrave; Nội</a>. M&igrave;nh đưa m&oacute;n n&agrave;y v&agrave;o danh s&aacute;ch để phục vụ c&aacute;c bạn th&iacute;ch c&aacute;c m&oacute;n ăn thanh đạm, thậm ch&iacute; l&agrave; th&iacute;ch ăn hơi hướng &ldquo;chay&rdquo; một ch&uacute;t thay v&igrave; c&aacute;c m&oacute;n kể tr&ecirc;n, m&oacute;n n&agrave;o cũng thấy đạm. Nhưng c&aacute;c bạn cũng đừng lo, lẩu nấm l&agrave; loại lẩu c&oacute; nhiều sự lựa chọn hơn về c&aacute;c loại nấm chứ kh&ocirc;ng phải l&agrave; &ldquo;chỉ c&oacute; nấm&rdquo;, c&aacute;c bạn ho&agrave;n to&agrave;n c&oacute; thể ăn k&egrave;m với c&aacute;c loại đồ nh&uacute;ng kh&aacute;c như thịt b&ograve;, t&ocirc;m, c&aacute;&hellip;</p>\r\n\r\n<p>N&oacute;i đến lẩu nấm th&igrave; đ&acirc;y l&agrave; một m&oacute;n ăn của Nhật, chắc ai cũng biết đến chuỗi nh&agrave; h&agrave;ng Ashima, c&oacute; địa chỉ ở nhiều nơi trong th&agrave;nh phố: 21 Điện Bi&ecirc;n Phủ, 182 Triệu Việt Vương, 60 Giang Văn Minh&hellip; Kh&ocirc;ng gian sang trọng, phục vụ tốt v&agrave; gi&aacute; cả cũng kh&aacute; cao. Theo c&ugrave;ng phong c&aacute;ch n&agrave;y c&oacute; Vietxiao ở 34 Ho&agrave;ng Cầu mới hơn nhưng cũng nhận được nhiều phản hồi tốt.</p>\r\n\r\n<p>C&ograve;n b&igrave;nh d&acirc;n hơn th&igrave; c&aacute;c bạn c&oacute; thể đến phố L&ograve; Đ&uacute;c, phố n&agrave;y c&oacute; nhiều nh&agrave; h&agrave;ng lẩu nấm. V&iacute; dụ như Nấm Việt 76 v&agrave; 195 L&ograve; Đ&uacute;c. Đ&acirc;y l&agrave; nh&agrave; h&agrave;ng chuy&ecirc;n về c&aacute;c m&oacute;n nấm chứ kh&ocirc;ng chỉ c&oacute; lẩu nấm. Nhưng d&acirc;n teen th&iacute;ch qu&aacute;n n&agrave;y l&agrave; nhiều do qu&aacute;n được PR kh&aacute; chuy&ecirc;n nghiệp từ thời điểm khai trương. D&acirc;n văn ph&ograve;ng th&iacute;ch qu&aacute;n Phố Nấm Bảo Ng&acirc;n 67 L&ograve; Đ&uacute;c hơn do hợp phong c&aacute;ch.</p>\r\n\r\n<p>Hy vọng những chia sẻ gợi &yacute; tr&ecirc;n đ&acirc;y về&nbsp;<strong>Lẩu Ngon H&agrave; Nội</strong>, sẽ gi&uacute;p bạn c&oacute; th&ecirc;m những lựa chọn về Ẩm thực khi đi Du lịch ở H&agrave; Nội</p>\r\n\r\n<p><img alt="" src="http://localhost/umaimono/uploads/images/lau-oc-ha-noi.jpg" style="height:380px; width:500px" /></p>\r\n', 0, 0, 22, 0, NULL, NULL),
(45, '2017-05-13 07:34:01', '2017-05-18 00:15:03', 'ádasdas', 'XBtZNFKKW1yGUht.jpg', 'adasdass', '<p>&aacute;dadasdasd</p>\r\n', 0, 0, 22, 0, NULL, NULL),
(46, '2017-05-13 10:18:44', '2017-05-18 00:14:56', 'asdadsas', 'oXtw7fLvW5uHYa.jpg', 'asdadsas', '<p>asdasdasd</p>\r\n', 0, 0, 22, 0, NULL, NULL),
(47, '2017-05-13 10:23:58', '2017-05-18 00:14:51', 'ádasdasdasád', 'L7nohTOzvOX4l0.jpg', 'adasdasdasad', '<p>&aacute;dasdasdas</p>\r\n', 0, 0, 22, 0, NULL, NULL),
(48, '2017-05-14 02:20:01', '2017-05-21 20:24:30', 'aasdasd', 'jgBBtJo2LiwUgA.jpg', 'aasdasd', '<p>asdasdaasdasd</p>\r\n', 0, 0, 22, 0, '2017-05-22 03:24:30', 1),
(49, '2017-05-17 01:20:02', '2017-05-20 20:43:15', 'asdasdasdd', 'qALkW0W8kv2Ih8g.png', 'asdasdasdd', '<p>&Aacute;&aacute;&Aacute;&aacute;asdas</p>\r\n', 0, 0, 22, 0, '2017-05-21 03:43:15', 1),
(50, '2017-05-17 19:07:04', '2017-05-17 21:21:15', '12312312', 'cRhx6xbWd8M6a8c.jpg', '12312312', '<p>12312312312</p>\r\n', 0, 0, 22, 0, NULL, NULL),
(51, '2017-05-17 19:14:49', '2017-05-17 21:21:11', 'asdasds', 'nP1OwyKmHJK7hIs.jpg', 'asdasds', '<p>asdadadad</p>\r\n', 0, 0, 22, 0, NULL, NULL),
(52, '2017-05-17 19:27:27', '2017-05-17 21:21:07', 'asdasd sdsdsd', '55NBGM0dW7InVI.jpg', 'asdasd-sdsdsd', '<p>asdasdasdasdasd</p>\r\n', 0, 0, 22, 0, NULL, NULL),
(53, '2017-05-18 01:31:36', '2017-05-18 01:31:36', 'Có ngay đĩa thịt bò xào dứa ngon lành trong vòng "vài nốt nhạc"', 'xLfYILNXCbiiRL.jpg', 'co-ngay-dia-thit-bo-xao-dua-ngon-lanh-trong-vong-vai-not-nhac', '<p><strong>Nguy&ecirc;n liệu l&agrave;m thịt b&ograve; x&agrave;o dứa</strong></p>\r\n\r\n<p><img alt="Có ngay đĩa thịt bò xào dứa ngon lành trong vòng &amp;#34;vài nốt nhạc&amp;#34; - 1" src="http://image.24h.com.vn/upload/2-2017/images/2017-05-18/1495076634-149492670019798-bo-2.jpg" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Thịt b&ograve;: 450g</p>\r\n\r\n<p>- Dứa: Nửa quả vừa</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- C&agrave; chua: 1 quả</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- H&agrave;nh l&aacute;: 1 nắm nhỏ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- H&agrave;nh, tỏi kh&ocirc;: Mỗi loại 1 củ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Muối, bột n&ecirc;m, bột ngọt, dầu h&agrave;o</p>\r\n\r\n<p><strong>C&aacute;ch l&agrave;m thịt b&ograve; x&agrave;o dứa</strong></p>\r\n\r\n<p><img alt="Có ngay đĩa thịt bò xào dứa ngon lành trong vòng &amp;#34;vài nốt nhạc&amp;#34; - 2" src="http://image.24h.com.vn/upload/2-2017/images/2017-05-18/1495076634-149492670064182-bo-3.jpg" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Bước 1: Thịt b&ograve; mua về đem rửa sạch, th&aacute;i miếng vừa ăn, ướp với tỏi băm, h&agrave;nh v&agrave; một ch&uacute;t dầu h&agrave;o. C&agrave; chua rửa sạch, th&aacute;i m&uacute;i cau. H&agrave;nh l&aacute; bạn đem cắt bỏ cuống rễ, rửa sạch, rồi th&aacute;i kh&uacute;c nhỏ. Dứa gọt bỏ mắt đi, rửa sạch, th&aacute;i miếng ch&eacute;o vừa ăn. H&agrave;nh, tỏi kh&ocirc; b&oacute;c vỏ băm nhỏ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Bước 2: Bắc chảo dầu ăn l&ecirc;n bếp đợi n&oacute;ng th&igrave; phi thơm tỏi băm. Tiếp theo đổ thịt b&ograve; v&agrave;o x&agrave;o t&aacute;i rồi tr&uacute;t ra đĩa ri&ecirc;ng.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Bước 3: Vẫn c&aacute;i chảo đ&oacute; bạn cho phi th&ecirc;m một ch&uacute;t tỏi rồi đổ dứa, c&agrave; chua v&agrave;o x&agrave;o c&ugrave;ng, cho th&ecirc;m một ch&uacute;t nước v&agrave;o cho dứa mềm, sau đ&oacute; n&ecirc;m gia vị.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>- Bước 4: Khi dứa v&agrave; c&agrave; chua đ&atilde; ch&iacute;n th&igrave; cho thịt b&ograve; v&agrave;o x&agrave;o, thấy hơi cạn nước th&igrave; cho h&agrave;nh l&aacute; v&agrave;o rồi tắt bếp. Cho m&oacute;n thịt b&ograve; x&agrave;o dứa ra đĩa.</p>\r\n\r\n<p><img alt="Có ngay đĩa thịt bò xào dứa ngon lành trong vòng &amp;#34;vài nốt nhạc&amp;#34; - 3" src="http://image.24h.com.vn/upload/2-2017/images/2017-05-18/1495076634-149492670047323-bo-1.jpg" /></p>\r\n\r\n<p>Ch&uacute;c c&aacute;c bạn th&agrave;nh c&ocirc;ng với m&oacute;n&nbsp;thịt b&ograve; x&agrave;o dứa&nbsp;n&agrave;y nh&eacute;!</p>\r\n', 0, 0, 22, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `receive_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_address_lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receive_address_lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nguoi_nhan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thanh_toan` tinyint(4) NOT NULL DEFAULT '0',
  `xac_nhan` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receive_day` date NOT NULL,
  `receive_hour` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` tinyint(4) NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rep_comment_foods`
--

CREATE TABLE `rep_comment_foods` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rep_comment_posts`
--

CREATE TABLE `rep_comment_posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_comment_post` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_profiles`
--

CREATE TABLE `restaurant_profiles` (
  `id` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `link_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` text COLLATE utf8_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_flg` tinyint(4) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant_profiles`
--

INSERT INTO `restaurant_profiles` (`id`, `id_restaurant`, `restaurant_name`, `address`, `lat`, `lng`, `link_website`, `phone_number`, `introduction`, `updated_at`, `created_at`, `delete_flg`, `deleted_at`, `deleted_by`) VALUES
(1, 22, 'Thế giới hải sản (cơ sở 3) Mễ Trì', '55 Cầu Giấy, Hanoi, Vietnam', 21.0122761, 105.77512300000001, 'http://thegioihaisan.vn', '01673203907', '<h2>Lịch sử h&igrave;nh th&agrave;nh</h2>\r\n\r\n<p>Bằng t&igrave;nh y&ecirc;u v&agrave; t&acirc;m huyết với hải sản của c&aacute;c cổ đ&ocirc;ng, th&aacute;ng 10 năm 2013, Nh&agrave; h&agrave;ng Si&ecirc;u thị Thế Giới Hải Sản cơ sở 1 ra đời, tại địa điểm số 18 Dương Đ&igrave;nh Nghệ, Cầu Giấy, H&agrave; Nội. Sau chặng khởi đầu đầy gian nan v&agrave; nhiều th&aacute;ch thức, đến th&aacute;ng 6/2014, CB CNV Thế Giới Hải Sản h&acirc;n hoan ch&agrave;o đ&oacute;n cơ sở 2 tại 75A Trần Hưng Đạo. Một năm sau, v&agrave;o th&aacute;ng 11 năm 2015, cơ sở 3 với quy m&ocirc; lớn hơn, được đầu tư mạnh hơn, đ&atilde; được khai trương, tại t&ograve;a nh&agrave; Golden Palace, Mễ Tr&igrave;, Nam Từ Li&ecirc;m, H&agrave; Nội. Tới ng&agrave;y 25/6/2016, cơ sở 5 số 196 Th&aacute;i Thịnh với sức chứa hơn 150 chỗ ngồi cũng đ&atilde; ra đời, để tăng diện t&iacute;ch phục vụ thực kh&aacute;ch y&ecirc;u th&iacute;ch hải sản. Kế thừa những th&agrave;nh c&ocirc;ng tại chuỗi&nbsp;<strong><a href="http://thegioihaisan.vn/gioi-thieu" target="_blank">nh&agrave; h&agrave;ng hải sản</a></strong>&nbsp;H&agrave; Nội v&agrave; thấu hiểu thời gian thực kh&aacute;ch bỏ ra c&ograve;n gi&aacute; trị hơn cả số tiền chi ti&ecirc;u, hệ thống Nh&agrave; h&agrave;ng Si&ecirc;u thị Thế giới hải sản &ndash; &ldquo;Con g&igrave; đang bơi ch&uacute;ng t&ocirc;i đều c&oacute;&rdquo; ch&iacute;nh thức đi v&agrave;o hoạt động tại S&agrave;i G&ograve;n tại địa chỉ 244Pasteur, Phường 6, Quận 3 từ ng&agrave;y 8/12/2016. Đ&acirc;y được xem l&agrave; một bước tiến mới của thương hiệu Thế Giới Hải Sản, mang theo l&agrave;n s&oacute;ng mới cho ẩm thực hải sản S&agrave;i G&ograve;n.</p>\r\n\r\n<h3>ĐO&Agrave;N MINH PH&Uacute;</h3>\r\n\r\n<p>TỔNG GI&Aacute;M ĐỐC</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="http://thegioihaisan.vn/wp-content/uploads/2014/12/personal_sign2.png" /></p>\r\n', '2017-05-28 10:07:17', '2017-05-24 04:08:45', 0, '0000-00-00 00:00:00', 0),
(2, 31, NULL, NULL, 0, 0, NULL, NULL, NULL, '2017-05-28 03:19:26', '2017-05-27 20:19:26', NULL, NULL, NULL),
(3, 32, NULL, NULL, 0, 0, NULL, NULL, NULL, '2017-05-28 03:20:34', '2017-05-27 20:20:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_detail`
--

CREATE TABLE `role_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_detail`
--

INSERT INTO `role_detail` (`id`, `name`, `created_at`, `updated_at`, `delete_flg`, `deleted_at`, `deleted_by`) VALUES
(0, 'shoppers', '2017-05-24 04:22:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(1, 'shippers', '2017-05-24 04:22:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'branchs', '2017-05-24 04:22:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'restaurants', '2017-05-24 04:22:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'managers', '2017-05-24 04:22:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 'admins', '2017-05-24 04:22:24', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `saved_foods`
--

CREATE TABLE `saved_foods` (
  `id` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_flg` tinyint(4) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `deleted_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `id_food` int(11) NOT NULL,
  `food_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `id_user`, `id_restaurant`, `id_food`, `food_name`, `price`, `number`, `updated_at`, `created_at`) VALUES
(39, 22, 22, 44, 'Trà xoài', 12000, 3, '2017-05-26 15:19:20', '2017-05-26 14:31:44'),
(40, 22, 22, 47, 'sò huyết nướng', 120000, 1, '2017-05-26 14:32:08', '2017-05-26 14:32:08'),
(41, 1, 22, 47, 'sò huyết nướng', 120000, 2, '2017-05-28 09:03:13', '2017-05-28 02:48:34'),
(42, 1, 22, 44, 'Trà xoài', 12000, 1, '2017-05-28 09:03:35', '2017-05-28 09:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `id_company` int(11) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_flg` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `id_company`, `avatar`, `remember_token`, `created_at`, `updated_at`, `delete_flg`, `deleted_by`, `updated_by`, `deleted_at`) VALUES
(1, 'hongha', 'hongha@gmail.com', '$2y$10$1Xoe2Q.5KOta7ELAP6PRauB9x6Nq2j1N3fyjeczHhZ9NdWyGGz.OS', 5, 0, 'aDIZ7l8Zmkgf.jpg', 'SGd5K98KpEhw9wQo235XuwixHS27nalm6YqF0KE3vQ6yyui4PY8oe1zZDLrA', '2016-12-22 21:43:08', '2017-05-28 10:06:45', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'hadh', 'hadh@gmail.com', '$2y$10$Yj6BEd6zwAII3ryLRhu2SuCwZX0t0zSWJl3mVccJD8ParofHGNNs.', 4, 0, '', 'frtTG937g2p4eyNqSW92LZvU2KTgCwIU8IuWQLIk8CN5Kgdi9zRTc7lFmet4', '2016-12-23 20:56:26', '2017-05-26 16:28:13', 1, 1, 0, '2017-05-22 03:23:53'),
(3, 'doanhongha', 'doanhongha1994hedspik57@gmail.com', '$2y$10$YudXfe9BTnN0SYiNQXoJNuVWiuF57aoiAYWISgAjcXzwOYChmXhfG', 0, 0, NULL, '1G8ctpJoWDuEytJqWJVkGMCvTiSnIRnUTJTuacwWMeZSZSNEaOiB2JzwF7uR', '2016-12-25 03:28:59', '2017-05-18 07:18:49', 0, 1, 0, '2017-05-18 07:18:49'),
(4, 'doanhong', 'ha2@gmail.com', '$2y$10$eHsCiHRc4jWc88LlIf.aR.fhRerVa5m3NAju4hSOkR.6gXZfffyW6', 4, 0, NULL, 'uM7Ay21BOOf9JZGj7E1Hf6Vj13WCkJtL8sqBm5i2JdaonGqJYPuuzHhCpwDl', '2016-12-25 19:09:21', '2017-05-22 03:23:55', 1, 1, 1, '2017-05-22 03:23:55'),
(5, 'honghai1990', 'honghai@gmail.com', '$2y$10$HrFJAtjGpZjXqLFFBtw8S..tzZ15/r1maEs/cvwWIMiC5ybvhsdDS', 1, 0, NULL, NULL, '2016-12-25 20:05:12', '2017-05-21 09:49:25', 0, 1, 0, '2017-05-21 09:49:25'),
(6, 'honghaxxx', 'honghaxxx@gmail.com', '$2y$10$cnqHuwsKcB5mmXE.gkoOu.j/a22oNKEJPT7Taio8Q0JfTO99etW5e', 4, 0, NULL, NULL, '2016-12-25 20:09:51', '2017-05-22 03:23:58', 1, 1, 1, '2017-05-22 03:23:58'),
(7, 'hongquan', 'hongquan@gmail.com', '$2y$10$ZERZiW.y8VEH0wVac02c8ukmuOL17feL.GQpprz6LyXpeqJbczgn2', 4, 0, NULL, 'rBmvOcsVzGy1gIgluwoH01BIp7WKgWvZe8peM8c3fTKgcqviu9a0UN0t6DE9', '2016-12-30 20:50:19', '2017-05-22 03:24:01', 1, 1, 1, '2017-05-22 03:24:01'),
(8, 'nguyenhien', 'nguyenhien@gmail.com', '$2y$10$Jvu9mOYD34Pjuiv35t7wE.U3OtCBbUUkjILxt4ED07Y2ThrMfXyUa', 4, 0, NULL, 'ulzWMHddR3GQKOebrCq7fAVt1wS9bMbbnq7oJqOoExWpR2Zd4AS4CnJwUDDg', '2016-12-31 03:02:45', '2017-05-21 10:00:53', 1, 1, 1, '2017-05-21 10:00:53'),
(9, 'hongha1994', 'hongha1994@gmail.com', '$2y$10$4MiVvkjYKr69OOyc4B.ifeUAJvY719gYXsm0Wh0PKa4Uy8GvlSdum', 0, 0, NULL, 'gjtOBxjqqdeiYhtynIe3rS5K7FqBOBCaiTf0xxVWIm2dyK8EduowXL3OWZ7z', '2017-01-12 23:06:21', '2017-05-21 09:46:39', 0, 1, 0, '2017-05-21 09:46:39'),
(10, 'baocaoproject2', 'baocao@gmail.co', '$2y$10$3ZIOumA59CQGRRVJmLrH8.02YMgNGKbRJ60kggyV2u1qPx1Hb.7GC', 4, 0, NULL, 'Ea0UZCdlIfGFzkfDcrY0XFjsnQbwWQzImkXIvpCPIOkPGJqZ56A7T89PQQep', '2017-01-12 23:09:11', '2017-05-21 10:00:57', 1, 1, 1, '2017-05-21 10:00:57'),
(11, 'qweqewqwe', 'adasdadadasd@gmail.com', '$2y$10$exPBHcCr3ttcTdOSqYJK0e0/Oo1yE6VIxJ/SZiut0MfWzbJ1jyLy6', 4, 0, '1', 'E33Xp6iYiKJR8U3X1uAzfAYPL0TSUdtYwwwjXrusC2nWMmQk3lfYqw5gfneF', '2017-02-27 20:15:35', '2017-05-21 09:52:19', 1, 1, 1, '2017-05-21 09:52:19'),
(12, 'dasdasdasd', 'dasdasdasd@gmail.com', '$2y$10$9WI7dgAdbqE059inl6ciAeaxEXNCEwI7g4UyG2BVd60km7nUOSCNC', 4, 0, '1', 'EjzVlTZpEEF3oArD7h2fsaZZAeE0bQNc0jC7qNMo0KfiZeeJbkaDGktoSZle', '2017-02-27 20:18:58', '2017-05-26 16:35:18', 1, 1, 1, '2017-05-26 16:35:18'),
(13, 'dfgdfgdfg', 'dfgdgdgd@gmail.com', '$2y$10$tdzdRcVT00dJsVw5wdFdg.ooxR6VyJr1q4AEhU76C6uvL0AS0tA8C', 4, 0, '1', '1FX3jgBkIZFfqsCBVOMEUNFBjqzaBZy4L56wL4WgtuO4l5bbJL8sDUCmVDF7', '2017-02-27 20:27:37', '2017-05-21 10:01:00', 1, 1, 1, '2017-05-21 10:01:00'),
(14, 'adadasdasd', 'asdadadasdas@gmail.com', '$2y$10$Vy/rwF/NT5gTG2J.6XCjlO1oqcdef.3dXHBGzlxyEolbR/D7.Hb/y', 0, 0, 'aDIZ7l8Zmkgf.jpg', '899qSbCxsFHZZTgBFTWFRNkD70rXGJyacPmOC6dxQVwLOrzgfPpP9QBWZka8', '2017-02-27 20:28:19', '2017-02-28 03:28:57', 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'hongha123', 'hongha123@gmail.com', '$2y$10$/eVnH0fB63FLySU27q6atOxAU0e081PWy3v3sgHsENtmQgecypWra', 4, 0, 'aDIZ7l8Zmkgf.jpg', 'yDT0Zp4Z7JNzBkCJw8BNtjszpmepT6FT2XfZoMAidPtjtGeCHEroVkQmWL9w', '2017-02-27 20:36:54', '2017-05-21 09:44:53', 0, 1, 1, '2017-05-21 09:44:53'),
(16, 'hongha1995', 'hongha1995@gmail.com', '$2y$10$OlUfA5dAvzYSu/I/1vBmC.6gT1JD9Z0L7cz0.qeDpsso2sIccBLb2', 4, 0, 'noavatar.png', 'YQjNI1jhMMlSWSOy0iypOOM5QWIrZ1ims0dC9q0zZUfao60ENXceexGZv03y', '2017-02-27 20:38:13', '2017-05-21 09:00:50', 0, 1, 1, '2017-05-21 09:00:50'),
(17, 'ádadasdasda', 'sdsda@gmail.com', '$2y$10$9cXgWJNJPAcz2pJwbevn9OeYZj/XBRtIo9U9ykiT5ZsP6bycaZsT2', 0, NULL, 'Tk0Taws0WATL.jpg', 'U4mknBpkgj12fUxa9jo0RTn7V29Y6LuWf2diZNs3lHcZRIbiL2dJOWwCMMbC', '2017-02-28 00:18:56', '2017-02-28 07:22:06', 0, NULL, NULL, NULL),
(18, 'kjjjksdfsdfsdfsf', 'hjkk@gmail.com', '$2y$10$u56ZzZI9djI6PSwKAZtD4eLhEH.5KGTxY9HSRvLwUgGGEKjgGVTmW', 1, NULL, 'yByfRcK8ThxH.jpg', 'EFYlCIafqIDt0ahNclAixSVn6bQcb3wM6ilznMC1McYfhLQqksTeqWqAUxS1', '2017-02-28 00:22:47', '2017-05-21 09:46:33', 0, 1, NULL, '2017-05-21 09:46:33'),
(19, 'ditimthatbai', 'ditimthatbai@gmail.com', '$2y$10$l0.B3Gi1rZ6owTeoTzMQM.SmHdQFM23afJLSrSmi714VRZ9xomrlW', 4, NULL, 'W2xDKYaEvX67.jpg', 'KYrl26SxfS2fYdZW8Pkfe4rat2Xcz8jRVd1fTYrAgxkCoFltTCs6SSlEAc63', '2017-03-19 08:15:33', '2017-05-21 09:49:43', 0, 1, 1, '2017-05-21 09:49:43'),
(20, 'hahedspik57', 'doanhongha@gmail.com', '$2y$10$.ZSkQcYk3M3rYwyJmsbgiOSIe8iLhxWtH5tVvYXCUgI1cv5nmw.YK', 3, NULL, 'UHenujW0592F.jpg', NULL, '2017-04-03 19:03:44', '2017-05-21 09:49:36', 0, 1, NULL, '2017-05-21 09:49:36'),
(21, 'umaimono1994', 'umaimono1994@gmail.com', '$2y$10$wFdnd43LMEpA3k9TjENmMODXXYKs44X2XI5kVV340OCGOB6oAw6NK', 1, NULL, 'EZv7q8w8vFm5.jpg', NULL, '2017-05-03 01:37:27', '2017-05-21 09:49:29', 0, 1, NULL, '2017-05-21 09:49:29'),
(22, 'restaurent123', 'restaurent123@gmail.com', '$2y$10$q134wyMiyep/NFP5r.8x4uwlRIYTlmFRzB9k0rjqcb9aY5GpI5WuW', 3, NULL, 'thegioihaisan.png', 'zFPrtx1KGqsh31KnjjWZC4Dh7W6gSuUQtmMbGTOwSdlXtVvvZlwYPbyeiMtq', '2017-05-03 19:28:11', '2017-05-26 16:26:48', 0, 1, NULL, '2017-05-21 09:45:15'),
(23, 'restaurent1234', 'restaurent1234@gmail.com', '$2y$10$lwpBTfoM1R36BOfu3Ux6zOG0DSa7Y4ZQi4J5taoH1IAhe0ieayWr2', 3, NULL, 'Fgpvkyd74zH4.jpg', NULL, '2017-05-07 09:22:33', '2017-05-18 06:36:24', 0, 1, NULL, '2017-05-18 06:36:24'),
(24, 'restaurent12', 'restaurent12@gmail.com', '$2y$10$5rCfrwjq2OBJAj0Mo3QyxOk7tb66QtMsrS1cQw/VGpyWkG7ENppV.', 3, NULL, 'MbkqvNKmloZh.jpg', NULL, '2017-05-07 18:36:56', '2017-05-08 01:36:56', 0, NULL, NULL, NULL),
(25, 'restaurant', 'restaurant@gmail.com', '$2y$10$FW4oGEdsbxFk6Gj6YMTtzOW8yd77vzcuvLi.RmZKcj3vLf30TXtpe', 3, NULL, 'Oaym5mvU9xEJ.jpg', NULL, '2017-05-27 19:58:11', '2017-05-28 02:58:11', 0, NULL, NULL, NULL),
(26, 'restaurant1', 'restaurant1@gmail.com', '$2y$10$.hiYPjddKCjj2jRzituW0OrlnEaZXLrrUa8V/6pJsW/8s9UUICzkS', 3, NULL, 'nJFvguROGxai.jpg', NULL, '2017-05-27 20:00:12', '2017-05-28 03:00:12', 0, NULL, NULL, NULL),
(27, 'restaurant2', 'restaurant2@gmail.com', '$2y$10$pEZloKRB7F7OsmcGp/wke.DNbfAboyVXLylc3pPHDQlcWopXdz6Hu', 3, NULL, 'bfALbkgeEDfJ.jpg', NULL, '2017-05-27 20:00:55', '2017-05-28 03:00:55', 0, NULL, NULL, NULL),
(28, 'restaurant3', 'restaurant3@gmail.com', '$2y$10$cPF4SoxXs1emLpTkNBS65uMP2j/bYbMWlrGBHifdGfirm176b.eDC', 3, NULL, 'CXJqem9dRhRV.jpg', 'KcdZBMs1hX9dGxVaLT8Y2jBYmw5oKrgIixiAbJqlpQbsuUtnXTJkZhRVrF0U', '2017-05-27 20:07:39', '2017-05-28 03:10:23', 0, NULL, NULL, NULL),
(29, 'restaurant4', 'restaurant4@gmail.com', '$2y$10$/1lQmvoL4ASx/tfhzLsyx.hr4s5eC5fMfFvB8WEWp2ozcW.HUwA12', 3, NULL, 'ThRXYsHoTHvs.jpg', 'tHf5UGJXYROykljtLCtSmdpCzlIqdyKLggkFgA4MLEJRA0iMFPJ0bWJJSi6l', '2017-05-27 20:11:03', '2017-05-28 03:12:14', 0, NULL, NULL, NULL),
(30, 'restaurant5', 'restaurant5@gmail.com', '$2y$10$uZ23xfOcprs6OGG7Ob5lbuJXL/yMYcMb1pMnTmpgtRlvVnK8JOCoO', 3, NULL, '5eNADSVKWoLv.jpg', 'D2aibQbhuhglNmUDbSYZ5tOBoCT4GphyCREUhijzffdb4WkuV1sVxNS9qzmY', '2017-05-27 20:12:38', '2017-05-28 03:13:59', 0, NULL, NULL, NULL),
(31, 'restaurant6', 'restaurant6@gmail.com', '$2y$10$1.EeUW.VoikU/nix1J/JN.hLnS/zne3VSoUDrDx6pEUiBJ4CmqHte', 3, NULL, 'n8h10tKBTbWz.jpg', NULL, '2017-05-27 20:19:26', '2017-05-28 03:19:26', 0, NULL, NULL, NULL),
(32, 'restaurant7', 'restaurant7@gmail.com', '$2y$10$XPVzhCvwaY/BkQIrLvcC8u3JGg5QP7jQqWAcjstDducymPnXt.N2O', 3, NULL, 'YZg7RNJ25DBu.jpg', NULL, '2017-05-27 20:20:33', '2017-05-28 03:20:33', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_foods`
--
ALTER TABLE `comment_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_type_details`
--
ALTER TABLE `food_type_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_comment_foods`
--
ALTER TABLE `like_comment_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_comment_posts`
--
ALTER TABLE `like_comment_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_foods`
--
ALTER TABLE `like_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_posts`
--
ALTER TABLE `like_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rep_comment_foods`
--
ALTER TABLE `rep_comment_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rep_comment_posts`
--
ALTER TABLE `rep_comment_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_profiles`
--
ALTER TABLE `restaurant_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_detail`
--
ALTER TABLE `role_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_foods`
--
ALTER TABLE `saved_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_foods`
--
ALTER TABLE `comment_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `food_type_details`
--
ALTER TABLE `food_type_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `like_comment_foods`
--
ALTER TABLE `like_comment_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `like_comment_posts`
--
ALTER TABLE `like_comment_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `like_foods`
--
ALTER TABLE `like_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `like_posts`
--
ALTER TABLE `like_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rep_comment_foods`
--
ALTER TABLE `rep_comment_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rep_comment_posts`
--
ALTER TABLE `rep_comment_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurant_profiles`
--
ALTER TABLE `restaurant_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `saved_foods`
--
ALTER TABLE `saved_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
