/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-01 18:12:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_viaje`
-- ----------------------------
DROP TABLE IF EXISTS `trans_viaje`;
CREATE TABLE `trans_viaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origen` char(255) DEFAULT NULL,
  `fk_remitente` int(11) DEFAULT NULL,
  `fecha_carga` datetime DEFAULT NULL,
  `direccion_carga` char(255) DEFAULT NULL,
  `contenido` char(255) DEFAULT NULL,
  `destino` char(255) DEFAULT NULL,
  `fk_destinatario` int(11) DEFAULT NULL,
  `direccion_de_entrega` text,
  `fecha_a_entregar` datetime DEFAULT NULL,
  `precio` decimal(18,6) DEFAULT NULL,
  `condiciones_de_pago` char(255) DEFAULT NULL,
  `fk_chofer` int(11) DEFAULT NULL,
  `costo` decimal(18,6) DEFAULT NULL,
  `fk_vehiculo` int(11) DEFAULT NULL,
  `fk_caja` int(11) DEFAULT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `folio` int(11) DEFAULT NULL,
  `fk_serie` int(11) DEFAULT '7',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_viaje
-- ----------------------------
INSERT INTO `trans_viaje` VALUES ('94', null, '3', '2013-06-01 22:41:00', null, null, null, '4', null, null, null, null, null, null, null, null, '2013-06-01 16:01:02', null, '7');
INSERT INTO `trans_viaje` VALUES ('95', null, '3', '2013-06-01 22:41:00', null, null, null, '4', null, null, null, null, null, null, null, null, '2013-06-01 16:01:02', null, '7');
INSERT INTO `trans_viaje` VALUES ('96', null, '3', '2013-06-01 22:41:00', null, null, null, '4', null, null, null, null, null, null, null, null, '2013-06-01 16:01:02', null, '7');
INSERT INTO `trans_viaje` VALUES ('98', null, null, null, null, null, null, '4', null, null, null, null, null, null, null, null, '2013-06-01 16:01:11', null, '7');
INSERT INTO `trans_viaje` VALUES ('99', null, '5', null, null, '', null, null, '', '2013-06-01 17:18:00', '0.000000', null, '4', '0.000000', '3', '1', '2013-06-01 17:18:51', '85', '7');
INSERT INTO `trans_viaje` VALUES ('100', null, '3', null, null, '', null, null, '', '2013-06-01 17:21:00', '0.000000', null, '4', '0.000000', '3', '1', '2013-06-01 17:21:38', '86', '7');
INSERT INTO `trans_viaje` VALUES ('101', '', '3', null, '20 de noviembre #1310, col. esperanza', '', null, null, '', '2013-06-01 17:36:00', '0.000000', null, '4', '0.000000', '3', '1', '2013-06-01 17:36:40', '87', '7');
INSERT INTO `trans_viaje` VALUES ('102', '', '3', null, '', '', null, null, '', '2013-06-01 17:38:00', '0.000000', null, '4', '0.000000', '3', '1', '2013-06-01 17:38:55', '88', '7');
INSERT INTO `trans_viaje` VALUES ('103', '', '3', '2013-06-01 18:05:00', '', '', '', '3', '', '2013-06-25 06:05:00', '2341243.000000', 'efectivo', '4', '12.000000', '3', '1', '2013-06-01 18:05:49', '89', '7');
INSERT INTO `trans_viaje` VALUES ('104', 'mazatlan', '3', '2013-06-01 18:07:00', '', '', 'culiacan', '5', '', '2013-06-01 18:07:00', '0.000000', '', '4', '0.000000', '3', '1', '2013-06-01 18:07:29', '90', '7');
