CREATE TABLE foodster.image_fast
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	comment_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	business_id INT(10) UNSIGNED,
	name VARCHAR(61),
	path VARCHAR(41),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX image_fast_user ON foodster.image_fast (user_id);
CREATE INDEX image_fast_dish ON foodster.image_fast (dish_id);
CREATE INDEX image_fast_comment ON foodster.image_fast (comment_id);
CREATE INDEX image_fast_business ON foodster.image_fast (business_id);