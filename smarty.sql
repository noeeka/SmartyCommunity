/*
MySQL Data Transfer
Source Host: localhost
Source Database: smarty
Target Host: localhost
Target Database: smarty
Date: 2017/11/10 18:16:21
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for building
-- ----------------------------
DROP TABLE IF EXISTS `building`;
CREATE TABLE `building` (
  `id` int(32) NOT NULL auto_increment,
  `building` int(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for indoor
-- ----------------------------
DROP TABLE IF EXISTS `indoor`;
CREATE TABLE `indoor` (
  `id` int(32) NOT NULL auto_increment,
  `sip` int(32) default NULL,
  `name` varchar(50) default NULL,
  `room` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for outdoor
-- ----------------------------
DROP TABLE IF EXISTS `outdoor`;
CREATE TABLE `outdoor` (
  `id` int(32) NOT NULL auto_increment,
  `sip` int(32) default NULL,
  `name` varchar(50) default NULL,
  `unit` varchar(50) default NULL,
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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `setting` VALUES ('智慧云社区', '黄泉路129号', '022-23708235', 'root', 'root');
