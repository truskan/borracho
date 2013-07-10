-- MySQL dump 10.14  Distrib 5.5.31-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: borracho
-- ------------------------------------------------------
-- Server version	5.5.31-MariaDB-log

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
-- Current Database: `borracho`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `borracho` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `borracho`;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `f_creacion` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'yuri marquez','12234567898','1372819293'),(4,'felipe aliaga','','1372819342'),(5,'jose olivera','','1372819383'),(6,'noemi espinoza','','1372819415'),(7,'stephani mendez','','1372819423'),(8,'jose martinez','','1372819430'),(9,'irvin gamarra','','1372819440'),(10,'suzanne palacios','','1372819447'),(11,'michael pazce','','1372819461'),(12,'Jose Ramos','','1372892587'),(13,'','','1373482237');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_plato`
--

DROP TABLE IF EXISTS `detalle_plato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_plato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_plato`
--

LOCK TABLES `detalle_plato` WRITE;
/*!40000 ALTER TABLE `detalle_plato` DISABLE KEYS */;
INSERT INTO `detalle_plato` VALUES (1,1,2,0.3),(2,1,3,0.25),(3,1,4,0.25),(4,1,5,0.25),(5,1,6,0.25),(6,2,1,0.25),(7,2,2,0.25),(8,2,3,0.25),(9,2,4,0.25),(10,2,5,0.25),(11,2,6,0.25),(12,3,1,0.25),(13,3,2,0.25),(14,3,3,0.25),(15,3,4,0.25),(16,3,5,0.25),(17,3,6,0.25),(18,12,7,2),(19,12,5,2),(20,13,5,12),(21,13,6,12),(22,13,2,12),(23,14,3,1),(24,14,2,1),(25,19,2,2),(26,19,1,2),(27,20,9,2),(28,20,5,2);
/*!40000 ALTER TABLE `detalle_plato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,1,3,1),(2,1,2,2),(3,1,1,3),(4,2,4,1),(5,2,3,2),(6,2,2,3),(7,3,4,1),(8,3,3,2),(9,3,2,3),(65,14,1,1),(66,14,1,2),(67,15,1,1),(68,15,1,2),(69,16,1,1),(70,16,1,2),(71,17,2,1),(72,17,2,2),(73,18,2,12),(74,19,2,19),(75,19,2,20),(76,20,1,19),(77,21,2,19),(78,21,2,20),(79,22,3,14),(80,22,3,19),(81,22,3,20),(82,23,2,19),(83,23,2,20),(84,24,5,14),(85,24,5,19),(86,25,10,14),(87,25,10,20),(88,26,2,14),(89,26,2,20),(90,27,2,19),(91,27,2,20),(92,28,2,19),(93,28,3,20);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `email` text NOT NULL,
  `foto` text NOT NULL,
  `f_creacion` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Naydu Leyva','truskan','a271b7e8f2f64b4de8af59abe18dd1e1','truskan.naydu@gmail.com','img/usuarios/naydu1372774321.png','1372806075'),(2,'Nayducita','naydu','a271b7e8f2f64b4de8af59abe18dd1e1','nayducita@gmail.com','img/usuarios/naydu1372774321.png','1372806075'),(3,'Sadith Alania','borrachita1','41897d1524f842ce74ad965fc88a9550','sadith123@gmail.com','img/usuarios/default.png','1372969269'),(4,'yuri marquez','ymarquez','0517dd1e00b72285d3b203221fbdbc49','ymarquez@continental.edu.pe','img/usuarios/default.png','1372969809');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingrediente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingrediente` varchar(100) NOT NULL,
  `costo` float NOT NULL,
  `stock` float DEFAULT NULL,
  `f_compra` varchar(10) NOT NULL,
  `f_vencimiento` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ingrediente` (`ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingrediente`
--

LOCK TABLES `ingrediente` WRITE;
/*!40000 ALTER TABLE `ingrediente` DISABLE KEYS */;
INSERT INTO `ingrediente` VALUES (1,'pescado jurel',4.5,74,'1372007212','1373303212',1),(2,'pescado bonito',4.5,54,'1371728152','1373024152',1),(3,'papa',4.5,80,'1371728152','1373024152',1),(4,'ajos',4.5,100,'1371728152','1373024152',1),(5,'kion',4.5,62,'1371728152','1373024152',1),(6,'limon',4.5,100,'1371728152','1373024152',1),(7,'apio',4.5,100,'1371728152','1373024152',1),(8,'pota',4.5,100,'1371728152','1373024152',1),(9,'arroz',3.5,62,'1372958297','1374254297',1);
/*!40000 ALTER TABLE `ingrediente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` text NOT NULL,
  `p_venta` float NOT NULL,
  `p_costo` float NOT NULL,
  `categoria` int(11) DEFAULT '1',
  `descripcion` text NOT NULL,
  `foto` text NOT NULL,
  `estrella` int(11) DEFAULT '0',
  `f_creacion` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (14,'chaufa de mariscos',15,13.5,1,'sdfsdfs','img/productos/1373475370.jpeg',1,'1373475370'),(19,'Leche de Tigre',8,22.5,1,'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.','img/productos/1373478337.jpeg',0,'1373478337'),(20,'Parihuela',15,20.5,1,'Una parihuela','img/productos/1373478392.jpeg',0,'1373478392');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pago` int(11) NOT NULL,
  `mesa` int(11) NOT NULL,
  `total_venta` float NOT NULL,
  `f_venta` varchar(10) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `cancelado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,1,1,35.5,'1372857039',4,1,2,1),(2,1,2,51,'1372857039',6,1,2,1),(3,1,3,51,'1372857039',6,1,2,1),(14,1,7,26,'1372893186',1,1,2,1),(15,1,7,26,'1372893270',1,1,2,1),(16,1,4,18,'1372893434',12,1,2,1),(17,1,5,28,'1372893452',12,1,2,1),(18,1,1,16,'1372956169',1,1,2,1),(19,1,1,61,'1373481603',1,1,2,0),(20,1,2,8,'1373481677',12,1,2,0),(21,1,1,76,'1373482030',1,1,2,0),(22,1,8,114,'1373482062',12,1,2,0),(23,1,1,61,'1373482218',1,1,2,0),(24,1,2,123,'1373482228',1,1,2,0),(25,1,14,180,'1373482237',13,1,2,0),(26,1,1,75,'1373482353',1,1,2,0),(27,1,12,61,'1373482472',1,1,1,0),(28,1,5,61,'1373482521',1,1,1,0);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-10 13:57:01
