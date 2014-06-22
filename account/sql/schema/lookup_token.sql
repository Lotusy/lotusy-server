CREATE TABLE {$dbName}.refresh_access
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	refresh_token VARCHAR(256),
	access_token VARCHAR(256),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_token_access_access_token_index ON {$dbName}.refresh_access (access_token(255));
CREATE INDEX {$dbName}_token_access_refresh_token_index ON {$dbName}.refresh_access (refresh_token(255));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';