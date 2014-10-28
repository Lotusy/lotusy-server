CREATE TABLE l_business.business_rating
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	food INT(2) UNSIGNED,
	serv INT(2) UNSIGNED,
	env INT(2) UNSIGNED,
	overall INT(2) UNSIGNED,
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX business_rating_business ON l_business.business_rating (business_id);
CREATE INDEX business_rating_user ON l_business.business_rating (user_id);