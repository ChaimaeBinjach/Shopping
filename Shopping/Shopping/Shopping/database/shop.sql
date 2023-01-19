-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 09:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(150) NOT NULL,
  `quantity` int(150) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(2, 10, 'Twilight', 25, 1, 'twilight.jpg'),
(3, 10, 'One Day', 15, 1, 'oneday.jfif'),
(4, 10, 'Le secret', 11, 1, 'leSecret.jfif'),
(5, 8, 'Twilight', 26, 1, 'twilight.jpg'),
(6, 8, 'Rumpelstiltskin', 12, 1, 'ca42957a54af6d88ad93562a19661f2f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `number` varchar(30) NOT NULL,
  `message` varchar(550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 8, 'Chaimae\r\n', 'chaimaa@gmail.com', '3', 'heyooo Shiny as always'),
(2, 8, 'Chaimae Binjach', 'binjachchaimaa@gmail.com', '', 'aqwsdfghm'),
(3, 10, 'Chaimae ', 'binjach@gmail.com', '', 'hjnjasjnsj');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(150) NOT NULL,
  `user_id` int(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(150) NOT NULL,
  `placed_on` varchar(60) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(1, 123456, 'Shimi Shimi', '3', 'shimi@gmail.com', 'cash on delivery', 'boszorkany ut2', '3', 50, '2april 2023', 'completed'),
(2, 23414, 'ShoSho', '4', 'shosho1@gmail.com', 'cash on delivery', 'ddgggrtr 44', '', 60, '2 feb 2023', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(150) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(9, 'Harry Potter', 17, 'harrypotter.png'),
(11, 'Le secret', 11, 'leSecret.jfif'),
(12, 'Twilight', 26, 'twilight.jpg'),
(13, 'One Day', 15, 'oneday.jfif'),
(14, 'Rumpelstiltskin', 12, 'ca42957a54af6d88ad93562a19661f2f.jpg'),
(15, 'Red Queen', 13, 'e5618762d62fcdb5541044d406f3330b.jpg'),
(16, 'Vampire', 16, '838dec51d9f16eed61ab40bd50c73b8d.jpg'),
(17, 'Cendrillon', 19, 'b3ec0fb78091ba23ea400f41e6aede10.jpg'),
(18, 'Antigone', 14, '2eaef2b01764d7903ad6807165d73a10.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(111) NOT NULL,
  `name` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `password` varchar(111) NOT NULL,
  `user_type` varchar(25) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(8, 'Chaimae', 'chaimaa@gmail.com', '$2y$10$jDfcLT0LcH3jvsWbsXhHd.Kdx9kqLmepVFzjwXqGrh4Tu32Y7SVO.', 'user'),
(10, 'ShinyShimi', 'shiny11@gmail.com', '$2y$10$KK.QDNG1/RlAGe5xPgCldeGpH6DLbGihW9YFvu0xQK7qzNWc15ic6', 'admin'),
(14, 'shosho', 'sho@gmail.com', '$2y$10$8/JmsQ5BhARpnpUEAZ1bpemZJoMzBGL1Sh.f8e9L2CAyE20AO2uHe', 'user'),
(24, 'hello', 'hello@gmail.com', '$2y$10$JJ.EgS/AWIjONNzGqZ8XFebmc49ctqpHWqY.nU0oj/1pIX5U8Gy9W', 'user'),
(27, 'shimi', 'shimi@gmail.com', '$2y$10$5YuE/r1p7pSKxm6ja7l4AO4O.U30AUmyq7cFYiaR66/Vl02z7GqzO', 'admin'),
(28, 'hihi', 'hihi@gmail.com', '$2y$10$DFu3jXBKYdC/VmrqYBY24uvUOxiHGH62TI376htfITiMwDEmHrU5u', 'user'),
(29, 'hel', 'hel@gmail.com', '$2y$10$tdpfRHE8DCdgt52nwpf6g.r5H9CK2L2oe3uDywNlurdwV.KbFADiK', 'user'),
(30, 'hhh', 'hhh@gmail.com', '$2y$10$dll36Kemgbz13ABRkDsFKOYSx0rwNlFsbYykNKhhrk6XMaV9h708i', 'admin'),
(31, 'dita', 'dita@gmail.com', '$2y$10$P6zcGroH4.GtoZgqpXm.GOySt.K7qyAJxya7s3rvsWPehk9ToZS9W', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
