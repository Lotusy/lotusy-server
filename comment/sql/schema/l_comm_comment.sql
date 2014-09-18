CREATE TABLE {$dbName}.comment
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	lat DOUBLE,
	lng DOUBLE,
	message VARCHAR(513),
	like_count INT UNSIGNED,
	dislike_count INT UNSIGNED,
	is_deleted VARCHAR(2),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.reply
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	comment_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	nickname VARCHAR(41),
	message VARCHAR(513),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_reply_comment_id_index ON {$dbName}.reply (comment_id);
CREATE INDEX {$dbName}_reply_user_id_index ON {$dbName}.reply (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';