CREATE TABLE l_business.iterm
(
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    code INT(10) UNSIGNED NOT NULL,
    type VARCHAR(11) NOT NULL,
    language VARCHAR(3) NOT NULL,
    description VARCHAR(128) NOT NULL,
    active VARCHAR(2),
    modyfied_by INT(10) UNSIGNED,
    ctime DATETIME NOT NULL,
    mtime DATETIME NOT NULL,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE INDEX iterm_code ON l_business.iterm (code);
CREATE INDEX iterm_type ON l_business.iterm (type(10));
CREATE INDEX iterm_language ON l_business.iterm (language(2));
CREATE INDEX iterm_active ON l_business.iterm (active(1));
CREATE INDEX iterm_mtime ON l_business.iterm (mtime);

INSERT INTO 
l_business.iterm (code, type, language, description, active, modyfied_by, ctime, mtime)
VALUES 
(1001, 'CUISINE', 'en', 'Chinese - Shanghai', 'Y', 1, NOW(), NOW()),
(1001, 'CUISINE', 'zh', '上海菜', 'Y', 1, NOW(), NOW()),
(1001, 'CUISINE', 'tw', '上海菜', 'Y', 1, NOW(), NOW()),
(1002, 'CUISINE', 'en', 'Chinese - Northern', 'Y', 1, NOW(), NOW()),
(1002, 'CUISINE', 'en', '北方菜', 'Y', 1, NOW(), NOW()),
(1002, 'CUISINE', 'tw', '北方菜', 'Y', 1, NOW(), NOW()),
(1003, 'CUISINE', 'en', 'French', 'Y', 1, NOW(), NOW()),
(1003, 'CUISINE', 'zh', '法式料理', 'Y', 1, NOW(), NOW()),
(1003, 'CUISINE', 'tw', '法式料理', 'Y', 1, NOW(), NOW()),
(1004, 'CUISINE', 'en', 'Italian', 'Y', 1, NOW(), NOW()),
(1004, 'CUISINE', 'zh', '意式料理', 'Y', 1, NOW(), NOW()),
(1004, 'CUISINE', 'tw', '意式料理', 'Y', 1, NOW(), NOW()),
(1005, 'CUISINE', 'en', 'Western', 'Y', 1, NOW(), NOW()),
(1005, 'CUISINE', 'zh', '西餐', 'Y', 1, NOW(), NOW()),
(1005, 'CUISINE', 'tw', '西餐', 'Y', 1, NOW(), NOW()),
(1006, 'CUISINE', 'en', 'Japanese', 'Y', 1, NOW(), NOW()),
(1006, 'CUISINE', 'zh', '日式料理', 'Y', 1, NOW(), NOW()),
(1006, 'CUISINE', 'tw', '日式料理', 'Y', 1, NOW(), NOW()),
(1007, 'CUISINE', 'en', 'Korean', 'Y', 1, NOW(), NOW()),
(1007, 'CUISINE', 'zh', '韩国菜', 'Y', 1, NOW(), NOW()),
(1007, 'CUISINE', 'tw', '韓國菜', 'Y', 1, NOW(), NOW());

INSERT INTO 
l_business.iterm (code, type, language, description, active, modyfied_by, ctime, mtime)
VALUES 
(2001, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2001, 'KEYWORD', 'zh', '精致', 'Y', 1, NOW(), NOW()),
(2001, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2002, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2002, 'KEYWORD', 'zh', '辣', 'Y', 1, NOW(), NOW()),
(2002, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2003, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2003, 'KEYWORD', 'zh', '火锅', 'Y', 1, NOW(), NOW()),
(2003, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2004, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2004, 'KEYWORD', 'zh', '难吃', 'Y', 1, NOW(), NOW()),
(2004, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2005, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2005, 'KEYWORD', 'zh', '环境幽雅', 'Y', 1, NOW(), NOW()),
(2005, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2006, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2006, 'KEYWORD', 'zh', '环境差', 'Y', 1, NOW(), NOW()),
(2006, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2007, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2007, 'KEYWORD', 'zh', '服务优质', 'Y', 1, NOW(), NOW()),
(2007, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2008, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2008, 'KEYWORD', 'zh', '服务差', 'Y', 1, NOW(), NOW()),
(2008, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2009, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2009, 'KEYWORD', 'zh', '好吃', 'Y', 1, NOW(), NOW()),
(2009, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2010, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2010, 'KEYWORD', 'zh', '回味', 'Y', 1, NOW(), NOW()),
(2010, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()), 
(2011, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2011, 'KEYWORD', 'zh', '值得再来', 'Y', 1, NOW(), NOW()),
(2011, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW()),
(2012, 'KEYWORD', 'en', '', 'Y', 1, NOW(), NOW()),
(2012, 'KEYWORD', 'zh', '不再来了', 'Y', 1, NOW(), NOW()),
(2012, 'KEYWORD', 'tw', '', 'Y', 1, NOW(), NOW());