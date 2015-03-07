CREATE TABLE foodster.image_user
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(10) UNSIGNED,
    name VARCHAR(61),
    path VARCHAR(41),
    is_deleted VARCHAR(2),
    create_time DATETIME,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX image_user_user_id_index ON foodster.image_user (user_id);
CREATE INDEX image_user_is_deleted_index ON foodster.image_user (is_deleted(1));