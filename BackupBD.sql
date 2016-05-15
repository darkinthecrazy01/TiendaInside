/*
Navicat MySQL Data Transfer

Source Server         : Insite
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tienda_insite

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-10-21 20:50:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tblcategoria
-- ----------------------------
DROP TABLE IF EXISTS `tblcategoria`;
CREATE TABLE `tblcategoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `strDescripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblcategoria
-- ----------------------------
INSERT INTO `tblcategoria` VALUES ('1', 'Caballeros');
INSERT INTO `tblcategoria` VALUES ('2', 'Dama');
INSERT INTO `tblcategoria` VALUES ('3', 'Calzado');
INSERT INTO `tblcategoria` VALUES ('4', 'Accesorios');
INSERT INTO `tblcategoria` VALUES ('5', 'niños');

-- ----------------------------
-- Table structure for tblproducto
-- ----------------------------
DROP TABLE IF EXISTS `tblproducto`;
CREATE TABLE `tblproducto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(100) NOT NULL,
  `strSEO` varchar(100) NOT NULL,
  `dbPrecio` double NOT NULL,
  `intEstado` int(11) NOT NULL,
  `intCategoria` int(11) NOT NULL,
  `strImagen` varchar(50) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblproducto
-- ----------------------------
INSERT INTO `tblproducto` VALUES ('1', 'Blusa', '1', '99', '1', '2', 'images.jpg');
INSERT INTO `tblproducto` VALUES ('5', 'Camison', 'mdkf', '200', '1', '2', '');

-- ----------------------------
-- Table structure for tblusuario
-- ----------------------------
DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE `tblusuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `strNombre` varchar(50) NOT NULL,
  `strEmail` varchar(50) NOT NULL,
  `intActivo` int(11) NOT NULL,
  `strPassword` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblusuario
-- ----------------------------
INSERT INTO `tblusuario` VALUES ('1', 'hhja', 'jha', '1', 'jhjhs');
INSERT INTO `tblusuario` VALUES ('2', 'Alejandra Burciaga', 'chuky@gmail.com', '1', 'panda');
INSERT INTO `tblusuario` VALUES ('3', 'Alejandra Burciaga', 'chuky@gmail.com', '1', 'dhghdghgdhgd');
INSERT INTO `tblusuario` VALUES ('4', 'Alejandre Burciaga', 'chuky@gmail.com', '1', 'mana');
INSERT INTO `tblusuario` VALUES ('5', 'Manuel Palomera', 'maks_drako_@hotmail.com', '1', 'mitos');
INSERT INTO `tblusuario` VALUES ('6', 'Alejandra Burciaga', 'wkaz@hotmail.com', '1', 'Martes13');
