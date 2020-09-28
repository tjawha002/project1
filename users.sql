-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2020 at 05:25 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `q1` varchar(100) NOT NULL,
  `q2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `fname`, `lname`, `password`, `q1`, `q2`) VALUES
('abc@yahoo.com', 'Abdulrahman', 'Alharbi', '$2y$10$9qCfLXu5.HqjWhlPDdhRUOLN9zX9EH3axtPf8LZy4CN1ClHKB8K8.', 'Ali', 'Jazan'),
('ahmed@hotmail.com', 'Ahmed', 'Ali', '$2y$10$S98qo20NvE768vF9ihnSjO2o5Wm73WzMTg/ZbiGC0ar/hVj4WZcpC', 'Java', 'Html'),
('mt@hotmail.com', 'Maya', 'Tariq', '$2y$10$sfJt.ayHlHuzRP0TSgKWeOFVhvw4YrZpqTlL0rrbmgueOZ.KYT7yW', 'Tariq', 'Jazan'),
('tariq@gmail.com', 'Tariq', 'Jowhari', '$2y$10$uS2rj3Akxjvssjz3I0UVb.HwuaxPtsfKmS.wjOOuGP/VkcYdCWBoS', 'Ahmed', 'Jazan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
