CREATE TABLE {$dbName}.access_token
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	user_id INT(10) UNSIGNED NOT NULL,
	access_token VARCHAR(256),
	refresh_token VARCHAR(256),
	expires_time VARCHAR(21),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_access_token_user_id ON {$dbName}.access_token (user_id);
CREATE INDEX {$dbName}_access_token_access_token ON {$dbName}.access_token (access_token(255));
CREATE INDEX {$dbName}_access_token_refresh_token ON {$dbName}.access_token (refresh_token(255));

GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';