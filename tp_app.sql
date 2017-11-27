/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp_app

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-27 18:29:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_active
-- ----------------------------
DROP TABLE IF EXISTS `app_active`;
CREATE TABLE `app_active` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` int(8) unsigned NOT NULL DEFAULT '0',
  `app_type` varchar(20) NOT NULL DEFAULT '',
  `version_code` varchar(10) NOT NULL DEFAULT '',
  `did` varchar(100) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_active
-- ----------------------------

-- ----------------------------
-- Table structure for app_admin_users
-- ----------------------------
DROP TABLE IF EXISTS `app_admin_users`;
CREATE TABLE `app_admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(59) NOT NULL COMMENT '密码',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '0' COMMENT '最后登录的ip地址',
  `listorder` int(8) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录的时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `username` (`username`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_admin_users
-- ----------------------------
INSERT INTO `app_admin_users` VALUES ('1', 'admin', '15da5b87fbda7ab1a95e471a1247abce', '127.0.0.1', '0', '1', '1509623714', '1510220130', '1510220130');
INSERT INTO `app_admin_users` VALUES ('2', 'wudean', '15da5b87fbda7ab1a95e471a1247abce', '0', '0', '1', '1509623785', '1509623785', '0');

-- ----------------------------
-- Table structure for app_news
-- ----------------------------
DROP TABLE IF EXISTS `app_news`;
CREATE TABLE `app_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `small_title` varchar(20) NOT NULL DEFAULT '' COMMENT '短标题',
  `catid` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '栏目',
  `image` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `description` varchar(200) NOT NULL,
  `is_position` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐',
  `is_head_figure` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页推荐',
  `is_allowcomments` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否允许评论',
  `listorder` int(8) NOT NULL,
  `source_type` tinyint(1) DEFAULT '0' COMMENT '来源',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `read_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  `upvote_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支持数量',
  `comment_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `create_time` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_news
-- ----------------------------
INSERT INTO `app_news` VALUES ('1', '1111', '1', '2', '', '<p>asdfasdfasdfasdf</p>', 'asdfasdf', '0', '0', '0', '0', '0', '1510122737', '1510141958', '1', '0', '0', '0');
INSERT INTO `app_news` VALUES ('2', '2222', '2', '2', '', '<p>adsfasdf<br/></p>', 'adfasdf', '1', '0', '0', '0', '0', '1510122838', '1510122838', '1', '0', '0', '0');
INSERT INTO `app_news` VALUES ('3', '3333', '3', '1', '', '<p>asdfadsfsadf</p>', 'asdfasdf', '0', '1', '0', '0', '0', '1510122848', '1510122848', '1', '6', '0', '0');
INSERT INTO `app_news` VALUES ('4', '4444', '4', '3', '', '<p>asdfasdfasdf</p>', 'adfadfadf', '1', '0', '0', '0', '0', '1510122858', '1510122858', '1', '0', '0', '0');
INSERT INTO `app_news` VALUES ('5', '5555', '5', '4', '', '<p>adsfasdasdfasdf</p>', 'asdfasdf', '0', '0', '0', '0', '0', '1510122869', '1510142441', '1', '0', '0', '0');
INSERT INTO `app_news` VALUES ('6', '6666', '6', '1', '', '<p>asdfasdf</p>', 'fasdfasdfasdf', '1', '0', '0', '0', '0', '1510122882', '1510142449', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for app_version
-- ----------------------------
DROP TABLE IF EXISTS `app_version`;
CREATE TABLE `app_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_type` varchar(20) NOT NULL DEFAULT '' COMMENT 'app类型 比如 ios android',
  `version` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '内部版本号',
  `version_code` varchar(20) NOT NULL DEFAULT '' COMMENT '外部版本号比如1.2.3',
  `is_force` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否强制更新0不，1强制更新',
  `apk_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'apk最新地址',
  `upgrade_point` varchar(500) NOT NULL DEFAULT '' COMMENT '升级提示',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of app_version
-- ----------------------------
