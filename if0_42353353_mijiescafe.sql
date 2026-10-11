-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql104.infinityfree.com
-- Generation Time: Jul 12, 2026 at 12:19 PM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42353353_mijiescafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `custName` varchar(100) NOT NULL,
  `custPhoneNo` varchar(20) NOT NULL,
  `custEmail` varchar(100) NOT NULL,
  `custUsername` varchar(50) NOT NULL,
  `custProfilePic` varchar(255) DEFAULT NULL,
  `custPassword` varchar(255) NOT NULL,
  `custAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `custName`, `custPhoneNo`, `custEmail`, `custUsername`, `custProfilePic`, `custPassword`, `custAddress`) VALUES
(1, 'Ali Hakim', '0121111111', 'alihakim@gmail.com', 'alihakim', NULL, '123', 'No. 5, Jalan Sultanah, 80000 Johor Bahru, Johor'),
(2, 'Siti Nurain', '0122457800', 'sitinurain@gmail.com', 'siti', NULL, '123', 'Lot 12, Kampung Melayu Majidee, 81100 Johor Bahru, Johor'),
(3, 'Muhammad Danish', '0123333333', 'danish@gmail.com', 'danish', NULL, '123', 'No. 43, Taman Mount Austin, 81100 Johor Bahru, Johor'),
(4, 'Nurul Aisyah', '0124444444', 'nurulaisyah@gmail.com', 'aisyah', NULL, '123', 'No. 11, Jalan Setia Tropika, 81200 Johor Bahru, Johor'),
(7, 'Muhamad Salam Bin Salim', '01427479880', 'salam12@gmail.com', 'salam', NULL, '123', '241B Jalan Lembah Bujang, Bedong, 08100, Sungai Petani, Kedah'),
(8, 'Nurul Afiqah binti Amran', '01129035223', '2024425044@student.uitm.edu.my', 'Afiqah', NULL, '123', 'No 12, Jalan Ria, 06100, Sungai Petani, Kedah');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(100) NOT NULL,
  `menuPrice` decimal(10,2) NOT NULL,
  `menuDetails` varchar(50) NOT NULL,
  `menuStatus` varchar(50) NOT NULL DEFAULT 'Available',
  `menuImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `menuName`, `menuPrice`, `menuDetails`, `menuStatus`, `menuImage`) VALUES
(1, 'Roti bakar', '2.00', 'Breakfast', 'Out of Stock', 'breakfast1.jpeg'),
(2, 'Roti canai', '1.50', 'Breakfast', 'Out of Stock', 'breakfast2.jpeg'),
(3, 'Nasi goreng', '5.00', 'Breakfast', 'Out of Stock', 'breakfast3.jpeg'),
(4, 'Mihun goreng', '5.00', 'Breakfast', 'Available', 'breakfast4.jpeg'),
(5, 'Mee goreng', '5.00', 'Breakfast', 'Available', 'breakfast5.jpeg'),
(6, 'Macaroni goreng', '5.00', 'Breakfast', 'Available', 'breakfast6.jpeg'),
(7, 'Nasi lemak', '3.50', 'Breakfast', 'Available', 'breakfast7.jpeg'),
(8, 'Kue toew goreng', '5.00', 'Breakfast', 'Available', 'breakfast10.jpeg'),
(9, 'Nasi putih + ayam masak merah', '7.00', 'Lunch', 'Available', 'lunch1.jpeg'),
(10, 'Nasi putih + kari ayam', '7.00', 'Lunch', 'Available', 'lunch2.jpeg'),
(11, 'Nasi putih + ayam masak lemak', '7.00', 'Lunch', 'Available', 'lunch3.jpeg'),
(12, 'Nasi putih + ayam goreng kunyit', '7.00', 'Lunch', 'Available', 'lunch4.jpeg'),
(13, 'Nasi putih + ayam paprik', '7.00', 'Lunch', 'Available', 'lunch5.jpeg'),
(14, 'Nasi putih + ayam kicap', '7.00', 'Lunch', 'Available', 'lunch6.jpeg'),
(15, 'Nasi putih + ayam buttermilk', '8.00', 'Lunch', 'Available', 'lunch7.jpeg'),
(16, 'Nasi putih + ayam berempah', '8.00', 'Lunch', 'Available', 'lunch8.jpeg'),
(17, 'Fresh orange', '2.00', 'Drink', 'Available', 'drink1.jpeg'),
(18, 'Sirap ais', '1.50', 'Drink', 'Available', 'drink2.jpeg'),
(19, 'Teh ais', '2.00', 'Drink', 'Available', 'drink3.jpeg'),
(20, 'Teh o ais', '1.50', 'Drink', 'Available', 'drink4.jpeg'),
(21, 'Milo ais', '2.00', 'Drink', 'Available', 'drink5.jpeg'),
(22, 'Green tea', '3.00', 'Drink', 'Available', 'drink7.png'),
(23, 'Lemon tea', '2.00', 'Drink', 'Available', 'drink9.jpeg'),
(24, 'Bandung', '2.00', 'Drink', 'Available', 'drink10.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDetail` text DEFAULT NULL,
  `orderType` varchar(50) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `orderDate` date NOT NULL,
  `orderStatus` varchar(50) NOT NULL DEFAULT 'Preparing',
  `custID` int(11) DEFAULT NULL,
  `staffID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDetail`, `orderType`, `totalPrice`, `orderDate`, `orderStatus`, `custID`, `staffID`) VALUES
