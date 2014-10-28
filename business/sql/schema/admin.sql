CREATE TABLE l_business.admin
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(61),
	password VARCHAR(33),
	username VARCHAR(41),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX admin_email ON l_business.admin (email(60));
CREATE INDEX admin_password ON l_business.admin (password(32));


INSERT INTO admin (email, password, username) VALUES ('peng.shen@lotusy.com', MD5('Langara2'), 'Peng Shen');