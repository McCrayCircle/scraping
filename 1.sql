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
  PRIMARY KEY (`id`),
  UNIQUE KEY `Domain_Unique` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`state`,`create_time`,`expire_time`,`age`,`community_score`,`ip`,`name`,`location`,`blacklist`,`test_result`) values 
(1,'armsdealership.clinltd.com',1,'2020-05-01','2021-05-01','1years, 1months','0','198.54.119.196','NameCheap, Inc.','(US) United States','0/34','5'),
(2,'cdn.cityvoterinc.com',1,'2008-03-04','2022-03-04','13years, 3months','0','108.161.189.193','NameCheap, Inc.','(US) United States','0/34','5'),
(3,'www.harrypottercat.com',1,'2018-08-28','2021-08-28','2years, 9months','0','','NameCheap, Inc.','','','5'),
(4,'wirwal.com',1,'2020-05-08','2021-05-08','1years, 0months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(5,'deluxepharmaceuticals.com',1,'2020-04-10','2021-04-10','1years, 1months','0','104.219.248.48','NameCheap, Inc.','(US) United States','0/34','5'),
(6,'germanshepherdsetc.com',1,'2013-04-23','2021-04-23','8years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(7,'tkv.io',1,'2018-04-16','2022-04-16','3years, 1months','0','104.198.14.52','NameCheap, Inc','(US) United States','0/34','25'),
(8,'sholarcenter.com',1,'2020-04-10','2021-04-10','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(9,'nowbreakingnews.com',1,'2020-04-19','2022-04-19','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','0'),
(10,'www.umbcvolleyballcamps.com',1,'2018-04-29','2022-04-29','3years, 1months','0','','NameCheap, Inc.','','','5'),
(11,'usedtruck.org',1,'2000-05-09','2022-05-09','21years, 0months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(12,'techiewrist.com',1,'2020-05-10','2021-05-10','1years, 0months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(13,'b7y6h56fg46dh5n8g5h.y7g4h4hjf3h4jk9.solar',1,'2021-03-27','2022-03-27','0years, 2months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(14,'printcalendr.com',1,'2020-04-25','2021-04-25','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(15,'bestshowersystem.com',1,'2020-04-18','2021-04-18','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(16,'musclecarspower.com',1,'2017-04-25','2021-04-25','4years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(17,'carsuimport.com',1,'2018-05-04','2021-05-04','3years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','0'),
(18,'tm.esthinobunipi.pro',1,'2020-04-20','2022-04-20','1years, 1months','0','99.83.154.118','NameCheap, Inc','(US) United States','0/34','5'),
(19,'urbanheightsbethesda.com',1,'2020-04-11','2022-04-11','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(20,'bbookstore.xyz',1,'2020-05-03','2022-05-03','1years, 1months','0','99.83.154.118','Namecheap','(US) United States','0/34','5'),
(21,'steerwheel.info',1,'2018-05-07','2022-05-07','3years, 1months','0','99.83.154.118','NameCheap, Inc','(US) United States','0/34','10'),
(22,'musclecranking.com',1,'2019-04-13','2021-04-13','2years, 1months','0','192.230.74.93','NameCheap, Inc.','(US) United States','0/34','5'),
(23,'www.uhdledtvcomparison.com',1,'2016-04-30','2021-04-30','5years, 1months','0','','NameCheap, Inc.','','','5'),
(24,'knowitblogs.com',1,'2020-05-07','2021-05-07','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(25,'verifications.io',1,'2017-05-02','2022-05-02','4years, 1months','0','72.52.178.23','NameCheap, Inc','(US) United States','','5'),
(26,'businessentity.org',1,'2018-05-02','2022-05-02','3years, 1months','0','107.174.192.211','NameCheap, Inc.','(US) United States','0/34','0'),
(27,'www.eventsinger.co.uk',1,'2018-04-17','2022-04-17','3years, 1months','0','','Namecheap, Inc. [Tag = NAMECHEAP-INC]','','','15'),
(28,'dieselcarnews.com',1,'2016-05-06','2022-05-06','5years, 1months','0','172.67.159.240','NameCheap, Inc.','(US) United States','0/34','0'),
(29,'healthcautions.com',1,'2017-05-07','2022-05-07','4years, 1months','0','162.255.119.250','NameCheap, Inc.','(US) United States','0/34','5'),
(30,'www.thurfy.com',1,'2017-04-02','2021-04-02','4years, 2months','0','','NameCheap, Inc.','','','0'),
(31,'www.truckerstraining.com',1,'2014-05-05','2022-05-05','7years, 1months','0','','NameCheap, Inc.','','','0'),
(32,'echoesplayer.com',1,'2017-02-23','2022-02-23','4years, 3months','0','72.52.178.23','NameCheap, Inc.','(US) United States','0/34','25'),
(33,'offenders.info',1,'2020-04-26','2022-04-26','1years, 1months','0','99.83.154.118','NameCheap, Inc','(US) United States','0/34','10'),
(34,'quotesta.com',1,'2016-03-04','2022-03-04','5years, 3months','0','198.54.117.197','NameCheap, Inc.','(US) United States','0/34','0'),
(35,'lilacswim.com',1,'2020-04-21','2022-04-21','1years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(36,'san-diego-zoo.com',1,'','','','0','51.38.113.147','','(FR) France','0/34','5'),
(37,'paddlersway.com',1,'2017-05-02','2021-05-02','4years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(38,'allove.me',1,'2018-08-09','2021-08-09','2years, 9months','0','','GoDaddy.com, LLC','','0/34','5'),
(39,'mixdogbreeds.info',1,'2020-04-16','2022-04-16','1years, 1months','0','99.83.154.118','NameCheap, Inc','(US) United States','0/34','10'),
(40,'sportslivehds.com',1,'2019-02-19','2022-02-19','2years, 3months','0','72.52.178.23','NameCheap, Inc.','(US) United States','0/34','25'),
(41,'www.sanantonioroofingmaster.com',1,'2016-04-26','2021-04-26','5years, 1months','0','','NameCheap, Inc.','','','5'),
(42,'www.ewheelsusa.com',0,'2017-03-11','2022-03-11','4years, 2months','0','','NameCheap, Inc.','','','5'),
(43,'www.nlda.org',0,'2000-05-03','2022-05-03','21years, 1months','0','','NameCheap, Inc.','','','5'),
(44,'scopelearner.com',1,'2019-05-01','2021-05-01','2years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(45,'orepstatic.com',1,'2017-04-29','2022-04-29','4years, 1months','0','172.67.196.164','NameCheap, Inc.','(US) United States','0/34','0'),
(46,'laurelinekoenig.com',1,'2019-04-29','2022-04-29','2years, 1months','0','104.21.22.190','NameCheap, Inc.','(US) United States','0/34','0'),
(47,'minatulum.com',1,'2016-04-29','2022-04-29','5years, 1months','0','198.49.23.144','NameCheap, Inc.','(US) United States','0/34','5'),
(48,'minoritytimes.com',1,'2019-04-29','2022-04-29','2years, 1months','0','192.254.185.185','NameCheap, Inc.','(US) United States','0/34','0'),
(49,'www.ohanabbqfood.com',0,'','','','0','','','','','5'),
(50,'carphanatics.com',1,'2019-04-25','2021-04-25','2years, 1months','0','99.83.154.118','NameCheap, Inc.','(US) United States','0/34','5'),
(51,'www.thecrazywormlady.com',0,'','','','0','','','','','0'),
(52,'www.tenproductsreviews.com',0,'2020-04-26','2021-04-26','1years, 1months','0','','NameCheap, Inc.','','','5'),
(53,'samsung-updates.cc',0,'','','','0','104.27.163.7','','(US) United States','','10'),
(54,'tritondefenseusa.com',1,'2020-04-11','2022-04-11','1years, 1months','0','99.83.154.118','GoDaddy.com, LLC','(US) United States','0/34','5');

/*Table structure for table `ips` */

DROP TABLE IF EXISTS `ips`;

CREATE TABLE `ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT 0,
  `domain_name` varchar(255) DEFAULT NULL,
  `community_score` int(111) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Ip_Unique` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Data for the table `ips` */

insert  into `ips`(`id`,`ip_address`,`state`,`domain_name`,`community_score`) values 
(1,'36.232.223.26',1,'36-232-223-26.dynamic-ip.hinet.net',0),
(2,'92.41.69.31',1,'92.41.69.31.threembb.co.uk',0),
(3,'141.105.45.75',1,'141.105.45.75',0),
(4,'220.94.155.130',1,'220.94.155.130',0),
(5,'185.224.225.231',1,'185.224.225.231',0),
(6,'56.154.112.221',1,'56.154.112.221',0),
(7,'70.110.78.230',1,'70.110.78.230',0),
(8,'70.212.59.14',1,'14.sub-70-212-59.myvzw.com',0),
(9,'125.237.128.95',1,'125-237-128-95-adsl.sparkbb.co.nz',0),
(10,'6.152.181.244',1,'6.152.181.244',0),
(11,'35.104.43.176',1,'35.104.43.176',0),
(12,'185.102.27.90',1,'185.102.27.90',0),
(13,'124.100.238.230',1,'p5873231-ipoe.ipoe.ocn.ne.jp',0),
(14,'163.243.24.68',1,'163.243.24.68',0),
(15,'251.60.215.100',1,'',0),
(16,'79.69.93.104',1,'79-69-93-104.dynamic.dsl.as9105.com',0),
(17,'73.166.113.114',1,'c-73-166-113-114.hsd1.tx.comcast.net',0),
(18,'65.102.73.27',1,'65-102-73-27.bois.qwest.net',0),
(19,'136.171.16.144',1,'non-routed-un-exposed-IP.171.136.in-addr.arpa',0),
(20,'73.115.52.13',1,'c-73-115-52-13.hsd1.tx.comcast.net',0),
(21,'196.10.44.97',1,'196.10.44.97',0),
(22,'166.134.130.6',1,'mobile-166-134-130-006.mycingular.net',0),
(23,'147.57.105.115',1,'147.57.105.115',0),
(24,'230.74.68.91',1,'230.74.68.91',0),
(25,'155.125.1.26',1,'155.125.1.26',0),
(26,'174.58.79.111',1,'c-174-58-79-111.hsd1.fl.comcast.net',0),
(27,'144.23.247.157',1,'144.23.247.157',0),
(28,'121.116.226.56',1,'i121-116-226-56.s41.a001.ap.plala.or.jp',0),
(29,'202.182.82.151',1,'static.skybb.net.nz',0),
(30,'255.97.138.163',1,'',0),
(31,'91.92.23.131',1,'91.92.23.131',0),
(32,'126.7.173.103',1,'softbank126007173103.bbtec.net',0),
(33,'250.202.61.147',1,'',0),
(34,'12.139.226.66',1,'12.139.226.66',0),
(35,'64.117.247.58',1,'64.117.247.58',0),
(36,'105.1.32.196',1,'105.1.32.196',0),
(37,'32.54.146.112',1,'32.54.146.112',0),
(38,'115.62.53.250',1,'hn.kd.ny.adsl',0),
(39,'4.81.122.130',1,'4.81.122.130',0),
(40,'240.94.166.151',1,'',0),
(41,'74.230.19.249',1,'adsl-74-230-19-249.hsv.bellsouth.net',0),
(42,'67.149.131.141',1,'d149-67-141-131.col.wideopenwest.com',0),
(43,'98.188.15.134',1,'98.188.15.134',0),
(44,'12.30.62.238',1,'12.30.62.238',0),
(45,'203.71.107.14',1,'203.71.107.14',0),
(46,'127.157.160.31',1,'',0),
(47,'228.71.104.116',1,'228.71.104.116',0),
(48,'175.155.55.32',1,'175.155.55.32',0),
(49,'126.84.69.193',1,'softbank126084069193.bbtec.net',0),
(50,'5.28.233.246',1,'5.28.233.246',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
