-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 07:27 PM
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
  `contact_tel` varchar(15) NOT NULL,
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
(1, 'Nice Website !!!'),
(2, 'I enjoy the site\'s coverage of F1 heritage races and special events.'),
(3, 'The site layout is clean and easy to navigate, making it simple to find the latest news and race information.'),
(4, 'I\'m impressed by the timely updates on driver transfers, team developments, and other F1 news.'),
(5, 'The feature articles exploring the cultural impact of F1 in different countries add a global perspective to the sport.'),
(6, 'The race calendar and event schedule are always up-to-date and easy to access.'),
(7, 'The site provides a good balance of news, features, and multimedia content.'),
(8, 'The team and driver profiles are comprehensive and informative.'),
(9, 'The video highlights of races and qualifying sessions are comprehensive and easy to access.'),
(10, 'I appreciate the detailed profiles of F1 legends and their contributions to the sport.');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `oi_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_tickets`
--

CREATE TABLE `order_tickets` (
  `ot_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ticketID` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` int(8) NOT NULL,
  `product_img` text DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` varchar(200) DEFAULT NULL,
  `product_size` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `product_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_img`, `product_name`, `category`, `product_size`, `description`, `product_price`) VALUES
(200838293, 'Aston Martin Aramco F1 2024 Fernando Alonso Team Cap - Green.jpg', 'Aston Martin Aramco F1 2024 Fernando Alonso Team Cap - Green', 'Cap', 'One Size Only', 'Wear your support for the Aston Martin Formula One team right through the 2024 F1 season with the official range of replica team apparel. Pay homage to Fernando Alonso with this team cap featuring his personal emblem and car number \'14\' on the brim. The Aston Martin logo features on the front crown, with embroidered sponsor logos on the back and sides and crosshatch stitching adding extra texture reminiscent of classic car interior upholstery. AMF-1 text repeats along the edge of the brim and an', 200.04),
(200838295, 'Aston Martin Aramco F1 2024 Fernando Alonso Team Driver T-Shirt.jpg', 'Aston Martin Aramco F1 2024 Fernando Alonso Team Driver T-Shirt', 'Clothes', '2XS, XS, S, M', 'Wear your support for the Aston Martin Formula One team right through the 2024 F1 season with the official range of replica team apparel. Show your support for Fernando Alonso and his Aston Martin team through the 2024 with this driver tee. Featuring the iconic team and sponsor branding on the chest, back and sleeves and Alonso\'s name and car number on the back there\'s no better way to show who you\'re cheering for at the circuit.', 313.28),
(201084097, 'Red Bull Racing 2024 Team Polo.jpg', 'Red Bull Racing 2024 Team Polo', 'Clothes', 'S, M, L, XL, 2XL, 3XL', 'An all-time favourite that works whatever the situation. Get the look of a real pro with this branded team polo and make sure you\'re ready for anything.', 343.47),
(201084325, 'McLaren 2024 Team Hooded Sweat - Unisex.jpg', 'McLaren 2024 Team Hooded Sweat - Unisex', 'Clothes', 'XS, S, M, L, XL, 2XL, 3XL, 4XL', 'Show your dedicated support for the McLaren F1 team right through the 2024 season with the official replica apparel collection from Castore. The unisex official McLaren F1 Team hoodie is built with a simple overhead design. We\'ve fine-tuned every detail to ensure supreme comfort – with a bungee cord to tailor the fit and concealed side pockets to store essentials.', 585.03),
(201131541, 'Scuderia Ferrari 2024 Team Hooded Sweat.jpg', 'Scuderia Ferrari 2024 Team Hooded Sweat', 'Clothes', 'XS, S, M, L, XL, 2XL, 3XL', 'Wear your pride and support for the Ferrari F1 team right through the 2024 season with the official replica apparel collection. The classic hoodie gets a Ferrari team makeover with the iconic team badge and colours combined with trackside-style sponsor branding. Elastic at the cuffs and hem and a comfortable hood give the classic hoodie silhouette that looks great anywhere.', 669.96),
(201163842, 'Mercedes AMG Petronas F1 2024 Team Cap - Black.jpg', 'Mercedes AMG Petronas F1 2024 Team Cap - Black', 'Cap', 'One Size Only', 'Take your passion for Formula 1 and the Mercedes AMG Petronas team from the track to the street and back with the official 2024 Replica apparel collection. This classic cap is ideal for adding some Mercedes F1 style to your look, constructed with team colours and featuring the iconic team badge embroidered on the front crown. A classic six-panel crown construction with a curved brim and adjustable backstrap make it an essential classic for any fan of the team.', 177.40);

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
(1, 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024', 'Fusion Lounge(Fri-Sun)', 24038.68),
(2, 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024', 'The Racing Green(Saturday)', 3199.18),
(3, 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024', 'Green Room(Fri-Sun)', 20341.74),
(4, 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024', 'Padang(Fri-Sun)', 2510.04);

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
(1, 'superadmin', 'superadmin@gmail.com', '$2y$10$EjGC5loV0dhSwYdILXO1rePs.5oThlzG3dOxgBw.p.W19O4vVxMya', 'superadmin'),
(2, 'admin', 'admin@hotmail.com', '$2y$10$2v86x6wogi1OzbvWhnhUuOJKrpBxr2ierwO2olm/6EANEB.OsMRXq', 'admin'),
(3, 'William Teoh', 'williamth06@gmail.com', '$2y$10$Ew1wx0UIGCNc612bmD8mDeOIT68nl1PK9Wescc3J/eWEPmc48Xum6', 'user'),
(4, 'Charlie Liu', 'charlieliu@hotmail.com', '$2y$10$wCMIpYPfjvm/H6CnB5zB9.7nwDbZeO7u7nxQoxc58BYzigzSIfHHm', 'user'),
(5, 'James Zhang', 'jameszg05@gmail.com', '$2y$10$6x7pKoYl4yAma1qfQRe3t.fhvbodkVAMEBnruM3RwP.eefs/Gp/ui', 'user'),
(6, 'Kevin Lim ', 'kevinlim0201@gmail.com', '$2y$10$67j9cM8/tVreokhcvV0KZOwLDEsCRCNfFzbRQ0jJ9lgeAmf7K9Una', 'user'),
(7, 'Lucas Tan', 'lucast08@hotmail.com', '$2y$10$Wu1.cYH28o89l9IBeq1rNOgb/08BgY/TN5R8WDbsv8BnSCWNsPKrW', 'user'),
(8, 'Jacob Li', 'jacobli1@gmail.com', '$2y$10$RTBfTVW/xKbXvCmS1m7Uyu4Wz5v2fUIZPiSzzb3y.npnppU9UenOm', 'user'),
(9, 'Jack Wang', 'jackwg@hotmail.com', '$2y$10$.swwolLVcPWbf/Fg7dmB8.3F/ZkVPi5LS1xmK4wziNNt7ZCbOLMAG', 'user'),
(10, 'Daniel Yang', 'danielyg07@gmail.com', '$2y$10$dWrohq17BeuPluWohikBE.RIr7kGGtfp3erJisQpwxpzLi8czvlVm', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_code`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_no.`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`oi_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_tickets`
--
ALTER TABLE `order_tickets`
  ADD PRIMARY KEY (`ot_id`),
  ADD KEY `order_id` (`order_id`);

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
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_code` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_no.` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `oi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_tickets`
--
ALTER TABLE `order_tickets`
  MODIFY `ot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shopping_cart2`
--
ALTER TABLE `shopping_cart2`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_detail` (`order_id`);

--
-- Constraints for table `order_tickets`
--
ALTER TABLE `order_tickets`
  ADD CONSTRAINT `order_tickets_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_detail` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
