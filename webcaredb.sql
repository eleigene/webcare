-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 03:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webcaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `username`, `password`) VALUES
(0, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articleid` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(2555) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `visit_count` int(255) NOT NULL,
  `categoryid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleid`, `title`, `link`, `picture`, `visit_count`, `categoryid`) VALUES
(1, 'What does anxiety feel like, and how does it affect the body?', 'https://www.medicalnewstoday.com/articles/322510', 'images/anxiety.jpg', 7, 5),
(4, 'Dealing with Teen Depression', 'https://www.helpguide.org/articles/depression/teenagers-guide-to-depression.htm', 'images/teen.jpg', 5, 0),
(10, 'Title', 'Link', 'upload/6703866dea01c.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE `article_categories` (
  `categoryid` int(255) NOT NULL,
  `articleid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`categoryid`, `articleid`) VALUES
(5, 1),
(2, 4),
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `article_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `name`, `article_id`) VALUES
(1, 'Academics and Career', 0),
(2, 'Depressiom', 0),
(3, 'Inspirational Quotes', 0),
(4, 'Behavioral Psychology', 2),
(5, 'Stress and Anxiety', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `verify_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `cpassword`, `userid`, `verify_token`, `profile`, `verify_status`) VALUES
('elei', 'eleigenefb25@gmail.com', '123', '', 12, '63ac4e1250718a1152be7201d420cdd9', 'profile.jpg', 'Verify'),
('sda', 'asdasd', 'asd', '', 13, '1b12d75996b7438c704947eb5cdf572e', 'profile.jpg', 'Not Verify'),
('', '', '', '', 14, '1332600ca1079361f689e9cdcbaf5d11', 'profile.jpg', 'Not Verify');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleid`);

--
-- Indexes for table `article_categories`
--
ALTER TABLE `article_categories`
  ADD KEY `fk_article` (`articleid`),
  ADD KEY `fk_category` (`categoryid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_categories`
--
ALTER TABLE `article_categories`
  ADD CONSTRAINT `fk_article` FOREIGN KEY (`articleid`) REFERENCES `articles` (`articleid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
