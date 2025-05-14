-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 08:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s3112121`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(0, 'Olzhas', '$2y$10$NJoUnP2CpscINQ6.eMI5veTtOJ3rfAP2N.muZp7nFBAezNCK4Z8o6'),
(0, 'a', '$2y$10$4.fzu8AJRU5YCDDUc49mNeRxK640c3uGrTldC574RkkWlb64XypcO'),
(0, 'asd123', '$2y$10$ilOnHKOyGYdlj5H1GxFBeeI4qaDXfbrNw7J5GTDybFILuSY7RNV4y');

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE `adverts` (
  `advert_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appliance`
--

CREATE TABLE `appliance` (
  `ApplianceID` int(50) NOT NULL,
  `UserID` int(11) NOT NULL,
  `appliance_type` enum('Refrigerator','Washing Machine','Drier','Oven') NOT NULL,
  `brand` varchar(20) NOT NULL,
  `model_number` varchar(8) NOT NULL,
  `serial_number` varchar(16) NOT NULL,
  `purchase_date` date NOT NULL,
  `warranty_expiration_date` date NOT NULL,
  `cost_of_appliance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appliance`
--

INSERT INTO `appliance` (`ApplianceID`, `UserID`, `appliance_type`, `brand`, `model_number`, `serial_number`, `purchase_date`, `warranty_expiration_date`, `cost_of_appliance`) VALUES
(33, 53, 'Oven', 'T-Mobile', 'ABC12345', '48915619856189CS', '2024-04-02', '2024-11-27', 12);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_details`
--

