/*
MySQL Data Transfer
Source Host: localhost
Source Database: smarty
Target Host: localhost
Target Database: smarty
Date: 2017/11/22 13:34:05
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for administrator
-- ----------------------------
DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for building
-- ----------------------------
DROP TABLE IF EXISTS `building`;
CREATE TABLE `building` (
  `id` int(32) NOT NULL auto_increment,
  `building` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for indoor
-- ----------------------------
DROP TABLE IF EXISTS `indoor`;
CREATE TABLE `indoor` (
  `id` int(32) NOT NULL auto_increment,
  `sip` int(32) default NULL,
  `name` varchar(50) default NULL,
  `room` varchar(50) default NULL,
  `building` varchar(50) default NULL,
  `unit` varchar(255) default NULL,
  `password` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for outdoor
-- ----------------------------
DROP TABLE IF EXISTS `outdoor`;
CREATE TABLE `outdoor` (
  `id` int(32) NOT NULL auto_increment,
  `building` int(32) default NULL,
  `unit` int(32) default NULL,
  `sip` varchar(50) default NULL,
  `name` varchar(50) character set utf8 collate utf8_unicode_ci default NULL,
  `password` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int(11) NOT NULL auto_increment,
  `building` int(11) default NULL,
  `unit` varchar(50) default NULL,
  `room` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `building` (`building`),
  KEY `unit` (`unit`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `project_name` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `tel` varchar(50) default NULL,
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for unity
-- ----------------------------
DROP TABLE IF EXISTS `unity`;
CREATE TABLE `unity` (
  `id` int(32) NOT NULL auto_increment,
  `unit` varchar(50) default NULL,
  `building` int(32) default NULL,
  PRIMARY KEY  (`id`),
  KEY `building` (`building`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `building` VALUES ('1', '1');
INSERT INTO `indoor` VALUES ('1', '0', '66', '7', '1', '1', '77');
INSERT INTO `indoor` VALUES ('2', '66', '55', '1', '1', '1', '55');
INSERT INTO `outdoor` VALUES ('1', '1', '2', '6001', '高欣', '123456');
INSERT INTO `outdoor` VALUES ('2', '2', '4', '44', '刘义', '333');
INSERT INTO `outdoor` VALUES ('3', '2', '4', '6001', '高欣', '123456');
INSERT INTO `outdoor` VALUES ('4', '0', '0', '5555', '555', '555');
INSERT INTO `outdoor` VALUES ('5', '0', '0', '555', '55', '55');
INSERT INTO `outdoor` VALUES ('6', '1', '1', '4444', '444', '5555');
INSERT INTO `room` VALUES ('1', '1', '1', '0101');
INSERT INTO `room` VALUES ('2', '1', '1', '0102');
INSERT INTO `room` VALUES ('3', '1', '1', '0201');
INSERT INTO `room` VALUES ('4', '1', '1', '0202');
INSERT INTO `room` VALUES ('5', '1', '1', '0301');
INSERT INTO `room` VALUES ('6', '1', '1', '0302');
INSERT INTO `room` VALUES ('7', '1', '1', '0401');
INSERT INTO `room` VALUES ('8', '1', '1', '0402');
INSERT INTO `room` VALUES ('9', '1', '1', '0501');
INSERT INTO `room` VALUES ('10', '1', '1', '0502');
INSERT INTO `room` VALUES ('11', '1', '1', '0601');
INSERT INTO `room` VALUES ('12', '1', '1', '0602');
INSERT INTO `room` VALUES ('13', '1', '1', '0701');
INSERT INTO `room` VALUES ('14', '1', '1', '0702');
INSERT INTO `room` VALUES ('15', '1', '1', '0801');
INSERT INTO `room` VALUES ('16', '1', '1', '0802');
INSERT INTO `room` VALUES ('17', '1', '1', '0901');
INSERT INTO `room` VALUES ('18', '1', '1', '0902');
INSERT INTO `room` VALUES ('19', '1', '1', '1001');
INSERT INTO `room` VALUES ('20', '1', '1', '1002');
INSERT INTO `room` VALUES ('21', '1', '1', '1101');
INSERT INTO `room` VALUES ('22', '1', '1', '1102');
INSERT INTO `room` VALUES ('23', '1', '1', '1201');
INSERT INTO `room` VALUES ('24', '1', '1', '1202');
INSERT INTO `room` VALUES ('25', '1', '1', '1301');
INSERT INTO `room` VALUES ('26', '1', '1', '1302');
INSERT INTO `room` VALUES ('27', '1', '1', '1401');
INSERT INTO `room` VALUES ('28', '1', '1', '1402');
INSERT INTO `room` VALUES ('29', '1', '1', '1501');
INSERT INTO `room` VALUES ('30', '1', '1', '1502');
INSERT INTO `room` VALUES ('31', '1', '1', '1601');
INSERT INTO `room` VALUES ('32', '1', '1', '1602');
INSERT INTO `room` VALUES ('33', '1', '1', '1701');
INSERT INTO `room` VALUES ('34', '1', '1', '1702');
INSERT INTO `room` VALUES ('35', '1', '1', '1801');
INSERT INTO `room` VALUES ('36', '1', '1', '1802');
INSERT INTO `room` VALUES ('37', '1', '1', '1901');
INSERT INTO `room` VALUES ('38', '1', '1', '1902');
INSERT INTO `room` VALUES ('39', '1', '1', '2001');
INSERT INTO `room` VALUES ('40', '1', '1', '2002');
INSERT INTO `room` VALUES ('41', '1', '1', '2101');
INSERT INTO `room` VALUES ('42', '1', '1', '2102');
INSERT INTO `room` VALUES ('43', '1', '1', '2201');
INSERT INTO `room` VALUES ('44', '1', '1', '2202');
INSERT INTO `room` VALUES ('45', '1', '1', '2301');
INSERT INTO `room` VALUES ('46', '1', '1', '2302');
INSERT INTO `room` VALUES ('47', '1', '1', '2401');
INSERT INTO `room` VALUES ('48', '1', '1', '2402');
INSERT INTO `room` VALUES ('49', '1', '1', '2501');
INSERT INTO `room` VALUES ('50', '1', '1', '2502');
INSERT INTO `room` VALUES ('51', '1', '1', '2601');
INSERT INTO `room` VALUES ('52', '1', '1', '2602');
INSERT INTO `room` VALUES ('53', '1', '1', '2701');
INSERT INTO `room` VALUES ('54', '1', '1', '2702');
INSERT INTO `room` VALUES ('55', '1', '1', '2801');
INSERT INTO `room` VALUES ('56', '1', '1', '2802');
INSERT INTO `room` VALUES ('57', '1', '1', '2901');
INSERT INTO `room` VALUES ('58', '1', '1', '2902');
INSERT INTO `room` VALUES ('59', '1', '1', '3001');
INSERT INTO `room` VALUES ('60', '1', '1', '3002');
INSERT INTO `setting` VALUES ('i-Life Style', '黄泉路129号', '022-23707788', 'root', 'root');
INSERT INTO `unity` VALUES ('1', '01', '1');
