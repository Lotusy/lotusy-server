-- user table
INSERT INTO foodster.user 
(email,phone,password,username,nickname,gender,rank,description,last_login,superuser,blocked)
VALUES 
(NULL,NULL,NULL,'TestUser0','testuser0',NULL,'5002',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser1','testuser1',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser2','testuser2',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser3','testuser3',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser4','testuser4',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser5','testuser5',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser6','testuser6',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser7','testuser7',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser8','testuser8',NULL,'5001',NULL,'N','N',NULL),
(NULL,NULL,NULL,'TestUser9','testuser9',NULL,'5001',NULL,'N','N',NULL);

INSERT INTO foodster.business
(external_id,external_type,user_id,name_zh,name_tw,name_en,category,image,street,city,state,country,zip,lat,lng,price,hours,cash_only,verified,tel,website,social)
VALUES 
(NULL,NULL,1,'Test Business 1 - zh','Test Business 1 - tw','Test Business 1 - en',1001,'','10209 King George Hwy','Surrey','BC','CA','V3T2W6',49.1880584,-122.8455534,'$','{\"Mon-Thu\":\"10:30am - 12:00am\",\"Fri-Sat\":\"10:30am - 1:00am\",\"Sun\":\"10:30am - 12:00am\"}','Y','N','1-778-395-8899','','\n'),
(NULL,NULL,1,'Test Business 2 - zh','Test Business 2 - tw','Test Business 2 - en',1001,'','9948 Lougheed Hwy','Burnaby','BC','CA','V3N4M7',49.2484904,-122.8975716,'$$','{\"Mon-Sun\":\"9:00am - 10:00pm\"}','N','N','1-604-421-8823','http://www.yansgardenrestaurant.ca/','\n'),
(NULL,NULL,1,'Test Business 3 - zh','Test Business 3 - tw','Test Business 3 - en',1001,'','4850 Imperial Street','Burnaby','BC','CA','',49.2219351,-122.9946451,'$','{}','N','N','1-604-437-0828','','\n'),
(NULL,NULL,1,'Test Business 4 - zh','Test Business 4 - tw','Test Business 4 - en',1001,'','2808 Commercial Dr','Vancouver','BC','CA','V5N4C6',49.2594131,-123.069685,'$$','{}','N','N','1-604-254-7434','','\n'),
(NULL,NULL,1,'Test Business 5 - zh','Test Business 5 - tw','Test Business 5 - en',1001,'','128-8531 Alexandra Ro','Richmond','BC','CA','V6X1C3',49.1784588,-123.1284028,'','{\"Mon-Sat\":\"2pm - 12am\",\"Sun\":\"Closed\"}','N','N','1-604-765-1266','','\n'),
(NULL,NULL,1,'Test Business 6 - zh','Test Business 6 - tw','Test Business 6 - en',1001,'','150-4231 Hazelbridge ','Richmod','BC','CA','V6X3L7',49.1825466,-123.1341918,'$','{\"Mon\":\"7:15am - 10:00pm\",\"Tue\":\"7:15am - 6:00pm\",\"Wed-Sun\":\"7:15am - 10:00pm\"}','N','N','1-604-231-0055','','\n'),
(NULL,NULL,1,'Test Business 7 - zh','Test Business 7 - tw','Test Business 7 - en',1002,'','188 - 8131 Westminste','Richmod','BC','CA','V6X1A7',49.1702904,-123.134854,'$$','{}','N','N','1-604-271-8266','','\n'),
(NULL,NULL,1,'Test Business 8 - zh','Test Business 8 - tw','Test Business 8 - en',1003,'','1190-4311 Hazelbridge','Richmod','BC','CA','V6X1E4',49.181971,-123.1336621,'$','{\"Mon-Sun\":\"11:00am - 11:00pm\"}','N','N','1-604-304-3351','','\n'),
(NULL,NULL,1,'Test Business 9 - zh','Test Business 9 - tw','Test Business 9 - en',1004,'','100-3791 Bayview Stre','Richmond','BC','CA','V7E3B6',49.123987,-123.1827964,'$$','{\"Mon\":\"10:30am - 10:00pm\",\"Tue\":\"Closed\",\"Wed-Sun\":\"10:30am - 10:00pm\"}','N','N','1-604-275-1112','http://www.timmykitchen.com/','\n'),
(NULL,NULL,1,'Test Business 10 - zh','Test Business 10 - tw','Test Business 10 - en',1005,'','3048 Kingsway','Vancouver','BC','CA','V5R5J7',49.2356031,-123.0412871,'$','{}','Y','N','1-604-558-3048','','https://www.facebook.com/pages/%E9%84%89%E9%9F%B3%E9%96%A3-Yangs-Hotpot-BBQ-Restaurant/103960489696657\n');

