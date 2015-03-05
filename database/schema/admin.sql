CREATE TABLE foodster.admin
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	password VARCHAR(33),
	username VARCHAR(41),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_admin_email_index ON foodster.admin (email(60));
CREATE INDEX foodster_admin_password_index ON foodster.admin (password(32));

INSERT INTO admin (email, password, username) VALUES ('peng.shen@foodster.club', MD5('Langara2'), 'Peng Shen');