(1, 'Customer: john (01129033851)\nItems: Roti Bakar x1', '', '0.00', '2026-05-17', 'Completed', NULL, NULL),
(2, 'Customer: afiqah (01129033851)\nCustomer: afiqah (01129033851)\nItems: Roti Bakar x1, Pakej A (Nasi lemak + Milo ais) x3', '', '0.00', '2026-05-19', 'Preparing', NULL, NULL),
(3, 'Customer: afiqah (01129033851)\nCustomer: afiqah (01129033851)\nItems: Roti Bakar x1, Pakej B (Nasi ayam berempah + Teh o ais) x1', '', '0.00', '2026-05-19', 'Pending', NULL, NULL),
(4, 'Customer: afiqah (01129033851)\nCustomer: afiqah (01129033851)\nItems: Roti Bakar x1\nType: Take Away', '', '0.00', '2026-05-19', 'Preparing', NULL, NULL),
(5, 'Customer: afiqah (01129033851)\nCustomer: afiqah (01129033851)\nItems: Roti Bakar x1\nType: Dine-In', '', '0.00', '2026-05-19', 'Preparing', NULL, NULL),
(6, 'Customer: john (01129033851)\nItems: Mee goreng x1\nType: Take Away', 'Take Away', '0.00', '2026-06-13', 'Ready', NULL, NULL),
(7, '', 'Dine-In', '0.00', '2026-06-23', 'Ready', NULL, NULL),
(8, '', 'Dine-In', '0.00', '2026-06-23', 'Ready', NULL, NULL),
(9, '', 'Dine-In', '0.00', '2026-06-23', 'Ready', NULL, NULL),
(10, 'Customer: Siti Nurain (0122222222)\r\nItems: Mihun goreng x1, Macaroni goreng x1\r\nType: Dine-In', 'Dine-In', '10.00', '2026-07-02', 'Completed', 2, NULL),
(11, 'Customer: Siti Nurain (0122222222)\r\nItems: Mihun goreng x1, Kue toew goreng x1, Sirap ais x1\r\nType: Take Away', 'Take Away', '11.50', '2026-07-02', 'Ready', 2, NULL),
(12, 'Customer: Siti Nurain (0122222222)\r\nItems: Mihun goreng x1, Green tea x1\r\nType: Take Away', 'Take Away', '8.00', '2026-07-02', 'Ready', 2, NULL),
(13, 'Customer: Siti Nurain (0122222222)\r\nItems: Mihun goreng x1\r\nType: Dine-In', 'Dine-In', '5.00', '2026-07-02', 'Ready', 2, NULL),
(14, 'Customer: Siti Nurain (0122222222)\r\nItems: Mihun goreng x1\r\nType: Dine-In', 'Dine-In', '5.00', '2026-07-02', 'Preparing', 2, NULL),
(15, 'Customer: john (01129033851)\r\nItems: Kue toew goreng x1\r\nType: Take Away', 'Take Away', '5.00', '2026-07-07', 'Ready', NULL, NULL),
(16, 'Customer: john (01129033851)\r\nItems: Mihun goreng x1\r\nType: Take Away', 'Take Away', '5.00', '2026-07-07', 'Preparing', NULL, NULL),
(17, 'Customer: john (01129033851)\r\nItems: Nasi goreng x1\r\nType: Take Away', 'Take Away', '5.00', '2026-07-07', 'Preparing', NULL, NULL),
(18, 'Customer: john (01129033851)\r\nItems: Mihun goreng x1, Macaroni goreng x1\r\nType: Take Away', 'Take Away', '10.00', '2026-07-07', 'Preparing', NULL, NULL),
(19, 'Customer: Siti Nurain (0122457800)\r\nItems: Macaroni goreng x1\r\nType: Take Away', 'Take Away', '5.00', '2026-07-07', 'Completed', 2, NULL),
(20, 'Customer: Siti Nurain (0122457800)\r\nItems: Mihun goreng x1, Mee goreng x1, Teh ais x1\r\nType: Dine-In', 'Dine-In', '12.00', '2026-07-07', 'Completed', 2, NULL),
(21, 'Customer: Siti Nurain (0122457800)\r\nItems: Mee goreng x1\r\nType: Take Away', 'Take Away', '5.00', '2026-07-07', 'Preparing', 2, NULL),
(22, 'Customer: salam (01129033851)\r\nItems: Macaroni goreng x1\r\nType: Take Away', 'Take Away', '5.00', '2026-07-07', 'Preparing', NULL, NULL),
(23, 'Customer: Nurul Afiqah binti Amran (01129033442)\r\nItems: Mihun goreng x1, Nasi putih + ayam goreng kunyit x1, Fresh orange x1\r\nType: Dine-In', 'Dine-In', '14.00', '2026-07-07', 'Ready', 8, NULL),
(24, 'Customer: Muhamad Salam Bin Salim (01427479886)\r\nItems: Macaroni goreng x1\r\nType: Dine-In', 'Dine-In', '5.00', '2026-07-07', 'Preparing', 7, NULL),
(25, 'Customer: Siti Nurain (0122457800)\r\nItems: Roti bakar x1, Fresh orange x1\r\nType: Dine-In', 'Dine-In', '3.00', '2026-07-10', 'Preparing', 2, NULL),
(26, 'Customer: john (01129033851)\r\nItems: Roti bakar x1\r\nType: Take Away', 'Take Away', '1.00', '2026-07-11', 'Completed', NULL, NULL),
(27, 'Customer: Muhamad Salam Bin Salim (01427479886)\r\nItems: Mihun goreng x1\r\nType: Dine-In', 'Dine-In', '5.00', '2026-07-11', 'Ready', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_menu`
--

CREATE TABLE `order_menu` (
  `orderID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_package`
--

CREATE TABLE `order_package` (
  `orderID` int(11) NOT NULL,
  `packageID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `packageID` int(11) NOT NULL,
  `packageName` varchar(100) NOT NULL,
  `packageDetail` text DEFAULT NULL,
  `packagePrice` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Available',
  `packageImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`packageID`, `packageName`, `packageDetail`, `packagePrice`, `status`, `packageImage`) VALUES
(1, 'Package A', 'Nasi lemak + Milo ais', '5.00', 'Out of Stock', 'A.jpeg'),
(2, 'Package B', 'Nasi ayam berempah + Teh o ais', '8.00', 'Available', 'B.jpeg'),
(3, 'Package C', 'Nasi ayam buttermilk + Fresh orange', '8.00', 'Available', 'C.jpeg'),
(4, 'Package D', 'Nasi ayam masak lemak + Bandung', '7.00', 'Available', 'D.jpeg'),
(5, 'Package E', 'Nasi ayam paprik + Teh ais', '7.00', 'Available', 'E.jpeg'),
(6, 'Package F', 'Nasi ayam goreng kunyit + Sirap ais', '7.00', 'Out of Stock', 'F.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentProof` varchar(255) DEFAULT NULL,
  `paymentDate` date NOT NULL,
  `paymentAmount` decimal(10,2) NOT NULL,
  `orderID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentProof`, `paymentDate`, `paymentAmount`, `orderID`) VALUES