INSERT INTO foodster.dish
(business_id,user_id,name_zh,name_tw,name_en,verified,like_count,dislike_count,create_time)
VALUES
(1,1,'Test Dish 1 - zh','Test Dish 1 - tw','Test Dish 1','N',7,3,NOW()),
(2,2,'Test Dish 2 - zh','Test Dish 2 - tw','Test Dish 2','N',1,0,NOW()),
(3,3,'Test Dish 3 - zh','Test Dish 3 - tw','Test Dish 3','N',1,0,NOW()),
(4,4,'Test Dish 4 - zh','Test Dish 4 - tw','Test Dish 4','N',1,0,NOW()),
(5,5,'Test Dish 5 - zh','Test Dish 5 - tw','Test Dish 5','N',1,0,NOW()),
(6,6,'Test Dish 6 - zh','Test Dish 6 - tw','Test Dish 6','N',1,0,NOW()),
(7,7,'Test Dish 7 - zh','Test Dish 7 - tw','Test Dish 7','N',1,0,NOW()),
(8,8,'Test Dish 8 - zh','Test Dish 8 - tw','Test Dish 8','N',1,0,NOW()),
(9,9,'Test Dish 9 - zh','Test Dish 9 - tw','Test Dish 9','N',1,0,NOW()),
(10,10,'Test Dish 10 - zh','Test Dish 10 - tw','Test Dish 10','N',1,0,NOW()),
(10,1,'Test Dish 11 - zh','Test Dish 11 - tw','Test Dish 11','N',0,0,NOW()),
(9,2,'Test Dish 12 - zh','Test Dish 12 - tw','Test Dish 12','N',0,0,NOW()),
(8,3,'Test Dish 13 - zh','Test Dish 13 - tw','Test Dish 13','N',0,0,NOW()),
(7,4,'Test Dish 14 - zh','Test Dish 14 - tw','Test Dish 14','N',0,0,NOW()),
(6,5,'Test Dish 15 - zh','Test Dish 15 - tw','Test Dish 15','N',0,0,NOW()),
(5,6,'Test Dish 16 - zh','Test Dish 16 - tw','Test Dish 16','N',0,0,NOW()),
(4,7,'Test Dish 17 - zh','Test Dish 17 - tw','Test Dish 17','N',0,0,NOW()),
(3,8,'Test Dish 18 - zh','Test Dish 18 - tw','Test Dish 18','N',0,0,NOW()),
(2,9,'Test Dish 19 - zh','Test Dish 19 - tw','Test Dish 19','N',0,0,NOW()),
(1,5,'Test Dish 20 - zh','Test Dish 20 - tw','Test Dish 20','N',0,0,NOW()),
(10,6,'Test Dish 21 - zh','Test Dish 21 - tw','Test Dish 21','N',0,0,NOW()),
(9,7,'Test Dish 22 - zh','Test Dish 22 - tw','Test Dish 22','N',0,0,NOW()),
(8,8,'Test Dish 23 - zh','Test Dish 23 - tw','Test Dish 23','N',0,0,NOW()),
(7,9,'Test Dish 24 - zh','Test Dish 24 - tw','Test Dish 24','N',0,0,NOW()),
(6,10,'Test Dish 25 - zh','Test Dish 25 - tw','Test Dish 25','N',0,0,NOW()),
(5,1,'Test Dish 26 - zh','Test Dish 26 - tw','Test Dish 26','N',0,0,NOW()),
(4,2,'Test Dish 27 - zh','Test Dish 27 - tw','Test Dish 27','N',0,0,NOW()),
(3,3,'Test Dish 28 - zh','Test Dish 28 - tw','Test Dish 28','N',0,0,NOW()),
(2,4,'Test Dish 29 - zh','Test Dish 29 - tw','Test Dish 29','N',0,0,NOW()),
(1,5,'Test Dish 30 - zh','Test Dish 30 - tw','Test Dish 30','N',0,0,NOW());

