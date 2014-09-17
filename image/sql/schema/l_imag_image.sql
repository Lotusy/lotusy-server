CREATE TABLE {$dbName}.fast_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(61),
	path VARCHAR(41),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.user_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	name VARCHAR(61),
	path VARCHAR(41),
	is_deleted VARCHAR(2),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_image_user_user_id_index ON {$dbName}.user_image (user_id);
CREATE INDEX {$dbName}_image_user_is_deleted_index ON {$dbName}.user_image (is_deleted(1));


CREATE TABLE {$dbName}.business_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	name VARCHAR(61),
	path VARCHAR(41),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_image_business_business_id_index ON {$dbName}.business_image (business_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';