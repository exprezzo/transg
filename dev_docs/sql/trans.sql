/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : trans

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-06-01 18:10:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `system_acl`
-- ----------------------------
DROP TABLE IF EXISTS `system_acl`;
CREATE TABLE `system_acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) DEFAULT NULL,
  `modulo` char(255) DEFAULT NULL,
  `controlador` char(255) DEFAULT NULL,
  `accion` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_acl
-- ----------------------------
INSERT INTO `system_acl` VALUES ('2', '0', 'asdf', 'asdf', 'asfd');
INSERT INTO `system_acl` VALUES ('3', '2', '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

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

-- ----------------------------
-- Table structure for `system_config`
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) DEFAULT NULL,
  `tema` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_config
-- ----------------------------
INSERT INTO `system_config` VALUES ('1', '1', 'artic');
INSERT INTO `system_config` VALUES ('2', '20', 'artic');

-- ----------------------------
-- Table structure for `system_modulos`
-- ----------------------------
DROP TABLE IF EXISTS `system_modulos`;
CREATE TABLE `system_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `icono` char(255) DEFAULT NULL,
  `nombre_interno` char(255) DEFAULT NULL,
  `ruta_base` char(255) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_modulos
-- ----------------------------
INSERT INTO `system_modulos` VALUES ('1', 'Sistema', 'http://png.findicons.com/files/icons/1681/siena/48/puzzle_yellow.png', 'backend', '/modulos/', '0');
INSERT INTO `system_modulos` VALUES ('2', 'Transportes Guerrero', 'http://png-1.findicons.com/files/icons/2003/business/64/shopping_full.png', 'portal', '/', '0');

-- ----------------------------
-- Table structure for `system_rol`
-- ----------------------------
DROP TABLE IF EXISTS `system_rol`;
CREATE TABLE `system_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_rol
-- ----------------------------
INSERT INTO `system_rol` VALUES ('1', 'Super Admin');
INSERT INTO `system_rol` VALUES ('2', 'System Admin');
INSERT INTO `system_rol` VALUES ('3', 'Gerente');
INSERT INTO `system_rol` VALUES ('4', 'Almacenista');

-- ----------------------------
-- Table structure for `system_users`
-- ----------------------------
DROP TABLE IF EXISTS `system_users`;
CREATE TABLE `system_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` char(255) NOT NULL,
  `pass` blob,
  `email` char(255) NOT NULL,
  `rol` int(11) DEFAULT '1',
  `fbid` int(11) DEFAULT NULL,
  `name` char(255) NOT NULL DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `originalName` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_users
-- ----------------------------
INSERT INTO `system_users` VALUES ('1', 'zesar1', 0xABD7D98E5D348AB50FACBA163A26D398, 'cbibriesca@hotmail.com', '1', '0', 'Zesar Octavio s', 'pic_1.jpg', 'retro_blue_background.jpg');
INSERT INTO `system_users` VALUES ('22', 'jose', 0xABD7D98E5D348AB50FACBA163A26D398, 'contacto@joseh.com', '1', null, 'JosÃ© Hernandez Olvera', null, null);

-- ----------------------------
-- Table structure for `trans_caja`
-- ----------------------------
DROP TABLE IF EXISTS `trans_caja`;
CREATE TABLE `trans_caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` char(255) DEFAULT NULL,
  `codigo` char(255) DEFAULT NULL,
  `horas_de_trabajo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_caja
-- ----------------------------
INSERT INTO `trans_caja` VALUES ('1', 'MOD-F540', 'c-501', '5000');
INSERT INTO `trans_caja` VALUES ('2', '', 'c-502', '0');
INSERT INTO `trans_caja` VALUES ('3', '', 'c-503', '0');
INSERT INTO `trans_caja` VALUES ('4', '', 'c-504', '0');

