CREATE TABLE foodster.user_external
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    type SMALLINT UNSIGNED,
    reference VARCHAR(33),
    user_id INT(10) UNSIGNED,
    profile_pic VARCHAR(121),
    username VARCHAR(41),
    create_time DATETIME,

    CONSTRAINT user_external_ref UNIQUE (type, reference),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_user_external_type ON foodster.user_external (type);
CREATE INDEX foodster_user_external_ref ON foodster.user_external (reference(32));
CREATE INDEX foodster_user_external_user ON foodster.user_external (user_id);