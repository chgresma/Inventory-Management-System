-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2022 at 10:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `userName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `role` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userName`, `firstName`, `middleName`, `lastName`, `passWord`, `role`) VALUES
('princessJ', 'Jasmine', 'Agrabah', 'Guy', 'testing', 'Staff'),
('xx_aladin_xx', 'Aladdin', 'Ali', 'Ababwa', 'iloveyouprincessj', 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `account_old_passwords`
--

CREATE TABLE `account_old_passwords` (
  `userName` varchar(255) NOT NULL,
  `old_password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_old_passwords`
--

INSERT INTO `account_old_passwords` (`userName`, `old_password`, `date_created`) VALUES
('princessJ', 'testing', '2022-06-04 20:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_attempts`
--

CREATE TABLE `authentication_attempts` (
  `userName` varchar(255) NOT NULL,
  `date_attempt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryitem`
--

CREATE TABLE `deliveryitem` (
  `deliveryID` int(11) NOT NULL,
  `requestID` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `quantityDelivered` int(11) NOT NULL,
  `staff_userName` varchar(255) NOT NULL,
  `supplier_userName` varchar(255) NOT NULL,
  `paymentChange` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itemrequests`
--

CREATE TABLE `itemrequests` (
  `requestID` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `quantityRequest` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemName` varchar(255) NOT NULL,
  `stocks` int(11) NOT NULL,
  `pricePerStock` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemName`, `stocks`, `pricePerStock`, `userName`) VALUES
('Apple', 0, 8, 'princessJ'),
('Banana', 0, 6, 'princessJ'),
('Grapes', 0, 4, 'princessJ'),
('Orange', 0, 5, 'princessJ');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `userName`) VALUES
(1, 'princessJ');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `userName`) VALUES
(1, 'xx_aladin_xx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `account_old_passwords`
--
ALTER TABLE `account_old_passwords`
  ADD KEY `fk_username_old_password` (`userName`);

--
-- Indexes for table `authentication_attempts`
--
ALTER TABLE `authentication_attempts`
  ADD KEY `fk_username` (`userName`);

--
-- Indexes for table `deliveryitem`
--
ALTER TABLE `deliveryitem`
  ADD PRIMARY KEY (`deliveryID`),
  ADD KEY `deliveryItem_requestID_itemRequests_FK` (`requestID`),
  ADD KEY `deliveryItem_itemName_itemRequests_FK` (`itemName`),
  ADD KEY `deliveryItem_staff_userName_itemRequests` (`staff_userName`),
  ADD KEY `deliveryItem_supplier_userName_supplier_FK` (`supplier_userName`);

--
-- Indexes for table `itemrequests`
--
ALTER TABLE `itemrequests`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `itemRequests_itemName_item_FK` (`itemName`),
  ADD KEY `itemRequests_userName_items_FK` (`userName`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemName`),
  ADD KEY `items_userName_staff_FK` (`userName`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD KEY `staff_userName_FK` (`userName`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`),
  ADD KEY `supplier_userName_FK` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deliveryitem`
--
ALTER TABLE `deliveryitem`
  MODIFY `deliveryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itemrequests`
--
ALTER TABLE `itemrequests`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_old_passwords`
--
ALTER TABLE `account_old_passwords`
  ADD CONSTRAINT `fk_username_old_password` FOREIGN KEY (`userName`) REFERENCES `account` (`userName`);

--
-- Constraints for table `authentication_attempts`
--
ALTER TABLE `authentication_attempts`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`userName`) REFERENCES `account` (`userName`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `deliveryitem`
--
ALTER TABLE `deliveryitem`
  ADD CONSTRAINT `deliveryItem_itemName_itemRequests_FK` FOREIGN KEY (`itemName`) REFERENCES `itemrequests` (`itemName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveryItem_requestID_itemRequests_FK` FOREIGN KEY (`requestID`) REFERENCES `itemrequests` (`requestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveryItem_staff_userName_itemRequests` FOREIGN KEY (`staff_userName`) REFERENCES `itemrequests` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveryItem_supplier_userName_supplier_FK` FOREIGN KEY (`supplier_userName`) REFERENCES `supplier` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemrequests`
--
ALTER TABLE `itemrequests`
  ADD CONSTRAINT `itemRequests_itemName_item_FK` FOREIGN KEY (`itemName`) REFERENCES `items` (`itemName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemRequests_userName_items_FK` FOREIGN KEY (`userName`) REFERENCES `items` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_userName_staff_FK` FOREIGN KEY (`userName`) REFERENCES `staff` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_userName_FK` FOREIGN KEY (`userName`) REFERENCES `account` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_userName_FK` FOREIGN KEY (`userName`) REFERENCES `account` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
