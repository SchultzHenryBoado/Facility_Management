-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 07:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facility_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_code`, `company_name`) VALUES
(1, 'OBN', 'Obanana Corp.'),
(2, 'PMI', 'Premium Megastructures Inc.'),
(3, 'PIVI', 'Premium Infinite Ventures Inc.');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `facility_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_code`, `facility_name`) VALUES
(1, 'BSKTBLLRM', 'Basketball Room'),
(4, 'MTNGRM', 'Meeting Room'),
(5, 'BRDRM', 'Board Room'),
(6, 'VLLYBLLRM', 'Volleyball Room');

-- --------------------------------------------------------

--
-- Table structure for table `facility_room_masters`
--

CREATE TABLE `facility_room_masters` (
  `id` int(11) NOT NULL,
  `facility_type` varchar(255) NOT NULL,
  `facility_number` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `floor_location` varchar(255) NOT NULL,
  `max_capacity` varchar(255) NOT NULL,
  `statuses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_room_masters`
--

INSERT INTO `facility_room_masters` (`id`, `facility_type`, `facility_number`, `descriptions`, `floor_location`, `max_capacity`, `statuses`) VALUES
(1, 'Board Room', 'BR-1', 'Board Room No.1', '15th floor', '20', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `floor_code` varchar(255) NOT NULL,
  `floor_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `floor_code`, `floor_name`) VALUES
(1, '15F', '15th floor'),
(3, '16F', '16th floor'),
(4, '17F', '17th floor');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT current_timestamp(),
  `rsvn_no` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `time_from` time(6) NOT NULL,
  `time_to` time(6) NOT NULL,
  `statuses` varchar(255) NOT NULL,
  `cancel_reasons` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `users_id`, `created_date`, `rsvn_no`, `created_by`, `room_type`, `date_from`, `date_to`, `time_from`, `time_to`, `statuses`, `cancel_reasons`) VALUES
(5, 2, '2022-12-19', '3123', 'Gloda, John Bryan', ' Volleyball Room', '2022-12-20', '2022-12-20', '17:30:00.000000', '18:00:00.000000', 'APPROVED', 'NO INFO'),
(6, 1, '2022-12-19', '12321', 'Boado, Schultz Henry', '', '2022-12-20', '2022-12-20', '00:00:00.000000', '00:00:00.000000', 'PENDING', 'asdasdasdad'),
(7, 1, '2022-12-20', 'assadasd', 'Boado, Schultz Henry', ' Meeting Room', '2022-12-20', '2022-12-20', '15:14:00.000000', '13:30:00.000000', 'REJECT', 'Wrong time'),
(14, 1, '2022-12-20', '', 'Boado, Schultz Henry', '', '0000-00-00', '0000-00-00', '00:00:00.000000', '00:00:00.000000', 'PENDING', ''),
(15, 1, '2022-12-20', '', 'Boado, Schultz Henry', '', '0000-00-00', '0000-00-00', '00:00:00.000000', '00:00:00.000000', 'PENDING', ''),
(16, 1, '2022-12-20', '', 'Boado, Schultz Henry', '', '0000-00-00', '0000-00-00', '00:00:00.000000', '00:00:00.000000', 'PENDING', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_accounts`
--

CREATE TABLE `users_accounts` (
  `id` int(11) NOT NULL,
  `last_names` varchar(255) NOT NULL,
  `first_names` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `statuses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_accounts`
--

INSERT INTO `users_accounts` (`id`, `last_names`, `first_names`, `username`, `company`, `emails`, `passwords`, `statuses`) VALUES
(1, 'Boado', 'Schultz Henry', 'henryboado', 'Obanana Corp.', 'schultzhenry.boado@obanana.com', '202cb962ac59075b964b07152d234b70', 'ACTIVE'),
(2, 'Gloda', 'John Bryan', 'bryangloda', 'Premium Megastructures Inc.', 'bryan.gloda@obanana.com', '202cb962ac59075b964b07152d234b70', 'ACTIVE'),
(3, 'Mangalo', 'Ryan Christian', 'ryanmangalo', 'Obanana Corp.', 'ryan.mangalo@obanana.com', '202cb962ac59075b964b07152d234b70', 'ACTIVE'),
(8, 'Matias', 'Ryan', 'ryanmatias', 'Obanana Corp.', 'ryan.matias@obanana.com', '57f231b1ec41dc6641270cb09a56f897', 'INACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility_room_masters`
--
ALTER TABLE `facility_room_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`users_id`);

--
-- Indexes for table `users_accounts`
--
ALTER TABLE `users_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `facility_room_masters`
--
ALTER TABLE `facility_room_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_accounts`
--
ALTER TABLE `users_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`users_id`) REFERENCES `users_accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
