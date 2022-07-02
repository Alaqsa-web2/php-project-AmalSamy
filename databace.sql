-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 يوليو 2022 الساعة 04:10
-- إصدار الخادم: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databace`
--

-- --------------------------------------------------------

--
-- بنية الجدول `post_comment`
--

CREATE TABLE `post_comment` (
  `comment_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `created_datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `post_comment`
--

INSERT INTO `post_comment` (`comment_id`, `post_id`, `userId`, `comment_text`, `created_datetime`) VALUES
(1, 4, 4, 'a', '22:06:30 01:58:38 am'),
(2, 4, 4, 'a', '22:06:30 02:00:11 am'),
(3, 5, 5, 'اهلا', '22:06:30 11:32:14 am'),
(4, 6, 7, 'amal', '22:06:30 12:01:00 pm'),
(5, 6, 7, 'aml', ''),
(6, 6, 7, 'aml', '22:06:30 11:22:03 am'),
(7, 6, 7, 'aml', '22:06:30 12:24:13 pm');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `userId` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`userId`, `username`, `email`, `password`, `name_img`) VALUES
(7, 'amal', 'a@gmail.com', 'amal', 'i.png'),
(8, 'amalsamy', 'amal@gmail.com', 'amal', 'maxresdefault.jpg'),
(9, 'a1', 'a1@gmail.com', 'amal', 'maxresdefault.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `user_post`
--

CREATE TABLE `user_post` (
  `post_id` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `written_text` varchar(255) DEFAULT NULL,
  `comments` int(255) NOT NULL,
  `likes` int(255) NOT NULL,
  `created_datetime` text NOT NULL,
  `img_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `user_post`
--

INSERT INTO `user_post` (`post_id`, `userId`, `written_text`, `comments`, `likes`, `created_datetime`, `img_url`) VALUES
(42, 9, '', 0, 0, '22:07:02 04:45:05 am', ''),
(43, 9, '', 0, 0, '22:07:02 04:45:47 am', 'amal (2).png'),
(44, 9, 'sdfsdf', 0, 0, '22:07:02 04:45:53 am', ''),
(45, 9, '', 0, 0, '22:07:02 04:46:04 am', 'am.jpg'),
(46, 9, 'fsdf', 0, 0, '22:07:02 04:46:16 am', 'amal.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`userId`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
