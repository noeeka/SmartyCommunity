/*
MySQL Data Transfer
Source Host: localhost
Source Database: smarty
Target Host: localhost
Target Database: smarty
Date: 2017/11/24 10:48:30
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
  `building` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `building` VALUES ('1', '001');
INSERT INTO `building` VALUES ('2', '1');
INSERT INTO `building` VALUES ('3', 'aaa');
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
INSERT INTO `room` VALUES ('21', '2', '2', '34aa');
INSERT INTO `room` VALUES ('22', '3', '3', '36aa');
INSERT INTO `setting` VALUES ('i-Life Style', '黄泉路129号', '022-23707788', 'root', 'root');
INSERT INTO `unity` VALUES ('1', '01', '1');
INSERT INTO `unity` VALUES ('2', '01', '2');
INSERT INTO `unity` VALUES ('3', '01', '3');