INSERT INTO foodster.comment
(business_id,user_id,dish_id,lat,lng,message,like_count,dislike_count,is_deleted,create_time)
VALUES
(1,1,1,49.19,-122.85,'Test Message b1 u1',0,0,'N',NOW()),
(1,2,1,49.19,-122.85,'Test Message b1 u2',0,0,'N',NOW()),
(1,3,1,49.19,-122.85,'Test Message b1 u3',0,0,'N',NOW()),
(1,4,1,49.19,-122.85,'Test Message b1 u4',0,0,'N',NOW()),
(1,5,1,49.19,-122.85,'Test Message b1 u5',0,0,'N',NOW()),
(1,6,1,49.19,-122.85,'Test Message b1 u6',0,0,'N',NOW()),
(1,7,1,49.19,-122.85,'Test Message b1 u7',0,0,'N',NOW()),
(1,8,1,49.19,-122.85,'Test Message b1 u8',0,0,'N',NOW()),
(1,9,1,49.19,-122.85,'Test Message b1 u9',0,0,'N',NOW()),
(1,10,1,49.19,-122.85,'Test Message b1 u10',0,0,'N',NOW()),
(2,1,2,49.19,-122.85,'Test Message b2 u1',0,0,'N',NOW()),
(2,2,2,49.19,-122.85,'Test Message b2 u2',0,0,'N',NOW()),
(2,3,2,49.19,-122.85,'Test Message b2 u3',0,0,'N',NOW()),
(2,4,2,49.19,-122.85,'Test Message b2 u4',0,0,'N',NOW()),
(2,5,2,49.19,-122.85,'Test Message b2 u5',0,0,'N',NOW()),
(2,6,2,49.19,-122.85,'Test Message b2 u6',0,0,'N',NOW()),
(2,7,2,49.19,-122.85,'Test Message b2 u7',0,0,'N',NOW()),
(2,8,2,49.19,-122.85,'Test Message b2 u8',0,0,'N',NOW()),
(2,9,2,49.19,-122.85,'Test Message b2 u9',0,0,'N',NOW()),
(2,10,2,49.19,-122.85,'Test Message b2 u10',0,0,'N',NOW());

INSERT INTO foodster.follower
(user_id,follower_id,create_time)
VALUES
(1,2,'2015-03-17 08:27:50'),
(1,3,'2015-03-17 08:28:50'),
(1,4,'2015-03-17 08:29:50'),
(1,5,'2015-03-17 08:30:50'),
(1,6,'2015-03-17 08:31:50'),
(1,7,'2015-03-17 08:32:50'),
(1,8,'2015-03-17 08:33:50'),
(1,9,'2015-03-17 08:34:50'),
(1,10,'2015-03-17 08:35:50'),
(2,1,'2015-03-17 08:36:50'),
(2,3,'2015-03-17 08:37:50'),
(2,4,'2015-03-17 08:38:50'),
(2,5,'2015-03-17 08:39:50'),
(2,6,'2015-03-17 08:40:50'),
(2,7,'2015-03-17 08:41:50'),
(2,8,'2015-03-17 08:42:50'),
(2,9,'2015-03-17 08:43:50'),
(2,10,'2015-03-17 08:44:50'),
(3,1,'2015-03-17 08:45:50'),
(3,2,'2015-03-17 08:46:50'),
(3,4,'2015-03-17 08:47:50'),
(3,5,'2015-03-17 08:48:50'),
(3,6,'2015-03-17 08:49:50'),
(3,7,'2015-03-17 08:50:50'),
(3,8,'2015-03-17 08:51:50'),
(3,9,'2015-03-17 08:52:50'),
(3,10,'2015-03-17 08:53:50'),
(4,1,'2015-03-17 08:54:50'),
(4,2,'2015-03-17 08:55:50'),
(4,3,'2015-03-17 08:56:50'),
(4,5,'2015-03-17 08:57:50'),
(4,6,'2015-03-17 08:58:50'),
(4,7,'2015-03-17 08:59:50'),
(4,8,'2015-03-17 09:00:50'),
(4,9,'2015-03-17 09:01:50'),
(4,10,'2015-03-17 09:02:50');

