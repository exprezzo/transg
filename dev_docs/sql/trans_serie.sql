/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-06 17:49:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `trans_serie`
-- ----------------------------
DROP TABLE IF EXISTS `trans_serie`;
CREATE TABLE `trans_serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` char(5) NOT NULL,
  `folio_i` int(11) DEFAULT NULL,
  `folio_f` int(11) DEFAULT NULL,
  `sig_folio` int(11) DEFAULT NULL,
  `es_default` bit(1) DEFAULT NULL,
  `idalmacen` int(11) DEFAULT NULL,
  `proceso` varchar(50) NOT NULL,
  `idsucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_serie
-- ----------------------------
INSERT INTO `trans_serie` VALUES ('1', 'ENE', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('2', 'FEB', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('3', 'MAR', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('4', 'ABR', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('5', 'MAY', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('6', 'JUN', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('7', 'JUL', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('8', 'AGO', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('9', 'SEP', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('10', 'OCT', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('11', 'NOV', '1', '10000', '1', '', '0', 'viajes', '0');
INSERT INTO `trans_serie` VALUES ('12', 'DIC', '1', '10000', '1', '', '0', 'viajes', '0');
