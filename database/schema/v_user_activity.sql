CREATE VIEW v_user_activity AS
SELECT user_id, 
       dish_id AS other_id, 
       1 AS type, 
       is_like AS data, 
       create_time 
FROM dish_user_like 
UNION 
SELECT user_id, 
       follower_id AS other_id, 
       2 AS type, 
       NULL AS data, 
       create_time 
FROM follower
ORDER BY create_time DESC;