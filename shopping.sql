-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 07:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Product_name` varchar(100) DEFAULT NULL,
  `Product_price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Customer_Name` varchar(100) DEFAULT NULL,
  `Hotel_name` varchar(100) DEFAULT NULL,
  `Phone_Number` int(11) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Longitude` float DEFAULT NULL,
  `Latitude` float DEFAULT NULL,
  `LongLat` varchar(200) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `paymentid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `ProductId`, `Product_name`, `Product_price`, `quantity`, `Total`, `Customer_Name`, `Hotel_name`, `Phone_Number`, `Address`, `Longitude`, `Latitude`, `LongLat`, `Status`, `paymentid`) VALUES
(97, NULL, 'Chapati', 1200, 1, 4800, 'Stephen Kaguri', 'Bettys Restaurant', 718024761, 'Kamakwa Nyeri', NULL, NULL, NULL, 'Paid', 'NVETV5454HF12'),
(98, NULL, 'Chapati', 1200, 3, 4800, 'Stephen Kaguri', 'Bettys Restaurant', 718024761, 'Kamakwa Nyeri', NULL, NULL, NULL, 'Paid', 'NVETV5454HF12'),
(99, NULL, 'Chapati', 1200, 1, 1200, 'gfg', 'Mama Africa Restaurant', 675645, 'gfdg', NULL, NULL, NULL, 'Paid', 'fdg'),
(100, NULL, 'Chapati', 1200, 5, 8400, 'stine', 'Raybells Restaurant', 718024766, 'kikuyu', NULL, NULL, NULL, 'Paid', 'dsa154sad'),
(101, NULL, 'Chapati', 1200, 2, 8400, 'stine', 'Raybells Restaurant', 718024766, 'kikuyu', NULL, NULL, NULL, 'Paid', 'dsa154sad'),
(102, NULL, 'Mchele Mix', 275, 3, 825, 'Stine', 'Mama Africa Restaurant', 715426325, 'Kikuyu', NULL, NULL, NULL, 'Paid', 'ERFETR1441ERE');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Photo` varchar(100) DEFAULT NULL,
  `Supplier` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `product_name`, `Category`, `Price`, `Photo`, `Supplier`) VALUES
(28, 'Mchele Mix', 'Main Dish', 200, '../img/b1.jpg', 'Mama Africa Restaurant'),
(29, 'Ugali Fish', 'Main Dish', 375, '../img/slider1.jpg', 'Mama Africa Restaurant'),
(30, 'Ugali Chicken', 'Main Dish', 275, '../img/d1.jpg', 'Mama Africa Restaurant'),
(31, 'Mchele Mix', 'Main Dish', 375, '../img/d2.jpg', 'Raybells Restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `Access_level` int(11) DEFAULT NULL,
  `Customer_name` varchar(100) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `TillNumber` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Access_level`, `Customer_name`, `Location`, `mobile`, `TillNumber`, `photo`, `Description`) VALUES
(1, 'admin@gmail.com', '$2y$10$tBlyEjFUv4SMi9vi1xwvxe4RP9Ns.tYSgtZ7Xo5vLS0aE/LJEJ2oC', 1, 'Administrator', NULL, 718024761, 111, 'none', 'none'),
(3, 'stine@gmail.com', '$2y$10$tBlyEjFUv4SMi9vi1xwvxe4RP9Ns.tYSgtZ7Xo5vLS0aE/LJEJ2oC', 3, 'Stephen Kaguri', 'Nyeri', 725426358, 111, 'none', 'none'),
(4, 'raybells@gmail.com', '0123456789', 2, 'Raybells Restaurant', 'Nyeri', 725426358, 854785, 'myimg/t2.jpg', 'Hello there, you are welcome anytime'),
(5, 'bettys@gmail.com', '0123456789', 2, 'Bettys Restaurant', 'Nyeri', 725426358, 12356, 'myimg/t3.jpg', 'Hello there, you are welcome anytime'),
(6, 'mamafrica@gmail.com', '0123456789', 2, 'Mama Africa Restaurant', 'Nyeri', 725426358, 854785, 'myimg/t4.jpg', 'Hello there, you are welcome anytime'),
(7, 'kaguris96@gmail.com', '$2y$10$tBlyEjFUv4SMi9vi1xwvxe4RP9Ns.tYSgtZ7Xo5vLS0aE/LJEJ2oC', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'stinestine@outlook.com', '$2y$10$Bb/uurXhf335ZsjgoxVxP.NwmoK.2emfNYW86MlVwYU9Lz3Fby07q', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'stinestine1@outlook.com', '$2y$10$.6KCHVbLRvf3jlgU7I9zN.9bylEd1OkUBWrKnDeYbmesFVYU0yry6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'stinestine10@outlook.com', '$2y$10$SWhH5pz60Og/cX5DylyH7OP3xj5yvG7pDLi3EgLdsnNcv0CyKTjMW', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'whiterhino@gmail.com', '1134567890', 2, 'The WhiteRhino Motel', 'Nyeri', 712584795, 3568742, 'myimg/f4.png', 'Welcome all');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
