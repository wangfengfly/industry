CREATE DATABASE IF NOT EXISTS industry default charset utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'industry' WITH GRANT OPTION;
FLUSH   PRIVILEGES;

use industry;

CREATE TABLE `industry` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '名称',
  `parentid` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上一级行业id',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '行业';


CREATE TABLE `province` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '省';

CREATE TABLE `city` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  `pid` int(11) unsigned NOT NULL DEFAULT 0 comment '省id',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '市';

CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `sshy1` int(11) unsigned NOT NULL DEFAULT '0',
  `sshy2` int(11) unsigned NOT NULL DEFAULT '0',
  `jsdw` varchar(200) NOT NULL DEFAULT '' COMMENT '建设单位',
  `jsdd1` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '省',
  `jsdd2` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '市',
  `tzztxz` varchar(45) NOT NULL DEFAULT '' COMMENT '投资主体性质',
  `tze` float NOT NULL DEFAULT '0' COMMENT '投资额',
  `jsnr` text NOT NULL COMMENT '建设内容',
  `jjzb` text NOT NULL COMMENT '经济指标',
  `jssj1` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '建设时间——起',
  `jssj2` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '建设时间—止',
  `tags` varchar(100) NOT NULL DEFAULT '' COMMENT '标签',
  `xmxz` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 未知 1新建 2改扩建 3融资',
  `ssyq` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属园区,关联园区表主键',
  PRIMARY KEY (`id`),
  KEY `idx_sshy1_sshy2` (`sshy1`,`sshy2`),
  KEY `idx_sshy2` (`sshy2`),
  KEY `idx_jsdd` (`jsdd1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目'

CREATE TABLE `park` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `identifier` int(11) unsigned not null DEFAULT 0 comment '编号',
  `code` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '代码',
  `name` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '园区名称',
  `create_time` int(11) UNSIGNED not null DEFAULT 0 comment '建立时间',
  `area` float unsigned not null DEFAULT 0 comment '占地面积,公顷',
  `prime_ind1` VARCHAR(20) not null DEFAULT '' comment '主导产业1',
  `prime_ind2` VARCHAR(20) not null DEFAULT '' comment '主导产业2',
  `prime_ind3` VARCHAR(20) not null DEFAULT '' comment '主导产业3',
  `prime_ind4` VARCHAR(20) not null DEFAULT '' comment '主导产业4',
  `intro` text not null DEFAULT '' comment '园区简介',
  `url` VARCHAR(100) not NULL DEFAULT '' comment '园区官网',
  `phone` VARCHAR(20) not NULL DEFAULT '' comment '联系电话',
  `email` VARCHAR(20) not null DEFAULT '' comment '邮箱',
  `wechat` VARCHAR(50) not null DEFAULT ''comment '微信公众号',
  `companies` VARCHAR(500) not null DEFAULT '' comment '园区企业',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '园区表';

CREATE TABLE `economy` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `park_id` int(11) unsigned not null DEFAULT 0 comment '所属园区id',
  `year` int(11) unsigned not null DEFAULT 0 comment '年份',
  `pepole_count` FLOAT unsigned NOT NULL DEFAULT 0 COMMENT '年末从业人员(万人)',
  `gross` FLOAT unsigned NOT NULL DEFAULT 0 COMMENT '工业总产值（亿元）',
  `delivery` FLOAT UNSIGNED not null DEFAULT 0 comment '出口交货值（亿元）',
  `total_assets` float unsigned not null DEFAULT 0 comment '年末资产总计（亿元）',
  `current_assets` FLOAT unsigned not null DEFAULT 0 comment '流动资产合计（亿元）',
  `debt` FLOAT unsigned not null DEFAULT 0 comment '年末负债合计（亿元）',
  `owners` FLOAT unsigned not null DEFAULT 0 comment '年末所有者权益（亿元）',
  `revenue` FLOAT unsigned not null DEFAULT 0 comment '主营业务收入（亿元）',
  `profit` FLOAT unsigned not null DEFAULT 0 comment '利润总额（亿元）',
  `tax` FLOAT unsigned not NULL DEFAULT 0 comment '税金总额（亿元）',
  `loss` FLOAT unsigned not NULL DEFAULT 0 comment '亏损企业总额（亿元）',
  PRIMARY KEY (`id`),
  unique key `uidx_parkid_year`(`park_id`,`year`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '经济指标表';

CREATE TABLE `policy` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pub_time` int(11) unsigned not null DEFAULT 0 comment '发布时间，20180517',
  `ind_id` int(11) unsigned not null DEFAULT 0 comment '行业',
  `pid` int(11) unsigned not null DEFAULT 0 comment '省',
  `department` tinyint(2) unsigned not null DEFAULT 0 comment '部门',
  `title` VARCHAR(100) not null DEFAULT '' comment '标题',
  `content` text not null DEFAULT '' comment '内容',
  `attach_url` VARCHAR(100) not null DEFAULT '' comment '文档下载地址',
  PRIMARY KEY (`id`),
  index `idx_pid`(`pid`),
  index `idx_department`(`department`),
  index `idx_indid`(`ind_id`),
  index `idx_pubtime`(`pub_time`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '政策表';


CREATE TABLE `menus` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `seq` tinyint(2) unsigned not null DEFAULT 0 comment '顺序号',
  `name` varchar(100) not null DEFAULT '' comment '名称',
  `ctime` timestamp not null DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP comment '创建时间',
  PRIMARY KEY (`id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '菜单栏';

CREATE TABLE `news` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned not null DEFAULT 0 comment '所属栏目id',
  `pub_time` timestamp not null DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP comment '发布时间',
  `title` VARCHAR(100) not null DEFAULT '' comment '标题',
  `desc` VARCHAR(200) not null DEFAULT '' comment '简介',
  `img_url` VARCHAR(200) not null DEFAULT '' comment '新闻图片url',
  `content` text not null DEFAULT '' comment '内容',
  `tags` VARCHAR(100) not null DEFAULT '' comment '标签',
  `author` VARCHAR(100) not null DEFAULT '' comment '发布者',
  PRIMARY KEY (`id`),
  index `idx_menu_id`(`menu_id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '新闻表';

