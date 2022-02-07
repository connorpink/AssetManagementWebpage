-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 04:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Item` varchar(55) NOT NULL,
  `Count` int(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Threshold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Item`, `Count`, `Category`, `Threshold`) VALUES
('BarcodeScanners', 32, '', 10),
('Docks', 10, 'Computer', 5),
('LabelPrinters', 44, 'Printer', 22),
('Laptops', 15, 'Computer', 6),
('Monitor', 27, 'Computer', 10),
('Printers', 36, 'Printer', 5),
('single-ear-headset-wired', 33, 'cisco/headset', 20),
('single-ear-headset-wireless', 33, 'cisco/headset', 20),
('SpeechMike', 15, '', 8),
('ThickClient', 12, 'Computer', 0),
('ThinClient', 28, 'Computer', 10);

--
-- Triggers `inventory`
--
DELIMITER $$
CREATE TRIGGER `AddLog` AFTER UPDATE ON `inventory` FOR EACH ROW INSERT INTO Log(item,count,date)VALUES(NEW.Item,NEW.count,NOW())
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Item`),
  ADD KEY `Category` (`Category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
