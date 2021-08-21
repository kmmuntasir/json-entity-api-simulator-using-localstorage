-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2021 at 01:29 AM
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
(5, 'AWS', '6067d7fb3e4b.jpg', '2021-08-21 22:25:10', b'0'),
(6, 'DynamoDB', 'd7026b299fa8.jpg', '2021-08-21 22:25:05', b'0'),
(7, 'C', 'ac723312d01f.jpg', '2021-08-21 22:25:00', b'0'),
(8, 'C++', 'c93753ced476.jpg', '2021-08-21 22:24:54', b'0'),
(9, 'Codeigniter', 'eae0b90144e9.jpg', '2021-08-21 22:24:49', b'0'),
(10, 'Dart', '48e3bd4d9753.jpg', '2021-08-21 23:04:27', b'0');

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
  `subcategory_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_subtitle`, `post_image`, `post_content`, `timestamp`, `is_deleted`, `subcategory_id`) VALUES
(1, 'MySQL Post', 'MySQL Post Subtitle', '1deea6168d71.jpg', 'MySQL Post Content', '2021-08-21 23:26:17', b'0', 4),
(2, 'Flutter Post', 'Flutter Post Subtitle', 'f0459f14a2f7.jpg', 'Flutter Post Content', '2021-08-21 23:26:08', b'0', 5),
(3, 'Node.js Post', 'Node.js Post Subtitle', '05612b147702.png', 'Node.js Post Content', '2021-08-21 23:27:20', b'0', 3);

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
(2, 'MySQL', '722c2e8c0992.jpg', '2021-08-21 22:25:29', b'0', 8),
(3, 'Node JS', 'b4e0e2459ff8.jpg', '2021-08-21 22:25:23', b'0', 6),
(4, 'Nuxt JS', 'e7d41b346380.jpg', '2021-08-21 22:25:18', b'0', 5),
(5, 'Flutter', '6e902a7d1a7b.jpg', '2021-08-21 22:37:23', b'0', 10);

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
  ADD KEY `FK_post_1` (`subcategory_id`);

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
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_subcategory_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
