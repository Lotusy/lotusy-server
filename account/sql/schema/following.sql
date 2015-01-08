CREATE TABLE l_account.following
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED,
	following_id INT(10) UNSIGNED,

	CONSTRAINT user_following UNIQUE (user_id, following_id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX l_account_following_user_id ON l_account.following (user_id);