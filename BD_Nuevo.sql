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

-- Dumping structure for table eurotechdb.bluseal
CREATE TABLE IF NOT EXISTS `bluseal` (
  `BS_Eurotech_PN` varchar(10) NOT NULL,
  `Model` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` tinytext NOT NULL,
  `Supplier` varchar(15) NOT NULL,
  `Supplier_PN` varchar(6) NOT NULL,
  PRIMARY KEY (`BS_Eurotech_PN`),
  UNIQUE KEY `Supplier_PN` (`Supplier_PN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.bluseal: ~2 rows (approximately)
INSERT INTO `bluseal` (`BS_Eurotech_PN`, `Model`, `Description`, `Supplier`, `Supplier_PN`) VALUES
	('123456781', 'ET008-50', 'BluSeal ET008-50 gram Bottle with UV Tracer', 'Toagosei (TGA)', 'CE6039'),
	('123456789', 'ET008-500', 'BluSeal ET008-500 gram Bottle with UV Tracer', 'Toagosei (TGA)', 'CE6038');

-- Dumping structure for table eurotechdb.bluseal_customer
CREATE TABLE IF NOT EXISTS `bluseal_customer` (
  `ID_BS_Customer` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID_BS_Customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.bluseal_customer: ~0 rows (approximately)

-- Dumping structure for table eurotechdb.bluseal_customer_pn
CREATE TABLE IF NOT EXISTS `bluseal_customer_pn` (
  `BS_Customer_PN` varchar(20) NOT NULL,
  `FK_ID_BS_Customer` int NOT NULL,
  `FK_BS_Eurotech_PN` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`BS_Customer_PN`),
  KEY `FK1_BS_Customer-BS_Customer_PN` (`FK_ID_BS_Customer`),
  KEY `FK2_BS-BS_Customer_PN` (`FK_BS_Eurotech_PN`),
  CONSTRAINT `FK1_BS_Customer-BS_Customer_PN` FOREIGN KEY (`FK_ID_BS_Customer`) REFERENCES `bluseal_customer` (`ID_BS_Customer`),
  CONSTRAINT `FK2_BS-BS_Customer_PN` FOREIGN KEY (`FK_BS_Eurotech_PN`) REFERENCES `bluseal` (`BS_Eurotech_PN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.bluseal_customer_pn: ~0 rows (approximately)

-- Dumping structure for table eurotechdb.bluseal_ppap
CREATE TABLE IF NOT EXISTS `bluseal_ppap` (
  `ID_BS_PPAP` int NOT NULL AUTO_INCREMENT,
  `FK_BS_Customer_PN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IMDS` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Request_Date` date DEFAULT NULL,
  `PPAP_Received_Date` date DEFAULT NULL,
  `Sent_Customer` date DEFAULT NULL,
  `PPAP_Signed_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID_BS_PPAP`),
  KEY `FK1_BS_Customer_PN-BS_PPAP` (`FK_BS_Customer_PN`),
  CONSTRAINT `FK1_BS_Customer_PN-BS_PPAP` FOREIGN KEY (`FK_BS_Customer_PN`) REFERENCES `bluseal_customer_pn` (`BS_Customer_PN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.bluseal_ppap: ~0 rows (approximately)

-- Dumping structure for table eurotechdb.cables
CREATE TABLE IF NOT EXISTS `cables` (
  `Eurotech_PN_CAB` varchar(8) NOT NULL,
  `Coroflex_PN` varchar(8) DEFAULT NULL,
  `Description` tinytext NOT NULL,
  PRIMARY KEY (`Eurotech_PN_CAB`) USING BTREE,
  UNIQUE KEY `Coroflex_PN` (`Coroflex_PN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.cables: ~45 rows (approximately)
INSERT INTO `cables` (`Eurotech_PN_CAB`, `Coroflex_PN`, `Description`) VALUES
	('P500000', '171953', 'Coroflex 9-2652 FHL2G 50.0mm²/0.21-ORG'),
	('P500001', '158543', 'Coroflex 9-2611 FHLR2GCB2G 4.0mm²/0.21-ORG'),
	('P500002', '229226', 'Coroflex 9-2611 FHLR2GCB2G 6.0mm²/0.21-ORG'),
	('P500003', '157090', 'Coroflex 9-2611 FHLR2GCB2G 10.0mm²/0.21-ORG'),
	('P500004', '153792', 'Coroflex 9-2611 FHLR2GCB2G 16.0mm²/0.21-ORG'),
	('P500005', '153797', 'Coroflex 9-2611 FHLR2GCB2G 25.0mm²/0.21-ORG'),
	('P500006', '153802', 'Coroflex 9-2611 FHLR2GCB2G 35.0mm²/0.21-ORG'),
	('P500007', '153807', 'Coroflex 9-2611 FHLR2GCB2G 50.0mm²/0.21-ORG'),
	('P500008', '177985', 'Coroflex 9-2611 FHLR2GCB2G 70.0mm²/0.21-ORG'),
	('P500009', '177987', 'Coroflex 9-2611 FHLR2GCB2G 95.0mm²/0.21-ORG'),
	('P500010', '185266', 'Coroflex 9-2621 FHL2GCB2G 120.0mm²/0.21-ORG'),
	('P500011', '169723', 'Coroflex 9-2652 FHL2G 4.0mm²/0.21-ORG'),
	('P500012', '224900', 'Coroflex 9-2652 FHL2G 6.0mm²/0.21-ORG'),
	('P500013', '208146', 'Coroflex 9-2652 FHL2G 10.0mm²/0.21-ORG'),
	('P500014', '193275', 'Coroflex 9-2652 FHL2G 16.0mm²/0.21-ORG'),
	('P500015', '175374', 'Coroflex 9-2652 FHL2G 25.0mm²/0.21-ORG'),
	('P500016', '167237', 'Coroflex 9-2652 FHL2G 35.0mm²/0.21-ORG'),
	('P500017', '193274', 'Coroflex 9-2652 FHL2G 70.0mm²/0.21-ORG'),
	('P500018', '190544', 'Coroflex 9-2652 FHL2G 95.0mm²/0.21-ORG'),
	('P500019', '223442', 'Coroflex 9-2652 FHL2G 120.0mm²/0.21-ORG'),
	('P500020', '173020', 'Coroflex 9-2642 FHLR2G2G 2x6mm²-ORG'),
	('P500021', '153706', 'Coroflex 9-2641 FHLR2GCB2G 2x4.0mm²-ORG'),
	('P500022', '165123', 'Coroflex 9-2641 FHLR2GCB2G 3x4.0mm²-ORG'),
	('P500023', '147794', 'Coroflex 9-2641 FHLR2GCB2G 2x6.0mm²-ORG'),
	('P500024', '174565', 'Coroflex 9-2641 FHLR2GCB2G 3x6.0mm²-ORG'),
	('P500025', '196024', 'Coroflex 9-2641 FHLR2GCB2G 4x6.0mm²-ORG'),
	('P500026', '155658', 'Coroflex 9-2641 FHLR2GCB2G 5x6.0mm²-ORG'),
	('P500027', '222024', 'Coroflex 9-2632 FHLALR2GCB2G 70mm²-ORG'),
	('P500028', '153702', 'Coroflex 9-2641 FHLR2GCB2G 2x2.5mm²-ORG'),
	('P500029', NULL, 'Coroflex 9-2642 FHLR2G2G 4x6mm²-ORG'),
	('P500030', NULL, 'Coroflex 9-2641 FHLR2GCB2G+FLR7YB2G 2x4mm²+2x0.35x0.35-ORG'),
	('P500031', '155582', 'Coroflex 9-2641 FHLR2GCB2G 3x2.5mm²-ORG'),
	('P500032', NULL, 'Coroflex 9-2632 FHLALR2GCB2G 35mm²-ORG'),
	('P500033', '216355', 'Coroflex 9-2632 FHLALR2GCB2G 50mm²-ORG'),
	('P500034', '221153', 'Coroflex 9-2632 FHLALR2GCB2G 95mm²-ORG'),
	('P500035', '174040', 'Coroflex 9-2641 FHLR2GCB2G 4x6.0mm²-ORG'),
	('P500036', '222874', 'Coroflex 9-2617 ISO T180 FHLR2GCB2G 35.0mm²/0.21-ORG'),
	('P500037', '218170', 'Coroflex 9-2617 ISO T180 FHLR2GCB2G 50.0mm²/0.21-ORG'),
	('P500038', '218171', 'Coroflex 9-2617 ISO T180 FHLR2GCB2G 70.0mm²/0.21-ORG'),
	('P500039', '218172', 'Coroflex 9-2617 ISO T180 FHLR2GCB2G 95.0mm²/0.21-ORG'),
	('P500040', '238568', 'Coroflex 9-2617 ISO T180 FHLR2GCB2G 120.0mm²/0.21-ORG'),
	('P500041', '179519', 'Coroflex 9-2641 FHLR2GCB2G 4x4.0mm²-ORG'),
	('P500042', '183141', 'Coroflex 9-2622 FHL2GCB2G 2.5mm²/0.21-ORG'),
	('P500043', '176709', 'Coroflex 9-2611 FHLR2GCB2G 50.0mm²/0.21-ORG w/ black stripe'),
	('P500044', '208273', 'Coroflex 9-2615 FHLR2GCB2G 50.0mm²/0.21-ORG');

-- Dumping structure for table eurotechdb.cables_customer
CREATE TABLE IF NOT EXISTS `cables_customer` (
  `ID_CAB_Customer` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(70) NOT NULL,
  PRIMARY KEY (`ID_CAB_Customer`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.cables_customer: ~3 rows (approximately)
INSERT INTO `cables_customer` (`ID_CAB_Customer`, `Name`) VALUES
	(3, 'CVG'),
	(5, 'Motherson/PKC'),
	(4, 'MSSL');

-- Dumping structure for table eurotechdb.cables_customer_pn
CREATE TABLE IF NOT EXISTS `cables_customer_pn` (
  `CAB_Customer_PN` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FK_Eurotech_PN_CAB` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FK_ID_CAB_Customer` int NOT NULL,
  PRIMARY KEY (`CAB_Customer_PN`),
  KEY `FK1_CAB-CAB_Customer_PN` (`FK_Eurotech_PN_CAB`),
  KEY `FK2_CAB_Customer-CAB_Customer_PN` (`FK_ID_CAB_Customer`),
  CONSTRAINT `FK1_CAB-CAB_Customer_PN` FOREIGN KEY (`FK_Eurotech_PN_CAB`) REFERENCES `cables` (`Eurotech_PN_CAB`),
  CONSTRAINT `FK2_CAB_Customer-CAB_Customer_PN` FOREIGN KEY (`FK_ID_CAB_Customer`) REFERENCES `cables_customer` (`ID_CAB_Customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.cables_customer_pn: ~3 rows (approximately)
INSERT INTO `cables_customer_pn` (`CAB_Customer_PN`, `FK_Eurotech_PN_CAB`, `FK_ID_CAB_Customer`) VALUES
	('67845380', 'P500000', 3),
	('67845381', 'P500003', 4),
	('67845382', 'P500023', 5);

-- Dumping structure for table eurotechdb.cables_ppap
CREATE TABLE IF NOT EXISTS `cables_ppap` (
  `ID_CAB_PPAP` int NOT NULL AUTO_INCREMENT,
  `FK_CAB_Customer_PN` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PPAP_Requested_Date` date DEFAULT NULL,
  `PPAP_Received_Date` date DEFAULT NULL,
  `PPAP_Sent_Date` date DEFAULT NULL,
  `PPAP_Signed_Date` date DEFAULT NULL,
  PRIMARY KEY (`ID_CAB_PPAP`),
  KEY `FK1_CAB_Customer_PN-CAB_PPAP` (`FK_CAB_Customer_PN`),
  CONSTRAINT `FK1_CAB_Customer_PN-CAB_PPAP` FOREIGN KEY (`FK_CAB_Customer_PN`) REFERENCES `cables_customer_pn` (`CAB_Customer_PN`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.cables_ppap: ~3 rows (approximately)
INSERT INTO `cables_ppap` (`ID_CAB_PPAP`, `FK_CAB_Customer_PN`, `PPAP_Requested_Date`, `PPAP_Received_Date`, `PPAP_Sent_Date`, `PPAP_Signed_Date`) VALUES
	(4, '67845380', '2024-12-10', NULL, NULL, NULL),
	(5, '67845381', '2025-06-24', NULL, NULL, NULL),
	(6, '67845382', '2025-01-10', NULL, NULL, '2025-01-16'),
	(9, '67845380', '2025-09-18', NULL, NULL, NULL);

-- Dumping structure for table eurotechdb.tapes
CREATE TABLE IF NOT EXISTS `tapes` (
  `Eurotech_PN_TAP` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Tape` varchar(25) NOT NULL,
  `Description` tinytext NOT NULL,
  `Width` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Length` varchar(8) NOT NULL,
  `Color` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SAP_Number` varchar(7) DEFAULT NULL,
  `Product_Family` varchar(20) NOT NULL,
  `CTC` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`Eurotech_PN_TAP`) USING BTREE,
  UNIQUE KEY `SAP_Number` (`SAP_Number`),
  UNIQUE KEY `CTC` (`CTC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tapes: ~36 rows (approximately)
INSERT INTO `tapes` (`Eurotech_PN_TAP`, `Tape`, `Description`, `Width`, `Length`, `Color`, `SAP_Number`, `Product_Family`, `CTC`) VALUES
	('1000321', '651MSX', '651MSX-25-20-BLK', '25', '20', 'BLK', NULL, 'Tape-WH', '184244'),
	('1000322', '8310SE', '8310SE-25-25-BLK', '25', '25', 'BLK', NULL, 'Tape-WH', '183452'),
	('1000324', '837X', '837X-38-25-BLK', '38', '25', 'BLK', '99264', 'Tape-WH', '99264'),
	('1000325', '8551', '8551-9-25-BLK', '9', '25', 'BLK', '176644', 'Tape-WH', '176644'),
	('1288X1925SLV', '1288X', '1288X-19-25-SLV', '19', '25', 'SLV', '205138', 'Tape-WH', NULL),
	('3171933WHT', '317', '317-19-33-WHT', '19', '33', 'WHT', '156317', 'Tape-WH', NULL),
	('317933WHT', '317', '317-9-33-WHT', '9', '33', 'WHT', NULL, 'Tape-WH', '179029'),
	('5051925BLK', '505', '505-19-25-BLK', '19', '25', 'BLK', '174104', 'Tape-WH', NULL),
	('5121925BLK', '512', '512-19-25-BLK', '19', '25', 'BLK', '173540', 'Tape-WH', NULL),
	('651MSX1933OR', '651MSX', '651MSX-19-33-ORG', '19', '33', 'ORG', '191015', 'Tape-WH', NULL),
	('651MSX2533OR', '651MSX', '651MSX-25-33-ORG', '25', '33', 'ORG', '235687', 'Tape-WH', NULL),
	('831925B', '839', '839-19-25-BLK', '19', '25', 'BLK', '177227', 'Tape-WH', NULL),
	('832MPX1915BK', '832MPX', '832MPX-19-15-BLK', '19', '15', 'BLK', '174352', 'Tape-WH', '174352'),
	('832MPXRTBKR', '832MPX-RT', '832MPXRT-35-10-BLK-RT', '35', '10', 'BLK-RT', NULL, 'Tape-WH', '164194'),
	('833MPX195BLK', '833MPX', '833MPX-19-5-BLK', '19', '5', 'BLK', '174060', 'Tape-WH', NULL),
	('834MPX1905BK', '834MPX', '834MPX-19-5-BLK', '19', '5', 'BLK', '141009', 'Tape-WH', '141009'),
	('8351925BLK', '835', '835-19-25-BLK', '19', '25', 'BLK', '172412', 'Tape-WH', NULL),
	('835X1925BLK', '835X', '835X-19-25-BLK', '19', '25', 'BLK', '156361', 'Tape-WH', NULL),
	('835X2525BLK', '835X', '835X-25-25-BLK', '25', '25', 'BLK', '180814', 'Tape-WH', NULL),
	('835X925BLK', '835X', '835X-9-25-BLK', '9', '25', 'BLK', '180389', 'Tape-WH', NULL),
	('8371925B', '837X', '837X-19-25-BLK', '19', '25', 'BLK', '99631', 'Tape-WH', '99631'),
	('8371925O', '837X', '837X-19-25-ORG', '19', '25', 'ORG', '147094', 'Tape-WH', NULL),
	('83751925', '8375X', '8375X-19-25-BLK', '19', '25', 'BLK', '92184', 'Tape-WH', NULL),
	('837X1925GRY', '837X', '837X-19-25-GRY', '19', '25', 'GRY', NULL, 'Tape-WH', '224247'),
	('837X2525BLK', '837X', '837X-25-25-BLK', '25', '25', 'BLK', '118710', 'Tape-WH', '118710'),
	('837XRT3510BK', '837XRT', '837X RT-35-10-BLK', '35', '10', 'BLK', '172995', 'Tape-WH', '172995'),
	('8381966G', '838X', '838X-19-66-GRY', '19', '66', 'GRY', NULL, 'Tape-WH', NULL),
	('8391925B', '839X', '839X-19-25-BLK', '19', '25', 'BLK', '154505', 'Tape-WH', NULL),
	('85101910BLK', '8510', '8510-19-10-BLK', '19', '10', 'BLK', '169355', 'Tape-WH', NULL),
	('8515X1910BLK', '8515X', '8515X-19-10-BLK', '19', '10', 'BLK', '53400', 'Tape-WH', NULL),
	('85511925BLK', '8551', '8551-19-25-BLK', '19', '25', 'BLK', '105407', 'Tape-WH', NULL),
	('8555X1920BLK', '8555X', '8555X-19-20-BLK', '19', '20', 'BLK', '117852', 'Tape-WH', '117852'),
	('8575X1905BLK', '8575X', '8575X-19-5-BLK', '19', '5', 'BLK', '53401', 'Tape-WH', NULL),
	('8801915B', '880', '880-19-15-BLK', '19', '15', 'BLK', NULL, 'Tape-WH', '111200'),
	('CP837X525ORG', 'CP-TKB0924 / 837X', 'CP-TKB0924 / 837X-5mm-25mm-ORG', '5mm', '25mm', 'ORG', '234350', 'Tape-WH', NULL);

-- Dumping structure for table eurotechdb.tapes_customers
CREATE TABLE IF NOT EXISTS `tapes_customers` (
  `ID_TAP_Customer` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID_TAP_Customer`) USING BTREE,
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tapes_customers: ~11 rows (approximately)
INSERT INTO `tapes_customers` (`ID_TAP_Customer`, `Name`) VALUES
	(6, 'Amphenol FCI/TCS'),
	(13, 'Amphenol ICA (Integrated Cable Assembly)'),
	(7, 'AutoKabel of North America'),
	(10, 'Bizlink (Productos Excel de Mexico)'),
	(12, 'CVG'),
	(3, 'Flextronics'),
	(9, 'GG Cables&Wires'),
	(11, 'Julian Electric'),
	(8, 'Kalas Manufacturing'),
	(14, 'SEWS (Sumitomo Electric Wiring Systems)'),
	(4, 'St. Clair'),
	(5, 'Textape');

-- Dumping structure for table eurotechdb.tapes_customer_pn
CREATE TABLE IF NOT EXISTS `tapes_customer_pn` (
  `TAP_Customer_PN` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FK_ID_TAP_Customer` int NOT NULL,
  `FK_Eurotech_PN_TAP` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`TAP_Customer_PN`) USING BTREE,
  KEY `FK1_TAP_Cust-TAP_Cust_PN` (`FK_ID_TAP_Customer`) USING BTREE,
  KEY `FK2_TAP-TAP_Cust_PN` (`FK_Eurotech_PN_TAP`) USING BTREE,
  CONSTRAINT `FK1_TAP_Cust-TAP_Cust_PN` FOREIGN KEY (`FK_ID_TAP_Customer`) REFERENCES `tapes_customers` (`ID_TAP_Customer`),
  CONSTRAINT `FK2_TAP-TAP_Cust_PN` FOREIGN KEY (`FK_Eurotech_PN_TAP`) REFERENCES `tapes` (`Eurotech_PN_TAP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tapes_customer_pn: ~43 rows (approximately)
INSERT INTO `tapes_customer_pn` (`TAP_Customer_PN`, `FK_ID_TAP_Customer`, `FK_Eurotech_PN_TAP`) VALUES
	('10164237-001', 6, '831925B'),
	('10173694-001', 6, '8371925O'),
	('10173843-001', 6, '8371925B'),
	('108250', 9, '8801915B'),
	('122G0-001488-01', 10, '837X2525BLK'),
	('122G0-001639-01', 10, '8575X1905BLK'),
	('122G0-004059-01', 10, '317933WHT'),
	('122GO-002704-01', 10, '834MPX1905BK'),
	('130851', 12, '8575X1905BLK'),
	('131646', 12, '1000324'),
	('138950', 12, '832MPX1915BK'),
	('146820', 12, '8555X1920BLK'),
	('149607', 12, '837XRT3510BK'),
	('162844', 9, '832MPX1915BK'),
	('198217', 9, '837XRT3510BK'),
	('2195', 8, '837X1925GRY'),
	('2196', 8, '8381966G'),
	('40002226', 14, '833MPX195BLK'),
	('40002433', 14, '8371925O'),
	('40002497', 14, '651MSX1933OR'),
	('40002498', 14, '651MSX2533OR'),
	('40021714', 14, '85511925BLK'),
	('40021743', 14, '8515X1910BLK'),
	('40021778', 14, '835X1925BLK'),
	('40021779', 14, '835X2525BLK'),
	('40021787', 14, '85101910BLK'),
	('40021804', 14, '1000325'),
	('40021815', 14, '835X925BLK'),
	('40021836', 14, '8351925BLK'),
	('40021860', 14, '832MPX1915BK'),
	('40021861', 14, '834MPX1905BK'),
	('40193540', 14, '5051925BLK'),
	('40194876', 14, 'CP837X525ORG'),
	('40194891', 14, '5121925BLK'),
	('48254', 7, '83751925'),
	('49997', 7, '8391925B'),
	('634421 25 00', 3, '1000321'),
	('648145 19 99', 3, '3171933WHT'),
	('707597-19-00', 3, '83751925'),
	('710065 25 00', 3, '1000322'),
	('71076600', 3, '1288X1925SLV'),
	('832MPX-RT', 11, '832MPXRTBKR'),
	('837X 25 BK', 3, '837X2525BLK'),
	('837X-19-BK', 3, '8371925B'),
	('837X-19MM', 13, '8371925B'),
	('CHT8551BK-354', 5, '1000325'),
	('M1317', 4, '8371925B'),
	('M1517', 4, '1000324');

-- Dumping structure for table eurotechdb.tapes_ppap
CREATE TABLE IF NOT EXISTS `tapes_ppap` (
  `ID_TAP_PPAP` int NOT NULL AUTO_INCREMENT,
  `PPAP_level` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FK_TAP_Customer_PN` varchar(30) NOT NULL,
  `IMDS_ID_No` varchar(8) DEFAULT NULL,
  `Returned_CTC-Sent_Cust` date DEFAULT NULL,
  `Cust_Signed-Sent_CTC` date DEFAULT NULL,
  `PPAP_from_shipments` char(1) DEFAULT NULL,
  `Comments` tinytext,
  PRIMARY KEY (`ID_TAP_PPAP`) USING BTREE,
  KEY `FK3_TAP_Cust_PN-TAP_PPAP` (`FK_TAP_Customer_PN`),
  CONSTRAINT `FK3_TAP_Cust_PN-TAP_PPAP` FOREIGN KEY (`FK_TAP_Customer_PN`) REFERENCES `tapes_customer_pn` (`TAP_Customer_PN`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tapes_ppap: ~36 rows (approximately)
INSERT INTO `tapes_ppap` (`ID_TAP_PPAP`, `PPAP_level`, `FK_TAP_Customer_PN`, `IMDS_ID_No`, `Returned_CTC-Sent_Cust`, `Cust_Signed-Sent_CTC`, `PPAP_from_shipments`, `Comments`) VALUES
	(4, '2', '10164237-001', '48001', '2023-08-24', '2023-10-03', NULL, NULL),
	(5, '2', '10173694-001', '48001', '2024-01-11', '2024-01-11', NULL, NULL),
	(6, '2', '10173843-001', '48001', '2024-01-08', '2024-01-22', NULL, NULL),
	(7, '2', '49997', '645', '2021-11-22', '2022-02-01', NULL, NULL),
	(8, '2', '48254', '645', '2021-03-25', NULL, NULL, NULL),
	(9, NULL, '122GO-002704-01', '40429', '2025-08-05', '2025-08-07', '*', NULL),
	(10, NULL, '122G0-001488-01', '40429', NULL, NULL, NULL, NULL),
	(11, NULL, '122G0-001639-01', '40429', NULL, NULL, NULL, NULL),
	(12, '4', '198217', '17916', '2025-05-23', NULL, NULL, NULL),
	(13, '2', '71076600', '21733', '2021-06-23', NULL, NULL, 'no aparece en netsuite'),
	(14, '4', '707597-19-00', '21733', '2019-08-15', '2019-08-15', NULL, 'no aparece en netsuite'),
	(15, '4', '837X-19-BK', '21733', '2023-04-04', NULL, NULL, 'no aparece en netsuite'),
	(16, '4', '648145 19 99', '21733', '2019-11-05', '2019-12-02', NULL, 'no aparece en netsuite'),
	(17, '2', '138950', '132984', '2024-11-25', NULL, NULL, NULL),
	(18, '4', '149607', '132984', '2025-05-19', NULL, NULL, NULL),
	(19, '2', '130851', '132984', '2024-11-27', NULL, NULL, NULL),
	(20, '2', '131646', '132984', '2024-11-25', NULL, NULL, NULL),
	(21, '4', '149607', '132984', '2025-05-19', NULL, '*', NULL),
	(22, '4', '146820', '132984', '2025-07-24', '2025-07-30', '*', NULL),
	(23, '4', '40021779', '56697', '2019-08-20', '2019-09-09', NULL, NULL),
	(24, '2', '40021778', '56697', '2018-10-01', '2018-11-26', NULL, NULL),
	(25, '2', '40021804', '56697', '2019-11-06', '2019-12-06', NULL, NULL),
	(26, '2', '40002433', '56697', '2022-09-26', NULL, NULL, NULL),
	(27, '2', '40021815', '56697', '2020-03-02', NULL, NULL, NULL),
	(28, '4', '40021743', '56697', '2019-08-20', '2019-09-09', NULL, NULL),
	(29, '4', '40021860', '56697', '2023-02-06', '2023-05-05', NULL, NULL),
	(30, '4', '40021861', '56697', '2023-01-24', '2023-02-20', NULL, NULL),
	(31, '4', '40194876', '56697', '2023-04-18', '2023-04-19', NULL, NULL),
	(32, '4', '40002226', '56697', NULL, NULL, NULL, NULL),
	(33, '2', '40002498', '56697', '2023-05-17', '2023-05-23', NULL, NULL),
	(34, '2', '40002497', '56697', '2023-05-01', '2023-05-22', NULL, NULL),
	(35, '4', '40194891', '56697', '2023-05-05', '2023-05-25', NULL, NULL),
	(36, '4', '40193540', '56697', '2023-10-24', NULL, NULL, NULL),
	(37, '2', '40021787', '56697', NULL, '2023-09-13', NULL, NULL),
	(38, '4', '40021714', '56697', '2024-02-05', NULL, NULL, NULL),
	(39, '4', '40021836', '56697', '2024-09-16', '2024-09-19', NULL, NULL);

-- Dumping structure for table eurotechdb.tapes_ppap_missing
CREATE TABLE IF NOT EXISTS `tapes_ppap_missing` (
  `ID_TAP_PPAP_Missing` int NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `FK_TAP_Customer_PN` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Form_Sent_Cust` date DEFAULT NULL,
  `Reminder` date DEFAULT NULL,
  `Received-RQ_Sent_CTC` date DEFAULT NULL,
  `Closing_Date` date DEFAULT NULL,
  `Comments` tinytext,
  PRIMARY KEY (`ID_TAP_PPAP_Missing`),
  KEY `FK3_TAP_Customer_PN-TAP_PPAP_Missing` (`FK_TAP_Customer_PN`),
  CONSTRAINT `FK3_TAP_Customer_PN-TAP_PPAP_Missing` FOREIGN KEY (`FK_TAP_Customer_PN`) REFERENCES `tapes_customer_pn` (`TAP_Customer_PN`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tapes_ppap_missing: ~16 rows (approximately)
INSERT INTO `tapes_ppap_missing` (`ID_TAP_PPAP_Missing`, `Date`, `FK_TAP_Customer_PN`, `Form_Sent_Cust`, `Reminder`, `Received-RQ_Sent_CTC`, `Closing_Date`, `Comments`) VALUES
	(4, '2025-05-08', '634421 25 00', '2025-05-08', '2025-05-16', '2025-05-16', '2025-07-17', 'SENT'),
	(5, '2025-05-08', '710065 25 00', '2025-05-08', '2025-05-16', '2025-05-16', '2025-06-03', 'SENT'),
	(6, '2025-05-08', 'M1317', '2025-05-08', '2025-05-16', '2025-05-16', '2025-05-16', 'SENT'),
	(7, '2025-05-08', 'M1517', '2025-05-08', '2025-05-16', '2025-05-16', '2025-05-16', 'SENT'),
	(8, '2025-05-08', 'CHT8551BK-354', '2025-05-08', '2025-05-16', '2025-06-02', '2025-06-18', 'SENT'),
	(9, '2025-07-27', '2196', '2025-07-28', '2025-08-01', '2025-08-22', NULL, NULL),
	(10, '2025-08-22', '108250', '2025-08-22', '2025-08-28', NULL, NULL, NULL),
	(11, '2025-05-08', '832MPX-RT', '2025-05-09', NULL, '2025-05-16', '2025-07-11', 'SENT'),
	(12, '2025-05-08', '149607', '2025-05-09', NULL, '2025-05-12', '2025-05-22', 'PPAP SENT to CUS'),
	(13, '2025-05-30', '837X 25 BK', '2025-06-03', NULL, NULL, '2025-06-04', 'REAL PN 704206 25 00'),
	(14, '2025-07-11', '146820', '2025-07-11', NULL, '2025-07-14', '2025-07-29', 'SENT'),
	(15, '2025-05-09', '122G0-004059-01', '2025-05-09', '2025-05-23', '2025-07-14', '2025-08-07', 'SENT'),
	(16, '2025-05-16', '122GO-002704-01', '2025-05-16', '2025-05-23', '2025-07-14', '2025-08-07', 'SENT'),
	(17, '2025-07-25', '2195', '2025-07-28', '2025-08-01', '2025-08-22', NULL, NULL),
	(18, '2025-08-22', '837X-19MM', '2025-08-22', '2025-08-28', NULL, NULL, 'Anahí sent us to Alejandro and Edgar'),
	(19, '2025-08-29', '162844', '2025-08-29', NULL, NULL, NULL, NULL);

-- Dumping structure for table eurotechdb.tapes_renewal
CREATE TABLE IF NOT EXISTS `tapes_renewal` (
  `ID_TAP_Renewal` int NOT NULL AUTO_INCREMENT,
  `Renewal_Date` date DEFAULT NULL,
  `Send_Request_CTC` date DEFAULT NULL,
  `Sent_Customer` date DEFAULT NULL,
  `Returned_Cust_Signed` date DEFAULT NULL,
  `FK_ID_TAP_PPAP` int NOT NULL,
  PRIMARY KEY (`ID_TAP_Renewal`),
  KEY `FK1_TAP_PPAP-TAP_Renewal` (`FK_ID_TAP_PPAP`),
  CONSTRAINT `FK1_TAP_PPAP-TAP_Renewal` FOREIGN KEY (`FK_ID_TAP_PPAP`) REFERENCES `tapes_ppap` (`ID_TAP_PPAP`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tapes_renewal: ~46 rows (approximately)
INSERT INTO `tapes_renewal` (`ID_TAP_Renewal`, `Renewal_Date`, `Send_Request_CTC`, `Sent_Customer`, `Returned_Cust_Signed`, `FK_ID_TAP_PPAP`) VALUES
	(3, '2024-08-23', '2024-06-24', '2024-08-06', NULL, 4),
	(4, '2025-08-23', '2025-06-24', NULL, NULL, 4),
	(5, '2025-01-10', '2024-11-11', '2025-01-06', NULL, 5),
	(6, '2025-01-07', '2024-11-08', '2025-01-06', NULL, 6),
	(7, '2024-02-01', '2023-12-03', '2024-03-11', NULL, 7),
	(8, '2025-03-11', '2025-01-10', '2025-01-06', '2025-03-26', 7),
	(9, '2024-02-23', '2023-12-25', '2024-03-12', NULL, 8),
	(10, '2025-03-12', '2025-01-11', '2025-01-17', '2025-02-18', 8),
	(11, '2024-05-12', '2024-03-13', '2024-08-05', NULL, 13),
	(12, '2025-03-13', '2025-01-12', '2025-01-24', NULL, 13),
	(13, '2024-08-22', '2024-06-23', '2024-07-25', NULL, 14),
	(14, '2025-06-23', '2025-04-24', '2025-05-14', '2025-07-15', 14),
	(15, '2024-04-03', '2024-02-03', '2024-05-23', NULL, 15),
	(16, '2025-04-03', '2025-02-02', '2025-02-21', '2025-03-14', 15),
	(17, '2024-04-05', '2024-02-05', '2024-01-16', '2024-01-29', 16),
	(18, '2025-01-15', '2024-11-16', '2025-02-04', '2025-02-10', 16),
	(19, NULL, NULL, '2025-01-28', NULL, 20),
	(20, '2024-07-19', '2024-05-20', '2024-08-05', NULL, 23),
	(21, '2025-08-05', '2025-06-06', '2025-02-21', '2025-03-05', 23),
	(22, '2024-07-19', '2024-05-20', '2024-07-12', '2024-08-20', 24),
	(23, '2025-07-12', '2025-05-13', '2025-02-21', NULL, 24),
	(24, '2024-07-19', '2024-05-20', '2024-07-12', '2024-08-20', 25),
	(25, '2025-07-12', '2025-05-13', '2025-02-21', NULL, 25),
	(26, '2024-09-25', '2024-07-27', '2024-09-10', '2024-09-13', 26),
	(27, '2025-09-10', '2025-07-12', '2025-05-19', NULL, 26),
	(28, '2024-01-10', '2023-11-11', '2024-03-11', NULL, 27),
	(29, '2025-03-11', '2025-01-10', '2025-01-16', '2025-01-30', 27),
	(30, '2024-10-27', '2024-08-28', '2024-02-05', NULL, 28),
	(31, '2025-02-04', '2024-12-06', '2025-02-24', '2025-03-05', 28),
	(32, '2024-02-06', '2023-12-08', '2024-03-11', NULL, 29),
	(33, '2025-03-11', '2025-01-10', '2025-01-06', NULL, 29),
	(34, '2024-01-24', '2023-11-25', '2024-04-24', '2024-05-02', 30),
	(35, '2025-04-24', '2025-02-23', '2025-03-12', NULL, 30),
	(36, '2024-04-17', '2024-02-17', '2024-07-24', NULL, 31),
	(37, '2025-07-24', '2025-05-25', '2025-03-17', NULL, 31),
	(38, NULL, NULL, '2024-02-16', '2024-02-27', 32),
	(39, '2025-02-15', '2024-12-17', NULL, NULL, 32),
	(40, '2024-05-16', '2024-03-17', '2024-07-25', '2024-08-20', 33),
	(41, '2027-07-25', '2025-05-26', '2025-03-27', NULL, 33),
	(42, '2024-04-30', '2024-03-01', '2024-07-24', '2024-08-20', 34),
	(44, '2025-04-30', '2025-03-01', '2025-03-17', NULL, 34),
	(45, '2024-05-04', '2024-03-05', NULL, NULL, 35),
	(46, '2025-05-04', '2025-03-05', '2025-03-17', NULL, 35),
	(47, '2024-10-23', '2024-08-24', NULL, NULL, 36),
	(48, '2025-10-23', '2025-08-24', NULL, NULL, 36),
	(49, '2024-09-12', '2024-07-14', '2024-08-06', NULL, 37),
	(50, '2025-08-06', '2025-06-07', NULL, NULL, 37),
	(51, '2025-02-04', '2024-12-06', '2025-01-06', '2025-01-30', 38),
	(52, '2025-09-16', '2025-07-18', NULL, NULL, 39);

-- Dumping structure for table eurotechdb.tubes
CREATE TABLE IF NOT EXISTS `tubes` (
  `Eurotech_PN_TUB` varchar(10) NOT NULL,
  `ET_Model` varchar(10) DEFAULT NULL,
  `ET_Dwg` varchar(8) DEFAULT NULL,
  `Description` tinytext NOT NULL,
  PRIMARY KEY (`Eurotech_PN_TUB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tubes: ~27 rows (approximately)
INSERT INTO `tubes` (`Eurotech_PN_TUB`, `ET_Model`, `ET_Dwg`, `Description`) VALUES
	('E101707', NULL, NULL, 'DWT(RX), 4:1 SHRINK RATIO, 10.8 ID, CL, 100mm LENGTH'),
	('E101710', NULL, NULL, 'DWT(RO),4:1 SHRINK RATIO, 7.40 ID, BK, 50mm LENGTH'),
	('P000030', 'ET00', 'D000002', 'ET00 SWS135-55PXV000, 3.2/1.6-Black'),
	('P000042', 'ET10', 'D000004', 'ET10 DWS125-40PXGEVS, 8/2-30mm Black'),
	('P000043', 'ET10', 'D000004', 'ET10 DWS125-40PXGEVS, 12/3-50mm Black'),
	('P000053', 'ET22', 'D000030', 'ET22 DWS125-40PXYEVH, 18.3/4.5-50mm BLK'),
	('P000106', 'ET22', 'D000030', 'ET22 DWS125-40PXYEVH, 5.7/1.3-50mm BLK'),
	('P000109', 'ET22', 'D000030', 'ET22-7.5/1.7-Blk-35mm'),
	('P000110', 'ET00', 'D000002', 'ET00-3.2/1.6-30MM-BLK'),
	('P000115', 'ET72', 'D000066', 'ET72-9.5/4.8-38MM-BLK'),
	('P000116', 'ET22', 'D000030', 'ET22 DWS125-40PXYEVH, 5.7/1.3-20mm BLK'),
	('P000117', 'ET22', 'D000030', 'ET22 DWS125-40PXYEVH, 5.7/1.3-35mm BLK'),
	('P000121', 'ET22', 'D000030', 'ET22 DWS125-40PXYEVH, 7.5/1.7-50mm BLK'),
	('P000198', 'ET10', 'D000004', 'ET10-12.0/3.0-35MM-BLK'),
	('P000215', 'ET25', 'D000060', 'ET25-5.7/1.3-BLK-65MM'),
	('P000217', 'ET25', 'D000060', 'ET25-11.0/2.5-65mm BLK'),
	('P000238', 'ET87', 'D000073', 'ET87-27.9/8.4-BLK-50mm'),
	('P000260', 'ET14', 'D000008', 'ET14-5.7/1.3-40MM-BLK'),
	('P000269', 'ET25', 'D000060', 'ET25-11.0/2.5-BLK-45MM'),
	('P000270', 'ET25', 'D000060', 'ET25-11.0/2.5-120MM-RED'),
	('P000285', 'ET25', 'D000060', 'ET25-14.0/3.0-BLK-45MM'),
	('P000286', 'ET25', 'D000060', 'ET25-14.0/3.0-BLK-65MM'),
	('P000289', 'ET25', 'D000060', 'ET25-5.7/1.3-27MM-BLK'),
	('P000318', 'ET25', 'D000060', 'ET25-18.3/4.5-37MM-BLK'),
	('P000336', 'ET25', 'D000060', 'ET25-5.7/1.3R-BLK-30mm'),
	('P000360', 'ET25', 'D000060', 'ET25-11.0/2.4R-BLK-30mm'),
	('P000415', 'ET25', 'D000060', 'ET25-18.3/4.5R-BK-50mm'),
	('P000677', 'ET84', 'D000078', 'ET84-5.7/1.3-BLK-35mm'),
	('P000708', 'ET70', 'D000070', 'ET70-1.6/0.8-BLK-50mm'),
	('P001078', 'ET49', 'D000063', 'ET49-9.5/4.8-BLK-50mm'),
	('P001080', 'ET87', 'D000073', 'ET87-11.6/2.5-BLK-33mm'),
	('P001081', 'ET87', 'D000073', 'ET87-17.8/4.4-BLK-33mm'),
	('P001083', 'ET87', 'D000073', 'ET87-11.6/2.5-RED-33mm'),
	('P001085', 'ET87', 'D000073', 'ET87-11.6/2.5-BLK-40mm'),
	('P001107', 'ET05', 'D000049', 'ET05-7.5/2.5-BK-35mm - no print'),
	('P001117', 'ET00', 'D000002', 'ET00-4.8/2.4-BK-35mm - no print'),
	('P001153', 'ET25', 'D000060', 'ET25-28.0/7.0-BK-50mm');

-- Dumping structure for table eurotechdb.tubes_customer-country
CREATE TABLE IF NOT EXISTS `tubes_customer-country` (
  `TUB_Customer-Country` int NOT NULL AUTO_INCREMENT,
  `Country` varchar(20) NOT NULL,
  `FK_ID_TUB_Customer` int NOT NULL,
  PRIMARY KEY (`TUB_Customer-Country`) USING BTREE,
  KEY `FK1_TUB_Cust-TUB_Cust-Cont` (`FK_ID_TUB_Customer`),
  CONSTRAINT `FK1_TUB_Cust-TUB_Cust-Cont` FOREIGN KEY (`FK_ID_TUB_Customer`) REFERENCES `tubes_customers` (`ID_TUB_Customer`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tubes_customer-country: ~10 rows (approximately)
INSERT INTO `tubes_customer-country` (`TUB_Customer-Country`, `Country`, `FK_ID_TUB_Customer`) VALUES
	(3, 'MEX', 3),
	(4, 'MEX', 4),
	(5, 'MEX', 5),
	(6, 'EU', 6),
	(7, 'North America', 7),
	(8, 'Brazil', 7),
	(9, 'Japan', 8),
	(10, 'MEX', 9),
	(11, 'MEX', 10),
	(12, 'Germany', 11),
	(13, 'North America', 12),
	(14, 'Morocco', 12),
	(15, 'MEX', 13);

-- Dumping structure for table eurotechdb.tubes_customers
CREATE TABLE IF NOT EXISTS `tubes_customers` (
  `ID_TUB_Customer` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TUB_Customer`) USING BTREE,
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tubes_customers: ~9 rows (approximately)
INSERT INTO `tubes_customers` (`ID_TUB_Customer`, `Name`) VALUES
	(3, 'Autokabel'),
	(9, 'CEMM'),
	(10, 'ECI'),
	(12, 'Lear'),
	(6, 'Lear EU'),
	(11, 'Meissner'),
	(13, 'Nexans'),
	(8, 'Senko'),
	(4, 'SEWS'),
	(5, 'Tenneco'),
	(7, 'Yazaki');

-- Dumping structure for table eurotechdb.tubes_customer_pn
CREATE TABLE IF NOT EXISTS `tubes_customer_pn` (
  `TUB_Customer_PN` varchar(30) NOT NULL,
  `FK_ID_TUB_Customer` int NOT NULL,
  `FK_Eurotech_PN_TUB` varchar(10) NOT NULL,
  PRIMARY KEY (`TUB_Customer_PN`),
  KEY `FK1_TUB_Cust-TUB_Cust_PN` (`FK_ID_TUB_Customer`),
  KEY `FK2_TUB-TUB_Cust_PN` (`FK_Eurotech_PN_TUB`),
  CONSTRAINT `FK1_TUB_Cust-TUB_Cust_PN` FOREIGN KEY (`FK_ID_TUB_Customer`) REFERENCES `tubes_customers` (`ID_TUB_Customer`),
  CONSTRAINT `FK2_TUB-TUB_Cust_PN` FOREIGN KEY (`FK_Eurotech_PN_TUB`) REFERENCES `tubes` (`Eurotech_PN_TUB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tubes_customer_pn: ~30 rows (approximately)
INSERT INTO `tubes_customer_pn` (`TUB_Customer_PN`, `FK_ID_TUB_Customer`, `FK_Eurotech_PN_TUB`) VALUES
	('012538', 11, 'P000030'),
	('57225', 3, 'P000238'),
	('69321134', 4, 'P000217'),
	('69321135', 4, 'P000270'),
	('7094175930', 7, 'P000415'),
	('7094176230 Document ID 2552486', 7, 'P000336'),
	('7094176430 Document ID 2553139', 7, 'P000360'),
	('7094177130 Document ID 2757177', 7, 'P000708'),
	('95849363', 13, 'P000677'),
	('95850698', 13, 'E101710'),
	('95890015', 13, 'E101707'),
	('99932941', 8, 'P001080'),
	('99932942', 8, 'P001081'),
	('99932943', 8, 'P001085'),
	('99932947', 8, 'P001078'),
	('99932951', 8, 'P001083'),
	('E26424100', 12, 'P000042'),
	('E26459700', 12, 'P000043'),
	('E33300300', 12, 'P000053'),
	('E33301100', 12, 'P000106'),
	('E34284700', 12, 'P000121'),
	('E36091300', 6, 'P000198'),
	('E37679000', 6, 'P000260'),
	('E38846500', 6, 'P000269'),
	('E38848500', 6, 'P000215'),
	('E38923900', 6, 'P000285'),
	('E38925400', 6, 'P000286'),
	('E38925800', 6, 'P000289'),
	('E39339000', 6, 'P000318'),
	('E55046100', 6, 'P001153'),
	('GAT023', 9, 'P000117'),
	('GAT101', 9, 'P000116'),
	('GAT125', 9, 'P000109'),
	('GAT130', 9, 'P001107'),
	('GAT132', 9, 'P001117'),
	('HST555P78', 10, 'P000115'),
	('ZRM-982381-20', 5, 'P000110');

-- Dumping structure for table eurotechdb.tubes_ppap
CREATE TABLE IF NOT EXISTS `tubes_ppap` (
  `PPAP_Number` varchar(10) NOT NULL,
  `Vendor` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FK_ID_TUB_Customer` int NOT NULL,
  `FK_TUB_Customer-Country` int DEFAULT NULL,
  PRIMARY KEY (`PPAP_Number`),
  KEY `FK1_TUB_Cust_Coun-TUB_PPAP` (`FK_TUB_Customer-Country`),
  KEY `FK3_TUB_Customers-TUB_PPAP` (`FK_ID_TUB_Customer`),
  CONSTRAINT `FK1_TUB_Cust_Coun-TUB_PPAP` FOREIGN KEY (`FK_TUB_Customer-Country`) REFERENCES `tubes_customer-country` (`TUB_Customer-Country`),
  CONSTRAINT `FK3_TUB_Customers-TUB_PPAP` FOREIGN KEY (`FK_ID_TUB_Customer`) REFERENCES `tubes_customers` (`ID_TUB_Customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tubes_ppap: ~26 rows (approximately)
INSERT INTO `tubes_ppap` (`PPAP_Number`, `Vendor`, `FK_ID_TUB_Customer`, `FK_TUB_Customer-Country`) VALUES
	('PP00012-01', 'UPM', 9, 10),
	('PP00012-02', 'UPM', 9, 10),
	('PP00012-03', 'UPM', 9, 10),
	('PP00012-04', 'UPM', 9, 10),
	('PP00012-05', 'ETC', 9, 10),
	('PP00014-01', 'ETC', 10, 11),
	('PP00015-1', 'UPM', 11, 12),
	('PP00016-1', 'UPM', 12, 13),
	('PP00016-2', 'UPM', 12, 13),
	('PP00016-3', 'UPM', 12, 13),
	('PP00017-1', 'UPM', 12, 14),
	('PP00017-2', 'UPM', 12, 14),
	('PP00019-02', 'ETC', 13, 15),
	('PP00019-03', 'KTG', 13, 15),
	('PP00019-04', 'KTG', 13, 15),
	('PP00024-01', 'UPM', 6, 6),
	('PP00024-02', 'UPM', 6, 6),
	('PP00024-03', 'ETC', 6, 6),
	('PP00024-04', 'ETC', 6, 6),
	('PP00024-05', 'ETC', 6, 6),
	('PP00024-06', 'ETC', 6, 6),
	('PP00024-09', 'ETC', 6, 6),
	('PP00024-10', 'ETC', 6, 6),
	('PP00024-27', 'ETC', 6, 6),
	('PP00025-01', 'UPM', 5, 5),
	('PP00026-01', 'ETC', 4, 4),
	('PP00045-03', 'ETC', 3, 3),
	('PP00061-11', 'ETC', 7, 7),
	('PP00061-12', 'ETC', 7, 7),
	('PP00062-01', 'ETC', 7, 8),
	('PP00062-02', 'ETC', 7, 8),
	('PP00067-12', 'UPM', 8, 9),
	('PP00067-13', 'ETC', 8, 9),
	('PP00067-14', 'ETC', 8, 9),
	('PP00067-15', 'ETC', 8, 9),
	('PP00067-16', 'ETC', 8, 9);

-- Dumping structure for table eurotechdb.tubes_ppaps
CREATE TABLE IF NOT EXISTS `tubes_ppaps` (
  `ID_TUB_PPAPs` int NOT NULL AUTO_INCREMENT,
  `FK_PPAP_Number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PPAP_Req_by_Cus_Date` date DEFAULT NULL,
  `Current_Status` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Rev` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FK_TUB_Customer_PN` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IMDS_Number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IMDS_Status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PPAP_do` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Level` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Samples_Status` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Reason_submission` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Sent_Customer` date DEFAULT NULL,
  `PSW_Returned` date DEFAULT NULL,
  `Origin_from_report` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Comments` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Inspection_rep_numb` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID_TUB_PPAPs`),
  KEY `FK2_TUB_PPAP-TUB_PPAPs` (`FK_PPAP_Number`),
  KEY `FK_tubes_ppaps_tubes_customer_pn` (`FK_TUB_Customer_PN`),
  CONSTRAINT `FK2_TUB_PPAP-TUB_PPAPs` FOREIGN KEY (`FK_PPAP_Number`) REFERENCES `tubes_ppap` (`PPAP_Number`),
  CONSTRAINT `FK_tubes_ppaps_tubes_customer_pn` FOREIGN KEY (`FK_TUB_Customer_PN`) REFERENCES `tubes_customer_pn` (`TUB_Customer_PN`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table eurotechdb.tubes_ppaps: ~50 rows (approximately)
INSERT INTO `tubes_ppaps` (`ID_TUB_PPAPs`, `FK_PPAP_Number`, `PPAP_Req_by_Cus_Date`, `Current_Status`, `Rev`, `FK_TUB_Customer_PN`, `IMDS_Number`, `IMDS_Status`, `PPAP_do`, `Level`, `Samples_Status`, `Reason_submission`, `Sent_Customer`, `PSW_Returned`, `Origin_from_report`, `Comments`, `Inspection_rep_numb`) VALUES
	(4, 'PP00026-01', '2025-07-14', 'Approved 2025', '73', '69321134', '1188884297 / 3', NULL, '8-Jul-24', '1', 'n/a', 'Annual Validation', '2025-08-11', '2025-08-12', NULL, NULL, '#N/A'),
	(5, 'PP00026-01', '2024-06-18', 'Approved 2024', '62', '69321134', '1188884584 / 2', NULL, '8-Jul-24', '1', 'n/a', 'Annual Validation', '2024-08-12', '2024-08-23', NULL, NULL, '#N/A'),
	(6, 'PP00045-03', '2025-07-16', 'PSW Pending Approve', '34', '57225', '1313989235 / 2', '0', '22-Mar-24', '4', 'requested', 'Initial Submission', '2025-08-13', NULL, NULL, NULL, NULL),
	(7, 'PP00024-27', '2025-08-28', 'PPAP requested to ETC', NULL, 'E55046100', NULL, 'received', NULL, '3', 'requested', 'Initial Submission', NULL, NULL, NULL, NULL, '#N/A'),
	(8, 'PP00025-01', '2025-03-06', 'PSW Pending Approve', '39', 'ZRM-982381-20', '1285136462 / 1', 'ok', NULL, '1', 'requested', 'Annual Validation', '2025-04-01', NULL, NULL, NULL, '#N/A'),
	(9, 'PP00025-01', '2023-09-28', 'Approved 2023', '39', 'ZRM-982381-20', '1285136462', NULL, 'ok', '1', NULL, 'Annual Validation', '2023-11-22', '2023-12-14', NULL, NULL, '#N/A'),
	(10, 'PP00024-03', '2023-01-13', 'Approved 2023', NULL, 'E39339000', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2023-01-13', '2023-01-25', NULL, NULL, '#N/A'),
	(11, 'PP00024-03', '2024-01-25', 'PSW Pending Approve', '57', 'E39339000', '1187233533', NULL, 'ok', '1', 'n/a', 'Annual Validation', '2024-02-16', NULL, NULL, NULL, '#N/A'),
	(12, 'PP00024-04', '2023-05-03', 'PSW Pending Approve', NULL, 'E38848500', '1230873815', NULL, NULL, '2', NULL, 'Initial Submission', '2023-06-14', NULL, NULL, NULL, NULL),
	(13, 'PP00024-05', '2023-05-03', 'PSW Pending Approve', NULL, 'E38925400', '1230874098', NULL, NULL, '2', NULL, 'Initial Submission', '2023-06-14', NULL, NULL, NULL, NULL),
	(14, 'PP00026-01', '2022-11-21', 'Approved 2023', NULL, '69321134', '1188884297/2', NULL, NULL, '2', NULL, 'Initial Submission', '2023-01-17', '2023-02-27', NULL, NULL, NULL),
	(15, 'PP00061-11', '2025-05-16', 'PPAP ready to be sent to customer', '71', '7094175930', '1429983779 / 1', NULL, NULL, '4', 'n/a', 'Initial Submission', '2025-07-16', NULL, '**', NULL, NULL),
	(16, 'PP00061-12', '2025-06-13', 'Approved 2025', '20', '7094177130 Document ID 2757177', '1425408416 / 1', NULL, '6-Jun-24', '4', 'requested', 'Initial Submission', '2025-06-17', '2025-07-02', NULL, NULL, '#N/A'),
	(17, 'PP00062-01', '2024-07-20', 'PSW Pending Approve', '63', '7094176230 Document ID 2552486', '1349615142 / 1', 'SUBMITED', '15-Aug-24', '4', 'requested', 'Initial Submission', '2024-10-09', NULL, NULL, NULL, '#N/A'),
	(18, 'PP00062-02', '2024-07-20', 'PSW Pending Approve', '63', '7094176430 Document ID 2553139', '1349615309 / 1', 'SUBMITED', '19-Jul-24', '4', 'requested', 'Initial Submission', '2024-10-09', NULL, NULL, NULL, '#N/A'),
	(19, 'PP00067-12', '2025-01-17', 'PSW Pending Approve', '5', '99932947', '1394585216 / 1', NULL, NULL, '4', 'requested', 'Initial Submission', '2025-02-19', NULL, NULL, NULL, '#N/A'),
	(20, 'PP00067-13', '2025-01-17', 'Approved 2025', '30', '99932941', '1388020665 / 1', NULL, '45680', '4', 'requested', 'Initial Submission', '2025-01-28', '2025-04-03', NULL, NULL, '#N/A'),
	(21, 'PP00067-14', '2025-01-17', 'PSW Pending Approve', '30', '99932951', '1388371797 / 1', NULL, '23-Jan-25', '4', 'requested', 'Initial Submission', '2025-01-28', NULL, NULL, NULL, '#N/A'),
	(22, 'PP00067-15', '2025-01-17', 'Approved 2025', '30', '99932943', '1388373582 / 1', NULL, '45680', '4', 'requested', 'Initial Submission', '2025-01-28', '2025-04-03', NULL, NULL, '#N/A'),
	(23, 'PP00067-16', '2025-01-17', 'Approved 2025', '30', '99932942', '1388376764 / 1', NULL, '45680', '4', 'requested', 'Initial Submission', '2025-01-28', '2025-04-03', NULL, NULL, '#N/A'),
	(24, 'PP00012-01', '2023-09-21', 'PSW Pending Approve', '34', 'GAT125', '1076153443 / 2', NULL, NULL, '4', NULL, 'Annual Validation', '2023-11-21', NULL, NULL, NULL, '#N/A'),
	(25, 'PP00012-01', '2024-09-06', 'PSW Pending Approve', '45', 'GAT125', '1076153443 / 2', NULL, '9-Sep-24', '2', 'n/a', 'Annual Validation', '2024-10-03', NULL, NULL, NULL, '#N/A'),
	(26, 'PP00012-02', '2005-07-12', 'PSW Pending Approve', NULL, 'GAT101', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2021-11-29', NULL, NULL, NULL, NULL),
	(27, 'PP00012-02', '2005-07-14', 'PSW Pending Approve', NULL, 'GAT101', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2021-11-29', NULL, NULL, NULL, NULL),
	(28, 'PP00012-03', '2005-07-13', 'PSW Pending Approve', NULL, 'GAT023', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2021-11-29', NULL, NULL, NULL, NULL),
	(29, 'PP00012-03', '2005-07-14', 'PSW Pending Approve', NULL, 'GAT023', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2021-11-29', NULL, NULL, NULL, NULL),
	(30, 'PP00012-03', '2023-04-19', 'PSW Pending Approve', NULL, 'GAT023', '1076160554/2', NULL, NULL, '2', NULL, 'Annual Validation', '2023-05-23', NULL, NULL, NULL, NULL),
	(31, 'PP00012-03', '2024-10-11', 'PSW Pending Approve', '45', 'GAT023', '1076160554 / 2', NULL, NULL, '4', 'n/a', 'Annual Validation', '2024-11-12', NULL, NULL, NULL, '#N/A'),
	(32, 'PP00012-04', '2025-08-04', 'PSW requested to UPM', NULL, 'GAT132', NULL, NULL, NULL, '4', 'requested', 'Initial Submission', NULL, NULL, '**', NULL, NULL),
	(33, 'PP00012-05', '2025-08-04', 'PPAP received, pending to review files', NULL, 'GAT130', NULL, NULL, NULL, '4', 'requested', 'Initial Submission', NULL, NULL, '**', 'Requested by customer', NULL),
	(34, 'PP00014-01', '2005-07-14', 'Approved 2022', NULL, 'HST555P78', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2022-07-29', '2022-08-22', NULL, NULL, NULL),
	(35, 'PP00015-1', '2005-07-13', 'PSW Pending Approve', NULL, '012538', NULL, NULL, NULL, '1', NULL, 'Initial Submission', '2022-03-17', NULL, NULL, NULL, NULL),
	(36, 'PP00015-1', '2005-07-14', 'Approved 2022', NULL, '012538', NULL, NULL, NULL, '1', NULL, 'Initial Submission', '2022-03-17', '2022-08-03', NULL, NULL, NULL),
	(37, 'PP00016-1', '2005-07-14', 'Approved 2022', NULL, 'E33300300', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2022-05-12', '2022-06-08', NULL, NULL, NULL),
	(38, 'PP00016-2', '2005-07-14', 'Approved 2022', NULL, 'E33301100', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2022-05-12', '2022-06-01', NULL, NULL, NULL),
	(39, 'PP00016-3', '2005-07-14', 'Approved 2022', NULL, 'E34284700', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2022-05-12', '2022-05-19', NULL, NULL, NULL),
	(40, 'PP00017-1', '2005-07-14', 'PSW Pending Approve', NULL, 'E26424100', NULL, NULL, NULL, '2', NULL, 'Annual Validation', '2022-05-12', NULL, NULL, NULL, NULL),
	(41, 'PP00017-2', '2005-07-14', 'Approved 2022', NULL, 'E26459700', NULL, NULL, NULL, '2', NULL, 'Annual Validation', '2022-07-04', '2022-07-06', NULL, NULL, NULL),
	(42, 'PP00019-02', '2025-06-30', 'Approved 2025', NULL, '95849363', '1432978980 / 1', NULL, NULL, '4', 'n/a', 'Initial Submission', '2025-07-18', '2025-07-22', '**', NULL, '#N/A'),
	(43, 'PP00019-03', '2025-06-30', 'Approved 2025', NULL, '95850698', NULL, NULL, NULL, '4', 'n/a', 'Initial Submission', '2025-07-18', '2025-07-22', '**', NULL, '#N/A'),
	(44, 'PP00019-04', '2025-06-30', 'Approved 2025', NULL, '95890015', NULL, NULL, NULL, '4', 'n/a', 'Initial Submission', '2025-07-18', '2025-07-22', '**', NULL, '#N/A'),
	(45, 'PP00024-01', '2005-07-14', 'Approved 2022', NULL, 'E36091300', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2022-12-01', '2022-12-20', NULL, NULL, NULL),
	(46, 'PP00024-01', '2022-12-01', 'Approved 2022', NULL, 'E36091300', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2022-12-01', '2022-12-20', NULL, NULL, NULL),
	(47, 'PP00024-01', '2023-12-20', 'PSW Pending Approve', '14', 'E36091300', '1173706697', NULL, 'ok', '1', 'n/a', 'Annual Validation', '2024-01-30', NULL, NULL, NULL, '#N/A'),
	(48, 'PP00024-02', '2023-01-13', 'Approved 2023', NULL, 'E37679000', NULL, NULL, NULL, '2', NULL, 'Initial Submission', '2023-01-13', '2023-01-17', NULL, NULL, '#N/A'),
	(49, 'PP00024-02', '2024-01-17', 'PSW Pending Approve', '12', 'E37679000', '1177309185', NULL, 'ok', '1', 'n/a', 'Annual Validation', '2024-03-12', NULL, NULL, NULL, '#N/A'),
	(50, 'PP00024-09', '2023-05-03', 'PSW Pending Approve', NULL, 'E38846500', '1201418073', NULL, NULL, '2', NULL, 'Initial Submission', '2023-05-24', NULL, NULL, NULL, '#N/A'),
	(51, 'PP00024-09', '2025-06-10', 'PSW Pending Approve', '70', 'E38846500', '1201418073 / 1', NULL, NULL, '3', 'n/a', 'Annual Validation', '2025-06-27', NULL, NULL, NULL, '#N/A'),
	(52, 'PP00024-10', '2023-05-03', 'PSW Pending Approve', NULL, 'E38925800', '1214709577', NULL, NULL, '2', NULL, 'Initial Submission', '2023-05-23', NULL, NULL, NULL, '#N/A'),
	(53, 'PP00024-10', '2025-06-10', 'PSW Pending Approve', '70', 'E38925800', '1214709577 / 1', NULL, NULL, '3', 'n/a', 'Annual Validation', '2025-06-27', NULL, NULL, NULL, '#N/A');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
