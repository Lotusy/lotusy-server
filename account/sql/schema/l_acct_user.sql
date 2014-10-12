CREATE TABLE {$dbName}.user
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	external_type INT(2) UNSIGNED,
	external_ref VARCHAR(33),
	email VARCHAR(128),
	password VARCHAR(41),
	username VARCHAR(41),
	nickname VARCHAR(41),
	gender VARCHAR(1),
	profile_pic VARCHAR(121),
	description VARCHAR(256),
	last_login DATETIME,
	superuser VARCHAR(2),
	blocked VARCHAR(2),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;


CREATE TABLE {$dbName}.following
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	following_id INT(10) UNSIGNED,

	CONSTRAINT user_following UNIQUE (user_id, following_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_following_user_id ON {$dbName}.following (user_id);


CREATE TABLE {$dbName}.follower
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	follower_id INT(10) UNSIGNED,

	CONSTRAINT user_follower UNIQUE (user_id, follower_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_follower_user_id ON {$dbName}.follower (user_id);


CREATE TABLE {$dbName}.dish_collection
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,

	CONSTRAINT user_follower UNIQUE (user_id, dish_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_collection_user_id ON {$dbName}.dish_collection (user_id);


CREATE TABLE {$dbName}.dish_hitlist
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,

	CONSTRAINT user_follower UNIQUE (user_id, dish_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_hitlist_dish_user_id ON {$dbName}.dish_hitlist (user_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';