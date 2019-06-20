-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2018 at 06:42 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `checkinId` int(20) NOT NULL,
  `userId` varchar(20) DEFAULT NULL,
  `clientId` varchar(20) DEFAULT NULL,
  `siteId` varchar(20) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`checkinId`, `userId`, `clientId`, `siteId`, `createdAt`, `updatedAt`) VALUES
(1, '1', '1', '4', '2018-04-20', '2018-04-21'),
(6, '2', '2', '2', '2018-04-21', '2018-04-21'),
(7, '2', '', '2', '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Id` int(11) NOT NULL,
  `waitlistId` varchar(20) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `phoneNumber` bigint(10) NOT NULL,
  `shelterId` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Id`, `waitlistId`, `Name`, `phoneNumber`, `shelterId`, `createdAt`, `updatedAt`) VALUES
(1, '1', 'Client 1', 1234567890, 1, '2018-04-20', '2018-04-22'),
(2, '2', 'Client 2', 2, 2, '2018-04-20', '2018-04-22'),
(3, '2', 'Client 3', 9898989898, 2, '2018-04-21', '2018-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `clientservices`
--

CREATE TABLE `clientservices` (
  `id` int(11) NOT NULL,
  `shelterId` varchar(20) NOT NULL,
  `kitchenId` varchar(20) NOT NULL,
  `siteId` varchar(20) NOT NULL,
  `foodpantryId` varchar(20) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientservices`
--

INSERT INTO `clientservices` (`id`, `shelterId`, `kitchenId`, `siteId`, `foodpantryId`, `createdAt`, `updatedAt`) VALUES
(1, '1', '1', '1', '1', '2018-04-20', '2018-04-20'),
(2, '2', '1', '2', '1', '2018-04-21', '2018-04-21'),
(3, '2', '1', '2', '1', '2018-04-22', '2018-04-22'),
(4, '3', '1', '2', '1', '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `closed`
--

CREATE TABLE `closed` (
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donationId` int(11) NOT NULL,
  `foodbankId` varchar(20) NOT NULL,
  `itemId` varchar(20) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donationId`, `foodbankId`, `itemId`, `createdAt`, `updatedAt`) VALUES
(2, '1', '1', '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `female`
--

CREATE TABLE `female` (
  `Status` varchar(20) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foodbank`
--

CREATE TABLE `foodbank` (
  `foodbankId` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodbank`
--

INSERT INTO `foodbank` (`foodbankId`, `createdAt`, `updatedAt`) VALUES
(1, '2018-04-20', '2018-04-20'),
(2, '2018-04-20', '2018-04-20'),
(3, '2018-04-22', '2018-04-22'),
(4, '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `foodpantry`
--

CREATE TABLE `foodpantry` (
  `Id` int(11) NOT NULL,
  `SSN` varchar(20) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodpantry`
--

INSERT INTO `foodpantry` (`Id`, `SSN`, `createdAt`, `updatedAt`) VALUES
(1, '1', '2018-04-20', '2018-04-20'),
(2, '3', '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `itemrequests`
--

CREATE TABLE `itemrequests` (
  `itemId` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `siteId` varchar(20) NOT NULL,
  `userId` varchar(20) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemrequests`
--

INSERT INTO `itemrequests` (`itemId`, `category`, `siteId`, `userId`, `createdAt`, `updatedAt`) VALUES
(1, 'Item Req 1', '1', '1', '2018-04-20', '2018-04-22'),
(2, 'Item Req 2', '2', '2', '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number_of_unit` varchar(20) NOT NULL,
  `expiryDate` date NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `name`, `number_of_unit`, `expiryDate`, `createdAt`, `updatedAt`) VALUES
(1, 'Item 1', '1', '2018-04-01', '2018-04-21', '2018-04-22'),
(2, 'item 2', '2', '2018-04-30', '2018-04-20', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `male`
--

CREATE TABLE `male` (
  `Status` varchar(20) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mixed`
--

CREATE TABLE `mixed` (
  `Status` varchar(20) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `open`
--

CREATE TABLE `open` (
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomId` int(11) NOT NULL,
  `shelterId` varchar(20) NOT NULL,
  `availableroom` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `shelterId`, `availableroom`, `createdAt`, `updatedAt`) VALUES
(1, '1', 1, '2018-04-20', '2018-04-20'),
(2, '2', 2, '2018-04-21', '2018-04-22'),
(3, '3', 3, '2018-04-22', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `Id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `hours` int(11) NOT NULL,
  `conditions` varchar(45) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`Id`, `name`, `hours`, `conditions`, `createdAt`, `updatedAt`) VALUES
(1, 'Service 1', 1, '1', '2018-04-20', '2018-04-22'),
(2, 'Service 2', 2, '2', '2018-04-21', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE `shelter` (
  `shelterId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number_of_female` int(11) NOT NULL,
  `number_of_male` int(11) NOT NULL,
  `number_of_mixed` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`shelterId`, `name`, `number_of_female`, `number_of_male`, `number_of_mixed`, `createdAt`, `updatedAt`) VALUES
(1, 'Shelter 1', 1, 1, 1, '2018-04-20', '2018-04-22'),
(2, 'Shelter 2', 2, 2, 2, '2018-04-20', '2018-04-22'),
(3, 'Shelter 3', 3, 3, 3, '2018-04-21', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `Id` int(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `address` varchar(80) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`Id`, `Name`, `address`, `city`, `zipcode`, `phoneNumber`, `createdAt`, `updatedAt`) VALUES
(1, 'Site 1', 'address 1', 'city 1', 123456, '2121212121', '2018-04-20', '2018-04-22'),
(2, 'Site 2', 'address 2', 'city 2', 123456, '123456789', '2018-04-20', '2018-04-22'),
(4, 'Site 3', 'address 3', 'city 3', 123456, '1234567890', '2018-04-20', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `soupkitchen`
--

CREATE TABLE `soupkitchen` (
  `kitchenId` int(11) NOT NULL,
  `totalSeats` int(11) NOT NULL,
  `locations` varchar(20) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soupkitchen`
--

INSERT INTO `soupkitchen` (`kitchenId`, `totalSeats`, `locations`, `createdAt`, `updatedAt`) VALUES
(1, 11, '11', '2018-04-21', '2018-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(20) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `emailId` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `emailId`, `password`, `createdAt`, `updatedAt`) VALUES
(1, 'User 1', 'user1@user.com', '123456', '2018-04-20', '2018-04-22'),
(2, 'User 2', 'user2@user.com', '123456', '2018-04-21', '2018-04-22'),
(3, 'User 3', 'user3@user.com', '123456', '2018-04-21', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

CREATE TABLE `waitlist` (
  `Id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `roomId` varchar(20) NOT NULL,
  `clientId` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waitlist`
--

INSERT INTO `waitlist` (`Id`, `name`, `roomId`, `clientId`, `userId`, `createdAt`, `updatedAt`) VALUES
(1, 'Wait List 1', '1', '1', 1, '2018-04-20', '2018-04-21'),
(2, 'Wait List 2', '2', '2', 2, '2018-04-21', '2018-04-22'),
(4, 'Wait List 3', '3', '3', 3, '2018-04-21', '2018-04-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`checkinId`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `clientservices`
--
ALTER TABLE `clientservices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donationId`);

--
-- Indexes for table `foodbank`
--
ALTER TABLE `foodbank`
  ADD PRIMARY KEY (`foodbankId`);

--
-- Indexes for table `foodpantry`
--
ALTER TABLE `foodpantry`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `itemrequests`
--
ALTER TABLE `itemrequests`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `shelter`
--
ALTER TABLE `shelter`
  ADD PRIMARY KEY (`shelterId`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `phoneNumber_UNIQUE` (`phoneNumber`);

--
-- Indexes for table `soupkitchen`
--
ALTER TABLE `soupkitchen`
  ADD PRIMARY KEY (`kitchenId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `emailId_UNIQUE` (`emailId`);

--
-- Indexes for table `waitlist`
--
ALTER TABLE `waitlist`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `checkinId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clientservices`
--
ALTER TABLE `clientservices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `foodbank`
--
ALTER TABLE `foodbank`
  MODIFY `foodbankId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `foodpantry`
--
ALTER TABLE `foodpantry`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `itemrequests`
--
ALTER TABLE `itemrequests`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shelter`
--
ALTER TABLE `shelter`
  MODIFY `shelterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `soupkitchen`
--
ALTER TABLE `soupkitchen`
  MODIFY `kitchenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `waitlist`
--
ALTER TABLE `waitlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
