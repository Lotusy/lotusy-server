CREATE TABLE foodster.dish_user_like
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(10) UNSIGNED,
    dish_id INT(10) UNSIGNED,
    is_like VARCHAR(1),
    create_time DATETIME,

    CONSTRAINT user_activity UNIQUE (user_id, dish_id),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX dish_user_like_user ON foodster.dish_user_like (user_id);
CREATE INDEX dish_user_like_dish ON foodster.dish_user_like (dish_id);
CREATE INDEX dish_user_like_time ON foodster.dish_user_like (create_time);