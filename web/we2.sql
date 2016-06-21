/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : 127.0.0.1:3306
Source Database       : we

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-06-21 09:15:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for we_menu
-- ----------------------------
DROP TABLE IF EXISTS `we_menu`;
CREATE TABLE `we_menu` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_main` varchar(255) DEFAULT NULL,
  `m_naem` varchar(255) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_public
-- ----------------------------
DROP TABLE IF EXISTS `we_public`;
CREATE TABLE `we_public` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(30) DEFAULT NULL,
  `p_type` varchar(30) DEFAULT NULL,
  `p_AppID` varchar(100) DEFAULT NULL,
  `p_AppSecret` varchar(100) DEFAULT NULL,
  `p_url` varchar(255) DEFAULT NULL,
  `p_token` varchar(100) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `p_state` int(1) DEFAULT NULL,
  `p_urlget` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_rule
-- ----------------------------
DROP TABLE IF EXISTS `we_rule`;
CREATE TABLE `we_rule` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_name` varchar(255) DEFAULT NULL,
  `r_keyword` varchar(255) DEFAULT NULL,
  `r_type` varchar(255) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `p_content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for we_user
-- ----------------------------
DROP TABLE IF EXISTS `we_user`;
CREATE TABLE `we_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(30) DEFAULT NULL,
  `u_pwd` char(32) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
