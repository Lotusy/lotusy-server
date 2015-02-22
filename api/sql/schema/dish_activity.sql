CREATE TABLE foodster.dish_activity
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	activity TINYINT UNSIGNED,
	create_time DATETIME,

	CONSTRAINT user_follower UNIQUE (user_id, dish_id, activity),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_dish_activity_user_id ON foodster.dish_activity (user_id);
CREATE INDEX foodster_dish_activity_activity ON foodster.dish_activity (activity);
CREATE INDEX foodster_dish_activity_create_time ON foodster.dish_activity (create_time);