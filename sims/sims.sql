-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 11, 2026 at 11:44 PM
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
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `matric` varchar(50) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `matric`, `department`, `created_at`, `photo`) VALUES
(16, 'Adebori Ayomide Daniel', 'eL/24/0164', 'Computer Science ', '2026-05-01 22:00:26', 'daniel.jpeg'),
(17, 'Monilari Oluwatimilehin Jeremiah', 'eL/24/0185', 'Computer Science ', '2026-05-01 22:06:14', 'lari.jpeg'),
(18, 'Ojo Opeyemi Gideon', 'eL/24/0191', 'Computer Science ', '2026-05-01 22:09:20', 'barnabas-lartey-odoi-tetteh-_86aPBb68os-unsplash.jpg'),
(19, 'Faith Ogbonna', 'eL/24/0245', 'Computer Science ', '2026-05-01 22:10:49', 'christopher-campbell-rDEOVtE7vOs-unsplash.jpg'),
(20, 'Isaac Akpoborie', 'eL/25/0430', 'Computer Science ', '2026-05-01 22:14:50', 'hamza-sakrani-ieQSQhN7KP0-unsplash.jpg'),
(21, 'Osude Adeola', 'eL/24/0195', 'Computer Science ', '2026-05-01 22:16:16', 'ayo-ogunseinde-6W4F62sN_yI-unsplash.jpg'),
(22, 'Olorunwa Ayomide', 'eL/24/0192', 'Computer Science ', '2026-05-01 22:20:23', 'charlie-green-3JmfENcL24M-unsplash.jpg'),
(23, 'Odutola Ayodele Emmanuel ', 'eL/24/0234', 'Computer Science ', '2026-05-03 03:05:42', 'Killer bean unleashed 1.jpg'),
(24, 'Emmanuel Grace Chizurum', 'eL/24/0252', 'Computer Science ', '2026-05-03 03:08:36', 'aiony-haust-3TLl_97HNJo-unsplash.jpg'),
(26, 'Adesina Israel Oluwapelumi', 'eL/24/0168', 'Computer Science ', '2026-05-08 17:32:28', 'israel.jpeg'),
(27, 'Adebori Ayomide Daniel ', 'eL/24/0164', 'computer science ', '2026-05-10 19:37:30', 'daniel.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
