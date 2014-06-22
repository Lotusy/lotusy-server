CREATE TABLE {$dbName}.user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	external_type INT(2) UNSIGNED,
	external_ref VARCHAR(16),
	username VARCHAR(41),
	nickname VARCHAR(41),
	profile_pic VARCHAR(121),
	description VARCHAR(256),
	last_login DATETIME,
	superuser VARCHAR(2),
	blocked VARCHAR(2),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_external_type_index ON {$dbName}.user (external_type);
CREATE INDEX {$dbName}_user_external_ref_index ON {$dbName}.user (external_ref(15));
CREATE INDEX {$dbName}_user_nickname_index ON {$dbName}.user (nickname(40));
CREATE INDEX {$dbName}_user_super_user_index ON {$dbName}.user (superuser(1));
CREATE INDEX {$dbName}_user_blocked_index ON {$dbName}.user (blocked(1));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';