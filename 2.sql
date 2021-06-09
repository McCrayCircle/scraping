/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.18-MariaDB : Database - scraping
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`scraping` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `scraping`;

/*Table structure for table `domains` */

DROP TABLE IF EXISTS `domains`;

CREATE TABLE `domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT 0,
  `create_time` varchar(255) DEFAULT NULL,
  `expire_time` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `community_score` varchar(255) DEFAULT '0',
  `ip` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `blacklist` varchar(255) DEFAULT NULL,
  `test_result` varchar(255) DEFAULT NULL,
  `downloaded` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Domain_Unique` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

/*Table structure for table `ips` */

DROP TABLE IF EXISTS `ips`;

CREATE TABLE `ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT 0,
  `domain_name` varchar(255) DEFAULT NULL,
  `community_score` int(111) DEFAULT 0,
  `downloaded` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Ip_Unique` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ips` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
