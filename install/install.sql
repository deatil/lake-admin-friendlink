DROP TABLE IF EXISTS `pre__lfriendlink_cate`;
CREATE TABLE `pre__lfriendlink_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '分类标识',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '分类名称',
  `description` char(100) DEFAULT '' COMMENT '分类描述',
  `sort` int(10) DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态，1-启用',
  `edit_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `edit_ip` varchar(25) DEFAULT '' COMMENT '更新IP',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `add_ip` varchar(25) DEFAULT '' COMMENT '添加IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='友情链接分类';

DROP TABLE IF EXISTS `pre__lfriendlink`;
CREATE TABLE `pre__lfriendlink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '标识ID',
  `cate_id` int(10) NOT NULL COMMENT '分类id',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '链接名称',
  `url` text COMMENT '链接',
  `description` char(100) DEFAULT '' COMMENT '链接描述',
  `logo` varchar(200) DEFAULT '' COMMENT 'LOGO',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示方式，1-文字，2-图片',
  `target` varchar(10) NOT NULL DEFAULT '_self' COMMENT '跳转方式，_self-自身，_blank-跳出',
  `sort` int(10) DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态，1-启用',
  `edit_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `edit_ip` varchar(25) DEFAULT '' COMMENT '更新IP',
  `add_time` int(10) DEFAULT '0' COMMENT '添加时间',
  `add_ip` varchar(25) DEFAULT '' COMMENT '添加IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='友情链接';


INSERT INTO `pre__lfriendlink_cate` VALUES (1,'lake','默认分类','',100,1,1582443242,'127.0.0.1',1578976091,'127.0.0.1');

INSERT INTO `pre__lfriendlink` VALUES (1,1,'bilibili','https://www.bilibili.com/','bilibili','',1,'_blank',100,1,0,'',1582443904,'127.0.0.1');
