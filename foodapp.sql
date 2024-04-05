-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2024 at 03:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `name`, `image`, `user_id`) VALUES
(2, 'Hollee Griffin', 'platzhalere-300x185.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `item_img` varchar(255) DEFAULT NULL,
  `quantity` int NOT NULL,
  `desc` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `user_id`, `item`, `item_img`, `quantity`, `desc`) VALUES
(14, 2, 'Ackee and saltfish ', 'Ackee_and_Saltfish.jpg', 96, 'Dive into the heart of Jamaican cuisine with Ackee and Saltfish, the national dish that symbolizes the island\'s rich culture and culinary diversity. This beloved meal pairs the unique, buttery ackee fruit with savory salted cod, creating a harmonious blend of flavors that\'s both comforting and exotic. SautÃ©ed with onions, scotch bonnet peppers, and tomatoes, it\'s a vibrant dish that\'s as colorful as it is delicious.'),
(15, 2, 'Cornish Pasty', 'Cornish_pasty.jpg', 100, 'The Cornish Pasty, a staple from Cornwall, England, is a savory hand-held pie filled with beef, potatoes, swede, and onions, wrapped in a D-shaped short crust pastry. This hearty meal has become a beloved symbol of Cornish heritage, enjoyed nationwide for its delicious filling and flaky pastry.'),
(16, 2, 'Pakoras', 'Pakora.jpg', 100, 'Pakora is a beloved fried snack from the Indian subcontinent, featuring vegetables, meat, or fish coated in a spiced gram flour batter and deep-fried until golden and crispy. Pakoras are a favorite at gatherings for their crunchy texture and flavorful bite. They are especially enjoyed during rainy and cold seasons, offering a warm and comforting treat.'),
(17, 2, 'Dhokla', 'Dhokla.jpg', 100, 'Dhokla is a light and spongy vegetarian snack from Gujarat, India, made from fermented rice and chickpea flour batter. It\'s steamed, then seasoned with mustard seeds, green chilies, and curry leaves, and often garnished with coconut and coriander.'),
(18, 2, 'Dim Sum', 'Dim_Sum.jpg', 100, 'Indulge in the exquisite tradition of Dim Sum, the heart of Cantonese cuisine, offering an array of bite-sized delights that promise to tantalize your taste buds. From succulent dumplings to fluffy buns and savory pastries, each piece is a masterpiece of flavor, meticulously prepared to offer a unique dining experience.'),
(19, 2, 'Chow Mein', 'Chow_Mein.jpg', 100, 'Dive into the rich flavors of Chow Mein, a cornerstone of Chinese cuisine known for its delightful mix of stir-fried noodles, crisp vegetables, and your choice of protein, all tossed in a savory sauce.'),
(20, 2, 'Fish and chips', 'Fish_and_chips.jpg', 100, 'Experience the iconic Fish and Chips, a beloved British dish that\'s become a worldwide favorite. Savor the perfect harmony of crispy, golden-battered fish paired with hot, fluffy chips, creating a comforting, and satisfying meal.'),
(21, 2, 'Chicken Biryani', 'Chicken_biryani.jpg', 100, 'Embark on a culinary journey with Chicken Biryani, a majestic dish that marries fragrant basmati rice with spiced, tender chicken, all layered with caramelized onions, fresh herbs, and saffron.'),
(22, 2, 'Sushi', 'Sushi.jpg', 100, 'Dive into the delicate art of Sushi, a cornerstone of Japanese culinary tradition renowned for its simple elegance and fresh flavors. This exquisite dish features perfectly seasoned sushi rice paired with a variety of toppings, including fresh fish, seafood, and vegetables, meticulously crafted into bite-sized pieces.');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `item_id` int NOT NULL,
  `quantity_sold` int NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `item_id`, `quantity_sold`, `transaction_date`) VALUES
(1, 5, 14, 2, '2024-04-05 17:13:01'),
(2, 5, 14, 2, '2024-04-05 17:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` enum('manager','staff','student') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2, 'manager', '$2y$10$sLIWGu9Ldd3BSuYMJXA.cu1LxGutsTQnvAa3kx2iS8LDdLdcLC1Bm', 'manager'),
(3, 'staff', '$2y$10$hb6YqcCYJd2j5U8YsDBDJu8D84K.A6G1otpdk9kEHP/9yvtSnxm4e', 'staff'),
(4, 'student', '$2y$10$QJKHu8AKiLbtiqpDILXIjuuDknfLOo/wXCyQZZ.gd.MUN7zXBixsi', 'student'),
(5, 'naveed', '$2y$10$Sv/ITrcqIetgfFVI/t9cee5tqgNNQBoSafCX2HjcQeCGrOyjcu.Ci', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
