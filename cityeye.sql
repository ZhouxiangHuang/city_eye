/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50718
 Source Host           : localhost
 Source Database       : caoshunke

 Target Server Type    : MySQL
 Target Server Version : 50718
 File Encoding         : utf-8

 Date: 09/07/2017 18:21:16 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `city_administrator`
-- ----------------------------
DROP TABLE IF EXISTS `city_administrator`;
CREATE TABLE `city_administrator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(22) NOT NULL COMMENT '管理员登录帐号',
  `password` char(64) NOT NULL COMMENT '管理员密码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账户状态（1，正常，0，锁定）',
  `realname` varchar(50) NOT NULL COMMENT '管理员真实姓名',
  `phone` varchar(50) NOT NULL COMMENT '管理员联系电话',
  `nickname` varchar(50) NOT NULL COMMENT '管理员昵称',
  `lasttime` int(10) unsigned NOT NULL COMMENT '最后一次登录时间戳',
  `lastip` varchar(200) NOT NULL COMMENT '最后一次登录IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
--  Records of `city_administrator`
-- ----------------------------
BEGIN;
INSERT INTO `city_administrator` VALUES ('1', 'admin', '1da68df173cdbffa60b036e10b357694', '1', 'admin', '18236197061', 'admin', '1504345115', '127.0.0.1'), ('2', '11111', '36738f0dd6c6d37147189f2de6fe986e', '1', '11111', '18273999182', '11111', '0', '');
COMMIT;

-- ----------------------------
--  Table structure for `city_area_new`
-- ----------------------------
DROP TABLE IF EXISTS `city_area_new`;
CREATE TABLE `city_area_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) NOT NULL COMMENT '地区名称',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2停用',
  `city_name_hun` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `city_area_new`
-- ----------------------------
BEGIN;
INSERT INTO `city_area_new` VALUES ('1', '八里铺', '0', '0', '1', '123123');
COMMIT;

-- ----------------------------
--  Table structure for `city_article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `city_article_cate`;
CREATE TABLE `city_article_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `cate_name` varchar(32) DEFAULT NULL COMMENT '名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '父级',
  `orderby` tinyint(3) DEFAULT '100' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常2禁用',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
--  Records of `city_article_cate`
-- ----------------------------
BEGIN;
INSERT INTO `city_article_cate` VALUES ('1', '京东', '0', '100', '1'), ('2', '手机', '1', '100', '1'), ('3', '天猫', '0', '100', '1'), ('4', '坚果', '3', '100', '1');
COMMIT;

-- ----------------------------
--  Table structure for `city_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `city_auth_group`;
CREATE TABLE `city_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '角色名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '角色状态（1，可用，0，不可用）',
  `rules` varchar(1000) NOT NULL DEFAULT '' COMMENT '角色功能id（1,2,3）',
  `description` varchar(500) DEFAULT NULL COMMENT '角色描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理角色表（管理用户组）';

-- ----------------------------
--  Records of `city_auth_group`
-- ----------------------------
BEGIN;
INSERT INTO `city_auth_group` VALUES ('1', '超级管理员', '1', '', null);
COMMIT;

-- ----------------------------
--  Table structure for `city_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `city_auth_group_access`;
CREATE TABLE `city_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '管理员ID',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '角色ID',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员角色映射表';

