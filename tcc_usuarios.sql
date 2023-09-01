-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tcc
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nivel` tinyint DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'vitoria','vitoria@gmail.com','202cb962ac59075b964b07152d234b70',0,NULL,NULL,'2023-08-25 10:08:38',1),(2,'vitoria','vitoria25nanda@gmail.com','bcbe3365e6ac95ea2c0343a2395834dd',0,NULL,NULL,'2023-08-25 10:15:04',1),(3,'juliana','juliana@gmail','698d51a19d8a121ce581499d7b701668',0,NULL,NULL,'2023-08-25 10:17:39',1),(4,'vitoria','rebecafsilva14@gmail.com','77963b7a931377ad4ab5ad6a9cd718aa',0,NULL,NULL,'2023-08-25 10:23:14',1),(5,'bbf','fabio@gmail.com','698d51a19d8a121ce581499d7b701668',0,NULL,NULL,'2023-08-25 10:29:21',1),(6,'jonas','jonas@gmail.com','698d51a19d8a121ce581499d7b701668',0,NULL,NULL,'2023-08-25 10:33:36',1),(7,'vera','veralucia@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',1,NULL,NULL,'2023-08-25 11:06:35',1),(8,'vera','veralucia@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',1,NULL,NULL,'2023-08-25 11:06:38',1),(9,'vitoria','vitoria1@gmail.com','202cb962ac59075b964b07152d234b70',0,NULL,NULL,'2023-08-29 10:10:03',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-30  8:19:42
