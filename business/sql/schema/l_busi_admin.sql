CREATE TABLE {$dbName}.business_admin
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	password VARCHAR(33),
	username VARCHAR(41),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_admin_email_index ON {$dbName}.business_admin (email(60));
CREATE INDEX {$dbName}_admin_password_index ON {$dbName}.business_admin (password(32));


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';

INSERT INTO business_admin (email, password, username) VALUES ('peng.shen@lotusy.com', MD5('Langara2'), 'Peng Shen');