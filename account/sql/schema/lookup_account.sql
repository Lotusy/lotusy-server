CREATE TABLE {$dbName}.user_external
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	external_type INT(2) UNSIGNED,
	external_ref VARCHAR(16),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_external_external_type_index ON {$dbName}.user_external (external_type);
CREATE INDEX {$dbName}_user_external_external_ref_index ON {$dbName}.user_external (external_ref(15));
CREATE INDEX {$dbName}_user_external_user_id_index ON {$dbName}.user_external (user_id);


CREATE TABLE {$dbName}.user_nickname
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	nickname VARCHAR(41),
	user_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_external_nickname_index ON {$dbName}.user_nickname (nickname(40));
CREATE INDEX {$dbName}_user_external_user_id_index ON {$dbName}.user_nickname (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';