-- ----------------------------
--  Records of `city_auth_group_access`
-- ----------------------------
BEGIN;
INSERT INTO `city_auth_group_access` VALUES ('1', '1'), ('2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `city_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `city_auth_rule`;
CREATE TABLE `city_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '' COMMENT '模块，规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则名称',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（1，正常，0，不可用·）',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '附件条件',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '归属上级ID（本表ID）',
  `navtype` tinyint(4) NOT NULL DEFAULT '1' COMMENT '导航分级（0，链接导航，2多级导航，1，不是导航）',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序号',
  `icon` varchar(500) DEFAULT NULL COMMENT '功能对应图标代码',
  `module` varchar(100) DEFAULT NULL COMMENT '模型',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
--  Records of `city_auth_rule`
-- ----------------------------
BEGIN;
INSERT INTO `city_auth_rule` VALUES ('1', 'Admini/Index/main', '后台首页', '1', '1', '', '0', '0', '0', 'fa fa-tasks', 'Admini'), ('2', 'Admini/User/userList', '管理员列表', '1', '1', '', '4', '2', '0', 'fa fa-clone', 'Admini'), ('3', 'Admini/Index/editwebconfig', '修改网站信息', '1', '1', '', '0', '1', '55', 'fa fa-clone', 'Admini'), ('4', 'Admini/Auth/index1', '权限管理', '1', '1', '', '0', '2', '19', 'fa fa-clone', 'Admini'), ('5', 'Admini/Auth/getgroups', '角色列表', '1', '1', '', '4', '2', '0', 'fa fa-clone', 'Admini'), ('6', 'Admini/Index/updatePersonalInfo', '修改个人信息', '1', '1', '', '0', '1', '55', 'fa fa-clone', 'Admini'), ('7', 'Admini/Auth/index', '权限节点列表', '1', '1', '', '4', '2', '0', 'fa fa-clone', 'Admini'), ('87', 'Admini/UserInfo/index', '用户列表', '1', '2', '', '0', '0', '13', 'fa fa-clone', 'Admini'), ('84', 'Admini/User/editAdminiStatus', '修改管理员状态', '1', '1', '', '4', '1', '0', 'fa fa-clone', 'Admini'), ('10', 'Admini/Auth/do_rulestatus', '修改节点功能', '1', '1', '', '4', '1', '0', 'fa fa-clone', 'Admini'), ('11', 'Admini/Homepage/leftMenu', '左侧菜单', '1', '1', '', '1', '1', '0', 'fa fa-clone', 'Admini'), ('12', 'Admini/Index/index', '主页', '1', '1', '', '0', '1', '55', 'fa fa-clone', 'Admini'), ('85', 'Admini/User/editUser', '增/删/改管理员信息', '1', '1', '', '4', '1', '0', 'fa fa-clone', 'Admini'), ('86', 'Admini/User/delUser', '删除管理员', '1', '1', '', '4', '1', '0', 'fa fa-clone', 'Admini'), ('94', 'Admini/Log/logList', '系统日志管理', '1', '1', '', '0', '0', '15', 'fa fa-clone', 'Admini'), ('95', 'Admini/UserInfo/editUserStatus', '修改用户状态', '1', '1', '', '87', '1', '0', 'fa fa-clone', 'Admini'), ('96', 'Admini/UserInfo/addUserInfo', '添加用户', '1', '1', '', '87', '1', '0', 'fa fa-clone', 'Admini'), ('98', 'Admini/Log/delLog', '删除日志', '1', '1', '', '94', '1', '0', 'fa fa-clone', 'Admini'), ('108', 'Admini/User/editUserPassword', '修改管理员密码', '1', '1', '', '4', '1', '0', 'fa fa-clone', 'Admini'), ('149', 'Admini/AreaNew/delete', '删除地区', '1', '1', '', '120', '1', '0', 'fa fa-clone', 'Admini'), ('116', 'Admini/UserInfo/updateUserInfo', '修改用户信息', '1', '1', '', '87', '1', '0', 'fa fa-clone', 'Admini'), ('117', 'Admini/UserInfo/delete', '删除用户信息', '1', '1', '', '87', '1', '0', 'fa fa-clone', 'Admini'), ('150', 'Admini/AreaNew/add', '添加地区', '1', '1', '', '120', '1', '0', 'fa fa-clone', 'Admini'), ('151', 'Admini/AreaNew/update', '修改地区', '1', '1', '', '120', '1', '0', 'fa fa-clone', 'Admini'), ('120', 'Admini/AreaNew/index', '地区列表', '1', '1', '', '0', '0', '0', 'fa fa-clone', 'Admini'), ('152', 'Admini/HouseInfo/index', '房屋信息列表', '1', '1', '', '0', '0', '0', 'fa fa-clone', 'Admini'), ('153', 'Admini/HouseInfo/delImg', '删除房屋图片', '1', '1', '', '152', '1', '0', 'fa fa-clone', 'Admini'), ('154', 'Admini/HouseInfo/updateStatus', '修改房屋状态', '1', '1', '', '152', '1', '0', null, null), ('155', 'Admini/HouseInfo/delete', '删除房屋信息', '1', '1', '', '152', '1', '0', null, null), ('156', 'Admini/HouseInfo/add', '添加房屋信息', '1', '1', '', '152', '1', '0', null, null), ('157', 'Admini/HouseInfo/updateHouseInfo', '修改房屋信息', '1', '1', '', '152', '1', '0', null, null), ('158', 'Admini/HouseInfo/lookImg', '查看房屋图册', '1', '1', '', '152', '1', '0', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `city_house_info`
-- ----------------------------
DROP TABLE IF EXISTS `city_house_info`;
CREATE TABLE `city_house_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL COMMENT '区域关联id',
  `title` varchar(50) NOT NULL,
  `price` decimal(13,2) NOT NULL COMMENT '价格',
  `title_hun` varchar(50) NOT NULL COMMENT '匈牙利语',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `address_hun` varchar(255) NOT NULL,
  `is_lift` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1有电梯2无电梯',
  `proportion` double(8,2) NOT NULL COMMENT '面积',
  `num` smallint(6) NOT NULL COMMENT '房间数目',
  `status` tinyint(1) NOT NULL COMMENT '1正常2停用',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `is_sale` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1售卖2租房3未知',
  `garden_area` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '花园面积',
  `floor_num` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所在楼层',
  `build_type` varchar(30) NOT NULL DEFAULT '0' COMMENT '建筑类型（暂时不知道是什么）',
  `room_num` tinyint(4) NOT NULL DEFAULT '0' COMMENT '房间数目',
  `wc_num` tinyint(4) NOT NULL DEFAULT '0' COMMENT '卫生间数目',
  `garage_area` double(11,2) NOT NULL DEFAULT '0.00' COMMENT '车库面积 如果为0则是没有车库',
  `is_floor_heat` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有地暖1有2没有',
  `is_dulilinyu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1有独立淋浴2没有独立淋浴',
  `memo` text COMMENT '简介',
  `creat_house_time` int(10) NOT NULL DEFAULT '0' COMMENT '房屋建造时间',
  `coder` char(20) NOT NULL COMMENT '房屋编码',
  `memo_hun` text COMMENT '房屋简介hun',
  `build_type_hun` varchar(30) NOT NULL COMMENT '建筑类型_hun',
  PRIMARY KEY (`id`),
  UNIQUE KEY `coder` (`coder`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `city_house_info`
-- ----------------------------
BEGIN;
INSERT INTO `city_house_info` VALUES ('1', '1', '22123', '123.00', '123', '123', '123', '1', '123.00', '0', '1', '1502520384', '1', '0.00', '10', '11', '0', '11', '0.00', '1', '1', '213123123', '-28800', '123123123', null, '');
COMMIT;

-- ----------------------------
--  Table structure for `city_house_photo`
-- ----------------------------
DROP TABLE IF EXISTS `city_house_photo`;
CREATE TABLE `city_house_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL COMMENT '关联房屋id',
  `filepath` varchar(255) NOT NULL COMMENT '文件路径',
  `status` tinyint(1) NOT NULL COMMENT '1正常2停用',
  `sort` tinyint(4) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `house_id` (`house_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `city_house_photo`
-- ----------------------------
BEGIN;
INSERT INTO `city_house_photo` VALUES ('2', '1', '', '1', '0'), ('3', '1', '', '1', '0'), ('4', '2', '', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `city_member`
-- ----------------------------
DROP TABLE IF EXISTS `city_member`;
CREATE TABLE `city_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` char(22) NOT NULL COMMENT '用户手机号，用户帐号',
  `password` char(64) NOT NULL COMMENT '用户密码',
  `drafttype` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '关注汇票类型，（0，为全部）',
  `nickname` varchar(30) NOT NULL COMMENT '用户昵称',
  `heaimg` varchar(500) NOT NULL COMMENT '用户头像',
  `realname` varchar(70) NOT NULL COMMENT '用户真实姓名',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户性别（0，为女，1为男）',
  `cardnumber` char(20) NOT NULL COMMENT '身份证号码',
  `cardfilepathn` varchar(500) NOT NULL COMMENT '身份证正面照片',
  `cardfilepathf` varchar(500) NOT NULL COMMENT '身份证反面照片',
  `handheldidentcard` varchar(500) NOT NULL COMMENT '手持身份证照片',
  `status` varchar(500) NOT NULL DEFAULT '1' COMMENT '帐号状态（0，锁定，1，正常）',
  `isrealnameauth` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否已经实名认证（0，未认证，1，已认证，认证通过，2，认证失败）',
  `isbid` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否可以出价（0，不可出价，1，可以出价）',
  `deposit` decimal(13,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '保证金',
  `loanlimit` decimal(13,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '总计可用贷款额度',
  `surplusloanlimit` decimal(13,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '当前剩余额度（注意增加带宽额度时，增加当前剩余额度）',
  `wx_openid` char(64) NOT NULL COMMENT '微信openID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `status` (`status`(333)),
  KEY `wx_openid` (`wx_openid`),
  KEY `cardnumber` (`cardnumber`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='平台用户';

-- ----------------------------
--  Records of `city_member`
-- ----------------------------
BEGIN;
INSERT INTO `city_member` VALUES ('2', '18236197061', '31dd9cba757467657e94916fcbd91fef', '0', '小和尚唱情歌23', 'Uploads/userInfo/heaing/2017/08/02/5981445d91d7d.jpg', '杨增文', '0', '410711199607061518', 'Uploads/userInfo/cardn/2017/08/02/598144430855e.jpg', 'Uploads/userInfo/cardf/2017/08/02/59814448b4197.jpg', 'Uploads/userInfo/hand/2017/08/02/5981443ca4d16.jpg', '1', '1', '1', '123.00', '123.00', '0.00', ''), ('3', '17079419195', '31dd9cba757467657e94916fcbd91fef', '0', '卡拉是条狗', '1707/26/59784376d6493.jpg', '', '0', '410111111111111111', '', '', '', '0', '0', '0', '0.00', '0.00', '0.00', 'oh0sN0ThquUr4xxaI79jwCB0TznM'), ('5', '15617591369', '2d7586b28c2f45b238d7c48f467e60fa', '0', '方豪', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erOUibh0tFrvT6kAcwZ0bxG4QqiaicXaGAgplSqFy5N1CWY3PbbYplNV3JUESGbeddnQPyOPNJyaRibXQ/0', '', '1', '', '', '', '', '1', '0', '1', '0.00', '0.00', '0.00', 'oh0sN0bg2qJp2LPADhwUIetlLZlw'), ('6', '15937108635', '2d7586b28c2f45b238d7c48f467e60fa', '0', '方豪', 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erOUibh0tFrvT6kAcwZ0bxG4QqiaicXaGAgplSqFy5N1CWY3PbbYplNV3JUESGbeddnQPyOPNJyaRibXQ/0', '', '1', '', '', '', '', '1', '0', '1', '0.00', '0.00', '0.00', 'oh0sN0bmzZ6tFNd00Mg0b6u1U8fM'), ('8', '18695916110', '31dd9cba757467657e94916fcbd91fef', '0', '胡', 'https://wx.qlogo.cn/mmopen/vi_32/aUV1V4jOBN2zoT6FI02Cpj4hSxEXS2Bicz5IMUxl8Ob2179f2XO4zxib69C6Zdaa9kN3l1ia3R2tXU7LXlFicmDqPw/0', '', '1', '', '', '', '', '1', '0', '1', '0.00', '0.00', '0.00', 'oh0sN0TnyC1jER8dLw2Yfd06TtPA'), ('9', '13439338524', '554998ebfc3300302990ed0c27d93353', '0', 'Leekingman', 'https://wx.qlogo.cn/mmopen/vi_32/zB68tGlNwT54nRpDsZwMaFSRDIQzSNdWqQXHeZYxtyAmP7P6hDVj1guoB0rr2ZsPtuBAxyXRg4ONF6zQHtQo9Q/0', '', '0', '', '', '', '', '1', '0', '1', '0.00', '0.00', '0.00', 'oh0sN0e0aOdrCb5m3D5LYae3v4lg'), ('11', '13937162888', '2d7586b28c2f45b238d7c48f467e60fa', '0', '深深APP开发网站设计', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLdJRI1tJBvFsVjNMI36AfQFhWBKAg2JVt4GoicSlnmGsM1yeFlRN26vkJF5mZNrgMh4Qke6chAcIA/0', '', '1', '', '', '', '', '1', '0', '1', '0.00', '0.00', '0.00', 'oh0sN0eY-RaK9CEdjkR4TAUh8fTk'), ('12', '18637167878', '52c116a1f0326f5ad7b94eefe2cc9a59', '0', 'DY Woo', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIH49Ug3q0kibRarUdtMiaIx1ICuOj7OeAn2zAwzgKM4RFpfbkSBEvX0hftoXibTrictcSibJPoHV5xu8Q/0', '', '1', '', '', '', '', '1', '0', '1', '0.00', '0.00', '0.00', 'oh0sN0cf_NQ30o0Jy4xQVxi2NKFU');
COMMIT;

-- ----------------------------
--  Table structure for `city_operationlog`
-- ----------------------------
DROP TABLE IF EXISTS `city_operationlog`;
CREATE TABLE `city_operationlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(500) COLLATE utf8_bin DEFAULT NULL COMMENT '操作表名',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '操作类型，暂时无用',
  `act_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作管理员ID',
  `act_account` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '操作管理员帐号',
  `description` varchar(2000) COLLATE utf8_bin DEFAULT NULL COMMENT '操作记录说明',
  `get_parameter` varchar(2000) COLLATE utf8_bin NOT NULL COMMENT 'get参数',
  `times` int(11) NOT NULL DEFAULT '0' COMMENT '操作日期时间',
  PRIMARY KEY (`id`),
  KEY `tablename` (`tablename`(333)),
  KEY `type` (`type`),
  KEY `act_id` (`act_id`),
  KEY `act_account` (`act_account`),
  KEY `times` (`times`)
) ENGINE=MyISAM AUTO_INCREMENT=4711 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='管理员操作日志';

-- ----------------------------
--  Records of `city_operationlog`
-- ----------------------------
BEGIN;
INSERT INTO `city_operationlog` VALUES ('4540', 'operationlog', '0', '1', 'admin', 'admin删除了日志,ID为[4539]', 'a:1:{s:16:\"/Log/delLog_html\";s:0:\"\";}', '1499649451'), ('4541', 'administrator', '0', '0', 'admin', '管理员[admin]登录失败！原因：账号或密码错误！', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1499672676'), ('4542', 'administrator', '0', '0', 'admin', '管理员[admin]登录失败！原因：账号或密码错误！', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1499672688'), ('4543', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1499672696'), ('4544', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1499739625'), ('4545', 'administrator', '0', '1', 'admin', 'admin修改了ID为2的管理员的密码', 'a:1:{s:23:\"/User/editPassword_html\";s:0:\"\";}', '1499769096'), ('4546', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1499821952'), ('4547', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1499908320'), ('4548', 'member', '0', '1', 'admin', 'admin将设备ID为[]绑定到了用户[]。中间表增加记录1', 'a:1:{s:26:\"/UserInfo/addUserInfo_html\";s:0:\"\";}', '1499911331'), ('4549', 'member', '0', '1', 'admin', 'admin将设备ID为[]绑定到了用户[]。中间表增加记录2', 'a:1:{s:26:\"/UserInfo/addUserInfo_html\";s:0:\"\";}', '1499912238'), ('4550', 'userinfo', '0', '1', 'admin', 'admin修改了会员[1]的状态为2。', 'a:1:{s:29:\"/UserInfo/editUserStatus_html\";s:0:\"\";}', '1499912524'), ('4551', 'userinfo', '0', '1', 'admin', 'admin修改了会员[1]的状态为1。', 'a:1:{s:29:\"/UserInfo/editUserStatus_html\";s:0:\"\";}', '1499912527'), ('4552', 'userinfo', '0', '1', 'admin', 'admin修改了会员[2]的状态为2。', 'a:1:{s:29:\"/UserInfo/editUserStatus_html\";s:0:\"\";}', '1499915109'), ('4553', 'userinfo', '0', '1', 'admin', 'admin修改了会员[2]的状态为1。', 'a:1:{s:29:\"/UserInfo/editUserStatus_html\";s:0:\"\";}', '1499915123'), ('4554', 'member', '0', '1', 'admin', 'admin删除了会员[1]', 'a:1:{s:21:\"/UserInfo/delete_html\";s:0:\"\";}', '1499925763'), ('4555', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:29:\"/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1499935063'), ('4556', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:29:\"/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1499935074'), ('4557', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500014658'), ('4558', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500014681'), ('4559', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500015181'), ('4560', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500015187'), ('4561', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500015187'), ('4562', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500015187'), ('4563', 'member', '0', '1', 'admin', 'admin管理员修改了id为1', 'a:1:{s:26:\"/Article/updateStatus_html\";s:0:\"\";}', '1500015187'), ('4564', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500253912'), ('4565', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500278968'), ('4566', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500339981'), ('4567', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500340043'), ('4568', 'member', '0', '1', 'admin', 'admin添加新票据，ID为[1]', 'a:1:{s:15:\"/Draft/add_html\";s:0:\"\";}', '1500347980'), ('4569', 'member', '0', '1', 'admin', 'admin添加新票据，ID为[2]', 'a:1:{s:15:\"/Draft/add_html\";s:0:\"\";}', '1500348160'), ('4570', 'draft', '0', '1', 'admin', 'admin修改了汇票[2]的状态为1。', 'a:1:{s:22:\"/Draft/editStatus_html\";s:0:\"\";}', '1500359814'), ('4571', 'draft', '0', '1', 'admin', 'admin修改了汇票[2]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361005'), ('4572', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361009'), ('4573', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361010'), ('4574', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361016'), ('4575', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361023'), ('4576', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361024'), ('4577', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361025'), ('4578', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361025'), ('4579', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361025'), ('4580', 'draft', '0', '1', 'admin', 'admin修改了汇票[2]的状态为0。', 'a:1:{s:22:\"/Draft/editStatus_html\";s:0:\"\";}', '1500361030'), ('4581', 'draft', '0', '1', 'admin', 'admin修改了汇票[2]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361034'), ('4582', 'draft', '0', '1', 'admin', 'admin修改了汇票[2]的状态为1。', 'a:1:{s:22:\"/Draft/editStatus_html\";s:0:\"\";}', '1500361075'), ('4583', 'draft', '0', '1', 'admin', 'admin修改了汇票[2]的是否展示。', 'a:1:{s:23:\"/Draft/editPutaway_html\";s:0:\"\";}', '1500361116'), ('4584', 'member', '0', '1', 'admin', 'admin添加新票据，ID为[5]', 'a:1:{s:15:\"/Draft/add_html\";s:0:\"\";}', '1500427950'), ('4585', 'draft', '0', '1', 'admin', 'admin删除了汇票[4]', 'a:1:{s:18:\"/Draft/delete_html\";s:0:\"\";}', '1500427961'), ('4586', 'draft', '0', '1', 'admin', 'admin删除了汇票[2]', 'a:1:{s:18:\"/Draft/delete_html\";s:0:\"\";}', '1500427965'), ('4587', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[6]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500430277'), ('4588', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500430392'), ('4589', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500430492'), ('4590', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500430617'), ('4591', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500430636'), ('4592', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500430724'), ('4593', 'draftblum', '0', '1', 'admin', 'admin删除了汇票图片[3]。', 'a:1:{s:18:\"/Draft/delImg_html\";s:0:\"\";}', '1500432147'), ('4594', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500445972'), ('4595', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500446459'), ('4596', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500446461'), ('4597', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500446867'), ('4598', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500446892'), ('4599', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500446919'), ('4600', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500447255'), ('4601', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500447649'), ('4602', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500448544'), ('4603', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500448559'), ('4604', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[]', 'a:1:{s:18:\"/Draft/update_html\";s:0:\"\";}', '1500448789'), ('4605', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:29:\"/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1500449082'), ('4606', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:29:\"/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1500449092'), ('4607', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500514251'), ('4608', 'draftbidblacklist', '0', '1', 'admin', 'admin添加了汇票黑名单[0]。', 'a:1:{s:27:\"/Draftbidblacklist/add_html\";s:0:\"\";}', '1500531791'), ('4609', 'draftbidblacklist', '0', '1', 'admin', 'admin删除了汇票黑名单[mid = 2,addtime = 1500531791]。', 'a:1:{s:27:\"/Draftbidblacklist/del_html\";s:0:\"\";}', '1500532716'), ('4610', 'draftbidblacklist', '0', '1', 'admin', 'admin添加了汇票黑名单[0]。', 'a:1:{s:27:\"/Draftbidblacklist/add_html\";s:0:\"\";}', '1500532728'), ('4611', 'draftbidblacklist', '0', '1', 'admin', 'admin添加了汇票黑名单[0]。', 'a:1:{s:27:\"/Draftbidblacklist/add_html\";s:0:\"\";}', '1500532793'), ('4612', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500623253'), ('4613', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:21:\"/Public/do_login_html\";s:0:\"\";}', '1500687685'), ('4614', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为1。', 'a:1:{s:26:\"/Loanlog/updateStatus_html\";s:0:\"\";}', '1500706929'), ('4615', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为0。', 'a:1:{s:26:\"/Loanlog/updateStatus_html\";s:0:\"\";}', '1500707165'), ('4616', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为1。', 'a:1:{s:26:\"/Loanlog/updateStatus_html\";s:0:\"\";}', '1500707168'), ('4617', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为0。', 'a:1:{s:33:\"/Admini/Loanlog/updateStatus_html\";s:0:\"\";}', '1500860691'), ('4618', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为1。', 'a:1:{s:33:\"/Admini/Loanlog/updateStatus_html\";s:0:\"\";}', '1500860694'), ('4619', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的状态为0。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1500861163'), ('4620', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1500861166'), ('4621', 'loanlog', '0', '1', 'admin', 'admin添加新贷款记录，ID为[7]', 'a:1:{s:24:\"/Admini/Loanlog/add_html\";s:0:\"\";}', '1500946333'), ('4622', 'loanlog', '0', '1', 'admin', 'admin添加新贷款记录，ID为[8]', 'a:1:{s:24:\"/Admini/Loanlog/add_html\";s:0:\"\";}', '1500946658'), ('4623', 'loanlog', '0', '1', 'admin', 'admin删除贷款信息[6]。', 'a:1:{s:27:\"/Admini/Loanlog/delete_html\";s:0:\"\";}', '1500946815'), ('4624', 'loanlog', '0', '1', 'admin', 'admin删除贷款信息[6]。', 'a:1:{s:27:\"/Admini/Loanlog/delete_html\";s:0:\"\";}', '1500946818'), ('4625', 'loanlog', '0', '1', 'admin', 'admin删除贷款信息[5]。', 'a:1:{s:27:\"/Admini/Loanlog/delete_html\";s:0:\"\";}', '1500946879'), ('4626', 'loanlog', '0', '1', 'admin', 'admin删除贷款信息[4]。', 'a:1:{s:27:\"/Admini/Loanlog/delete_html\";s:0:\"\";}', '1500946910'), ('4627', 'loanlog', '0', '1', 'admin', 'admin删除贷款信息[3]。', 'a:1:{s:27:\"/Admini/Loanlog/delete_html\";s:0:\"\";}', '1500946913'), ('4628', 'loanlog', '0', '1', 'admin', 'admin删除贷款信息[2]。', 'a:1:{s:27:\"/Admini/Loanlog/delete_html\";s:0:\"\";}', '1500946953'), ('4629', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为0。', 'a:1:{s:33:\"/Admini/Loanlog/updateStatus_html\";s:0:\"\";}', '1500947502'), ('4630', 'loanlog', '0', '1', 'admin', 'admin修改贷款信息[1]的状态为1。', 'a:1:{s:33:\"/Admini/Loanlog/updateStatus_html\";s:0:\"\";}', '1500947504'), ('4631', 'system_article', '0', '1', 'admin', 'admin添加系统新闻，ID为[1]', 'a:1:{s:30:\"/Admini/SystemArticle/add_html\";s:0:\"\";}', '1500973024'), ('4632', 'system_article', '0', '1', 'admin', 'admin添加系统新闻，ID为[2]', 'a:1:{s:30:\"/Admini/SystemArticle/add_html\";s:0:\"\";}', '1500973134'), ('4633', 'system_article', '0', '1', 'admin', 'admin修改系统新闻[1]的状态为0。', 'a:1:{s:39:\"/Admini/SystemArticle/updateStatus_html\";s:0:\"\";}', '1500973236'), ('4634', 'system_article', '0', '1', 'admin', 'admin修改系统新闻[1]的状态为1。', 'a:1:{s:39:\"/Admini/SystemArticle/updateStatus_html\";s:0:\"\";}', '1500973238'), ('4635', 'system_article', '0', '1', 'admin', 'admin删除系统新闻[2]。', 'a:1:{s:33:\"/Admini/SystemArticle/delete_html\";s:0:\"\";}', '1500976894'), ('4636', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：192.168.31.181', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501032240'), ('4637', 'member', '0', '1', 'admin', 'admin修改了系统新闻，ID为[1]', 'a:1:{s:33:\"/Admini/SystemArticle/update_html\";s:0:\"\";}', '1501033177'), ('4638', 'member', '0', '1', 'admin', 'admin修改了系统新闻，ID为[1]', 'a:1:{s:33:\"/Admini/SystemArticle/update_html\";s:0:\"\";}', '1501033187'), ('4639', 'bidlog', '0', '1', 'admin', 'admin修改了出价表mid=2,did=1的状态为1。', 'a:1:{s:32:\"/Admini/Bidlog/updateIslock_html\";s:0:\"\";}', '1501051864'), ('4640', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：123.161.217.28', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501053764'), ('4641', 'member', '0', '1', 'admin', 'admin添加新用户，ID为[3]', 'a:1:{s:33:\"/Admini/UserInfo/addUserInfo_html\";s:0:\"\";}', '1501053856'), ('4642', 'member', '0', '1', 'admin', 'admin修改了会员[3]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501054653'), ('4643', 'draft', '0', '1', 'admin', 'admin修改了汇票[37]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501559493'), ('4644', 'draft', '0', '1', 'admin', 'admin修改了汇票[36]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501559496'), ('4645', 'draft', '0', '1', 'admin', 'admin修改了汇票[37]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501559647'), ('4646', 'draft', '0', '1', 'admin', 'admin修改了汇票[36]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501559650'), ('4647', 'draft', '0', '1', 'admin', 'admin修改了汇票[41]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501567753'), ('4648', 'draft', '0', '1', 'admin', 'admin修改了汇票[40]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501567756'), ('4649', 'draft', '0', '1', 'admin', 'admin修改了汇票[39]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501567758'), ('4650', 'draft', '0', '1', 'admin', 'admin修改了汇票[38]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501567761'), ('4651', 'draft', '0', '1', 'admin', 'admin修改了汇票[41]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501567766'), ('4652', 'draft', '0', '1', 'admin', 'admin修改了汇票[40]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501567768'), ('4653', 'draft', '0', '1', 'admin', 'admin修改了汇票[39]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501567771'), ('4654', 'draft', '0', '1', 'admin', 'admin修改了汇票[38]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501567776'), ('4655', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501570875'), ('4656', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501574641'), ('4657', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501574756'), ('4658', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501574939'), ('4659', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501575308'), ('4660', 'draftblum', '0', '1', 'admin', 'admin删除了汇票图片[1]。', 'a:1:{s:25:\"/Admini/Draft/delImg_html\";s:0:\"\";}', '1501575446'), ('4661', 'draftblum', '0', '1', 'admin', 'admin删除了汇票图片[2]。', 'a:1:{s:25:\"/Admini/Draft/delImg_html\";s:0:\"\";}', '1501575449'), ('4662', 'draftblum', '0', '1', 'admin', 'admin删除了汇票图片[4]。', 'a:1:{s:25:\"/Admini/Draft/delImg_html\";s:0:\"\";}', '1501575451'), ('4663', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[1]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501575523'), ('4664', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[1]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501576695'), ('4665', 'draftblum', '0', '1', 'admin', 'admin删除了汇票图片[13]。', 'a:1:{s:25:\"/Admini/Draft/delImg_html\";s:0:\"\";}', '1501576761'), ('4666', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[1]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501576767'), ('4667', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的状态为2。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501577451'), ('4668', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的状态为0。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501577456'), ('4669', 'draft', '0', '1', 'admin', 'admin修改了汇票[1]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501577463'), ('4670', 'draft', '0', '1', 'admin', 'admin修改了汇票[49]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501585949'), ('4671', 'draft', '0', '1', 'admin', 'admin修改了汇票[49]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501585953'), ('4672', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501638024'), ('4673', 'bidlog', '0', '1', 'admin', 'admin修改了出价表mid=2,did=1的状态为。', 'a:1:{s:32:\"/Admini/Bidlog/updateIslock_html\";s:0:\"\";}', '1501639345'), ('4674', 'bidlog', '0', '1', 'admin', 'admin修改了出价表mid=2,did=1的状态为。', 'a:1:{s:32:\"/Admini/Bidlog/updateIslock_html\";s:0:\"\";}', '1501639347'), ('4675', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：1.192.37.156', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501642658'), ('4676', 'draftblum', '0', '1', 'admin', 'admin删除了汇票图片[14]。', 'a:1:{s:25:\"/Admini/Draft/delImg_html\";s:0:\"\";}', '1501643040'), ('4677', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：1.192.37.156', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501643560'), ('4678', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501643854'), ('4679', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501643872'), ('4680', 'member', '0', '1', 'admin', 'admin修改了会员[2]', 'a:1:{s:36:\"/Admini/UserInfo/updateUserInfo_html\";s:0:\"\";}', '1501643933'), ('4681', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501644514'), ('4682', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[1]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501644557'), ('4683', 'administrator', '0', '0', 'admin', '管理员[admin]登录失败！原因：账号或密码错误！', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501646241'), ('4684', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：1.192.37.156', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501646253'), ('4685', 'draft', '0', '1', 'admin', 'admin修改了汇票[51]的状态为1。', 'a:1:{s:29:\"/Admini/Draft/editStatus_html\";s:0:\"\";}', '1501662017'), ('4686', 'draft', '0', '1', 'admin', 'admin修改了汇票[51]的是否展示。', 'a:1:{s:30:\"/Admini/Draft/editPutaway_html\";s:0:\"\";}', '1501662029'), ('4687', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：1.192.37.156', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501662769'), ('4688', 'member', '0', '1', 'admin', 'admin添加新票据，ID为[52]', 'a:1:{s:22:\"/Admini/Draft/add_html\";s:0:\"\";}', '1501663110'), ('4689', 'member', '0', '1', 'admin', 'admin添加新票据，ID为[53]', 'a:1:{s:22:\"/Admini/Draft/add_html\";s:0:\"\";}', '1501663246'), ('4690', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[53]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501663303'), ('4691', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[52]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501663334'), ('4692', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[52]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501664391'), ('4693', 'member', '0', '1', 'admin', 'admin修改了票据，ID为[53]', 'a:1:{s:25:\"/Admini/Draft/update_html\";s:0:\"\";}', '1501666484'), ('4694', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：125.46.130.18', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1501723707'), ('4695', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1502420013'), ('4696', 'article_cate', '0', '1', 'admin', 'admin修改了新闻类型，ID为[1]', 'a:1:{s:27:\"/Admini/AreaNew/update_html\";s:0:\"\";}', '1502432836'), ('4697', 'area_new', '0', '1', 'admin', 'admin添加新闻类型，ID为[2]', 'a:1:{s:24:\"/Admini/AreaNew/add_html\";s:0:\"\";}', '1502432898'), ('4698', 'area_new', '0', '1', 'admin', 'admin删除了新闻类型[2]', 'a:1:{s:27:\"/Admini/AreaNew/delete_html\";s:0:\"\";}', '1502432903'), ('4699', 'area_new', '0', '1', 'admin', 'admin添加新闻类型，ID为[3]', 'a:1:{s:24:\"/Admini/AreaNew/add_html\";s:0:\"\";}', '1502432922'), ('4700', 'area_new', '0', '1', 'admin', 'admin删除了新闻类型[3]', 'a:1:{s:27:\"/Admini/AreaNew/delete_html\";s:0:\"\";}', '1502432926'), ('4701', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1502520249'), ('4702', 'article', '0', '1', 'admin', 'admin添加新房屋，ID为[1]', 'a:1:{s:26:\"/Admini/HouseInfo/add_html\";s:0:\"\";}', '1502520384'), ('4705', 'auth_rule', '0', '1', 'admin', '禁用了标识ID为：1的规则。', 'a:1:{s:31:\"/Admini/Auth/do_rulestatus_html\";s:0:\"\";}', '1504261584'), ('4706', 'auth_rule', '0', '1', 'admin', '启用了标识ID为：1的规则。', 'a:1:{s:31:\"/Admini/Auth/do_rulestatus_html\";s:0:\"\";}', '1504261699'), ('4707', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1504262288'), ('4708', 'administrator', '0', '1', 'admin', '管理员[admin]登录成功！登录IP：127.0.0.1', 'a:1:{s:28:\"/Admini/Public/do_login_html\";s:0:\"\";}', '1504345115'), ('4709', 'house_info', '0', '1', 'admin', 'admin修改房屋，ID为[1]', 'a:1:{s:38:\"/Admini/HouseInfo/updateHouseInfo_html\";s:0:\"\";}', '1504514968'), ('4710', 'house_info', '0', '1', 'admin', 'admin修改房屋，ID为[1]', 'a:1:{s:38:\"/Admini/HouseInfo/updateHouseInfo_html\";s:0:\"\";}', '1504515332');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
