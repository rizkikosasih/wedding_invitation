-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for wedding
CREATE DATABASE IF NOT EXISTS `wedding` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `wedding`;

-- Dumping structure for table wedding.akses_menu
CREATE TABLE IF NOT EXISTS `akses_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int NOT NULL,
  `grup_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=325 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- Dumping data for table wedding.akses_menu: 22 rows
DELETE FROM `akses_menu`;
/*!40000 ALTER TABLE `akses_menu` DISABLE KEYS */;
INSERT INTO `akses_menu` (`id`, `menu_id`, `grup_id`) VALUES
	(288, 2, 1),
	(259, 14, 3),
	(260, 14, 1),
	(261, 14, 2),
	(318, 2, 3),
	(315, 2, 2),
	(314, 3, 2),
	(265, 3, 3),
	(266, 3, 1),
	(267, 15, 1),
	(274, 13, 3),
	(273, 17, 1),
	(270, 16, 1),
	(279, 16, 2),
	(275, 13, 1),
	(276, 1, 1),
	(277, 1, 3),
	(278, 1, 2),
	(316, 18, 1),
	(322, 22, 1),
	(323, 23, 1),
	(324, 23, 2);
/*!40000 ALTER TABLE `akses_menu` ENABLE KEYS */;

-- Dumping structure for table wedding.bank
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.bank: 3 rows
DELETE FROM `bank`;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` (`id`, `name`, `image`) VALUES
	(1, 'BCA', 'bca-white.png'),
	(2, 'BRI', ''),
	(3, 'ETC', '');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;

-- Dumping structure for table wedding.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL DEFAULT '0',
  `name` tinytext NOT NULL,
  `message` text NOT NULL,
  `date_added` datetime NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.comment: 1 rows
DELETE FROM `comment`;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `event_id`, `name`, `message`, `date_added`, `isDelete`) VALUES
	(1, 1, 'Test', 'test', '2022-12-25 10:04:54', 0);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Dumping structure for table wedding.event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bank_id` int NOT NULL,
  `bank_id2` int NOT NULL,
  `event_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reception_date` datetime NOT NULL,
  `wedding_date` datetime NOT NULL,
  `reception_location` text NOT NULL,
  `wedding_location` text NOT NULL,
  `number_rekening` varchar(20) NOT NULL DEFAULT '',
  `number_rekening2` varchar(20) NOT NULL DEFAULT '',
  `atas_nama` tinytext NOT NULL,
  `atas_nama2` tinytext NOT NULL,
  `wedding_map` text NOT NULL,
  `cover` text NOT NULL COMMENT 'image',
  `cover_mobile` text NOT NULL,
  `background_gallery` text NOT NULL COMMENT 'image',
  `background_gallery_mobile` text NOT NULL,
  `background_home` text NOT NULL COMMENT 'image',
  `background_home_mobile` text NOT NULL,
  `name_man` tinytext NOT NULL,
  `alias_man` tinytext NOT NULL,
  `desc_man` text NOT NULL,
  `image_man` text NOT NULL,
  `name_woman` tinytext NOT NULL,
  `alias_woman` tinytext NOT NULL,
  `desc_woman` text NOT NULL,
  `image_woman` text NOT NULL,
  `template_wa` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bank_id` (`bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.event: 1 rows
DELETE FROM `event`;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `bank_id`, `bank_id2`, `event_name`, `reception_date`, `wedding_date`, `reception_location`, `wedding_location`, `number_rekening`, `number_rekening2`, `atas_nama`, `atas_nama2`, `wedding_map`, `cover`, `cover_mobile`, `background_gallery`, `background_gallery_mobile`, `background_home`, `background_home_mobile`, `name_man`, `alias_man`, `desc_man`, `image_man`, `name_woman`, `alias_woman`, `desc_woman`, `image_woman`, `template_wa`, `date_added`, `date_modify`) VALUES
	(1, 1, 0, 'Wedding Ola & Atta', '2023-02-05 10:30:00', '2023-02-05 09:00:00', 'Jl. Sabangan No. 378', 'Jl. Sabangan No. 378', '1234567890', '', 'Ariola', '', '&lt;iframe src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.769504343384!2d106.81222731435987!3d-6.1616166621031905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f67683b657bd%3A0xb9b974541a653ffd!2sJl.%20Petojo%20Utara%20III%20No.240%2C%20RT.17%2FRW.3%2C%20Petojo%20Utara%2C%20Kecamatan%20Gambir%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010130!5e0!3m2!1sen!2sid!4v1671244826772!5m2!1sen!2sid&quot; width=&quot;1920&quot; height=&quot;1080&quot; style=&quot;border:0;&quot; allowfullscreen=&quot;true&quot; loading=&quot;lazy&quot; referrerpolicy=&quot;no-referrer-when-downgrade&quot;&gt;&lt;/iframe&gt;', '', '', '', '', '', '', 'Janahtan Firdaus', 'Janahtan', '&lt;p&gt;&lt;span style=&quot;color: #818491; font-family: Montserrat, sans-serif; font-size: 16px; text-align: right; background-color: #edf5f7;&quot;&gt;Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd clita kasd stet amet est dolor elitr.&lt;/span&gt;&lt;/p&gt;', '83918_about-1.jpg', 'Riska Ariola', 'Ariola', '&lt;p&gt;&lt;span style=&quot;color: #818491; font-family: Montserrat, sans-serif; font-size: 16px; text-align: right; background-color: #edf5f7;&quot;&gt;Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd clita kasd stet amet est dolor elitr.&lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;span style=&quot;color: #818491; font-family: Montserrat, sans-serif; font-size: 16px; text-align: right; background-color: #edf5f7;&quot;&gt;test&lt;/span&gt;&lt;/p&gt;', '83918_about-2.jpg', 'Assalamualaikum Wr.Wb\r\n%0A\r\nTanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i {name} untuk menghadiri acara kami.\r\n%0A\r\nBerikut link undangan kami, untuk info lengkap dari acara bisa kunjungi :\r\n%0A%0A\r\n{link}\r\n%0A%0A\r\nMerupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu.\r\n%0A%0A\r\nMohon maaf perihal undangan hanya di bagikan melalui pesan ini.\r\n%0A%0A\r\nDan karena suasana masih pandemi, diharapkan untuk tetap menggunakan masker dan datang pada jam yang telah ditentukan.\r\n%0A\r\nTerima kasih banyak perhatiannya.', '2022-12-17 12:36:26', '2024-04-21 03:20:44');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;

-- Dumping structure for table wedding.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `images` text NOT NULL,
  `description` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.gallery: 6 rows
DELETE FROM `gallery`;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`id`, `event_id`, `images`, `description`, `date_added`, `date_modify`, `isActive`, `isDelete`) VALUES
	(1, 1, '', 'Gambar 1', '2022-12-18 11:27:12', '2024-04-21 03:21:30', 1, 1),
	(2, 1, '', 'Gambar 2', '2022-12-18 11:43:43', '2024-04-21 03:21:32', 1, 0),
	(3, 1, '', 'Gambar 3', '2022-12-18 23:59:26', '2024-04-21 03:21:33', 1, 0),
	(4, 1, '', 'Gambar 4', '2022-12-18 23:59:42', '2024-04-21 03:21:34', 1, 0),
	(5, 1, '', 'Gambar 5', '2022-12-18 23:59:56', '2024-04-21 03:21:36', 1, 0),
	(6, 1, '', 'Gambar 6', '2022-12-19 00:00:14', '2024-04-21 03:21:37', 1, 0);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;

