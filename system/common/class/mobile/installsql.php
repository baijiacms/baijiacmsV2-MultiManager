<?php
// +----------------------------------------------------------------------
// | WE CAN DO IT JUST FREE
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
defined('SYSTEM_INSTALL_IN') or exit('Access Denied');
$sql = "
-- ----------------------------
-- Table structure for baijiacms_config
-- ----------------------------
DROP TABLE IF EXISTS `baijiacms_config`;
CREATE TABLE `baijiacms_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(100) NOT NULL COMMENT '配置名称',
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_config
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_store
-- ----------------------------
DROP TABLE IF EXISTS `baijiacms_store`;
CREATE TABLE `baijiacms_store` (
  `dburl` varchar(100) NOT NULL,
  `dbpwd` varchar(100) NOT NULL,
  `dbport` int(3) NOT NULL,
  `dbuser` varchar(30) NOT NULL,
  `dbname` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `disabled` int(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_store
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_user
-- ----------------------------
DROP TABLE IF EXISTS `baijiacms_user`;
CREATE TABLE `baijiacms_user` (
  `createtime` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `groupName` varchar(100) NOT NULL DEFAULT '',
  `is_admin` int(1) NOT NULL DEFAULT '0' COMMENT '1管理员0用户',
  `groupid` int(10) NOT NULL DEFAULT '0' COMMENT '用户组id',
  `username` varchar(50) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_user
-- ----------------------------
";
mysqld_batch($sql);
define('LOCK_TO_UPDATE', true);
require WEB_ROOT.'/system/modules/class/web/updatesql.php';
define('LOCK_TO_ADDONS_INSTALL', true);