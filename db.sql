-- MySQL dump 10.14  Distrib 5.5.36-MariaDB, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: china
-- ------------------------------------------------------
-- Server version	5.5.36-MariaDB-1~precise-log

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
-- Table structure for table `dish`
--

DROP TABLE IF EXISTS `dish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dish` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) DEFAULT NULL,
  `description` char(200) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `long_description` text,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dish`
--

LOCK TABLES `dish` WRITE;
/*!40000 ALTER TABLE `dish` DISABLE KEYS */;
INSERT INTO `dish` VALUES (1,'C1','Nasi Goreng',700,'gebratener Reis mit Curry, Hühnerfleisch, Schinken, Krabben und Mandeln'),(2,'C2','Gebratene Nudeln',700,'mit Hühnerfleisch und Gemüse'),(3,'C3','Schweinefilet',700,'mit Curry, Champignons, Bambussprossen'),(4,'C4','Gebratene Schweinebällchen',700,'mit süß-saurer Sauce'),(5,'C5','Chop Suey',700,'mit Schweinefleisch'),(6,'C6','Schweinefilet',700,'mit Bambussprossen und Sojakeimen'),(7,'C7','Gebackene Ente',900,'mit Champignonsauce'),(8,'C8','Hühnerfleish',760,'mit frischen Champignons und Mandeln'),(9,'C9','Hühnerfleisch',760,'mit Gemüse'),(10,'C10','Rinderfilet',760,'mit Curry, Champignons, Bambussprossen'),(11,'C11','Hühnerfleisch',760,'mit Curry, Bambus und Champignons'),(12,'32c','Gebratene Nudeln',420,'mit Schinken, Hühnerfleisch und Eiern'),(13,'32c','Gebratener Reis',420,'mit Schinken, Hühnerfleisch und Eieren'),(14,'32d','Hähnchen-Schnitzel',500,'mit Pommes frites'),(15,'32e','Gebackenes Hühnerfleisch',500,'mit Reis und süß-saurer Sauce');
/*!40000 ALTER TABLE `dish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `get_orders`
--

DROP TABLE IF EXISTS `get_orders`;
/*!50001 DROP VIEW IF EXISTS `get_orders`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `get_orders` (
  `uid` tinyint NOT NULL,
  `prename` tinyint NOT NULL,
  `did` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `long_description` tinyint NOT NULL,
  `amount` tinyint NOT NULL,
  `price` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `prename` char(50) NOT NULL,
  `surname` char(50) NOT NULL,
  `preferred_dish_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=790364697 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Max','Mustermann',1),(2,'Dieter','Pete',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `get_orders`
--

/*!50001 DROP TABLE IF EXISTS `get_orders`*/;
/*!50001 DROP VIEW IF EXISTS `get_orders`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`china`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `get_orders` AS select `user`.`uid` AS `uid`,`user`.`prename` AS `prename`,`dish`.`did` AS `did`,`dish`.`name` AS `name`,`dish`.`description` AS `description`,`dish`.`long_description` AS `long_description`,`orders`.`amount` AS `amount`,`dish`.`price` AS `price` from ((`user` join `dish`) join `orders`) where ((`orders`.`did` = `dish`.`did`) and (`orders`.`uid` = `user`.`uid`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-26 22:53:38
