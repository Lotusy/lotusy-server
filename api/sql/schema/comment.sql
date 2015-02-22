CREATE TABLE foodster.comment
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	lat DOUBLE,
	lng DOUBLE,
	message VARCHAR(513),
	like_count INT UNSIGNED,
	dislike_count INT UNSIGNED,
	is_deleted VARCHAR(2),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_comment_business ON foodster.comment (business_id);
CREATE INDEX foodster_comment_user ON foodster.comment (user_id);
CREATE INDEX foodster_comment_dish ON foodster.comment (dish_id);