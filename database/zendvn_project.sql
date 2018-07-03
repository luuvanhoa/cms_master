-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2018 at 06:07 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zendvn_project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_students` (IN `p_offset` INT, IN `p_limit` INT, IN `p_title` VARCHAR(255) CHARSET utf8, IN `p_email` VARCHAR(255) CHARSET utf8, IN `p_course_id` INT, IN `p_status` INT, OUT `total` INT)  BEGIN 
    
   	SELECT user_id, email, phone, last_login, u1.status, u1.username, u1.fullname, GROUP_CONCAT(course_id, ':', c.name, ':', u.status) as list_courses
	FROM users_courses u
   		INNER JOIN courses c ON u.course_id = c.id
   		INNER JOIN users u1 ON u.user_id = u1.id
    WHERE user_id > 0
     
    GROUP BY user_id 
    LIMIT p_offset, p_limit; 
    
    SELECT COUNT(DISTINCT user_id) INTO total FROM users_courses;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `share_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cate_original` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cate_list` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `page_views` int(11) DEFAULT '0',
  `is_comment` int(11) DEFAULT '0',
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `modified_by` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `author_article`
--

CREATE TABLE `author_article` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `avatar` int(11) DEFAULT NULL,
  `share_url` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_article`
--

CREATE TABLE `category_article` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catecode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_header` int(11) DEFAULT '1',
  `show_frontend_header` int(11) NOT NULL,
  `position_footer` int(11) DEFAULT '1',
  `show_frontend_footer` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `fullcate_parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `level` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_courses`
--

CREATE TABLE `category_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catecode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `show_frontend` int(11) DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `options` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_courses`
--

