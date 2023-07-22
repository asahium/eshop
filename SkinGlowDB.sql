-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2022 at 01:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SkinGlowDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `session_uniqeID` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `psize` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `ptype` text NOT NULL,
  `pdesc` text NOT NULL,
  `img` text NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pname`, `psize`, `price`, `ptype`,`pdesc`, `img`, `stock`) VALUES
(1, 'BEACH BREEZE', '200 ml', 11.99, 'some type', 'Treat yourself to a summer paradise in your own home! Our Beach Breeze Slime features two textures of slime – jelly slime and butter slime for the perfect puffy texture once mixed! Plus, the beach theme is completed with sea shell charm & pool float charm! Scented carribean dream, a tropical fruit fragrance!', '1.jpg', 100),
(2, 'SPACE CUBES', '200 ml', 11.99, 'some type', 'Treat yourself to a truly out of this world experience with Space Cubes! Our jelly cube clear slime provides a cool color shifting effect with its purple, red, and blue hues - so its like traveling through a galaxy of stars every time you play! Plus, jelly cubes and an astronaut charm provide a perfect cosmic topping!', '2.jpg', 100),
(3, 'SHARK GUMMY', '300 ml', 12.99, 'some type', 'Say hello to Shark Gummy! Clear blue slime swirled with white ice-cream textured slime for extra waves of fun. Indulge in play with the unique texture & scented blue razz gummy scent! Mixes into an ultra soft cloud creme / jelly texture! Bring on the shark-tastic adventure!', '3.jpg', 100),
(4, 'SOLAR ECLIPSE', '300 ml', 12.99, 'some type', 'Step into the dark and explore the dazzling world of the Solar Eclipse! Our unique Slime is avalanche clear, with a delicious scent of cherry and a super bright amber clear slime topped with red/white thick slime that will avalanche down. Perfect for a truly out-of-this-world experience!', '4.jpg', 100),
(5, 'FLUFFY PINK CANDY', '250 ml', 11.99, 'some type', 'Bring some sweetness into your life with Fluffy Pink Candy! This irresistibly scented berry candy slime is light and airy and its super smooth butter texture will make you want to keep squeezing and stretching it! Get ready for a delicious, sugar-coated sensory experience!', '5.jpg', 100),
(6, 'BANANA CREAM PIE', '200 ml', 10.99, 'some type', 'Super crunchy full floam slime with a thick base. Makes super good bubble pops and smells just like banana cream pie!\n\nLarge banana fimo slices throughout.', '6.jpg', 100),
(7, 'MANGO DRAGONFRUIT REFRESHER', '300 ml', 12.99, 'some type','Thick and holdable fishbowl slime made after my favorite drink! Magenta colored fishbowl beads and black glitters throughout!', '7.jpg', 100),
(8, 'LAVENDER DREAMS MEMORYDOUGH', '250 ml', 11.99, 'some type', 'By popular request— here is lavender dreams memoryDOUGH! My signature texture that everybody loves, super thick clay heavy slime, perfect for squeezing, holding, and despite being clay heavy it inflates & makes super satisfying sizzles. Scented with 100% grade lavender essential oil, super relaxing scent which makes the memoryDOUGH experience even better 🤩', '8.jpg', 100),
(9, 'ASTRONAUT ICE-CREAM', '200 ml', 10.99, 'some type', 'Tri-colored layered ice-cream textured slime! Topped with jumbo star charm & has a soft, dreamy and stretchy texture. Mixes into a soft violet color and is scented just like blue razz ice cream -- a sweet berry scent!', '9.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `bday` date NOT NULL,
  `country` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
