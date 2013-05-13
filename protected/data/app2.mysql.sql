SET FOREIGN_KEY_CHECKS=0;


CREATE TABLE IF NOT EXISTS tbl_lookup
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(128) NOT NULL,
	code INT NOT NULL,
	type VARCHAR(128) NOT NULL,
	position INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_user
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(128) NOT NULL,
	realname VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	salt VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	profile TEXT,
	group_id INT NOT NULL DEFAULT 0,
	create_time INT NOT NULL DEFAULT 0,
	update_time INT NOT NULL DEFAULT 0,
	active TINYINT NOT NULL DEFAULT 0,
        status TINYINT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_group
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	group_name VARCHAR(128) NOT NULL,
	group_label VARCHAR(128) NOT NULL,
	pid INT NOT NULL,
	group_icon VARCHAR(128) NOT NULL,
	group_desc TEXT,
	sort INT NOT NULL DEFAULT 0,
	create_time INT NOT NULL DEFAULT 0,
	update_time INT NOT NULL DEFAULT 0,
        status TINYINT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_post
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(128) NOT NULL,
	content TEXT NOT NULL,
	tags TEXT,
	status TINYINT NOT NULL,
	create_time INT,
	update_time INT,
	author_id INT NOT NULL,
	CONSTRAINT FK_post_author FOREIGN KEY (author_id)
		REFERENCES tbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_comment
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	content TEXT NOT NULL,
	status TINYINT NOT NULL,
	create_time INT,
	author VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	url VARCHAR(128),
	post_id INT NOT NULL,
	CONSTRAINT FK_comment_post FOREIGN KEY (post_id)
		REFERENCES tbl_post (id) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_tag
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(128) NOT NULL,
	frequency INT DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Draft', 'PostStatus', 1, 1);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Published', 'PostStatus', 2, 2);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Archived', 'PostStatus', 3, 3);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Pending Approval', 'CommentStatus', 1, 1);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Approved', 'CommentStatus', 2, 2);

