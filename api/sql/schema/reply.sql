CREATE TABLE foodster.reply
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	comment_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	nickname VARCHAR(41),
	message VARCHAR(513),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX foodster_reply_comment ON foodster.reply (comment_id);
CREATE INDEX foodster_reply_user ON foodster.reply (user_id);