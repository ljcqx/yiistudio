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
CREATE TABLE
IF NOT EXISTS `tbl_coverage` (
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


SET FOREIGN_KEY_CHECKS=1;
