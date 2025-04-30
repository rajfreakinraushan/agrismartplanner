-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 23, 2025 at 07:54 AM
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
-- Database: `agrismart`
--

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `region_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `name`, `region_id`, `created_at`) VALUES
(1, 'Rice', 1, '2025-04-21 19:52:38'),
(2, 'Wheat', 5, '2025-04-21 19:52:38'),
(3, 'Cotton', 2, '2025-04-21 19:52:38'),
(4, 'Sugarcane', 4, '2025-04-21 19:52:38'),
(5, 'Coconut', 3, '2025-04-21 19:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `disposal_methods`
--

CREATE TABLE `disposal_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disposal_methods`
--

INSERT INTO `disposal_methods` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'In-situ Incorporation', 'Incorporate the waste directly into the soil to improve organic matter content and soil health.', '2025-04-21 19:52:38'),
(2, 'Composting', 'Convert the waste into nutrient-rich compost through controlled decomposition.', '2025-04-21 19:52:38'),
(3, 'Briquetting', 'Compress the waste into fuel briquettes that can be used as an alternative to firewood or coal.', '2025-04-21 19:52:38'),
(4, 'Biochar Production', 'Convert waste into biochar through pyrolysis for use as a soil amendment.', '2025-04-21 19:52:38'),
(5, 'Biogas Generation', 'Process waste in anaerobic digesters to produce methane-rich biogas.', '2025-04-21 19:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `complexity` enum('Low','Medium','High') NOT NULL,
  `market_demand` enum('Low','Medium','High') NOT NULL,
  `min_budget` enum('low','medium','high') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `name`, `description`, `complexity`, `market_demand`, `min_budget`, `created_at`) VALUES
(1, 'Organic Compost', 'Convert waste into nutrient-rich compost for use as a soil amendment or for sale to other farmers and gardeners.', 'Low', 'Medium', 'low', '2025-04-21 19:52:38'),
(2, 'Mulch', 'Process waste into mulch for weed suppression, moisture conservation, and soil improvement.', 'Low', 'Medium', 'low', '2025-04-21 19:52:38'),
(3, 'Fuel Briquettes', 'Compress waste into solid fuel briquettes for use as a clean-burning alternative to firewood or coal.', 'Medium', 'High', 'medium', '2025-04-21 19:52:38'),
(4, 'Biochar', 'Convert waste into biochar through pyrolysis for use as a soil amendment that improves fertility and carbon sequestration.', 'High', 'High', 'high', '2025-04-21 19:52:38'),
(5, 'Mushroom Substrate', 'Use agricultural waste as a growing medium for mushrooms.', 'Medium', 'Medium', 'medium', '2025-04-21 19:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `solar_potential` enum('Low','Medium','High','Very High') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `solar_potential`, `created_at`) VALUES
(1, 'Punjab', 'High', '2025-04-21 19:52:38'),
(2, 'Maharashtra', 'Very High', '2025-04-21 19:52:38'),
(3, 'Karnataka', 'High', '2025-04-21 19:52:38'),
(4, 'Gujarat', 'Very High', '2025-04-21 19:52:38'),
(5, 'Uttar Pradesh', 'Medium', '2025-04-21 19:52:38'),
(6, 'Haryana', 'High', '2025-04-22 07:40:26'),
(7, 'Rajasthan', 'Very High', '2025-04-22 07:40:26'),
(8, 'Madhya Pradesh', 'High', '2025-04-22 07:40:26'),
(9, 'Tamil Nadu', 'Very High', '2025-04-22 07:40:26'),
(10, 'Andhra Pradesh', 'High', '2025-04-22 07:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `crop_type_id` int(11) NOT NULL,
  `waste_type_id` int(11) NOT NULL,
  `waste_amount` decimal(10,2) NOT NULL,
  `farm_size` decimal(10,2) NOT NULL,
  `space_available` enum('none','small','medium','large') NOT NULL,
  `solar_panels` enum('yes','no') NOT NULL,
  `solar_capacity` decimal(10,2) DEFAULT 0.00,
  `budget` enum('low','medium','high') NOT NULL,
  `current_practice` varchar(100) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `region_id`, `crop_type_id`, `waste_type_id`, `waste_amount`, `farm_size`, `space_available`, `solar_panels`, `solar_capacity`, `budget`, `current_practice`, `notes`, `created_at`) VALUES
(1, 1, 10, 3, 6, 5.10, 5.20, 'large', 'no', 0.00, 'medium', 'plowing', '', '2025-04-22 08:33:10'),
(2, 1, 2, 2, 4, 2.90, 2.00, 'medium', 'no', 0.00, 'medium', 'composting', '', '2025-04-22 08:50:11'),
(3, 1, 2, 2, 4, 2.90, 2.00, 'medium', 'no', 0.00, 'medium', 'composting', '', '2025-04-22 08:53:20'),
(4, 1, 2, 2, 4, 2.90, 2.00, 'medium', 'no', 0.00, 'medium', 'composting', '', '2025-04-22 08:55:51'),
(5, 1, 1, 2, 4, 5.10, 6.30, 'large', 'no', 0.00, 'high', 'selling', '', '2025-04-22 18:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `solar_devices`
--

CREATE TABLE `solar_devices` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `roi_period` decimal(5,2) NOT NULL,
  `min_budget` enum('low','medium','high') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solar_devices`
