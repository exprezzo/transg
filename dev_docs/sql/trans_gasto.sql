/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-04 15:21:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_gasto`
-- ----------------------------
DROP TABLE IF EXISTS `trans_gasto`;
CREATE TABLE `trans_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(18,6) DEFAULT NULL,
  `descripcion` char(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `documento` char(255) DEFAULT NULL,
  `fk_tipo_gasto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_gasto
-- ----------------------------
INSERT INTO `trans_gasto` VALUES ('1', '500.000000', 'coyote', '2013-06-19 00:00:00', 'MZT-540', '1');
INSERT INTO `trans_gasto` VALUES ('2', '234.000000', '', '2013-06-04 14:30:09', 'ENE-119', '1');
INSERT INTO `trans_gasto` VALUES ('4', '250.000000', 'gasolina', '2013-06-04 14:30:04', 'ENE-120', '1');
INSERT INTO `trans_gasto` VALUES ('5', '0.000000', '', '2013-06-04 14:29:59', '', '3');
INSERT INTO `trans_gasto` VALUES ('6', '0.000000', '', '2013-06-19 14:26:00', '', '1');
INSERT INTO `trans_gasto` VALUES ('7', '0.000000', '', '2013-06-04 14:27:49', 'ENE-121', '1');
INSERT INTO `trans_gasto` VALUES ('8', '200.000000', 'gasolina', '2013-06-04 07:30:56', 'ENE-125', '1');
INSERT INTO `trans_gasto` VALUES ('9', '1500.000000', 'Prestamo a Macario', '2013-06-04 14:45:37', 'PRE-250', '4');
