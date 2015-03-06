CREATE TABLE foodster.follower
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	follower_id INT(10) UNSIGNED,
	create_time DATETIME,

	CONSTRAINT user_follower UNIQUE (user_id, follower_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_follower_user_id ON foodster.follower (user_id);