-- Dumping structure for table wedding.grup
CREATE TABLE IF NOT EXISTS `grup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_grup` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table wedding.grup: 5 rows
DELETE FROM `grup`;
/*!40000 ALTER TABLE `grup` DISABLE KEYS */;
INSERT INTO `grup` (`id`, `nama_grup`, `deskripsi`) VALUES
	(1, 'Super Admin', 'Super Admin'),
	(2, 'Admin', 'Admin'),
	(3, 'Pimpinan', 'Pimpinan'),
	(4, 'Customer', 'Customer'),
	(11, 'Abc', 'Abc');
/*!40000 ALTER TABLE `grup` ENABLE KEYS */;

-- Dumping structure for table wedding.halaman_statis
CREATE TABLE IF NOT EXISTS `halaman_statis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section` varchar(128) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `isi` text NOT NULL,
  `jenis` enum('f','b') NOT NULL DEFAULT 'b',
  `isImage` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `date_added` datetime NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table wedding.halaman_statis: 13 rows
DELETE FROM `halaman_statis`;
/*!40000 ALTER TABLE `halaman_statis` DISABLE KEYS */;
INSERT INTO `halaman_statis` (`id`, `section`, `judul`, `isi`, `jenis`, `isImage`, `isActive`, `date_added`, `date_modify`) VALUES
	(2, 'img-dashboard', 'Images Dashboard', '99788_git_data_transport_commands.png', 'b', 1, 1, '2022-06-13 09:59:19', '2022-10-17 10:42:41'),
	(3, 'txt-dashboard', 'Dashboard Text', '<div><strong>Lorem Ipsum</strong> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun.</div>', 'b', 0, 1, '2022-06-13 10:16:59', '2022-10-17 10:42:51'),
	(4, 'logo-icon', 'Icon Logo', '98794_adminltelogo.png', 'b', 1, 1, '2022-06-14 04:26:10', '2022-10-17 10:42:41'),
	(5, 'logo-txt', 'Text Logo', '<div>Backend</div>', 'b', 0, 1, '2022-06-14 04:39:00', '2022-10-21 07:58:38'),
	(6, 'footer-txt', 'Text Footer', '<div>Created By&nbsp;<strong>Kosasih</strong></div>', 'b', 0, 1, '2022-06-14 04:45:32', '2022-10-17 10:42:51'),
	(7, 'login-img', 'Image Login', '67788_photo4.jpg', 'f', 1, 1, '2022-06-14 05:08:54', '2022-10-17 10:42:41'),
	(8, 'nama-pt', 'Nama Perusahaan', '<div>PT. XYZ</div>', 'b', 0, 1, '2022-06-14 05:25:57', '2022-10-17 10:42:51'),
	(9, 'alamat-pt', 'Alamat Perusahaan', '<div>Tidak Ada&nbsp;Tujuan</div>', 'b', 0, 1, '2022-06-14 05:26:30', '2022-10-17 10:42:51'),
	(11, 'inisial-pt', 'Inisial Perusahaan', '<div>abc</div>', 'b', 0, 1, '2022-06-18 08:49:58', '2022-10-17 10:42:51'),
	(12, 'img-about', 'Image About', '70096_hero-bg2.jpg', 'f', 1, 1, '2022-06-24 13:44:59', '2022-10-17 10:42:41'),
	(13, 'txt-about', 'Text About', '<h2 style="margin: 0px 0px 10px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px;">Where Does It Come From?</h2>\r\n<p style="margin: 0px 0px 15px; padding: 0px; text-align: Justify; font-family: \'Open Sans\', Arial, Sans-serif; font-size: 14px;">Contrary To Popular Belief, Lorem Ipsum Is Not Simply Random Text. It Has Roots In A Piece Of Classical Latin Literature From 45 BC, Making It Over 2000 Years Old. Richard McClintock, A Latin Professor At Hampden-Sydney College In Virginia, Looked Up One Of The More Obscure Latin Words, Consectetur, From A Lorem Ipsum Passage, And Going Through The Cites Of The Word In Classical Literature, Discovered The Undoubtable Source. Lorem Ipsum Comes From Sections 1.10.32 And 1.10.33 Of "de Finibus Bonorum Et Malorum" (The Extremes Of Good And Evil) By Cicero, Written In 45 BC. This Book Is A Treatise On The Theory Of Ethics, Very Popular During The Renaissance. The First Line Of Lorem Ipsum, "Lorem Ipsum Dolor Sit Amet..", Comes From A Line In Section 1.10.32.</div>', 'f', 0, 1, '2022-06-24 13:48:00', '2022-10-17 10:42:51'),
	(14, 'contact-person', 'Contact Person', '<div><strong>Nama</strong></div>\r\n<div>XYZ Organizer</div>\r\n<div><strong>Alamat</strong></div>\r\n<div>Jl. Memutar</div>\r\n<div><strong>No Telp</strong></div>\r\n<div>(021)&nbsp;614231</div>\r\n<div><strong>Email</strong></div>\r\n<div>xyz@gmail.com</div>', 'f', 0, 1, '2022-06-24 14:10:20', '2022-10-17 10:42:51'),
	(17, 'bg-login', 'Background Auth Admin', '51712_photo1.png', 'b', 1, 1, '2022-07-15 23:08:34', '2022-10-17 10:59:23');
/*!40000 ALTER TABLE `halaman_statis` ENABLE KEYS */;

-- Dumping structure for table wedding.list_tab
CREATE TABLE IF NOT EXISTS `list_tab` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.list_tab: 5 rows
DELETE FROM `list_tab`;
/*!40000 ALTER TABLE `list_tab` DISABLE KEYS */;
INSERT INTO `list_tab` (`id`, `name`) VALUES
	(1, 'Event Detail'),
	(2, 'Love Story'),
	(3, 'Gallery'),
	(4, 'Wishes'),
	(5, 'Send WA');
/*!40000 ALTER TABLE `list_tab` ENABLE KEYS */;

-- Dumping structure for table wedding.love_story
CREATE TABLE IF NOT EXISTS `love_story` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `title` tinytext NOT NULL,
  `body` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sort` int NOT NULL,
  `position` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`) USING BTREE,
  KEY `title` (`title`(63))
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.love_story: 4 rows
DELETE FROM `love_story`;
/*!40000 ALTER TABLE `love_story` DISABLE KEYS */;
INSERT INTO `love_story` (`id`, `event_id`, `title`, `body`, `date_added`, `date_modify`, `sort`, `position`, `isActive`, `isDelete`) VALUES
	(2, 1, 'First Meet', 'Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd clita kasd stet amet est dolor elitr.', '0000-00-00 00:00:00', '2022-12-17 13:12:32', 1, 0, 1, 0),
	(3, 1, 'First Date', 'Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd clita kasd stet amet est dolor elitr.', '2022-12-17 17:38:38', '2022-12-17 13:12:49', 2, 1, 1, 0),
	(4, 1, 'Proposal', 'Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd clita kasd stet amet est dolor elitr.', '2022-12-17 20:25:25', '2022-12-18 17:52:14', 3, 0, 1, 0),
	(5, 1, 'Engagement', 'Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd clita kasd stet amet est dolor elitr.', '2022-12-17 20:25:49', '2022-12-18 17:52:18', 4, 1, 1, 0);
/*!40000 ALTER TABLE `love_story` ENABLE KEYS */;

