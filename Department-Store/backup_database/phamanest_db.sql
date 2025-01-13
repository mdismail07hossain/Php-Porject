-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 08:08 AM
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
-- Database: `phamanest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `role`, `avatar`) VALUES
(1, 'Md Ismail', 'Hossain', 'ismail@gmail.com', 'ismail', '01322555634', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_status`) VALUES
(15, 'Antibiotics', 1),
(26, 'Antivirals', 1),
(27, 'Antifungals', 1),
(28, 'Analgesics', 1),
(29, 'Antipyretics', 1),
(30, ' Bronchodilators', 1),
(31, 'Corticosteroids', 2),
(32, 'Diuretics', 1),
(33, 'Immunosuppressants', 1),
(34, 'Proton Pump Inhibitors', 1),
(35, 'Statins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `role`, `avatar`) VALUES
(1, 'Afsana', 'Akther', 'afsana@gmail.com', 'afsana', '01752477210', 'manager', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_type`
--

CREATE TABLE `medicine_type` (
  `id` int(10) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `type_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_type`
--

INSERT INTO `medicine_type` (`id`, `type_name`, `type_status`) VALUES
(1, 'Food', '1'),
(2, 'Baby Care', '2'),
(3, 'Personal Care', '2'),
(4, 'Pet Care', '1'),
(21, 'Home & Kitchen', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `tax` decimal(10,2) DEFAULT 0.00,
  `net_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `total_amount`, `discount`, `tax`, `net_total`) VALUES
(1, '2024-12-08 14:33:14', 0.00, 0.00, 0.00, 0.00),
(2, '2024-12-08 14:40:32', 0.00, 0.00, 0.00, 0.00),
(3, '2024-12-08 15:19:03', 11800.00, 1770.00, 501.50, 10531.50),
(4, '2024-12-08 15:23:32', 350.00, 24.50, 9.77, 335.27),
(5, '2024-12-11 13:34:56', 250.00, 0.00, 0.00, 250.00),
(6, '2024-12-11 13:44:58', 250.00, 15.00, 7.05, 242.05),
(7, '2024-12-11 14:31:02', 10.60, 0.74, 0.39, 10.25),
(8, '2025-01-10 15:36:25', 0.00, 0.00, 0.00, 0.00),
(9, '2025-01-10 15:42:35', 1.00, 0.00, 0.00, 1.00),
(10, '2025-01-10 16:06:06', 31.00, 0.00, 0.00, 31.00),
(11, '2025-01-13 03:06:30', 4.90, 0.00, 0.00, 4.90),
(12, '2025-01-13 03:08:27', 4.90, 0.00, 0.00, 4.90);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `subtotal`) VALUES
(1, 3, 1, 100, 10000.00),
(2, 3, 3, 12, 1800.00),
(3, 4, 1, 2, 200.00),
(4, 4, 3, 1, 150.00),
(5, 5, 1, 1, 100.00),
(6, 5, 3, 1, 150.00),
(7, 6, 1, 1, 100.00),
(8, 6, 3, 1, 150.00),
(9, 7, 1, 4, 4.00),
(10, 7, 3, 2, 3.00),
(11, 7, 4, 3, 3.60),
(12, 9, 1, 1, 1.00),
(13, 10, 1, 1, 1.00),
(14, 10, 6, 1, 10.00),
(15, 10, 7, 1, 20.00),
(16, 11, 1, 1, 1.00),
(17, 11, 3, 1, 1.50),
(18, 11, 4, 2, 2.40),
(19, 12, 1, 1, 1.00),
(20, 12, 3, 1, 1.50),
(21, 12, 4, 2, 2.40);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`) VALUES
(1, 'Milk', 1.00, 92),
(3, 'Egg', 1.00, 90),
(4, 'Sugear', 1.20, 93),
(6, 'Meat', 10.00, 99),
(7, 'Fish', 20.00, 49),
(8, 'Rice', 5.00, 200),
(9, 'Atta', 1.00, 500),
(10, 'Potato', 1.00, 200),
(11, 'Dal', 1.50, 200),
(12, 'Salt', 1.00, 100),
(13, 'Onion', 1.50, 150),
(14, 'Maggi', 1.00, 50),
(15, 'Baby Food', 1.00, 40),
(16, 'Pet food', 2.00, 30),
(17, 'Diapers', 1.00, 100),
(18, 'Edible Oil', 2.00, 300);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `net_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `company`, `mobile_number`, `email`, `address`, `city`, `state`, `created_at`) VALUES
(1, 'Munna', 'Pure', '0211456415644', 'munna@gmail.com', 'Mirpur, dhaka-1207.', 'Dhaka', 'Dhaka', '2025-01-13 06:14:10'),
(2, 'Rajib', 'Prun', '015478245', 'rajib@gmail.com', 'Mirpur-2, dhaka-1207.', 'Dhaka', 'Dhaka', '2025-01-13 06:19:43'),
(3, 'Rajib', 'Prun', '015478245', 'rajib@gmail.com', 'Mirpur-2, dhaka-1207.', 'Dhaka', 'Dhaka', '2025-01-13 06:20:15'),
(4, 'Rajib Hossain', 'PrunXL', '0136547869', 'rajib12@gmail.com', 'Mirpur, dhaka-1207.', 'Dhaka', 'Dhaka', '2025-01-13 06:25:27'),
(5, 'Rajib Hossain', 'PrunXL', '0136547869', 'rajib12@gmail.com', 'Mirpur, dhaka-1207.', 'Dhaka', 'Dhaka', '2025-01-13 06:29:14'),
(6, 'Rajib Hossain', 'PrunXL', '0136547869', 'rajib12@gmail.com', 'Mirpur, dhaka-1207.', 'Dhaka', 'Dhaka', '2025-01-13 06:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_type`
--
ALTER TABLE `medicine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine_type`
--
ALTER TABLE `medicine_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
