-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost:3306	Database: ceneac5
-- ------------------------------------------------------
-- Server version 	5.7.16
-- Date: Mon, 19 Jun 2017 00:31:16 +0000

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
-- Table structure for table `auth_assignment`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_assignment` VALUES ('admin','1',1497211512),('instructor','4',1497804832),('participante','5',1497802706);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `auth_item`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_item` VALUES ('admin',1,'Usuario Administrador',NULL,NULL,1497211478,1497213330),('Categorias - Actualizar',2,'El usuario puede actualizar categorías',NULL,NULL,1497232744,1497232744),('Categorias - Crear',2,'El usuario puede crear categorías',NULL,NULL,1497232758,1497232758),('Categorias - Eliminar',2,'El usuario puede eliminar categorías',NULL,NULL,1497232773,1497232773),('Categorias - Leer',2,'El usuario puede consultar categorías',NULL,NULL,1497232793,1497232793),('Categorias - Todos',2,'El usuario puede realizar todas las acciones con las categorías',NULL,NULL,1497232807,1497232807),('Cronograma - Actualizar',2,'El usuario puede actualizar cronogramas',NULL,NULL,1497232991,1497232991),('Cronograma - Crear',2,'El usuario puede crear cronogramas',NULL,NULL,1497233001,1497233001),('Cronograma - Eliminar',2,'El usuario puede eliminar cronogramas',NULL,NULL,1497233013,1497233013),('Cronograma - Leer',2,'El usuario puede consultar cronogramas',NULL,NULL,1497233028,1497233028),('Cronograma - Todos',2,'El usuario puede realizar todas las acciones con los cronogramas',NULL,NULL,1497233042,1497233042),('Cursos - Actualizar',2,'El usuario puede actualizar cursos',NULL,NULL,1497213211,1497213211),('Cursos - Crear',2,'El usuario puede crear cursos',NULL,NULL,1497211541,1497213133),('Cursos - Eliminar',2,'El usuario puede eliminar cursos',NULL,NULL,1497213157,1497213157),('Cursos - Leer',2,'El usuario puede consultar cursos',NULL,NULL,1497213190,1497213190),('Cursos - Todos',2,'El usuario puede realizar todas las acciones con los cursos',NULL,NULL,1497213271,1497213298),('instructor',1,'Instructor perteneciente al CENAC',NULL,NULL,1497804806,1497804806),('participante',1,'Usuario inscrito/preinscrito/interesado en un curso.',NULL,NULL,1497802686,1497802686),('Respaldos - Crear',2,'El usuario puede crear respaldos',NULL,NULL,1497233579,1497233579),('Respaldos - Eliminar',2,'El usuario puede eliminar respaldos',NULL,NULL,1497233593,1497233593),('Respaldos - Todos',2,'El usuario puede realizar todas las acciones con los respaldos',NULL,NULL,1497233623,1497233623),('Usuarios - Actualizar',2,'El usuario puede actualizar usuarios',NULL,NULL,1497235144,1497235144),('Usuarios - Crear',2,'El usuario puede crear usuarios',NULL,NULL,1497235157,1497235157),('Usuarios - Eliminar',2,'El usuario puede eliminar usuarios',NULL,NULL,1497235169,1497235169),('Usuarios - Leer',2,'El usuario puede consultar usuarios',NULL,NULL,1497235180,1497235180),('Usuarios - Todos',2,'El usuario puede realizar todas las acciones con los usuarios',NULL,NULL,1497235194,1497235194);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `auth_item_child`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `auth_item_child` VALUES ('Categorias - Todos','Categorias - Actualizar'),('Categorias - Todos','Categorias - Crear'),('Categorias - Todos','Categorias - Eliminar'),('Categorias - Todos','Categorias - Leer'),('admin','Categorias - Todos'),('Cronograma - Todos','Cronograma - Actualizar'),('Cronograma - Todos','Cronograma - Crear'),('Cronograma - Todos','Cronograma - Eliminar'),('Cronograma - Todos','Cronograma - Leer'),('admin','Cronograma - Todos'),('Cursos - Todos','Cursos - Actualizar'),('Cursos - Todos','Cursos - Crear'),('Cursos - Todos','Cursos - Eliminar'),('Cursos - Todos','Cursos - Leer'),('admin','Cursos - Todos'),('Respaldos - Todos','Respaldos - Crear'),('Respaldos - Todos','Respaldos - Eliminar'),('admin','Respaldos - Todos'),('Usuarios - Todos','Usuarios - Actualizar'),('Usuarios - Todos','Usuarios - Crear'),('Usuarios - Todos','Usuarios - Eliminar'),('Usuarios - Todos','Usuarios - Leer'),('admin','Usuarios - Todos');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `auth_rule`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `backups`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `backups` VALUES (1,'/home/criera/Projects/CENEAC/ceneac_yii/backups/dump2017-06-11-20:39:38.sql',NULL,NULL);
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `categories`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `categories` VALUES (1,'Ofimática','Categoría de Ofimática Categoría de OfimáticaCategor ía de OfimáticaCategoría de Ofimática  Categoría de Ofimática a de Ofimática  a de Ofimática  a de Ofimática  a de Ofimática  a de Ofimática  a de Ofimática   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg a   sdgfsdfg.','2017-02-05 23:42:40','2017-02-05 23:42:40'),(2,'Programación','Descripción de programación','2017-02-06 02:46:22','2017-02-06 02:46:22');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `courses`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `costos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_name_unique` (`name`),
  KEY `courses_category_id_foreign` (`category_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `courses` VALUES (1,'Word 1','Descripción de Word 1',3,'3000',1,'2017-02-06 02:45:22','2017-02-06 02:45:22'),(2,'Python','sdfsdfsd',43,'200',2,NULL,NULL),(3,'Go','Go Lang',43,'200,100,50,10',2,NULL,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `instructors`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `schedule_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instructors_user_id_foreign` (`user_id`),
  KEY `instructors_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `instructors_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  CONSTRAINT `instructors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `instructors` VALUES (1,1,5,NULL,NULL),(2,1,7,NULL,NULL),(4,1,4,NULL,NULL);
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `interest_lists`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interest_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interest_lists_user_id_foreign` (`user_id`),
  KEY `interest_lists_course_id_foreign` (`course_id`),
  CONSTRAINT `interest_lists_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `interest_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interest_lists`
--

LOCK TABLES `interest_lists` WRITE;
/*!40000 ALTER TABLE `interest_lists` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `interest_lists` VALUES (1,4,1,'2017-03-09 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `interest_lists` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `migration`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migration` VALUES ('m000000_000000_base',1497134224),('m140506_102106_rbac_init',1497134407);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `payments`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `preregister_id` int(10) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_type` enum('DEPOSITO','CREDITO','EFECTIVO','TRANSFERENCIA','DEBITO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_bank` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `remaining_amount` double(8,2) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_preregister_id_foreign` (`preregister_id`),
  CONSTRAINT `payments_preregister_id_foreign` FOREIGN KEY (`preregister_id`) REFERENCES `preregisters` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `postulates`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postulates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `schedule_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postulates_user_id_foreign` (`user_id`),
  KEY `postulates_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `postulates_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  CONSTRAINT `postulates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postulates`
--

LOCK TABLES `postulates` WRITE;
/*!40000 ALTER TABLE `postulates` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `postulates` VALUES (1,1,7,NULL,NULL);
/*!40000 ALTER TABLE `postulates` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `preregisters`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preregisters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `schedule_id` int(10) unsigned NOT NULL,
  `preregister_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `preregisters_user_id_foreign` (`user_id`),
  KEY `preregisters_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `preregisters_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  CONSTRAINT `preregisters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preregisters`
--

LOCK TABLES `preregisters` WRITE;
/*!40000 ALTER TABLE `preregisters` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `preregisters` VALUES (1,4,4,'2017-03-03 00:00:00',1,'S',NULL,NULL);
/*!40000 ALTER TABLE `preregisters` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `registers`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `schedule_id` int(10) unsigned NOT NULL,
  `asistence` tinyint(1) DEFAULT NULL,
  `asistence_number` int(11) DEFAULT NULL,
  `personal_bill` tinyint(1) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registers_user_id_foreign` (`user_id`),
  KEY `registers_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `registers_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  CONSTRAINT `registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registers`
--

LOCK TABLES `registers` WRITE;
/*!40000 ALTER TABLE `registers` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `registers` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `schedules`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `start_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classroom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monday` tinyint(1) NOT NULL,
  `tuesday` tinyint(1) NOT NULL,
  `wednesday` tinyint(1) NOT NULL,
  `thursday` tinyint(1) NOT NULL,
  `friday` tinyint(1) NOT NULL,
  `saturday` tinyint(1) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_course_id_foreign` (`course_id`),
  CONSTRAINT `schedules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `schedules` VALUES (4,2,'2017-03-09 00:00:00','2017-03-21 00:00:00',44,'10:00 AM','10:00 AM','44',1,1,0,0,0,0,'eee',NULL,NULL),(5,1,'2017-03-09 00:00:00','2017-03-16 00:00:00',66,'10:00 AM','10:00 AM','6',1,0,0,0,0,0,'6',NULL,NULL),(7,3,'2017-03-23 00:00:00','2017-03-31 00:00:00',66,'10:00 AM','5:00 PM','55',1,1,1,1,1,1,'yes',NULL,NULL);
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `settings`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `settings` VALUES (1,'contact_email','Contact form email address','The email address that all emails from the contact form will go to.','admin@updivision.com','{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}',1,NULL,NULL),(2,'contact_cc','Contact form CC field','Email adresses separated by comma, to be included as CC in the email sent by the contact form.','','{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}',1,NULL,NULL),(3,'contact_bcc','Contact form BCC field','Email adresses separated by comma, to be included as BCC in the email sent by the contact form.','','{\"name\":\"value\",\"label\":\"Value\",\"type\":\"email\"}',1,NULL,NULL),(4,'motto','Motto','Website motto','this is the value','{\"name\":\"value\",\"label\":\"Value\", \"title\":\"Motto value\" ,\"type\":\"textarea\"}',1,NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `user`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` int(10) unsigned DEFAULT NULL,
  `phone_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_home` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (1,'ycarballo','$2y$13$mZ6jpMomhRDzXl27df59Z.3qAekW6sUIsmSOquIUwx5qOOueU5T9K','','','Yusneyi','Carballo','admin@ceneac.com',18004591,'','','2017-02-07 01:41:58','2017-02-07 01:41:58'),(4,'rmachado','$2y$13$D.1fvdq0p3CjEgN6LGwxwO7mbLJNdIRG9g/WbWUWLoG8PKocWawla','vwRkit6Ka-N18y1cEyJ4AL79OYlKmDHy',NULL,'Rafael','Machado','rmachado@ceneac.com',12345678,'','','2017-03-05 02:25:26','2017-03-05 02:25:26'),(5,'participante_1','$2y$13$suwyDmT06v1TJx69tGuBZeOUxf05Lk9VZJPxBjV3kxHU3tjqbfu66','pRdtqKyjuLHEsJXdDeNJ9PdQ0tu3kfB1','','José','Pereira','participante_1@gmail.com',12453687,'04161234567','02122344568','2017-06-18 16:16:09','2017-06-18 16:16:09');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 19 Jun 2017 00:31:16 +0000