--

INSERT INTO `solar_devices` (`id`, `name`, `description`, `cost`, `roi_period`, `min_budget`, `created_at`) VALUES
(1, 'Solar Dryer', 'Use solar energy to dry agricultural waste and products, reducing moisture content for better storage and processing.', 50000.00, 2.00, 'low', '2025-04-21 19:52:38'),
(2, 'Solar-Powered Shredder', 'Reduce the size of agricultural waste for easier processing and faster decomposition.', 120000.00, 3.00, 'medium', '2025-04-21 19:52:38'),
(3, 'Solar-Powered Briquetting Machine', 'Compress agricultural waste into solid fuel briquettes for use as an alternative to firewood or coal.', 250000.00, 4.00, 'high', '2025-04-21 19:52:38'),
(4, 'Solar-Powered Pyrolysis Unit', 'Convert agricultural waste into biochar, bio-oil, and syngas through heating in the absence of oxygen.', 350000.00, 5.00, 'high', '2025-04-21 19:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Raj Raushan', 'rajraushanbaranwal@gmail.com', '$2y$10$OEK0wi/XkP9W1iPDrajoTOB7bLUhct.rN4zgk7F9eg9yQ5BSzSYCi', '2025-04-21 19:56:43', '2025-04-21 19:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `waste_disposal_suitability`
--

CREATE TABLE `waste_disposal_suitability` (
  `id` int(11) NOT NULL,
  `waste_type_id` int(11) NOT NULL,
  `disposal_method_id` int(11) NOT NULL,
  `suitability` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waste_product_suitability`
--

CREATE TABLE `waste_product_suitability` (
  `id` int(11) NOT NULL,
  `waste_type_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `suitability` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waste_types`
--

CREATE TABLE `waste_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waste_types`
--

INSERT INTO `waste_types` (`id`, `name`, `crop_id`, `created_at`) VALUES
(1, 'Paddy Straw', 1, '2025-04-21 19:52:38'),
(2, 'Rice Husk', 1, '2025-04-21 19:52:38'),
(3, 'Wheat Straw', 2, '2025-04-21 19:52:38'),
(4, 'Wheat Chaff', 2, '2025-04-21 19:52:38'),
(5, 'Cotton Stalks', 3, '2025-04-21 19:52:38'),
(6, 'Cotton Gin Waste', 3, '2025-04-21 19:52:38'),
(7, 'Sugarcane Trash', 4, '2025-04-21 19:52:38'),
(8, 'Sugarcane Bagasse', 4, '2025-04-21 19:52:38'),
(9, 'Coconut Husks', 5, '2025-04-21 19:52:38'),
(10, 'Coconut Shells', 5, '2025-04-21 19:52:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `disposal_methods`
--
ALTER TABLE `disposal_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `crop_type_id` (`crop_type_id`),
  ADD KEY `waste_type_id` (`waste_type_id`);

--
-- Indexes for table `solar_devices`
--
ALTER TABLE `solar_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `waste_disposal_suitability`
--
ALTER TABLE `waste_disposal_suitability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste_type_id` (`waste_type_id`),
  ADD KEY `disposal_method_id` (`disposal_method_id`);

--
-- Indexes for table `waste_product_suitability`
--
ALTER TABLE `waste_product_suitability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste_type_id` (`waste_type_id`),
  ADD KEY `product_option_id` (`product_option_id`);

--
-- Indexes for table `waste_types`
--
ALTER TABLE `waste_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disposal_methods`
--
ALTER TABLE `disposal_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `solar_devices`
--
ALTER TABLE `solar_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waste_disposal_suitability`
--
ALTER TABLE `waste_disposal_suitability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waste_product_suitability`
--
ALTER TABLE `waste_product_suitability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waste_types`
--
ALTER TABLE `waste_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crops`
--
ALTER TABLE `crops`
  ADD CONSTRAINT `crops_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_3` FOREIGN KEY (`crop_type_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_4` FOREIGN KEY (`waste_type_id`) REFERENCES `waste_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `waste_disposal_suitability`
--
ALTER TABLE `waste_disposal_suitability`
  ADD CONSTRAINT `waste_disposal_suitability_ibfk_1` FOREIGN KEY (`waste_type_id`) REFERENCES `waste_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `waste_disposal_suitability_ibfk_2` FOREIGN KEY (`disposal_method_id`) REFERENCES `disposal_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `waste_product_suitability`
--
ALTER TABLE `waste_product_suitability`
  ADD CONSTRAINT `waste_product_suitability_ibfk_1` FOREIGN KEY (`waste_type_id`) REFERENCES `waste_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `waste_product_suitability_ibfk_2` FOREIGN KEY (`product_option_id`) REFERENCES `product_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `waste_types`
--
ALTER TABLE `waste_types`
  ADD CONSTRAINT `waste_types_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crops` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
