CREATE TABLE foodster.dish_keyword
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    keyword_code INT(10) UNSIGNED,
    dish_id INT(10) UNSIGNED,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX dish_keyword_dish ON foodster.dish_keyword (dish_id);
CREATE INDEX dish_keyword_code ON foodster.dish_keyword (keyword_code);