INSERT INTO foodster.dish_activity
(user_id,dish_id,business_id,activity,is_deleted,create_time)
VALUES
(1,1,1,1,'Y','2015-03-17 08:12:45'),
(1,2,2,1,'Y','2015-03-17 08:13:45'),
(1,3,3,1,'Y','2015-03-17 08:14:45'),
(1,4,4,1,'Y','2015-03-17 08:15:45'),
(1,5,5,1,'Y','2015-03-17 08:16:45'),
(1,6,6,1,'Y','2015-03-17 08:17:45'),
(1,7,7,1,'Y','2015-03-17 08:18:45'),
(1,8,8,1,'Y','2015-03-17 08:19:45'),
(1,9,9,1,'Y','2015-03-17 08:20:45'),
(1,10,10,1,'Y','2015-03-17 08:21:45'),
(1,11,10,1,'N','2015-03-17 08:22:45'),
(1,12,9,1,'N','2015-03-17 08:23:45'),
(1,13,8,1,'N','2015-03-17 08:24:45'),
(1,14,7,1,'N','2015-03-17 08:25:45'),
(1,15,6,1,'N','2015-03-17 08:26:45'),
(1,16,5,1,'N','2015-03-17 08:27:45'),
(1,17,4,1,'N','2015-03-17 08:28:45'),
(1,18,3,1,'N','2015-03-17 08:29:45'),
(1,19,2,1,'N','2015-03-17 08:30:45'),
(1,20,1,1,'N','2015-03-17 08:31:45'),
(1,1,1,0,'Y','2015-03-17 08:32:45'),
(1,2,2,0,'Y','2015-03-17 08:33:45'),
(1,3,3,0,'Y','2015-03-17 08:34:45'),
(1,4,4,0,'Y','2015-03-17 08:35:45'),
(1,5,5,0,'Y','2015-03-17 08:36:45'),
(1,6,6,0,'Y','2015-03-17 08:37:45'),
(1,7,7,0,'Y','2015-03-17 08:38:45'),
(1,8,8,0,'Y','2015-03-17 08:39:45'),
(1,9,9,0,'Y','2015-03-17 08:40:45'),
(1,10,10,0,'Y','2015-03-17 08:41:45'),
(2,1,1,0,'Y','2015-03-17 08:42:45'),
(3,1,1,0,'Y','2015-03-17 08:43:45'),
(4,1,1,0,'Y','2015-03-17 08:44:45'),
(5,1,1,0,'Y','2015-03-17 08:45:45'),
(6,1,1,0,'Y','2015-03-17 08:46:45'),
(7,1,1,0,'Y','2015-03-17 08:47:45'),
(8,1,1,0,'Y','2015-03-17 08:48:45'),
(9,1,1,0,'Y','2015-03-17 08:49:45'),
(10,1,1,0,'Y','2015-03-17 08:50:45'),
(2,11,10,1,'N','2015-03-17 08:51:45'),
(2,2,2,0,'Y','2015-03-17 08:52:45'),
(2,3,3,0,'Y','2015-03-17 08:53:45'),
(2,2,2,1,'N','2015-03-17 08:54:45'),
(2,3,3,1,'N','2015-03-17 08:55:45');

