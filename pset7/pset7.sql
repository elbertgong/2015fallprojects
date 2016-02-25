-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `user_id` int(10) unsigned NOT NULL,
  `transaction` char(5) NOT NULL,
  `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `symbol` char(10) NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  `price` decimal(65,4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (9,'SELL','2015-11-06 07:59:58','',0,0.0000),(9,'BUY','2015-11-06 08:00:45','FREE',20,0.0500),(9,'SELL','2015-11-06 08:04:07','FREE',20,0.0500),(9,'BUY','2015-11-06 08:04:22','FREE',20,0.0500),(9,'BUY','2015-11-06 08:04:27','FREE',3,0.0500),(9,'SELL','2015-11-06 08:04:36','FREE',23,0.0500),(9,'BUY','2015-11-06 08:15:33','FREE',30,0.0500),(9,'BUY','2015-11-06 08:16:17','GOOG',1,731.2500),(9,'BUY','2015-11-06 08:20:59','GOOG',1,731.2500),(9,'SELL','2015-11-06 08:22:00','FREE',31,0.0500),(9,'BUY','2015-11-06 08:22:11','FREE',20,0.0500),(9,'BUY','2015-11-06 08:30:48','FREE',2,0.0500),(9,'SELL','2015-11-06 08:30:57','GOOG',23,731.2500),(9,'BUY','2015-11-06 08:31:02','FREE',2,0.0500),(9,'BUY','2015-11-06 08:31:07','GOOG',1,731.2500),(9,'BUY','2015-11-06 08:31:20','GOOG',20,731.2500),(9,'BUY','2015-11-06 08:49:03','GOOG',1,731.2500),(9,'SELL','2015-11-06 08:50:25','FREE',24,0.0500),(9,'BUY','2015-11-06 08:50:33','GOOG',1,731.2500),(9,'BUY','2015-11-06 08:50:42','FREE',1,0.0500),(9,'SELL','2015-11-06 09:18:42','GOOG',2,731.2500),(9,'BUY','2015-11-06 09:18:53','FB',3,108.7600),(9,'BUY','2015-11-06 09:18:57','GOOG',3,731.2500),(9,'SELL','2015-11-06 09:19:08','FB',6,108.7600),(9,'BUY','2015-11-06 15:49:36','GOOG',10,732.4020),(9,'BUY','2015-11-06 15:50:08','FREE',20,0.0526),(9,'SELL','2015-11-06 15:50:28','GOOG',30,732.5299),(9,'BUY','2015-11-06 15:54:10','GOOG',10,733.2000),(9,'BUY','2015-11-06 15:54:19','FREE',10,0.0552),(9,'SELL','2015-11-06 15:54:55','FREE',10,0.0552),(9,'BUY','2015-11-06 16:14:00','DIS',2,116.3500),(9,'BUY','2015-11-06 16:14:07','FREE',2,0.0549);
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,9,'GOOG',10),(3,9,'DIS',2),(4,9,'FREE',2);
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'andi','$2y$10$c.e4DK7pVyLT.stmHxgAleWq4yViMmkwKz3x8XCo4b/u3r8g5OTnS',10000.0000),(2,'caesar','$2y$10$0p2dlmu6HnhzEMf9UaUIfuaQP7tFVDMxgFcVs0irhGqhOxt6hJFaa',10000.0000),(3,'eli','$2y$10$COO6EnTVrCPCEddZyWeEJeH9qPCwPkCS0jJpusNiru.XpRN6Jf7HW',10000.0000),(4,'hdan','$2y$10$o9a4ZoHqVkVHSno6j.k34.wC.qzgeQTBHiwa3rpnLq7j2PlPJHo1G',10000.0000),(5,'jason','$2y$10$ci2zwcWLJmSSqyhCnHKUF.AjoysFMvlIb1w4zfmCS7/WaOrmBnLNe',10000.0000),(6,'john','$2y$10$dy.LVhWgoxIQHAgfCStWietGdJCPjnNrxKNRs5twGcMrQvAPPIxSy',10000.0000),(7,'levatich','$2y$10$fBfk7L/QFiplffZdo6etM.096pt4Oyz2imLSp5s8HUAykdLXaz6MK',10000.0000),(8,'rob','$2y$10$3pRWcBbGdAdzdDiVVybKSeFq6C50g80zyPRAxcsh2t5UnwAkG.I.2',10000.0000),(9,'skroob','$2y$10$395b7wODm.o2N7W5UZSXXuXwrC0OtFB17w4VjPnCIn/nvv9e4XUQK',19190.1854),(10,'zamyla','$2y$10$UOaRF0LGOaeHG4oaEkfO4O7vfI34B1W23WqHr9zCpXL68hfQsS3/e',10000.0000);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-06 16:17:05
