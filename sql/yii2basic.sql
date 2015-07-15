-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 09:03 AM
-- Server version: 5.6.24-0ubuntu2-log
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2basic`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE IF NOT EXISTS `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `vn_price` decimal(10,0) DEFAULT NULL,
  `produced_year` date DEFAULT NULL,
  `manufacturer` varchar(128) DEFAULT NULL,
  `import_price` decimal(10,0) DEFAULT NULL,
  `color` varchar(64) DEFAULT NULL,
  `note` text,
  `available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `vn_price`, `produced_year`, `manufacturer`, `import_price`, `color`, `note`, `available`) VALUES
(1, 'Citroen', 0, '0000-00-00', '', 0, 'Orange', '', 1),
(2, 'eouoeu', 0, '0000-00-00', '', 0, 'gray', '', 1),
(3, 'oêuu', 0, '0000-00-00', '', 0, '', '', 1),
(4, 'ouoeu', 0, '0000-00-00', '', 0, 'yellow', '', 1),
(5, '', 0, '0000-00-00', '', 0, 'green', '', 0),
(6, 'BMW', 3423, '0000-00-00', '', 0, 'Orange', '', 1),
(7, 'BMW', 3423, '0000-00-00', '', 0, 'Orange', '', 1),
(8, 'BMW', 0, '0000-00-00', '', 0, '', '', 0),
(9, 'Suzuki', 0, '0000-00-00', '', 0, 'yellow', '', 0),
(10, 'Nissan', 0, '0000-00-00', '', 0, '', '', 0),
(11, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(12, 'Volvo', 0, '0000-00-00', '', 0, '', '', 0),
(13, 'Opel', 0, '0000-00-00', '', 0, 'Orange', '', 0),
(14, 'Chrysler', 0, '0000-00-00', '', 0, '', '', 0),
(15, 'Suzuki', 0, '0000-00-00', '', 0, '', '', 0),
(16, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(17, 'Suzuki', 0, '0000-00-00', '', 0, '', '', 0),
(18, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(19, 'Volvo', 0, '0000-00-00', '', 0, '', '', 0),
(20, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(21, 'Suzuki', 0, '0000-00-00', '', 0, 'Orange', '', 0),
(22, 'Chrysler', 0, '0000-00-00', '', 0, '', '', 0),
(23, 'Suzuki', 0, '0000-00-00', '', 0, '', '', 0),
(24, 'BMW', 0, '0000-00-00', '', 0, '', '', 0),
(25, 'Suzuki', 0, '0000-00-00', '', 0, '', '', 0),
(26, 'Nissan', 0, '0000-00-00', '', 0, '', '', 0),
(27, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(28, 'Volvo', 0, '0000-00-00', '', 0, '', '', 0),
(29, 'Opel', 0, '0000-00-00', '', 0, 'Orange', '', 0),
(30, 'Chrysler', 0, '0000-00-00', '', 0, 'Audi', '', 0),
(31, 'Nissan', 0, '0000-00-00', '', 0, 'yellow', '', 0),
(32, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(33, 'Suzuki', 0, '0000-00-00', '', 0, '', '', 0),
(34, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(35, 'Volvo', 0, '0000-00-00', '', 0, '', '', 0),
(36, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(37, 'Suzuki', 0, '0000-00-00', '', 0, '', '', 0),
(38, 'Kawasaki', 0, '0000-00-00', '', 0, '', '', 1),
(39, 'Lifan', 0, '0000-00-00', '', 0, '', '', 0),
(40, 'Honda', 0, '0000-00-00', '', 0, '', '', 0),
(41, 'Lifan', 0, '0000-00-00', '', 0, '', '', 0),
(42, 'Yamaha', 0, '0000-00-00', '', 0, '', '', 0),
(43, 'Toyota', 0, '0000-00-00', '', 0, '', '', 0),
(44, '', 0, '0000-00-00', '', 0, 'yellow', '', 0),
(45, 'Honda', 0, '0000-00-00', '', 0, '', '', 0),
(46, '', 0, '0000-00-00', '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `VN_price` decimal(10,0) DEFAULT NULL,
  `produced_year` date DEFAULT NULL,
  `Manufacturer` varchar(128) DEFAULT NULL,
  `Import_price` decimal(10,0) DEFAULT NULL,
  `Note` text,
  `Available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `VN_price`, `produced_year`, `Manufacturer`, `Import_price`, `Note`, `Available`) VALUES