-- ----------------------------
-- Table structure for `trans_chofer`
-- ----------------------------
DROP TABLE IF EXISTS `trans_chofer`;
CREATE TABLE `trans_chofer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `nss` char(255) DEFAULT NULL,
  `telefonos` char(255) DEFAULT NULL,
  `cuenta_bancaria` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_chofer
-- ----------------------------
INSERT INTO `trans_chofer` VALUES ('4', 'Juan Ramon', '', '', '');
INSERT INTO `trans_chofer` VALUES ('5', 'Oscar', '', '', '');
INSERT INTO `trans_chofer` VALUES ('6', 'Cesar Octavio', '', '', '');
INSERT INTO `trans_chofer` VALUES ('7', 'Otro chofer', '', '', 'asd');
INSERT INTO `trans_chofer` VALUES ('8', 'un nuevo chofer', '', '', '');
INSERT INTO `trans_chofer` VALUES ('9', 'y otro mas...', '', '', '');

-- ----------------------------
-- Table structure for `trans_cliente`
-- ----------------------------
DROP TABLE IF EXISTS `trans_cliente`;
CREATE TABLE `trans_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` char(255) DEFAULT NULL,
  `rfc` char(15) DEFAULT NULL,
  `direccion` char(255) DEFAULT NULL,
  `telefonos` char(255) DEFAULT NULL,
  `www` char(255) DEFAULT NULL,
  `contacto` char(255) DEFAULT NULL,
  `cuenta_bancaria` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_cliente
-- ----------------------------
INSERT INTO `trans_cliente` VALUES ('3', 'otro clientehh', '', '', '', '', '', '');
INSERT INTO `trans_cliente` VALUES ('4', 'aa', '', '', '', '', '', '');
INSERT INTO `trans_cliente` VALUES ('5', 'bbbb', '', 'asd', '', '', '', '');
INSERT INTO `trans_cliente` VALUES ('6', 'cccc', '', '', '', '', '', '');
INSERT INTO `trans_cliente` VALUES ('7', 'Soriana', '', '', '', '', '', '');
INSERT INTO `trans_cliente` VALUES ('8', 'Wall Mart', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `trans_concepto`
-- ----------------------------
DROP TABLE IF EXISTS `trans_concepto`;
CREATE TABLE `trans_concepto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `costo` decimal(18,6) DEFAULT NULL,
  `nombre_um` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_concepto
-- ----------------------------
INSERT INTO `trans_concepto` VALUES ('4', 'diesel', '0.000000', '');
INSERT INTO `trans_concepto` VALUES ('5', 'caseta', '250.000000', '');
INSERT INTO `trans_concepto` VALUES ('6', 'mordida de federal', '1000.000000', '');
INSERT INTO `trans_concepto` VALUES ('7', 'reparaciones', '0.000000', 'asd');
INSERT INTO `trans_concepto` VALUES ('8', 'viaticos', '0.000000', '');
INSERT INTO `trans_concepto` VALUES ('9', 'asdf', '0.000000', '');
INSERT INTO `trans_concepto` VALUES ('10', 'diesel Almacen', '100.000000', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_serie
-- ----------------------------
INSERT INTO `trans_serie` VALUES ('7', 'MAY', '1', '10000', '91', '', '0', 'viajes', '0');

-- ----------------------------
-- Table structure for `trans_vehiculo`
-- ----------------------------
DROP TABLE IF EXISTS `trans_vehiculo`;
CREATE TABLE `trans_vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` char(255) DEFAULT NULL,
  `codigo` char(255) DEFAULT NULL,
  `placas` char(255) DEFAULT NULL,
  `rendimiento` decimal(18,2) DEFAULT NULL,
  `fk_caja` int(11) DEFAULT NULL,
  `kilometraje` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_vehiculo
-- ----------------------------
INSERT INTO `trans_vehiculo` VALUES ('3', 'asdf', 'T-501', 'asdfd', '0.00', '1', '1');
INSERT INTO `trans_vehiculo` VALUES ('4', '', 'T-502', '', '0.00', '2', '0');
INSERT INTO `trans_vehiculo` VALUES ('5', '', 'T-503', '', '0.00', '3', '2344234');
INSERT INTO `trans_vehiculo` VALUES ('6', '', 'sd', '', '0.00', '1', '0');

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

-- ----------------------------
-- Table structure for `trans_viaje_gasto`
-- ----------------------------
DROP TABLE IF EXISTS `trans_viaje_gasto`;
CREATE TABLE `trans_viaje_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_viaje` int(11) DEFAULT NULL,
  `fk_concepto` int(11) DEFAULT NULL,
  `costo` decimal(18,6) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trans_viaje_gasto
-- ----------------------------
INSERT INTO `trans_viaje_gasto` VALUES ('73', '103', '7', '12.000000', '2013-06-01 00:00:00');
