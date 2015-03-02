CREATE TABLE foodster.access_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED NOT NULL,
	access_token VARCHAR(256),
	refresh_token VARCHAR(256),
	expires_time VARCHAR(21),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_access_token_user_id ON foodster.access_token (user_id);
CREATE INDEX foodster_access_token_access_token ON foodster.access_token (access_token(255));
CREATE INDEX foodster_access_token_refresh_token ON foodster.access_token (refresh_token(255));