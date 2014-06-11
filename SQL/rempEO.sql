-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: easyOrder
-- ------------------------------------------------------
-- Server version	5.5.37-1

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
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `refClient` int(11) NOT NULL AUTO_INCREMENT,
  `nomClient` text NOT NULL,
  `categ` text NOT NULL,
  `passClient` text NOT NULL,
  `adresse` text,
  `codePost` text,
  `ville` text,
  `pays` text,
  `telClient` text,
  `mailClient` text,
  `tvaIntracom` text,
  `correspondant` text,
  `remise` int(11) NOT NULL,
  `seuil` int(11) DEFAULT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`refClient`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES (1,'Albert SA','client','coucou','3 rue de lÃ ','01234','Broug','France','0456789012','albert@lbert.sa','FR123456789','Albert',500,1500000,1),(2,'Admin','admin','admin',' ',' ',' ',' ',' ','admin@nous.fr',' ',' ',0,0,1);
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Commandes`
--

DROP TABLE IF EXISTS `Commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Commandes` (
  `refCom` int(11) NOT NULL AUTO_INCREMENT,
  `refClient` int(11) DEFAULT NULL,
  `dateCom` date NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`refCom`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Commandes`
--

LOCK TABLES `Commandes` WRITE;
/*!40000 ALTER TABLE `Commandes` DISABLE KEYS */;
INSERT INTO `Commandes` VALUES (1,1,'2014-01-01',1,'1'),(2,1,'2014-02-01',1,'J\'aime beaucoup cette interface ! ');
/*!40000 ALTER TABLE `Commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Lignesco`
--

DROP TABLE IF EXISTS `Lignesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lignesco` (
  `refLico` int(11) NOT NULL AUTO_INCREMENT,
  `refCom` int(11) DEFAULT NULL,
  `clefProd` text,
  `quantite` int(11) NOT NULL,
  `puRemise` int(11) NOT NULL,
  PRIMARY KEY (`refLico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lignesco`
--

LOCK TABLES `Lignesco` WRITE;
/*!40000 ALTER TABLE `Lignesco` DISABLE KEYS */;
INSERT INTO `Lignesco` VALUES (1,1,'2',2,3840),(2,2,'5',12,4750),(3,2,'4',3,1900);
/*!40000 ALTER TABLE `Lignesco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Produits`
--

DROP TABLE IF EXISTS `Produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Produits` (
  `clefProd` int(11) NOT NULL AUTO_INCREMENT,
  `refProd` text NOT NULL,
  `nature` text NOT NULL,
  `specProd` text NOT NULL,
  `pu` int(11) NOT NULL,
  `unite` text NOT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`clefProd`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produits`
--

LOCK TABLES `Produits` WRITE;
/*!40000 ALTER TABLE `Produits` DISABLE KEYS */;
INSERT INTO `Produits` VALUES (1,'chp01','Chene','Plaque Taille:2x2m Ep:5cm',2000,'pc',1),(2,'chp02','Chene','Plaque Taille:2x2m Ep:10cm',2000,'pc',0),(3,'chp03','Chene','Plaque Taille:2x2m Ep:15cm',2000,'pc',1),(4,'chp04','Chene','Plaque Taille:2x2m Ep:20cm',2000,'pc',0),(5,'mp01','Medium','Plaque Taille:2x2m Ep:5cm',5000,'pc',1),(6,'mp02','Medium','Plaque Taille:2x2m Ep:10cm',5000,'pc',0),(7,'mp03','Medium','Plaque Taille:2x2m Ep:15cm',5000,'pc',1),(8,'mp04','Medium','Plaque Taille:2x2m Ep:20cm',5000,'pc',0),(9,'ep01','Exotique','Plaque Taille:2x2cm Ep:5cm',10000,'pc',1),(10,'ep02','Exotique','Plaque Taille:2x2m Ep:10cm',10000,'pc',0),(11,'ep03','Exotique','Plaque Taille:2x2m Ep:15cm',10000,'pc',1),(12,'ep04','Exotique','Plaque Taille:2x2m Ep:20cm',10000,'pc',0);
/*!40000 ALTER TABLE `Produits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-09 17:19:09
