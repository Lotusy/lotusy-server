CREATE TABLE foodster.image_dish
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	dish_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	name VARCHAR(61),
	path VARCHAR(41),
	is_default VARCHAR(2),
	is_deleted VARCHAR(2),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX image_dish_user ON foodster.image_dish (user_id);
CREATE INDEX image_dish_dish ON foodster.image_dish (dish_id);
CREATE INDEX image_dish_default ON foodster.image_dish (is_default(1));
CREATE INDEX image_dish_delete ON foodster.image_dish (is_deleted(1));