INSERT INTO `category_courses` (`id`, `name`, `catecode`, `parent_id`, `level`, `ordering`, `show_frontend`, `image`, `status`, `description`, `options`, `meta_description`, `meta_title`, `meta_keyword`, `created_time`, `modified_time`, `created_at`, `updated_at`) VALUES
(1000001, 'Công nghệ thông tin', 'cong-nghe-thong-tin', NULL, 0, 10, 0, NULL, 1, '<p>aaaaaaaaaaaaaaaaaaaaaa</p>', NULL, NULL, NULL, NULL, '2018-06-24 05:59:09', '2018-06-24 11:31:02', '2018-06-23 22:59:09', '2018-06-24 04:31:02'),
(1000003, 'IT software', 'it-software', 1000001, 2, 10, 0, '/img/upload/category/0c9dee602b02122382f9990a782c1c0816ff1966.jpeg', 2, '<p>ssssssssssssssssdđ</p>', NULL, 'hoalv12', 'Vui lòng xác nhận captcha', 'Vui lòng xác nhận captchaư', '2018-06-24 12:21:47', '2018-06-24 13:40:40', '2018-06-24 05:21:47', '2018-06-24 06:40:40'),
(1000004, 'Phụ kiện máy tính1', 'phu-kien-may-tinh1', 0, 0, 10, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2018-06-24 13:44:38', NULL, '2018-06-24 06:44:38', '2018-06-24 06:44:38'),
(1000005, 'Hòa gửi bài thi', 'hoa-gui-bai-thi', 1000004, 2, 10, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2018-06-24 13:45:00', NULL, '2018-06-24 06:45:00', '2018-06-24 06:45:00'),
(1000006, 'hoalv12', 'hoalv12', 1000001, 2, 10, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2018-06-24 13:45:13', NULL, '2018-06-24 06:45:13', '2018-06-24 06:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `share_url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `category_fullparent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catelist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `teacher_id` int(11) DEFAULT '0',
  `price` int(11) DEFAULT '0',
  `price_old` int(11) DEFAULT '0',
  `start_sale` datetime DEFAULT NULL,
  `end_sale` datetime DEFAULT NULL,
  `publish_time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `modified_time` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `share_url`, `images`, `category_id`, `category_fullparent`, `catelist`, `description`, `content`, `teacher_id`, `price`, `price_old`, `start_sale`, `end_sale`, `publish_time`, `status`, `modified_time`, `modified_by`, `create_time`, `create_by`, `meta_keyword`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Lập trình PHP chuyên sâu', 'lap-trinh-php-chuyen-sau', NULL, 1000001, '', '1000001', 'The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.', '<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>\r\n\r\n<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>\r\n\r\n<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>\r\n\r\n<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>\r\n\r\n<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>\r\n\r\n<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>', 0, 500000, 550000, '2018-06-25 19:34:39', '2018-06-25 19:34:39', '2018-06-25 12:35:16', 1, '2018-06-25 12:35:16', NULL, '2018-06-25 00:58:43', NULL, NULL, NULL, NULL, '2018-06-24 17:58:43', '2018-06-25 05:35:16'),
(2, 'Lập trình Phalcon Framework', 'lap-trinh-phalcon-framework', NULL, 1000001, '', '1000001', 'The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.\r\n\r\nSo, adding something like this to your FFmpeg command should work:', '<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>\r\n\r\n<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>\r\n\r\n<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>\r\n\r\n<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>\r\n\r\n<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>\r\n\r\n<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>\r\n\r\n<p>The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</p>\r\n\r\n<p>So, adding something like this to your FFmpeg command should work:</p>', 1000001, 1500000, 1700000, '2018-06-25 19:34:39', '2018-06-25 19:34:39', '2018-06-27 21:21:54', 1, NULL, NULL, '2018-06-27 14:22:35', NULL, 'Vui lòng xác nhận captcha', 'Vui lòng xác nhận captcha', 'Doanh nhân', '2018-06-27 07:22:35', '2018-06-27 07:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `courses_detail`
--

CREATE TABLE `courses_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `level` int(11) DEFAULT '0',
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_duration` int(11) DEFAULT '0',
  `total_lesson` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_learn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites_courses`
--

CREATE TABLE `favorites_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `modified_time` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_acp` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `created_by` datetime DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `modified_by` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `privilege_id`, `ordering`, `created_by`, `created_time`, `modified_by`, `modified_time`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 1, 10, NULL, '2018-07-01 11:31:01', NULL, '2018-07-01 11:55:14', '2018-07-01 04:31:01', '2018-07-01 04:55:14'),
(2, 'Manager', 1, 2, 10, NULL, '2018-07-01 11:59:26', NULL, '2018-07-01 11:59:52', '2018-07-01 04:59:26', '2018-07-01 04:59:52'),
(3, 'Member', 1, 3, 10, NULL, '2018-07-01 11:59:35', NULL, '2018-07-01 11:59:46', '2018-07-01 04:59:35', '2018-07-01 04:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `menu_admin`
--

CREATE TABLE `menu_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catecode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_time` datetime NOT NULL,
  `modified_time` datetime DEFAULT NULL,
  `fullcate_parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `level` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_06_19_072038_create_group_table', 1),
(4, '2018_06_19_072613_create_options_table', 1),
(5, '2018_06_19_072726_create_articles_table', 1),
(6, '2018_06_19_072735_create_object_article_table', 1),
(7, '2018_06_19_072743_create_category_article_table', 1),
(8, '2018_06_19_072750_create_tag_article_table', 1),
(9, '2018_06_19_072756_create_author_article_table', 1),
(10, '2018_06_19_072943_create_role_table', 1),
(11, '2018_06_19_073013_create_menu_addmin_table', 1),
(12, '2018_06_19_073446_create_privilege_table', 1),
(13, '2018_06_20_160826_create_courses_table', 1),
(14, '2018_06_20_160925_create_courses_detail_table', 1),
(15, '2018_06_20_160936_create_category_courses_table', 1),
(16, '2018_06_20_160949_create_users_courses_table', 1),
(17, '2018_06_20_161000_create_favorites_courses_table', 1),
(18, '2018_06_20_161010_create_rating_courses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `object_article`
--

CREATE TABLE `object_article` (
  `id` int(10) UNSIGNED NOT NULL,
  `object_id` int(11) DEFAULT '0',
  `object_type` int(11) DEFAULT '0',
  `article_id` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_time` datetime NOT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `key_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_options` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_time` datetime NOT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_courses`
--

CREATE TABLE `rating_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `rating_star` int(11) DEFAULT '0',
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `modified_time` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_article`
--

CREATE TABLE `tag_article` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT '0',
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `content` text,
  `info` mediumtext,
  `cmnd` varchar(255) DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `fullname`, `address`, `phone`, `status`, `avatar`, `description`, `content`, `info`, `cmnd`, `created_time`, `created_by`, `modified_time`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'hailan', 'Lưu Trường Hải Lân', '', '01659213296', 1, '/img/upload/teacher/2831e8f9f2e73e8fe26293e6170feb0aa4e72502.jpeg', '<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>\r\n\r\n<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>', NULL, 'Cao to đen hôi', '741852963', '2018-07-02 17:15:29', NULL, '2018-07-02 17:34:07', '', '2018-07-02 10:15:29', '2018-07-02 10:34:08'),
(2, 'hoalv12', 'Lưu Văn Hòa', '', '01659213290', 1, '/img/upload/teacher/4a6f8d09f9b3cd386fd789ee3210835afc0902c9.jpeg', '<p><span style=\"color:rgb(36, 39, 41); font-family:arial,helvetica neue,helvetica,sans-serif; font-size:15px\">The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.The first line of this file states the URI for the key, which is written into the HLS playlist. The second line of the file points to the key file (may be local or http) against which the media will be encrypted.</span></p>', NULL, 'Cao to đen hôi', '23456789', '2018-07-02 17:34:39', NULL, '2018-07-02 17:42:56', '', '2018-07-02 10:34:39', '2018-07-02 10:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL DEFAULT '1',
  `admin` int(11) NOT NULL DEFAULT '0',
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `token_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `status`, `group_id`, `admin`, `password`, `address`, `phone`, `birthday`, `register_date`, `last_login`, `token_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1000001, 'hoalv123', 'Lưu Văn Hòa', 'admin@gmail.com', 1, 10, 1, '$2y$10$O91T0BpmSBBzLV/K5YyHVO83SqiWXph/xKt5runFpcrbEtJncQcOC', 'adf', '01659213296', '2018-06-21', '2018-06-21 00:00:00', '2018-06-21 00:00:00', NULL, '2018-06-21 09:25:07', '2018-06-24 07:08:13', NULL),
(1000002, 'hoaluu', 'Lưu Hòa', 'luuvanhoa001@gmail.com', 1, 2, 1, '$2y$10$yIc9GLvIdnZiSqDa6wZnu.uXN8shQM9VHlKjir0BAOwNffWV0HIaS', 'adf', '01659213296', '2018-06-24', NULL, '2018-06-21 00:00:00', NULL, '2018-06-23 18:51:04', '2018-07-03 08:10:29', NULL),
(1000003, 'admin1@gmail.com', 'admin1', 'admin1@gmail.com', 1, 1, 1, '$2y$10$bUuYLXCDt6UTAw8LNjEMce1GMPvDua7kT2zthEnEMDLNFzNwgMs/W', NULL, NULL, '1970-01-01', NULL, NULL, NULL, '2018-07-03 07:18:44', '2018-07-03 08:10:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE `users_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `payment` int(11) DEFAULT '0',
  `payment_time` datetime DEFAULT NULL,
  `payment_type` int(11) DEFAULT '0',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_courses`
--

INSERT INTO `users_courses` (`id`, `course_id`, `user_id`, `status`, `payment`, `payment_time`, `payment_type`, `note`, `modified_time`, `modified_by`, `create_time`, `create_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1000002, 1, 1111111, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 1000001, 1, 753951, '2018-06-27 22:04:26', 0, 'nộp bài', NULL, NULL, NULL, NULL, '2018-06-27 08:31:00', '2018-06-27 08:31:00'),
(11, 2, 1000002, 1, 753951, '2018-06-27 22:04:26', 0, 'nộp bài', NULL, NULL, NULL, NULL, '2018-06-27 08:31:00', '2018-06-30 20:02:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_article`
--
ALTER TABLE `author_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_article`
--
ALTER TABLE `category_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_courses`
--
ALTER TABLE `category_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_detail`
--
ALTER TABLE `courses_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites_courses`
--
ALTER TABLE `favorites_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `object_article`
--
ALTER TABLE `object_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_courses`
--
ALTER TABLE `rating_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_article`
--
ALTER TABLE `tag_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_courses`
--
ALTER TABLE `users_courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `author_article`
--
ALTER TABLE `author_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_article`
--
ALTER TABLE `category_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_courses`
--
ALTER TABLE `category_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000007;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses_detail`
--
ALTER TABLE `courses_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites_courses`
--
ALTER TABLE `favorites_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `object_article`
--
ALTER TABLE `object_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_courses`
--
ALTER TABLE `rating_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag_article`
--
ALTER TABLE `tag_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000004;

--
-- AUTO_INCREMENT for table `users_courses`
--
ALTER TABLE `users_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
