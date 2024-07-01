-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 04:02 PM
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

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_code`, `contact_name`, `contact_email`, `contact_tel`, `contact_message`) VALUES
(1, 'William Teoh', 'williamth06@gmail.com', '018-9576234', 'Hello, I\'m interested in sponsorship opportunities within F1. Who should I contact to discuss this further?'),
(2, 'Jack Wang', 'jackwg@hotmail.com', '019-3578429', 'Hello, I\'m a student researching the environmental impact of F1 racing. Can you provide data or studies on this topic?'),
(3, 'Kevin Lim', 'kevinlim0201@gmail.com', '011-2574368', 'Hi there, I\'m interested in volunteering at an F1 event. How can I apply to become a volunteer?'),
(4, 'Charlie Liu', 'charlieliu@hotmail.com', '011-8527496', 'Hey, I\'m a photographer looking to get accredited for an upcoming F1 race. What are the requirements and application process?'),
(5, 'Daniel Yang', 'danielyg07@gmail.com', '013-9634578', 'Hi, I\'m a journalist interested in attending F1 pre-season testing. How can I obtain media credentials for these events?'),
(6, 'James Zhang', 'jameszg05@gmail.com', '015-8749130', 'Hi, I\'m a charity organizer interested in partnering with F1 teams or sponsors for fundraising events. How can I get in touch?'),
(7, 'Jacob Li', 'jacobli1@gmail.com', '016-7489325', 'Hello, I\'m a data analyst interested in F1 race strategies. Can you provide information on typical pit stop timings and strategies?'),
(8, 'Lucas Tan', 'lucast08@hotmail.com', '012-8574956', 'Hi, I\'m a podcaster specializing in sports psychology. Can you suggest resources on the mental preparation of F1 drivers?');

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

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `user_id`, `name`, `address`, `phone`, `payment_method`, `total_price`, `payment_status`, `created_at`) VALUES
(1, 4, 'Charlie Liu', 'No 25, Jalan Melaka Baru 3/2, Kampung Tengah, 75350 Batu Berendam, Melaka', '011-8527496', 'credit-card', 3023.36, 'Completed', '2024-04-15 22:42:42'),
(2, 7, 'Lucas Tan', 'No 5, Jalan Indah 18/6, 84000 Muar, Johor', '012-8574956', 'credit-card', 24382.15, 'Completed', '2024-04-19 16:26:24'),
(3, 3, 'William Teoh', 'No 8, Jalan Cenderawasih 8, Kampung Abdullah, 85000 Segamat, Johor', '018-9576234', 'credit-card', 1170.06, 'Completed', '2024-04-25 00:20:50'),
(4, 8, 'Jacob Li', 'No 27, Jalan Setia Jaya 16, Taman Setia Jaya, 83000 Batu Pahat, Johor', '016-7489325', 'credit-card', 669.96, 'Completed', '2024-05-01 02:56:25'),
(5, 5, 'James Zhang', 'No 40, Jalan Puteri 10/9, Bandar Puteri, 47100 Puchong, Selangor', '015-8749130', 'credit-card', 26671.33, 'Completed', '2024-05-05 23:02:37'),
(6, 9, 'Jack Wang', 'No 8, Jalan PU 9/5, Taman Puchong Utama, 47100 Puchong, Selangor', '019-3578429', 'credit-card', 41374.20, 'Completed', '2024-05-12 01:10:55'),
(7, 6, 'Kevin Lim', 'No 6, Jalan Berkok, Taman Million, 51100 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', '011-2574368', 'credit-card', 15993.64, 'Completed', '2024-05-16 21:12:26'),
(8, 10, 'Daniel Yang', 'No 15, Jalan TU 28, 75350 Ayer Keroh, Melaka', '013-9634578', 'credit-card', 12550.20, 'Completed', '2024-05-27 17:15:14'),
(9, 7, 'Lucas Tan', 'No 5, Jalan Indah 18/6, 84000 Muar, Johor', '012-8574956', 'credit-card', 52378.82, 'Completed', '2024-06-05 19:20:49'),
(10, 5, 'James Zhang', 'No 40, Jalan Puteri 10/9, Bandar Puteri, 47100 Puchong, Selangor', '015-8749130', 'credit-card', 81366.96, 'Completed', '2024-06-15 00:10:48');

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

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`oi_id`, `order_id`, `product_code`, `quantity`, `price`) VALUES
(1, 1, '200838293', 1, 200.04),
(2, 1, '200838295', 1, 313.28),
(3, 2, '201084097', 1, 343.47),
(4, 3, '201084325', 2, 585.03),
(5, 4, '201131541', 1, 669.96),
(6, 5, '200838293', 1, 200.04),
(7, 5, '200838295', 1, 313.28),
(8, 5, '201084097', 2, 343.47),
(9, 5, '201084325', 1, 585.03),
(10, 5, '201131541', 1, 669.96),
(11, 5, '201163842', 1, 177.40),
(12, 6, '200838293', 1, 200.04),
(13, 6, '201163842', 1, 177.40),
(14, 6, '200838295', 1, 313.28),
(15, 7, '201084325', 2, 585.03),
(16, 7, '201131541', 2, 669.96),
(17, 7, '201084097', 2, 343.47),
(18, 9, '200838293', 1, 200.04),
(19, 9, '200838295', 1, 313.28),
(20, 9, '201084097', 1, 343.47),
(21, 9, '201084325', 1, 585.03),
(22, 9, '201131541', 1, 669.96),
(23, 9, '201163842', 1, 177.40);

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

--
-- Dumping data for table `order_tickets`
--

INSERT INTO `order_tickets` (`ot_id`, `order_id`, `ticketID`, `race`, `quantity`, `price`) VALUES
(1, 1, '4', 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024                          ', 1, 2510.04),
(2, 2, '1', 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024                          ', 1, 24038.68),
(3, 5, '1', 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024                          ', 1, 24038.68),
(4, 6, '3', 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024                          ', 2, 20341.74),
(5, 7, '2', 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024                          ', 4, 3199.18),
(6, 8, '4', 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024                          ', 5, 2510.04),
(7, 9, '1', 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024                          ', 1, 24038.68),
(8, 9, '2', 'FORMULA 1 QATAR AIRWAYS BRITISH GRAND PRIX 2024                          ', 1, 3199.18),
(9, 9, '3', 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024                          ', 1, 20341.74),
(10, 9, '4', 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024                          ', 1, 2510.04),
(11, 10, '3', 'FORMULA 1 SINGAPORE AIRLINES SINGAPORE GRAND PRIX 2024                          ', 4, 20341.74);

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

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `id`, `product_code`, `product_name`, `product_img`, `product_size`, `quantity`, `product_price`) VALUES
(18, 11, 201084325, 'McLaren 2024 Team Hooded Sweat - Unisex                          ', 'McLaren 2024 Team Hooded Sweat - Unisex.jpg                          ', 'l', 1, 585.03);

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
  `role` varchar(255) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `reset_token`, `token_expiry`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '$2y$10$EjGC5loV0dhSwYdILXO1rePs.5oThlzG3dOxgBw.p.W19O4vVxMya', 'superadmin', NULL, NULL),
(2, 'admin', 'admin@hotmail.com', '$2y$10$2v86x6wogi1OzbvWhnhUuOJKrpBxr2ierwO2olm/6EANEB.OsMRXq', 'admin', NULL, NULL),
(3, 'William Teoh', 'williamth06@gmail.com', '$2y$10$Ew1wx0UIGCNc612bmD8mDeOIT68nl1PK9Wescc3J/eWEPmc48Xum6', 'user', NULL, NULL),
(4, 'Charlie Liu', 'charlieliu@hotmail.com', '$2y$10$wCMIpYPfjvm/H6CnB5zB9.7nwDbZeO7u7nxQoxc58BYzigzSIfHHm', 'user', NULL, NULL),
(5, 'James Zhang', 'jameszg05@gmail.com', '$2y$10$6x7pKoYl4yAma1qfQRe3t.fhvbodkVAMEBnruM3RwP.eefs/Gp/ui', 'user', NULL, NULL),
(6, 'Kevin Lim ', 'kevinlim0201@gmail.com', '$2y$10$67j9cM8/tVreokhcvV0KZOwLDEsCRCNfFzbRQ0jJ9lgeAmf7K9Una', 'user', NULL, NULL),
(7, 'Lucas Tan', 'lucast08@hotmail.com', '$2y$10$Wu1.cYH28o89l9IBeq1rNOgb/08BgY/TN5R8WDbsv8BnSCWNsPKrW', 'user', NULL, NULL),
(8, 'Jacob Li', 'jacobli1@gmail.com', '$2y$10$RTBfTVW/xKbXvCmS1m7Uyu4Wz5v2fUIZPiSzzb3y.npnppU9UenOm', 'user', NULL, NULL),
(9, 'Jack Wang', 'jackwg@hotmail.com', '$2y$10$.swwolLVcPWbf/Fg7dmB8.3F/ZkVPi5LS1xmK4wziNNt7ZCbOLMAG', 'user', NULL, NULL),
(10, 'Daniel Yang', 'danielyg07@gmail.com', '$2y$10$dWrohq17BeuPluWohikBE.RIr7kGGtfp3erJisQpwxpzLi8czvlVm', 'user', NULL, NULL),
(11, 'chongxian', 'howchongxian@gmail.com', '$2y$10$EZX.mJdceqFqGTShZ3TYgu4HEIf4colLUyAY9NM2yR9hLw1NC8/6S', 'user', NULL, NULL);

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
  MODIFY `contact_code` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_no.` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `oi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_tickets`
--
ALTER TABLE `order_tickets`
  MODIFY `ot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shopping_cart2`
--
ALTER TABLE `shopping_cart2`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
