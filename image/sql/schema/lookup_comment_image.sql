CREATE TABLE {$dbName}.business_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	image_id INT(10) UNSIGNED,
	business_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_business_image_image_id_index ON {$dbName}.business_image (image_id);
CREATE INDEX {$dbName}_business_image_business_id_index ON {$dbName}.business_image (business_id);
CREATE INDEX {$dbName}_business_image_create_time_index ON {$dbName}.business_image (create_time);


CREATE TABLE {$dbName}.user_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	image_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_user_image_image_id_index ON {$dbName}.user_image (image_id);
CREATE INDEX {$dbName}_user_image_user_id_index ON {$dbName}.user_image (user_id);
CREATE INDEX {$dbName}_user_image_create_time_index ON {$dbName}.user_image (create_time);


CREATE TABLE {$dbName}.comment_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	image_id INT(10) UNSIGNED,
	comment_id INT(10) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_comment_image_image_id_index ON {$dbName}.comment_image (image_id);
CREATE INDEX {$dbName}_comment_image_comment_id_index ON {$dbName}.comment_image (comment_id);
CREATE INDEX {$dbName}_comment_image_create_time_index ON {$dbName}.comment_image (create_time);



GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';