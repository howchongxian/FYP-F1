SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user` (
  `id` int(5) PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `product` (
  `product_code` int(4) NOT NULL,
  `product_img` text NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_size` varchar(5) NOT NULL,
  `description` varchar(500) NOT NULL,
  `product_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `ticket` (
    `ticketID` int(4) PRIMARY KEY AUTO_INCREMENT,
    `raceID` int (4) NOT NULL,
    `stand` varchar(100) NOT NULL,
    `ticket_price` decimal(5,2) NOT NULL,
);

CREATE TABLE `order` (
  `OrderID` int(11) PRIMARY KEY AUTO_INCREMENT,
  `UserID` int(5),
  `payment_method` varchar(50) NOT NULL,
  `transactionID` int(11),
  `payment_status` varchar(20) NOT NULL,
  FOREIGN KEY (`UserID`) REFERENCES `user` (`id`)
);

CREATE TABLE `transaction` (
  `transactionID` int(11) PRIMARY KEY AUTO_INCREMENT,
  `OrderID` int(11),
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`)
);

CREATE TABLE `contact` (
  `contact_code` int(3) PRIMARY KEY AUTO_INCREMENT,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_tel` int(11) NOT NULL,
  `contact_message` text NOT NULL
);

CREATE TABLE `feedback` (
    `feedback_no.` int(4) PRIMARY KEY AUTO_INCREMENT,
    `feedback` text NOT NULL
);