-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: anu
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `achievements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` tinyint NOT NULL,
  `achievement_desc` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'Added new course AI-401','2026-02-25 10:11:23'),(2,'Updated staff profile','2026-02-25 10:11:23'),(3,'Created Tech Fest Event','2026-02-25 10:11:23'),(4,'Uploaded gallery images','2026-02-25 10:11:23');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'customer id is auto increament and primary key',
  `adminname` varchar(200) NOT NULL COMMENT 'user name',
  `password` varchar(50) NOT NULL COMMENT 'customer password is stored',
  `mail_id` varchar(500) NOT NULL COMMENT 'customer mail_id is stored',
  `firstname` varchar(500) NOT NULL COMMENT 'customer first name is stored',
  `lastname` varchar(500) NOT NULL COMMENT 'customer last name is stored',
  `gender` varchar(200) NOT NULL COMMENT 'gender',
  `address` varchar(25) NOT NULL COMMENT 'customer address is stored',
  `mobile_no` bigint NOT NULL COMMENT 'customers mobile no is stored',
  `qualification` varchar(200) NOT NULL COMMENT 'Qualification',
  `image` varchar(500) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'customer created date and time is stored',
  `last_access` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'customer login time and date is stored',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`adminname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Users details are stored';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (3,'prasad','d7fbabb3289b145a0f256d6596e2e43e9ecb9986','venkatavaraprasad12@gmail.com','gade','venkat','male','guntur',9030114200,'btech','','2014-01-28 11:52:36','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_id` int NOT NULL,
  `alumni_desc` blob NOT NULL,
  `alumni_img` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES (1,2,_binary 'hai','Tulips.jpg'),(2,2,'','Penguins.jpg');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `category` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'document'),(2,'non_document');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_code` varchar(500) NOT NULL,
  `class_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (0,'passout','Pass Out'),(1,'IV IT','4th Year IT SEM I'),(2,'III IT','3rd Year IT SEM I'),(3,'II IT','2nd Year IT SEM I'),(4,'I IT','1st Year IT SEM I'),(6,'IV IT','4th Year IT SEM II'),(7,'III IT','3rd Year IT SEM II'),(8,'II IT','2nd Year IT SEM II');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `comment` blob NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'prasad','hod','phd','hod',_binary 'qqqqqqqqq','ITHOD.png'),(2,'prasad','principal','phd','professor',_binary 'ppp','principal.png'),(3,'prasad','chairman','phd','professor',_binary 'prof','chairman.png');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committee`
--

DROP TABLE IF EXISTS `committee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `committee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `committee_cat_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committee`
--

LOCK TABLES `committee` WRITE;
/*!40000 ALTER TABLE `committee` DISABLE KEYS */;
INSERT INTO `committee` VALUES (1,1,1);
/*!40000 ALTER TABLE `committee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `committee_cat`
--

DROP TABLE IF EXISTS `committee_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `committee_cat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `committee_cat`
--

