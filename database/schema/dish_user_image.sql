CREATE TABLE foodster.dish_user_image
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	image_id INT(10) UNSIGNED,

	CONSTRAINT user_activity UNIQUE (user_id, dish_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX dish_user_image_user ON foodster.dish_user_image (user_id);
CREATE INDEX dish_user_image_dish ON foodster.dish_user_image (dish_id);