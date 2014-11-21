CREATE TABLE l_business.dish_infograph
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	dish_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	item_value SMALLINT UNSIGNED,
	portion_size TINYINT UNSIGNED,
	presentation TINYINT UNSIGNED,
	uniqueness TINYINT UNSIGNED,

	CONSTRAINT user_dish UNIQUE (dish_id, user_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX dish_infograph_dish ON l_business.dish_infograph (dish_id);
CREATE INDEX dish_infograph_user ON l_business.dish_infograph (user_id);
