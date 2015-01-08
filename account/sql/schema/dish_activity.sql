CREATE TABLE l_account.dish_activity
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,
	activity TINYINT UNSIGNED,
	create_time DATETIME,

	CONSTRAINT user_follower UNIQUE (user_id, dish_id, activity),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX l_account_dish_activity_user_id ON l_account.dish_activity (user_id);
CREATE INDEX l_account_dish_activity_activity ON l_account.dish_activity (activity);
CREATE INDEX l_account_dish_activity_create_time ON l_account.dish_activity (create_time);