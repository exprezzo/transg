/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-04 15:22:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `system_catalogos`
-- ----------------------------
DROP TABLE IF EXISTS `system_catalogos`;
CREATE TABLE `system_catalogos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_modulo` int(11) DEFAULT NULL,
  `nombre` char(255) DEFAULT NULL,
  `controlador` char(255) DEFAULT NULL,
  `modelo` char(255) DEFAULT NULL,
  `tabla` char(255) DEFAULT NULL,
  `pk_tabla` char(255) DEFAULT 'id',
  `icono` char(255) DEFAULT NULL,
  `titulo_nuevo` char(255) DEFAULT NULL,
  `titulo_edicion` char(255) DEFAULT NULL,
  `titulo_busqueda` char(255) DEFAULT NULL,
  `msg_creado` char(255) DEFAULT NULL,
  `msg_actualizado` char(255) DEFAULT NULL,
  `pregunta_eliminar` char(255) DEFAULT NULL,
  `msg_eliminado` char(255) DEFAULT NULL,
  `msg_cambios` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_catalogos
-- ----------------------------
INSERT INTO `system_catalogos` VALUES ('18', '1', 'Usuarios', 'usuarios', 'Usuario', 'system_users', 'id', 'http://png.findicons.com/files/icons/2332/super_mono/64/user_card.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('31', '1', 'Configuracion', 'config', 'config', 'system_config', 'id', 'http://png.findicons.com/files/icons/2645/super_mono_3d/64/super_mono_3d_part2_65.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('32', '1', 'Modulos', 'modulos', 'Modulo', 'system_modulos', 'id', 'http://png.findicons.com/files/icons/1681/siena/48/puzzle_yellow.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('33', '1', 'Catalogos', 'catalogos', 'Catalogo', 'system_catalogos', 'id', 'http://png.findicons.com/files/icons/577/refresh_cl/48/windows_view_icon.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('36', '1', 'seguridad', 'seguridad', 'Seguridad', 'system_acl', 'id', 'http://png.findicons.com/files/icons/1035/human_o2/48/keepassx.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('40', '2', 'Usuarios', 'usuarios2', 'usuario', 'system_users', 'id', 'http://png.findicons.com/files/icons/1620/crystal_project/64/personal.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('42', '1', 'Roles', 'roles', 'rol', 'system_rol', 'id', 'http://png.findicons.com/files/icons/2332/super_mono/48/user_card.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('48', '2', 'Clientes', 'clientes', 'cliente', 'trans_cliente', 'id', 'http://png.findicons.com/files/icons/117/radium/48/user.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('49', '2', 'Choferes', 'choferes', 'chofer', 'trans_chofer', 'id', 'http://png.findicons.com/files/icons/180/urban_ppl/48/xp_ppl02.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('50', '2', 'Conceptos', 'conceptos', 'concepto', 'trans_concepto', 'id', 'http://png.findicons.com/files/icons/2165/office/48/marked_price.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('51', '2', 'Vehiculos', 'vehiculos', 'vehiculo', 'trans_vehiculo', 'id', 'http://png.findicons.com/files/icons/1789/large_business/48/trailer.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('52', '2', 'Cajas', 'cajas', 'caja', 'trans_caja', 'id', 'http://png.findicons.com/files/icons/2206/austerity/59/com_saurik_winterboard.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('53', '2', 'Viajes', 'viajes', 'viaje', 'trans_viaje', 'id', 'http://png.findicons.com/files/icons/52/cargo_boxes/48/shipping1.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('54', '2', 'Gastos de Viaje', 'gastosdeviaje', 'gastodeviaje', 'trans_viaje_gasto', 'id', '', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('55', '2', 'Series', 'series', 'serie', 'trans_serie', 'id', '', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('56', '2', 'Consumo', 'consumos', 'consumo', 'trans_consumo', 'id', 'http://png-1.findicons.com/files/icons/2448/wpzoom_developer/48/gas.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('57', '2', 'Gasto', 'gastos', 'gasto', 'trans_gasto', 'id', 'http://png.findicons.com/files/icons/1681/siena/48/currency_dollar_blue.png', '', '', '', '', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('58', '2', 'Tipo de Gasto', 'tipogastos', 'tipogasto', 'trans_tipo_gasto', 'id', 'http://png.findicons.com/files/icons/2254/munich/32/category.png', '', '', '', '', '', '', '', '');
