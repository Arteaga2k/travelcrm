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
  `owner_users_rid` int(12) DEFAULT NULL,
  `createDT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifyDT` timestamp NULL DEFAULT NULL,
  `modifier_users_rid` int(12) DEFAULT NULL,
  `archive` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `state_name` (`state_name`),
  KEY `FK__account_states` (`modifier_users_rid`),
  KEY `FK__account_states1` (`owner_users_rid`),
  CONSTRAINT `FK__account_states` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__account_states1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
-- Table structure for table `_aircalls_rows`
--

DROP TABLE IF EXISTS `_aircalls_rows`;
CREATE TABLE `_aircalls_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_aircalls_headers_rid` int(12) DEFAULT NULL,
  `_countries_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `air_class` int(1) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `sum_wanted_from` float DEFAULT NULL,
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
  CONSTRAINT `FK__aircalls_rows` FOREIGN KEY (`_advertisessources_rid`) REFERENCES `_advertisessources` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows1` FOREIGN KEY (`_aircalls_headers_rid`) REFERENCES `_aircalls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows2` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows4` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows5` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__aircalls_rows7` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=5330 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Table structure for table `_calls_rows`
--

DROP TABLE IF EXISTS `_calls_rows`;
CREATE TABLE `_calls_rows` (
  `rid` int(12) NOT NULL AUTO_INCREMENT,
  `_calls_headers_rid` int(12) DEFAULT NULL,
  `_countries_rid` int(12) DEFAULT NULL,
  `_advertisessources_rid` int(12) DEFAULT NULL,
  `_currencies_rid` int(12) DEFAULT NULL,
  `_curourts_rid` int(12) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `s_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `sum_wanted_from` float DEFAULT NULL,
  `sum_wanted_to` float DEFAULT NULL,
  `tourists_quan` int(12) DEFAULT NULL,
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
  KEY `_countries_rid` (`_countries_rid`),
  KEY `_adverises_rows_rid` (`_advertisessources_rid`),
  KEY `_currencies_rid` (`_currencies_rid`),
  KEY `FK__calls_rows_2` (`modifier_users_rid`),
  KEY `FK__calls_rows1` (`owner_users_rid`),
  KEY `FK__calls_rows3` (`_curourts_rid`),
  CONSTRAINT `FK__calls_rows` FOREIGN KEY (`_calls_headers_rid`) REFERENCES `_calls_headers` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows1` FOREIGN KEY (`owner_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows2` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows3` FOREIGN KEY (`_curourts_rid`) REFERENCES `_curourts` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows7` FOREIGN KEY (`_currencies_rid`) REFERENCES `_currencies` (`rid`) ON UPDATE CASCADE,
  CONSTRAINT `FK__calls_rows_2` FOREIGN KEY (`modifier_users_rid`) REFERENCES `_users` (`rid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5312 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=4730 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=14467 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=3524 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=490 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-06-23 19:31:28
