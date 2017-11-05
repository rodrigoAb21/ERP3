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
  `tupla` int(11) DEFAULT NULL,
  `bitacora_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bitacora_id` (`bitacora_id`),
  CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`bitacora_id`) REFERENCES `bitacora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (1,'CREAR','2017-11-01 06:45:13','cliente',1,7),(2,'VER','2017-11-02 11:53:46','empleado',NULL,8),(3,'VER','2017-11-05 11:36:16','empleado',NULL,9),(4,'CREAR','2017-11-05 11:40:41','empleado',6,9),(5,'VER','2017-11-05 11:40:42','empleado',NULL,9),(6,'ACTUALIZAR','2017-11-05 12:53:45','tarea',1,9),(7,'ACTUALIZAR','2017-11-05 12:54:45','tarea',1,9),(8,'CREAR','2017-11-05 13:36:32','tarea',3,9),(9,'ACTUALIZAR','2017-11-05 13:37:49','tarea',1,9);
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignacion` (
  `seguimiento` int(11) NOT NULL,
  `tarea` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nota` varchar(50) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  PRIMARY KEY (`seguimiento`,`tarea`),
  KEY `tarea` (`tarea`),
  CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`seguimiento`) REFERENCES `seguimiento` (`id`),
  CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`tarea`) REFERENCES `tarea` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignacion`
--

LOCK TABLES `asignacion` WRITE;
/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
INSERT INTO `asignacion` VALUES (2,1,'2017-11-02','Hhbs','12:30:00','18:47:00'),(2,2,'2017-11-02','Ghj','21:48:00','23:48:00');
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
INSERT INTO `backup` VALUES (1,'sistemas2_201710311509432366.sql'),(2,'sistemas2_201711051509900791.sql'),(3,'sistemas2_201711051509903455.sql');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,'2017-10-31 02:36:48',1),(2,'2017-10-31 02:45:50',2),(3,'2017-10-31 02:48:25',2),(4,'2017-10-31 04:04:31',2),(5,'2017-10-31 04:05:26',3),(6,'2017-10-31 04:16:24',2),(7,'2017-11-01 06:44:12',1),(8,'2017-11-02 11:44:49',4),(9,'2017-11-05 11:35:39',5),(10,'2017-11-05 12:27:58',7),(11,'2017-11-05 13:37:15',9);
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `casousos`
--

DROP TABLE IF EXISTS `casousos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casousos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `depto_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `depto_id` (`depto_id`),
  CONSTRAINT `casousos_ibfk_1` FOREIGN KEY (`depto_id`) REFERENCES `departamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casousos`
--

