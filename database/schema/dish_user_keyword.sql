CREATE TABLE foodster.dish_user_keyword
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(10) UNSIGNED,
    dish_id INT(10) UNSIGNED,
    keyword_code INT(10) UNSIGNED,

    CONSTRAINT user_activity UNIQUE (dish_id, user_id, keyword_code),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX dish_user_keyword_user ON foodster.dish_user_keyword (user_id);
CREATE INDEX dish_user_keyword_dish ON foodster.dish_user_keyword (dish_id);
CREATE INDEX dish_user_keyword_code ON foodster.dish_user_keyword (keyword_code);