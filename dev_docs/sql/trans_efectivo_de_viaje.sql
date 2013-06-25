/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-25 15:10:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_efectivo_de_viaje`
-- ----------------------------
DROP TABLE IF EXISTS `trans_efectivo_de_viaje`;
CREATE TABLE `trans_efectivo_de_viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `importe` decimal(18,6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `concepto` char(255) DEFAULT NULL,
  `forma_deposito` char(255) DEFAULT NULL,
  `fk_viaje` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