LOCK TABLES `casousos` WRITE;
/*!40000 ALTER TABLE `casousos` DISABLE KEYS */;
INSERT INTO `casousos` VALUES (1,'Gestion de Empresa',1),(2,'Gestion de Empleados',1),(3,'Control de acceso',1),(4,'Visualizar Bitacora',1),(5,'Backup',1),(6,'Configuraciones',1),(7,'Gestion de Proveedores',2),(8,'Gestion de Productos',2),(9,'Categorizacion de Productos',2),(10,'Gestion de Compras',2),(11,'Administracion de Inventarios',2),(12,'Reabastecimiento de Productos',2),(13,'Registro de Puntos de Venta',3),(14,'Gestion de Clientes',3),(15,'Registro de Pagos',3),(16,'Pago al contado',3),(17,'Facturacion',3),(18,'Pago al Credito',3),(19,'Gestionar Garante',3),(20,'Registro de cancelacion de cuotas',3),(21,'Categorizacion de Clientes',4),(22,'Gestion de Beneficios',4),(23,'Gestion de Promociones',4),(24,'Asignacion de Promociones',4),(25,'Gestion de Posibles Clientes',4),(26,'Planificacion de Tareas',4),(27,'Gestion de Tareas',4),(28,'Actualizacion de Estado',4),(29,'Reporte de reabastecimiento de tiendas',5),(30,'Reporte de resultados de seguimientos',5),(31,'Reporte de productos mas vendidos',5);
/*!40000 ALTER TABLE `casousos` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `puntosRequeridos` int(11) NOT NULL,
  `frecuenciaRequerida` int(11) NOT NULL,
  `montoRequerido` int(11) NOT NULL,
  `cantDiasReserva` int(11) NOT NULL,
  `cantProdReserva` int(11) NOT NULL,
  `visible` char(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_cliente`
--

LOCK TABLES `categoria_cliente` WRITE;
/*!40000 ALTER TABLE `categoria_cliente` DISABLE KEYS */;
INSERT INTO `categoria_cliente` VALUES (1,'xxxx','sada',12312,123,12312,1231,123,'1',12321);
/*!40000 ALTER TABLE `categoria_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `visible` char(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_producto`
--

LOCK TABLES `categoria_producto` WRITE;
/*!40000 ALTER TABLE `categoria_producto` DISABLE KEYS */;
INSERT INTO `categoria_producto` VALUES (1,'Bebidas','1',5),(2,'categoria','1',5),(3,'mk','1',5);
/*!40000 ALTER TABLE `categoria_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` int(11) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `puntosAcumulados` int(11) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `visible` char(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategoria` (`idCategoria`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria_cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,12312,NULL,'QWEQWE',0,'QWEQWE',NULL,'Posible Cliente',1,'1',123456);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(10) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'SEGURIDAD'),(2,'COMPRAS'),(3,'VENTAS'),(4,'CRM'),(5,'REPORTES');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_promo`
--

LOCK TABLES `detalle_promo` WRITE;
/*!40000 ALTER TABLE `detalle_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_venta` (
  `idPago` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idPago`,`idProducto`),
  KEY `idProducto` (`idProducto`),
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`idPago`) REFERENCES `pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
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
  `ci` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ocupacion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `visible` char(1) NOT NULL DEFAULT '1',
  `idEmpresa` int(11) DEFAULT NULL,
  `rol_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'312312','asdasd','asdas','Administrador','12312','Administrador','1',1,1),(2,'123123','asd','asd','Administrador','12','Administrador','1',2,1),(3,'123456','asd','asd','Administrador','123','Administrador','1',3,1),(4,'156','X','X','Administrador','1463','Administrador','1',4,1),(5,'8595199','n','n','Administrador','67849099','Administrador','1',5,1),(6,'78465','PruebaEmpleado','njin','nknkn','41513','Empleado','1',5,4),(7,'123','asd','asd','Administrador','231','Administrador','1',6,1);
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
  `nit` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `idEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'12312','easdas','asdas',NULL,NULL,1),(2,'123','asd','asd','123','asd@asd.com',2),(3,'123','asd','asd','123','qwe@qwe.com',3),(4,'1234','Vdj','Vjd','1563','x@x.com',4),(5,'8595199','n','n','67849099','n@n.com',5),(6,'123','asd','asd','123','asd1@asd1.com',7);
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
  `color` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'abierto','recientemente creado','green'),(2,'realizado','realizado','blue'),(3,'cancelado','cancelado','red'),(4,'pospuesto','pospuesto','purple'),(5,'sin confirmar','sin confirmar','yellow');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago`
--

DROP TABLE IF EXISTS `pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montoTotal` float NOT NULL,
  `fecha` datetime NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL,
  `idPuntoVenta` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPuntoVenta` (`idPuntoVenta`),
  KEY `idCliente` (`idCliente`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idPuntoVenta`) REFERENCES `punto_de_venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pago_ibfk_3` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago`
--

LOCK TABLES `pago` WRITE;
/*!40000 ALTER TABLE `pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `rol_id` int(10) unsigned NOT NULL,
  `casouso_id` int(10) unsigned NOT NULL,
  `leer` int(11) DEFAULT '0',
  `crear` int(11) DEFAULT '0',
  `editar` int(11) DEFAULT '0',
  `eliminar` int(11) DEFAULT '0',
  PRIMARY KEY (`rol_id`,`casouso_id`),
  KEY `casouso_id` (`casouso_id`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`casouso_id`) REFERENCES `casousos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,1,1,1,1,1),(1,2,1,1,1,1),(1,3,1,1,1,1),(1,4,1,1,1,1),(1,5,1,1,1,1),(1,6,1,1,1,1),(1,7,1,1,1,1),(1,8,1,1,1,1),(1,9,1,1,1,1),(1,10,1,1,1,1),(1,11,1,1,1,1),(1,12,1,1,1,1),(1,13,1,1,1,1),(1,14,1,1,1,1),(1,15,1,1,1,1),(1,16,1,1,1,1),(1,17,1,1,1,1),(1,18,1,1,1,1),(1,19,1,1,1,1),(1,20,1,1,1,1),(1,21,1,1,1,1),(1,22,1,1,1,1),(1,23,1,1,1,1),(1,24,1,1,1,1),(1,25,1,1,1,1),(1,26,1,1,1,1),(1,27,1,1,1,1),(1,28,1,1,1,1),(1,29,1,1,1,1),(1,30,1,1,1,1),(1,31,1,1,1,1),(3,1,1,1,1,1),(3,2,1,1,1,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
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
  `precioActual` decimal(8,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `visible` char(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_id` (`tipo_id`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'ds','mklm','5',45,54,564.00,456.00,456.00,'c13.jpg',1,'1',5),(2,'mkl',',lñ','45',45,5,5.00,5.00,7878.00,'15-2-13-6CM-Cute-Vinyl-Car-font-b-Stickers-b-font-font-b-Ghibli-b.jpg',1,'1',5);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocion`
--

LOCK TABLES `promocion` WRITE;
/*!40000 ALTER TABLE `promocion` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `visible` char(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'454153','mmkl','mklmlk','4653','mkl','1',5),(2,'11111111111','NLK','MLKM','545313','MKL','1',5);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punto_de_venta`
--

DROP TABLE IF EXISTS `punto_de_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `punto_de_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `punto_de_venta`
--

LOCK TABLES `punto_de_venta` WRITE;
/*!40000 ALTER TABLE `punto_de_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `punto_de_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'ADMINISTRADOR'),(2,'ENCARGADO'),(3,'AGENTE'),(4,'EMPLEADO'),(5,'CLIENTE');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
  `proposito` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEstado` (`idEstado`),
  KEY `idCliente` (`idCliente`),
  KEY `idEmpleado` (`idEmpleado`),
  CONSTRAINT `seguimiento_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seguimiento_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `seguimiento_ibfk_3` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguimiento`
--

LOCK TABLES `seguimiento` WRITE;
/*!40000 ALTER TABLE `seguimiento` DISABLE KEYS */;
INSERT INTO `seguimiento` VALUES (1,'2017-11-01',1,1,1,'1',NULL),(2,'2017-11-02',1,1,4,'1','Sghhsl');
/*!40000 ALTER TABLE `seguimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_puntoventa`
--

DROP TABLE IF EXISTS `stock_puntoventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_puntoventa` (
  `idPuntoVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  PRIMARY KEY (`idPuntoVenta`,`idProducto`),
  KEY `idProducto` (`idProducto`),
  CONSTRAINT `stock_puntoventa_ibfk_1` FOREIGN KEY (`idPuntoVenta`) REFERENCES `punto_de_venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_puntoventa_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_puntoventa`
--

LOCK TABLES `stock_puntoventa` WRITE;
/*!40000 ALTER TABLE `stock_puntoventa` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_puntoventa` ENABLE KEYS */;
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
  `color` varchar(20) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `visible` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarea`
--

LOCK TABLES `tarea` WRITE;
/*!40000 ALTER TABLE `tarea` DISABLE KEYS */;
INSERT INTO `tarea` VALUES (1,',.','Chh','green',1,'1'),(2,'Vhh','Vhj','green',1,'1'),(3,'dsad','dsa',NULL,NULL,'1');
/*!40000 ALTER TABLE `tarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `visible` char(1) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `idCategoriaProd` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategoriaProd` (`idCategoriaProd`),
  CONSTRAINT `tipo_ibfk_1` FOREIGN KEY (`idCategoriaProd`) REFERENCES `categoria_producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'gaseosa','1',5,1);
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'asdasd','rodrigo@gmail.com','$2y$10$hAeI24AhiJXyNi6Cz9k0VOY3kPsyKw/ai.EtJ277lNmkOuVAdPo0e',NULL,'Administrador',1,1,NULL,'Morado','Oscuro','Default','2017-10-31 02:36:44','2017-10-31 02:36:45'),(2,'asd','asd@asd.com','$2y$10$07A2JIuCoUoR9A6jgemrX.ZOLG6.tWSJlKvhJbK5w7bnSl/37lrZa','nTePrUDjVFGueSWDtzYKVVx1FRnpxEokWtAipiouTFzJUyKsd6iTvOC5oDJl','Administrador',2,2,NULL,'Morado','Oscuro','Default','2017-10-31 02:45:44','2017-10-31 02:45:44'),(3,'asd','qwe@qwe.com','$2y$10$KG8FPmxIfSA00MycQa48M.r03HmiIY0BqqZhh7p8sILKfdNeR2Hxm','HRirOZFbdxg94F1ppoD2Lj8AYjLXsxilBl9SWt3x9Fu50D7k7bsbzFjMu4Md','Administrador',3,3,NULL,'Morado','Oscuro','Default','2017-10-31 04:04:20','2017-10-31 04:04:21'),(4,'X','x@x.com','$2y$10$rIXUCjMZ8TEO45vrjnCCw.ozHszJzrKw7Y2OUpDv9ACUBXZ95olJO',NULL,'Administrador',4,4,NULL,'Morado','Oscuro','Default','2017-11-02 11:44:37','2017-11-02 11:44:38'),(5,'n','n@n.com','$2y$10$7fNno3joNRziIdMBKDE6FO8rp87yAnbsz0piUZAN8F8y6ryeWXLca',NULL,'Administrador',5,5,NULL,'Morado','Oscuro','Default','2017-11-05 11:35:27','2017-11-05 11:35:28'),(7,'PruebaEmpleado','empleado@n.com','$2y$10$fdvKDYnjZSuW/OnWNs62UOQp7kg4dgJ/8ju0orLV/XlrhNQtX13Eu',NULL,'Empleado',NULL,6,NULL,'Morado','Oscuro','Default','2017-11-05 11:40:40','2017-11-05 12:44:26'),(9,'asd','asd1@asd1.com','$2y$10$eGciLv8mqbrNDRs2BkaO2ugG.JmQDZjnC3ozTWlNfDsjc1fKjH1TW',NULL,'Administrador',6,7,NULL,'Morado','Oscuro','Default','2017-11-05 13:37:00','2017-11-05 13:37:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sistemas2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-05 13:39:32