LOCK TABLES `committee_cat` WRITE;
/*!40000 ALTER TABLE `committee_cat` DISABLE KEYS */;
INSERT INTO `committee_cat` VALUES (1,'Chairman'),(2,'Vice Chairman'),(3,'President'),(4,'Vice-President'),(5,'Secretary'),(6,'Join-Secretary'),(7,'Tresurer'),(8,'join-Tresurer');
/*!40000 ALTER TABLE `committee_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_reg`
--

DROP TABLE IF EXISTS `event_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_reg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_reg`
--

LOCK TABLES `event_reg` WRITE;
/*!40000 ALTER TABLE `event_reg` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_results`
--

DROP TABLE IF EXISTS `event_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `award` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_results`
--

LOCK TABLES `event_results` WRITE;
/*!40000 ALTER TABLE `event_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_types`
--

DROP TABLE IF EXISTS `event_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_type` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_types`
--

LOCK TABLES `event_types` WRITE;
/*!40000 ALTER TABLE `event_types` DISABLE KEYS */;
INSERT INTO `event_types` VALUES (1,'MBA'),(2,'MBA Department');
/*!40000 ALTER TABLE `event_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_type_id` int NOT NULL,
  `event_name` varchar(500) NOT NULL,
  `event_desc` blob NOT NULL,
  `event_address` varchar(500) NOT NULL,
  `event_date` date NOT NULL,
  `reg_frm_date` date NOT NULL,
  `reg_to_date` date NOT NULL,
  `is_registration` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,'bkh',_binary ' mvn','mbvnj','2014-01-09','2014-01-02','2014-01-31',1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` blob NOT NULL,
  `image_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `highlights`
--

DROP TABLE IF EXISTS `highlights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `highlights` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `high_light` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `highlights`
--

LOCK TABLES `highlights` WRITE;
/*!40000 ALTER TABLE `highlights` DISABLE KEYS */;
INSERT INTO `highlights` VALUES (14,2,_binary 'Hai The Matter About Department Events');
/*!40000 ALTER TABLE `highlights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sub_id` varchar(500) NOT NULL,
  `material_name` varchar(500) NOT NULL,
  `mater_file` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placements`
--

DROP TABLE IF EXISTS `placements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `placements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` tinyint NOT NULL,
  `placement_desc` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placements`
--

LOCK TABLES `placements` WRITE;
/*!40000 ALTER TABLE `placements` DISABLE KEYS */;
INSERT INTO `placements` VALUES (2,1,_binary '2008-12 Batch Placaments$$placements.docx');
/*!40000 ALTER TABLE `placements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prev_papers`
--

DROP TABLE IF EXISTS `prev_papers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prev_papers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subj_id` int NOT NULL,
  `paper_name` varchar(500) NOT NULL,
  `paper_file` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prev_papers`
--

LOCK TABLES `prev_papers` WRITE;
/*!40000 ALTER TABLE `prev_papers` DISABLE KEYS */;
/*!40000 ALTER TABLE `prev_papers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `section_code` varchar(500) NOT NULL,
  `section_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES (1,1,'IV IT A SEC ','4th IT A Section'),(2,2,'III IT A Sec','3rd IT A Sec'),(3,3,'II IT A Sec','2nd IT A Section'),(4,3,'II IT B Sec','2nd IT B Section'),(5,4,'I IT A Sec','1st IT A Section'),(6,4,'I IT B Sec','1st IT B Section');
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `staff_categ_id` int NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `industry_exp` varchar(500) NOT NULL,
  `teach_exp` varchar(500) NOT NULL,
  `research` varchar(500) NOT NULL,
  `publ_national` blob NOT NULL COMMENT 'national wise publications',
  `publ_international` blob NOT NULL COMMENT 'inter-national wise publications',
  `conf_national` blob NOT NULL COMMENT 'national wise conferences',
  `conf_international` blob NOT NULL COMMENT 'inter-national wise conferences',
  `e_mail` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_category`
--

DROP TABLE IF EXISTS `staff_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_category`
--

LOCK TABLES `staff_category` WRITE;
/*!40000 ALTER TABLE `staff_category` DISABLE KEYS */;
INSERT INTO `staff_category` VALUES (1,'Teaching'),(2,'Non Teaching');
/*!40000 ALTER TABLE `staff_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stream`
--

DROP TABLE IF EXISTS `stream`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stream` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stream_code` varchar(500) NOT NULL,
  `stream_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stream`
--

LOCK TABLES `stream` WRITE;
/*!40000 ALTER TABLE `stream` DISABLE KEYS */;
INSERT INTO `stream` VALUES (1,'IT','Information Technology'),(2,'CSE','Computer science & Enginering'),(5,'ECE','Electronics and Communication Engineering'),(6,'EEE','Electronics and Electrical Engineering'),(7,'Other','Any Other Branch');
/*!40000 ALTER TABLE `stream` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sub_code` varchar(500) NOT NULL,
  `sub_name` varchar(500) NOT NULL,
  `class_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'IS','Information Security',1),(2,'NP','Network Programming',1),(3,'SPM','Software Project Management',1),(4,'ES','Embeded Systems',1),(5,'MAD','Multimedia And Application Developement',1),(6,'MC','Mobile Computing',1),(7,'CG','Computer Graphics',2),(8,'ADS','Adv Data Stractures',2),(9,'CN','Computer Networks',2),(10,'OS','Opreting System',2),(11,'SE','Softwre Engineering',2),(12,'WT','Web Technology',0),(13,'WT','Web Technology',2),(14,'MS','MANAGEMENT SCIENCE',6),(15,'DP','DESIGN PATTERN',6),(16,'NMS','NETWORK MANAGEMENT SYSTEMS',6),(17,'DAA','DESIGN AND ANALYSIS OF ALGORITHMS',7),(18,'UNIX','UNIX',7),(19,'OOAD','OBJECT ORIENTED ANALYSIS AND DESIGN',7),(20,'ACN','ADV COMPUTER NETWORKS',7),(21,'AJP','ADV JAVA PROGAMMING',7),(22,'MS','MANAGEMENT SCIENCE',7),(23,'DC','DATA COMMUNICATION',8),(24,'PPL','PRINCIPLES OF PROGRAMINNG LANGUAGES',8),(25,'OOPS','OBJECT ORIENTED PROGRAMMING',8),(26,'CO','COMPUTER ORGANIZATION AND ARCHITECTURE',8),(27,'DBMS','DATABASE MANAGEMENT SYSTEMS',8),(28,'ACD','AUTOMATA AND COMPILER DESIGN',8);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `syllabus`
--

DROP TABLE IF EXISTS `syllabus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `syllabus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `syllabus_name` varchar(500) NOT NULL,
  `class_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `syllabus`
--

LOCK TABLES `syllabus` WRITE;
/*!40000 ALTER TABLE `syllabus` DISABLE KEYS */;
/*!40000 ALTER TABLE `syllabus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'customer id is auto increament and primary key',
  `username` varchar(200) NOT NULL COMMENT 'user name',
  `password` varchar(50) NOT NULL COMMENT 'user password is stored',
  `mail_id` varchar(500) NOT NULL COMMENT 'user mail_id is stored',
  `firstname` varchar(50) NOT NULL COMMENT 'user first name is stored',
  `lastname` varchar(50) NOT NULL COMMENT 'user last name is stored',
  `gender` varchar(20) NOT NULL COMMENT 'gender',
  `address` varchar(25) NOT NULL COMMENT 'user address is stored',
  `mobile_no` bigint NOT NULL COMMENT 'user mobile no is stored',
  `batch_id` int NOT NULL,
  `stream_id` int NOT NULL,
  `section` smallint NOT NULL COMMENT 'section',
  `admission_id` varchar(300) NOT NULL COMMENT 'Admission Id',
  `image` varchar(500) NOT NULL COMMENT 'Image Of User',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'customer created date and time is stored',
  `last_access` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1 COMMENT='Users details are stored';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (76,'sai','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','sainukala5@gmail.com','Nukala','Sai','Male','kompally',6302504213,1,1,2,'23x01a66a4','','2026-02-25 05:26:03','0000-00-00 00:00:00',0),(77,'pavan','40bd001563085fc35165329ea1ff5c5ecbdbbeef','sai@123','nukala','sai','Male','venkatapuram',6302504213,1,5,3,'a3','','2026-02-25 05:44:36','2026-02-25 05:45:35',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `year_batch`
--

DROP TABLE IF EXISTS `year_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `year_batch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `year_batch`
--

LOCK TABLES `year_batch` WRITE;
/*!40000 ALTER TABLE `year_batch` DISABLE KEYS */;
INSERT INTO `year_batch` VALUES (1,'2008-12 Batch'),(2,'2009-13 Batch'),(3,'2010-14 Batch'),(4,'2011-15 Batch'),(5,'Other');
/*!40000 ALTER TABLE `year_batch` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-25 12:11:50
