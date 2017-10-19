/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shopapp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-10-18 18:03:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `good_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `good_sn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `good_image_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `good_price` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT '1',
  `good_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES ('2', '1', '1', '12', 'Iphone X', '00001', null, '8999', '1', null, '2017-10-18 16:33:49', '2017-10-18 16:33:49');
INSERT INTO `carts` VALUES ('3', '2', '1', '12', '产品名称9', '9', null, '9', '4', null, '2017-10-18 16:53:03', '2017-10-18 16:53:19');

-- ----------------------------
-- Table structure for categorys
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categorys
-- ----------------------------
INSERT INTO `categorys` VALUES ('1', '0', '数码', '数码产品栏目分类', null, '0', '1', null, null);
INSERT INTO `categorys` VALUES ('2', '0', '食品', '食物类', null, '1', '1', null, null);
INSERT INTO `categorys` VALUES ('3', '1', '手机', '手机栏目', null, '0', '1', null, null);
INSERT INTO `categorys` VALUES ('4', '3', '苹果', '苹果手机', null, '0', '1', null, null);
INSERT INTO `categorys` VALUES ('5', '3', '魅族', '魅族手机', null, '0', '1', null, null);

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `deliver_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `top` int(11) DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT '1',
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12452 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '1', null, null, 'Iphone X', '00001', null, '1', '100', '1', 'iphone 十周年纪念版', '<h1>详情</h1>', '1', '1', '1', '1', null, null);
INSERT INTO `goods` VALUES ('2', '1', null, null, 'Iphone 8', '00002', '', '5688', '100', '1', 'iphone 8代', '<h1>详情</h1>', '1', '1', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `goods` VALUES ('3', '1', null, null, '产品名称0', '0', null, '0', '100', '821', '产品描述0', null, null, null, '0', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('4', '1', null, null, '产品名称1', '1', null, '1', '100', '900', '产品描述1', null, null, null, '1', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('5', '1', null, null, '产品名称2', '2', null, '2', '100', '257', '产品描述2', null, null, null, '2', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('6', '1', null, null, '产品名称3', '3', null, '3', '100', '954', '产品描述3', null, null, null, '3', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('7', '1', null, null, '产品名称4', '4', null, '4', '100', '609', '产品描述4', null, null, null, '4', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('8', '1', null, null, '产品名称5', '5', null, '5', '100', '565', '产品描述5', null, null, null, '5', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('9', '1', null, null, '产品名称6', '6', null, '6', '100', '939', '产品描述6', null, null, null, '6', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('10', '1', null, null, '产品名称7', '7', null, '7', '100', '426', '产品描述7', null, null, null, '7', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('11', '1', null, null, '产品名称8', '8', null, '8', '100', '193', '产品描述8', null, null, null, '8', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('12', '1', null, null, '产品名称9', '9', null, '9', '100', '2', '产品描述9', null, null, null, '9', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('13', '1', null, null, '产品名称10', '10', null, '10', '100', '970', '产品描述10', null, null, null, '10', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('14', '1', null, null, '产品名称11', '11', null, '11', '100', '894', '产品描述11', null, null, null, '11', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('15', '1', null, null, '产品名称12', '12', null, '12', '100', '478', '产品描述12', null, null, null, '12', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
INSERT INTO `goods` VALUES ('16', '1', null, null, '产品名称13', '13', null, '13', '100', '735', '产品描述13', null, null, null, '13', '1', '2017-10-17 19:55:44', '2017-10-17 19:55:44');
-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '登录密码；sp_password加密',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES ('12', '17603008613', '$2y$10$8nSxcdTMyOrsV0.PDaaJ2O8TDsk3BQj45XQfF6gGR.puQ8RtXxdvO', '', '827951152@qq.com', '', null, null, '', null, '1', null, null, '0', '0', null, null, null, '2017-10-15 04:22:14', '2017-10-15 04:22:14', '1');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2017_10_13_071347_create_categories_table', '1');
INSERT INTO `migrations` VALUES ('2', '2017_10_13_071709_create_goods_table', '1');

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
INSERT INTO `permission_role` VALUES ('32', '17');
INSERT INTO `permission_role` VALUES ('33', '17');
INSERT INTO `permission_role` VALUES ('36', '17');
INSERT INTO `permission_role` VALUES ('37', '17');
INSERT INTO `permission_role` VALUES ('38', '17');
INSERT INTO `permission_role` VALUES ('34', '17');
INSERT INTO `permission_role` VALUES ('39', '17');
INSERT INTO `permission_role` VALUES ('40', '17');
INSERT INTO `permission_role` VALUES ('41', '17');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '高展', 'admin', '827951152@qq.com', '17603008613', '$2y$10$.0YhTjvoz8CMbu6RzIUg9eM6ZTHYJ7tspL4uEcgj2DAPJHwpPC/jG', '', '1', null, '2017-10-08 03:00:44', '2017-10-08 03:13:56');

-- ----------------------------
-- Table structure for member_addresses
-- ----------------------------
DROP TABLE IF EXISTS `member_addresses`;
CREATE TABLE `member_addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `alias` varchar(50) DEFAULT NULL COMMENT '地址别名',
  `region` int(11) DEFAULT NULL COMMENT '地区码',
  `region_name` varchar(255) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL COMMENT '地址',
  `postcodes` varchar(20) DEFAULT NULL COMMENT '邮政编码',
  `description` text,
  `mobile` varchar(100) DEFAULT '' COMMENT '电话',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_default` int(2) DEFAULT '0' COMMENT '默认地址',
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `userid` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member_addresses
-- ----------------------------
INSERT INTO `member_addresses` VALUES ('1', '12', '高展', '老家', '25500', null, '盘滩村七组', '518000', '乡下老家', '17603008613', null, '2017-10-19 14:03:26', '1', '1');
INSERT INTO `member_addresses` VALUES ('31', '12', '高展', 'Home', '25491', null, '翰林公馆2栋703', '518000', '', '17603008613', null, '2017-10-19 09:09:15', '0', '1');
INSERT INTO `member_addresses` VALUES ('40', '12', 'gaozhan', '', '1', null, 'address', '', '', '1222', '2017-10-19 10:19:44', '2017-10-19 10:19:44', null, '1');
INSERT INTO `member_addresses` VALUES ('41', '12', 'gaozhan', '', '1', null, 'address', '', '', '1222', '2017-10-19 10:23:18', '2017-10-19 10:23:18', null, '1');
INSERT INTO `member_addresses` VALUES ('42', '12', '', '', '1', null, 'address', '', '', '1222', '2017-10-19 10:23:57', '2017-10-19 10:23:57', null, '1');
INSERT INTO `member_addresses` VALUES ('43', '12', 'gaozhan', '', '1', null, 'address', '', '', '1222', '2017-10-19 10:24:35', '2017-10-19 10:24:35', null, '1');
INSERT INTO `member_addresses` VALUES ('39', '20', '陈璇', '', '29873', '广东省东莞市黄江镇', '棕榈泉', '', '', '18758411206', null, null, '0', '1');
