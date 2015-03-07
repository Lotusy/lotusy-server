CREATE TABLE foodster.image_signature
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(10) UNSIGNED,
    name VARCHAR(61),
    path VARCHAR(41),
    create_time DATETIME,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX image_signature_user ON foodster.image_signature (user_id);