INSERT INTO foodster.dish_user_like
(user_id,dish_id,is_like,create_time)
VALUES
(1,1,'Y','2015-03-17 08:32:45'),
(1,2,'Y','2015-03-17 08:33:45'),
(1,3,'Y','2015-03-17 08:34:45'),
(1,4,'Y','2015-03-17 08:35:45'),
(1,5,'Y','2015-03-17 08:36:45'),
(1,6,'Y','2015-03-17 08:37:45'),
(1,7,'Y','2015-03-17 08:38:45'),
(1,8,'Y','2015-03-17 08:39:45'),
(1,9,'Y','2015-03-17 08:40:45'),
(1,10,'Y','2015-03-17 08:41:45'),
(2,1,'Y','2015-03-17 08:42:45'),
(3,1,'N','2015-03-17 08:43:45'),
(4,1,'Y','2015-03-17 08:44:45'),
(5,1,'Y','2015-03-17 08:45:45'),
(6,1,'N','2015-03-17 08:46:45'),
(7,1,'Y','2015-03-17 08:47:45'),
(8,1,'Y','2015-03-17 08:48:45'),
(9,1,'N','2015-03-17 08:49:45'),
(10,1,'Y','2015-03-17 08:51:45'),
(2,2,'Y','2015-03-17 08:52:45'),
(2,3,'N','2015-03-17 08:53:45');

INSERT INTO foodster.dish_infograph
(dish_id,user_id,item_value,portion_size,presentation,uniqueness)
VALUES
(1,1,83,3,4,5),(2,1,83,3,4,5),(3,1,83,3,4,5),(4,1,83,3,4,5),(5,1,83,3,4,5),(6,1,83,3,4,5),(7,1,83,3,4,5),(8,1,83,3,4,5),(9,1,83,3,4,5),(10,1,83,3,4,5),
(1,2,54,2,1,5),(1,3,74,3,2,5),(1,4,93,1,3,5),(1,5,76,4,2,5),(1,6,90,2,4,5),(1,7,98,3,2,5),(1,8,27,2,3,5),(1,9,47,4,3,5),(1,10,90,1,4,5);

INSERT INTO foodster.dish_user_image
(user_id,dish_id,image_id)
VALUES
(1,1,5),(2,1,6),(3,1,5),(4,1,5),(5,1,5),(6,1,5),(7,1,5),(8,1,5),(9,1,5),(10,1,5),
(1,2,15),(1,3,21),(1,4,22),(1,5,23),(1,6,24),(1,7,25),(1,8,26),(1,9,27),(1,10,28);

INSERT INTO foodster.dish_user_keyword
(user_id,dish_id,keyword_code)
VALUES
(1,1,2001),(1,1,2002),(1,1,2003),(1,1,2005),(1,1,2008),(1,1,2012),
(1,2,2001),(1,2,2002),(1,2,2003),(1,2,2005),(1,2,2008),(1,2,2012),
(1,3,2001),(1,3,2002),(1,3,2003),(1,3,2005),(1,3,2008),(1,3,2012),
(1,4,2001),(1,4,2002),(1,4,2003),(1,4,2005),(1,4,2008),(1,4,2012),
(2,1,2011),(2,1,2012),(2,1,2013),(2,1,2005),(2,1,2008),(2,1,2022),
(3,1,2001),(3,1,2002),(3,1,2003),(3,1,2015),(3,1,2008),(3,1,2022),
(4,1,2001),(4,1,2022),(4,1,2003),(4,1,2005),(4,1,2002),
(5,1,2021),(5,1,2002),(5,1,2003),(5,1,2015),(5,1,2008),(5,1,2012);

INSERT INTO foodster.user_alert
(keyword_code,user_id)
VALUES
(4001,1),(4002,1),(4003,1),(4005,1),(4007,1),
(4001,2),(4002,2),(4003,2),(4005,2),(4007,2),
(4001,3),(4002,3),(4003,3),(4005,3),(4007,3);

