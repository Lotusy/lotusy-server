CREATE TABLE foodster.image_business
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    business_id INT(10) UNSIGNED,
    name VARCHAR(61),
    path VARCHAR(41),
    create_time DATETIME,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX image_business_business_id_index ON foodster.image_business (business_id);