CREATE TABLE `inventory_details` (
  `inID` int(11) NOT NULL,
  `prID` int(11) DEFAULT NULL,
  `item1` varchar(20) DEFAULT NULL,
  `item2` varchar(20) DEFAULT NULL,
  `item3` varchar(20) DEFAULT NULL,
  `item4` varchar(20) DEFAULT NULL,
  `totalCost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_details`
--

INSERT INTO `inventory_details` (`inID`, `prID`, `item1`, `item2`, `item3`, `item4`, `totalCost`) VALUES
(1, 1, 'J chair', 'J table', '4k Tv', 'couch M', 1500.00),
(2, 2, 'Rug', 'Dryer', 'Jade bed', 'couch', 1000.00),
(3, 3, 'Rug', 'Dryer', 'TV', 'couch', 1996.00),
(4, 4, 'Rug', 'Dryer', 'TV', 'couch', 1000.00),
(5, 5, 'Rug', 'Dryer', '4k Tv', 'couch', 2000.00),
(6, 6, 'Rug', 'Dryer', 'TV', 'couch', 1500.00),
(7, 7, 'Rug', 'Dryer', 'TV', 'couch', 1000.00),
(8, 8, 'Rug', 'Dryer', 'TV', 'couch', 1500.00),
(9, 9, 'Rug', 'Dryer', 'TV', 'couch', 2000.00),
(14, 1, 'chair', 'J table', '4k Tv', 'J bath', 2000.00),
(0, 1, 'item1', 'item2', 'item2', 'item2', 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `landlord`
--

CREATE TABLE `landlord` (
  `lID` int(11) NOT NULL,
  `prID` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `management_fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord`
--

INSERT INTO `landlord` (`lID`, `prID`, `name`, `password`, `email`, `income`, `commission`, `management_fee`) VALUES
(1, 61, 'EddieL', 'EddiesonL1', 'EddiesonL1@Gmail.com', 1000.00, 250.00, 500.00),
(2, 63, 'BernieL', 'BeranrdoL2', 'BeranrdoL2@Gmail.com', 2000.00, 500.00, 1000.00),
(3, 50, 'OljasL', 'OljassonL3', 'OljassonL3@Gmail.com', 3000.00, 1000.00, 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `landlords`
--

CREATE TABLE `landlords` (
  `landlord_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landlord_account`
--

CREATE TABLE `landlord_account` (
  `account_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `rental_income` decimal(10,2) NOT NULL,
  `commission` decimal(10,2) NOT NULL,
  `management_fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `category` enum('1 Bed','2 Bed','3 Bed','4 Bed') NOT NULL,
  `description` text NOT NULL,
  `length_of_tenancy` enum('3-month','6 month','1 year') NOT NULL,
  `landlord_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `prID` int(50) NOT NULL,
  `lID` int(11) DEFAULT NULL,
  `type` enum('Apartment','House') NOT NULL,
  `bedrooms` enum('1 Bed','2 Bed','3 Bed','4 Bed') NOT NULL,
  `address` varchar(50) NOT NULL,
  `eircode` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `furnished` tinyint(1) NOT NULL,
  `length_of_tenancy` enum('3-month',' 6 month','1 year','1+ year') NOT NULL,
  `description` varchar(5000) NOT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`prID`, `lID`, `type`, `bedrooms`, `address`, `eircode`, `price`, `furnished`, `length_of_tenancy`, `description`, `photo_path`) VALUES
(41, NULL, 'House', '4 Bed', '23 Griffith Court', 'D08 F31F', 12345, 1, '1+ year', 'Sale Type: For Sale by Private Treaty\r\nOverall Floor Area: 92 m²\r\nCONTACT SALES AGENT DIARMUID LYNCH FOR A VIEWING 0872622382\r\nDan Howard &amp; Co. Limited are delighted to bring this luxury beautifully decorated three bedroom duplex to the market. The property is in superb condition having been refurbished throughout with a high level of insulation and quality finish. The residence would make an ideal home or investment property.\r\n\r\nGround Floor \r\nCloak closet and understairs storage \r\n\r\nFirst Floor \r\nLiving Room: 3.6m x 2.8m \r\nKitchen/Dining Room: 3.1m x 2.8m - modern fitted kitchen incorporating hob, oven, washer, dryer and fridge freezer \r\nBathroom: 3.2m x 1.65m - beautifully decorated with 3 piece white suite \r\n\r\nSecond Floor \r\nBedroom 1: 3.2m x 2.87m - built in robe and fully tiled ensuite off \r\nBedroom 2: 3.0m x 2.2m - built in robe \r\nBedroom 3: 3.0m x 1.7m - built in robe \r\nGuest WC \r\nAttic entrance with access ladder', ''),
(46, NULL, 'House', '1 Bed', '23 Griffith Court', 'D08 F31X', 1234, 0, '3-month', '// Handle file uploads\r\n        $target_dir = &quot;property_photos/&quot;;\r\n        $target_files = array();\r\n        foreach ($_FILES[&quot;photos&quot;][&quot;tmp_name&quot;] as $key =&gt; $tmp_name) {\r\n            $target_file = $target_dir . basename($_FILES[&quot;photos&quot;][&quot;name&quot;][$key]);\r\n            move_uploaded_file($tmp_name, $target_file);\r\n            $target_files[] = $target_file;\r\n        }', 'property_photos/8.jpg'),
(50, NULL, '', '2 Bed', '23 Griffith Court', 'D08 F31X', 39999, 1, '', 'sdasdw ads awd saw', 'property_photos/8.jpg,property_photos/6.jpg,property_photos/5.jpg,property_photos/4.webp,property_photos/3.jpg'),
(60, NULL, '', '2 Bed', '23 Griffith Court', 'D08 F31X', 50000, 1, '1 year', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis magna id odio aliquet hendrerit. Sed sed hendrerit orci. Praesent sed ipsum nunc. Quisque gravida cursus neque et porta. In non dolor a magna pretium ultrices in consectetur risus. Mauris condimentum eleifend tellus quis accumsan. Vivamus quam arcu, tincidunt sit amet dui ac, dignissim hendrerit augue. Integer eleifend et risus a euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam malesuada quis massa id gravida. Ut sed tempus lacus. Cras purus nisl, malesuada ac pretium eu, pharetra a augue. Morbi faucibus risus odio, ornare accumsan tellus efficitur ut.\r\n\r\nProin varius felis nec enim porta mollis. Ut iaculis euismod fermentum. Suspendisse commodo arcu vitae nulla convallis, et aliquam lectus vehicula. Curabitur lacinia, risus vitae luctus molestie, justo dolor aliquam sapien, non sollicitudin mauris enim vitae purus. Ut ac efficitur nisl. Donec lacinia, neque et molestie consectetur, lorem risus gravida ex, non convallis velit enim vel mauris. Fusce tortor felis, gravida quis purus egestas, viverra euismod neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin volutpat nibh nec quam convallis, id molestie leo efficitur. Fusce id dui vel neque euismod aliquam. Aliquam est tortor, porttitor eu ex in, posuere lacinia risus. Duis iaculis dictum mauris, et convallis lorem blandit facilisis. Phasellus eget aliquet magna, quis aliquam magna. In auctor mattis nibh eget bibendum.\r\n\r\nFusce tincidunt cursus scelerisque. Etiam non elit luctus, porttitor nunc eget, convallis dolor. Nunc interdum fringilla dui posuere mattis. Nullam et tellus quis magna mattis egestas id vel ipsum. Curabitur arcu tortor, cursus id lacus ac, placerat mollis dolor. Sed mattis metus id risus commodo posuere. Phasellus nec elementum ligula, ac commodo purus. Proin urna nibh, malesuada quis elementum eget, faucibus ut erat. Vestibulum odio felis, elementum sed leo id, vestibulum imperdiet lectus. In elementum justo eu urna volutpat tristique. Pellentesque at urna nibh.\r\n\r\nMorbi dictum nisl ac urna auctor, id hendrerit purus cursus. Cras vehicula mauris sed elit tempus tincidunt. Pellentesque dapibus cursus consectetur. Nunc suscipit massa a leo lobortis, sit amet vulputate lectus consequat. Pellentesque consequat ligula vitae porttitor efficitur. Nullam pharetra elementum arcu at dignissim. Morbi interdum nulla sit amet scelerisque fringilla. Aenean porta neque at hendrerit semper. Proin eu mi risus. Integer dolor odio, egestas vel feugiat tincidunt, consectetur at ante. Nunc blandit nunc et mi varius, consectetur consequat purus maximus. Praesent ornare, leo a hendrerit fringilla, mauris nibh bibendum sem, a maximus lectus massa eu dui. Donec luctus elementum magna in lacinia. Praesent sodales nisl nunc, nec rhoncus metus sagittis ut. Etiam ante nulla, aliquet a urna in, lobortis ornare est. Vivamus elementum justo nec purus commodo, ac egestas massa euismod.\r\n\r\nMaecenas pharetra tortor ut lectus dictum, eget mattis sapien tincidunt. Ut a vehicula nisl. Maecenas eleifend, odio vitae scelerisque laoreet, est augue semper eros, sit amet interdum nunc elit at sem. Vestibulum varius at ex a commodo. Nam sagittis tellus sed consequat malesuada. Pellentesque eu felis lacus. Fusce pellentesque, erat vitae feugiat tristique, odio risus rutrum dolor, nec sollicitudin quam ligula ut elit. Morbi non risus ut urna gravida consectetur porttitor eget odio. Sed id arcu id nisl mollis pulvinar ut sit amet nunc. Phasellus pulvinar augue non ligula tempus, sit amet dignissim ligula varius. In mollis, nisi quis aliquet eleifend, ex purus vehicula enim, rutrum laoreet magna tortor convallis tellus. Suspendisse potenti. Morbi iaculis lacinia dui, sit amet convallis risus elementum a. Phasellus hendrerit interdum eleifend. Nullam arcu ipsum, tempor quis scelerisque non, faucibus in dui.', 'property_photos/4.webp'),
(61, NULL, '', '2 Bed', '23 Griffith Court', 'D08 F31X', 50000, 1, '1 year', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis magna id odio aliquet hendrerit. Sed sed hendrerit orci. Praesent sed ipsum nunc. Quisque gravida cursus neque et porta. In non dolor a magna pretium ultrices in consectetur risus. Mauris condimentum eleifend tellus quis accumsan. Vivamus quam arcu, tincidunt sit amet dui ac, dignissim hendrerit augue. Integer eleifend et risus a euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam malesuada quis massa id gravida. Ut sed tempus lacus. Cras purus nisl, malesuada ac pretium eu, pharetra a augue. Morbi faucibus risus odio, ornare accumsan tellus efficitur ut.\r\n\r\nProin varius felis nec enim porta mollis. Ut iaculis euismod fermentum. Suspendisse commodo arcu vitae nulla convallis, et aliquam lectus vehicula. Curabitur lacinia, risus vitae luctus molestie, justo dolor aliquam sapien, non sollicitudin mauris enim vitae purus. Ut ac efficitur nisl. Donec lacinia, neque et molestie consectetur, lorem risus gravida ex, non convallis velit enim vel mauris. Fusce tortor felis, gravida quis purus egestas, viverra euismod neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin volutpat nibh nec quam convallis, id molestie leo efficitur. Fusce id dui vel neque euismod aliquam. Aliquam est tortor, porttitor eu ex in, posuere lacinia risus. Duis iaculis dictum mauris, et convallis lorem blandit facilisis. Phasellus eget aliquet magna, quis aliquam magna. In auctor mattis nibh eget bibendum.\r\n\r\nFusce tincidunt cursus scelerisque. Etiam non elit luctus, porttitor nunc eget, convallis dolor. Nunc interdum fringilla dui posuere mattis. Nullam et tellus quis magna mattis egestas id vel ipsum. Curabitur arcu tortor, cursus id lacus ac, placerat mollis dolor. Sed mattis metus id risus commodo posuere. Phasellus nec elementum ligula, ac commodo purus. Proin urna nibh, malesuada quis elementum eget, faucibus ut erat. Vestibulum odio felis, elementum sed leo id, vestibulum imperdiet lectus. In elementum justo eu urna volutpat tristique. Pellentesque at urna nibh.\r\n\r\nMorbi dictum nisl ac urna auctor, id hendrerit purus cursus. Cras vehicula mauris sed elit tempus tincidunt. Pellentesque dapibus cursus consectetur. Nunc suscipit massa a leo lobortis, sit amet vulputate lectus consequat. Pellentesque consequat ligula vitae porttitor efficitur. Nullam pharetra elementum arcu at dignissim. Morbi interdum nulla sit amet scelerisque fringilla. Aenean porta neque at hendrerit semper. Proin eu mi risus. Integer dolor odio, egestas vel feugiat tincidunt, consectetur at ante. Nunc blandit nunc et mi varius, consectetur consequat purus maximus. Praesent ornare, leo a hendrerit fringilla, mauris nibh bibendum sem, a maximus lectus massa eu dui. Donec luctus elementum magna in lacinia. Praesent sodales nisl nunc, nec rhoncus metus sagittis ut. Etiam ante nulla, aliquet a urna in, lobortis ornare est. Vivamus elementum justo nec purus commodo, ac egestas massa euismod.\r\n\r\nMaecenas pharetra tortor ut lectus dictum, eget mattis sapien tincidunt. Ut a vehicula nisl. Maecenas eleifend, odio vitae scelerisque laoreet, est augue semper eros, sit amet interdum nunc elit at sem. Vestibulum varius at ex a commodo. Nam sagittis tellus sed consequat malesuada. Pellentesque eu felis lacus. Fusce pellentesque, erat vitae feugiat tristique, odio risus rutrum dolor, nec sollicitudin quam ligula ut elit. Morbi non risus ut urna gravida consectetur porttitor eget odio. Sed id arcu id nisl mollis pulvinar ut sit amet nunc. Phasellus pulvinar augue non ligula tempus, sit amet dignissim ligula varius. In mollis, nisi quis aliquet eleifend, ex purus vehicula enim, rutrum laoreet magna tortor convallis tellus. Suspendisse potenti. Morbi iaculis lacinia dui, sit amet convallis risus elementum a. Phasellus hendrerit interdum eleifend. Nullam arcu ipsum, tempor quis scelerisque non, faucibus in dui.', 'property_photos/4.webp'),
(62, NULL, '', '3 Bed', '23 Griffith Court', 'D08 F31X', 50000, 0, '1 year', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis magna id odio aliquet hendrerit. Sed sed hendrerit orci. Praesent sed ipsum nunc. Quisque gravida cursus neque et porta. In non dolor a magna pretium ultrices in consectetur risus. Mauris condimentum eleifend tellus quis accumsan. Vivamus quam arcu, tincidunt sit amet dui ac, dignissim hendrerit augue. Integer eleifend et risus a euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam malesuada quis massa id gravida. Ut sed tempus lacus. Cras purus nisl, malesuada ac pretium eu, pharetra a augue. Morbi faucibus risus odio, ornare accumsan tellus efficitur ut.\r\n\r\nProin varius felis nec enim porta mollis. Ut iaculis euismod fermentum. Suspendisse commodo arcu vitae nulla convallis, et aliquam lectus vehicula. Curabitur lacinia, risus vitae luctus molestie, justo dolor aliquam sapien, non sollicitudin mauris enim vitae purus. Ut ac efficitur nisl. Donec lacinia, neque et molestie consectetur, lorem risus gravida ex, non convallis velit enim vel mauris. Fusce tortor felis, gravida quis purus egestas, viverra euismod neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin volutpat nibh nec quam convallis, id molestie leo efficitur. Fusce id dui vel neque euismod aliquam. Aliquam est tortor, porttitor eu ex in, posuere lacinia risus. Duis iaculis dictum mauris, et convallis lorem blandit facilisis. Phasellus eget aliquet magna, quis aliquam magna. In auctor mattis nibh eget bibendum.\r\n\r\nFusce tincidunt cursus scelerisque. Etiam non elit luctus, porttitor nunc eget, convallis dolor. Nunc interdum fringilla dui posuere mattis. Nullam et tellus quis magna mattis egestas id vel ipsum. Curabitur arcu tortor, cursus id lacus ac, placerat mollis dolor. Sed mattis metus id risus commodo posuere. Phasellus nec elementum ligula, ac commodo purus. Proin urna nibh, malesuada quis elementum eget, faucibus ut erat. Vestibulum odio felis, elementum sed leo id, vestibulum imperdiet lectus. In elementum justo eu urna volutpat tristique. Pellentesque at urna nibh.\r\n\r\nMorbi dictum nisl ac urna auctor, id hendrerit purus cursus. Cras vehicula mauris sed elit tempus tincidunt. Pellentesque dapibus cursus consectetur. Nunc suscipit massa a leo lobortis, sit amet vulputate lectus consequat. Pellentesque consequat ligula vitae porttitor efficitur. Nullam pharetra elementum arcu at dignissim. Morbi interdum nulla sit amet scelerisque fringilla. Aenean porta neque at hendrerit semper. Proin eu mi risus. Integer dolor odio, egestas vel feugiat tincidunt, consectetur at ante. Nunc blandit nunc et mi varius, consectetur consequat purus maximus. Praesent ornare, leo a hendrerit fringilla, mauris nibh bibendum sem, a maximus lectus massa eu dui. Donec luctus elementum magna in lacinia. Praesent sodales nisl nunc, nec rhoncus metus sagittis ut. Etiam ante nulla, aliquet a urna in, lobortis ornare est. Vivamus elementum justo nec purus commodo, ac egestas massa euismod.\r\n\r\nMaecenas pharetra tortor ut lectus dictum, eget mattis sapien tincidunt. Ut a vehicula nisl. Maecenas eleifend, odio vitae scelerisque laoreet, est augue semper eros, sit amet interdum nunc elit at sem. Vestibulum varius at ex a commodo. Nam sagittis tellus sed consequat malesuada. Pellentesque eu felis lacus. Fusce pellentesque, erat vitae feugiat tristique, odio risus rutrum dolor, nec sollicitudin quam ligula ut elit. Morbi non risus ut urna gravida consectetur porttitor eget odio. Sed id arcu id nisl mollis pulvinar ut sit amet nunc. Phasellus pulvinar augue non ligula tempus, sit amet dignissim ligula varius. In mollis, nisi quis aliquet eleifend, ex purus vehicula enim, rutrum laoreet magna tortor convallis tellus. Suspendisse potenti. Morbi iaculis lacinia dui, sit amet convallis risus elementum a. Phasellus hendrerit interdum eleifend. Nullam arcu ipsum, tempor quis scelerisque non, faucibus in dui.', 'property_photos/1.webp'),
(63, NULL, '', '3 Bed', '23 Griffith Court', 'D08 F31X', 50000, 0, '1 year', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis magna id odio aliquet hendrerit. Sed sed hendrerit orci. Praesent sed ipsum nunc. Quisque gravida cursus neque et porta. In non dolor a magna pretium ultrices in consectetur risus. Mauris condimentum eleifend tellus quis accumsan. Vivamus quam arcu, tincidunt sit amet dui ac, dignissim hendrerit augue. Integer eleifend et risus a euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam malesuada quis massa id gravida. Ut sed tempus lacus. Cras purus nisl, malesuada ac pretium eu, pharetra a augue. Morbi faucibus risus odio, ornare accumsan tellus efficitur ut.\r\n\r\nProin varius felis nec enim porta mollis. Ut iaculis euismod fermentum. Suspendisse commodo arcu vitae nulla convallis, et aliquam lectus vehicula. Curabitur lacinia, risus vitae luctus molestie, justo dolor aliquam sapien, non sollicitudin mauris enim vitae purus. Ut ac efficitur nisl. Donec lacinia, neque et molestie consectetur, lorem risus gravida ex, non convallis velit enim vel mauris. Fusce tortor felis, gravida quis purus egestas, viverra euismod neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin volutpat nibh nec quam convallis, id molestie leo efficitur. Fusce id dui vel neque euismod aliquam. Aliquam est tortor, porttitor eu ex in, posuere lacinia risus. Duis iaculis dictum mauris, et convallis lorem blandit facilisis. Phasellus eget aliquet magna, quis aliquam magna. In auctor mattis nibh eget bibendum.\r\n\r\nFusce tincidunt cursus scelerisque. Etiam non elit luctus, porttitor nunc eget, convallis dolor. Nunc interdum fringilla dui posuere mattis. Nullam et tellus quis magna mattis egestas id vel ipsum. Curabitur arcu tortor, cursus id lacus ac, placerat mollis dolor. Sed mattis metus id risus commodo posuere. Phasellus nec elementum ligula, ac commodo purus. Proin urna nibh, malesuada quis elementum eget, faucibus ut erat. Vestibulum odio felis, elementum sed leo id, vestibulum imperdiet lectus. In elementum justo eu urna volutpat tristique. Pellentesque at urna nibh.\r\n\r\nMorbi dictum nisl ac urna auctor, id hendrerit purus cursus. Cras vehicula mauris sed elit tempus tincidunt. Pellentesque dapibus cursus consectetur. Nunc suscipit massa a leo lobortis, sit amet vulputate lectus consequat. Pellentesque consequat ligula vitae porttitor efficitur. Nullam pharetra elementum arcu at dignissim. Morbi interdum nulla sit amet scelerisque fringilla. Aenean porta neque at hendrerit semper. Proin eu mi risus. Integer dolor odio, egestas vel feugiat tincidunt, consectetur at ante. Nunc blandit nunc et mi varius, consectetur consequat purus maximus. Praesent ornare, leo a hendrerit fringilla, mauris nibh bibendum sem, a maximus lectus massa eu dui. Donec luctus elementum magna in lacinia. Praesent sodales nisl nunc, nec rhoncus metus sagittis ut. Etiam ante nulla, aliquet a urna in, lobortis ornare est. Vivamus elementum justo nec purus commodo, ac egestas massa euismod.\r\n\r\nMaecenas pharetra tortor ut lectus dictum, eget mattis sapien tincidunt. Ut a vehicula nisl. Maecenas eleifend, odio vitae scelerisque laoreet, est augue semper eros, sit amet interdum nunc elit at sem. Vestibulum varius at ex a commodo. Nam sagittis tellus sed consequat malesuada. Pellentesque eu felis lacus. Fusce pellentesque, erat vitae feugiat tristique, odio risus rutrum dolor, nec sollicitudin quam ligula ut elit. Morbi non risus ut urna gravida consectetur porttitor eget odio. Sed id arcu id nisl mollis pulvinar ut sit amet nunc. Phasellus pulvinar augue non ligula tempus, sit amet dignissim ligula varius. In mollis, nisi quis aliquet eleifend, ex purus vehicula enim, rutrum laoreet magna tortor convallis tellus. Suspendisse potenti. Morbi iaculis lacinia dui, sit amet convallis risus elementum a. Phasellus hendrerit interdum eleifend. Nullam arcu ipsum, tempor quis scelerisque non, faucibus in dui.', 'property_photos/1.webp');

-- --------------------------------------------------------

--
-- Table structure for table `property_photos`
--

CREATE TABLE `property_photos` (
  `photo_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenancy_account`
--

CREATE TABLE `tenancy_account` (
  `account_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `monthly_rental_fee` decimal(10,2) NOT NULL,
  `length_of_tenancy` enum('1 year') NOT NULL,
  `tenancy_agreement` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `amount_owed` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tID` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `length_tenancy` int(11) DEFAULT NULL,
  `tenancy_agreement` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `amount_owed` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tID`, `name`, `password`, `email`, `monthly_fee`, `address`, `length_tenancy`, `tenancy_agreement`, `start_date`, `end_date`, `amount_paid`, `amount_owed`) VALUES
(1, 'Eddie', 'Eddieson1', 'Eddie1@Gmail.com', 200.00, '123 Main St', 1, 'Tenant is permitted to stay for the length agreed', '2024-04-18', '2025-04-18', 3000.00, 1000.00),
(2, 'Bernie', '@Beranrdo2', 'Bernie2@Gmail.com', 300.00, '789 Main St', 2, 'Tenant is permitted to stay for the length agreed', '2024-08-19', '2026-08-19', 5000.00, 2000.00),
(3, 'Oljas', '@Oljasson3', 'Oljas3@Gmail.com', 400.00, '456 Oak St', 3, 'Tenant is permitted to stay for the length agreed', '2024-04-20', '2027-04-20', 6000.00, 3000.00),
(4, 'Elon Musk', 'Eddie1212@', 'elonmusk@tesla.com', 4000.00, '', 5, 'yes', '2024-04-25', '2025-02-04', 3800.00, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `parent_first_name` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `user_id`, `service_name`, `date`, `parent_first_name`, `comment`) VALUES
(0, 0, 'asasa', '2024-04-29', '', 'rararv');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `eircode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `first_name`, `last_name`, `address`, `mobile`, `email`, `eircode`) VALUES
(53, 'Enkhbaatar', 'Idersaikhan', '23 Annfield Court', '0892151195', 'roberthdoll@gmail.com', 'D15 H7D5'),
(54, 'Enkhbaatar', 'Idersaikhan', '23 Annfield Court', '0892151195', 'roberthdoll@gmail.com', 'D15 H7D1'),
(55, 'Enkhbaatar', 'Idersaikhan', '23 Griffith Court', '0892151195', 'roberthdoll@gmail.com', 'D08 H7D1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('Public','Landlord','Tenant','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
(0, 'Eddie', '$2y$10$b09iXcOKntyHifjaZK/xXOxo37tmPXW/oR/hG7IY36S6ZUXdRUeWe', 'Public'),
(0, 'Aaa', '$2y$10$.DiFRgqF8PkbwadKZ6q.beFQuo0PEX.1rE0mHts3zF8VdS579ZPS2', 'Public'),
(0, 'aa', '$2y$10$bCxvLm0Iym767yl8Z4RjVOBlE9qynQXN.Yedvhh1FxJYFFM.rJDMu', 'Public'),
(0, 'asd123', '$2y$10$ZaBjfU4HOhBO0HWEwnNb9eANRRV66oO6IckfpYJvMXw5z9aS4k3O2', 'Public');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliance`
--
ALTER TABLE `appliance`
  ADD PRIMARY KEY (`ApplianceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `landlord`
--
ALTER TABLE `landlord`
  ADD PRIMARY KEY (`lID`),
  ADD KEY `prID` (`prID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`prID`),
  ADD KEY `Foreign Key` (`lID`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appliance`
--
ALTER TABLE `appliance`
  MODIFY `ApplianceID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `landlord`
--
ALTER TABLE `landlord`
  MODIFY `lID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `prID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appliance`
--
ALTER TABLE `appliance`
  ADD CONSTRAINT `appliance_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `landlord`
--
ALTER TABLE `landlord`
  ADD CONSTRAINT `landlord_ibfk_1` FOREIGN KEY (`prID`) REFERENCES `property` (`prID`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`lID`) REFERENCES `landlord` (`lID`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
