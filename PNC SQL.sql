CREATE DATABASE `pnc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pnc`;
CREATE TABLE `pnc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `dob` varchar(45) DEFAULT NULL,
  `markers` varchar(60) DEFAULT NULL,
  `additional` varchar(1000) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `plate` varchar(45) DEFAULT NULL,
  `insurance` varchar(45) DEFAULT NULL,
  `mot` varchar(45) DEFAULT NULL,
  `previous` varchar(1000) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
