-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 03:45 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saloni`
--

-- --------------------------------------------------------

--
-- Table structure for table `salon`
--

CREATE TABLE `salon` (
  `user` int(5) NOT NULL,
  `id` int(7) NOT NULL,
  `salonname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon`
--

INSERT INTO `salon` (`user`, `id`, `salonname`, `address`, `category`) VALUES
(1, 0, 'Hairlovers', 'Gracanicka 9, Beograd', 'zenski frizer'),
(2, 0, 'Unicut hair salon', 'Kondina 26, Beograd', 'zenski frizer'),
(0, 0, 'Blow Hair Studio', 'Nemanjina 40, Beograd', 'muski i zenski fizer'),
(0, 0, 'Berber', 'Karamatina 37, Beograd', 'muski frizer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `username`, `contact`, `email`, `password`) VALUES
(1, 'Nikola', 'Nikolic', 'nikola', '0601111222', 'nikolanikolic@gmail.com', 'nikola12345'),
(1, 'Nikola', 'Nikolic', 'nikola', '0601111222', 'nikolanikolic@gmail.com', 'nikola12345'),
(2, 'Jovana', 'Jovanic', 'jovana', '0651234567', 'jovanajovanic@gmail.com', 'jovana12345'),
(2, 'Jovana', 'Jovanic', 'jovana', '0651234567', 'jovanajovanic@gmail.com', 'jovana12345');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
