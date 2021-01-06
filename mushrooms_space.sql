-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 06, 2021 at 12:54 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mushrooms_space`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ukr_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `ukr_name`) VALUES
(1, 'edible', 'Їстівні гриби'),
(2, 'poisonous', 'Ядовиті гриби');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_goods`
--

CREATE TABLE `order_goods` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ukr_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `ukr_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `price`, `ukr_name`, `image`, `description`) VALUES
(1, 'amanita', 2, 270, 'Мухомор червоний', 'amanita.jpg', 'Плодове тіло містить ряд токсичних сполук, деякі з яких мають психотропний ефект. Токсичні і психоактивні речовини добре розчиняються в гарячій воді, і вживання грибів, відварених в декількох водах, призводить до менш сильного отруєння. Однак, зміст отрут в плодових тілах може сильно варіювати, що робить вживання мухоморів в їжу небезпечним'),
(2, 'panther', 2, 290, 'Мухомор пантерний', 'panther.jpg', 'Сильно отруйний. Утворює мікоризу з багатьма деревами, зустрічається в хвойних, змішаних і широколистяних лісах, часто під сосною, дубом, буком, вважає за краще лужні грунту. Широко поширений в помірному кліматі Північної півкулі'),
(3, 'kingbolete', 1, 330, 'Білий гриб', 'kingbolete.jpg', 'Класичний вид, який в народі прозвали «полковником» - вшановуючи найголовнішим і кращим з родичів. Каштаново-коричнева капелюшок опукла, потім плоско-опукла, подушковидна, рідко розпростерта, досягає діаметра 25-30 см. Відомі гігантські представники - з діаметром капелюшка до 45 см і вагою до 2-3 кг. Поверхня гладка, іноді нерівна, борозниста мул'),
(4, 'leccinum', 1, 320, 'Красноголовець', 'leccinum.jpg', 'Плодоносить частіше поодинці. Поширений в північній помірній зоні. Сезон червень - вересень, іноді до пізньої осені. Їстівний'),
(5, 'chanterelle', 1, 370, 'Лисичка', 'chanterelle.jpg', 'Добре відомий їстівний гриб, високо цінується, годиться для вживання в будь-якому вигляді. Утворює мікоризу з різними деревами, найбільш часто з ялиною, сосною, дубом, буком'),
(6, 'pax', 2, 260, 'Свинушка', 'pax.jpg', 'До 1981 року цей гриб вважався умовно їстівним і відносився до 4-ї категорії по харчовим якостям. В даний час віднесений до отруйних, хоча симптоми отруєння проявляються не завжди і / або не відразу. Містить токсини (лектини), не руйнуються навіть при багаторазовому відварювання');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_goods`
--
ALTER TABLE `order_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_goods`
--
ALTER TABLE `order_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_goods`
--
ALTER TABLE `order_goods`
  ADD CONSTRAINT `order_goods_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_goods_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
