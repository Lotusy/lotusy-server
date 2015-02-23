CREATE TABLE foodster.image_fast
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	comment_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	name VARCHAR(61),
	path VARCHAR(41),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;