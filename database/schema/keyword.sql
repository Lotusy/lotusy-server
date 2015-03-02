CREATE TABLE foodster.keyword
(
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	code INT(10) UNSIGNED,
	color VARCHAR(8),

	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX keyword_code ON foodster.keyword (code);

INSERT INTO 
foodster.keyword (code, color)
VALUES
(2001, '#ffd97d'),
(2002, '#e2975d'),
(2003, '#813a26'),
(2004, '#af8a5f'),
(2005, '#a34974'),
(2006, '#bce368'),
(2007, '#e26552'),
(2008, '#583d31'),
(2009, '#eb8a70'),
(2010, '#bc6367'),
(2011, '#447c69'),
(2012, '#cdc39d'),
(2013, '#84b1ed'),
(2014, '#515749'),
(2015, '#fac699'),
(2016, '#5d594f'),
(2017, '#e76278'),
(2018, '#eddbc3'),
(2019, '#f29670'),
(2020, '#a8c9c8'),
(2021, '#8e8c6d'),
(2022, '#a1d5d3'),
(2023, '#a67d6c'),
(2024, '#edbba5'),
(2025, '#8eb59c'),
(2026, '#b7ae9d'),
(2027, '#73c493'),
(2028, '#e8c571');
