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
  PRIMARY KEY (`id`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '市';

CREATE TABLE `projects` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL DEFAULT '',
  `sshy1` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `sshy2` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `jsdw` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '建设单位',
  `jsdd` INT(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '建设地点',
  `tzztxz` VARCHAR(45) NOT NULL DEFAULT '' COMMENT '投资主体性质',
  `tze` FLOAT NOT NULL DEFAULT 0 COMMENT '投资额',
  `jsnr` TEXT NOT NULL DEFAULT '' COMMENT '建设内容',
  `jjzb` TEXT NOT NULL DEFAULT '' COMMENT '经济指标',
  `jssj1` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '建设时间——起',
  `jssj2` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '建设时间—止',
  `tags` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '标签',
  `xmxz` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 未知 1新建 2改扩建 3融资',
  `ssyq` INT(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属园区,关联园区表主键',
  PRIMARY KEY (`id`),
  index `idx_sshy1_sshy2`(`sshy1`, `sshy2`),
  index `idx_sshy2`(`sshy2`),
  index `idx_jsdd`(`jsdd`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COMMENT = '项目';

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

