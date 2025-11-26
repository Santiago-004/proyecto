-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for eurotechdb
CREATE DATABASE IF NOT EXISTS `eurotechdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `eurotechdb`;

-- Dumping structure for table eurotechdb.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `C_ID` int NOT NULL AUTO_INCREMENT,
  `Customer_ID` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Name` varchar(70) NOT NULL,
  `Products` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IMDS_ID_no` varchar(8) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Customer_PPAP_Number` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`C_ID`),
  UNIQUE KEY `Customer_PPAP_Number` (`Customer_PPAP_Number`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table eurotechdb.customer_pn
CREATE TABLE IF NOT EXISTS `customer_pn` (
  `Customer_PN_ID` int NOT NULL AUTO_INCREMENT,
  `Customer_PN` varchar(30) NOT NULL,
  `FK_Customer_ID` int NOT NULL DEFAULT (0),
  `FK_Eurotech_PN` varchar(30) NOT NULL,
  PRIMARY KEY (`Customer_PN_ID`),
  KEY `FK2_Products-Customer_PN` (`FK_Eurotech_PN`),
  KEY `FK1_Customers-Customer_PN` (`FK_Customer_ID`),
  CONSTRAINT `FK1_Customers-Customer_PN` FOREIGN KEY (`FK_Customer_ID`) REFERENCES `customers` (`C_ID`),
  CONSTRAINT `FK2_Products-Customer_PN` FOREIGN KEY (`FK_Eurotech_PN`) REFERENCES `products` (`Eurotech_PN`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table eurotechdb.ppap
CREATE TABLE IF NOT EXISTS `ppap` (
  `PPAP_ID` int NOT NULL AUTO_INCREMENT,
  `FK_Customer_PN_ID` int NOT NULL,
  `FK_Vendor_ID` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PPAP_Number` varchar(12) DEFAULT NULL,
  `Country` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IMDS` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PPAP_Request_Date` date DEFAULT NULL,
  `PPAP_Requested_Vendor` date DEFAULT NULL,
  `PPAP_Received_Date` date DEFAULT NULL,
  `PPAP_Sent_Customer` date DEFAULT NULL,
  `PPAP_Signed_Date` date DEFAULT NULL,
  `PPAP_ET` varchar(1) DEFAULT NULL,
  `IMDS_ET` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `OEM` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `PPAP_Level` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PPAP_From_Shipments` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Current_Status` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Rev` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Samples_Status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Reason_Submission` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Inspection_Rep_Number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Comments` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`PPAP_ID`),
  KEY `FK2_Vendors-PPAP` (`FK_Vendor_ID`),
  KEY `FK2_Customer_PN-PPAP` (`FK_Customer_PN_ID`),
  CONSTRAINT `FK2_Customer_PN-PPAP` FOREIGN KEY (`FK_Customer_PN_ID`) REFERENCES `customer_pn` (`Customer_PN_ID`),
  CONSTRAINT `FK_ppap_vendors` FOREIGN KEY (`FK_Vendor_ID`) REFERENCES `vendors` (`Vendor_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table eurotechdb.products
CREATE TABLE IF NOT EXISTS `products` (
  `Eurotech_PN` varchar(30) NOT NULL,
  `Description` tinytext NOT NULL,
  `Supplier` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Supplier_PN` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Tape` varchar(25) DEFAULT NULL,
  `Width` varchar(8) DEFAULT NULL,
  `Length` varchar(8) DEFAULT NULL,
  `Color` varchar(8) DEFAULT NULL,
  `ET_Model` varchar(10) DEFAULT NULL,
  `ET_Dwg` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Product` varchar(7) NOT NULL,
  PRIMARY KEY (`Eurotech_PN`),
  UNIQUE KEY `Supplier_PN` (`Supplier_PN`),
  KEY `FK1_Vendors-Products` (`Supplier`),
  CONSTRAINT `FK1_Vendors-Products` FOREIGN KEY (`Supplier`) REFERENCES `vendors` (`Vendor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table eurotechdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `Role` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

-- Dumping structure for table eurotechdb.vendors
CREATE TABLE IF NOT EXISTS `vendors` (
  `Vendor_ID` varchar(10) NOT NULL,
  `Name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Short_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Vendor_ID`),
  UNIQUE KEY `Name` (`Name`),
  UNIQUE KEY `Short_name` (`Short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
