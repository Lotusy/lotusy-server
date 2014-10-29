CREATE TABLE l_business.iterm
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    code VARCHAR(21) NOT NULL,
    type VARCHAR(21) NOT NULL,
    language VARCHAR(3) NOT NULL,
    description VARCHAR(128) NOT NULL,
    active VARCHAR(2),
    admin_create INT(10) UNSIGNED,
    last_modify INT(10) UNSIGNED,
    ctime DATETIME NOT NULL,
    mtime DATETIME NOT NULL,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX iterm_code ON l_business.iterm (code(20));
CREATE INDEX iterm_language ON l_business.iterm (language(2));
CREATE INDEX iterm_active ON l_business.iterm (active(1));
CREATE INDEX iterm_mtime ON l_business.iterm (mtime);

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('SHANGHAI', 'CUISINE', 'en', 'Chinese - Shanghai', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('SHANGHAI', 'CUISINE', 'zh', '上海菜', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('SHANGHAI', 'CUISINE', 'tw', '上海菜', 'Y', '1', '1', NOW(), NOW());

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('NORTH', 'CUISINE', 'en', 'Chinese - Northern', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('NORTH', 'CUISINE', 'en', '北方菜', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('NORTH', 'CUISINE', 'tw', '北方菜', 'Y', '1', '1', NOW(), NOW());

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('FRENCH', 'CUISINE', 'en', 'French', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('FRENCH', 'CUISINE', 'zh', '法式料理', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('FRENCH', 'CUISINE', 'tw', '法式料理', 'Y', '1', '1', NOW(), NOW());

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('ITALIAN', 'CUISINE', 'en', 'Italian', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('ITALIAN', 'CUISINE', 'zh', '意式料理', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('ITALIAN', 'CUISINE', 'tw', '意式料理', 'Y', '1', '1', NOW(), NOW());

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('WESTERN', 'CUISINE', 'en', 'Western', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('WESTERN', 'CUISINE', 'zh', '西餐', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('WESTERN', 'CUISINE', 'tw', '西餐', 'Y', '1', '1', NOW(), NOW());

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('JAPANESE', 'CUISINE', 'en', 'Japanese', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('JAPANESE', 'CUISINE', 'zh', '日式料理', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('JAPANESE', 'CUISINE', 'tw', '日式料理', 'Y', '1', '1', NOW(), NOW());

INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('KOREAN', 'CUISINE', 'en', 'Korean', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('KOREAN', 'CUISINE', 'zh', '韩国菜', 'Y', '1', '1', NOW(), NOW());
INSERT INTO l_business.iterm (code, type, language, description, active, admin_create, last_modify, ctime, mtime)
 VALUES ('KOREAN', 'CUISINE', 'tw', '韓國菜', 'Y', '1', '1', NOW(), NOW());