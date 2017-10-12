/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : shopapp

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2017-10-08 17:59:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(255) NOT NULL DEFAULT '' COMMENT '登录密码；sp_password加密',
  `user_nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '用户美名',
  `user_email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `user_url` varchar(100) NOT NULL DEFAULT '' COMMENT '用户个人网站',
  `token` varchar(200) DEFAULT NULL COMMENT '单点登录token',
  `avatar` varchar(255) DEFAULT NULL COMMENT '用户头像，相对于upload/avatar目录',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号',
  `remember_token` varchar(200) DEFAULT NULL,
  `forget` int(2) DEFAULT '1' COMMENT '0 禁止找回 1允许找回',
  `qq` bigint(20) DEFAULT NULL,
  `wechat` varchar(100) DEFAULT NULL,
  `sex` smallint(1) DEFAULT '0' COMMENT '性别；0：保密，1：男；2：女',
  `coin` int(11) DEFAULT '0' COMMENT '积分',
  `birthday` int(11) DEFAULT NULL COMMENT '生日',
  `signature` varchar(255) DEFAULT NULL COMMENT '个性签名',
  `last_login_ip` varchar(30) DEFAULT NULL COMMENT '最后登录ip',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nickname`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('10', '17603008613', '###1abf509edaf66d93aa7dffede84bb150', '高展', '827951152@qq.com', '', 'f406d667db1f5fd7b6fa14397aaeaa2a', null, '17603008613', null, '1', '827951152', '17603008613', '1', '11000', '697392000', '这个世界是恶意的', '0.0.0.0', '0000-00-00 00:00:00', null, '1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '权限名',
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限解释名称',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述与备注',
  `cid` tinyint(4) NOT NULL DEFAULT '0' COMMENT '级别',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标',
  `status` int(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', null, '后台用户管理', '', '0', '', '1', null, '2017-10-07 08:28:09');
INSERT INTO `permissions` VALUES ('2', 'role', '角色管理', '', '1', '', '1', null, '2017-10-07 08:27:38');
INSERT INTO `permissions` VALUES ('3', 'permission', '权限管理', '', '1', '', '1', null, null);
INSERT INTO `permissions` VALUES ('4', 'user', '管理员列表', '', '1', '', '1', null, null);
INSERT INTO `permissions` VALUES ('19', 'role.create', '角色添加', null, '2', null, '1', '2017-10-07 09:03:41', '2017-10-07 09:03:41');
INSERT INTO `permissions` VALUES ('20', 'role.edit', '角色修改', null, '2', null, '1', '2017-10-07 09:03:55', '2017-10-07 09:03:55');
INSERT INTO `permissions` VALUES ('21', 'role.destroy', '角色删除', null, '2', null, '1', '2017-10-07 09:04:15', '2017-10-07 09:04:15');
INSERT INTO `permissions` VALUES ('22', 'role.index', '角色查看', null, '2', null, '1', '2017-10-07 09:04:52', '2017-10-07 09:04:52');
INSERT INTO `permissions` VALUES ('23', 'permission.index', '权限查看', null, '3', null, '1', '2017-10-07 09:05:12', '2017-10-07 09:05:12');
INSERT INTO `permissions` VALUES ('24', 'permission.create', '权限添加', null, '3', null, '1', '2017-10-07 09:05:25', '2017-10-07 09:05:25');
INSERT INTO `permissions` VALUES ('25', 'permission.edit', '权限修改', null, '3', null, '1', '2017-10-07 09:05:44', '2017-10-07 09:05:44');
INSERT INTO `permissions` VALUES ('26', 'permission.destroy', '权限删除', null, '3', null, '1', '2017-10-07 09:06:00', '2017-10-07 09:06:00');
INSERT INTO `permissions` VALUES ('27', 'user.index', '管理员查看', null, '4', null, '1', '2017-10-07 09:06:21', '2017-10-07 09:06:21');
INSERT INTO `permissions` VALUES ('28', 'user.create', '管理员添加', null, '4', null, '1', '2017-10-07 09:06:33', '2017-10-07 09:06:33');
INSERT INTO `permissions` VALUES ('29', 'user.edit', '管理员修改', null, '4', null, '1', '2017-10-07 09:06:46', '2017-10-07 09:06:46');
INSERT INTO `permissions` VALUES ('30', 'user.destroy', '管理员删除', null, '4', null, '1', '2017-10-07 09:06:58', '2017-10-07 09:06:58');
INSERT INTO `permissions` VALUES ('31', 'index.index', '首页', '', '0', null, '1', '2017-10-08 02:31:13', '2017-10-08 02:31:54');
INSERT INTO `permissions` VALUES ('32', null, '产品管理', null, '0', null, '1', '2017-10-08 03:26:46', '2017-10-08 03:26:46');
INSERT INTO `permissions` VALUES ('33', 'category.index', '产品栏目', null, '32', null, '1', '2017-10-08 03:27:06', '2017-10-08 03:27:06');
INSERT INTO `permissions` VALUES ('34', 'good.index', '产品列表', null, '32', null, '1', '2017-10-08 03:27:30', '2017-10-08 03:27:30');
INSERT INTO `permissions` VALUES ('36', 'cagetory.create', '栏目添加', null, '33', null, '1', '2017-10-08 03:28:00', '2017-10-08 03:28:00');
INSERT INTO `permissions` VALUES ('37', 'cagetory.edit', '栏目修改', null, '33', null, '1', '2017-10-08 03:28:14', '2017-10-08 03:28:14');
INSERT INTO `permissions` VALUES ('38', 'cagetory.destroy', '栏目删除', null, '33', null, '1', '2017-10-08 03:28:28', '2017-10-08 03:28:28');
INSERT INTO `permissions` VALUES ('39', 'good.create', '产品添加', null, '34', null, '1', '2017-10-08 03:28:47', '2017-10-08 03:28:47');
INSERT INTO `permissions` VALUES ('40', 'good.edit', '产品修改', null, '34', null, '1', '2017-10-08 03:29:00', '2017-10-08 03:29:00');
INSERT INTO `permissions` VALUES ('41', 'good.destroy', '产品删除', null, '34', null, '1', '2017-10-08 03:29:13', '2017-10-08 03:29:13');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '17');
INSERT INTO `permission_role` VALUES ('2', '17');
INSERT INTO `permission_role` VALUES ('19', '17');
INSERT INTO `permission_role` VALUES ('20', '17');
INSERT INTO `permission_role` VALUES ('21', '17');
INSERT INTO `permission_role` VALUES ('22', '17');
INSERT INTO `permission_role` VALUES ('3', '17');
INSERT INTO `permission_role` VALUES ('23', '17');
INSERT INTO `permission_role` VALUES ('24', '17');
INSERT INTO `permission_role` VALUES ('25', '17');
INSERT INTO `permission_role` VALUES ('26', '17');
INSERT INTO `permission_role` VALUES ('4', '17');
INSERT INTO `permission_role` VALUES ('27', '17');
INSERT INTO `permission_role` VALUES ('28', '17');
INSERT INTO `permission_role` VALUES ('29', '17');
INSERT INTO `permission_role` VALUES ('30', '17');
INSERT INTO `permission_role` VALUES ('31', '17');
INSERT INTO `permission_role` VALUES ('2', '18');
INSERT INTO `permission_role` VALUES ('19', '18');
INSERT INTO `permission_role` VALUES ('20', '18');
INSERT INTO `permission_role` VALUES ('21', '18');
INSERT INTO `permission_role` VALUES ('22', '18');
INSERT INTO `permission_role` VALUES ('31', '18');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名称',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `status` int(2) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('17', '系统管理员', null, '1', '2017-10-08 02:59:41', '2017-10-08 02:59:41');
INSERT INTO `roles` VALUES ('18', '角色管理员', null, '1', '2017-10-08 03:25:06', '2017-10-08 03:25:06');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('17', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '高展', 'admin', '827951152@qq.com', '17603008613', '$2y$10$.0YhTjvoz8CMbu6RzIUg9eM6ZTHYJ7tspL4uEcgj2DAPJHwpPC/jG', '', '1', null, '2017-10-08 03:00:44', '2017-10-08 03:13:56');
