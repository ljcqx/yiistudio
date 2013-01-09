drop table if exists `tbl_lookup`;
drop table if exists `tbl_user`;
drop table if exists `tbl_post`;
drop table if exists `tbl_comment`;
drop table if exists `tbl_tag`;

CREATE TABLE tbl_lookup
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(128) NOT NULL,
	code INTEGER NOT NULL,
	type VARCHAR(128) NOT NULL,
	position INTEGER NOT NULL
);

CREATE TABLE tbl_user
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	username VARCHAR(128) NOT NULL,
	realname VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	salt VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	profile TEXT,
	create_time INTEGER NOT NULL DEFAULT 0,
	update_time INTEGER NOT NULL DEFAULT 0,
        stauts INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE tbl_post
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	title VARCHAR(128) NOT NULL,
	content TEXT NOT NULL,
	tags TEXT,
	status INTEGER NOT NULL,
	create_time INTEGER,
	update_time INTEGER,
	author_id INTEGER NOT NULL,
	CONSTRAINT FK_post_author FOREIGN KEY (author_id)
		REFERENCES tbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE tbl_comment
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	content TEXT NOT NULL,
	status INTEGER NOT NULL,
	create_time INTEGER,
	author VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	url VARCHAR(128),
	post_id INTEGER NOT NULL,
	CONSTRAINT FK_comment_post FOREIGN KEY (post_id)
		REFERENCES tbl_post (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE tbl_tag
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(128) NOT NULL,
	frequency INTEGER DEFAULT 1
);

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



drop table if exists `tbl_assignments`;
drop table if exists `tbl_itemchild`;
drop table if exists `tbl_item`;
drop table if exists `tbl_admin`;

create table 'tbl_item'
(
   "name"                 varchar(64) not null,
   "type"                 integer not null,
   "description"          text,
   "bizrule"              text,
   "data"                 text,
   primary key ("name")
);

create table 'tbl_itemchild'
(
   "parent"               varchar(64) not null,
   "child"                varchar(64) not null,
   primary key ("parent","child"),
   foreign key ("parent") references 'tbl_item' ("name") on delete cascade on update cascade,
   foreign key ("child") references 'tbl_item' ("name") on delete cascade on update cascade
);

create table 'tbl_assignments'
(
   "itemname"             varchar(64) not null,
   "userid"               varchar(64) not null,
   "bizrule"              text,
   "data"                 text,
   primary key ("itemname","userid"),
   foreign key ("itemname") references 'tbl_item' ("name") on delete cascade on update cascade
);


CREATE TABLE tbl_admin
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	username VARCHAR(128) NOT NULL,
	realname VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	salt VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	profile TEXT,
	create_time INTEGER NOT NULL DEFAULT 0,
	update_time INTEGER NOT NULL DEFAULT 0,
	role_id INTEGER NOT NULL 
        stauts INTEGER NOT NULL DEFAULT 0
);