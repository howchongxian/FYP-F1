-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 07:42 AM
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
-- Database: `f1`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_code` int(3) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_tel` int(11) NOT NULL,
  `contact_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_no.` int(4) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_no.`, `feedback`) VALUES
(1, 'Nice product'),
(2, 'Good service bro!');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `id` int(5) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transactionID` int(11) DEFAULT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `name` int(5) NOT NULL,
  `address` varchar(25) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` int(8) NOT NULL,
  `product_img` text DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` varchar(200) DEFAULT NULL,
  `product_size` varchar(5) NOT NULL,
  `description` varchar(500) NOT NULL,
  `product_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_img`, `product_name`, `category`, `product_size`, `description`, `product_price`) VALUES
(13334182, 'images/product/Red Bull clothes(1).jpg', 'Oracle Red Bull Racing 2023 Team Polo', 'Clother', '55-80', '<ul>\r\n              <li>84% polyester/16% Elastane</li>\r\n              <li>Short sleeves</li>\r\n              <li>Quarter zip neck</li>\r\n              <li>Polo collar</li>\r\n              <li>Regular fit</li>\r\n              <li>Heat-sealed team and sponsor graphics</li>\r\n              <li>Officially licensed</li>\r\n            </ul>', 48.75),
(13368549, 'images/product/Mercedes clothes.jpg', 'Mercedes AMG Petronas F1 2023 Team Driver T-Shirt - White', 'Clother', '55-80', '<ul>\r\n                            <li>100% polyester</li>\r\n              <li>Short sleeves</li>\r\n              <li>Crew neck</li>\r\n              <li>Regular fit</li>\r\n              <li>Team and sponsor graphics</li>\r\n              <li>Officially licensed</li>\r\n            </ul>', 43.40);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `product_code` int(8) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_img` text NOT NULL,
  `product_size` varchar(5) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `product_price` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart2`
--

CREATE TABLE `shopping_cart2` (
  `cart_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `ticketID` int(4) DEFAULT NULL,
  `race` varchar(1000) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `ticket_price` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketID` int(4) NOT NULL,
  `race` varchar(1000) NOT NULL,
  `stand` varchar(100) NOT NULL,
  `ticket_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketID`, `race`, `stand`, `ticket_price`) VALUES
(1, 'FORMULA 1 CRYPTO.COM MIAMI GRAND PRIX 2024', 'HOSPITALITY - FORMULA ONE PADDOCK CLUB', 10000.00),
(2, 'FORMULA 1 CRYPTO.COM MIAMI GRAND PRIX 2024', 'Marina Central Grandstand', 850.00);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', 'S19h8a1w23n', 'superadmin'),
(2, 'admin', 'admin@hotmail.com', 'Mt021-036', 'admin'),
(3, 'user', 'user@hotmail.com', 'S19h8a1w23n', 'user'),
(4, 'test', 'test@hotmail.com', 't20e5s19t20', 'user'),
(5, 'Shawnkew', 'shawnkohenwee@gmail.com', 'mt=04-08+28', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_no.`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `order_ibfk_1` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `shopping_cart2`
--
ALTER TABLE `shopping_cart2`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_no.` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopping_cart2`
--
ALTER TABLE `shopping_cart2`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
