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
-- Current Database: `wbd`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `wbd` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `wbd`;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Dark chocolate',10,20000,20,'Cokelat yang low calories','0.jpg'),(2,'JJ8',0,99,88,'jj','1.jpg'),(3,'choco',0,11,11,'cjoco','3.png'),(4,'Susanti Gojali',7,228,281,'felfei','4.jpg'),(5,'coco',0,123,22,'enak','5.jpg'),(6,'fefe',0,11,2,'fef','6.jpg'),(7,'dwdw',0,22,22,'dwdw','7.jpg'),(8,'okok',0,99,99,'o','8.jpg'),(9,'jj`0',0,99,99,'jj','9.jpg'),(10,'Susanti Gojali',0,12,12,'dd','10.jpg'),(12,'5',0,5,20000,'2020-08-3-17 09:42:11','Bandung'),(13,'5',0,5,20000,'2020-08-3-17 09:42:11','Bandung'),(14,'5',0,5,20000,'2020-08-3-17 09:42:11','Bandung');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,10,'eeE',10,50000,'2020-10-25 03:33:19','Bandung'),(2,1,'eeE',2,40000,'2020-10-25 03:33:19','Jakarta'),(3,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(4,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(5,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(6,5,'eeE',5,20000,'2020-08-03 10:00:00','Bandung'),(7,4,'eeE',3,684,'2020-10-25 05:13:58',''),(8,4,'eeE',4,912,'2020-10-25 05:15:07','');
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
INSERT INTO `user` VALUES ('eeE','ee@gmail.com','EE',0,'co7yfdfj5o'),('felicia123','aa@gmail.com','aa',0,NULL),('feliciagojali','abc123@gmail.com','123456',1,'mrl9,]&vo#'),('lia','lia@lia.com','lia',0,NULL),('pepe','pepe@email.com','1234',0,NULL),('saya','saya','saya',0,NULL),('ss','ss','ss',0,'-qmkv\"%bau'),('ssaa','ueue@uu.com','jjj',0,NULL),('willywangkong','ass@gmail.com','123455',0,NULL),('zzz','zzz','zzz',0,NULL);
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

-- Dump completed on 2020-10-25 18:16:40
