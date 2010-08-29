-- MySQL dump 10.11
--
-- Host: soad    Database: smailcrm
-- ------------------------------------------------------
-- Server version	5.1.46-log

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
-- Table structure for table `_account_states`
--

DROP TABLE IF EXISTS `_account_states`;
CREATE TABLE `_account_states` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `state_name` varchar(255) DEFAULT NULL,
  `koef` tinyint(1) DEFAULT '1',
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(11) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(11) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `state_name` (`state_name`),
  KEY `FK__account_states_1` (`modifier_users_rid`),
  KEY `FK__account_states` (`owner_users_rid`),
  CONSTRAINT `FK__account_states` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK__account_states_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_account_states`
--

LOCK TABLES `_account_states` WRITE;
/*!40000 ALTER TABLE `_account_states` DISABLE KEYS */;
INSERT INTO `_account_states` VALUES (2,'00001','Расходы на аренду',-1,'Расходы на аренду',1,'2010-04-15 21:00:00','2010-08-20 15:13:14',1,0),(3,'00002','Расходы на рекламу',-1,'Расходы на рекламные кампании',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(4,'00003','Предоплата за тур',1,'Предоплата за тур от клиентов на счет ЦО',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(5,'00004','Доплата за тур',1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(6,'00005','Расходы на связь',-1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(7,'00006','Расходы на Tury.in.ua',-1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(8,'00007','Расходы прочие',-1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(9,'00008','Расходы на вывески и навигацию',-1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(10,'00009','Налоговые расходы по ЗП',-1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(11,'00010','Коммунальные услуги',-1,'Затраты на коммунальные услуги',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(12,'00011','Расходы на Интернет',-1,'Затраты на интернет',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(13,'00012','Расходы на открытие филиалов',-1,'Расходы на открытие филиалов',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(14,'00013','Приобретение ОС',-1,'Приобретение ОС',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(15,'00014','Коммандировочные расходы',-1,'Расходы на коммандировки',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0),(20,'00019','Расчеты с туроператорами',-1,'',1,'2010-04-15 21:00:00','2010-04-15 21:00:00',1,0);
/*!40000 ALTER TABLE `_account_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_advertises_headers`
--

DROP TABLE IF EXISTS `_advertises_headers`;
CREATE TABLE `_advertises_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `_advertisescompanies_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `date_doc` timestamp NULL DEFAULT NULL,
  `sum` float(10,2) DEFAULT '0.00',
  `bdate` timestamp NULL DEFAULT NULL,
  `edate` timestamp NULL DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(11) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `_documents_rid` (`_documents_rid`),
  KEY `FK__advertises_headers2` (`modifier_users_rid`),
  KEY `FK__advertises_headers1` (`owner_users_rid`),
  KEY `FK__advertises_headers3` (`_advertisescompanies_rid`),
  KEY `FK__advertises_headers4` (`_advertisessources_rid`),
  KEY `FK__advertises_headers5` (`_currencies_rid`),
  CONSTRAINT `FK__advertises_headers` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_headers1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_headers2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_headers3` FOREIGN KEY (`_advertisescompanies_rid`) REFERENCES `_advertisescompanies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_headers4` FOREIGN KEY (`_advertisessources_rid`) REFERENCES `_advertisessources` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_headers5` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_advertises_headers`
--