INSERT INTO foodster.user_external
(type,reference,user_id,profile_pic,username,create_time)
VALUES
(1,'123123123',1,'http://www.facebook.com/graph/1231123','Test FB User 1',NOW()),
(2,'234234234',1,'http://www.twitter.com/graph/1231123','Test TW User 1',NOW()),
(3,'345345345',1,'http://www.weibo.com/graph/1231123','Test WB User 1',NOW()),
(1,'111111111',2,'http://www.twitter.com/graph/1231123','Test TW User 1',NOW()),
(2,'222222222',3,'http://www.twitter.com/graph/1231123','Test TW User 1',NOW()),
(3,'333333333',4,'http://www.twitter.com/graph/1231123','Test TW User 1',NOW());

INSERT INTO foodster.image_business
(business_id,name,`path`,create_time)
VALUES
(1,'business_1_profile.png','/tmp/',NOW()),
(2,'business_2_profile.png','/tmp/',NOW()),
(3,'business_3_profile.png','/tmp/',NOW()),
(4,'business_4_profile.png','/tmp/',NOW()),
(5,'business_5_profile.png','/tmp/',NOW()),
(6,'business_6_profile.png','/tmp/',NOW()),
(7,'business_7_profile.png','/tmp/',NOW());

INSERT INTO foodster.image_dish
(dish_id,user_id,name,`path`,is_default,is_deleted,create_time)
VALUES
(1,1,'u1_d1_111.png','/tmp/','N','Y',NOW()),
(1,1,'u1_d1_112.png','/tmp/','N','Y',NOW()),
(1,1,'u1_d1_113.png','/tmp/','N','N',NOW()),
(1,2,'u2_d1_111.png','/tmp/','N','N',NOW()),
(1,3,'u3_d1_111.png','/tmp/','Y','N',NOW()),
(1,4,'u4_d1_111.png','/tmp/','N','N',NOW()),
(1,5,'u5_d1_111.png','/tmp/','N','N',NOW()),
(1,6,'u6_d1_111.png','/tmp/','N','N',NOW()),
(1,7,'u7_d1_111.png','/tmp/','N','N',NOW()),
(1,8,'u8_d1_111.png','/tmp/','N','N',NOW()),
(1,9,'u9_d1_111.png','/tmp/','N','N',NOW()),
(2,1,'u1_d2_113.png','/tmp/','N','N',NOW()),
(2,2,'u2_d2_111.png','/tmp/','N','N',NOW()),
(2,3,'u3_d2_111.png','/tmp/','Y','N',NOW()),
(2,4,'u4_d2_111.png','/tmp/','N','N',NOW()),
(2,5,'u5_d2_111.png','/tmp/','N','N',NOW()),
(2,6,'u6_d2_111.png','/tmp/','N','N',NOW()),
(2,7,'u7_d2_111.png','/tmp/','N','N',NOW()),
(2,8,'u8_d2_111.png','/tmp/','N','N',NOW()),
(2,9,'u9_d2_111.png','/tmp/','N','N',NOW()),
(3,1,'u1_d3_113.png','/tmp/','Y','N',NOW()),
(4,1,'u1_d4_113.png','/tmp/','Y','N',NOW()),
(5,1,'u1_d5_113.png','/tmp/','Y','N',NOW()),
(6,1,'u1_d6_113.png','/tmp/','Y','N',NOW()),
(7,1,'u1_d7_113.png','/tmp/','Y','Y',NOW()),
(8,1,'u1_d8_113.png','/tmp/','Y','N',NOW()),
(9,1,'u1_d9_113.png','/tmp/','Y','N',NOW());

INSERT INTO foodster.image_user
(user_id,name,`path`,is_deleted,create_time)
VALUES
(1,'u1_profile_1.png','/tmp/','Y',NOW()),
(1,'u1_profile_2.png','/tmp/','N',NOW()),
(2,'u2_profile.png','/tmp/','N',NOW()),
(3,'u3_profile.png','/tmp/','N',NOW()),
(4,'u4_profile.png','/tmp/','N',NOW()),
(5,'u5_profile.png','/tmp/','N',NOW());

