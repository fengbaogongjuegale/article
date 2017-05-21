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

