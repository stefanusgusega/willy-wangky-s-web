-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: wbd
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amountSold` int(8) NOT NULL,
  `price` int(8) NOT NULL,
  `amountRemaining` int(8) NOT NULL,
  `description` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Dark chocolate',21,20000,100,'Cokelat yang low calories','0.jpg'),(2,'JJ8',10,99,78,'coklat truffle dengan 6 jenis variasi','1.jpg'),(3,'choco',0,11,100,'satu keranjang coklat truffle aneka ragam variasi','3.png'),(4,'Susanti Gojali',31,228,257,'paket coklat berisi white choco, milk choco, dan dark choco','4.jpg'),(5,'coco',5,123,95,'cookies coklat yang crunchy di luar dan lembut di dalam','5.jpg'),(6,'fefe',0,11,100,'brownies coklat dengan campuran aneka macam choco crumble','6.jpg'),(7,'dwdw',25,22,100,'bola coklat dengan isian permen','7.jpg'),(8,'okok',15,99,84,'paket bola coklat dengan aneka macam balutan','8.jpg'),(9,'jj`0',8,99,91,'truffle coklat dengan aneka ragam coklat dalam wadah berbentuk hati','9.jpg'),(10,'chacha',16,12,100,'permen coklat dengan aneka macam warna','10.jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `amount` int(8) NOT NULL,
  `total` int(8) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `transaction_ibfk_1` (`productID`),
  KEY `transaction_ibfk_2` (`username`),
  CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`id`),
  CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,10,'eeE',10,50000,'2020-10-25 03:33:19','Bandung'),(2,1,'eeE',2,40000,'2020-10-25 03:33:19','Jakarta'),(3,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(4,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(5,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(6,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(10,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(11,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(12,4,'eeE',10,2280,'2020-10-25 12:54:49','apaya'),(13,2,'eeE',10,990,'2020-11-02 23:46:49','Bandung Selatan'),(14,5,'eeE',5,615,'2020-11-03 01:16:05','');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `superuser` tinyint(1) NOT NULL DEFAULT 0,
  `cookie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `name` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cookie` (`cookie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('eeE','ee@gmail.com','EE',0,NULL),('felicia123','aa@gmail.com','aa',0,NULL),('feliciagojali','abc123@gmail.com','123456',1,NULL),('lia','lia@lia.com','lia',0,NULL),('pepe','pepe@email.com','1234',0,NULL),('saya','saya','saya',0,NULL),('ss','ss','ss',0,'-qmkv\"%bau'),('ssaa','ueue@uu.com','jjj',0,NULL),('willywangkong','ass@gmail.com','123455',0,NULL),('zzz','zzz','zzz',0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-18 17:29:25
