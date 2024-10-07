-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_echoes
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `music` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `playlist_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `idx_name` (`name`),
  KEY `idx_autor` (`autor`),
  KEY `playlist_id` (`playlist_id`),
  CONSTRAINT `music_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `music`
--

LOCK TABLES `music` WRITE;
/*!40000 ALTER TABLE `music` DISABLE KEYS */;
INSERT INTO `music` VALUES (1,'Viva La Vida','../src/songs/Coldplay - Viva La Vida (Official Video).mp3','ColdPlay','../src/images/coldplay.jpg','2024-08-30 00:23:31','2024-08-30 00:23:31',1),(2,'A Real Hero','../src/songs/College & Electric Youth - A Real Hero (Drive Original Movie Soundtrack).mp3','College & Electric Youth','../src/images/coldplay.jpg','2024-08-30 01:11:31','2024-08-30 01:11:31',3),(3,'Back In Black','../src/songs/AC_DC - Back In Black (Official 4K Video).mp3','AC/DC','../src/images/Back_in_Black.jpg','2024-09-02 23:11:33','2024-09-04 00:26:43',2),(4,'Highway to Hell','../src/songs/AC_DC - Back In Black (Official 4K Video).mp3','AC/DC','../src/images/Acdc_Highway_to_Hell.jfif','2024-09-02 23:12:51','2024-09-04 00:26:43',2),(5,'Numb','../src/songs/Numb (Official Music Video) [4K UPGRADE] – Linkin Park.mp3','Linkin Park','../src/images/coldplay.jpg','2024-09-02 23:14:13','2024-09-02 23:14:13',2);
/*!40000 ALTER TABLE `music` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
INSERT INTO `playlist` VALUES (1,'Melhores Clássicos','2024-08-29 23:40:40','2024-08-29 23:40:40'),(2,'Melhores do Rock','2024-08-29 23:40:40','2024-08-29 23:40:40'),(3,'SummerEletroHits','2024-08-29 23:40:40','2024-08-29 23:40:40');
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','$2y$10$6ynbhJ6lrMjzWbkzomhwSOLeTwr2HYikFmRZEfMWH4fdDk9q38rEy','a@a.com','4799173334'),(2,'','teste','123','guilherme_b_damasio@estudante.sesissenai.org.br',''),(3,'','Gui','$2y$10$ZS0o/ruLIe6MRsagvflQp.t9zbl/0tAnh71DOxJgrtkAeefsViHLW','guilherme_b_damasio@estudante.sesissenai.org.br',''),(4,'','Renê','$2y$10$1ngAYULi77AGEk2lXElpdup8vi69ewaIrMyobr.vk/zWNSVQavbae','guilherme_b_damasio@estudante.sesissenai.org.br',''),(5,'','gabriel','$2y$10$eFv9bGtTlSCL5qal/gawfuImDkyEiTMT85DGui3kyLVZQG4VuIbz2','macify@mailinator.com','');
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

CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    expire_at INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(ID)
);


-- Dump completed on 2024-09-03 21:58:13
