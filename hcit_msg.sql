/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50743
Source Host           : localhost:3306
Source Database       : hcit_msg

Target Server Type    : MYSQL
Target Server Version : 50743
File Encoding         : 65001

Date: 2024-07-16 14:36:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` char(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'root', '7b24afc8bc80e548d66c4e7ff72171c5', 'Hcit');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `poster` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `reply` text NOT NULL,
  `reply2` text NOT NULL,
  `mail` varchar(60) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `report` int(10) NOT NULL,
  `likes` int(10) NOT NULL,
  `step_on` int(10) NOT NULL,
  `is_private` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '2024-07-14 00:00:00', '李刚', '你好，我想请问一下计算机的基本组成是什么？', '它组成包括硬件系统和软件系统两大部分。', '好的好的，谢谢！', '123@qq.com', '192.168.0.1', '0', '2', '2', null);
INSERT INTO `comment` VALUES ('2', '2024-07-15 00:00:00', '王小利', '大家好。我是王小利。', '你好，我是王明很高兴认识你。', '', '456@qq.com', '192.168.0.1', '0', '1', '0', null);
INSERT INTO `comment` VALUES ('3', '2024-07-16 00:00:00', '小李', 'Hello,我是小李。', '你好啊', '', '789@qq.com', '::1', '0', '0', '0', '1');
INSERT INTO `comment` VALUES ('4', '2024-07-16 13:14:00', '张三', '我是张三李四的张，张三李四的三，很高兴认识大家。', '', '', '000@qq.com', '::1', '1', '0', '1', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` char(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Hcit');
