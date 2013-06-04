/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-03 19:39:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_consumo`
-- ----------------------------
DROP TABLE IF EXISTS `trans_consumo`;
CREATE TABLE `trans_consumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_viaje` int(11) DEFAULT NULL,
  `distancia` decimal(18,6) DEFAULT NULL,
  `rendimiento` decimal(18,6) DEFAULT NULL,
  `consumo_diesel_lt` decimal(18,6) DEFAULT NULL,
  `precio_por_litro` decimal(18,6) DEFAULT NULL,
  `consumo_en_pesos` decimal(18,6) DEFAULT NULL,
  `kilometraje_inicial` decimal(18,6) DEFAULT NULL,
  `kilometraje_final` decimal(18,6) DEFAULT NULL,
  `kilometraje_recorrido` decimal(18,6) DEFAULT NULL,
  `consumo_diesel_calculado_lt` decimal(18,6) DEFAULT NULL,
  `consumo_diesel_calculado_pesos` decimal(18,6) DEFAULT NULL,
  `consumo_diesel_real_pesos` decimal(18,6) DEFAULT NULL,
  `diferencia` decimal(18,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_consumo
-- ----------------------------
INSERT INTO `trans_consumo` VALUES ('1', '107', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('4', '113', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('5', '109', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('6', '108', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('7', '106', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('8', '105', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('9', '114', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('10', '115', '200.000000', '1.300000', '0.000000', '3.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('11', '116', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('12', '117', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('13', '118', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
INSERT INTO `trans_consumo` VALUES ('14', '119', '123123.000000', '12123.000000', '0.000000', '123.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000', '0.000000');