(2, 'Paid via Cash', '2026-05-17', '1.50', 1),
(3, 'Paid via Cash', '2026-05-19', '16.50', 2),
(4, 'Paid via Cash', '2026-05-19', '9.50', 3),
(5, 'Paid via Cash', '2026-05-19', '1.50', 4),
(6, 'Paid via Cash', '2026-06-13', '5.00', 6),
(7, 'Paid via Cash', '2026-06-23', '0.00', 7),
(8, 'Paid via Cash', '2026-06-23', '0.00', 8),
(9, 'Paid via Cash', '2026-06-23', '0.00', 9),
(10, 'Paid via Cash', '2026-07-02', '10.00', 10),
(11, 'Paid via Cash', '2026-07-02', '11.50', 11),
(12, 'Paid via Cash', '2026-07-02', '8.00', 12),
(13, 'Paid via Cash', '2026-07-02', '5.00', 13),
(14, 'Paid via Cash', '2026-07-02', '5.00', 14),
(15, '1783426970_breakfast3.jpeg', '2026-07-07', '5.00', 15),
(16, 'Paid via Cash', '2026-07-07', '5.00', 16),
(17, 'Paid via Cash', '2026-07-07', '5.00', 17),
(18, 'Paid via Cash', '2026-07-07', '10.00', 18),
(19, 'Paid via Cash', '2026-07-07', '5.00', 19),
(20, 'Paid via Cash', '2026-07-07', '12.00', 20),
(21, 'Paid via Cash', '2026-07-07', '5.00', 21),
(22, '1783470232_qr.jpeg', '2026-07-07', '5.00', 22),
(23, 'Paid via Cash', '2026-07-07', '14.00', 23),
(24, 'Paid via Cash', '2026-07-07', '5.00', 24),
(25, 'Paid via Cash', '2026-07-10', '3.00', 25),
(26, 'Paid via Cash', '2026-07-11', '1.00', 26),
(27, '1783755011_qr.jpeg', '2026-07-11', '5.00', 27);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `staffPhoneNo` varchar(20) NOT NULL,
  `staffPosition` varchar(50) NOT NULL,
  `staffProfilePic` varchar(255) DEFAULT NULL,
  `staffEmail` varchar(100) NOT NULL,
  `staffUsername` varchar(50) NOT NULL,
  `staffPassword` varchar(255) NOT NULL,
  `staffAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `staffPhoneNo`, `staffPosition`, `staffProfilePic`, `staffEmail`, `staffUsername`, `staffPassword`, `staffAddress`) VALUES
(1, 'Muhammad Tarmizie Bin Alias', '0123456781', 'Manager', NULL, 'tarmizie1@mijiescafe.com', 'tarmizie', '1', 'No. 12, Jalan Sultan Ahmad, 25000 Kuantan, Pahang'),
(2, 'Ahmad Firdaus Bin Rahman', '0123456782', 'Financial', NULL, 'firdaus2@mijiescafe.com', 'firdaus', '1', 'Lot 45, Kampung Baru, 50300 Kuala Lumpur'),
(3, 'Muhammad Tarmizie Bin Alias', '0123456783', 'Accountant', NULL, 'tarmizie3@mijiescafe.com', 'mie', '1', 'No. 7, Taman Tas, 25150 Kuantan, Pahang'),
(4, 'Syafiq Azman Bin Roslan', '0123456784', 'Operations Assistant', NULL, 'syafiq4@mijiescafe.com', 'syafiq', '1', 'No. 22, Jalan Kebun, 40460 Shah Alam, Selangor'),
(5, 'Syazwan Bin Latif', '0123456785', 'Operations Assistant', NULL, 'syazwan5@mijiescafe.com', 'syazwan', '1', 'No. 104, Blok B, Flat San Peng, 55100 Kuala Lumpur'),
(6, 'Nur Aisyah Binti Zainal', '0123456786', 'Cashier', NULL, 'aisyah6@mijiescafe.com', 'aisyah', '1', 'No. 3, Jalan Melati, 81000 Kulai, Johor'),
(7, 'Farah Binti Zulkarnain', '0123456787', 'Kitchen Assistant', NULL, 'farah7@mijiescafe.com', 'farah', '1', 'Lot 88, Jalan Gombak, 53000 Kuala Lumpur'),
(8, 'Nabil Fikri Bin Rosli', '0123456788', 'Head Chef', NULL, 'nabil8@mijiescafe.com', 'nabil', '1', 'No. 15, Taman Temerloh Jaya, 28000 Temerloh, Pahang'),
(9, 'Siti Hajar Binti Yusof', '0123456789', 'Steward', NULL, 'sitihajar9@mijiescafe.com', 'sitihajar', '1', 'No. 44, Jalan Keramat, 54000 Kuala Lumpur'),
(12, 'Izzat Bin Razak', '0123456791', 'Demi Chef', NULL, 'izzat11@mijiescafe.com', 'izzat', '1', 'No 9, Jalan Pinang, 43000 Kajang, Selangor'),
(13, 'Nurin Hidayah binti Azhar', '0163152546', 'Cashier', NULL, 'nurin@gmail.com', 'nurin', '1', 'No 23, Jalan Aman , 06000, Jitra Kedah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `staffID` (`staffID`),
  ADD KEY `custID` (`custID`);

--
-- Indexes for table `order_menu`
--
ALTER TABLE `order_menu`
  ADD PRIMARY KEY (`orderID`,`menuID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indexes for table `order_package`
--
ALTER TABLE `order_package`
  ADD PRIMARY KEY (`orderID`,`packageID`),
  ADD KEY `packageID` (`packageID`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packageID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `packageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`custID`) REFERENCES `customer` (`custID`);

--
-- Constraints for table `order_menu`
--
ALTER TABLE `order_menu`
  ADD CONSTRAINT `order_menu_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_menu_ibfk_2` FOREIGN KEY (`menuID`) REFERENCES `menu` (`menuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_package`
--
ALTER TABLE `order_package`
  ADD CONSTRAINT `order_package_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_package_ibfk_2` FOREIGN KEY (`packageID`) REFERENCES `package` (`packageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
