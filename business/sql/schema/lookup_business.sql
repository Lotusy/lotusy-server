CREATE TABLE {$dbName}.business_user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	business_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_business_user_user_id_index ON {$dbName}.business_user (user_id);
CREATE INDEX {$dbName}_business_user_business_id_index ON {$dbName}.business_user (business_id);


CREATE TABLE {$dbName}.business_zh_name
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	zh_name VARCHAR(61),
	business_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_business_zh_name_zh_name_index ON {$dbName}.business_zh_name (zh_name(60));
CREATE INDEX {$dbName}_business_zh_name_business_id_index ON {$dbName}.business_zh_name (business_id);


CREATE TABLE {$dbName}.business_tw_name
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	tw_name VARCHAR(61),
	business_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_business_tw_name_tw_name_index ON {$dbName}.business_tw_name (tw_name(60));
CREATE INDEX {$dbName}_business_tw_name_business_id_index ON {$dbName}.business_tw_name (business_id);


CREATE TABLE {$dbName}.business_en_name
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	en_name VARCHAR(61),
	business_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_business_en_name_en_name_index ON {$dbName}.business_en_name (en_name(60));
CREATE INDEX {$dbName}_business_en_name_business_id_index ON {$dbName}.business_en_name (business_id);


CREATE TABLE {$dbName}.business_location
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	lat DOUBLE,
	lng DOUBLE,
	business_id INT(10) UNSIGNED,
	verified VARCHAR(2),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_business_location_lat_index ON {$dbName}.business_location (lat);
CREATE INDEX {$dbName}_business_location_lng_index ON {$dbName}.business_location (lng);
CREATE INDEX {$dbName}_business_location_business_id_index ON {$dbName}.business_location (business_id);
CREATE INDEX {$dbName}_business_location_verified_index ON {$dbName}.business_location (verified(1));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';