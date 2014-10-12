CREATE TABLE {$dbName}.lookup_user_external
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	type TINYINT(2) UNSIGNED,
	reference VARCHAR(33),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_external_type ON {$dbName}.lookup_user_external (type);
CREATE INDEX {$dbName}_user_external_reference ON {$dbName}.lookup_user_external (reference(32));
CREATE INDEX {$dbName}_user_external_user_id ON {$dbName}.lookup_user_external (user_id);


CREATE TABLE {$dbName}.lookup_user_nickname
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	nickname VARCHAR(41),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_nickname_nickname ON {$dbName}.lookup_user_nickname (nickname(40));
CREATE INDEX {$dbName}_user_nickname_user_id ON {$dbName}.lookup_user_nickname (user_id);


CREATE TABLE {$dbName}.lookup_user_email
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(129),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_email_email ON {$dbName}.lookup_user_email (email(128));


CREATE TABLE {$dbName}.lookup_user_dish
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_dish_user ON {$dbName}.lookup_user_dish (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';