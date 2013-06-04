/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-04 15:21:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_tipo_gasto`
-- ----------------------------
DROP TABLE IF EXISTS `trans_tipo_gasto`;
CREATE TABLE `trans_tipo_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_tipo_gasto
-- ----------------------------
INSERT INTO `trans_tipo_gasto` VALUES ('1', 'Viajes');
INSERT INTO `trans_tipo_gasto` VALUES ('2', 'Oficina');
INSERT INTO `trans_tipo_gasto` VALUES ('3', 'Maquinaria');
INSERT INTO `trans_tipo_gasto` VALUES ('4', 'Choferes');
INSERT INTO `trans_tipo_gasto` VALUES ('5', 'Otros');
