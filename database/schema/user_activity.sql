CREATE TABLE foodster.user_activity
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(10) UNSIGNED,
	type SMALLINT UNSIGNED,
	data TEXT,
    create_time DATETIME,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_user_activity_user ON foodster.user_activity (user_id);
CREATE INDEX foodster_user_activity_type ON foodster.user_activity (type);