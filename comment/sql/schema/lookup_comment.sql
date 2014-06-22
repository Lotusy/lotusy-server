CREATE TABLE {$dbName}.comment_user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	comment_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_comment_user_user_id_index ON {$dbName}.comment_user (user_id);
CREATE INDEX {$dbName}_comment_user_comment_id_index ON {$dbName}.comment_user (comment_id);
CREATE INDEX {$dbName}_comment_user_create_time_index ON {$dbName}.comment_user (create_time);


CREATE TABLE {$dbName}.comment_business
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	comment_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_comment_business_business_id_index ON {$dbName}.comment_business (business_id);
CREATE INDEX {$dbName}_comment_business_comment_id_index ON {$dbName}.comment_business (comment_id);
CREATE INDEX {$dbName}_comment_business_create_time_index ON {$dbName}.comment_business (create_time);


CREATE TABLE {$dbName}.comment_location
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	lat DOUBLE,
	lng DOUBLE,
	comment_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_comment_location_lat_index ON {$dbName}.comment_location (lat);
CREATE INDEX {$dbName}_comment_location_lng_index ON {$dbName}.comment_location (lng);
CREATE INDEX {$dbName}_comment_location_comment_id_index ON {$dbName}.comment_location (comment_id);
CREATE INDEX {$dbName}_comment_location_create_time_index ON {$dbName}.comment_location (create_time);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';