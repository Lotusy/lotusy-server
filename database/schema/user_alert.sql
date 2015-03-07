CREATE TABLE foodster.user_alert
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    keyword_code INT(10) UNSIGNED,
    user_id INT(10) UNSIGNED,

    CONSTRAINT user_activity UNIQUE (keyword_code, user_id),

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX user_alert_user ON foodster.user_alert (user_id);
CREATE INDEX user_alert_keyword ON foodster.user_alert (keyword_code);