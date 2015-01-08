CREATE TABLE l_account.access_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED NOT NULL,
	access_token VARCHAR(256),
	refresh_token VARCHAR(256),
	expires_time VARCHAR(21),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX l_account_access_token_user_id ON l_account.access_token (user_id);
CREATE INDEX l_account_access_token_access_token ON l_account.access_token (access_token(255));
CREATE INDEX l_account_access_token_refresh_token ON l_account.access_token (refresh_token(255));