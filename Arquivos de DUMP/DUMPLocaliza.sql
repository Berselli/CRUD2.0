-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: crud_localiza
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.31-MariaDB

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
-- Table structure for table `carro`
--

DROP TABLE IF EXISTS `carro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carro` (
  `id_carro` int(11) NOT NULL AUTO_INCREMENT,
  `modelo_carro` int(11) NOT NULL,
  `ano_carro` int(11) NOT NULL,
  `placa_carro` varchar(8) NOT NULL,
  `locatario_carro` int(11) DEFAULT NULL,
  `cor_carro` varchar(45) NOT NULL,
  `locacao_carro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_carro`),
  UNIQUE KEY `id_carro_UNIQUE` (`id_carro`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carro`
--

LOCK TABLES `carro` WRITE;
/*!40000 ALTER TABLE `carro` DISABLE KEYS */;
INSERT INTO `carro` VALUES (1,1,2010,'VET-5566',0,'Prata',0),(2,2,2005,'KKA-9988',3,'Vermelho',18),(3,3,2011,'KKQ-7766',0,'Preto',0),(4,5,2012,'FGT-6835',NULL,'Preto',NULL),(6,6,2014,'CCC-4755',NULL,'Caramelo',NULL);
/*!40000 ALTER TABLE `carro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_locacao`
--

DROP TABLE IF EXISTS `historico_locacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_locacao` (
  `id_historico_locacao` int(11) NOT NULL AUTO_INCREMENT,
  `locatario_historico_locacao` int(11) NOT NULL,
  `carro_historico_locacao` int(11) NOT NULL,
  `data_locacao_historico_locacao` date NOT NULL,
  `data_devolucao_historico_locacao` date DEFAULT NULL,
  PRIMARY KEY (`id_historico_locacao`),
  UNIQUE KEY `id_historico_locacao_UNIQUE` (`id_historico_locacao`),
  KEY `locatario_historico_locacao_idx` (`locatario_historico_locacao`),
  KEY `carro_historico_locacao_idx` (`carro_historico_locacao`),
  CONSTRAINT `carro_historico_locacao` FOREIGN KEY (`carro_historico_locacao`) REFERENCES `carro` (`id_carro`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `locatario_historico_locacao` FOREIGN KEY (`locatario_historico_locacao`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_locacao`
--

LOCK TABLES `historico_locacao` WRITE;
/*!40000 ALTER TABLE `historico_locacao` DISABLE KEYS */;
INSERT INTO `historico_locacao` VALUES (3,1,1,'2018-07-15','2018-07-15'),(4,1,1,'2018-07-15','2018-07-15'),(5,3,1,'2018-07-15','2018-07-15'),(10,3,2,'2018-07-15','2018-07-15'),(11,3,3,'2018-07-15','2018-07-15'),(12,3,1,'2018-07-15','2018-07-16'),(14,3,2,'2018-07-16','2018-07-16'),(16,1,3,'2018-07-16','2018-07-16'),(17,3,1,'2018-07-16','2018-07-16'),(18,3,2,'2018-07-16',NULL);
/*!40000 ALTER TABLE `historico_locacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelo`
--

DROP TABLE IF EXISTS `modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelo` (
  `id_modelo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_modelo` varchar(45) NOT NULL,
  `marca_modelo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_modelo`),
  UNIQUE KEY `id_modelo_UNIQUE` (`id_modelo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelo`
--

LOCK TABLES `modelo` WRITE;
/*!40000 ALTER TABLE `modelo` DISABLE KEYS */;
INSERT INTO `modelo` VALUES (1,'Vectra','Chevrolet'),(2,'Golf','Volkswagen'),(3,'C3','Citroen'),(4,'325i','BMW'),(5,'Cruze','Chevrolet'),(6,'Jeta','Volkswagen'),(7,'3008 GT Line','Peugeot'),(8,'Captur','Renault'),(9,'Ford','Fusion');
/*!40000 ALTER TABLE `modelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(45) NOT NULL,
  `sobrenome_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(70) NOT NULL,
  `senha_usuario` varchar(200) NOT NULL,
  `admin_usuario` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`),
  UNIQUE KEY `email_usuario_UNIQUE` (`email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Juliano','Berselli','julianob@mail.com','077c2170022851cf6c6e5d11a10acc4a',0),(3,'Administrador','Supremo','admin@mail.com','21232f297a57a5a743894a0e4a801fc3',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16 10:32:00
