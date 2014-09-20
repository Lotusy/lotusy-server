CREATE TABLE {$dbName}.lookup_dish_business
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	business_id INT(10) UNSIGNED,
	dish_id INT(10) UNSIGNED,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX {$dbName}_dish_business_id ON {$dbName}.lookup_dish_business (business_id);


GRANT ALL ON {$dbName}.* TO '{$uname}'@'%' IDENTIFIED BY '{$passwd}';