-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 12:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kost`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `payment_type`, `payment_status`) VALUES
(1, 9, 9, '2024-07-05', '2024-07-05', 'Credit Card', 'Pending'),
(2, 9, 9, '2024-07-05', '2024-07-08', 'Credit Card', 'Pending'),
(3, 9, 3, '2024-07-05', '2024-07-07', 'Credit Card', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available_rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `price`, `available_rooms`) VALUES
(1, 'Kamar A', 'Kamar dengan fasilitas lengkap', 1000000.00, 11),
(2, 'Kamar B', 'Kamar dengan fasilitas standar', 750000.00, 3),
(3, 'Kamar ekonomis', 'Kamar ekonomis kamar mandi dalam', 500000.00, 3),
(4, 'King Room', 'fasilitas wah', 3000000.00, 3),
(5, 'Kost Alcyone', 'Jl. Nebula No.1 Fasilitas:Kamar Mandi Dalam, Ac,Tv, Dapur Dalam\r\n\r\n', 1200000.00, 4),
(9, 'Kost Pollux', 'Jl. Galaxi No.3 Fasilitas:\r\nKamar Mandi Dalam, Ac,Tv', 900000.00, 2),
(12, 'King', 'ini kost berrpa by u', 2000000.00, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `status`) VALUES
(1, 'admin', '$2y$10$xcxeTBQd0UAzmI0rFI2rK.zrtT6OFTk6rw8Q9TPc675ebG45ik3XS', '', 'admin'),
(3, 'tes', '$2y$10$eYMuiaIOZvJilWoJJThfVuUq8P/mGJ3p5jFEKoOVXSZFCaQPuovuW', 'tes@gmail.com', 'user'),
(5, '123', '$2y$10$8h3E4jkI62bRerjQKcymMuJGWxNRtkt07Ya2WxR/UUjySAbe5nTJO', '123@gmail.com', 'user'),
(7, 'user', '$2y$10$DLJX/8yNCaR3y4KfgAX...4p02C973frHTwXdKbZdwHOVjimAKGdu', 'user@gmail.com', 'user'),
(9, 'caca', '$2y$10$IG0NQBYoWczxqOKCmvPrseZFuawiUsxRg8Ubh8kYdcKEJNeKaB/.W', 'caca@gmail.com', 'user'),
(10, 'admin newbie', '$2y$10$mGR4ACJNQoWcK/1CEm8UQ.MHBi3NDolo6jLqJHrhiXUygX.FfrphG', 'adminnewbie@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
