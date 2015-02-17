CREATE TABLE l_comment.reply
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	comment_id INT(10) UNSIGNED,
	user_id INT(10) UNSIGNED,
	nickname VARCHAR(41),
	message VARCHAR(513),
	create_time DATETIME,

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX l_comment_reply_comment ON l_comment.reply (comment_id);
CREATE INDEX l_comment_reply_user ON l_comment.reply (user_id);