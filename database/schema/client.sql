CREATE TABLE foodster.client
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	app_key VARCHAR(33) NOT NULL,
	name VARCHAR(41) NOT NULL,
	scope VARCHAR(256) NOT NULL,
	create_time DATETIME NOT NULL,
	modified_time DATETIME NOT NULL,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX app_key_index ON foodster.client (app_key(32));

INSERT INTO client (app_key, name, scope, create_time, modified_time) VALUES ('E268443E43D93DAB7EBEF303BBE9642F', 'account', 'account+business+comment+image', NOW(), NOW());
INSERT INTO client (app_key, name, scope, create_time, modified_time) VALUES ('F5D7E2532CC9AD16BC2A41222D76F269', 'business', 'account+business+comment+image', NOW(), NOW());
INSERT INTO client (app_key, name, scope, create_time, modified_time) VALUES ('06D4CD63BDE972FC66A0AED41D2F5C51', 'comment', 'account+business+comment+image', NOW(), NOW());
INSERT INTO client (app_key, name, scope, create_time, modified_time) VALUES ('78805A221A988E79EF3F42D7C5BFD418', 'image', 'account+business+comment+image', NOW(), NOW());
INSERT INTO client (app_key, name, scope, create_time, modified_time) VALUES ('9D0E7CE8711F6F1CF87704557828A16E', 'lotusy-mobile', 'account+business+comment+image', NOW(), NOW());
INSERT INTO client (app_key, name, scope, create_time, modified_time) VALUES ('30FB325B721E39C215F085EB9E883FC6', 'lotusy-web', 'account+business+comment+image', NOW(), NOW());