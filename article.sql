drop database if exists article;
create database if not exists article;

use article;

drop table if exists `article_list`;
create table if not exists `article_list`(
	`articleid` bigint unsigned not null auto_increment primary key,
	`title` varchar(32) not null default 'weimingming',
	`content` text ,
	`yearid` enum('0','1','2','3','4','5','6','7','8','9','10','11','12') not null default '1',
	`genreid` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18') not null default '1',
	`authorid` bigint unsigned not null default '0'
)engine = innodb default charset 'utf8';

drop table if exists `author`;
create table if not exists `author`(
	`authorid` bigint unsigned not null auto_increment primary key,
	`nickname` varchar(16) not null default '',
	`name` varchar(16) not null default '',
	`email` varchar(100) not null default '' comment '也是账号',
	`password` varchar(32) not null default '',
	`yearid` enum('0','1','2','3','4','5','6','7','8','9','10','11','12') not null default '1',
	`sex` enum('0','1') not null default '0',
	`underwrite` varchar(200) not null default '空空如也' comment '签名'
)engine = innodb default charset 'utf8';

insert into `author` (`nickname`,`name`,`yearid`,`sex`) values ('管理员','管理员','0','0');

alter table `article_list` add column `createtime` int unsigned not null default '0';
desc article_list;
alter table `article_list` add column `author` varchar(16) not null default 'admin';