INSERT INTO tbl_user (username, password, salt, email) VALUES ('demo','2e5c7db760a33498023813489cfadc0b','28b206548469ce62182048fd9cf91760','webmaster@example.com');
INSERT INTO tbl_post (title, content, status, create_time, update_time, author_id, tags) VALUES ('Welcome!','This blog system is developed using Yii. It is meant to demonstrate how to use Yii to build a complete real-world application. Complete source code may be found in the Yii releases.

Feel free to try this system by writing new posts and leaving comments.',2,1230952187,1230952187,1,'yii, blog');
INSERT INTO tbl_post (title, content, status, create_time, update_time, author_id, tags) VALUES ('A Test Post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2,1230952187,1230952187,1,'test');

INSERT INTO tbl_comment (content, status, create_time, author, email, post_id) VALUES ('This is a test comment.', 2, 1230952187, 'Tester', 'tester@example.com', 2);

INSERT INTO tbl_tag (name) VALUES ('yii');
INSERT INTO tbl_tag (name) VALUES ('blog');
INSERT INTO tbl_tag (name) VALUES ('test');



create table IF NOT EXISTS tbl_item
(
   name                 varchar(64) not null,
   type                 int not null,
   description          text,
   bizrule              text,
   data                 text,
   primary key (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table IF NOT EXISTS tbl_itemchild
(
   parent               varchar(64) not null,
   child                varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references tbl_item (name) on delete cascade on update cascade,
   foreign key (child) references tbl_item (name) on delete cascade on update cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table IF NOT EXISTS tbl_assignments
(
   itemname             varchar(64) not null,
   userid               varchar(64) not null,
   bizrule              text,
   data                 text,
   primary key (itemname,userid),
   foreign key (itemname) references tbl_item (name) on delete cascade on update cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS tbl_admin
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(128) NOT NULL,
	realname VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	salt VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	profile TEXT,
	create_time INT NOT NULL DEFAULT 0,
	update_time INT NOT NULL DEFAULT 0,
	role_id INT NOT NULL,
        status TINYINT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO tbl_admin (username, password, salt, email) VALUES ('admin','2e5c7db760a33498023813489cfadc0b','28b206548469ce62182048fd9cf91760','admin@admin.com');

CREATE TABLE IF NOT EXISTS `tbl_sensorario_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semantic_id` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `user` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `sex` tinyint NOT NULL DEFAULT 0,
  KEY FK_profile_user (uid),
  CONSTRAINT FK_profile_user FOREIGN KEY (uid)
		REFERENCES tbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tbl_role` (
  role_id tinyint not null primary key auto_increment,
  role_name varchar(50) not null,
  role_label varchar(50) not null,
  role_access varchar(255) not null,
  remark varchar(50) not null,
  pid tinyint not null default 0,
  level tinyint default 0,
  create_time int not null default 0,
  update_time int not null default 0,
  status tinyint not null default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_node (
  node_id tinyint not null primary key auto_increment,
  node_name varchar(100) not null,
  node_label varchar(100) not null,
  pid tinyint not null default 0,
  module_name varchar(50) not null,
  controller_name varchar(50) not null,
  action_name varchar(50) not null,
  node_url varchar(100) not null,
  sort tinyint not null default 0,
  status tinyint not null default 0,
  create_time int not null default 0,
  update_time int not null default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS tbl_role_nav (
  id mediumint  primary key auto_increment,
  nav_name varchar(50) not null,
  sort tinyint not null default 0,
  status tinyint not null default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--    
-- 表的结构 `tbl_coverage`    
--    
CREATE TABLE IF NOT EXISTS `tbl_coverage` (
	`id` INT (10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pid` INT (10) UNSIGNED DEFAULT 0,
	`coverageName` VARCHAR (100) NOT NULL,
	`coverageDesc` VARCHAR (200) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `FK_coverage` (`pid`),
	CONSTRAINT `FK_coverage` FOREIGN KEY (pid)
		REFERENCES tbl_coverage (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci;

--    
-- 转存表中的数据 `tbl_coverage`    
--    
INSERT INTO `tbl_coverage` (
	`id`,
	`pid`,
	`coverageName`,
	`coverageDesc`
)
VALUES
	(16, '', '类别', ''),
	(17, 16, '类别一', ''),
	(18, '', '分类', ''),
	(19, 17, '类别二', '');

--    
-- 限制表 `tbl_coverage`    
--    
#ALTER TABLE `tbl_coverage` ADD CONSTRAINT `coverage_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `tbl_coverage` (`id`) ON DELETE CASCADE;



CREATE TABLE IF NOT EXISTS `tbl_sync_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local_id` int(11) DEFAULT NULL,
  `client_device_id` int(11) DEFAULT NULL,
  `sync_time` int(11) DEFAULT NULL,
  `method`  text COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sync_author` (`author_id`),
  CONSTRAINT `FK_sync_author` FOREIGN KEY (`author_id`) REFERENCES `tbl_tm_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tbl_tm_messages` */

DROP TABLE IF EXISTS `tbl_tm_messages`;

CREATE TABLE `tbl_tm_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `message` text,
  `message_read` tinyint(1) NOT NULL,
  `draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users` (`from_user_id`),
  KEY `fk_messages_users1` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_messages` */

/*Table structure for table `tbl_tm_profile_fields` */

DROP TABLE IF EXISTS `tbl_tm_profile_fields`;

CREATE TABLE `tbl_tm_profile_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `field_group_id` int(3) NOT NULL DEFAULT '0',
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `hint` text,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT 'value',
  `range` varchar(255) NOT NULL DEFAULT 'default',
  `error_message` varchar(255) NOT NULL DEFAULT 'default message',
  `other_validator` varchar(255) NOT NULL DEFAULT 'default ',
  `default` varchar(255) NOT NULL DEFAULT 'default val',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  `editable` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_profile_fields` */

insert  into `tbl_tm_profile_fields`(`id`,`field_group_id`,`varname`,`title`,`hint`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`position`,`visible`,`editable`) values (1,0,'displayname','Display name',NULL,'VARCHAR',255,0,0,'','','','','',0,1,1),(2,0,'firstname','First name',NULL,'VARCHAR',255,0,1,'','','','','',0,2,1),(3,0,'lastname','Last name',NULL,'VARCHAR',255,0,1,'','','','','',0,2,1),(4,0,'email','Email',NULL,'VARCHAR',255,0,1,'','','','','',0,2,0),(5,0,'gender','Gender',NULL,'VARCHAR',255,0,0,'','Female,Male','','','',0,1,1),(6,0,'birthday','Birthday',NULL,'DATE',20,0,0,'','','','','',0,1,1),(7,0,'about','About',NULL,'TEXT',255,0,0,'','','','','',0,1,1);

/*Table structure for table `tbl_tm_profile_fields_group` */

DROP TABLE IF EXISTS `tbl_tm_profile_fields_group`;

CREATE TABLE `tbl_tm_profile_fields_group` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_profile_fields_group` */

/*Table structure for table `tbl_tm_profiles` */

DROP TABLE IF EXISTS `tbl_tm_profiles`;

CREATE TABLE `tbl_tm_profiles` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `privacy` enum('protected','private','public') NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `about` text,
  `street` varchar(255) DEFAULT NULL,
  `displayname` varchar(255) DEFAULT NULL,
  `gender` int(10) DEFAULT NULL,
  `birthday` int(10) DEFAULT NULL,
  PRIMARY KEY (`profile_id`),
  KEY `fk_profiles_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_profiles` */

insert  into `tbl_tm_profiles`(`profile_id`,`user_id`,`timestamp`,`privacy`,`lastname`,`firstname`,`email`,`about`,`street`,`displayname`,`gender`,`birthday`) values (1,1,1302661847,'protected','admin','admin','binhbt@lifetimetech.vn','xxxxxxxxx',NULL,'Thanh Binh',1,-282484800),(7,7,0,'protected','thanh binh gd','bui','thanhbinh.gd@gmail.com',NULL,NULL,'thanhbinh.gd@gmail.com',NULL,NULL);

/*Table structure for table `tbl_tm_roles` */

DROP TABLE IF EXISTS `tbl_tm_roles`;

CREATE TABLE `tbl_tm_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_roles` */

insert  into `tbl_tm_roles`(`id`,`title`,`description`) values (1,'UserCreator','This users can create new Users'),(2,'UserRemover','This users can remove other Users');

/*Table structure for table `tbl_tm_user_has_role` */

DROP TABLE IF EXISTS `tbl_tm_user_has_role`;

CREATE TABLE `tbl_tm_user_has_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_user_has_role` */

insert  into `tbl_tm_user_has_role`(`id`,`user_id`,`role_id`) values (2,35,1);

/*Table structure for table `tbl_tm_user_has_user` */

DROP TABLE IF EXISTS `tbl_tm_user_has_user`;

CREATE TABLE `tbl_tm_user_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_user_has_user` */

/*Table structure for table `tbl_tm_users` */

DROP TABLE IF EXISTS `tbl_tm_users`;

CREATE TABLE `tbl_tm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activationKey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tm_users` */

insert  into `tbl_tm_users`(`id`,`username`,`password`,`activationKey`,`createtime`,`lastvisit`,`superuser`,`status`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','',0,1303300800,1,1),(3,'binhbt@lifetimetech.vn','87bf66b91ec8bceb0b3e0dea7cb92440','5daa28112cd6f5c6e5680d8435a8418e',1294909926,1303300800,1,1),(7,'thanhbinh.gd@gmail.com','e10adc3949ba59abbe56e057f20f883e','17382305deae52ca2a912a626f5a706e',1302264000,1303128000,0,1);



CREATE TABLE IF NOT EXISTS tbl_members
(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(128) NOT NULL,
	realname VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	salt VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	profile TEXT,
	group_id INT NOT NULL DEFAULT 0,
	create_time INT NOT NULL DEFAULT 0,
	update_time INT NOT NULL DEFAULT 0,
	active TINYINT NOT NULL DEFAULT 0,
        status TINYINT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET FOREIGN_KEY_CHECKS=1;
