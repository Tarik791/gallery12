-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2021 at 03:05 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`) VALUES
(49, 'images', '', '', 'images-1.jpg', '', 'image/jpeg', 28947),
(50, 'Image 2', '', '', 'images-2 copy.jpg', '', 'image/jpeg', 18578),
(51, 'Image 3', '', '', 'images-3.jpg', '', 'image/jpeg', 18096),
(52, 'Image 4', '', '', 'images-3 copy.jpg', '', 'image/jpeg', 18096),
(53, 'Image 5', '', '', 'images-4.jpg', '', 'image/jpeg', 23270),
(54, 'Image 6', '', '', 'images-4 copy.jpg', '', 'image/jpeg', 23270),
(55, 'Image 7', '', '', 'images-5.jpg', '', 'image/jpeg', 33192),
(56, 'Image 8', '', '', 'images-5 copy.jpg', '', 'image/jpeg', 33192),
(57, 'Image 8', '', '', 'images-6.jpg', '', 'image/jpeg', 21886),
(58, 'Image 9', '', '', 'images-6 copy.jpg', '', 'image/jpeg', 21886),
(59, 'Image 11', '', '', 'images-7.jpg', '', 'image/jpeg', 24140),
(60, 'Image 12', '', '', 'images-7 copy.jpg', '', 'image/jpeg', 24140),
(61, 'Image 13', '', '', 'images-8.jpg', '', 'image/jpeg', 20810),
(62, 'Image 14', '', '', 'images-9.jpg', '', 'image/jpeg', 21108),
(63, 'Image 15', '', '', 'images-9 copy.jpg', '', 'image/jpeg', 21108),
(64, '', '', '', 'images-11.jpg', '', 'image/jpeg', 27916),
(65, 'Image 17', '', '', 'images-10 copy.jpg', '', 'image/jpeg', 20401),
(66, 'Image 18', '', '', 'images-12.jpg', '', 'image/jpeg', 18540),
(67, 'Image 19', '', '', 'images-11 copy.jpg', '', 'image/jpeg', 27916),
(68, 'Image 19', '', '', 'images-18.jpg', '', 'image/jpeg', 27595),
(69, 'Image 20', '', '', 'images-18 copy.jpg', '', 'image/jpeg', 27595),
(70, 'Image 21', '', '', 'images-21.jpg', '', 'image/jpeg', 19957),
(71, 'Image 22', '', '', 'images-21 copy.jpg', '', 'image/jpeg', 19957),
(72, 'Image 23', '', '', 'images-23.jpg', '', 'image/jpeg', 22792),
(73, 'Image 24', '', '', 'images-24 copy.jpg', '', 'image/jpeg', 29850),
(74, 'image 24', '', '', 'images-27.jpg', '', 'image/jpeg', 17662),
(75, 'Image 25', '', '', 'images-25 copy.jpg', '', 'image/jpeg', 19363),
(76, 'Image 26', '', '', 'images-28.jpg', '', 'image/jpeg', 17662),
(77, 'Image 28', '', '', 'images-28 copy.jpg', '', 'image/jpeg', 17662),
(78, 'Image 29', '', '', 'images-29.jpg', '', 'image/jpeg', 25493),
(79, 'Image 30', '', '', 'images-30.jpg', '', 'image/jpeg', 20257),
(80, 'Image 31', '', '', 'images-32.jpg', '', 'image/jpeg', 22772),
(81, 'Image 33', '', '', 'images-32 copy.jpg', '', 'image/jpeg', 22772),
(82, 'Image 33', '', '', 'images-35.jpg', '', 'image/jpeg', 23672),
(83, 'Image 36', '', '', 'images-36.jpg', '', 'image/jpeg', 21672),
(84, 'Images 30', '', '', 'images-44.jpg', '', 'image/jpeg', 29486),
(85, 'Image 31', '', '', 'images-38.jpg', '', 'image/jpeg', 21857);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` bigint(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `rank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `username`, `password`, `first_name`, `last_name`, `user_image`, `date`, `rank`) VALUES
(276, 9223372036854775807, 'Tarik', '77b22b868e0a903025c048d20acf33283e6392cf', '', '', '', '2021-07-30 14:48:57', 'user'),
(277, 9223372036854775807, 'admin', '1172df8880fa4a374cbe300cef7e3f91ebccb73d', '', '', '', '2021-07-30 14:53:18', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caption` (`caption`),
  ADD KEY `filename` (`filename`),
  ADD KEY `alternate_text` (`alternate_text`),
  ADD KEY `type` (`type`),
  ADD KEY `size` (`size`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `userid` (`userid`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `user_image` (`user_image`),
  ADD KEY `date` (`date`),
  ADD KEY `rank` (`rank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
