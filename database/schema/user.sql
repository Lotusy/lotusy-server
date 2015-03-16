CREATE TABLE foodster.user
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(128),
    phone VARCHAR(16),
    password VARCHAR(41),
    username VARCHAR(41),
    nickname VARCHAR(41),
    gender VARCHAR(1),
    rank VARCHAR(11),
    description VARCHAR(256),
    last_login DATETIME,
    superuser VARCHAR(2),
    blocked VARCHAR(2),

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_user_email ON foodster.user (email(127));
CREATE INDEX foodster_user_phone ON foodster.user (phone(15));
CREATE INDEX foodster_user_nickname ON foodster.user (nickname(40));
CREATE INDEX foodster_user_rank ON foodster.user (rank(10));
CREATE INDEX foodster_user_superuser ON foodster.user (superuser(1));
CREATE INDEX foodster_user_blocked ON foodster.user (blocked(1));