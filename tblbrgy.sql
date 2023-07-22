/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 5.7.33-0ubuntu0.16.04.1 : Database - registrar_gadtc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`registrar_gadtc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `registrar_gadtc`;

/*Table structure for table `tblbrgy` */

DROP TABLE IF EXISTS `tblbrgy`;

CREATE TABLE `tblbrgy` (
  `Brgy_ID` int(7) NOT NULL,
  `Bgry_Name` varchar(50) DEFAULT NULL,
  `City_Id` int(7) DEFAULT NULL,
  `City_Name` varchar(50) DEFAULT NULL,
  `Prov_Id` int(7) DEFAULT NULL,
  `Prov_Name` varchar(50) DEFAULT NULL,
  `Region` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Brgy_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tblbrgy` */


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;