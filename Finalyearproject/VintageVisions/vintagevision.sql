-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 10:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vintagevision`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(50) NOT NULL COMMENT 'regular id',
  `product_id` int(50) NOT NULL COMMENT 'id from product (FK)',
  `user_id` int(50) NOT NULL COMMENT 'user_id (FK)',
  `user_status` int(2) NOT NULL COMMENT '1 = Member || 0 = Guest',
  `cart_total` int(50) NOT NULL COMMENT 'total items added to cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(50) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `email`, `status`, `product_id`, `user_id`) VALUES
(96, 'pi_3OAQGIBeyFElC0Gu1DXPOzbf', 'nash.kavin.kd@gmail.com', 'Complete', '[\"2\",\"1\",\"7\"]', 5500),
(97, 'pi_3OAQGIBeyFElC0Gu1DXPOzbf', 'nash.kavin.kd@gmail.com', 'Complete', '[\"1\"]', 5500);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL COMMENT 'id increases as more added',
  `product_name` varchar(120) NOT NULL COMMENT 'name of furniture',
  `product_price` decimal(10,2) NOT NULL COMMENT 'price of furniture',
  `product_category` varchar(255) NOT NULL COMMENT 'category',
  `product_variation` varchar(15) NOT NULL COMMENT 'color, size etc',
  `product_description` varchar(999) NOT NULL,
  `product_stock` int(50) NOT NULL,
  `product_image` varchar(255) NOT NULL COMMENT '255 for link size, unknown.',
  `product_image_prev1` varchar(255) NOT NULL COMMENT 'preview 1',
  `product_image_prev2` varchar(255) NOT NULL COMMENT 'preview 2',
  `QRCode` varchar(50) NOT NULL COMMENT 'QR code name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_category`, `product_variation`, `product_description`, `product_stock`, `product_image`, `product_image_prev1`, `product_image_prev2`, `QRCode`) VALUES
(1, 'Midcentury Arm Chair', 399.00, 'Living Room', 'Mustard Yellow', 'Introducing our timeless Scandinavian Armchair, a true embodiment of mid-century elegance that harks back to the iconic design sensibilities of the 1950s. Crafted with precision and care, this chair boasts a sleek, minimalist frame constructed from sustainably sourced Scandinavian oak, providing both durability and a touch of eco-conscious style. Its lush, velvet upholstery, available in a myriad of rich colors, ensures not only a cozy seating experience but also a chic focal point for any room. With dimensions that make it the perfect fit for both small apartments and sprawling living spaces (measuring 45 inches in width, 38 inches in depth, and a seat height of 20 inches), this armchair effortlessly combines form and function. The ergonomically designed seating and angled armrests guarantee maximum comfort, while its faux-gold accents add a touch of understated luxury. Elevate your home décor with this Scandinavian masterpiece, where vintage charm meets modern sensibility.', 11, '../Images/mac1.jpg', '../Images/mac2.jpg', '../Images/mac3.jpg', '../QR/MAC1.png'),
(2, 'Mahogany Coffee Table', 499.00, 'Living Room', 'Mahogany Brown', 'Introducing our exquisite Mahogany Coffee Table, a timeless addition to your living space that effortlessly combines elegance.', 0, 'https://i.pinimg.com/564x/33/8f/48/338f4811a2794f2a8e1c80bb0e438d30.jpg', '', '', ''),
(3, 'Leather Sofa Set', 1399.00, 'Living Room', 'Leather Brown', 'Introducing our exquisite Mahogany Coffee Table, a timeless addition to your living space that effortlessly combines elegance.', 0, 'https://i.pinimg.com/564x/29/c7/6a/29c76aa971559b240319537a94cc183b.jpg', '', '', ''),
(5, 'Mahogany Dining Set', 1399.00, 'Dining', 'Brown', '', 0, '../Images/dining table.png', '', '', ''),
(6, 'Rich White Sofa', 2399.00, 'Living Room', 'White Leather', '', 0, '../Images/featured-sofa.png', '', '', ''),
(7, 'Leather Blue Sofa', 3999.00, 'Living Room', 'Blue Leather', '', 0, '../Images/featured-sofa-2.png', '', '', ''),
(8, 'Mahogany Queen Bed', 999.00, 'Bedroom', 'Brown Yellow', '', 1, '../Images/featured-bedroom.png', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(50) NOT NULL,
  `support_email` varchar(50) NOT NULL,
  `support_subject` varchar(50) NOT NULL,
  `support_message` varchar(500) NOT NULL,
  `status` int(2) NOT NULL COMMENT '1 yes 0 no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `support_email`, `support_subject`, `support_message`, `status`) VALUES
(1, 'nash.kavin.kd@gmail.com', 'Test Subject', 'Checking on the last stock updates.', 1),
(10, 'test@gmail.com', 'Test Subject', 'Checking on the last stock updates.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL COMMENT '0 = Not veriied/1 = Verified',
  `created_at` date NOT NULL,
  `user_phonenum` int(15) DEFAULT NULL,
  `user_shipping` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `verify_token`, `verify_status`, `created_at`, `user_phonenum`, `user_shipping`) VALUES
(4, 'Kavinash Devakumar', 'nash.kavin.kd@gmail.com', 'Kavinash29!', '30c1ff02f37fc10f53515f83af0f9ccf', 1, '0000-00-00', 165241871, '70-20-1, Olive Tree Residences, Persiaran Mahsuri 2, 11950, Bayan Lepas, Penang'),
(5, 'John Doe', 'k4vinplays@gmail.com', '$2y$10$QRYFd6MIO/vh8VlUs5u68uqO0jLv0pPAjMkbmEe9R/JibT5DHtD.i', 'a2788a000e2b43b2be6009994788d451', 0, '0000-00-00', NULL, NULL),
(6, 'Account Tester', 'p20012394@student.newinti.edu.my', '$2y$10$0IQOjxvKGjRsBAyBW0Ieo.vWY6RZ/VOcraocu/279UdM0OQ83rwpO', 'c51a679f730bae4741ce73a53a336688', 0, '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `user_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`, `user_status`) VALUES
(103, 1, 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'regular id', AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id increases as more added', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
