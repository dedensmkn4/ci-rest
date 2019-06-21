/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.31-MariaDB : Database - db_ota
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ota` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `db_ota`;

/*Table structure for table `mst_airline` */

DROP TABLE IF EXISTS `mst_airline`;

CREATE TABLE `mst_airline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniq code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_airline` */

LOCK TABLES `mst_airline` WRITE;

insert  into `mst_airline`(`id`,`code`,`name`) values (1,'GA','GARUDA INDONESIA'),(2,'QG','CITILINK INDONESIA'),(3,'SJ','SRIWIJAYA AIR');

UNLOCK TABLES;

/*Table structure for table `mst_airport` */

DROP TABLE IF EXISTS `mst_airport`;

CREATE TABLE `mst_airport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniq code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_airport` */

LOCK TABLES `mst_airport` WRITE;

insert  into `mst_airport`(`id`,`code`,`name`) values (1,'CGK','Soekarno Hatta'),(2,'DPS','Ngurah Rai'),(3,'BDO','Husein Sastranegara');

UNLOCK TABLES;

/*Table structure for table `tbl_ticket` */

DROP TABLE IF EXISTS `tbl_ticket`;

CREATE TABLE `tbl_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin_airport_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_airport_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `airline_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `origin_airport_code` (`origin_airport_code`),
  KEY `destination_airport_code` (`destination_airport_code`),
  KEY `airline_code` (`airline_code`),
  CONSTRAINT `tbl_ticket_ibfk_1` FOREIGN KEY (`origin_airport_code`) REFERENCES `mst_airport` (`code`),
  CONSTRAINT `tbl_ticket_ibfk_2` FOREIGN KEY (`destination_airport_code`) REFERENCES `mst_airport` (`code`),
  CONSTRAINT `tbl_ticket_ibfk_3` FOREIGN KEY (`airline_code`) REFERENCES `mst_airline` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ticket` */

LOCK TABLES `tbl_ticket` WRITE;

insert  into `tbl_ticket`(`id`,`origin_airport_code`,`destination_airport_code`,`airline_code`,`stock`) values (1,'CGK','DPS','GA',79),(2,'CGK','DPS','QG',5),(3,'CGK','BDO','SJ',2),(4,'CGK','BDO','QG',3);

UNLOCK TABLES;

/*Table structure for table `tbl_ticket_inquiry` */

DROP TABLE IF EXISTS `tbl_ticket_inquiry`;