(1, 'Sherpa', 200000, '2015-07-02', 'K', 10000, '', 1),
(2, 'Ninja', 3432, '0000-00-00', '343', 43, '            xxxxxxxxxxxxxx', 1),
(3, 'Kawasaki Sherpa', 160000000, '2008-07-16', 'Kawasaki', 7000, 'kkkkkkkkkk', 1),
(4, 'CR400', 200000000, '2009-07-22', 'Honda', 10000, 'jjjjjjjjjjjjjjjj', 1),
(5, '', 0, '0000-00-00', '', 0, '', 1),
(6, 'ZX', 34343, '0000-00-00', 'Yamaha', 3433, '', 1),
(7, '', 0, '0000-00-00', '', 0, 'voãi', 1),
(8, 'kkkk', 0, '0000-00-00', '', 2343, '', 1),
(9, '', 0, '0000-00-00', '', 0, '', 1),
(10, 'đậu xanh', 0, '0000-00-00', '', 0, '', 1),
(11, 'iiiiiiiiiiiiiiii', 0, '0000-00-00', '', 0, '', 1),
(12, 'Santa Cruz', 0, '0000-00-00', '', 234324, 'aouoeuo', 1),
(13, 'Rocky Mountain', 0, '0000-00-00', '', 0, '', 1),
(14, 'balboa', 0, '0000-00-00', '', 0, '', 1),
(15, 'Zigg', 0, '0000-00-00', '', 0, 'aoueou', 1),
(16, 'Teemoo', 0, '0000-00-00', '', 0, 'kkk', 1),
(17, 'oeueu', 0, '0000-00-00', '', 0, 'xanh', 1),
(18, 'Yasuo', 0, '0000-00-00', '', 0, '', 1),
(19, 'oeueou', 0, '0000-00-00', '', 0, '', 1),
(20, 'oeue', 0, '0000-00-00', '', 0, '>>>>>>>>>>>>>>>', 1),
(21, 'oaeue', 0, '0000-00-00', '', 0, '', 1),
(22, 'oauoeu', 0, '0000-00-00', '', 0, '', 1),
(23, 'oeuoeu', 0, '0000-00-00', '', 0, '.p,.p343', 1),
(24, 'oauoeu', 0, '0000-00-00', '', 0, '', 1),
(25, 'oeuoeu', 0, '0000-00-00', '', 0, '', 1),
(26, 'dau', 0, '0000-00-00', '', 0, '', 0),
(27, 'xanh', 0, '0000-00-00', '', 0, '', 0),
(28, 'voaix', 0, '0000-00-00', '', 0, '.p.p', 0),
(29, 'ma', 0, '0000-00-00', 'eueu', 0, '', 0),
(30, 'kkk', 0, '0000-00-00', '', 0, '', 0),
(31, 'kkk', 0, '0000-00-00', 'oueu', 0, 'oeueu', 0),
(32, 'oeueou', 0, '0000-00-00', '', 0, '', 0),
(33, 'oeuuuueu', 0, '0000-00-00', 'oaueu', 0, '', 0),
(34, 'chandra', 0, '0000-00-00', '', 0, '', 0),
(35, '#################', 0, '0000-00-00', '', 0, '', 0),
(36, '', 0, '0000-00-00', '', 0, '', 0),
(37, '', 0, '0000-00-00', '', 0, '', 0),
(38, '', 0, '0000-00-00', '', 0, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
