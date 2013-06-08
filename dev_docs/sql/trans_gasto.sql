/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-07 20:19:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_gasto`
-- ----------------------------
DROP TABLE IF EXISTS `trans_gasto`;
CREATE TABLE `trans_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costo` decimal(18,6) DEFAULT NULL,
  `descripcion` char(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `documento` char(255) DEFAULT NULL,
  `fk_tipo_gasto` int(11) DEFAULT NULL,
  `fk_viaje` int(11) DEFAULT NULL,
  `fk_vehiculo` int(11) DEFAULT NULL,
  `fk_concepto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_gasto
-- ----------------------------
