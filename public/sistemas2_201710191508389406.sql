-- MySQL dump 10.13  Distrib 5.7.19, for Win64 (x86_64)
--
-- Host: sistemaspractica-mysqldbserver.mysql.database.azure.com    Database: sistemas2
-- ------------------------------------------------------
-- Server version	5.6.26.0

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
-- Current Database: `sistemas2`
--

/*!40000 DROP DATABASE IF EXISTS `sistemas2`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sistemas2` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sistemas2`;

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accion` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `tabla` varchar(30) NOT NULL,
  `tupla` int(11) NOT NULL,
  `bitacora_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bitacora_id` (`bitacora_id`),
  CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`bitacora_id`) REFERENCES `bitacora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (1,'CREAR','2017-10-10 23:51:35','empleado',2,1);
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup`
--

DROP TABLE IF EXISTS `backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
INSERT INTO `backup` VALUES (1,'sistemas2_201710191508389406.sql');
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficio`
--

DROP TABLE IF EXISTS `beneficio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `visible` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficio`
--

LOCK TABLES `beneficio` WRITE;
/*!40000 ALTER TABLE `beneficio` DISABLE KEYS */;
/*!40000 ALTER TABLE `beneficio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaEntrada` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,'2017-10-10 23:50:59',1),(2,'2017-10-11 03:45:54',1),(3,'2017-10-11 10:02:04',1),(4,'2017-10-15 21:39:28',1),(5,'2017-10-16 00:36:48',1),(6,'2017-10-16 00:57:05',1),(7,'2017-10-16 20:55:43',3),(8,'2017-10-16 20:56:54',1),(9,'2017-10-18 14:47:47',4),(10,'2017-10-18 22:15:10',4),(11,'2017-10-18 22:29:53',4),(12,'2017-10-18 23:11:20',4),(13,'2017-10-19 00:10:13',4);
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_beneficio`
--

DROP TABLE IF EXISTS `categoria_beneficio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_beneficio` (
  `beneficio` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  PRIMARY KEY (`beneficio`,`categoria`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `categoria_beneficio_ibfk_1` FOREIGN KEY (`beneficio`) REFERENCES `beneficio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `categoria_beneficio_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categoria_cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_beneficio`
--

LOCK TABLES `categoria_beneficio` WRITE;
/*!40000 ALTER TABLE `categoria_beneficio` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_beneficio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_cliente`
--

DROP TABLE IF EXISTS `categoria_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `puntosRequeridos` int(11) NOT NULL,
  `frecuenciaRequerida` int(11) NOT NULL,
  `montoRequerido` int(11) NOT NULL,
  `cantDiasReserva` int(11) NOT NULL,
  `cantProdReserva` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_cliente`
--

LOCK TABLES `categoria_cliente` WRITE;
/*!40000 ALTER TABLE `categoria_cliente` DISABLE KEYS */;
INSERT INTO `categoria_cliente` VALUES (1,'Nueva','asdaslmd',123213,123,3322,12,212,12321,1);
/*!40000 ALTER TABLE `categoria_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoriacliente`
--

DROP TABLE IF EXISTS `categoriacliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoriacliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cantDiasReserva` int(11) NOT NULL,
  `cantProdReserva` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frecuenciaRequerida` int(11) NOT NULL,
  `montoRequerido` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puntosRequeridos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoriacliente`
--

LOCK TABLES `categoriacliente` WRITE;
/*!40000 ALTER TABLE `categoriacliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoriacliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_promo`
--

DROP TABLE IF EXISTS `detalle_promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_promo` (
  `promo` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  PRIMARY KEY (`promo`,`producto`),
  KEY `producto` (`producto`),
  CONSTRAINT `detalle_promo_ibfk_1` FOREIGN KEY (`promo`) REFERENCES `promocion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_promo_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_promo`
--

LOCK TABLES `detalle_promo` WRITE;
/*!40000 ALTER TABLE `detalle_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ocupacion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'8181035','Rodrigo Abasto','Lejos','Administrador','123123','Administrador',1),(2,'8181028','Silvia','lejos','CRM','13123','Empleado',1),(3,'9034865','asdasdsad','asdasd','Administrador','231321','Administrador',2),(4,'123','asd','asd','Administrador','123','Administrador',3);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nit` varchar(250) DEFAULT NULL,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `telefono` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `idEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'123123','Patito','asdas',NULL,NULL,1),(2,'654654','asdasd','asdasd','6546','Asdas@hotmail.com',3),(3,'123','asd','asd','123','asd@asd.com',4);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `especificacion` varchar(100) NOT NULL,
  `garantia` varchar(100) NOT NULL,
  `puntosEquivale` int(11) NOT NULL,
  `puntosPorVenta` int(11) NOT NULL,
  `precioUCompra` decimal(8,2) NOT NULL,
  `precioUVenta` decimal(8,2) NOT NULL,
  `precionActual` decimal(8,2) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `visible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocion`
--

DROP TABLE IF EXISTS `promocion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fechaEmpieza` date NOT NULL,
  `fechaTermina` date NOT NULL,
  `visible` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocion`
--

LOCK TABLES `promocion` WRITE;
/*!40000 ALTER TABLE `promocion` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` date NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `visible` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEstado` (`idEstado`),
  KEY `idCliente` (`idCliente`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `seguimiento_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seguimiento_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seguimiento_ibfk_3` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguimiento`
--

LOCK TABLES `seguimiento` WRITE;
/*!40000 ALTER TABLE `seguimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarea`
--

DROP TABLE IF EXISTS `tarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `visible` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarea`
--

LOCK TABLES `tarea` WRITE;
/*!40000 ALTER TABLE `tarea` DISABLE KEYS */;
INSERT INTO `tarea` VALUES (1,'Llamar','realizar llamada a cliente','1');
/*!40000 ALTER TABLE `tarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT 'Morado',
  `fondo` varchar(255) NOT NULL DEFAULT 'Oscuro',
  `fuente` varchar(255) NOT NULL DEFAULT 'Default',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idEmpleado` (`idEmpleado`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rodrigo Abasto','rodrigo@gmail.com','$2y$10$Gcw02Vg0We5Qk6t.I6RJdOinRKywTxmvh3abfSu7nYBkvaLepXwq6','14AFhumFZN2fdI2WLm4jMKihRHZij0qihlCIjdTUEZ3mwdy4bFB5UesR3br0','Administrador',1,1,NULL,'Morado','Claro','Default','2017-10-11 03:50:40','2017-10-16 20:57:08'),(2,'Silvia','silvia@gmail.com','$2y$10$mOftkZUiQusAfagk8YlVYO3v64tPff3K8awqRwSxMl612facqXkg.',NULL,'Empleado',NULL,2,NULL,'Morado','Oscuro','Default','2017-10-11 03:51:34','2017-10-11 03:51:34'),(3,'asdasdsad','Asdas@hotmail.com','$2y$10$IRHzfabCCe6VTGxhsbiEWeFgbwqoYmUrtknwwEQnwtoMc7hRqGhvq',NULL,'Administrador',2,3,NULL,'Morado','Oscuro','Default','2017-10-16 20:55:24','2017-10-16 20:55:25'),(4,'asd','asd@asd.com','$2y$10$YWlnVi/DJrFD55Lw99oqH.b/MAME77HVan.y6rm3GXDhOFnfeTZK2','IPFeNwBsTry8mP2CebFDXbKdxJ9cI5W19LbU2GG8esvsFLBLzp2cj1GiJMQG','Administrador',3,4,NULL,'Morado','Oscuro','Default','2017-10-18 14:47:22','2017-10-18 14:47:24');
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

-- Dump completed on 2017-10-19  1:04:10