LOCK TABLES `_advertises_headers` WRITE;
/*!40000 ALTER TABLE `_advertises_headers` DISABLE KEYS */;
INSERT INTO `_advertises_headers` VALUES (1,14450,17,125,1,'2009-07-17 21:00:00',100.00,'2009-06-30 21:00:00','2009-07-30 21:00:00',NULL,1,'2009-07-18 11:55:21','2010-07-18 13:22:08',1,0),(2,14451,18,126,1,'2009-07-17 21:00:00',466.00,'2009-06-30 21:00:00','2009-07-30 21:00:00',NULL,1,'2009-07-18 14:27:40','2010-07-18 13:22:44',1,0),(3,14466,18,128,1,'2010-05-01 21:00:00',300.00,'2010-04-15 21:00:00','2010-05-15 21:00:00',NULL,1,'2010-05-02 18:16:24','2010-05-02 18:36:29',1,0);
/*!40000 ALTER TABLE `_advertises_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_advertises_rows`
--

DROP TABLE IF EXISTS `_advertises_rows`;
CREATE TABLE `_advertises_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_advertises_headers_rid` int(12) DEFAULT NULL,
  `_filials_rid` int(12) DEFAULT NULL,
  `sum` float(10,2) DEFAULT '0.00',
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_advertises_headres_rid` (`_advertises_headers_rid`),
  KEY `FK__advertises_rows2` (`modifier_users_rid`),
  KEY `FK__advertises_rows1` (`owner_users_rid`),
  KEY `FK__advertises_rows3` (`_filials_rid`),
  CONSTRAINT `FK__advertises_rows` FOREIGN KEY (`_advertises_headers_rid`) REFERENCES `_advertises_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_rows1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_rows2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertises_rows3` FOREIGN KEY (`_filials_rid`) REFERENCES `_filials` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_advertises_rows`
--

LOCK TABLES `_advertises_rows` WRITE;
/*!40000 ALTER TABLE `_advertises_rows` DISABLE KEYS */;
INSERT INTO `_advertises_rows` VALUES (20,3,1,150.00,NULL,1,'2010-05-02 18:36:29','2010-05-02 18:36:29',1,0),(21,3,12,150.00,NULL,1,'2010-05-02 18:36:29','2010-05-02 18:36:29',1,0),(22,1,1,50.00,NULL,1,'2010-07-18 13:22:08','2010-07-18 13:22:08',1,0),(23,1,12,50.00,NULL,1,'2010-07-18 13:22:08','2010-07-18 13:22:08',1,0),(24,2,1,233.00,NULL,1,'2010-07-18 13:22:44','2010-07-18 13:22:44',1,0),(25,2,12,233.00,NULL,1,'2010-07-18 13:22:44','2010-07-18 13:22:44',1,0);
/*!40000 ALTER TABLE `_advertises_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_advertisescompanies`
--

DROP TABLE IF EXISTS `_advertisescompanies`;
CREATE TABLE `_advertisescompanies` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  `company_type` varchar(25) DEFAULT 'TOURISM',
  PRIMARY KEY (`rid`),
  KEY `FK__advertisescompanies1` (`modifier_users_rid`),
  KEY `FK__advertisescompanies2` (`owner_users_rid`),
  CONSTRAINT `FK__advertisescompanies1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertisescompanies2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_advertisescompanies`
--

LOCK TABLES `_advertisescompanies` WRITE;
/*!40000 ALTER TABLE `_advertisescompanies` DISABLE KEYS */;
INSERT INTO `_advertisescompanies` VALUES (17,'Тестовая рекламная кампания','Основная кампания',1,'2007-12-24 17:17:10','2010-05-02 15:52:25',1,0,'TOURISM'),(18,'Интернет продвижение','Продвижение сайта в интернет',1,'2009-07-18 14:25:47','2009-07-18 14:25:52',1,0,'TOURISM'),(19,'Продвижение статьями','Тестовая кампания',1,'2010-03-15 21:32:25','2010-03-15 21:32:29',1,0,'TOURISM');
/*!40000 ALTER TABLE `_advertisescompanies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_advertisessources`
--

DROP TABLE IF EXISTS `_advertisessources`;
CREATE TABLE `_advertisessources` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_advertisestypes_rid` int(12) DEFAULT NULL,
  `source_name` varchar(255) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__advertisessources1` (`_advertisestypes_rid`),
  KEY `FK__advertisessources2` (`modifier_users_rid`),
  KEY `FK__advertisessources3` (`owner_users_rid`),
  CONSTRAINT `FK__advertisessources1` FOREIGN KEY (`_advertisestypes_rid`) REFERENCES `_advertisestypes` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertisessources2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertisessources3` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_advertisessources`
--

LOCK TABLES `_advertisessources` WRITE;
/*!40000 ALTER TABLE `_advertisessources` DISABLE KEYS */;
INSERT INTO `_advertisessources` VALUES (34,20,'Знакомые','',1,'2008-01-29 12:37:20','2008-01-29 12:37:20',1,0),(35,20,'По рекомендации','',1,'2008-01-29 12:37:40','2008-01-29 12:37:40',1,0),(40,20,'Повторно','повторное обращение',1,'2008-02-12 11:13:57','2008-02-12 11:13:57',1,0),(124,19,'По рекомендации Coral Travel','',1,'2008-11-11 12:57:04','2010-07-18 12:53:23',1,1),(125,12,'Otpusk.com','Интернет портал Otpusk.com',1,'2009-07-18 11:53:02','2010-03-30 19:09:52',1,0),(126,12,'КР в Yandex','Контекстная реклама в Yandex',1,'2009-07-18 14:27:03','2009-07-18 15:21:31',1,0),(127,12,'Сервисы статей','',1,'2010-03-15 21:33:05','2010-03-15 21:33:09',1,0),(128,12,'Meta market','',1,'2010-05-02 18:06:36','2010-05-02 18:06:36',1,0);
/*!40000 ALTER TABLE `_advertisessources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_advertisestypes`
--

DROP TABLE IF EXISTS `_advertisestypes`;
CREATE TABLE `_advertisestypes` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__advertisestypes1` (`modifier_users_rid`),
  KEY `FK__advertisestypes2` (`owner_users_rid`),
  CONSTRAINT `FK__advertisestypes1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__advertisestypes2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_advertisestypes`
--

LOCK TABLES `_advertisestypes` WRITE;
/*!40000 ALTER TABLE `_advertisestypes` DISABLE KEYS */;
INSERT INTO `_advertisestypes` VALUES (12,'Интернет','Реклама в интернет',1,'2007-12-20 08:40:24','2010-03-30 19:14:06',1,0),(16,'Наружная реклама','',1,'2007-12-20 08:45:01','2007-12-20 08:45:01',1,0),(18,'Indoor','',1,'2008-01-18 15:38:17','2008-01-18 15:38:17',1,0),(19,'Бизнес-справка','',1,'2008-01-18 16:08:37','2009-08-24 21:39:26',1,0),(20,'Сарафанное радио','',1,'2008-01-29 12:36:31','2008-01-29 12:36:31',1,0);
/*!40000 ALTER TABLE `_advertisestypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_aircalls_headers`
--

DROP TABLE IF EXISTS `_aircalls_headers`;
CREATE TABLE `_aircalls_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `date_doc` timestamp NULL DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `_documents_rid` (`_documents_rid`),
  KEY `FK__calls_headers_3` (`modifier_users_rid`),
  KEY `FK__calls_headers1` (`owner_users_rid`),
  CONSTRAINT `FK__aircalls_headers_1` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_headers_2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_headers_4` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_aircalls_headers`
--

LOCK TABLES `_aircalls_headers` WRITE;
/*!40000 ALTER TABLE `_aircalls_headers` DISABLE KEYS */;
INSERT INTO `_aircalls_headers` VALUES (1,14457,'2009-09-02 13:30:00',NULL,1,'2009-09-02 13:32:31','2009-09-02 13:32:31',1,0);
/*!40000 ALTER TABLE `_aircalls_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_aircalls_rows`
--

DROP TABLE IF EXISTS `_aircalls_rows`;
CREATE TABLE `_aircalls_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_aircalls_headers_rid` int(12) DEFAULT NULL,
  `_clients_rid` int(12) DEFAULT NULL,
  `_countries_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `air_class` int(1) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `sum_wanted_to` float DEFAULT NULL,
  `tourists_quan` int(12) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  `phones` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `_calls_headers_rid` (`_aircalls_headers_rid`),
  KEY `_countries_rid` (`_countries_rid`),
  KEY `_adverises_rows_rid` (`_advertisessources_rid`),
  KEY `_currencies_rid` (`_currencies_rid`),
  KEY `FK__calls_rows_2` (`modifier_users_rid`),
  KEY `FK__calls_rows1` (`owner_users_rid`),
  KEY `FK__aircalls_rows8` (`_clients_rid`),
  CONSTRAINT `FK__aircalls_rows` FOREIGN KEY (`_advertisessources_rid`) REFERENCES `_advertisessources` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows1` FOREIGN KEY (`_aircalls_headers_rid`) REFERENCES `_aircalls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows2` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows4` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows5` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows7` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows8` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_aircalls_rows`
--

LOCK TABLES `_aircalls_rows` WRITE;
/*!40000 ALTER TABLE `_aircalls_rows` DISABLE KEYS */;
INSERT INTO `_aircalls_rows` VALUES (1,1,4727,174,40,2,3,'','','','2009-09-29 21:00:00','2009-10-30 22:00:00',2000,2,NULL,1,'2009-09-02 13:32:31','2010-07-15 23:26:45',1,0,'12345678','');
/*!40000 ALTER TABLE `_aircalls_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_aircompanies`
--

DROP TABLE IF EXISTS `_aircompanies`;
CREATE TABLE `_aircompanies` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `iata` varchar(2) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__aircompanies_1` (`modifier_users_rid`),
  KEY `FK__aircompanies_2` (`owner_users_rid`),
  CONSTRAINT `FK__aircompanies_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircompanies_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_aircompanies`
--

LOCK TABLES `_aircompanies` WRITE;
/*!40000 ALTER TABLE `_aircompanies` DISABLE KEYS */;
INSERT INTO `_aircompanies` VALUES (37,'165','JP','Adria Airwais','',1,'2008-09-11 07:52:43','2010-07-18 15:26:37',1,0),(38,'555','SU','Aeroflot',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(39,'870','VV','Aerosvit',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(40,'657','BT','Air Baltic',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(41,'057','AF','Air France',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(42,'055','AZ','Alitalia',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(43,'257','OS','Austrian Airlines','',1,'2008-09-11 07:52:43','2009-06-14 15:02:17',1,0),(44,'628','B2','Belavia',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(45,'125','BA','British Airways',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(46,'021','V3','Carpatair',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(47,'064','OK','CSA Czech Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(48,'006','DL','Delta Air',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(49,'181','Z6','Dneproavia',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(50,'897','7D','Donbassaero',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(51,'114','LY','ELAL',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(52,'176','EK','Emirates Air Lines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(53,'960','OV','Estonian Air',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(54,'105','AY','Finnair',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(55,'','3P','Georgian Airways',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(56,'241','K8','KD Avia',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(57,'074','KL','KLM Royal Dutch Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(58,'874','TE','Lithuanian Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(59,'080','LO','LOT Polish Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(60,'220','LH','Lufthansa',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(61,'182','MA','Malev',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(62,'117','SK','SAS Scandinavian Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(63,'421','S7','Siberia',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(64,'233','YG','South Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(65,'724','LX','Swiss International Air Lines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(66,'670','UN','TRANSAERO AIRLINES',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(67,'235','TK','Turkish Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(68,'566','PS','Ukrainian International Airlines',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(69,'828','UF','UM Air',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(70,'298','UT','UTair',NULL,1,'2008-09-11 07:52:43','2008-09-11 07:52:43',1,0),(78,'764','4L','ЕвроЛайн',NULL,1,'2008-09-11 07:52:43','2009-06-15 07:55:21',1,0);
/*!40000 ALTER TABLE `_aircompanies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_airsell_headers`
--

DROP TABLE IF EXISTS `_airsell_headers`;
CREATE TABLE `_airsell_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `_aircalls_documents_rid` int(12) DEFAULT NULL,
  `_clients_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `date_doc` date DEFAULT NULL,
  `anulated` tinyint(1) DEFAULT '0',
  `dnum` varchar(32) DEFAULT NULL COMMENT 'номер заявки',
  `bill_code` varchar(10) DEFAULT NULL,
  `bill_num` varchar(32) DEFAULT NULL,
  `bill_date` timestamp NULL DEFAULT NULL,
  `issue` tinyint(1) DEFAULT NULL,
  `sum` float(10,2) DEFAULT NULL,
  `brone_locator` varchar(32) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  `changes_before` varchar(50) DEFAULT NULL,
  `changes_after` varchar(50) DEFAULT NULL,
  `refund_before` varchar(50) DEFAULT NULL,
  `refund_after` varchar(50) DEFAULT NULL,
  `baggage_type` varchar(2) DEFAULT NULL,
  `baggage_allowance` float DEFAULT NULL,
  `not_changes` int(11) DEFAULT NULL,
  `not_refund` int(11) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__airsell_headers_1` (`_documents_rid`),
  KEY `FK__airsell_headers_2` (`_advertisessources_rid`),
  KEY `FK__airsell_headers_6` (`owner_users_rid`),
  KEY `FK__airsell_headers_7` (`modifier_users_rid`),
  KEY `FK__airsell_headers3` (`_clients_rid`),
  KEY `FK__airsell_headers_4` (`_aircalls_documents_rid`),
  KEY `FK__airsell_headers_8` (`_currencies_rid`),
  CONSTRAINT `FK__airsell_headers3` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__airsell_headers_1` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__airsell_headers_2` FOREIGN KEY (`_advertisessources_rid`) REFERENCES `_advertisessources` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__airsell_headers_6` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__airsell_headers_7` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__airsell_headers_8` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_airsell_headers`
--

LOCK TABLES `_airsell_headers` WRITE;
/*!40000 ALTER TABLE `_airsell_headers` DISABLE KEYS */;
INSERT INTO `_airsell_headers` VALUES (1,14464,35,14457,4720,NULL,'2010-04-05',0,'14464','','',NULL,2,0.00,'',NULL,1,'2010-04-05 10:32:37','2010-07-15 21:17:26',1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `_airsell_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_airsell_routes`
--

DROP TABLE IF EXISTS `_airsell_routes`;
CREATE TABLE `_airsell_routes` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_airsell_headers_rid` int(12) DEFAULT NULL,
  `_aircompanies_rid` int(12) DEFAULT NULL,
  `_countries_rid_from` int(12) DEFAULT NULL,
  `_countries_rid_to` int(12) DEFAULT NULL,
  `point_from` varchar(32) DEFAULT NULL,
  `point_to` varchar(32) DEFAULT NULL,
  `departure` date DEFAULT NULL,
  `arrival` date DEFAULT NULL,
  `air_class` int(2) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__routes_2` (`_countries_rid_from`),
  KEY `FK__routes_3` (`_countries_rid_to`),
  KEY `FK__routes_4` (`_aircompanies_rid`),
  KEY `FK__roures_1` (`_airsell_headers_rid`),
  KEY `FK__airsell_routes_5` (`owner_users_rid`),
  KEY `FK__airsell_routes_6` (`modifier_users_rid`),
  CONSTRAINT `FK__airsell_routes_5` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__airsell_routes_6` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__roures_1` FOREIGN KEY (`_airsell_headers_rid`) REFERENCES `_airsell_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__routes_2` FOREIGN KEY (`_countries_rid_from`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__routes_3` FOREIGN KEY (`_countries_rid_to`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__routes_4` FOREIGN KEY (`_aircompanies_rid`) REFERENCES `_aircompanies` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_airsell_routes`
--

LOCK TABLES `_airsell_routes` WRITE;
/*!40000 ALTER TABLE `_airsell_routes` DISABLE KEYS */;
INSERT INTO `_airsell_routes` VALUES (11,1,43,1,13,'Киев','Вена','2010-04-05','2010-04-05',3,1,1,'2010-07-15 21:17:26',NULL),(12,1,43,13,1,'Вена','Киев (Борисполь)','2010-04-06','2010-04-06',3,1,1,'2010-07-15 21:17:27',NULL);
/*!40000 ALTER TABLE `_airsell_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_attaches`
--

DROP TABLE IF EXISTS `_attaches`;
CREATE TABLE `_attaches` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `file_descr` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(32) DEFAULT NULL,
  `file_size` float(10,2) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `raw_name` varchar(255) DEFAULT NULL,
  `orig_name` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `is_image` tinyint(1) DEFAULT NULL,
  `image_width` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `image_type` varchar(32) DEFAULT NULL,
  `image_size_str` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_attaches`
--

LOCK TABLES `_attaches` WRITE;
/*!40000 ALTER TABLE `_attaches` DISABLE KEYS */;
INSERT INTO `_attaches` VALUES (17,'7486bd6db95634bd012e7e7498b7a8f5.jpg','7486bd6db95634bd012e7e7498b7a8f5.jpg','image/jpeg',31.20,'/home/mazvv/Projects/Php/travelcrm/public/attaches/hotels/','7486bd6db95634bd012e7e7498b7a8f5',NULL,'.jpg',1,450,278,'jpeg','width=\"450\" height=\"278\"'),(18,'Photo1','6cdc4084bbc99924f32be6d68207fd52.jpg','image/jpeg',26.60,'/home/mazvv/Projects/Php/travelcrm/public/attaches/hotels/','6cdc4084bbc99924f32be6d68207fd52',NULL,'.jpg',1,372,245,'jpeg','width=\"372\" height=\"245\"'),(19,'Photo2','b5fbbae95d86f847b51782e4cc0f7464.jpg','image/jpeg',212.92,'/home/mazvv/Projects/Php/travelcrm/public/attaches/hotels/','b5fbbae95d86f847b51782e4cc0f7464',NULL,'.jpg',1,1024,767,'jpeg','width=\"1024\" height=\"767\"'),(20,'Photo3','c835186ee3e206922b89e3a941d907eb.jpg','image/jpeg',305.25,'/home/mazvv/Projects/Php/travelcrm/public/attaches/hotels/','c835186ee3e206922b89e3a941d907eb',NULL,'.jpg',1,1024,885,'jpeg','width=\"1024\" height=\"885\"'),(21,'Photo4','80002fe3862e81517552402e70de7476.jpg','image/jpeg',173.66,'/home/mazvv/Projects/Php/travelcrm/public/attaches/hotels/','80002fe3862e81517552402e70de7476',NULL,'.jpg',1,1024,984,'jpeg','width=\"1024\" height=\"984\"');
/*!40000 ALTER TABLE `_attaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_calls_countries`
--

DROP TABLE IF EXISTS `_calls_countries`;
CREATE TABLE `_calls_countries` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_calls_headers_rid` int(12) DEFAULT NULL,
  `_countries_rid` int(12) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__calls_countries` (`_countries_rid`),
  KEY `FK__calls_countries_2` (`_calls_headers_rid`),
  CONSTRAINT `FK__calls_countries_2` FOREIGN KEY (`_calls_headers_rid`) REFERENCES `_calls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_countries` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_calls_countries`
--

LOCK TABLES `_calls_countries` WRITE;
/*!40000 ALTER TABLE `_calls_countries` DISABLE KEYS */;
INSERT INTO `_calls_countries` VALUES (25,5331,3),(26,5331,7),(44,5292,3),(45,5333,64),(48,5332,1),(49,5334,64),(52,5335,3),(53,5335,7),(55,5336,117);
/*!40000 ALTER TABLE `_calls_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_calls_curourts`
--

DROP TABLE IF EXISTS `_calls_curourts`;
CREATE TABLE `_calls_curourts` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_calls_headers_rid` int(12) DEFAULT NULL,
  `_curourts_rid` int(12) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__calls_curourts` (`_curourts_rid`),
  KEY `FK__calls_curourts_2` (`_calls_headers_rid`),
  CONSTRAINT `FK__calls_curourts_2` FOREIGN KEY (`_calls_headers_rid`) REFERENCES `_calls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_curourts` FOREIGN KEY (`_curourts_rid`) REFERENCES `_curourts` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_calls_curourts`
--

LOCK TABLES `_calls_curourts` WRITE;
/*!40000 ALTER TABLE `_calls_curourts` DISABLE KEYS */;
INSERT INTO `_calls_curourts` VALUES (15,5331,1),(16,5331,2),(17,5331,14),(20,5292,2),(23,5332,13);
/*!40000 ALTER TABLE `_calls_curourts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_calls_food`
--

DROP TABLE IF EXISTS `_calls_food`;
CREATE TABLE `_calls_food` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_calls_headers_rid` int(12) DEFAULT NULL,
  `_food_rid` int(12) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__calls_food_1` (`_calls_headers_rid`),
  KEY `FK__calls_food_2` (`_food_rid`),
  CONSTRAINT `FK__calls_food_2` FOREIGN KEY (`_food_rid`) REFERENCES `_food` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_food_1` FOREIGN KEY (`_calls_headers_rid`) REFERENCES `_calls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_calls_food`
--

LOCK TABLES `_calls_food` WRITE;
/*!40000 ALTER TABLE `_calls_food` DISABLE KEYS */;
INSERT INTO `_calls_food` VALUES (1,5292,4),(2,5292,5),(3,5333,1),(4,5333,2),(7,5332,1),(8,5334,1),(9,5334,2),(12,5335,4),(13,5335,5),(17,5336,4),(18,5336,5),(19,5336,6);
/*!40000 ALTER TABLE `_calls_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_calls_hcats`
--

DROP TABLE IF EXISTS `_calls_hcats`;
CREATE TABLE `_calls_hcats` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_calls_headers_rid` int(12) DEFAULT NULL,
  `_hotelscats_rid` int(12) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__calls_hcats` (`_calls_headers_rid`),
  KEY `FK__calls_hcats1` (`_hotelscats_rid`),
  CONSTRAINT `FK__calls_hcats` FOREIGN KEY (`_calls_headers_rid`) REFERENCES `_calls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_hcats1` FOREIGN KEY (`_hotelscats_rid`) REFERENCES `_hotelscats` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_calls_hcats`
--

LOCK TABLES `_calls_hcats` WRITE;
/*!40000 ALTER TABLE `_calls_hcats` DISABLE KEYS */;
INSERT INTO `_calls_hcats` VALUES (49,5331,5),(82,5292,5),(83,5333,4),(84,5333,5),(89,5332,2),(90,5332,3),(91,5334,3),(92,5334,4),(95,5335,4),(96,5335,5),(99,5336,4),(100,5336,5);
/*!40000 ALTER TABLE `_calls_hcats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_calls_headers`
--

DROP TABLE IF EXISTS `_calls_headers`;
CREATE TABLE `_calls_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `date_doc` timestamp NULL DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `_documents_rid` (`_documents_rid`),
  KEY `FK__calls_headers_3` (`modifier_users_rid`),
  KEY `FK__calls_headers1` (`owner_users_rid`),
  CONSTRAINT `FK__calls_headers1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_headers_2` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_headers_3` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5337 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_calls_headers`
--

LOCK TABLES `_calls_headers` WRITE;
/*!40000 ALTER TABLE `_calls_headers` DISABLE KEYS */;
INSERT INTO `_calls_headers` VALUES (5292,8582,'2009-08-14 08:02:00',NULL,1,'2008-08-15 08:17:03','2008-08-15 08:17:03',1,0),(5331,14470,'2010-08-15 09:58:00',NULL,1,'2010-08-15 10:03:39','2010-08-15 10:03:39',1,0),(5332,14471,'2010-08-15 10:05:00',NULL,1,'2010-08-15 10:12:18','2010-08-15 10:12:18',1,0),(5333,14473,'2010-08-15 11:26:00',NULL,1,'2010-08-15 11:28:28','2010-08-15 11:28:28',1,0),(5334,14474,'2010-08-19 20:09:00',NULL,1,'2010-08-19 20:11:31','2010-08-19 20:11:31',1,0),(5335,14476,'2010-08-19 20:28:00',NULL,2,'2010-08-19 20:29:55','2010-08-19 20:29:55',2,0),(5336,14478,'2010-08-20 18:12:00',NULL,2,'2010-08-20 18:15:52','2010-08-20 18:15:52',2,0);
/*!40000 ALTER TABLE `_calls_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_calls_rows`
--

DROP TABLE IF EXISTS `_calls_rows`;
CREATE TABLE `_calls_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_calls_headers_rid` int(12) DEFAULT NULL,
  `_clients_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `sum_wanted_to` float DEFAULT NULL,
  `tourists_quan` int(12) DEFAULT NULL,
  `chields_quan` int(11) DEFAULT NULL,
  `tourists_wish` varchar(512) DEFAULT NULL,
  `tourists_offers` varchar(512) DEFAULT NULL,
  `tourists_answers` varchar(512) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  `phones` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `_calls_headers_rid` (`_calls_headers_rid`),
  KEY `_adverises_rows_rid` (`_advertisessources_rid`),
  KEY `_currencies_rid` (`_currencies_rid`),
  KEY `FK__calls_rows_2` (`modifier_users_rid`),
  KEY `FK__calls_rows1` (`owner_users_rid`),
  KEY `FK__calls_rows8` (`_clients_rid`),
  CONSTRAINT `FK__calls_rows` FOREIGN KEY (`_calls_headers_rid`) REFERENCES `_calls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows7` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows8` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows_2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5319 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_calls_rows`
--

LOCK TABLES `_calls_rows` WRITE;
/*!40000 ALTER TABLE `_calls_rows` DISABLE KEYS */;
INSERT INTO `_calls_rows` VALUES (5274,5292,NULL,35,2,'марина','','','2008-09-26 21:00:00','2008-10-03 21:00:00',2500,2,0,'Желаемый уровень отеля: 4*\nПожелания по питанию: Все включено\n------------------------------------\nКол. взрослых туристов: 2\nКол. детей: 13; 8','minamark hurghada, coral beach rotana resort','-',NULL,1,'2008-08-15 08:17:03','2010-08-15 15:48:22',1,0,'8-097-998-33-67',''),(5313,5331,NULL,128,2,'Руслан','Валериевич','Остапенко','2010-08-31 21:00:00','2010-09-11 21:00:00',2300,3,NULL,'Пожелания туриста','Предложения туристу','Ответы туриста',NULL,1,'2010-08-15 10:03:39','2010-08-15 11:02:11',1,0,'044 1111111',''),(5314,5332,4733,125,2,'','','','2010-09-12 21:00:00','2010-09-24 21:00:00',750,2,1,'Пожелания туриста','Предложения туристу','Ответы туриста',NULL,1,'2010-08-15 10:12:18','2010-08-15 15:56:15',1,0,'03659851',''),(5315,5333,NULL,35,4,'Сергей','','','2010-08-24 21:00:00','2010-08-29 21:00:00',1350,2,1,'Пожелания туриста *','Предложения туристу *','Ответы туриста *',NULL,1,'2010-08-15 11:28:28','2010-08-15 15:51:25',1,0,'0679995588',''),(5316,5334,NULL,124,4,'Игорь','','','2010-08-31 21:00:00','2010-09-11 21:00:00',1300,2,1,'Пожелания туриста','Предложения туристу','Ответы туриста',NULL,1,'2010-08-19 20:11:31','2010-08-19 20:11:31',1,0,'044 1523112',''),(5317,5335,NULL,125,2,'Элла','','','2010-08-19 21:00:00','2010-08-26 21:00:00',2300,2,2,'--','*---','***---',NULL,2,'2010-08-19 20:29:55','2010-08-19 20:31:08',2,0,'0664561232',''),(5318,5336,4738,126,2,'','','','2010-08-20 21:00:00','2010-08-22 21:00:00',2800,2,1,'--','--','--',NULL,2,'2010-08-20 18:15:52','2010-08-20 18:15:57',2,0,'12345687','');
/*!40000 ALTER TABLE `_calls_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_chat`
--

DROP TABLE IF EXISTS `_chat`;
CREATE TABLE `_chat` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__chat_1` (`modifier_users_rid`),
  KEY `FK__chat_2` (`owner_users_rid`),
  CONSTRAINT `FK__chat_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__chat_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_chat`
--

LOCK TABLES `_chat` WRITE;
/*!40000 ALTER TABLE `_chat` DISABLE KEYS */;
INSERT INTO `_chat` VALUES (40,'сообщение 1',1,'2009-07-05 17:09:36','2009-07-05 17:09:36',1,0),(41,'сообщение 2',1,'2009-07-05 17:09:58','2009-07-05 17:09:58',1,0),(42,'сообщение 3',1,'2009-07-05 17:13:49','2009-07-05 17:13:49',1,0),(43,'сообщение 4',1,'2009-07-05 17:13:57','2009-07-05 17:13:57',1,0),(44,'сообщение 5',1,'2009-07-05 17:14:52','2009-07-05 17:14:52',1,0),(45,'сообщение 6',1,'2009-07-05 17:15:03','2009-07-05 17:15:03',1,0),(46,'сообщение 7',1,'2009-07-05 17:15:15','2009-07-05 17:15:15',1,0),(47,'сообщение 8',1,'2009-07-05 17:15:25','2009-07-05 17:15:25',1,0),(48,'сообщение 9',1,'2009-07-05 17:15:33','2009-07-05 17:15:33',1,0),(49,'сообщение 10',1,'2009-07-05 17:16:02','2009-07-05 17:16:02',1,0),(50,'',1,'2009-07-05 17:17:37','2009-07-05 17:17:37',1,0),(51,'',1,'2009-07-05 17:24:40','2009-07-05 17:24:40',1,0),(52,'еку имеку ',1,'2009-07-05 17:24:43','2009-07-05 17:24:43',1,0),(53,'',1,'2009-07-05 17:35:48','2009-07-05 17:35:48',1,0),(54,'Тест IE',1,'2009-07-05 17:36:01','2009-07-05 17:36:01',1,0),(55,'Тест IE',1,'2009-07-05 17:36:25','2009-07-05 17:36:25',1,0),(56,'',1,'2009-07-05 17:38:51','2009-07-05 17:38:51',1,0),(57,'',1,'2009-07-05 17:40:06','2009-07-05 17:40:06',1,0),(58,'test',1,'2009-07-05 17:40:10','2009-07-05 17:40:10',1,0),(59,'test',1,'2009-07-05 17:40:31','2009-07-05 17:40:31',1,0),(60,'test',1,'2009-07-05 17:53:57','2009-07-05 17:53:57',1,0),(61,'',1,'2009-07-05 17:56:49','2009-07-05 17:56:49',1,0),(62,'',1,'2009-07-05 17:56:49','2009-07-05 17:56:49',1,0),(63,'asd',1,'2009-07-05 17:57:09','2009-07-05 17:57:09',1,0);
/*!40000 ALTER TABLE `_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_cities`
--

DROP TABLE IF EXISTS `_cities`;
CREATE TABLE `_cities` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_countries_rid` int(12) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `city_name_lat` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_countries_rid` (`_countries_rid`),
  KEY `FK__cities2` (`modifier_users_rid`),
  KEY `FK__cities1` (`owner_users_rid`),
  CONSTRAINT `FK__cities` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__cities1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__cities2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_cities`
--

LOCK TABLES `_cities` WRITE;
/*!40000 ALTER TABLE `_cities` DISABLE KEYS */;
INSERT INTO `_cities` VALUES (1,1,'Київ','Kiev','',1,'2007-11-30 14:31:11','2010-04-02 01:23:19',1,0),(2,1,'Донецьк','Donetsk','',1,'2007-11-13 14:06:41','2008-01-22 12:53:51',1,0),(5,1,'Дніпропетровськ','Dnepropetrovsk','',1,'2007-12-20 19:01:44','2008-01-22 12:54:01',1,0),(6,1,'Запорожье','Zaporozhe','',1,'2007-12-20 19:02:13','2007-12-20 19:02:13',1,0),(7,1,'Львов','Lvov','',1,'2007-12-20 19:02:36','2007-12-20 19:02:36',1,0),(8,1,'Кривой Рог','Krivoy Rog','',1,'2007-12-20 19:03:22','2007-12-20 19:03:22',1,0),(9,1,'Одеса','Odessa','',1,'2007-12-20 19:03:49','2008-01-25 18:05:33',1,0),(10,1,'Луганск','Lugansk','',1,'2007-12-20 19:04:20','2007-12-20 19:04:20',1,0),(11,1,'Харьков','Kharkov','',1,'2007-12-20 19:04:44','2009-06-06 14:55:36',1,0),(12,1,'Винница','Vinnica','',1,'2008-03-04 17:59:05','2008-03-04 17:59:05',1,0),(13,1,'Бровары','Brovary','',1,'2008-10-31 18:32:40','2008-10-31 18:32:40',1,0),(14,1,'Хмельницький','Khmelnytskyy','',1,'2008-11-27 17:38:03','2010-07-18 22:21:57',1,1);
/*!40000 ALTER TABLE `_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_clients`
--

DROP TABLE IF EXISTS `_clients`;
CREATE TABLE `_clients` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `parent` int(12) DEFAULT NULL COMMENT 'Родитель',
  `f_name` varchar(255) DEFAULT NULL COMMENT 'Имя',
  `s_name` varchar(255) DEFAULT NULL COMMENT 'Отчество',
  `l_name` varchar(255) DEFAULT NULL COMMENT 'Фамилия',
  `f_name_lat` varchar(255) DEFAULT NULL COMMENT 'Имя лат',
  `l_name_lat` varchar(255) DEFAULT NULL COMMENT 'Фамилия лат',
  `birthday` datetime DEFAULT NULL COMMENT 'Дата рождения',
  `citizenship` varchar(255) DEFAULT NULL COMMENT 'Гражданство',
  `_countries_rid` int(12) DEFAULT NULL COMMENT 'Гражданство',
  `passp_seria` varchar(20) DEFAULT NULL COMMENT 'Серия паспорта',
  `passp_num` varchar(20) DEFAULT NULL COMMENT 'Номер паспорта',
  `passp_out` varchar(255) DEFAULT NULL COMMENT 'Кем и когда выдан',
  `f_pass_seria` varchar(20) DEFAULT NULL COMMENT 'Серия загран паспорта',
  `f_pass_num` varchar(20) DEFAULT NULL COMMENT 'Номер загран паспорта',
  `f_pass_period` timestamp NULL DEFAULT NULL COMMENT 'Период загран паспорта',
  `f_pass_out` varchar(255) DEFAULT NULL,
  `nal_number` varchar(20) DEFAULT NULL COMMENT 'Налоговый номер',
  `_cities_rid` int(12) DEFAULT NULL COMMENT 'Город',
  `adress` varchar(255) DEFAULT NULL COMMENT 'Адрес',
  `phones` varchar(255) DEFAULT NULL COMMENT 'телефоны',
  `email` varchar(65) DEFAULT NULL COMMENT 'емайл',
  `_dcarts_rid` int(12) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__clients` (`modifier_users_rid`),
  KEY `FK__clients4` (`citizenship`),
  KEY `FK__clients2` (`_cities_rid`),
  KEY `FK__clients1` (`owner_users_rid`),
  KEY `FK__clients_3` (`_dcarts_rid`),
  CONSTRAINT `FK__clients` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__clients1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__clients2` FOREIGN KEY (`_cities_rid`) REFERENCES `_cities` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__clients_3` FOREIGN KEY (`_dcarts_rid`) REFERENCES `_dcarts` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4741 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_clients`
--

LOCK TABLES `_clients` WRITE;
/*!40000 ALTER TABLE `_clients` DISABLE KEYS */;
INSERT INTO `_clients` VALUES (4675,0,'Ярослава','','Нараевская','YAROSLAVA','NARAEVSKA','2007-03-17 00:00:00','',1,'','','','','',NULL,'','',1,'','0509281519','',NULL,'F','',1,'2008-11-21 12:25:27','2010-08-18 20:12:25',1,0),(4714,0,'Елена','','Струкова','OLENA ','STRUKOVA','1976-02-26 00:00:00','',NULL,'','','','','','0000-00-00 00:00:00',NULL,'',1,'','80674025657','',NULL,'0','',1,'2008-11-26 13:46:28','2008-11-26 14:31:41',1,0),(4720,0,'Любовь','','Копытко','LYUBOV','KOPYTKO','2008-11-02 00:00:00','',NULL,'','','','','','0000-00-00 00:00:00',NULL,'',1,'','11111111','',NULL,'0','',1,'2008-11-27 09:20:36','2008-11-27 09:20:36',1,0),(4725,0,'Алла','','Джигомон','ALLA','DZHYGOMON','2008-11-26 00:00:00','',1,'','','','','',NULL,'','',1,'','599 4415, 80934458033','',NULL,'F','',1,'2008-11-28 12:38:13','2010-08-16 17:17:04',1,0),(4726,0,'Андрей','','Козенко','ANDREY','KOZENKO','2008-11-28 00:00:00','',1,'','','','','',NULL,'','',1,'','11111111','',3,'M','',1,'2008-11-28 13:00:56','2010-04-05 18:33:15',1,0),(4727,0,'Татьяна','','Овсиенко','TATYANA','OVCIENKO','1979-09-03 00:00:00',NULL,1,'','','','YY','456123','2019-09-29 21:00:00','','',1,'','12223664','',4,'F','',1,'2009-09-02 10:28:43','2010-07-18 21:30:51',1,0),(4729,0,'Михаил','','Яневский','Michail','Yanevskiy','1972-05-16 00:00:00',NULL,1,'','','','НГ','123456','2012-11-30 22:00:00','','',1,'','044 1111111','',NULL,'M','',2,'2010-05-07 08:03:06','2010-05-16 09:13:07',1,0),(4730,0,'Олег','Олександрович','Погорелов','Oleg','Pogorelov','1970-02-17 00:00:00',NULL,1,'НК','121212','','','',NULL,'','',1,'Киев, ул.Приозерная','044 333-22-11','',NULL,'M','',1,'2010-08-10 21:11:50','2010-08-10 21:11:54',1,0),(4731,0,'Елена','Петровна','Погорелова','Helen','Pogorelova','1970-02-21 00:00:00',NULL,1,'','','','','',NULL,'','',1,'Киев, ул. Приозерная','044 333-22-11','',NULL,'F','',1,'2010-08-10 21:13:37','2010-08-10 21:13:43',1,0),(4732,0,'Александра','Олеговна','Погорелова','Alexandra','Pogorelova','1992-07-01 00:00:00',NULL,1,'','','','','',NULL,'','',1,'','','',NULL,'F','',1,'2010-08-10 21:14:54','2010-08-10 21:14:58',1,0),(4733,0,'Алексей','Сергеевич','Михайлов','Alexey','Mihailov','1979-02-18 00:00:00',NULL,1,'','','','','',NULL,'','',1,'','0683596598','',NULL,'M','',1,'2010-08-15 10:09:42','2010-08-15 10:10:31',1,0),(4734,0,'Элина','','Михайлова','Elina','Mihailova','1978-04-25 00:00:00',NULL,1,'','','','','',NULL,'','',1,'','0445656213','',NULL,'F','',1,'2010-08-15 10:20:04','2010-08-15 10:20:07',1,0),(4735,0,'Ирина','Алексеевна','Михайлова','Irina','Mihailova','2006-01-15 00:00:00',NULL,1,'','','','','',NULL,'','',1,'','044 422423123','',NULL,'F','',1,'2010-08-15 10:21:48','2010-08-15 10:21:53',1,0),(4736,0,'Элла','Леонидовна','Онопко','Ella','Onopko','1978-03-30 00:00:00',NULL,1,'','','','RR','123456',NULL,'','',1,'','456123354','',NULL,'F','',2,'2010-08-19 20:39:04','2010-08-20 07:25:12',2,0),(4737,0,'Анатолий','','Онопко','Anatolii','Onopko','1976-09-03 00:00:00',NULL,1,'','','','','',NULL,'','',1,'','044123456456','',NULL,'M','',2,'2010-08-20 07:37:41','2010-08-20 07:37:47',2,0),(4738,0,'Руслан','','Савченко','Ruslan','Savchenko','1982-05-02 00:00:00',NULL,1,'','','','АА','456789',NULL,'','',11,'','323566544','',NULL,'M','',2,'2010-08-20 18:14:20','2010-08-20 18:14:50',2,0),(4739,0,'Алина','','Савченко','Alina','Savchenko','2005-10-23 00:00:00',NULL,1,'','','','','',NULL,'','',11,'','12316546','',NULL,'F','',2,'2010-08-20 18:18:17','2010-08-20 18:18:22',2,0),(4740,0,'Анжела','','Дементьева','Angel','Dement\'eva','1984-07-17 00:00:00',NULL,1,'','','','','',NULL,'','',11,'','1234565','',NULL,'F','',2,'2010-08-20 18:19:47','2010-08-20 18:19:52',2,0);
/*!40000 ALTER TABLE `_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_clients_attaches`
--

DROP TABLE IF EXISTS `_clients_attaches`;
CREATE TABLE `_clients_attaches` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `_clients_rid` int(11) DEFAULT NULL,
  `_attaches_rid` int(11) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__clients_attaches0` (`_clients_rid`),
  KEY `FK__clients_attaches` (`_attaches_rid`),
  CONSTRAINT `FK__clients_attaches` FOREIGN KEY (`_attaches_rid`) REFERENCES `_attaches` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__clients_attaches0` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_clients_attaches`
--

LOCK TABLES `_clients_attaches` WRITE;
/*!40000 ALTER TABLE `_clients_attaches` DISABLE KEYS */;
/*!40000 ALTER TABLE `_clients_attaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_clients_interests`
--

DROP TABLE IF EXISTS `_clients_interests`;
CREATE TABLE `_clients_interests` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `_clients_rid` int(11) DEFAULT NULL,
  `_interests_rid` int(11) DEFAULT NULL,
  `mark` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__clients_interests_1` (`_clients_rid`),
  KEY `FK__clients_interests_2` (`_interests_rid`),
  CONSTRAINT `FK__clients_interests_1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__clients_interests_2` FOREIGN KEY (`_interests_rid`) REFERENCES `_interests` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_clients_interests`
--

LOCK TABLES `_clients_interests` WRITE;
/*!40000 ALTER TABLE `_clients_interests` DISABLE KEYS */;
INSERT INTO `_clients_interests` VALUES (1,NULL,5,0),(2,NULL,2,4),(3,NULL,3,0),(4,NULL,8,0),(5,NULL,6,0),(6,NULL,10,0),(7,NULL,1,0),(8,NULL,9,0),(9,NULL,4,0),(10,NULL,7,5),(31,4725,5,0),(32,4725,2,4),(33,4725,3,0),(34,4725,8,2),(35,4725,6,0),(36,4725,10,0),(37,4725,1,0),(38,4725,9,0),(39,4725,4,0),(40,4725,7,5),(201,4675,5,2),(202,4675,2,2),(203,4675,3,0),(204,4675,8,0),(205,4675,6,1),(206,4675,10,0),(207,4675,1,2),(208,4675,9,3),(209,4675,4,0),(210,4675,7,0),(241,4736,5,0),(242,4736,2,0),(243,4736,3,0),(244,4736,8,0),(245,4736,6,0),(246,4736,10,0),(247,4736,1,0),(248,4736,9,0),(249,4736,4,0),(250,4736,7,0),(261,4737,5,0),(262,4737,2,0),(263,4737,3,0),(264,4737,8,0),(265,4737,6,0),(266,4737,10,0),(267,4737,1,0),(268,4737,9,0),(269,4737,4,0),(270,4737,7,0),(291,4738,5,0),(292,4738,2,0),(293,4738,3,0),(294,4738,8,0),(295,4738,6,0),(296,4738,10,0),(297,4738,1,0),(298,4738,9,0),(299,4738,4,0),(300,4738,7,0),(311,4739,5,0),(312,4739,2,0),(313,4739,3,0),(314,4739,8,0),(315,4739,6,0),(316,4739,10,0),(317,4739,1,0),(318,4739,9,0),(319,4739,4,0),(320,4739,7,0),(331,4740,5,0),(332,4740,2,0),(333,4740,3,0),(334,4740,8,0),(335,4740,6,0),(336,4740,10,0),(337,4740,1,0),(338,4740,9,0),(339,4740,4,0),(340,4740,7,0);
/*!40000 ALTER TABLE `_clients_interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_constants`
--

DROP TABLE IF EXISTS `_constants`;
CREATE TABLE `_constants` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__constants_1` (`modifier_users_rid`),
  KEY `FK__constants_2` (`owner_users_rid`),
  CONSTRAINT `FK__constants_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__constants_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_constants`
--

LOCK TABLES `_constants` WRITE;
/*!40000 ALTER TABLE `_constants` DISABLE KEYS */;
INSERT INTO `_constants` VALUES (1,'COMPANY_NAME','Название компании','ТОВ \"Тестовая компания\"',2,'2009-07-10 11:22:07','2010-07-10 21:06:32',1,0),(2,'DIRECTOR','ФИО директора','Пупкин Василий Васильевич',1,'2009-07-11 14:31:43','2009-07-11 14:31:43',1,0),(3,'DIRECTOR_ROD','ФИО директора родительский падеж','Пупкина Василия Васильевича',1,'2009-07-11 14:33:21','2009-07-11 14:33:21',1,0),(4,'EDRPUO','Код ЄДРПОУ','111111111',1,'2009-07-11 14:40:22','2009-07-11 14:40:22',1,0),(5,'RECVISITS','Реквизиты компании','р/р 1111111111111  у ЗАТ «ОТП Банк»\nМФО 111111',1,'2009-07-11 14:42:57','2010-07-15 00:20:04',1,0);
/*!40000 ALTER TABLE `_constants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_contrahens`
--

DROP TABLE IF EXISTS `_contrahens`;
CREATE TABLE `_contrahens` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_cities_rid` int(11) DEFAULT NULL,
  `scontrahens_name` varchar(255) DEFAULT NULL,
  `contrahens_name` varchar(255) DEFAULT NULL,
  `www` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `NewIndex1` (`scontrahens_name`),
  KEY `FK__contrahens` (`modifier_users_rid`),
  KEY `FK__contrahens_1` (`_cities_rid`),
  KEY `FK__contrahens_2` (`owner_users_rid`),
  CONSTRAINT `FK__contrahens` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__contrahens_1` FOREIGN KEY (`_cities_rid`) REFERENCES `_cities` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__contrahens_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_contrahens`
--

LOCK TABLES `_contrahens` WRITE;
/*!40000 ALTER TABLE `_contrahens` DISABLE KEYS */;
INSERT INTO `_contrahens` VALUES (1,1,'Прага','Бизнес центр ПРАГА','','Киев, ул.Сосюры, 6','факс','Емельянов Анатолий Иванович','068 1983856','a.i.emelianov@example.com','Орендодатель',1,'2010-04-01 21:52:59','2010-04-01 21:53:37',1,0),(2,1,'Цифра','ТОВ Цифра','','Гринченка, 20','','Сергей','044 3333333','serge@cyfra.net','ПРовайдер интернета',1,'2010-04-01 22:24:26','2010-04-01 22:24:26',1,0),(3,11,'Алфьоров М. А. СПД','СПД Алфьоров Микита Андрійович','http://www.meta.ua','61108, м.Харків, б.Миру, б.1, кв.53','','Алфьоров Микита Андрійович','(057) 706-39-5','olga.derevyanko@meta.ua','',1,'2010-05-02 18:31:18','2010-05-02 18:31:50',1,0);
/*!40000 ALTER TABLE `_contrahens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_countries`
--

DROP TABLE IF EXISTS `_countries`;
CREATE TABLE `_countries` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(5) DEFAULT NULL,
  `country_name` varchar(65) DEFAULT NULL,
  `country_name_lat` varchar(65) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `country_code` (`country_code`),
  UNIQUE KEY `country_name` (`country_name`),
  UNIQUE KEY `country_name_lat` (`country_name_lat`),
  KEY `FK__countries` (`modifier_users_rid`),
  KEY `FK__countries1` (`owner_users_rid`),
  CONSTRAINT `FK__countries` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__countries1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_countries`
--

LOCK TABLES `_countries` WRITE;
/*!40000 ALTER TABLE `_countries` DISABLE KEYS */;
INSERT INTO `_countries` VALUES (1,'UA','Украина','Ukraine','',1,'2007-12-19 18:40:47','2010-03-22 23:50:05',1,0),(3,'EGY','Египет','Egypt',NULL,1,'2007-11-21 18:01:03','2007-11-21 18:01:03',1,0),(4,'TH','Таиланд','Thailand','',1,'2007-12-27 12:54:37','2007-12-27 12:54:37',1,0),(5,'DO','Доминиканская Республика','Dominican Republic','',1,'2007-12-27 12:55:34','2007-12-27 12:55:34',1,0),(6,'AE','ОАЭ','United Arab Emirates','',1,'2007-12-27 12:58:35','2007-12-27 12:58:35',1,0),(7,'TR','Турция','Turkey','',1,'2007-12-27 13:01:06','2007-12-27 13:01:06',1,0),(8,'CY','Кипр','Cyprus','',1,'2007-12-27 13:01:56','2007-12-27 13:01:56',1,0),(9,'JO','Иордания','Jordan','',1,'2007-12-27 13:02:46','2007-12-27 13:02:46',1,0),(10,'CU','Куба','Cuba','',1,'2007-12-27 13:03:38','2007-12-27 13:03:38',1,0),(11,'TN','Тунис','Tunisia','',1,'2007-12-27 13:04:45','2007-12-27 13:04:45',1,0),(12,'AU','Австралия','Australia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(13,'AT','Австрия','Austria',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(14,'AZ','Азербайджан','Azerbaijan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(15,'AL','Албания','Albania',NULL,1,'2008-02-06 10:38:27','2009-06-15 11:16:52',1,0),(16,'DZ','Алжир','Algeria',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(17,'AS','Американское Самоа','American Samoa',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(18,'AI','Ангилья','Anguilla',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(19,'AO','Ангола','Angola',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(20,'AD','Андорра','Andorra',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(21,'AG','Антигуа и Барбуда','Antigua And Barbuda',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(22,'AR','Аргентина','Argentina',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(23,'AM','Армения','Armenia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(24,'AW','Аруба','Aruba',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(25,'AF','Афганистан','Afghanistan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(26,'BS','Багамы','Bahamas',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(27,'BD','Бангладеш','Bangladesh',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(28,'BB','Барбадос','Barbados',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(29,'BH','Бахрейн','Bahrain',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(30,'BY','Беларусь','Belarus',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(31,'BZ','Белиз','Belize',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(32,'BE','Бельгия','Belgium',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(33,'BJ','Бенин','Benin',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(34,'BM','Бермуды','Bermuda',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(35,'BG','Болгария','Bulgaria',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(36,'BO','Боливия','Bolivia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(37,'BA','Босния и Герцеговина','Bosnia And Herzegovina',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(38,'BW','Ботсвана','Botswana',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(39,'BR','Бразилия','Brazil',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(40,'BN','Бруней-Даруссалам','Brunei Darussalam',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(41,'BF','Буркина-Фасо','Burkina Faso',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(42,'BI','Бурунди','Burundi',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(43,'BT','Бутан','Bhutan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(44,'VU','Вануату','Vanuatu',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(45,'HU','Венгрия','Hungary',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(46,'VE','Венесуэла','Venezuela',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(47,'TP','Восточный Тимор','East Timor',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(48,'VN','Вьетнам','Vietnam',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(49,'GA','Габон','Gabon',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(50,'HT','Гаити','Haiti',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(51,'GY','Гайана','Guyana',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(52,'GM','Гамбия','Gambia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(53,'GH','Гана','Ghana',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(54,'GP','Гваделупа','Guadeloupe',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(55,'GT','Гватемала','Guatemala',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(56,'GN','Гвинея','Guinea',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(57,'GW','Гвинея-Бисау','Guinea-Bissau',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(58,'DE','Германия','Germany',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(59,'GI','Гибралтар','Gibraltar',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(60,'HN','Гондурас','Honduras',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(61,'HK','Гонконг','Hong Kong',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(62,'GD','Гренада','Grenada',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(63,'GL','Гренландия','Greenland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(64,'GR','Греция','Greece',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(65,'GE','Грузия','Georgia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(66,'GU','Гуам','Guam',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(67,'DK','Дания','Denmark',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(68,'DJ','Джибути','Djibouti',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(69,'DM','Доминика','Dominica',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(70,'ZM','Замбия','Zambia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(71,'EH','Западная Сахара','Western Sahara',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(72,'ZW','Зимбабве','Zimbabwe',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(73,'IL','Израиль','Israel',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(74,'IN','Индия','India',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(75,'ID','Индонезия','Indonesia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(76,'IQ','Ирак','Iraq',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(77,'IE','Ирландия','Ireland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(78,'IS','Исландия','Iceland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(79,'ES','Испания','Spain',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(80,'IT','Италия','Italy',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(81,'YE','Йемен','Yemen',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(82,'CV','Кабо-Верде','Cape Verde',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(83,'KZ','Казахстан','Kazakhstan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(84,'KH','Камбоджа','Cambodia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(85,'CM','Камерун','Cameroon',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(86,'CA','Канада','Canada',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(87,'QA','Катар','Qatar',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(88,'KE','Кения','Kenya',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(89,'KG','Киргизия','Kyrgyzstan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(90,'KI','Кирибати','Kiribati',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(91,'CN','Китай','China',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(93,'CO','Колумбия','Colombia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(94,'KM','Коморы','Comoros',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(95,'CG','Конго','Congo',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(96,'CR','Коста-Рика','Costa Rica',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(97,'CI','Кот д&#146;Ивуар','Cote d&#146;Ivoire',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(98,'KW','Кувейт','Kuwait',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(99,'LA','Лаосс','Lao People’s Democratic Republic','',1,'2008-02-06 10:38:27','2008-02-06 10:42:59',1,0),(100,'LV','Латвия','Latvia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(101,'LS','Лесото','Lesotho',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(102,'LR','Либерия','Liberia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(103,'LB','Ливан','Lebanon',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(105,'LT','Литва','Lithuania',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(106,'LI','Лихтенштейн','Liechtenstein',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(107,'LU','Люксембург','Luxembourg',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(108,'MU','Маврикий','Mauritius',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(109,'MR','Мавритания','Mauritania',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(110,'MG','Мадагаскар','Madagascar',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(111,'MO','Макао','Macau',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(112,'MW','Малави','Malawi',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(113,'MY','Малайзия','Malaysia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(114,'ML','Мали','Mali',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(115,'MV','Мальдивы','Maldives',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(116,'MT','Мальта','Malta',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(117,'MA','Марокко','Morocco',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(118,'MQ','Мартиника','Martinique',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(119,'MH','Маршалловы Острова','Marshall Islands',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(120,'MX','Мексика','Mexico',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(121,'MZ','Мозамбик','Mozambique',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(122,'MC','Монако','Monaco',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(123,'MN','Монголия','Mongolia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(124,'MS','Монтсеррат','Montserrat',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(125,'MM','Мьянма','Myanmar',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(126,'NA','Намибия','Namibia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(127,'NR','Науру','Nauru',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(128,'NP','Непал','Nepal',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(129,'NE','Нигер','Niger',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(130,'NG','Нигерия','Nigeria',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(131,'AN','Нидерландские Антилы','Netherlands Antilles',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(132,'NL','Нидерланды','Netherlands',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(133,'NI','Никарагуа','Nicaragua',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(134,'NU','Ниуэ','Niue',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(135,'NZ','Новая Зеландия','New Zealand',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(136,'NC','Новая Каледония','New Caledonia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(137,'NO','Норвегия','Norway',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(138,'OM','Оман','Oman',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(139,'PK','Пакистан','Pakistan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(140,'PW','Палау','Palau',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(141,'PS','Палестина','Palestine',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(142,'PA','Панама','Panama',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(143,'VA','Ватикан','Vatican City State (Holy See)','',1,'2008-02-06 10:38:27','2008-02-06 10:44:49',1,0),(144,'PG','Папуа &#151; Новая Гвинея','Papua New Guinea',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(145,'PY','Парагвай','Paraguay',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(146,'PE','Перу','Peru',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(147,'PN','Питкерн','Pitcairn',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(148,'PL','Польша','Poland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(149,'PT','Португалия','Portugal',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(150,'PR','Пуэрто-Рико','Puerto Rico',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(151,'RE','Реюньон','Reunion',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(152,'RU','Россия','Russian Federation',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(153,'RW','Руанда','Rwanda',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(154,'RO','Румыния','Romania',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(155,'SV','Сальвадор','El Salvador',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(156,'WS','Самоа','Samoa',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(157,'SM','Сан-Марино','San Marino',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(158,'ST','Сан-Томе и Принсипи','Sao Tome And Principe',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(159,'SA','Саудовская Аравия','Saudi Arabia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(160,'SZ','Свазиленд','Swaziland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(161,'SH','Святая Елена','St Helena',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(162,'MP','Северные Марианские острова','Northern Mariana Islands',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(163,'RS','Сербия','Serbia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(164,'SC','Сейшелы','Seychelles',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(165,'SN','Сенегал','Senegal',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(167,'KN','Сент-Китс и Невис','Saint Kitts&mdash;Nevis',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(168,'LC','Сент-Люсия','Saint Lucia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(169,'PM','Сент-Пьер и Микелон','St Pierre And Miquelon',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(170,'SG','Сингапур','Singapore',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(171,'SY','Сирия','Syrian Arab Republic','',1,'2008-02-06 10:38:27','2008-02-06 10:45:28',1,0),(172,'SK','Словакия','Slovakia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(173,'SI','Словения','Slovenia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(174,'GB','Соединенное Королевство','United Kingdom',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(175,'US','Соединенные Штаты','United States',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(176,'SB','Соломоновы Острова','Solomon Islands',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(177,'SO','Сомали','Somalia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(178,'SD','Судан','Sudan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(179,'SR','Суринам','Suriname',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(180,'SL','Сьерра-Леоне','Sierra Leone',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(181,'TJ','Таджикистан','Tajikistan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(182,'TG','Того','Togo',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(183,'TK','Токелау','Tokelau',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(184,'TO','Тонга','Tonga',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(185,'TT','Тринидад и Тобаго','Trinidad And Tobago',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(186,'TV','Тувалу','Tuvalu',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(187,'TM','Туркмения','Turkmenistan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(188,'UG','Уганда','Uganda',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(189,'UZ','Узбекистан','Uzbekistan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(190,'UY','Уругвай','Uruguay',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(191,'FO','Фарерские острова','Faroe Islands',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(192,'FJ','Фиджи','Fiji',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(193,'PH','Филиппины','Philippines',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(194,'FI','Финляндия','Finland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(196,'FR','Франция','France',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(197,'GF','Французская Гвиана','French Guiana',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(198,'PF','Французская Полинезия','French Polynesia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(199,'HR','Хорватия','Croatia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(201,'TD','Чад','Chad',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(202,'ME','Черногория','Montenegro',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(203,'CZ','Чехия','Czech Republic',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(204,'CL','Чили','Chile',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(205,'CH','Швейцария','Switzerland',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(206,'SE','Швеция','Sweden',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(207,'SJ','Шпицберген и Ян Майен','Svalbard And Jan Mayen Islands',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(208,'LK','Шри-Ланка','Sri Lanka',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(209,'EC','Эквадор','Ecuador',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(210,'GQ','Экваториальная Гвинея','Equatorial Guinea',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(211,'ER','Эритрея','Eritrea',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(212,'EE','Эстония','Estonia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(213,'ET','Эфиопия','Ethiopia',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(214,'ZA','Южная Африка','South Africa',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(215,'JM','Ямайка','Jamaica',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(216,'JP','Япония','Japan',NULL,1,'2008-02-06 10:38:27','2008-02-06 10:38:27',1,0),(219,'UK','Великобритания','Great Britain','',1,'2008-11-03 12:01:51','2008-11-03 12:01:51',1,0);
/*!40000 ALTER TABLE `_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_curourts`
--

DROP TABLE IF EXISTS `_curourts`;
CREATE TABLE `_curourts` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_countries_rid` int(12) DEFAULT NULL,
  `curourt_name` varchar(255) DEFAULT NULL,
  `curourt_name_lat` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `_countries_rid` (`_countries_rid`,`curourt_name`),
  KEY `FK__curourts` (`modifier_users_rid`),
  KEY `FK__curourts2` (`owner_users_rid`),
  CONSTRAINT `FK__curourts` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__curourts1` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__curourts2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_curourts`
--

LOCK TABLES `_curourts` WRITE;
/*!40000 ALTER TABLE `_curourts` DISABLE KEYS */;
INSERT INTO `_curourts` VALUES (1,3,'Хургада','Hurgada','',1,'2007-11-29 19:47:11','2009-06-04 23:12:25',1,0),(2,3,'Шарм-ель-Шейх','Sharm el\' Sheih','',1,'2007-11-21 23:37:20','2009-06-23 22:52:57',1,0),(3,6,'Дубаи','Dubai','',1,'2007-12-27 14:44:10','2007-12-27 14:44:10',1,0),(4,6,'Шарджа','Shardga','',1,'2007-12-27 14:44:33','2007-12-27 14:44:33',1,0),(5,6,'Фуджейра','Fudjeira','',1,'2007-12-27 14:45:09','2007-12-27 14:45:09',1,0),(6,6,'Абу-Даби','Abu-Dabi','',1,'2007-12-27 14:45:56','2007-12-27 14:45:56',1,0),(7,6,'Аджаман','Adjaman','',1,'2007-12-27 14:48:31','2007-12-27 14:48:31',1,0),(8,7,'Улудаг','Uludag','',1,'2007-12-27 14:50:07','2010-07-18 23:23:19',1,1),(9,7,'Эрджиес','Erdgies','',1,'2007-12-27 14:52:00','2007-12-27 14:52:00',1,0),(10,7,'Саракамыш','Sarakamish','',1,'2007-12-27 14:54:30','2007-12-27 14:54:30',1,0),(13,1,'Крым','Krimea','Крымский полуостров, Украина',1,'2009-06-21 15:36:11','2009-06-21 15:36:11',1,0),(14,7,'Фетхие','Fethie','Фетхие, Турция',1,'2009-06-24 18:57:55','2009-06-24 18:57:55',1,0),(15,8,'Протарас','Protaras','',1,'2009-07-26 17:08:24','2009-07-26 17:10:42',1,0),(16,7,'Кемер','Kemer','',1,'2009-07-26 18:01:19','2009-07-26 18:01:22',1,0);
/*!40000 ALTER TABLE `_curourts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_currencies`
--

DROP TABLE IF EXISTS `_currencies`;
CREATE TABLE `_currencies` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `left_word` varchar(65) DEFAULT NULL,
  `right_word` varchar(65) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `currency_name` (`currency_name`),
  KEY `FK__currencies` (`modifier_users_rid`),
  KEY `FK__currencies1` (`owner_users_rid`),
  CONSTRAINT `FK__currencies` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__currencies1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_currencies`
--

LOCK TABLES `_currencies` WRITE;
/*!40000 ALTER TABLE `_currencies` DISABLE KEYS */;
INSERT INTO `_currencies` VALUES (1,'UAH','Украинская гривна','','грн.','',1,NULL,'2010-03-22 23:03:30',1,0),(2,'USD','Доллар США','','долл.',NULL,1,'2007-11-12 17:30:15','2007-11-12 17:30:15',1,0),(3,'RUR','Российский рубль','','руб.','',1,NULL,'2010-07-18 18:48:58',1,0),(4,'EUR','Евро','','евро','',1,NULL,'2009-06-15 11:07:22',1,0);
/*!40000 ALTER TABLE `_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_dcarts`
--

DROP TABLE IF EXISTS `_dcarts`;
CREATE TABLE `_dcarts` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `num` varchar(20) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `discount_type` varchar(20) DEFAULT 'PERCENT',
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `NewIndex1` (`num`),
  KEY `FK__dcarts_1` (`modifier_users_rid`),
  KEY `FK__dcarts_2` (`owner_users_rid`),
  CONSTRAINT `FK__dcarts_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__dcarts_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_dcarts`
--

LOCK TABLES `_dcarts` WRITE;
/*!40000 ALTER TABLE `_dcarts` DISABLE KEYS */;
INSERT INTO `_dcarts` VALUES (3,'123456','1.5','PERCENT','Тестовая карта',1,'2009-09-02 11:46:18','2010-03-23 00:00:43',1,0),(4,'456123','0.5','PERCENT','',1,'2009-09-02 13:27:59','2009-09-02 13:28:02',1,0);
/*!40000 ALTER TABLE `_dcarts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_demands_headers`
--

DROP TABLE IF EXISTS `_demands_headers`;
CREATE TABLE `_demands_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `_calls_documents_rid` int(12) DEFAULT NULL,
  `_tours_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `date_doc` timestamp NULL DEFAULT NULL,
  `agreement` varchar(255) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_tours_rid` (`_tours_rid`),
  KEY `_documents_rid` (`_documents_rid`),
  KEY `FK__demands_headers` (`modifier_users_rid`),
  KEY `FK__demands_headers6` (`_advertisessources_rid`),
  KEY `FK__demands_headers1` (`owner_users_rid`),
  KEY `FK__demands_headers7` (`_calls_documents_rid`),
  CONSTRAINT `FK__demands_headers` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_headers1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_headers2` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_headers3` FOREIGN KEY (`_tours_rid`) REFERENCES `_tours` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_headers6` FOREIGN KEY (`_advertisessources_rid`) REFERENCES `_advertisessources` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_headers7` FOREIGN KEY (`_calls_documents_rid`) REFERENCES `_documents` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_demands_headers`
--

LOCK TABLES `_demands_headers` WRITE;
/*!40000 ALTER TABLE `_demands_headers` DISABLE KEYS */;
INSERT INTO `_demands_headers` VALUES (8,14472,14471,3,125,'2010-08-14 21:00:00','14472-15/08/2010',NULL,1,'2010-08-15 10:22:34','2010-08-15 10:34:14',1,0),(9,14475,14474,4,124,'2010-08-18 21:00:00','14475-19/08/2010',NULL,1,'2010-08-19 20:15:35','2010-08-19 20:19:25',1,0),(10,14477,14476,5,125,'2010-08-19 21:00:00','14477-20/08/2010',NULL,2,'2010-08-20 07:28:42','2010-08-20 18:10:42',2,0),(11,14479,14478,6,126,'2010-08-19 21:00:00','14479-20/08/2010',NULL,2,'2010-08-20 18:20:23','2010-08-20 18:23:15',2,0);
/*!40000 ALTER TABLE `_demands_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_demands_rows`
--

DROP TABLE IF EXISTS `_demands_rows`;
CREATE TABLE `_demands_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_demands_headers_rid` int(12) DEFAULT NULL,
  `_clients_rid` int(12) DEFAULT NULL,
  `demander` tinyint(1) DEFAULT '0',
  `tourist` tinyint(1) DEFAULT '0',
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_demands_headers_rid` (`_demands_headers_rid`),
  KEY `_clients_rid` (`_clients_rid`),
  KEY `FK__demands_rows` (`modifier_users_rid`),
  KEY `FK__demands_rows3` (`owner_users_rid`),
  CONSTRAINT `FK__demands_rows` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_rows1` FOREIGN KEY (`_demands_headers_rid`) REFERENCES `_demands_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_rows2` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__demands_rows3` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_demands_rows`
--

LOCK TABLES `_demands_rows` WRITE;
/*!40000 ALTER TABLE `_demands_rows` DISABLE KEYS */;
INSERT INTO `_demands_rows` VALUES (103,8,4733,1,1,NULL,1,'2010-08-15 10:34:14',NULL,1,0),(104,8,4734,0,1,NULL,1,'2010-08-15 10:34:14',NULL,1,0),(105,8,4735,0,1,NULL,1,'2010-08-15 10:34:14',NULL,1,0),(115,9,4730,1,1,NULL,1,'2010-08-19 20:19:25',NULL,1,0),(116,9,4731,0,1,NULL,1,'2010-08-19 20:19:25',NULL,1,0),(117,9,4732,0,1,NULL,1,'2010-08-19 20:19:26',NULL,1,0),(129,10,4737,0,1,NULL,2,'2010-08-20 18:10:42',NULL,2,0),(130,10,4736,1,1,NULL,2,'2010-08-20 18:10:42',NULL,2,0),(131,10,4729,0,1,NULL,2,'2010-08-20 18:10:42',NULL,2,0),(138,11,4740,0,1,NULL,2,'2010-08-20 18:23:15',NULL,2,0),(139,11,4739,0,1,NULL,2,'2010-08-20 18:23:15',NULL,2,0),(140,11,4738,1,1,NULL,2,'2010-08-20 18:23:15',NULL,2,0);
/*!40000 ALTER TABLE `_demands_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_documents`
--

DROP TABLE IF EXISTS `_documents`;
CREATE TABLE `_documents` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `doc_type` varchar(64) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__documents_2` (`modifier_users_rid`),
  KEY `FK__documents1` (`owner_users_rid`),
  KEY `NewIndex1` (`doc_type`),
  CONSTRAINT `FK__documents1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__documents_2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14480 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_documents`
--

LOCK TABLES `_documents` WRITE;
/*!40000 ALTER TABLE `_documents` DISABLE KEYS */;
INSERT INTO `_documents` VALUES (159,'EMPTOPOSITIONS','',1,'2008-01-01 00:00:00','2009-07-29 13:06:41',1,0),(8582,'CALLS','',2,'2008-08-15 11:17:03','2010-08-15 18:48:22',1,0),(14441,'ADVERTISES','',1,'2009-06-28 19:23:54','2009-06-28 21:31:38',1,0),(14442,'ADVERTISES','',1,'2009-06-28 23:44:47','2009-06-28 23:46:04',1,0),(14446,'DEMANDS','',1,'2009-07-10 11:45:18','2009-07-11 19:03:53',1,0),(14448,'INOUT','Тестовый документ',1,'2009-07-12 10:18:44','2010-07-15 19:58:47',1,1),(14450,'ADVERTISES','Otpusk.com по Раисы Окипной',1,'2009-07-18 14:55:21','2010-07-18 16:22:08',1,1),(14451,'ADVERTISES','',1,'2009-07-18 17:27:40','2010-07-18 16:22:44',1,1),(14453,'DEMANDS','Тестовый документ',1,'2009-07-23 00:13:09','2009-08-08 19:02:43',1,0),(14455,'DEMANDS','',1,'2009-07-26 18:03:39','2009-07-26 18:05:13',1,0),(14457,'AIRCALLS','',1,'2009-09-02 16:32:31','2010-07-15 23:26:45',1,1),(14461,'EMPTOPOSITIONS','Тестовый сотрудник',1,'2009-09-28 20:16:34','2010-03-16 17:31:38',1,0),(14463,'INOUT','',1,'2010-03-31 21:30:51','2010-03-31 21:30:51',1,0),(14464,'AIRSELL','',1,'2010-04-05 13:32:37','2010-07-16 00:17:26',1,0),(14465,'EMPTOPOSITIONS','',1,'2010-04-27 23:26:12','2010-07-18 17:05:58',1,0),(14466,'ADVERTISES','Реклама на Мета',1,'2010-05-02 21:16:24','2010-05-02 21:36:29',1,0),(14467,'INOUT','На транспорт',1,'2010-07-15 19:49:51','2010-07-15 19:58:29',1,0),(14470,'CALLS','тестирование',1,'2010-08-15 13:03:39','2010-08-15 14:02:11',1,0),(14471,'CALLS','',1,'2010-08-15 13:12:18','2010-08-15 18:56:15',1,0),(14472,'DEMANDS','',1,'2010-08-15 13:22:34','2010-08-15 13:34:14',1,0),(14473,'CALLS','',1,'2010-08-15 14:28:28','2010-08-15 18:51:25',1,0),(14474,'CALLS','',1,'2010-08-19 23:11:31','2010-08-19 23:11:31',1,0),(14475,'DEMANDS','',1,'2010-08-19 23:15:35','2010-08-19 23:19:25',1,0),(14476,'CALLS','',2,'2010-08-19 23:29:55','2010-08-19 23:31:08',2,0),(14477,'DEMANDS','для тестирования',2,'2010-08-20 10:28:41','2010-08-20 21:10:42',2,0),(14478,'CALLS','',2,'2010-08-20 21:15:52','2010-08-20 21:15:57',2,0),(14479,'DEMANDS','',2,'2010-08-20 21:20:23','2010-08-20 21:23:15',2,0);
/*!40000 ALTER TABLE `_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_documents_attaches`
--

DROP TABLE IF EXISTS `_documents_attaches`;
CREATE TABLE `_documents_attaches` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(11) DEFAULT NULL,
  `_attaches_rid` int(11) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__documents_attaches0` (`_documents_rid`),
  KEY `FK__documents_attaches1` (`_attaches_rid`),
  CONSTRAINT `FK__documents_attaches0` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__documents_attaches1` FOREIGN KEY (`_attaches_rid`) REFERENCES `_attaches` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_documents_attaches`
--

LOCK TABLES `_documents_attaches` WRITE;
/*!40000 ALTER TABLE `_documents_attaches` DISABLE KEYS */;
/*!40000 ALTER TABLE `_documents_attaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_emp_to_positions_headers`
--

DROP TABLE IF EXISTS `_emp_to_positions_headers`;
CREATE TABLE `_emp_to_positions_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `date_doc` date DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_documents_rid` (`_documents_rid`),
  KEY `FK__emp_to_positions_headers2` (`modifier_users_rid`),
  KEY `FK__emp_to_positions_headers3` (`owner_users_rid`),
  KEY `NewIndex1` (`date_doc`),
  CONSTRAINT `FK__emp_to_positions_headers1` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_headers2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_headers3` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_emp_to_positions_headers`
--

LOCK TABLES `_emp_to_positions_headers` WRITE;
/*!40000 ALTER TABLE `_emp_to_positions_headers` DISABLE KEYS */;
INSERT INTO `_emp_to_positions_headers` VALUES (1,159,'2008-01-01',NULL,1,'2008-01-01 00:00:00','2009-07-29 13:06:41',1,0),(2,14461,'2009-09-28',NULL,1,'2009-09-28 20:16:34','2010-03-16 17:31:38',1,0),(3,14465,'2010-04-01',NULL,1,'2010-04-27 23:26:12','2010-07-18 17:05:58',1,0);
/*!40000 ALTER TABLE `_emp_to_positions_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_emp_to_positions_rows`
--

DROP TABLE IF EXISTS `_emp_to_positions_rows`;
CREATE TABLE `_emp_to_positions_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_emp_to_positions_headers_rid` int(12) DEFAULT NULL,
  `_employeers_rid` int(12) DEFAULT NULL,
  `_positions_rid` int(12) DEFAULT NULL,
  `_filials_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(11) DEFAULT NULL,
  `salary` float(10,2) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  `bdate` date NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `_employeers_rid` (`_employeers_rid`),
  KEY `_positions_rid` (`_positions_rid`),
  KEY `_emp_to_positions_headers_rid` (`_emp_to_positions_headers_rid`),
  KEY `FK__emp_to_positions_rows1` (`owner_users_rid`),
  KEY `FK__emp_to_positions_rows2` (`modifier_users_rid`),
  KEY `FK__emp_to_positions_rows` (`_currencies_rid`),
  CONSTRAINT `FK__emp_to_positions_rows` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_rows1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_rows2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_rows3` FOREIGN KEY (`_employeers_rid`) REFERENCES `_employeers` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_rows4` FOREIGN KEY (`_emp_to_positions_headers_rid`) REFERENCES `_emp_to_positions_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__emp_to_positions_rows5` FOREIGN KEY (`_positions_rid`) REFERENCES `_positions` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_emp_to_positions_rows`
--

LOCK TABLES `_emp_to_positions_rows` WRITE;
/*!40000 ALTER TABLE `_emp_to_positions_rows` DISABLE KEYS */;
INSERT INTO `_emp_to_positions_rows` VALUES (1,1,1,1,12,1,100.00,NULL,1,'2008-01-01 00:00:00','2009-07-29 13:06:41',1,0,'2008-01-01'),(2,2,2,2,12,1,100.00,NULL,1,'2009-09-28 20:16:34','2010-03-16 17:31:38',1,0,'2009-09-27'),(3,3,2,2,1,2,100.00,NULL,1,'2010-04-27 23:26:12','2010-07-18 17:05:58',1,0,'2010-05-01');
/*!40000 ALTER TABLE `_emp_to_positions_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_employeers`
--

DROP TABLE IF EXISTS `_employeers`;
CREATE TABLE `_employeers` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `f_name_lat` varchar(255) DEFAULT NULL,
  `s_name_lat` varchar(255) DEFAULT NULL,
  `l_name_lat` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `passp_seria` varchar(20) DEFAULT NULL,
  `passp_num` varchar(20) DEFAULT NULL,
  `nal_number` varchar(20) DEFAULT NULL,
  `fpassp_seria` varchar(20) DEFAULT NULL,
  `fpassp_num` varchar(20) DEFAULT NULL,
  `stazh` int(2) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL,
  `is_legal` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__employeers1` (`modifier_users_rid`),
  KEY `FK__employeers3` (`owner_users_rid`),
  CONSTRAINT `FK__employeers1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__employeers3` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_employeers`
--

LOCK TABLES `_employeers` WRITE;
/*!40000 ALTER TABLE `_employeers` DISABLE KEYS */;
INSERT INTO `_employeers` VALUES (1,'--','--','Admin','--','Vasilievich','--','1979-07-17','2007-11-01',NULL,'HH','000000','','','',0,'support@travelcrm.org.ua','Администратор CRM',1,'2008-01-11 18:15:18','2010-05-02 18:32:08',1,0,0),(2,'--','--','Manager','Manager',NULL,'Manager','2009-09-28','2008-09-30',NULL,'--','222222','','','',0,'','',1,'2009-09-28 20:13:36','2010-07-18 18:18:02',1,0,0);
/*!40000 ALTER TABLE `_employeers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_filials`
--

DROP TABLE IF EXISTS `_filials`;
CREATE TABLE `_filials` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_cities_rid` int(12) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `phones` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `mobile_phones` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_cities_rid` (`_cities_rid`),
  KEY `FK__filials2` (`modifier_users_rid`),
  KEY `FK__filials3` (`owner_users_rid`),
  CONSTRAINT `FK__filials1` FOREIGN KEY (`_cities_rid`) REFERENCES `_cities` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__filials2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__filials3` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_filials`
--

LOCK TABLES `_filials` WRITE;
/*!40000 ALTER TABLE `_filials` DISABLE KEYS */;
INSERT INTO `_filials` VALUES (1,1,'11','Окипная','вул. Р. Окіпної 4а','(044) 569-86-95','','095 271 32 44','kiev1@smail.ua','',1,'2007-12-24 11:31:26','2009-07-29 09:44:35',1,0),(12,1,'ЦО','Центральный офис','вул. Межигірська, 25','(044)583-00-80','(044)583-00-82','','info@smail.ua','',1,'2008-01-11 10:02:55','2009-07-29 09:44:45',1,0);
/*!40000 ALTER TABLE `_filials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_finjournal`
--

DROP TABLE IF EXISTS `_finjournal`;
CREATE TABLE `_finjournal` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `_account_states_rid` int(12) DEFAULT NULL,
  `sum_value` float(10,2) DEFAULT NULL,
  `payment_type` tinyint(1) DEFAULT '1' COMMENT 'Нал - 1, бн - 2',
  `oper_date` timestamp NULL DEFAULT NULL,
  `credit_c_type` varchar(32) DEFAULT NULL,
  `debet_c_type` varchar(32) DEFAULT NULL,
  `credit_clients_rid` int(12) DEFAULT NULL,
  `debet_clients_rid` int(12) DEFAULT NULL,
  `credit_filials_rid` int(12) DEFAULT NULL,
  `debet_filials_rid` int(12) DEFAULT NULL,
  `credit_employeers_rid` int(12) DEFAULT NULL,
  `debet_employeers_rid` int(12) DEFAULT NULL,
  `credit_touroperators_rid` int(12) DEFAULT NULL,
  `debet_touroperators_rid` int(12) DEFAULT NULL,
  `credit_contrahents_rid` int(12) DEFAULT NULL,
  `debet_contrahents_rid` int(12) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_currency_rid` (`_currencies_rid`),
  KEY `_documents_rid` (`_documents_rid`),
  KEY `FK__outgoing_incoming4` (`modifier_users_rid`),
  KEY `FK__outgoing_incoming6` (`owner_users_rid`),
  KEY `FK__finjournal3` (`_account_states_rid`),
  KEY `FK__finjournal_7` (`credit_clients_rid`),
  KEY `FK__finjournal_8` (`debet_clients_rid`),
  KEY `FK__finjournal_9` (`credit_filials_rid`),
  KEY `FK__finjournal_10` (`debet_filials_rid`),
  KEY `FK__finjournal11` (`credit_employeers_rid`),
  KEY `FK__finjournal12` (`debet_employeers_rid`),
  KEY `FK__finjournal13` (`credit_touroperators_rid`),
  KEY `FK__finjournal14` (`debet_touroperators_rid`),
  KEY `FK__finjournal_15` (`credit_contrahents_rid`),
  KEY `FK__finjournal_16` (`debet_contrahents_rid`),
  CONSTRAINT `FK__finjournal11` FOREIGN KEY (`credit_employeers_rid`) REFERENCES `_employeers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal12` FOREIGN KEY (`debet_employeers_rid`) REFERENCES `_employeers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal13` FOREIGN KEY (`credit_touroperators_rid`) REFERENCES `_touroperators` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal14` FOREIGN KEY (`debet_touroperators_rid`) REFERENCES `_touroperators` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal3` FOREIGN KEY (`_account_states_rid`) REFERENCES `_account_states` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal_10` FOREIGN KEY (`debet_filials_rid`) REFERENCES `_filials` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal_15` FOREIGN KEY (`credit_contrahents_rid`) REFERENCES `_contrahens` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal_16` FOREIGN KEY (`debet_contrahents_rid`) REFERENCES `_contrahens` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal_7` FOREIGN KEY (`credit_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal_8` FOREIGN KEY (`debet_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__finjournal_9` FOREIGN KEY (`credit_filials_rid`) REFERENCES `_filials` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__outgoing_incoming1` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__outgoing_incoming2` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__outgoing_incoming4` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__outgoing_incoming6` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3533 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_finjournal`
--

LOCK TABLES `_finjournal` WRITE;
/*!40000 ALTER TABLE `_finjournal` DISABLE KEYS */;
INSERT INTO `_finjournal` VALUES (3506,14441,1,3,759.21,2,'2009-06-27 21:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2009-06-28 18:09:50','2009-06-28 18:11:18',1,0),(3507,14442,1,3,280.00,2,'2009-06-29 21:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2009-06-28 20:45:55','2009-06-28 20:45:55',1,0),(3512,14451,1,3,466.00,2,'2009-07-17 21:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2009-07-24 07:10:16','2009-07-24 07:10:16',1,0),(3516,14455,1,4,8231.05,2,'2009-07-26 21:00:00','CLIENT','FILIAL',4720,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2009-07-26 15:05:07','2009-08-08 10:22:37',1,0),(3519,14453,1,4,2000.00,1,'2009-07-31 21:00:00','CLIENT','FILIAL',4726,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2009-08-08 16:02:37','2009-08-08 16:02:37',1,0),(3522,14448,1,12,160.00,2,'2010-02-14 22:00:00','FILIAL','CONTRAHENT',NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,2,'Оплата за интернет',1,'2010-04-01 22:46:32','2010-04-01 22:46:32',1,0),(3523,14466,1,3,300.00,2,'2010-04-19 21:00:00','FILIAL','CONTRAHENT',NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,3,'Размещение информации в разделе Метамаркет  \nРахунок-фактура № A-20.04-3 від 20.04.2010',1,'2010-05-02 18:35:25','2010-05-02 18:35:49',1,0),(3524,14467,1,2,1240.00,1,'2010-07-14 21:00:00','FILIAL','CONTRAHENT',NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,1,'',1,'2010-07-15 16:52:16','2010-07-15 16:52:23',1,0),(3525,14467,1,12,160.00,2,'2010-06-30 21:00:00','FILIAL','CONTRAHENT',NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,3,'',1,'2010-07-15 16:58:10','2010-07-15 16:58:10',1,0),(3526,14472,1,4,5968.29,2,'2010-08-14 21:00:00','CLIENT','FILIAL',4733,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,'',1,'2010-08-15 10:26:55','2010-08-15 10:26:55',1,0),(3527,14472,1,20,5127.00,2,'2010-08-14 21:00:00','FILIAL','TOUROPERATOR',NULL,NULL,12,NULL,NULL,NULL,NULL,40,NULL,NULL,'',1,'2010-08-15 10:34:03','2010-08-15 10:34:03',1,0),(3528,14475,1,4,7400.00,1,'2010-08-18 21:00:00','CLIENT','FILIAL',4730,NULL,NULL,12,NULL,NULL,NULL,NULL,NULL,NULL,'предоплата 50%',1,'2010-08-19 20:18:19','2010-08-19 20:18:19',1,0),(3529,14475,1,20,13540.00,2,'2010-08-19 21:00:00','FILIAL','TOUROPERATOR',NULL,NULL,12,NULL,NULL,NULL,NULL,45,NULL,NULL,'',1,'2010-08-19 20:19:06','2010-08-19 20:19:06',1,0),(3530,14477,1,4,7000.00,1,'2010-08-19 21:00:00','CLIENT','FILIAL',4736,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'',2,'2010-08-20 18:07:09','2010-08-20 18:07:09',2,0),(3531,14479,1,5,22238.44,2,'2010-08-19 21:00:00','CLIENT','FILIAL',4738,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,'',2,'2010-08-20 18:22:13','2010-08-20 18:22:31',2,1),(3532,14479,1,20,20563.00,2,'2010-08-19 21:00:00','FILIAL','TOUROPERATOR',NULL,NULL,1,NULL,NULL,NULL,NULL,40,NULL,NULL,'',2,'2010-08-20 20:03:36','2010-08-20 20:03:36',2,0);
/*!40000 ALTER TABLE `_finjournal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_food`
--

DROP TABLE IF EXISTS `_food`;
CREATE TABLE `_food` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `food_name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__food1` (`modifier_users_rid`),
  KEY `FK__food2` (`owner_users_rid`),
  CONSTRAINT `FK__food1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__food2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_food`
--

LOCK TABLES `_food` WRITE;
/*!40000 ALTER TABLE `_food` DISABLE KEYS */;
INSERT INTO `_food` VALUES (1,'No','без харчування','',1,'2007-11-29 19:55:51','2009-06-15 11:26:27',1,0),(2,'BB','снiданки','',1,'2008-01-18 17:50:06','2008-01-18 17:50:06',1,0),(3,'НВ','сніданок + вечеря ','',1,'2008-01-21 13:23:11','2008-01-21 13:23:11',1,0),(4,'ALL','\"все включено\"','',1,'2008-01-21 13:23:30','2008-01-21 13:24:18',1,0),(5,'ULTRA ALL','\"ультра все включено\"','',1,'2008-01-21 13:24:10','2008-01-21 13:24:10',1,0),(6,'FB','тричі на день','',1,'2008-01-21 13:26:32','2008-01-21 13:26:32',1,0),(7,'FBT','триразове + лікування','',1,'2008-01-21 13:27:10','2008-01-21 13:27:10',1,0),(8,'BBT','сніданки + лікування','',1,'2008-01-21 13:28:03','2008-01-21 13:28:03',1,0),(9,'HBT','сніданок+вечеря + лікування','',1,'2008-01-21 13:28:33','2008-01-21 13:28:33',1,0);
/*!40000 ALTER TABLE `_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_hotels`
--

DROP TABLE IF EXISTS `_hotels`;
CREATE TABLE `_hotels` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_countries_rid` int(12) DEFAULT NULL,
  `_curourts_rid` int(12) DEFAULT NULL,
  `_hotelscats_rid` int(12) DEFAULT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__hotels_1` (`_hotelscats_rid`),
  KEY `FK__hotels_2` (`_countries_rid`),
  KEY `FK__hotels_3` (`_curourts_rid`),
  KEY `FK__hotels_4` (`modifier_users_rid`),
  KEY `FK__hotels_5` (`owner_users_rid`),
  CONSTRAINT `FK__hotels_1` FOREIGN KEY (`_hotelscats_rid`) REFERENCES `_hotelscats` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__hotels_2` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__hotels_3` FOREIGN KEY (`_curourts_rid`) REFERENCES `_curourts` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__hotels_4` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__hotels_5` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_hotels`
--

LOCK TABLES `_hotels` WRITE;
/*!40000 ALTER TABLE `_hotels` DISABLE KEYS */;
INSERT INTO `_hotels` VALUES (1,3,1,4,'Pharao Hotel Al Mashrabia Hurghada','',1,'2009-09-02 23:35:55','2010-04-07 00:05:10',1,0),(5,3,2,3,'Blue Reef Naama Bay','',1,'2009-09-02 23:54:20','2009-09-05 20:02:17',1,0),(6,3,2,3,'Aida','для теста',1,'2009-09-05 20:26:10','2009-09-05 20:27:16',1,0),(7,7,14,5,'Alinn Sarigerme Boutique Hotel','',1,'2010-08-10 23:37:26','2010-08-10 23:37:29',1,0);
/*!40000 ALTER TABLE `_hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_hotels_attaches`
--

DROP TABLE IF EXISTS `_hotels_attaches`;
CREATE TABLE `_hotels_attaches` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_hotels_rid` int(12) DEFAULT NULL,
  `_attaches_rid` int(12) DEFAULT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__hotels_attaches_1` (`_hotels_rid`),
  KEY `FK__hotels_attaches_2` (`_attaches_rid`),
  CONSTRAINT `FK__hotels_attaches_1` FOREIGN KEY (`_hotels_rid`) REFERENCES `_hotels` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__hotels_attaches_2` FOREIGN KEY (`_attaches_rid`) REFERENCES `_attaches` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_hotels_attaches`
--

LOCK TABLES `_hotels_attaches` WRITE;
/*!40000 ALTER TABLE `_hotels_attaches` DISABLE KEYS */;
INSERT INTO `_hotels_attaches` VALUES (15,6,17),(16,1,18),(17,1,19),(18,1,20),(19,1,21);
/*!40000 ALTER TABLE `_hotels_attaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_hotelscats`
--

DROP TABLE IF EXISTS `_hotelscats`;
CREATE TABLE `_hotelscats` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `hotelcat_name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__hotelscats1` (`modifier_users_rid`),
  KEY `FK__hotelscats2` (`owner_users_rid`),
  CONSTRAINT `FK__hotelscats1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__hotelscats2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_hotelscats`
--

LOCK TABLES `_hotelscats` WRITE;
/*!40000 ALTER TABLE `_hotelscats` DISABLE KEYS */;
INSERT INTO `_hotelscats` VALUES (1,'00001','1*','',1,'2007-11-21 17:04:42','2010-03-23 00:09:48',1,0),(2,'00002','2*',NULL,1,'2007-11-21 17:05:08','2007-11-21 17:05:08',1,0),(3,'00003','3*',NULL,1,'2007-11-21 17:05:32','2007-11-21 17:05:32',1,0),(4,'00004','4*',NULL,1,'2007-11-21 17:05:49','2007-11-21 17:05:49',1,0),(5,'00005','5*',NULL,1,'2007-11-21 17:06:11','2007-11-21 17:06:11',1,0),(6,'00006','HV-1','',1,'2007-11-21 17:06:32','2010-07-19 00:18:11',1,0);
/*!40000 ALTER TABLE `_hotelscats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_hotelssynonims`
--

DROP TABLE IF EXISTS `_hotelssynonims`;
CREATE TABLE `_hotelssynonims` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_hotels_rid` int(12) DEFAULT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__hotelssynonims_1` (`_hotels_rid`),
  KEY `FK__hotelssynonims_2` (`modifier_users_rid`),
  KEY `FK__hotelssynonims_3` (`owner_users_rid`),
  CONSTRAINT `FK__hotelssynonims_1` FOREIGN KEY (`_hotels_rid`) REFERENCES `_hotels` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__hotelssynonims_2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__hotelssynonims_3` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_hotelssynonims`
--

LOCK TABLES `_hotelssynonims` WRITE;
/*!40000 ALTER TABLE `_hotelssynonims` DISABLE KEYS */;
INSERT INTO `_hotelssynonims` VALUES (9,1,'ап авпрапра рап','0',1,'2009-09-05 17:00:14','2009-09-05 17:00:14',1,0),(10,1,'ап авпрапра рап апра','0',1,'2009-09-05 17:00:18','2009-09-05 17:00:18',1,0);
/*!40000 ALTER TABLE `_hotelssynonims` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_inout_headers`
--

DROP TABLE IF EXISTS `_inout_headers`;
CREATE TABLE `_inout_headers` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_documents_rid` int(12) DEFAULT NULL,
  `date_doc` timestamp NULL DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT NULL,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `FK__inout_headers_1` (`modifier_users_rid`),
  KEY `FK__inout_headers_2` (`owner_users_rid`),
  KEY `FK__inout_headers_3` (`_documents_rid`),
  CONSTRAINT `FK__inout_headers_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__inout_headers_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__inout_headers_3` FOREIGN KEY (`_documents_rid`) REFERENCES `_documents` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_inout_headers`
--

LOCK TABLES `_inout_headers` WRITE;
/*!40000 ALTER TABLE `_inout_headers` DISABLE KEYS */;
INSERT INTO `_inout_headers` VALUES (2,14448,'2009-07-11 21:00:00',NULL,1,'2009-07-12 07:18:44','2010-07-15 16:58:47',1,0),(3,14463,'2010-03-30 21:00:00',NULL,1,'2010-03-31 18:30:51','2010-03-31 18:30:51',1,0),(4,14467,'2010-07-14 21:00:00',NULL,1,'2010-07-15 16:49:51','2010-07-15 16:58:29',1,0);
/*!40000 ALTER TABLE `_inout_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_interests`
--

DROP TABLE IF EXISTS `_interests`;
CREATE TABLE `_interests` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `interests_name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__interests_1` (`modifier_users_rid`),
  KEY `FK__interests_2` (`owner_users_rid`),
  CONSTRAINT `FK__interests_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK__interests_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_interests`
--

LOCK TABLES `_interests` WRITE;
/*!40000 ALTER TABLE `_interests` DISABLE KEYS */;
INSERT INTO `_interests` VALUES (1,'Природа','джунгли, горы, водопады, пещеры, флора, фауна',1,'2010-08-15 21:30:42','2010-08-15 21:50:28',1,1),(2,'Достопримечательности','архитектура, музеи, памятники, старинные замки',1,'2010-08-15 21:31:38','2010-08-15 21:50:37',1,1),(3,'Зрелища','театры, шоу, карнавалы, коррида, спортивные состязания',1,'2010-08-15 21:47:49','2010-08-15 21:51:20',1,1),(4,'Тусовка','дискотеки, бары',1,'2010-08-15 21:48:08','2010-08-15 21:51:40',1,1),(5,'Активные развлечения','аквапарки, аттракционы, рафтинг,\nдайвинг с инструктором',1,'2010-08-15 21:48:31','2010-08-15 21:51:52',1,1),(6,'Кулинария','рестораны, винодельни, сыроварни',1,'2010-08-15 21:48:57','2010-08-15 21:52:02',1,1),(7,'Шопинг','бутики, торговые центры, антиквариат, развалы',1,'2010-08-15 21:49:18','2010-08-15 21:52:13',1,1),(8,'Иной образ жизни','племена, монастыри',1,'2010-08-15 21:49:34','2010-08-15 21:52:21',1,1),(9,'Спортивный отдых','сплав, альпинизм, треккинг, горные лыжи, рыбалка, охота',1,'2010-08-15 21:49:53','2010-08-15 21:52:31',1,1),(10,'Пассивный отдых','пляж, бассейн, прогулки',1,'2010-08-15 21:50:13','2010-08-15 21:52:51',1,1);
/*!40000 ALTER TABLE `_interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_modules`
--

DROP TABLE IF EXISTS `_modules`;
CREATE TABLE `_modules` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) DEFAULT NULL,
  `module_controller` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `item_name` (`module_name`,`module_controller`),
  KEY `FK__menu_items1` (`modifier_users_rid`),
  KEY `FK__menu_items2` (`owner_users_rid`),
  CONSTRAINT `FK__modules_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__modules_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_modules`
--

LOCK TABLES `_modules` WRITE;
/*!40000 ALTER TABLE `_modules` DISABLE KEYS */;
INSERT INTO `_modules` VALUES (1,'Статьи оплат','accountstates','Статьи оплат (доходов и затрат)',1,'2009-08-23 16:38:05','2010-04-29 21:16:42',1,0),(2,'Рекламные площадки','advertises','Управление рекламными площадями и затратами по рекламе',1,'2009-08-23 16:40:04','2009-08-23 22:02:40',1,0),(3,'Рекламные кампании','advertisescompanies','Управление рекламными кампаниями',1,'2009-08-23 16:40:29','2010-04-29 21:09:05',1,0),(4,'Рекламные носители','advertisessources','Справочник рекламных носителей',1,'2009-08-23 16:41:17','2010-05-06 14:46:50',1,0),(5,'Типы рекламных носителей','advertisestypes','Справочник типов рекламных носителей',1,'2009-08-23 16:41:59','2009-08-23 22:03:40',1,0),(6,'Контакты авиа','aircalls','Регистрация контактов для подсистемы авиа',1,'2009-08-23 16:42:56','2009-08-23 22:03:57',1,0),(7,'Авиакомпании','aircompanies','Справочник авиакомпаний',1,'2009-08-23 16:46:19','2009-08-23 22:04:19',1,0),(8,'Продажа авиабилетов','airsell','Документ продажи авиабилетов',1,'2009-08-23 16:47:09','2010-04-29 21:10:35',1,0),(9,'Контакты туров','calls','Документ регистрации контактов туров',1,'2009-08-23 16:47:46','2010-04-29 21:17:36',1,0),(10,'Корпоративный чат','chat','Корпоративный чат',1,'2009-08-23 16:48:58','2009-08-23 22:05:16',1,0),(11,'Города','cities','Справочник городов',1,'2009-08-23 16:49:34','2010-05-07 07:54:41',1,0),(12,'Клиенты','clients','Справочник клиентов',1,'2009-08-23 16:49:54','2010-04-29 19:21:38',1,0),(13,'Константы','constants','Справочник констант',1,'2009-08-23 16:50:25','2009-08-24 18:43:17',1,0),(14,'Страны','countries','Справочник стран',1,'2009-08-23 16:50:48','2009-08-23 22:06:29',1,0),(15,'Курорты','curourts','Справочник курортов',1,'2009-08-23 16:51:17','2010-05-07 08:27:24',1,0),(16,'Валюты','currencies','Справочник валют',1,'2009-08-23 16:52:12','2009-08-23 22:07:08',1,0),(17,'Продажа туров','demands','Документ продажи туров',1,'2009-08-23 16:52:43','2010-08-19 20:32:49',1,0),(18,'Сотрудники','employeers','Справочник сотрудников',1,'2009-08-23 16:53:10','2009-08-23 22:07:49',1,0),(19,'Назначения сотрудников','emptopositions','Документ назначения сотрудников',1,'2009-08-23 16:53:44','2009-08-23 22:08:07',1,0),(20,'Филиалы','filials','Справочник филиалов',1,'2009-08-23 16:54:27','2010-08-20 07:53:19',1,0),(21,'Журнал фин. операций','finjournal','Журнал финансовых операций',1,'2009-08-23 16:55:01','2010-08-20 18:05:01',1,0),(22,'Типы питания','food','Справочник типов питания',1,'2009-08-23 16:55:42','2009-08-23 22:12:57',1,0),(23,'Категории отелей','hotelscats','Справочник категорий отелей',1,'2009-08-23 16:56:13','2009-08-23 22:12:32',1,0),(24,'Доходы-затраты','inout','Документ регистрации финансовых операций по статьям',1,'2009-08-23 16:56:58','2009-08-23 22:12:14',1,0),(25,'Модули','modules','Модули системы',1,'2009-08-23 16:57:39','2009-08-23 22:11:47',1,0),(26,'Должности','positions','Справочник должностей',1,'2009-08-23 16:58:05','2009-08-23 22:11:24',1,0),(27,'Меню должностей','positionsmenu','Справочник меню для должностей',1,'2009-08-23 16:58:44','2009-08-23 22:11:04',1,0),(28,'Отчет, активность рекламы','r_advactivity','Отчет по активности рекламных носителей',1,'2009-08-23 16:59:30','2009-08-23 22:10:41',1,0),(29,'Отчет, эффективность рекламы','r_adveffectivity','Отчет по эффективности рекламных носителей',1,'2009-08-23 17:00:05','2009-08-23 22:10:25',1,0),(30,'Отчет, продажы','r_sales','Отчет по продажам',1,'2009-08-23 17:00:45','2010-08-20 19:48:09',1,0),(31,'Отчет, продажи по туроператорам','r_touroperators','Отчет по продажам в разрезе туроператоров',1,'2009-08-23 17:01:25','2010-08-20 19:48:33',1,0),(32,'Типы номеров','rooms','Справочник типов номеров',1,'2009-08-23 17:02:09','2009-08-23 22:09:33',1,0),(33,'Задачи','tasks','Модуль задач',1,'2009-08-23 17:02:36','2009-08-23 22:09:14',1,0),(34,'Туроператоры','touroperators','Справочник туроператоров',1,'2009-08-23 17:02:59','2010-08-19 20:35:33',1,0),(35,'Пользователи','users','Справочник пользователей',1,'2009-08-23 17:03:24','2009-08-23 19:04:47',1,0),(36,'Дисконтные карты','dcarts','Управление дисконтными картами',1,'2009-08-30 13:29:39','2010-05-07 07:55:34',1,0),(37,'База отелей','hotels','Справочник гостиниц',1,'2009-09-02 14:45:54','2010-04-29 21:27:50',1,0),(38,'Контрагенты','contrahens','Справочник прочих контрагентов',1,'2010-04-01 21:13:00','2010-04-01 21:13:24',1,0),(39,'Интересы клиентов','interests','Справочник интересов клиентов.',1,'2010-08-15 18:07:34','2010-08-15 18:11:47',1,0);
/*!40000 ALTER TABLE `_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_modules_permissions`
--

DROP TABLE IF EXISTS `_modules_permissions`;
CREATE TABLE `_modules_permissions` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_modules_rid` int(12) DEFAULT NULL,
  `_positions_rid` int(12) DEFAULT NULL,
  `add_allow` tinyint(1) DEFAULT '0',
  `edit_allow` tinyint(1) DEFAULT '0',
  `details_allow` tinyint(1) DEFAULT '0',
  `delete_allow` tinyint(1) DEFAULT '0',
  `move_allow` tinyint(1) DEFAULT '0',
  `archive_allow` tinyint(1) DEFAULT '0',
  `viewed_space` varchar(10) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__modules_permissions_1` (`modifier_users_rid`),
  KEY `FK__modules_permissions_2` (`owner_users_rid`),
  KEY `FK__modules_permissions_3` (`_modules_rid`),
  KEY `FK__modules_permissions_4` (`_positions_rid`),
  CONSTRAINT `FK__modules_permissions_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__modules_permissions_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__modules_permissions_3` FOREIGN KEY (`_modules_rid`) REFERENCES `_modules` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__modules_permissions_4` FOREIGN KEY (`_positions_rid`) REFERENCES `_positions` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=520 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_modules_permissions`
--

LOCK TABLES `_modules_permissions` WRITE;
/*!40000 ALTER TABLE `_modules_permissions` DISABLE KEYS */;
INSERT INTO `_modules_permissions` VALUES (11,35,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 19:04:47',NULL,NULL,0),(14,35,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 19:04:47',NULL,NULL,0),(15,35,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 19:04:47',NULL,NULL,0),(59,2,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:02:40',NULL,NULL,0),(62,2,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:02:40',NULL,NULL,0),(63,2,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:02:40',NULL,NULL,0),(83,5,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:03:40',NULL,NULL,0),(86,5,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:03:40',NULL,NULL,0),(87,5,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:03:40',NULL,NULL,0),(91,6,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:03:57',NULL,NULL,0),(94,6,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:03:57',NULL,NULL,0),(95,6,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:03:57',NULL,NULL,0),(99,7,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:04:19',NULL,NULL,0),(102,7,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:04:19',NULL,NULL,0),(103,7,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:04:19',NULL,NULL,0),(123,10,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:05:16',NULL,NULL,0),(126,10,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:05:16',NULL,NULL,0),(127,10,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:05:16',NULL,NULL,0),(155,14,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:06:29',NULL,NULL,0),(158,14,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:06:29',NULL,NULL,0),(159,14,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:06:29',NULL,NULL,0),(171,16,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:07:08',NULL,NULL,0),(174,16,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:07:08',NULL,NULL,0),(175,16,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:07:08',NULL,NULL,0),(187,18,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:07:49',NULL,NULL,0),(190,18,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:07:49',NULL,NULL,0),(191,18,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:07:49',NULL,NULL,0),(195,19,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:08:07',NULL,NULL,0),(198,19,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:08:07',NULL,NULL,0),(199,19,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:08:07',NULL,NULL,0),(219,33,1,1,1,1,1,1,1,'OWN',NULL,NULL,'2009-08-23 22:09:14',NULL,NULL,0),(222,33,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:09:14',NULL,NULL,0),(223,33,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:09:14',NULL,NULL,0),(227,32,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:09:33',NULL,NULL,0),(230,32,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:09:33',NULL,NULL,0),(231,32,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:09:33',NULL,NULL,0),(251,29,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:10:25',NULL,NULL,0),(254,29,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:10:25',NULL,NULL,0),(255,29,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:10:25',NULL,NULL,0),(259,28,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:10:41',NULL,NULL,0),(262,28,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:10:41',NULL,NULL,0),(263,28,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:10:41',NULL,NULL,0),(267,27,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:11:04',NULL,NULL,0),(270,27,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:11:04',NULL,NULL,0),(271,27,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:11:04',NULL,NULL,0),(275,26,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:11:24',NULL,NULL,0),(278,26,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:11:24',NULL,NULL,0),(279,26,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:11:24',NULL,NULL,0),(283,25,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:11:47',NULL,NULL,0),(286,25,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:11:47',NULL,NULL,0),(287,25,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:11:47',NULL,NULL,0),(291,24,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:12:14',NULL,NULL,0),(294,24,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:12:14',NULL,NULL,0),(295,24,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:12:14',NULL,NULL,0),(299,23,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:12:32',NULL,NULL,0),(302,23,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:12:32',NULL,NULL,0),(303,23,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:12:32',NULL,NULL,0),(307,22,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-23 22:12:57',NULL,NULL,0),(310,22,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:12:57',NULL,NULL,0),(311,22,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-23 22:12:57',NULL,NULL,0),(387,13,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2009-08-24 18:43:17',NULL,NULL,0),(390,13,3,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-24 18:43:17',NULL,NULL,0),(391,13,2,0,0,0,0,0,0,NULL,NULL,NULL,'2009-08-24 18:43:17',NULL,NULL,0),(427,38,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-01 21:13:24',NULL,NULL,0),(428,38,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-01 21:13:24',NULL,NULL,0),(429,38,2,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-01 21:13:24',NULL,NULL,0),(445,12,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-29 19:21:38',NULL,NULL,0),(446,12,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 19:21:39',NULL,NULL,0),(447,12,2,1,1,1,1,0,0,'FILIAL',NULL,NULL,'2010-04-29 19:21:39',NULL,NULL,0),(457,3,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-29 21:09:05',NULL,NULL,0),(458,3,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:09:05',NULL,NULL,0),(459,3,2,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:09:05',NULL,NULL,0),(460,8,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-29 21:10:35',NULL,NULL,0),(461,8,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:10:35',NULL,NULL,0),(462,8,2,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:10:35',NULL,NULL,0),(463,1,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-29 21:16:42',NULL,NULL,0),(464,1,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:16:42',NULL,NULL,0),(465,1,2,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:16:42',NULL,NULL,0),(469,9,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-29 21:17:36',NULL,NULL,0),(470,9,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:17:36',NULL,NULL,0),(471,9,2,1,1,1,1,0,0,'OWN',NULL,NULL,'2010-04-29 21:17:36',NULL,NULL,0),(475,37,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-04-29 21:27:50',NULL,NULL,0),(476,37,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-04-29 21:27:50',NULL,NULL,0),(477,37,2,0,0,1,0,0,0,'ALL',NULL,NULL,'2010-04-29 21:27:50',NULL,NULL,0),(478,4,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-05-06 14:46:50',NULL,NULL,0),(479,4,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-05-06 14:46:50',NULL,NULL,0),(480,4,2,0,0,1,0,0,0,'ALL',NULL,NULL,'2010-05-06 14:46:50',NULL,NULL,0),(481,11,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-05-07 07:54:41',NULL,NULL,0),(482,11,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-05-07 07:54:41',NULL,NULL,0),(483,11,2,1,1,1,1,0,0,'ALL',NULL,NULL,'2010-05-07 07:54:41',NULL,NULL,0),(484,36,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-05-07 07:55:34',NULL,NULL,0),(485,36,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-05-07 07:55:34',NULL,NULL,0),(486,36,2,0,0,1,0,0,0,'ALL',NULL,NULL,'2010-05-07 07:55:34',NULL,NULL,0),(487,15,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-05-07 08:27:24',NULL,NULL,0),(488,15,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-05-07 08:27:24',NULL,NULL,0),(489,15,2,1,1,1,1,0,0,'ALL',NULL,NULL,'2010-05-07 08:27:24',NULL,NULL,0),(499,39,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-15 18:11:47',NULL,NULL,0),(500,39,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-15 18:11:47',NULL,NULL,0),(501,39,2,0,0,1,0,0,0,'ALL',NULL,NULL,'2010-08-15 18:11:47',NULL,NULL,0),(502,17,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-19 20:32:49',NULL,NULL,0),(503,17,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-19 20:32:49',NULL,NULL,0),(504,17,2,1,1,1,1,1,1,'FILIAL',NULL,NULL,'2010-08-19 20:32:49',NULL,NULL,0),(505,34,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-19 20:35:33',NULL,NULL,0),(506,34,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-19 20:35:33',NULL,NULL,0),(507,34,2,0,0,1,0,0,0,'ALL',NULL,NULL,'2010-08-19 20:35:33',NULL,NULL,0),(508,20,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-20 07:53:19',NULL,NULL,0),(509,20,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-20 07:53:19',NULL,NULL,0),(510,20,2,0,0,1,0,0,0,'ALL',NULL,NULL,'2010-08-20 07:53:19',NULL,NULL,0),(511,21,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-20 18:05:01',NULL,NULL,0),(512,21,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-20 18:05:01',NULL,NULL,0),(513,21,2,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-20 18:05:01',NULL,NULL,0),(514,30,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-20 19:48:09',NULL,NULL,0),(515,30,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-20 19:48:09',NULL,NULL,0),(516,30,2,1,0,0,0,0,0,'OWN',NULL,NULL,'2010-08-20 19:48:09',NULL,NULL,0),(517,31,1,1,1,1,1,1,1,'ALL',NULL,NULL,'2010-08-20 19:48:33',NULL,NULL,0),(518,31,3,0,0,0,0,0,0,NULL,NULL,NULL,'2010-08-20 19:48:33',NULL,NULL,0),(519,31,2,1,0,0,0,0,0,'OWN',NULL,NULL,'2010-08-20 19:48:33',NULL,NULL,0);
/*!40000 ALTER TABLE `_modules_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_positions`
--

DROP TABLE IF EXISTS `_positions`;
CREATE TABLE `_positions` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `name` (`name`),
  KEY `FK__positions1` (`modifier_users_rid`),
  KEY `FK__positions2` (`owner_users_rid`),
  CONSTRAINT `FK__positions1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__positions2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_positions`
--

LOCK TABLES `_positions` WRITE;
/*!40000 ALTER TABLE `_positions` DISABLE KEYS */;
INSERT INTO `_positions` VALUES (1,'Администратор','',1,'2007-11-13 16:02:28','2010-03-31 22:05:30',1,0),(2,'Менеджер по туризму','Тестирование',1,'2008-01-04 14:20:25','2010-07-18 17:00:43',1,0),(3,'Маркетолог','',1,'2008-01-04 14:20:01','2008-01-04 14:20:01',1,0);
/*!40000 ALTER TABLE `_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_positions_menus`
--

DROP TABLE IF EXISTS `_positions_menus`;
CREATE TABLE `_positions_menus` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_positions_rid` int(12) DEFAULT NULL,
  `_modules_rid` int(12) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `parent` int(12) DEFAULT NULL,
  `item_order` int(11) DEFAULT '0',
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` datetime DEFAULT NULL,
  `modifyDT` datetime DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `p1` (`_positions_rid`,`_modules_rid`),
  KEY `_positions_rid` (`_positions_rid`),
  KEY `FK__positions_menus3` (`modifier_users_rid`),
  KEY `FK__positions_menus1` (`owner_users_rid`),
  KEY `FK__positions_menus_4` (`_modules_rid`),
  CONSTRAINT `FK__positions_menus1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__positions_menus2` FOREIGN KEY (`_positions_rid`) REFERENCES `_positions` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__positions_menus3` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__positions_menus_4` FOREIGN KEY (`_modules_rid`) REFERENCES `_modules` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_positions_menus`
--

LOCK TABLES `_positions_menus` WRITE;
/*!40000 ALTER TABLE `_positions_menus` DISABLE KEYS */;
INSERT INTO `_positions_menus` VALUES (1,1,NULL,'Работа с клиентами',0,0,'',1,'2007-11-28 17:01:32','2010-03-03 21:46:51',1,0),(2,1,NULL,'Справочники',0,0,'Тестирование',1,'2007-12-11 10:31:51','2009-08-24 12:07:09',1,0),(3,1,NULL,'Отчеты',0,0,'',1,'2007-12-08 18:46:08','2009-08-24 12:07:37',1,0),(4,1,16,'Валюты',2,0,'',1,'2007-12-08 18:51:59','2009-08-24 12:08:00',1,0),(6,1,12,'Клиенты',2,0,'',1,'2007-11-13 18:58:09','2009-08-24 12:08:16',1,0),(10,1,NULL,'Администрирование',0,0,'',1,'2007-12-08 19:01:42','2009-08-24 12:09:11',1,0),(12,1,27,'Меню должностей',10,0,'',1,'2007-12-08 18:53:30','2009-08-24 12:10:24',1,0),(13,1,NULL,'География',2,0,'',1,'2007-12-08 19:00:43','2009-08-24 12:10:43',1,0),(14,1,14,'Страны',13,0,'',1,'2007-12-08 19:01:17','2009-08-24 12:11:07',1,0),(15,1,11,'Города',13,0,'',1,'2007-12-08 19:01:26','2009-08-24 12:11:27',1,0),(16,1,NULL,'Сотрудники',0,0,'Test',1,'2007-11-29 15:07:34','2009-08-24 12:11:52',1,0),(17,1,18,'Сотрудники',16,0,'Справочник сотрудников',1,'2007-12-10 18:21:22','2009-08-24 12:12:17',1,0),(18,1,26,'Должности',16,0,'',1,'2007-12-08 19:01:01','2009-08-24 12:12:42',1,0),(19,1,20,'Филиалы',2,0,'',1,'2007-12-08 19:00:47','2010-03-31 12:24:28',1,0),(21,1,9,'Контакты туров',1,0,'',1,'2007-11-15 11:30:26','2009-08-24 12:13:33',1,0),(22,1,17,'Продажа туров',1,0,'',1,'2007-11-15 11:40:16','2009-08-24 12:13:57',1,0),(25,1,NULL,'Реклама',0,0,'',1,'2007-11-15 17:43:11','2009-08-24 12:14:11',1,0),(26,1,2,'Рекламные площадки',25,0,'',1,'2007-11-15 17:43:53','2009-08-24 12:14:39',1,0),(28,1,35,'Пользователи',10,0,'',1,'2007-11-21 14:52:42','2009-08-24 12:15:22',1,0),(29,1,34,'Туроператоры',2,0,'',1,'2007-11-21 16:27:20','2009-08-24 12:26:58',1,0),(30,1,22,'Типы питания',2,0,'',1,'2007-11-21 16:43:39','2009-08-24 12:26:25',1,0),(31,1,32,'Типы номеров',2,0,'',1,'2007-11-21 16:54:07','2009-08-24 12:25:47',1,0),(32,1,23,'Категории отелей',2,0,'',1,'2007-12-05 15:21:45','2009-08-24 12:25:25',1,0),(34,1,15,'Курорты',13,0,'',1,'2008-01-09 14:51:19','2009-08-24 12:24:59',1,0),(37,1,19,'Назначения сотрудников',16,0,'',1,'2007-12-05 18:43:26','2009-09-02 15:26:27',1,0),(39,1,NULL,'Доходы-затраты',0,0,'',1,'2007-12-08 20:13:43','2009-08-24 12:24:03',1,0),(40,1,1,'Статьи оплат',39,0,'',1,'2007-12-08 20:15:06','2009-08-24 12:23:43',1,0),(41,1,24,'Доходы-затраты',39,0,'',1,'2007-12-12 10:07:40','2009-08-24 12:23:22',1,0),(52,1,5,'Типы рекламных носителей',25,0,'',1,'2007-12-20 10:33:30','2009-08-24 12:23:01',1,0),(53,1,4,'Рекламные носители',25,0,'',1,'2007-12-20 11:19:46','2009-08-24 12:22:28',1,0),(56,1,3,'Рекламные кампании',25,0,'',1,'2007-12-24 17:59:50','2009-08-24 12:22:05',1,0),(110,1,8,'Продажа авиабилетов',1,0,'',1,'2008-03-07 18:54:28','2009-08-24 12:21:34',1,0),(177,1,NULL,'Авиапродажи',2,0,'',1,'2008-08-28 12:16:04','2009-08-24 12:21:10',1,0),(178,1,7,'Авиакомпании',177,0,'',1,'2008-08-28 12:18:11','2009-08-24 12:20:43',1,0),(233,1,6,'Контакты авиапродаж',1,0,'',1,'2008-10-24 16:59:35','2009-08-24 12:20:22',1,0),(300,1,13,'Константы',10,0,'',1,'2009-07-08 12:15:53','2009-08-24 12:19:26',1,0),(301,1,NULL,'Отчеты по маркетингу',3,0,'',1,'2009-07-15 23:32:45','2009-08-24 12:19:07',1,0),(302,1,28,'Активность рекламы',301,0,'',1,'2009-07-15 23:33:15','2009-08-24 12:18:43',1,0),(303,1,29,'Эффективность рекламы',301,0,'',1,'2009-07-20 18:21:11','2009-08-24 12:17:54',1,0),(304,1,NULL,'Бухгалтерские отчеты',3,0,'',1,'2009-07-24 12:03:50','2009-08-24 12:17:29',1,0),(305,1,31,'Отчет по туроператорам',304,0,'',1,'2009-07-24 12:04:17','2009-08-24 12:17:02',1,0),(306,1,30,'Отчет по продажам',304,0,'',1,'2009-08-08 16:30:30','2009-08-24 12:16:31',1,0),(307,1,25,'Модули',10,0,'',1,'2009-08-23 18:17:47','2009-08-24 12:15:58',1,0),(309,1,36,'Дисконтные карты',2,0,'',1,'2009-08-30 16:31:17','2009-08-30 16:33:20',1,0),(310,1,37,'База отелей',2,0,'Справочник гостиниц',1,'2009-09-02 17:47:32','2009-09-02 17:47:32',1,0),(311,2,NULL,'Работа с клиентами',0,0,'',1,'2009-09-28 20:25:39','2009-09-28 20:25:39',1,0),(312,2,9,'Контакты туров',311,0,'',1,'2009-09-28 20:26:36','2010-04-30 00:17:37',1,0),(313,2,17,'Продажа туров',311,0,'',1,'2009-09-28 20:27:07','2009-09-28 20:27:07',1,0),(314,1,38,'Прочие контрагенты',2,0,'Справочник прочих контрагентов',1,'2010-04-02 00:15:15','2010-04-02 00:15:15',1,0),(315,2,NULL,'Справочники',0,0,'Список справочников менеджера',1,'2010-04-29 22:13:36','2010-04-30 00:23:47',1,0),(316,2,12,'Справочник клиентов',315,1,'Справочник клиентов',1,'2010-04-29 22:14:28','2010-04-29 22:14:28',1,0),(317,2,37,'База отелей',315,3,'',1,'2010-04-30 00:28:00','2010-04-30 00:28:00',1,0),(318,1,39,'Интересы клиентов',2,0,'Справочник для интересов клиентов',1,'2010-08-15 21:09:43','2010-08-15 21:10:44',1,0),(319,2,NULL,'Отчеты',0,2,'',1,'2010-08-20 22:49:16','2010-08-20 22:49:16',1,0),(320,2,30,'Отчет по  продажам',319,1,'',1,'2010-08-20 22:50:19','2010-08-20 22:50:19',1,0),(321,2,31,'Отчет по туроператорам',319,2,'Отчет по продажам в разрезе туроператоров',1,'2010-08-20 22:50:57','2010-08-20 22:51:13',1,0);
/*!40000 ALTER TABLE `_positions_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_rooms`
--

DROP TABLE IF EXISTS `_rooms`;
CREATE TABLE `_rooms` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__rooms1` (`modifier_users_rid`),
  KEY `FK__rooms2` (`owner_users_rid`),
  CONSTRAINT `FK__rooms1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__rooms2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_rooms`
--

LOCK TABLES `_rooms` WRITE;
/*!40000 ALTER TABLE `_rooms` DISABLE KEYS */;
INSERT INTO `_rooms` VALUES (1,'SNGL','одномісний','',1,'2007-11-21 14:54:58','2009-06-15 08:25:56',1,0),(2,'DBL','2-місний','',1,'2007-11-21 14:55:21','2010-03-22 22:53:15',1,0),(3,'TRPL','тримісний','',1,'2007-12-21 14:11:50','2009-06-02 21:56:54',1,0),(4,'Sng+1chd ','одномісний + дитина','',1,'2008-01-21 11:20:34','2008-01-21 11:20:34',1,0),(5,'Sng+2chd ','одномісний + 2 дитини ','',1,'2008-01-21 11:21:05','2008-01-21 11:21:05',1,0),(6,'Dbl+1chd','2-місний + 1 дитина','',1,'2008-01-21 11:21:37','2008-02-12 10:09:19',1,0),(7,'Dbl+2chd ','2-місний + 2 дитини','',1,'2008-01-21 11:22:21','2008-02-12 10:09:29',1,0),(8,'DBL+EXB','2-місний + дод. ліжко','',1,'2008-02-06 15:16:53','2008-02-12 10:10:03',1,0),(9,'DBL+EXB+1chd','2-місний+дод. ліжко+1дитина','',1,'2008-03-14 14:52:54','2008-05-23 12:43:28',1,0),(11,'--','ні','',1,'2008-04-21 08:33:37','2008-04-21 08:33:37',1,0),(12,'SNGL+inf.','SNGL+inf.','',1,'2008-06-03 13:34:29','2008-06-03 13:35:20',1,0);
/*!40000 ALTER TABLE `_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_sessions`
--

DROP TABLE IF EXISTS `_sessions`;
CREATE TABLE `_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `session_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_sessions`
--

LOCK TABLES `_sessions` WRITE;
/*!40000 ALTER TABLE `_sessions` DISABLE KEYS */;
INSERT INTO `_sessions` VALUES ('0a1f0f19819fbe14ed10591a86415135','10.0.33.33','Mozilla/5.0 (X11; U; Linux i686; ru; rv:1.9.1.3) G',1282936264,''),('3b97700c38ff1aaff0055c413c2cd609','10.0.33.33','Mozilla/5.0 (X11; U; Linux i686; ru; rv:1.9.1.3) G',1283087060,'a:2:{s:4:\"URID\";s:1:\"1\";s:8:\"LANGUAGE\";s:7:\"russian\";}'),('d8ddfa64903a60917a875a46bd0e718a','10.0.33.33','Mozilla/5.0 (X11; U; Linux i686; ru; rv:1.9.1.3) G',1282851536,'a:2:{s:4:\"URID\";s:1:\"1\";s:8:\"LANGUAGE\";s:7:\"russian\";}'),('df594b818703a188294ce17babefe328','10.0.33.33','Mozilla/5.0 (X11; U; Linux i686; ru; rv:1.9.1.3) G',1282892511,'');
/*!40000 ALTER TABLE `_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_tasks`
--

DROP TABLE IF EXISTS `_tasks`;
CREATE TABLE `_tasks` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `objrid` int(12) DEFAULT NULL,
  `objtype` varchar(255) DEFAULT NULL,
  `edate` timestamp NULL DEFAULT NULL,
  `descr` varchar(512) DEFAULT NULL,
  `done` tinyint(1) DEFAULT '0',
  `priority` tinyint(1) DEFAULT '0',
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__rooms1` (`modifier_users_rid`),
  KEY `FK__rooms2` (`owner_users_rid`),
  CONSTRAINT `FK__tasks_1` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tasks_2` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_tasks`
--

LOCK TABLES `_tasks` WRITE;
/*!40000 ALTER TABLE `_tasks` DISABLE KEYS */;
INSERT INTO `_tasks` VALUES (12,NULL,'TASKS','2009-09-04 21:00:00','Для тестирования',1,2,1,'2009-09-20 19:17:49','2009-09-20 19:17:49',1,0),(13,4675,'CLIENTS','2009-09-19 21:00:00','Тестирование функциональности',1,2,1,'2009-09-28 16:25:06','2009-09-28 16:25:06',1,0),(18,1,'FOOD','2009-09-29 21:00:00','Задачи',1,0,1,'2010-02-10 20:39:01','2010-02-10 20:39:01',1,0),(19,8582,'CALLS','2009-09-27 21:00:00','Тестирование задач',1,1,1,'2009-09-28 17:23:48','2009-09-28 17:23:48',1,0),(20,14461,'EMPTOPOSITIONS','2009-09-27 21:00:00','Исправить назначение на должность для тестового менеджера по туризму',1,0,1,'2010-02-10 13:24:47','2010-02-10 13:24:47',1,0),(26,NULL,'TASKS','2010-01-31 22:00:00','Поверка корректности выполнения задач в IE',1,2,1,'2010-02-10 20:38:50','2010-02-10 20:38:50',1,0),(29,NULL,'TASKS','2010-01-31 22:00:00','Поверка корректности выполнения задач в IE',1,2,1,'2010-02-10 20:38:56','2010-02-10 20:38:56',1,0),(32,14472,'DEMANDS','2010-08-31 21:00:00','Проконтролировать выдачу документов туристам',0,1,1,'2010-08-15 13:40:40','2010-08-15 13:40:40',1,0),(33,14476,'CALLS','2010-08-19 21:00:00','Созвониться с Эллой и уточнить наличие мест в гостиницы',0,2,2,'2010-08-19 20:30:55','2010-08-19 20:30:55',2,0);
/*!40000 ALTER TABLE `_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_touroperators`
--

DROP TABLE IF EXISTS `_touroperators`;
CREATE TABLE `_touroperators` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `stouroperator_name` varchar(255) DEFAULT NULL,
  `touroperator_name` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `chief_name` varchar(255) DEFAULT NULL,
  `www` varchar(255) DEFAULT NULL,
  `contract` varchar(65) DEFAULT NULL,
  `contract_period` timestamp NULL DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `category` varchar(32) DEFAULT '0',
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `payment_condition` varchar(255) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `FK__touroperators` (`modifier_users_rid`),
  KEY `FK__touroperators1` (`owner_users_rid`),
  CONSTRAINT `FK__touroperators` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__touroperators1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_touroperators`
--

LOCK TABLES `_touroperators` WRITE;
/*!40000 ALTER TABLE `_touroperators` DISABLE KEYS */;
INSERT INTO `_touroperators` VALUES (1,'НЬЮЗ ТРЕВЕЛ','Товариство з обмеженою відповідальністю \"Ньюз Тревел\"','АБ 217778 від 11 листопада  2005 р.','Солнцев Сергей Олександрович','http://www.newstravel.com','№ 0315 від 15.03.2008р.','2020-01-20 15:00:00','02660 г. Киев, ул. Старосельская 1д','(044) 50-308-50','Солнцев Сергей','(044) 50-308-50, 502-82-32,','info@newstravel.com.ua','Рекомендованый','',1,'2008-01-14 08:27:04','2009-06-21 19:24:29',1,'$TOUR_DATE_BEGIN-2',0),(40,'ПРОЛАНД','ООО \"Туроператор \"Проланд\"','АВ 329035 від 16.03.2007 р.','Ицковский Я.Б.','www.proland.ua ','№344 від 07.06.2007 р.','2008-12-30 22:00:00','г. Киев, пр. Победы, д.2, оф. 75','288-0477','','236-9009','proland@proland.ua ','Нейтральный','',1,'2008-01-14 09:43:22','2008-12-17 09:55:07',1,'',0),(45,'Тез тур','ТОВ \"ТЕЗ ТУР\"','АВ 020225 від 21.03.2006р.','Андрик Йосип Йожефович','','№703 від 01.04.2008 р.','2010-03-31 21:00:00','03150, Україна, м. Київ, вул. Червоноармійська 63, кв.2','289-03-90, 390-50-90','----','531-98-00,3905000, 581 50 00','book@teztour.com.ua','Рекомендованый','',1,'2008-01-14 10:46:28','2009-09-19 13:50:12',1,'$TOUR_DATE_BEGIN-2',0);
/*!40000 ALTER TABLE `_touroperators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_tours`
--

DROP TABLE IF EXISTS `_tours`;
CREATE TABLE `_tours` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_touroperators_rid` int(12) DEFAULT NULL,
  `_food_rid` int(12) DEFAULT NULL,
  `_rooms_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `_hotels_rid` int(12) DEFAULT NULL,
  `_countries_rid` int(12) DEFAULT NULL,
  `_curourts_rid` int(12) DEFAULT NULL,
  `room_cat` varchar(255) DEFAULT NULL,
  `sum_tour` float(10,2) DEFAULT NULL,
  `cource` float(10,2) DEFAULT NULL,
  `to_koeff` float(10,2) DEFAULT NULL,
  `discount_per` float(10,2) DEFAULT NULL,
  `discount_fix` float(10,2) DEFAULT NULL,
  `sum` float(10,2) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `transfer` varchar(255) DEFAULT NULL,
  `excursions` varchar(255) DEFAULT NULL,
  `visa` tinyint(1) DEFAULT '0',
  `cif` varchar(255) DEFAULT NULL,
  `order_sum` float(10,2) DEFAULT NULL,
  `order_num` varchar(45) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `approve` tinyint(1) DEFAULT '0',
  `approve_date` timestamp NULL DEFAULT NULL,
  `tour_num` varchar(45) DEFAULT NULL,
  `anulated` tinyint(1) DEFAULT '0',
  `descr` varchar(512) DEFAULT NULL,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `_rooms_rid` (`_rooms_rid`),
  KEY `_food_rid` (`_food_rid`),
  KEY `FK__tours` (`modifier_users_rid`),
  KEY `FK__tours1` (`_touroperators_rid`),
  KEY `FK__tours8` (`_currencies_rid`),
  KEY `FK__tours9` (`owner_users_rid`),
  KEY `FK__tours10` (`_hotels_rid`),
  KEY `FK__tours4` (`_countries_rid`),
  KEY `FK__tours5` (`_curourts_rid`),
  CONSTRAINT `FK__tours` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours1` FOREIGN KEY (`_touroperators_rid`) REFERENCES `_touroperators` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours10` FOREIGN KEY (`_hotels_rid`) REFERENCES `_hotels` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours2` FOREIGN KEY (`_food_rid`) REFERENCES `_food` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours3` FOREIGN KEY (`_rooms_rid`) REFERENCES `_rooms` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours4` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours5` FOREIGN KEY (`_curourts_rid`) REFERENCES `_curourts` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours8` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__tours9` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_tours`
--

LOCK TABLES `_tours` WRITE;
/*!40000 ALTER TABLE `_tours` DISABLE KEYS */;
INSERT INTO `_tours` VALUES (1,45,4,2,2,5,3,2,'стандарт',1000.00,9.20,1.00,0.00,0.00,9292.00,'Киев-Хургада-Киев','2009-09-20 21:00:00','2009-09-26 21:00:00','групповой','--',0,'',8700.00,'132456','2009-09-06 21:00:00',1,NULL,'',0,NULL,1,'2009-09-06 11:15:32','2010-08-10 22:20:57',1,0),(2,45,5,2,2,7,7,14,'standart',1258.00,7.92,1.00,0.00,0.00,10062.99,'Киев-Даламан-Киев','2010-08-27 21:00:00','2010-09-03 21:00:00','групповой','-',0,'',0.00,'','0000-00-00 00:00:00',1,NULL,'',0,NULL,1,'2010-08-10 21:15:18','2010-08-10 21:18:58',1,0),(3,40,1,6,2,NULL,1,13,'стандарт',748.00,7.90,1.00,0.00,0.00,5968.29,'Киев-Симферополь-Алушта-Симферополь-Киев','2010-09-05 21:00:00','2010-09-11 21:00:00','групповой','-',0,'есть',5127.00,'','0000-00-00 00:00:00',1,NULL,'123456',0,NULL,1,'2010-08-15 10:22:34','2010-08-15 10:34:14',1,0),(4,45,3,6,4,NULL,64,NULL,'стандарт',1420.00,10.32,1.00,0.00,0.00,14800.94,'Киев-Афины-Киев','2010-08-31 21:00:00','2010-09-07 21:00:00','груповий','-',1,'',13540.00,'123','2010-08-19 21:00:00',1,NULL,'12345',0,NULL,1,'2010-08-19 20:15:35','2010-08-19 20:19:25',1,0),(5,45,5,6,2,1,3,1,'люкс',1680.00,7.95,1.03,0.00,0.00,13493.57,'КИев-Хургада-Киев','2010-08-19 21:00:00','2010-08-27 21:00:00','групп.','--',0,'',12356.00,'123456','2010-08-19 21:00:00',1,NULL,'4564879',0,NULL,2,'2010-08-20 07:28:42','2010-08-20 18:10:42',2,0),(6,40,5,6,2,NULL,117,NULL,'стандарт',2780.00,7.92,1.00,0.00,0.00,22237.78,'Киев-Марокко-Киев','2010-08-20 21:00:00','2010-08-27 21:00:00','групп','--',1,'включена',20563.00,'12345','2010-08-19 21:00:00',1,NULL,'12345',0,NULL,2,'2010-08-20 18:20:23','2010-08-20 18:23:15',2,0);
/*!40000 ALTER TABLE `_tours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_users`
--

DROP TABLE IF EXISTS `_users`;
CREATE TABLE `_users` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_employeers_rid` int(12) DEFAULT NULL,
  `user_login` varchar(20) DEFAULT NULL,
  `user_passwd` varchar(255) DEFAULT NULL,
  `edate_passwd` timestamp NULL DEFAULT NULL,
  `chdate_passwd` timestamp NULL DEFAULT NULL,
  `descr` text,
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `IX__users_1` (`user_login`),
  KEY `_employeers_rid` (`_employeers_rid`),
  CONSTRAINT `FK__users1` FOREIGN KEY (`_employeers_rid`) REFERENCES `_employeers` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `_users`
--

LOCK TABLES `_users` WRITE;
/*!40000 ALTER TABLE `_users` DISABLE KEYS */;
INSERT INTO `_users` VALUES (1,1,'admin','adminadmin','2019-12-31 22:00:00','2010-09-20 21:00:00','Администратор системы',1,'2007-11-28 11:55:12','2010-03-16 19:31:18',1,0),(2,2,'manager','managermanager','2010-09-27 21:00:00','2010-10-15 21:00:00','Тестовый менеджер',1,'2009-09-28 17:22:27','2010-07-15 16:30:23',1,0);
/*!40000 ALTER TABLE `_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-08-29 13:17:30