-- Dumping structure for table wedding.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(256) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL DEFAULT '#',
  `urutan` int NOT NULL DEFAULT '2',
  `tipe` enum('b','f') NOT NULL DEFAULT 'b',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isLogin` tinyint(1) NOT NULL DEFAULT '1',
  `induk_id` int NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table wedding.menu: 10 rows
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nama_menu`, `icon`, `url`, `urutan`, `tipe`, `isActive`, `isLogin`, `induk_id`, `isDelete`) VALUES
	(1, 'Website', 'fas fa-cogs', '#', 99, 'b', 1, 1, 0, 0),
	(2, 'Administrator', 'fas fa-user-shield', '#', 3, 'b', 1, 1, 0, 0),
	(3, 'Dashboard', 'fas fa-tachometer-alt', 'dashboard', 1, 'b', 1, 1, 0, 0),
	(13, 'Grup', 'fas fa-layer-group', 'grup', 3, 'b', 1, 1, 1, 0),
	(14, 'Halaman Statis', 'fas fa-columns', 'halaman_statis', 1, 'b', 1, 1, 1, 0),
	(15, 'Data Menu', 'fas fa-bars', 'menu', 3, 'b', 1, 1, 1, 0),
	(17, 'Data User', 'fas fa-user', 'user', 2, 'b', 1, 1, 1, 0),
	(18, 'Pelanggan', 'fas fa-user', 'pelanggan', 3, 'b', 0, 1, 2, 0),
	(22, 'Event', 'far fa-calendar-alt', 'event', 4, 'b', 1, 1, 2, 0),
	(23, 'Undangan Terkirim', 'fas fa-envelope-circle-check', 'sent', 2, 'b', 1, 1, 2, 0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table wedding.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_depan` varchar(128) NOT NULL,
  `nama_belakang` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `createDate` datetime NOT NULL,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=536 DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- Dumping data for table wedding.pelanggan: 519 rows
DELETE FROM `pelanggan`;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`id`, `nama_depan`, `nama_belakang`, `alamat`, `no_hp`, `isActive`, `isDelete`, `createDate`, `updateDate`) VALUES
	(1, 'Cheyanne', 'Rosenbaum', 'Port Kaylatown', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(2, 'Avery', 'Konopelski', 'North Orphaview', '81', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(3, 'Kelvin', 'Kilback', 'Lake Edmouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(4, 'Rasheed', 'Johnston', 'Whitneychester', '573', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(5, 'Jena', 'Pollich', 'North Lizziechester', '838402742', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(6, 'Mabelle', 'Braun', 'North Demondport', '3834408279', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(7, 'Dorthy', 'Schmitt', 'Oswaldberg', '37', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(8, 'Noelia', 'Kertzmann', 'Mertzland', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(9, 'Kellie', 'McGlynn', 'New Edythmouth', '167', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(10, 'Hipolito', 'Wyman', 'Reichertside', '384', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(11, 'Blanche', 'Spinka', 'North Isaiasshire', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(12, 'Axel', 'Ondricka', 'Port Abdullahberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(13, 'Sigurd', 'Bradtke', 'East Marc', '5239651618', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(14, 'Zechariah', 'Prosacco', 'North Rogers', '926', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(15, 'Deanna', 'Larkin', 'South Candice', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(16, 'Jaida', 'Spencer', 'Karlstad', '60', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(17, 'Berry', 'Howe', 'Eleazarfurt', '917', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(18, 'Rita', 'Hodkiewicz', 'Hudsontown', '967400137', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(19, 'Emie', 'Parisian', 'Lynchberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(20, 'Nadia', 'Willms', 'Port Trevion', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(21, 'Pinkie', 'Durgan', 'Hesterfort', '525', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(22, 'Alana', 'Anderson', 'West Kalichester', '464', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(23, 'Pearl', 'Kirlin', 'New Theo', '624', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(24, 'Matteo', 'Pollich', 'South Tad', '818', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(25, 'Simone', 'Feil', 'Port Nelliestad', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(26, 'Tyrell', 'Bergstrom', 'Bauchmouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(27, 'Dedrick', 'Koelpin', 'Schusterburgh', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(28, 'Lamont', 'Rempel', 'Feestfort', '643', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(29, 'Eladio', 'Ledner', 'Chancechester', '214', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(30, 'Armand', 'Cronin', 'Isomton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(31, 'Delta', 'Pouros', 'South Hershel', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(32, 'Krystel', 'Schroeder', 'Georgianastad', '147', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(33, 'German', 'Rodriguez', 'Farrellstad', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(34, 'Cleta', 'Zulauf', 'New Daija', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(35, 'Royce', 'Larkin', 'Port Aliciaberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(36, 'Blanca', 'Rosenbaum', 'Lillymouth', '581', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(37, 'Reta', 'Watsica', 'New Jewell', '5', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(38, 'Krista', 'Smitham', 'South Jaylenburgh', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(39, 'Randall', 'Thompson', 'East Lee', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(40, 'Tyrese', 'Hyatt', 'Reingerside', '5', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(41, 'Maude', 'Huels', 'East Andreborough', '529', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(42, 'Caesar', 'Roob', 'West Natasha', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(43, 'Bella', 'Rutherford', 'Dietrichfort', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(44, 'Grayce', 'Bruen', 'West Lincoln', '151', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(45, 'Jackie', 'Steuber', 'West Gastonfurt', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(46, 'Justice', 'Gleason', 'Kundehaven', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(47, 'Carlotta', 'Batz', 'Hahnville', '27', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(48, 'Lue', 'Hoppe', 'Kunzeside', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(49, 'Edyth', 'Quitzon', 'Lake Lonport', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(50, 'Anastacio', 'Blanda', 'Rippinside', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(51, 'Hillary', 'Spinka', 'Strackemouth', '2101320677', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(52, 'Orlo', 'Reichert', 'Whitechester', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(53, 'Presley', 'Bashirian', 'Cristtown', '996', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(54, 'Bernadette', 'Rempel', 'Lake Aisha', '9416835519', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(55, 'Abbey', 'Walter', 'South Bryonchester', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(56, 'Clifton', 'Ryan', 'Lake Fridastad', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(57, 'Marquise', 'Hermann', 'East Felixbury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(58, 'Kasey', 'Koelpin', 'Cecilbury', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(59, 'Marlee', 'Feeney', 'Alberthaport', '926', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(60, 'Genesis', 'Crist', 'Miracleberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(61, 'Drew', 'Kutch', 'Aishachester', '75', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(62, 'Ken', 'Borer', 'Bradenstad', '3', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(63, 'Ilene', 'Sauer', 'Nicolasview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(64, 'Eveline', 'Hansen', 'Andreaneborough', '126', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(65, 'Rhoda', 'Brekke', 'Artmouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(66, 'Corine', 'Marks', 'Lake Camronfort', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(67, 'Myrl', 'Goodwin', 'Port Gilesmouth', '252', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(68, 'Molly', 'Jast', 'Carterfort', '584', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(69, 'Abraham', 'Gutkowski', 'Leonardomouth', '521', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(70, 'Camila', 'Smitham', 'Andyport', '265', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(71, 'Solon', 'Koss', 'Johnstonshire', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(72, 'Theodore', 'Steuber', 'Juanatown', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(73, 'Lyla', 'Pfeffer', 'McGlynnport', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(74, 'Gerald', 'Streich', 'Erdmanborough', '519', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(75, 'Frederic', 'Lakin', 'East Lottie', '9026322677', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(76, 'Myrtice', 'Crona', 'West Dallin', '29', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(77, 'Delpha', 'Greenholt', 'East Ethel', '328', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(78, 'Kadin', 'Doyle', 'Karianneburgh', '791', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(79, 'George', 'Gerhold', 'Denesikton', '379', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(80, 'Bria', 'Prohaska', 'Port Serenity', '88', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(81, 'Velda', 'Goodwin', 'Lake Carrieborough', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(82, 'Consuelo', 'Murphy', 'East Llewellynside', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(83, 'Ashly', 'Marks', 'New Stacey', '2330400376', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(84, 'Lina', 'Parker', 'Feltontown', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(85, 'Colten', 'Bartoletti', 'Dachhaven', '11', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(86, 'Delphia', 'Spinka', 'Lake Mariela', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(87, 'Freddie', 'Altenwerth', 'South Madilyn', '215', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(88, 'Shanny', 'Fisher', 'West Kasandra', '569', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(89, 'Mozelle', 'DuBuque', 'South Ozellaport', '58', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(90, 'Zachariah', 'Tremblay', 'Rolfsonhaven', '63', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(91, 'Gabe', 'Watsica', 'Buddytown', '6346817344', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(92, 'Creola', 'Howell', 'Hettiestad', '776', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(93, 'Lavada', 'Fritsch', 'North Camrenfurt', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(94, 'Lance', 'Sanford', 'Lexiborough', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(95, 'Morris', 'Howe', 'VonRuedentown', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(96, 'John', 'McKenzie', 'Vinceshire', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(97, 'Gerald', 'Durgan', 'North Angelomouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(98, 'Louie', 'Cartwright', 'Hamillview', '748', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(99, 'Yasmine', 'Medhurst', 'Port Hayley', '543', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(100, 'Wilfrid', 'Christiansen', 'North Anabellemouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(101, 'Florian', 'Reilly', 'Mckenzieport', '453', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(102, 'Laron', 'DuBuque', 'Port Rahsaanside', '842', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(103, 'Johnpaul', 'Frami', 'Michealside', '434', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(104, 'Maureen', 'Wolf', 'Nikolausstad', '132', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(105, 'Marguerite', 'Lindgren', 'Rosenbaumbury', '312', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(106, 'Marianna', 'Orn', 'Kameronburgh', '472', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(107, 'Lavonne', 'Strosin', 'Tomasahaven', '18', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(108, 'Nelson', 'Bayer', 'Janickton', '543', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(109, 'Okey', 'Ryan', 'New Margaret', '2437847341', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(110, 'Giovanna', 'Gorczany', 'Lake Shayleeville', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(111, 'Pauline', 'Streich', 'Bettiefurt', '35', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(112, 'Wyatt', 'Smith', 'Nakiastad', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(113, 'Flossie', 'Barton', 'Mohrfort', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(114, 'Merlin', 'Schulist', 'New Chris', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(115, 'Kristin', 'Heller', 'Eldridgeville', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(116, 'Juliet', 'Oberbrunner', 'South Elinor', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(117, 'Chadrick', 'Hahn', 'New Connor', '7238792516', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(118, 'Stephen', 'Kovacek', 'North Wilhelmstad', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(119, 'Nora', 'Homenick', 'Port Guillermochester', '210', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(120, 'Fiona', 'Mann', 'Cartwrighttown', '682', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(121, 'Erika', 'Schuppe', 'Port Arvelshire', '289', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(122, 'Maya', 'Turcotte', 'Jackhaven', '48', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(123, 'Layla', 'Nader', 'South Beulahfurt', '7832271322', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(124, 'Terrence', 'Douglas', 'Kshlerinhaven', '150', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(125, 'Louie', 'Kihn', 'Hauckchester', '560', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(126, 'Alvena', 'Harvey', 'West Frederique', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(127, 'Keith', 'Keeling', 'New Wilfrid', '70', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(128, 'Hal', 'Rempel', 'North Shayne', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(129, 'Lavada', 'Nitzsche', 'Roobmouth', '658', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(130, 'Jamaal', 'Hilll', 'Danielport', '310', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(131, 'Lavon', 'Davis', 'Rebeccabury', '78', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(132, 'Queen', 'Daniel', 'Ephraimville', '5386020763', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(133, 'Jeremy', 'Runte', 'North Beau', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(134, 'Ned', 'O\'Hara', 'East Icieburgh', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(135, 'Rene', 'Smith', 'Avistown', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(136, 'Kendrick', 'Tremblay', 'Adolphport', '126', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(137, 'Jeffry', 'Zulauf', 'Turcottestad', '65', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(138, 'Laurel', 'Swaniawski', 'Fanniestad', '540', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(139, 'Kassandra', 'Torp', 'Lake Rogersland', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(140, 'Nicolas', 'Pagac', 'North Aydenhaven', '64', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(141, 'Demond', 'Leffler', 'North Alysonfurt', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(142, 'Janice', 'Prohaska', 'New Lonieside', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(143, 'Angela', 'King', 'Lake Leraport', '80', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(144, 'Carmel', 'Mueller', 'West Alanaside', '8432108170', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(145, 'Kayli', 'Hahn', 'East Guido', '698', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(146, 'Carleton', 'Wiegand', 'New Groverside', '55', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(147, 'Dedric', 'Huels', 'Port Shermantown', '9531817058', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(148, 'Jessika', 'Hagenes', 'New Nikolas', '9', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(149, 'Evan', 'Gleason', 'Lake Aidan', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(150, 'Kyle', 'Mante', 'Hintzhaven', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(151, 'Efren', 'Flatley', 'Conniemouth', '669', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(152, 'Corene', 'Sauer', 'Donavontown', '645', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(153, 'Junius', 'Schinner', 'Bauchborough', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(154, 'Shayna', 'Wisoky', 'Reeseview', '604', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(155, 'Celestino', 'Franecki', 'Balistreriville', '55', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(156, 'Angie', 'Heidenreich', 'Earlinebury', '336', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(157, 'Sydnee', 'Bednar', 'Francescoport', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(158, 'Lilian', 'Bednar', 'Aidafort', '243', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(159, 'Casandra', 'Strosin', 'Martabury', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(160, 'Winston', 'Spinka', 'South Kian', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(161, 'Cornell', 'Rowe', 'Quitzonberg', '920', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(162, 'Dino', 'Swift', 'New Eula', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(163, 'Zakary', 'Cormier', 'East Arianna', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(164, 'Aileen', 'Lowe', 'D\'angelohaven', '616', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(165, 'Ezekiel', 'Gottlieb', 'O\'Connershire', '403', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(166, 'Hilma', 'Gerlach', 'Carrollview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(167, 'Geoffrey', 'Rutherford', 'East Lamont', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(168, 'Harmon', 'Wiza', 'Port Ralphhaven', '71', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(169, 'Kamille', 'Johnston', 'Gregorymouth', '427', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(170, 'Daron', 'Hintz', 'North Linnie', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(171, 'Eileen', 'Tremblay', 'Dachton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(172, 'Margret', 'Block', 'East Giovanniport', '13', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(173, 'Kendra', 'Grant', 'New Fay', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(174, 'Rene', 'Botsford', 'Abshireshire', '311', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(175, 'Agustin', 'Steuber', 'Klingchester', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(176, 'Norval', 'Swaniawski', 'Flatleybury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(177, 'Gladyce', 'Aufderhar', 'Jenkinsburgh', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(178, 'Adela', 'Kessler', 'North Davonte', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(179, 'Jarvis', 'Terry', 'Bustershire', '685', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(180, 'Mackenzie', 'Torphy', 'Port Jaydonside', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(181, 'Lela', 'Erdman', 'Lake Richmondfort', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(182, 'Stephen', 'Fahey', 'West Ceciliabury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(183, 'Mckenzie', 'Price', 'West Careyberg', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(184, 'Verner', 'Roob', 'North Cleomouth', '642', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(185, 'Ole', 'Douglas', 'Kennedyville', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(186, 'Layla', 'Bosco', 'Kirlinview', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(187, 'Annabell', 'White', 'South Angietown', '502', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(188, 'Tommie', 'Beier', 'Vanessabury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(189, 'Erwin', 'O\'Keefe', 'Shaniyaport', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(190, 'Ashley', 'Bergnaum', 'West Dave', '781', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(191, 'Lincoln', 'Zboncak', 'Port Frances', '610', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(192, 'Jazlyn', 'Hauck', 'Dovieburgh', '958', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(193, 'Brianne', 'Hilll', 'Isabelleland', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(194, 'Nettie', 'Turner', 'Blickmouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(195, 'Eden', 'Feil', 'Port Rosalindaberg', '591', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(196, 'Katlyn', 'Kirlin', 'Parisianland', '454', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(197, 'Korey', 'Schinner', 'Lake Leopold', '240', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(198, 'Holden', 'Stokes', 'Port Diegoton', '9557535386', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(199, 'Berniece', 'Kohler', 'Keeblermouth', '40', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(200, 'Sim', 'Murray', 'Dickinsonfurt', '985', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(201, 'Oswald', 'Koss', 'Keeleyside', '6029218086', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(202, 'Norene', 'Hackett', 'Jevonchester', '503', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(203, 'Vince', 'Grimes', 'North Braxtonburgh', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(204, 'Karley', 'Kuhlman', 'Geovanniland', '932', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(205, 'Miller', 'Fadel', 'South Martyburgh', '587', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(206, 'Juliana', 'Blanda', 'Immanuelbury', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(207, 'Mavis', 'Rutherford', 'East Elianefort', '7927247484', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(208, 'Janiya', 'Rempel', 'East Carminebury', '620', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(209, 'Eden', 'Mitchell', 'Lethaton', '7720899749', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(210, 'Khalil', 'Brakus', 'Binsfort', '4', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(211, 'Cordia', 'West', 'Gunnarfurt', '873', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(212, 'Lupe', 'Kub', 'Rolfsonchester', '831', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(213, 'Enid', 'Anderson', 'Gerholdtown', '436', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(214, 'Isai', 'O\'Conner', 'Laceyside', '216972691', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(215, 'Catalina', 'Adams', 'Port Emelyborough', '828', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(216, 'Bianka', 'Considine', 'Schuppeview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(217, 'Golda', 'Lindgren', 'Reaganville', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(218, 'Elbert', 'Berge', 'South Jaylen', '806', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(219, 'Adell', 'Bernier', 'Kamrenport', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(220, 'Laura', 'Gusikowski', 'Powlowskifort', '628', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(221, 'Chance', 'Homenick', 'Runolfsdottirport', '774', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(222, 'Marshall', 'Kautzer', 'Roxaneborough', '49', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(223, 'Judah', 'Carroll', 'Damienmouth', '33', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(224, 'Lea', 'Jast', 'Jeffryshire', '308', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(225, 'Lambert', 'Luettgen', 'Julioville', '5966393317', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(226, 'Brock', 'Franecki', 'Karliport', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(227, 'Enos', 'Predovic', 'East Zaria', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(228, 'Stanford', 'Parisian', 'Walkerfurt', '148', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(229, 'Gaylord', 'Conn', 'Alexandrineside', '208', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(230, 'Sabryna', 'McLaughlin', 'Beerton', '955', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(231, 'Genoveva', 'Grant', 'Lake Aricmouth', '8416320054', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(232, 'Vito', 'Osinski', 'Pouroschester', '858', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(233, 'Dora', 'Bergstrom', 'Sporerbury', '9138191183', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(234, 'Collin', 'Ullrich', 'Christineview', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(235, 'Roxanne', 'Bergstrom', 'Mrazbury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(236, 'Leatha', 'Schneider', 'Reyesmouth', '332', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(237, 'Susanna', 'Hoeger', 'North Agustina', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(238, 'Vidal', 'Johnson', 'Port Kennyside', '661', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(239, 'Steve', 'Kuphal', 'North Katherineland', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(240, 'Trevor', 'Hagenes', 'New Curtchester', '488', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(241, 'Brittany', 'Feil', 'New Aliza', '761', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(242, 'Roslyn', 'Hilll', 'Ebertborough', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(243, 'Hettie', 'Heaney', 'Vergieshire', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(244, 'Noble', 'Keebler', 'East Edwinaville', '144', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(245, 'Selina', 'Wintheiser', 'Jayceville', '905', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(246, 'Kariane', 'Schowalter', 'Port Sandrinemouth', '779', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(247, 'Jarrod', 'Roberts', 'Langworthbury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(248, 'Kieran', 'Durgan', 'Port Evefurt', '3900115135', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(249, 'Nels', 'Cremin', 'Angeloport', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(250, 'Lori', 'Denesik', 'North Casandrabury', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(251, 'Paxton', 'Bruen', 'South Aricfurt', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(252, 'Forest', 'O\'Reilly', 'Lake Marieton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(253, 'General', 'Schaefer', 'North Carloview', '45', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(254, 'Jeromy', 'Lowe', 'West Cordiaburgh', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(255, 'Otis', 'Quigley', 'Trevionton', '563', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(256, 'Colin', 'Conn', 'Bechtelartown', '14450442', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(257, 'Marcia', 'Hessel', 'East Cortez', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(258, 'Janie', 'Goldner', 'North Shaniyaport', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(259, 'Bradly', 'Langosh', 'Alexzanderstad', '8829689085', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(260, 'Nova', 'Hagenes', 'North Jeremiestad', '671', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(261, 'Margot', 'Cronin', 'South Karsonborough', '478', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(262, 'Zackery', 'Jakubowski', 'North Edmond', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(263, 'Helene', 'Cartwright', 'Balistreriview', '63', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(264, 'Rose', 'Konopelski', 'Lake Hermannview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(265, 'Nedra', 'Nicolas', 'South Reanna', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(266, 'Rico', 'Willms', 'Cronaborough', '2795318709', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(267, 'Ryleigh', 'Mueller', 'Loystad', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(268, 'Mittie', 'Wisozk', 'North Dasia', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(269, 'Penelope', 'Schmidt', 'New Damarischester', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(270, 'Rhett', 'Watsica', 'Elenorafurt', '274', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(271, 'Retha', 'Murazik', 'Bartolettifort', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(272, 'Mavis', 'Runte', 'North Rosalindtown', '3645561156', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(273, 'Fanny', 'Blanda', 'Lucioberg', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(274, 'Fae', 'Dickinson', 'Raemouth', '552', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(275, 'Donavon', 'Krajcik', 'West Lucio', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(276, 'Dawson', 'Bins', 'Port Creola', '4915506', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(277, 'Arlie', 'Dickens', 'Wisokyhaven', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(278, 'Luciano', 'Koelpin', 'North Julietville', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(279, 'Naomie', 'O\'Conner', 'Guadalupeside', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(280, 'Lexi', 'Volkman', 'New Leomouth', '954', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(281, 'Josefa', 'Considine', 'East Barrett', '67', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(282, 'Lisa', 'Muller', 'Wisozkmouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(283, 'Tanya', 'Paucek', 'O\'Konside', '485', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(284, 'Libby', 'Johns', 'Port Vivianneshire', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(285, 'Caden', 'Vandervort', 'South Dillonborough', '1972685085', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(286, 'Bell', 'Koepp', 'Shannashire', '679', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(287, 'Elissa', 'Hoeger', 'Wilfredoland', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(288, 'Jody', 'Senger', 'Reichelmouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(289, 'Gardner', 'Pfannerstill', 'New Mitchellfort', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(290, 'Alfred', 'Howe', 'West Penelopemouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(291, 'Easter', 'Wehner', 'North Lisandrostad', '855', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(292, 'Dale', 'Pfeffer', 'Garnettville', '671', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(293, 'Mossie', 'Von', 'Darleneton', '176', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(294, 'Noemie', 'Bins', 'North Hardymouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(295, 'Rossie', 'Purdy', 'Spinkaland', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(296, 'Earlene', 'Connelly', 'East Jaredbury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(297, 'Annamae', 'Boyle', 'Kertzmannborough', '26', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(298, 'Jeremy', 'O\'Kon', 'West Jasper', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(299, 'Tre', 'Kris', 'Corenestad', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(300, 'Amiya', 'Paucek', 'East Keshaunview', '35', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(301, 'Deon', 'Jacobson', 'West Axel', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(302, 'Carol', 'Borer', 'Feeneytown', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(303, 'Rae', 'Harris', 'New Katlynnside', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(304, 'Stephanie', 'Koch', 'East Bonitaton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(305, 'Marjory', 'Wyman', 'Emilville', '538', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(306, 'Ronaldo', 'Larson', 'Dickiland', '454', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(307, 'Ernesto', 'Kuphal', 'North Calista', '326', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(308, 'Caroline', 'Maggio', 'Lake Kailee', '499', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(309, 'Camryn', 'Koepp', 'Lake Audraberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(310, 'Paxton', 'Bauch', 'Trevorstad', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(311, 'Annabelle', 'Wehner', 'East Albert', '947', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(312, 'Henriette', 'Tremblay', 'Margarettebury', '78', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(313, 'Jackeline', 'Rodriguez', 'Schulistton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(314, 'Gene', 'Bosco', 'New Lorna', '3', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(315, 'Makayla', 'Kemmer', 'North Kyliestad', '79', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(316, 'Earlene', 'Runolfsson', 'Sincereville', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(317, 'Jairo', 'Bins', 'South Giovannyland', '116', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(318, 'Sabina', 'Stehr', 'New Rossiebury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(319, 'Matt', 'Heller', 'Alberthahaven', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(320, 'Gonzalo', 'Schuppe', 'Lake Cara', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(321, 'Kristy', 'Considine', 'D\'Amoreport', '898', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(322, 'Evalyn', 'Kemmer', 'East Melisaside', '89', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(323, 'Stefan', 'Ferry', 'Desmondburgh', '16', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(324, 'Moriah', 'Ondricka', 'Lake Janis', '742', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(325, 'Rex', 'Aufderhar', 'Wilmermouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(326, 'Stewart', 'Ryan', 'Amparochester', '96', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(327, 'Mireya', 'Jerde', 'Hoegerville', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(328, 'Osvaldo', 'Ruecker', 'Stantonshire', '203', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(329, 'Bernita', 'Gutkowski', 'North Shanelleside', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(330, 'Kaleb', 'Price', 'Lake Dejuan', '409', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(331, 'Effie', 'Turcotte', 'Port Malindaport', '7835491309', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(332, 'Zion', 'Jerde', 'Runolfsdottirville', '898', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(333, 'Mortimer', 'Herman', 'New Britneyfort', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(334, 'Arely', 'Jakubowski', 'Ashtyntown', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(335, 'Evalyn', 'Rau', 'Mohrbury', '865', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(336, 'Leanne', 'Ziemann', 'Bethanyland', '3206145488', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(337, 'Monica', 'Connelly', 'Smithamland', '41', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(338, 'Edmund', 'Windler', 'East Bennett', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(339, 'Shanelle', 'Koepp', 'Justineside', '249216478', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(340, 'Alphonso', 'Feeney', 'Haskellburgh', '28', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(341, 'Cecil', 'Sanford', 'Legroschester', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(342, 'Kattie', 'Murphy', 'West Alba', '604', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(343, 'Hudson', 'Kunze', 'West Pamelaport', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(344, 'Hassan', 'Predovic', 'South Donatoland', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(345, 'Amely', 'Mueller', 'Princehaven', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(346, 'Kiel', 'Parisian', 'Goldnerville', '730', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(347, 'Norris', 'Satterfield', 'Ansleyside', '569', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(348, 'Wilhelmine', 'Haag', 'Lake Keithborough', '478', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(349, 'Tyson', 'Grady', 'Pacochaside', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(350, 'Trycia', 'Grady', 'Richardview', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(351, 'Felipa', 'Littel', 'Parisianchester', '8375627673', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(352, 'Valentin', 'Bosco', 'Maeside', '552', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(353, 'Glen', 'Schumm', 'Howellburgh', '480', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(354, 'Tyson', 'Huel', 'Corkerystad', '476', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(355, 'Josefa', 'Gorczany', 'Whitemouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(356, 'Christopher', 'Halvorson', 'East Otis', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(357, 'Margarita', 'Bruen', 'Freddiehaven', '850', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(358, 'Arely', 'Dickens', 'Lake Nataliechester', '317', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(359, 'Paolo', 'Batz', 'Ziemefort', '838', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(360, 'Avery', 'Murazik', 'Cornellhaven', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(361, 'Mireille', 'Donnelly', 'North Neoma', '5409588079', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(362, 'Delfina', 'Halvorson', 'Harveyhaven', '12', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(363, 'Nora', 'Lockman', 'Coltborough', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(364, 'Lily', 'Russel', 'Lazarobury', '695', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(365, 'Anika', 'Zemlak', 'Gusberg', '89', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(366, 'Amina', 'Paucek', 'Beattyfort', '54', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(367, 'Lula', 'Roberts', 'North Natalia', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(368, 'Ryan', 'Emard', 'Reginaldstad', '547', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(369, 'Howell', 'Wunsch', 'Miltonfort', '22', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(370, 'Asa', 'Medhurst', 'Eviestad', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(371, 'Santa', 'Raynor', 'East Lisandro', '120', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(372, 'Josefina', 'Stiedemann', 'Mandyshire', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(373, 'Cecilia', 'Friesen', 'Willmsstad', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(374, 'Audra', 'Buckridge', 'Marciashire', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(375, 'Parker', 'Boehm', 'New Nia', '92', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(376, 'Destiny', 'Dickinson', 'Dannyside', '866', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(377, 'Raven', 'Hermann', 'Hagenesstad', '792', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(378, 'Rylan', 'Daugherty', 'Wunschburgh', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(379, 'Oswaldo', 'Berge', 'East Lourdeshaven', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(380, 'Keven', 'Ruecker', 'Wisozkberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(381, 'Xander', 'Kulas', 'Starkmouth', '23', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(382, 'Jade', 'Frami', 'Madonnafurt', '83', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(383, 'Nathanial', 'Fay', 'East Nora', '141', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(384, 'Jordyn', 'Thompson', 'North Estrellaview', '22', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(385, 'Emilia', 'Swift', 'Tracechester', '948016578', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(386, 'Lily', 'Friesen', 'Weberhaven', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(387, 'Zelma', 'Reichert', 'Marksmouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(388, 'Danny', 'Wilderman', 'Zarialand', '7344503200', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(389, 'Birdie', 'Doyle', 'Lake Braxtonton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(390, 'Angelita', 'Metz', 'West Maudstad', '408', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(391, 'Issac', 'Raynor', 'South Katheryn', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(392, 'Petra', 'Hilll', 'Aurelieview', '401', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(393, 'Larry', 'Funk', 'Port Blaise', '805', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(394, 'August', 'Gibson', 'North Bradley', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(395, 'Cristobal', 'Olson', 'New Hazelview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(396, 'Rachael', 'Trantow', 'Fayfurt', '367', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(397, 'Emile', 'Dietrich', 'South Mozellton', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(398, 'Afton', 'Shanahan', 'Lake Vaughn', '729', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(399, 'Oscar', 'Pagac', 'Naomieland', '235', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(400, 'Skye', 'Cruickshank', 'Graysonbury', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(401, 'Nels', 'Effertz', 'Efrainburgh', '353', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(402, 'Aimee', 'Predovic', 'West Dayna', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(403, 'Andy', 'Schulist', 'East Myraside', '643', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(404, 'Lesly', 'Abernathy', 'Corkerystad', '738', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(405, 'Madyson', 'Bechtelar', 'Port Reid', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(406, 'Russ', 'Waters', 'Kadinchester', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(407, 'Leonel', 'Nolan', 'Port Travistown', '185', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(408, 'Rosario', 'Russel', 'South Haleyport', '6', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(409, 'Donnell', 'Will', 'South Eladio', '196', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(410, 'Tristin', 'Padberg', 'West Harmon', '886', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(411, 'Claire', 'Blanda', 'Alexandremouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(412, 'Ike', 'Wiza', 'North Arleneton', '589', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(413, 'Cordia', 'Lehner', 'West Noemy', '619', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(414, 'Jody', 'Homenick', 'Lake Parkermouth', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(415, 'Alexander', 'Wuckert', 'Ornchester', '7025895283', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(416, 'Casper', 'Kohler', 'South Sean', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(417, 'Carolanne', 'Grady', 'New Andrehaven', '532', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(418, 'Vivianne', 'Jacobi', 'West Walterberg', '695', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(419, 'Aliza', 'Moore', 'Port Devenfort', '994', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(420, 'Jace', 'Keebler', 'North Rosalee', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(421, 'Cassie', 'Kuphal', 'New Ellis', '7787439124', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(422, 'Antonio', 'O\'Hara', 'New Cassietown', '599', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(423, 'Kaylie', 'Zemlak', 'Keanuburgh', '34', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(424, 'Isobel', 'Kerluke', 'West Hertha', '399', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(425, 'Adolf', 'Lubowitz', 'Wilmerfurt', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(426, 'Gillian', 'Haley', 'Lake Alexandria', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(427, 'Viviane', 'Kling', 'Port Winston', '5860479951', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(428, 'Felicia', 'Grimes', 'Devenmouth', '18', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(429, 'Nicolas', 'Grant', 'Pacochahaven', '46', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(430, 'Bernard', 'Schroeder', 'East Liana', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(431, 'Summer', 'Schowalter', 'Volkmanland', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(432, 'Misael', 'Wiegand', 'Port Helenbury', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(433, 'Jacynthe', 'Sporer', 'Daynetown', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(434, 'Luis', 'Gleichner', 'McClurechester', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(435, 'Filomena', 'Jacobi', 'East Jermaine', '281', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(436, 'Bertram', 'Reilly', 'Lake Leannaland', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(437, 'Eulah', 'Cruickshank', 'Annamaeview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(438, 'Aubree', 'Parker', 'New Elwin', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(439, 'Keegan', 'Howell', 'Lake Kaleb', '396967086', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(440, 'Kayden', 'Leannon', 'New Alysonbury', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(441, 'Dorothy', 'Hettinger', 'New Roma', '980', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(442, 'Linnie', 'Simonis', 'New Maxwell', '5406043751', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(443, 'Charity', 'Flatley', 'North Stewart', '936', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(444, 'Queen', 'Bogan', 'South Amoshaven', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(445, 'Ophelia', 'Eichmann', 'Wilkinsonbury', '19', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(446, 'Vicente', 'Dietrich', 'South Buddy', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(447, 'Talon', 'Simonis', 'McLaughlinside', '754', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(448, 'Nelle', 'Mills', 'Everettebury', '950', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(449, 'Alexander', 'Cruickshank', 'Vidalview', '9363194125', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(450, 'Odell', 'Robel', 'Port Odie', '1895630791', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(451, 'Judd', 'Kunze', 'South Enidberg', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(452, 'Jimmy', 'Davis', 'Madiefort', '451', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(453, 'Lottie', 'Cronin', 'East D\'angelo', '585', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(454, 'Tessie', 'Zieme', 'Kellihaven', '348', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(455, 'Earlene', 'Crist', 'Lake Imeldaport', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(456, 'Wendell', 'Pollich', 'West Leanna', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(457, 'Matilda', 'Quigley', 'Port Jada', '95', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(458, 'Yvonne', 'Hauck', 'Sengerhaven', '875', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(459, 'Cielo', 'Howell', 'North Stefanfurt', '6813014969', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(460, 'Emmie', 'Daugherty', 'New Kacishire', '940', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(461, 'Amie', 'Willms', 'North Melody', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(462, 'Holly', 'Bernhard', 'Lake Payton', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(463, 'Mercedes', 'Rogahn', 'Port Julietmouth', '739', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(464, 'Lizzie', 'Glover', 'Todmouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(465, 'Felicity', 'Russel', 'New Cora', '7996217600', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(466, 'Bernhard', 'Hammes', 'O\'Connellborough', '855459722', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(467, 'Otha', 'Mohr', 'Schusterbury', '3390623593', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(468, 'Nikolas', 'Frami', 'Estellport', '491275028', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(469, 'Noemi', 'Cole', 'Janisbury', '154449768', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(470, 'Collin', 'Runolfsson', 'South Jimmyberg', '4801870344', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(471, 'Ruby', 'Eichmann', 'Frankberg', '8196468537', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(472, 'Rosina', 'Rosenbaum', 'Elenorbury', '182445129', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(473, 'Devon', 'Jones', 'Port Coleman', '2851433692', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(474, 'Jeff', 'Schinner', 'Aufderharville', '375916373', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(475, 'Kay', 'Anderson', 'Buckmouth', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(476, 'Jackie', 'Stracke', 'Kubland', '894', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(477, 'Nicholas', 'Breitenberg', 'West Loraine', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(478, 'Flavie', 'Parisian', 'Karenberg', '754', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(479, 'Jason', 'Kuphal', 'North Samirburgh', '729', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(480, 'Abigale', 'Rippin', 'Lake Florence', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(481, 'Paula', 'Russel', 'Ryanhaven', '91', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(482, 'Daisy', 'Boyle', 'New Cristianside', '357', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(483, 'Frank', 'Hessel', 'Catalinaview', '687', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(484, 'Odie', 'Gislason', 'Botsfordside', '214', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(485, 'Emerson', 'Mosciski', 'North Ethelynmouth', '7913511057', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(486, 'Maxine', 'Gleichner', 'East Leonemouth', '25', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(487, 'Cory', 'Ward', '<div>West Audras</div>', '146412243', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(488, 'Kyra', 'Ledner', 'South Jarret', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(489, 'Anastacio', 'Powlowski', 'South Ross', '0', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(490, 'Wilton', 'Fisher', 'Cristside', '658', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(491, 'Shyann', 'Huels', 'South Katherine', '487', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(492, 'Dalton', 'Macejkovic', 'East Stevie', '3964124906', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(493, 'Karina', 'Paucek', 'East Anaview', '1', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(494, 'Napoleon', 'Reichel', 'Quigleyberg', '1262615781', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(495, 'Asha', 'Heathcote', 'North Amberfurt', '23456789', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(496, 'Sherman', 'O\'Keefe', 'West Emieview', '7151196087', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(497, 'Rosella', 'Gerlach', 'Trudieborough', '6196082181', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(498, 'Alayna', 'Bednar', 'New Roslyntown', '9101908169', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(499, 'Jazmin', 'Schinner', 'Lake Jacynthe', '153855476', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(500, 'Mario', 'Kemmer', 'North Dejonside', '7377661219', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(501, 'Rizki', 'Kosasih', '<div>Jakarta Pusat</div>', '876543210', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(502, 'Asd', 'Asd', 'Testereqwasd', '8123123', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(506, 'Teset', 'Tester', 'Teset', '8123213', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(507, 'Test', 'Asdwq', 'Qweqw', '678', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(508, 'Tesasdyfayf', 'Fwtaftf', 'Ttywfqyfyfqw', '8165752', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(509, 'Ahdhaskh', 'Asdhkjah', 'Asjdhajsh', '8901728618', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(521, 'Asdasd23', 'Asdasdasasd', '<div>asasda</div>', '123456789012', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(522, '123', '12312', '<div>asdasdasczx</div>', '12312444345', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(525, 'Asdasdasd', 'Asdasdas', '<div>sdsasdasd<strong>asdasdasdas</strong>asdasa</div>', '1231231231', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(524, 'Test', 'Test', '<div>test123</div>', '1234567890', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(526, 'ASaadas', 'Sdada', '<div>dasdassdas</div>', '1231231', 1, 0, '2022-08-30 09:21:33', '2022-10-17 10:20:39'),
	(528, 'Test', 'Test', '<div>jhajhsdj</div>', '123121321321', 1, 0, '2022-08-31 14:10:56', '2022-10-17 10:20:39'),
	(529, 'Test', 'Test', '<div>asdas</div>', '1234', 1, 0, '2022-08-31 14:19:12', '2022-10-17 10:22:48'),
	(530, 'Kjhaksd', 'Hjhskdhj', '<div>ashdiuhashduinkansjdnaksndjnajksndasnnal</div>', '2345678', 1, 0, '2022-08-31 14:22:26', '2022-10-17 10:20:39'),
	(531, 'Bhashgyg', 'Ashhihi', '<div>aishwkwkwkwkwk</div>', '081234567897', 1, 0, '2022-09-13 17:39:09', '2022-10-17 10:20:39'),
	(532, 'Test', 'Test', '<div>test</div>', '123456789009', 1, 1, '2022-09-13 17:40:47', '2022-10-17 10:20:39'),
	(533, 'Testtttt', 'Testttt', '<div>testttttttt</div>', '123456789012', 1, 0, '2022-09-13 17:41:22', '2022-10-17 10:20:39'),
	(534, 'Tert', 'Wqeqw', '<div>qweqweqw</div>', '12312312312', 1, 0, '2022-12-02 08:53:20', '2022-12-02 07:53:20'),
	(535, 'Ijal', 'Lodan', '<div>lodans</div>', '12345', 1, 0, '2022-12-02 08:53:39', '2022-12-02 08:39:22');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;

-- Dumping structure for table wedding.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL DEFAULT '0',
  `name` tinytext NOT NULL,
  `amount` int NOT NULL DEFAULT '0',
  `confirmation` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.reservation: 0 rows
DELETE FROM `reservation`;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Dumping structure for table wedding.role_event
CREATE TABLE IF NOT EXISTS `role_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.role_event: 1 rows
DELETE FROM `role_event`;
/*!40000 ALTER TABLE `role_event` DISABLE KEYS */;
INSERT INTO `role_event` (`id`, `event_id`, `user_id`) VALUES
	(1, 1, 4);
/*!40000 ALTER TABLE `role_event` ENABLE KEYS */;

-- Dumping structure for table wedding.statis_template
CREATE TABLE IF NOT EXISTS `statis_template` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL DEFAULT '0',
  `title` tinytext NOT NULL,
  `content` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `search_key` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.statis_template: 0 rows
DELETE FROM `statis_template`;
/*!40000 ALTER TABLE `statis_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `statis_template` ENABLE KEYS */;

-- Dumping structure for table wedding.undangan_terkirim
CREATE TABLE IF NOT EXISTS `undangan_terkirim` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL DEFAULT '0',
  `name` tinytext NOT NULL,
  `phone` varchar(15) NOT NULL,
  `sent` int NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table wedding.undangan_terkirim: ~0 rows (approximately)
DELETE FROM `undangan_terkirim`;
INSERT INTO `undangan_terkirim` (`id`, `event_id`, `name`, `phone`, `sent`, `date_added`) VALUES
	(1, 1, 'Rizki Kosasih', '6285893146277', 1, '2022-12-25 17:53:56');

-- Dumping structure for table wedding.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `grup_id` int NOT NULL,
  `foto` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(250) NOT NULL,
  `no_hp` varchar(250) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `tema` enum('light-mode','dark-mode') NOT NULL DEFAULT 'light-mode',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` date NOT NULL,
  `token` text NOT NULL,
  `token_id` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table wedding.user: 5 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `grup_id`, `foto`, `nama`, `tempat_lahir`, `tanggal_lahir`, `email`, `no_hp`, `jenis_kelamin`, `alamat`, `tema`, `isActive`, `date_created`, `token`, `token_id`, `last_login`) VALUES
	(1, 'programmer', 'a425352a84b14c7acb601495bd156322', 1, '', 'Programmer', 'Jakarta', '1999-08-04', 'programmer@gmail.com', '081234567890', 'pria', 'Jakarta', 'light-mode', 1, '2021-11-13', '', 0, '0000-00-00 00:00:00'),
	(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, '', 'Web Admins', 'Padang', '1990-02-14', 'admin@rocketmail.com', '081234567890', 'pria', '<div>Jakarta Utara</div>', 'light-mode', 1, '2021-12-15', '', 0, '2022-08-29 09:30:49'),
	(4, 'kosasih', '202cb962ac59075b964b07152d234b70', 1, '73625_profile-img.jpg', 'Rizki Kosasih', 'Bogor', '1997-01-10', 'rizkigames9@gmail.com', '081234567890', 'pria', '<div>Jl. Petojo Utara III No.240</div>', 'dark-mode', 1, '2021-11-26', '', 0, '2022-12-18 09:40:54'),
	(11, 'test', '098f6bcd4621d373cade4e832627b4f6', 2, '', 'Tests', 'Jakarta', '2022-06-18', 'rizkigames39@gmail.com', '081234567890', 'pria', 'Jakarta Pusat', 'light-mode', 1, '2022-06-18', '', 0, '2022-06-29 21:14:23'),
	(12, 'kosasih2', 'e1ec2a6a47ddf42d96c55c4e5bb23760', 3, '', 'Kosasih2', 'Jakarta', '2022-07-18', 'rizkikosasih39@gmail.com', '3123121288', 'pria', 'sadasdasadsd', 'light-mode', 1, '2022-06-21', '', 0, '2022-06-25 14:45:27');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
