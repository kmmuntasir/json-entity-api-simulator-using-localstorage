-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2021 at 03:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `json_simulator`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_icon` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_icon`, `timestamp`, `is_deleted`) VALUES
(1, 'AWS', 'f4aeb7198a52.jpg', '2021-08-21 23:50:00', b'0'),
(2, 'DynamoDB', '638dd4ec7e0d.jpg', '2021-08-21 23:50:07', b'0'),
(3, 'C', 'e980215e3a58.jpg', '2021-08-21 23:50:13', b'0'),
(4, 'C++', 'cf5c89012d3c.jpg', '2021-08-21 23:50:21', b'0'),
(5, 'Codeigniter', 'd9b0a7a471d3.jpg', '2021-08-21 23:50:28', b'0'),
(6, 'Dart', '0c2338dd841b.jpg', '2021-08-21 23:50:35', b'0'),
(7, 'Docker', '1736ae0ac7cd.jpg', '2021-08-21 23:50:44', b'0'),
(8, 'Flutter', 'bb006d40e1e7.jpg', '2021-08-21 23:50:50', b'0'),
(9, 'Github Actions', '44d3bc7287cd.jpg', '2021-08-21 23:51:00', b'0'),
(10, 'HTML/CSS', '787a2ec3617d.jpg', '2021-08-21 23:51:20', b'0'),
(11, 'Java', '184a40142f2b.jpg', '2021-08-21 23:51:27', b'0'),
(12, 'Javascript', '74c40a68899c.jpg', '2021-08-21 23:51:35', b'0'),
(13, 'jQuery', '8bf0152e04af.jpg', '2021-08-22 00:05:12', b'1'),
(14, 'Kubernetes', 'c35e4d5edfb7.jpg', '2021-08-21 23:51:50', b'0'),
(15, 'Mocha-Chai', 'f8a19a53dc11.jpg', '2021-08-21 23:51:59', b'0'),
(16, 'MySQL', '118e74bf114f.jpg', '2021-08-21 23:52:06', b'0'),
(17, 'Node JS', 'a182f296cea5.jpg', '2021-08-21 23:52:15', b'0'),
(18, 'Nuxt JS', '4f2f79747121.jpg', '2021-08-21 23:52:22', b'0'),
(19, 'PHP', '88d42eb3b0c8.jpg', '2021-08-22 00:05:00', b'1'),
(20, 'PostgreSQL', '350d6e2f69b2.jpg', '2021-08-21 23:52:40', b'0'),
(21, 'Redis', 'c2241ac31b7f.jpg', '2021-08-22 00:05:02', b'1'),
(22, 'Shell Script', 'ace217058706.jpg', '2021-08-21 23:53:05', b'0'),
(23, 'Spring Boot', '403c615e1bee.jpg', '2021-08-22 00:05:08', b'1'),
(24, 'Linux', 'd4de0c2dd10b.jpg', '2021-08-22 00:05:20', b'1'),
(25, 'Git', '61f10fb1095f.jpg', '2021-08-21 23:53:39', b'0'),
(26, 'Vue JS', '03d1a4fde9c1.jpg', '2021-08-22 00:05:05', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_subtitle` varchar(255) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `post_content` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL DEFAULT b'0',
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_subtitle`, `post_image`, `post_content`, `timestamp`, `is_deleted`, `subcategory_id`, `category_id`) VALUES
(1, 'Post-AWS', 'Post-AWS Subtitle', '3ff52bc8fbbc.jpg', 'lkjalksflkjaklsdfasdf', '2021-08-21 23:58:08', b'0', 1, 1),
(2, 'Post-DynamoDB', 'Post-DynamoDB Subtitle', 'cb9ad6f15423.jpg', 'lkjlajsdklfasdf', '2021-08-21 23:58:28', b'0', 1, 1),
(3, 'Post-C', 'Post-C Subtitle', '8c68e9ab252a.jpg', 'asdfasfasdf', '2021-08-21 23:58:40', b'0', 1, 1),
(4, 'Post-C++', 'Post-C++ Subtitle', 'a2163bb04190.jpg', 'asdfasdsadf', '2021-08-21 23:58:53', b'0', 1, 1),
(5, 'Post-Codeigniter', 'Post-Codeigniter Subtitle', '92510416a576.jpg', 'asdfasdfasdf', '2021-08-21 23:59:07', b'0', 1, 1),
(6, 'Post-Dart', 'Post-Dart Subtitle', '6b7ea389b3e7.jpg', 'asdfasdfasdaassdf', '2021-08-21 23:59:22', b'0', 1, 1),
(7, 'Post-Docker', 'Post-Docker Subtitle', '67c4cc24d365.jpg', 'asdfaassddf', '2021-08-21 23:59:36', b'0', 1, 1),
(8, 'Post-Flutter', 'Post-Flutter Subtitle', 'e87020cf2294.jpg', 'asdfassdf', '2021-08-21 23:59:49', b'0', 1, 1),
(9, 'Post-GitActions', 'Post-GitActions Subtitle', '514702d74b05.jpg', 'lkjasdf', '2021-08-22 00:00:07', b'0', 1, 1),
(10, 'Post-HTML/CSS', 'Post-HTML/CSS Subtitle', 'f820d753e1c9.jpg', 'asdfasasdfsssdf', '2021-08-22 00:00:25', b'0', 1, 1),
(11, 'Post-Java', 'Post-Java Subtitle', 'c1db2ef11e78.jpg', 'asdssdf', '2021-08-22 00:00:38', b'0', 1, 1),
(12, 'Post-Javascript', 'Post-Javascript Subtitle', 'b70167502f4f.jpg', 'asssdf', '2021-08-22 00:00:55', b'0', 1, 1),
(13, 'Post-jQuery', 'Post-jQuery Subtitle', '973ffe9fa98a.jpg', 'aasdfggasdf', '2021-08-22 00:01:08', b'0', 1, 1),
(14, 'Post-Kubernetes', 'Post-Kubernetes Subtitle', '1be822b9d264.jpg', 'assdfd', '2021-08-22 00:04:46', b'1', 1, 1),
(15, 'Post-Mocha-Chai', 'Post-Mocha-Chai Subtitle', '4c6735ef7f2b.jpg', 'assdfdf', '2021-08-22 00:01:39', b'0', 1, 1),
(16, 'Post-MySQL', 'Post-MySQL Subtitle', 'cfafe1242674.jpg', 'asfsdf', '2021-08-22 00:02:00', b'0', 1, 1),
(17, 'Post-NodeJS', 'Post-NodeJS Subtitle', 'b41c88411718.jpg', 'assdfdf', '2021-08-22 00:04:44', b'1', 1, 1),
(18, 'Post-NuxtJS', 'Post-NuxtJS Subtitle', 'be0ed4a5efa9.jpg', 'assdfdf', '2021-08-22 00:02:28', b'0', 1, 1),
(19, 'Post-PHP', 'Post-PHP Subtitle', 'f91b197e802e.jpg', 'assdf', '2021-08-22 00:05:35', b'1', 1, 1),
(20, 'Post-PostgreSQL', 'Post-PostgreSQL Subtitle', 'e8680f0f32ad.jpg', 'asfsdfsf', '2021-08-22 00:02:58', b'0', 1, 1),
(21, 'Post-Redis', 'Post-Redis Subtitle', '47dcef303874.jpg', 'asdfsdf', '2021-08-22 00:03:11', b'0', 1, 1),
(22, 'Post-Shellscript', 'Post-Shellscript Subtitle', 'f58eb257b3d7.jpg', 'asdfsdf', '2021-08-22 00:04:41', b'1', 1, 1),
(23, 'Post-SpringBoot', 'Post-SpringBoot Subtitle', 'f7b1ccde0abd.jpg', 'asfsfsdf', '2021-08-22 00:03:48', b'0', 1, 1),
(24, 'Post-Linux', 'Post-Linux Subtitle', 'a0649794de21.jpg', 'asdsdf', '2021-08-22 00:03:58', b'0', 1, 1),
(25, 'Post-Git', 'Post-Git Subtitle', 'ccb83bc901cb.jpg', 'asdfsdf', '2021-08-22 00:04:15', b'0', 1, 1),
(26, 'Post-VueJS', 'Post-VueJS Subtitle', 'd1deba20ee22.jpg', 'assdf', '2021-08-22 00:04:38', b'1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_icon` varchar(255) DEFAULT '',
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_deleted` bit(1) NOT NULL DEFAULT b'0',
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`, `subcategory_icon`, `timestamp`, `is_deleted`, `category_id`) VALUES
(1, 'Sub-AWS', 'a38bc8353a97.jpg', '2021-08-21 23:54:25', b'0', 1),
(2, 'Sub-DynamoDB', '437e0c7e95f1.jpg', '2021-08-21 23:54:32', b'0', 1),
(3, 'Sub-C', 'a67144108173.jpg', '2021-08-21 23:54:38', b'0', 1),
(4, 'Sub-C++', '460a32659b5a.jpg', '2021-08-21 23:54:45', b'0', 1),
(5, 'Sub-Codeigniter', 'dde2d1025108.jpg', '2021-08-21 23:54:54', b'0', 1),
(6, 'Sub-Dart', '83b3c45151da.jpg', '2021-08-21 23:55:01', b'0', 1),
(7, 'Sub-Docker', '0f3ce49c5b52.jpg', '2021-08-21 23:55:08', b'0', 1),
(8, 'Sub-Flutter', '307decdbf46c.jpg', '2021-08-21 23:55:15', b'0', 1),
(9, 'Sub-Github Actions', '31e4dd4aa40e.jpg', '2021-08-21 23:55:23', b'0', 1),
(10, 'Sub-HTML/CSS', '49455c2cb8b5.jpg', '2021-08-21 23:55:32', b'0', 1),
(11, 'Sub-Java', '2416ff99546f.jpg', '2021-08-21 23:55:39', b'0', 1),
(12, 'Sub-Javascript', 'ab4e41668a0e.jpg', '2021-08-21 23:55:46', b'0', 1),
(13, 'Sub-jQuery', 'b95721756f5d.jpg', '2021-08-21 23:55:52', b'0', 1),
(14, 'Sub-Kubernetes', '50b5827e0d30.jpg', '2021-08-21 23:55:59', b'0', 1),
(15, 'Sub-Mocha-Chai', '9817a68c36c1.jpg', '2021-08-21 23:56:06', b'0', 1),
(16, 'Sub-MySQL', 'e45752a5f1ed.jpg', '2021-08-21 23:56:15', b'0', 1),
(17, 'Sub-NodeJS', '16e9330bfce8.jpg', '2021-08-21 23:56:21', b'0', 1),
(18, 'Sub-NuxtJS', '93d1969f9042.jpg', '2021-08-21 23:56:29', b'0', 1),
(19, 'Sub-PHP', 'eef59cf346f8.jpg', '2021-08-21 23:56:35', b'0', 1),
(20, 'Sub-PostgreSQL', '7cb9a21dffe6.jpg', '2021-08-22 00:04:54', b'1', 1),
(21, 'Sub-Redis', 'cebe080d8c54.jpg', '2021-08-22 00:05:52', b'1', 1),
(22, 'Sub-Shellscript', '796fcade523b.jpg', '2021-08-21 23:57:05', b'0', 1),
(23, 'Sub-SpringBoot', 'b122ac678d99.jpg', '2021-08-21 23:57:16', b'0', 1),
(24, 'Sub-Linux', '7a890a7d9192.jpg', '2021-08-22 00:05:44', b'1', 1),
(25, 'Sub-Git', 'a6345974242b.jpg', '2021-08-22 00:04:51', b'1', 1),
(26, 'Sub-VueJS', 'fd6a7ae09e3a.jpg', '2021-08-21 23:57:39', b'0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_post_1` (`subcategory_id`),
  ADD KEY `FK_post_2` (`category_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `FK_subcategory_1` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_post_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_subcategory_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
