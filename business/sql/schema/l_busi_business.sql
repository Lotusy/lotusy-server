CREATE TABLE {$dbName}.business
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	external_id VARCHAR(20),
	external_type SMALLINT,
	user_id INT(10) UNSIGNED,
	name_zh VARCHAR(61),
	name_tw VARCHAR(61),
	name_en VARCHAR(61),
	image VARCHAR(121),
	street VARCHAR(21),
	city VARCHAR(21),
	state VARCHAR(21),
	country VARCHAR(21),
	zip VARCHAR(8),
	lat DOUBLE,
	lng DOUBLE,
	price VARCHAR(6),
	hours VARCHAR(256),
	cash_only VARCHAR(2),
	verified VARCHAR(2),
	tel VARCHAR(16),
	website VARCHAR(41),
	social VARCHAR(256),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.dish
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	name_zh VARCHAR(32),
	name_tw VARCHAR(32),
	name_en VARCHAR(32),
	verified VARCHAR(1),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.rating
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	food INT(2) UNSIGNED,
	serv INT(2) UNSIGNED,
	env INT(2) UNSIGNED,
	overall INT(2) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_rating_business_id_index ON {$dbName}.rating (business_id);
CREATE INDEX {$dbName}_rating_user_id_index ON {$dbName}.rating (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';