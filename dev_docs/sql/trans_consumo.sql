/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-04 00:52:27
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
  `diferencia_calculado` decimal(18,6) DEFAULT NULL,
  `diferencia_medido` decimal(18,6) DEFAULT NULL,
  `hora_trabajo_i` decimal(18,6) DEFAULT NULL,
  `hora_trabajo_f` decimal(18,6) DEFAULT NULL,
  `horas_trabajo` decimal(18,6) DEFAULT NULL,
  `horas_esperadas` decimal(18,6) DEFAULT NULL,
  `horas_diferencia` decimal(18,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_consumo
-- ----------------------------
INSERT INTO `trans_consumo` VALUES ('28', '136', '3500.000000', '2.300000', '1521.739130', '15.000000', '22826.086957', '1000.000000', '2000.000000', '1000.000000', '434.782609', '6521.739130', '2500.000000', '20326.086957', '4021.739130', '10.000000', '26.000000', '16.000000', '20.000000', '-4.000000');
