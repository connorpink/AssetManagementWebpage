-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 05:03 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `item` varchar(55) NOT NULL,
  `count` int(55) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`item`, `count`, `date`) VALUES
('BarcodeScanners', 1, '2022-02-02'),
('BarcodeScanners', 6, '2022-02-02'),
('LabelPrinters', -5, '2022-02-02'),
('BarcodeScanners', 0, '2022-02-02'),
('LabelPrinters', 0, '2022-02-02'),
('BarcodeScanners', 5, '2022-02-02'),
('ThinClient', -10, '2022-02-03'),
('ThinClient', 10, '2022-02-03'),
('BarcodeScanners', 10, '2022-02-03'),
('BarcodeScanners', 190, '2022-02-03'),
('BarcodeScanners', 690, '2022-02-03'),
('BarcodeScanners', 1190, '2022-02-03'),
('BarcodeScanners', 1690, '2022-02-03'),
('BarcodeScanners', 2190, '2022-02-03'),
('BarcodeScanners', 2690, '2022-02-03'),
('BarcodeScanners', 3190, '2022-02-03'),
('BarcodeScanners', 3690, '2022-02-03'),
('BarcodeScanners', 4190, '2022-02-03'),
('BarcodeScanners', 4690, '2022-02-03'),
('BarcodeScanners', 5190, '2022-02-03'),
('BarcodeScanners', 5690, '2022-02-03'),
('BarcodeScanners', 6190, '2022-02-03'),
('BarcodeScanners', 6690, '2022-02-03'),
('BarcodeScanners', 7190, '2022-02-03'),
('BarcodeScanners', 7690, '2022-02-03'),
('BarcodeScanners', 8190, '2022-02-03'),
('BarcodeScanners', 8690, '2022-02-03'),
('BarcodeScanners', 9190, '2022-02-03'),
('BarcodeScanners', 9690, '2022-02-03'),
('BarcodeScanners', 10190, '2022-02-03'),
('BarcodeScanners', 9690, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 5, '2022-02-03'),
('Docks', 5, '2022-02-03'),
('ThinClient', 16, '2022-02-03'),
('BarcodeScanners', 10, '2022-02-03'),
('Docks', 3, '2022-02-03'),
('LabelPrinters', 5, '2022-02-03'),
('BarcodeScanners', 11, '2022-02-03'),
('BarcodeScanners', 11, '2022-02-03'),
('Docks', 3, '2022-02-03'),
('LabelPrinters', 5, '2022-02-03'),
('Laptops', 0, '2022-02-03'),
('Monitor', 0, '2022-02-03'),
('Printers', 0, '2022-02-03'),
('SpeechMike', 0, '2022-02-03'),
('ThickClient', 0, '2022-02-03'),
('ThinClient', 16, '2022-02-03'),
('BarcodeScanners', 5, '2022-02-03'),
('BarcodeScanners', 11, '2022-02-03'),
('BarcodeScanners', 17, '2022-02-03'),
('BarcodeScanners', 23, '2022-02-03'),
('BarcodeScanners', 20, '2022-02-03'),
('BarcodeScanners', 26, '2022-02-03'),
('BarcodeScanners', 29, '2022-02-03'),
('BarcodeScanners', 32, '2022-02-03'),
('BarcodeScanners', 38, '2022-02-03'),
('BarcodeScanners', 44, '2022-02-03'),
('BarcodeScanners', 132, '2022-02-03'),
('BarcodeScanners', 135, '2022-02-03'),
('BarcodeScanners', 141, '2022-02-03'),
('BarcodeScanners', 147, '2022-02-03'),
('Docks', 9, '2022-02-03'),
('LabelPrinters', 11, '2022-02-03'),
('Laptops', 6, '2022-02-03'),
('BarcodeScanners', 153, '2022-02-03'),
('BarcodeScanners', 159, '2022-02-03'),
('BarcodeScanners', 150, '2022-02-03'),
('Docks', 18, '2022-02-03'),
('LabelPrinters', 2, '2022-02-03'),
('BarcodeScanners', 156, '2022-02-03'),
('Docks', 24, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('Docks', 0, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', -312, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 18, '2022-02-03'),
('BarcodeScanners', 21, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 1, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', -3, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 18, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('Docks', 6, '2022-02-03'),
('LabelPrinters', 8, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('Docks', 3, '2022-02-03'),
('LabelPrinters', 2, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', 13, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', 5, '2022-02-03'),
('BarcodeScanners', 11, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', 15, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 18, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('BarcodeScanners', 9, '2022-02-03'),
('BarcodeScanners', 3, '2022-02-03'),
('BarcodeScanners', -3, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('Docks', 6, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 12, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 0, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-03'),
('BarcodeScanners', 6, '2022-02-04'),
('Docks', 6, '2022-02-04'),
('LabelPrinters', 2, '2022-02-04'),
('Laptops', 6, '2022-02-04'),
('Monitor', 0, '2022-02-04'),
('Printers', 0, '2022-02-04'),
('SpeechMike', 0, '2022-02-04'),
('ThickClient', 0, '2022-02-04'),
('ThinClient', 16, '2022-02-04'),
('Printers', 0, '2022-02-04'),
('Monitor', 0, '2022-02-04'),
('Docks', 6, '2022-02-04'),
('Docks', 6, '2022-02-04'),
('LabelPrinters', 2, '2022-02-04'),
('Laptops', 6, '2022-02-04'),
('Monitor', 0, '2022-02-04'),
('Printers', 0, '2022-02-04'),
('ThickClient', 0, '2022-02-04'),
('ThinClient', 16, '2022-02-04'),
('BarcodeScanners', 6, '2022-02-04'),
('Docks', 6, '2022-02-04'),
('BarcodeScanners', 7, '2022-02-04'),
('BarcodeScanners', 8, '2022-02-04'),
('BarcodeScanners', 9, '2022-02-04'),
('BarcodeScanners', 10, '2022-02-04'),
('BarcodeScanners', 4, '2022-02-04'),
('BarcodeScanners', 5, '2022-02-04'),
('BarcodeScanners', 13, '2022-02-04'),
('BarcodeScanners', 15, '2022-02-04'),
('BarcodeScanners', 19, '2022-02-04'),
('BarcodeScanners', 21, '2022-02-04'),
('BarcodeScanners', 15, '2022-02-04'),
('BarcodeScanners', 3, '2022-02-04'),
('BarcodeScanners', 6, '2022-02-04'),
('BarcodeScanners', 18, '2022-02-04'),
('SpeechMike', 15, '2022-02-04'),
('Docks', 21, '2022-02-04'),
('Laptops', 18, '2022-02-04'),
('Monitor', 12, '2022-02-04'),
('ThickClient', 12, '2022-02-04'),
('ThinClient', 28, '2022-02-04'),
('LabelPrinters', 14, '2022-02-04'),
('Printers', 12, '2022-02-04'),
('BarcodeScanners', 3, '2022-02-04'),
('Monitor', 3, '2022-02-04'),
('Docks', 1, '2022-02-04'),
('LabelPrinters', 14, '2022-02-04'),
('Laptops', 18, '2022-02-04'),
('Monitor', 3, '2022-02-04'),
('Laptops', 3, '2022-02-04'),
('BarcodeScanners', 6, '2022-02-04'),
('BarcodeScanners', 15, '2022-02-04'),
('BarcodeScanners', 3, '2022-02-04'),
('SpeechMike', 27, '2022-02-04'),
('SpeechMike', 15, '2022-02-04'),
('Docks', 10, '2022-02-04'),
('LabelPrinters', 17, '2022-02-04'),
('single-ear-headset-wired', 3, '2022-02-04'),
('LabelPrinters', 20, '2022-02-04'),
('LabelPrinters', 23, '2022-02-04'),
('Monitor', 27, '2022-02-04'),
('LabelPrinters', 26, '2022-02-04'),
('LabelPrinters', 29, '2022-02-04'),
('Laptops', 15, '2022-02-04'),
('BarcodeScanners', 2, '2022-02-04'),
('LabelPrinters', 20, '2022-02-07'),
('Printers', -3, '2022-02-07'),
('SpeechMike', 15, '2022-02-07'),
('ThinClient', 28, '2022-02-07'),
('Printers', -3, '2022-02-07'),
('Printers', 0, '2022-02-07'),
('LabelPrinters', 32, '2022-02-07'),
('LabelPrinters', 38, '2022-02-07'),
('BarcodeScanners', 32, '2022-02-07'),
('single-ear-headset-wired', 33, '2022-02-07'),
('single-ear-headset-wireless', 33, '2022-02-07'),
('Printers', 36, '2022-02-07'),
('LabelPrinters', 44, '2022-02-07'),
('LabelPrinters', 38, '2022-02-07'),
('LabelPrinters', 44, '2022-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `sendemail`
--

CREATE TABLE `sendemail` (
  `Item` varchar(50) NOT NULL,
  `StoredDate` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sendemail`
--

INSERT INTO `sendemail` (`Item`, `StoredDate`, `id`) VALUES
('Docks', '2022-02-04', 8),
('Monitor', '2022-02-04', 9),
('LabelPrinters', '2022-02-07', 10),
('Laptops', '2022-02-04', 11),
('', '2022-02-04', 12),
('Computer', '2022-02-04', 13),
('Printer', '2022-02-04', 14),
('single-ear-headset-wired', '2022-02-07', 15),
('single-ear-headset-wireless', '2022-02-07', 16),
('BarcodeScanners', '2022-02-07', 17),
('Printers', '2022-02-07', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Item`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD KEY `item` (`item`);

--
-- Indexes for table `sendemail`
--
ALTER TABLE `sendemail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Item` (`Item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sendemail`
--
ALTER TABLE `sendemail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`item`) REFERENCES `inventory` (`Item`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