CREATE TABLE `tbl_ticket_inquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `updated_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  CONSTRAINT `tbl_ticket_inquiry_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tbl_ticket` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ticket_inquiry` */

LOCK TABLES `tbl_ticket_inquiry` WRITE;

insert  into `tbl_ticket_inquiry`(`id`,`ticket_id`,`email`,`created_datetime`,`updated_datetime`) values (14,1,'deden@swamedia.co.id','2019-06-20 14:39:53',NULL),(15,1,'deden@swamedia.co.id','2019-06-20 14:51:14',NULL),(16,1,'deden@swamedia.co.id','2019-06-20 14:51:48',NULL),(17,1,'deden@swamedia.co.id','2019-06-20 14:52:47',NULL),(18,1,'deden@swamedia.co.id','2019-06-20 14:55:04',NULL),(19,1,'deden@swamedia.co.id','2019-06-20 14:56:48',NULL),(20,1,'deden@swamedia.co.id','2019-06-20 14:57:02',NULL),(21,1,'deden@swamedia.co.id','2019-06-20 14:57:29',NULL),(22,1,'deden@swamedia.co.id','2019-06-20 14:58:04',NULL),(23,1,'deden@swamedia.co.id','2019-06-20 14:58:51',NULL),(24,1,'deden@swamedia.co.id','2019-06-20 14:59:33',NULL),(25,1,'deden@swamedia.co.id','2019-06-20 15:00:41',NULL),(26,1,'deden@swamedia.co.id','2019-06-20 15:02:28',NULL),(27,1,'deden@swamedia.co.id','2019-06-20 15:03:41',NULL),(28,1,'deden@swamedia.co.id','2019-06-20 15:03:59',NULL),(29,1,'deden@swamedia.co.id','2019-06-20 15:04:36',NULL),(30,1,'deden@swamedia.co.id','2019-06-20 15:05:01',NULL),(31,1,'deden@swamedia.co.id','2019-06-20 15:05:56',NULL),(32,1,'deden@swamedia.co.id','2019-06-20 15:06:16',NULL),(33,1,'deden@swamedia.co.id','2019-06-20 15:08:21',NULL),(34,1,'deden@swamedia.co.id','2019-06-20 15:08:37',NULL),(35,1,'deden@swamedia.co.id','2019-06-20 15:09:43',NULL),(36,1,'deden@swamedia.co.id','2019-06-20 15:12:14',NULL),(37,1,'deden@swamedia.co.id','2019-06-20 15:12:45',NULL),(38,1,'deden@swamedia.co.id','2019-06-20 15:12:46',NULL),(39,1,'deden@swamedia.co.id','2019-06-20 15:12:47',NULL),(40,1,'deden@swamedia.co.id','2019-06-20 15:14:01',NULL),(41,1,'deden@swamedia.co.id','2019-06-20 15:14:02',NULL),(42,1,'deden@swamedia.co.id','2019-06-20 15:14:03',NULL),(43,1,'deden@swamedia.co.id','2019-06-20 15:18:44',NULL),(44,1,'deden@swamedia.co.id','2019-06-20 15:18:49',NULL),(45,2,'deden.farhan@widyatama.ac.id','2019-06-21 09:41:17',NULL),(46,2,'deden.farhan@widyatama.ac.id','2019-06-21 09:48:51',NULL),(47,2,'deden.farhan@widyatama.ac.id','2019-06-21 09:49:41',NULL),(48,2,'deden@swamedia.co.id','2019-06-21 09:52:41',NULL),(49,2,'deden@swamedia.co.id','2019-06-21 09:53:04',NULL),(50,1,'deden@swamedia.co.id','2019-06-21 10:55:27',NULL),(51,1,'deden@swamedia.co.id','2019-06-21 10:55:53',NULL),(52,1,'deden@swamedia.co.id','2019-06-21 10:56:15',NULL),(53,1,'deden@swamedia.co.id','2019-06-21 10:56:26',NULL),(54,1,'deden@swamedia.co.id','2019-06-21 10:57:12',NULL),(55,1,'deden@swamedia.co.id','2019-06-21 10:57:31',NULL),(56,1,'deden@swamedia.co.id','2019-06-21 10:58:05',NULL),(57,1,'deden@swamedia.co.id','2019-06-21 11:02:57',NULL),(58,1,'deden@swamedia.co.id','2019-06-21 11:13:34',NULL),(59,1,'deden@swamedia.co.id','2019-06-21 11:14:16',NULL),(60,1,'deden@swamedia.co.id','2019-06-21 11:24:36',NULL),(61,1,'deden@swamedia.co.id','2019-06-21 11:27:05',NULL),(62,1,'deden@swamedia.co.id','2019-06-21 11:27:48',NULL),(63,1,'deden@swamedia.co.id','2019-06-21 11:27:49',NULL),(64,1,'deden@swamedia.co.id','2019-06-21 11:43:03',NULL),(65,1,'deden@swamedia.co.id','2019-06-21 11:44:24',NULL),(66,1,'deden@swamedia.co.id','2019-06-21 11:45:05',NULL),(67,1,'deden@swamedia.co.id','2019-06-21 11:54:05',NULL),(68,3,'deden@swamedia.co.id','2019-06-21 12:01:05',NULL),(69,4,'deden@swamedia.co.id','2019-06-21 12:02:45',NULL),(70,4,'deden@swamedia.co.id','2019-06-21 12:04:22',NULL),(71,2,'deden@swamedia.co.id','2019-06-21 12:07:31',NULL),(72,2,'deden@swamedia.co.id','2019-06-21 12:14:28',NULL),(73,2,'deden@swamedia.co.id','2019-06-21 12:15:10',NULL),(74,2,'deden@swamedia.co.id','2019-06-21 12:15:14',NULL),(75,4,'deden@swamedia.co.id','2019-06-21 12:18:28',NULL),(76,4,'dedensmkn4@gmail.com','2019-06-21 12:21:39',NULL),(77,4,'deden@swamedia.co.id','2019-06-21 12:24:33',NULL),(78,2,'dedensmkn4@gmail.com','2019-06-21 13:30:50',NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
