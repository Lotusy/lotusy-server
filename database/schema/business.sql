CREATE TABLE foodster.business
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    external_id VARCHAR(21),
    external_type SMALLINT,
    user_id INT(10) UNSIGNED,
    name_zh VARCHAR(61),
    name_tw VARCHAR(61),
    name_en VARCHAR(61),
    category VARCHAR(21),
    image VARCHAR(121),
    street VARCHAR(21),
    city VARCHAR(21),
    state VARCHAR(21),
    country VARCHAR(21),
    zip VARCHAR(8),
    lat DOUBLE,
    lng DOUBLE,
    price VARCHAR(6),
    hours VARCHAR(256),
    cash_only VARCHAR(2),
    verified VARCHAR(2),
    tel VARCHAR(16),
    website VARCHAR(41),
    social VARCHAR(256),

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX business_external_id ON foodster.business (external_id(20));
CREATE INDEX business_external_type ON foodster.business (external_type);
CREATE INDEX business_user ON foodster.business (user_id);
CREATE INDEX business_category ON foodster.business (category(20));
CREATE INDEX business_name_zh ON foodster.business (name_zh(60));
CREATE INDEX business_name_tw ON foodster.business (name_tw(60));
CREATE INDEX business_name_en ON foodster.business (name_en(60));
CREATE INDEX business_lat ON foodster.business (lat);
CREATE INDEX business_lng ON foodster.business (lng);
CREATE INDEX business_verified ON foodster.business (verified(1));