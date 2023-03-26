-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 04:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--
CREATE DATABASE IF NOT EXISTS `capstone` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `capstone`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Ceiling Hang Pot Racks'),
(3, 'Coat Rack'),
(4, 'Greeting Cards'),
(2, 'Jewelry Organizer');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image_name`, `product_id`) VALUES
(17, 'pot-rack1.jpeg', 1),
(18, 'jewerly-organizer1.jpeg', 2),
(19, 'coat-rack1.jpeg', 3),
(20, 'card1.jpeg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_cost` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` decimal(6,2) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_description`, `product_price`) VALUES
(1, 1, 'Stained - Provincial Ceiling Hang Pot Rack', 'Wood type: White pine.\r\nColor stained- Provincial.\r\n\r\nThis pot rack is made with REAL pressed flowers! Black-eyed Susan flowers are featured on both sides of the pot rack.\r\n\r\nCan hold up to 8 pots and pans. Attaches to the ceiling with 2 standard ceiling hooks (not included). Pots and pans are easy to slide on and off the hooks with little effort from you.\r\n\r\n- Supports up to 8 pots or pans.\r\n\r\n- 26 1/2 inches in length.\r\n\r\n- Each hook can support up to 50lbs pot or pan.\r\n\r\n-Chain is at 16” length and can be adjusted shorter by looping the excess unwanted chain onto the ceiling hooks (like seen in pictures)\r\n\r\n-2 1/2” height, 1 1/2” depth and 26 1/2” length of wooden base.\r\n\r\n-With hooks it is 6” height (from bottom hook to top of hook attached to chain), 1 1/2” depth and 26 1/2” length.', '119.99'),
(2, 2, 'Weather Black- Jewelry Organizer', 'This jewelry holder features REAL roses on it. All flowers come from my house in Asheville, N.C. and is a one-of-a-kind piece.\r\n\r\nNo more tangled jewelry and now you can have your special pieces on display which makes it easier to choose what to wear! If you\'re like me and a visual person this is great to remind yourself of all the beautiful jewelry, you have to pick from.\r\nPersonally, If I don’t see it, I forget to wear it!\r\n\r\nThis Jewelry holder can hold up to 16 necklaces, earrings or brackets.\r\nIt attaches to the wall by two sawtooth hangers on the back.\r\n\r\n- Holds 16 items of jewelry.\r\n\r\n- 16 inches in length.\r\n\r\n-2 1/2” height, 1 1/2” depth and 16” length of wooden base.\r\n\r\n-With hooks it is 3 & 3/8” height (from bottom of hook to top of wood), 1 1/2” depth and 16” length.\r\n\r\nWhen installing, make sure your screw or nails hit a stud in the wall for maximum support.', '89.99'),
(3, 3, 'Farmhouse Style - Coat Rack', 'Farmhouse style coat/towel rack.\r\n\r\n- features 4 antique brass hooks for hanging.\r\n\r\n- 22 1/16” length\r\n\r\n- 6 14/16” width\r\n\r\n- 1 1/4” depth of wood\r\n- 3 1/2” depth with hooks\r\n\r\n- hooks are 4” height 1 1/2” length and 2” depth.\r\n\r\n- hangs by two keyhole slots on back\r\n\r\n- weighs 2.7 lbs.', '89.00'),
(4, 4, 'Blank Card with Flowers/ Greeting Card', 'This card features a design with real pressed flowers on the front.\r\n\r\nAll flowers come from my garden in Asheville, North Carolina that I have picked and pressed myself.\r\n\r\nThe rest of the card is blank for you to inscribe anything you want!\r\n\r\nEach card is unique (due to seasonal variation in flowers available) and includes my logo on the back.\r\n\r\nThis card measures:\r\n- 7” height\r\n- 5” wide\r\n\r\nA9 envelope is included with order\r\n- Measures 5-3/4” by 8-3/4”\r\n\r\nCould also be framed and hung on a wall.', '9.99');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_level` char(1) NOT NULL,
  `street_1` varchar(60) NOT NULL,
  `street_2` varchar(60) DEFAULT NULL,
  `city` varchar(40) NOT NULL,
  `state_abbrev` char(2) NOT NULL,
  `zip_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `user_password`, `user_level`, `street_1`, `street_2`, `city`, `state_abbrev`, `zip_code`) VALUES
(94, 'The test', 'A', 'atest@gmail.com', '08b98e389d4862f7226f57dc52aa7e96', '', 'a', '', 'Asheville', 'KS', '000112');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
