<?php
class DishUserKeywordDao extends DishUserKeywordDaoGenerated {

    public static function getUserDishKeywords($userId, $dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('keyword_code', self::$table)
                       ->where('user_id', $userId)
                       ->where('dish_id', $dishId)
                       ->findList();

        $codes = array();
        foreach ($res as $row) {
            $codes[] = $row['keyword_code'];
        }

        return $codes;
    }

    public static function getDishKeywordsCount($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('keyword_code, COUNT(id) as count', self::$table)
                       ->where('dish_id', $dishId)
                       ->group('keyword_code')
                       ->findList();

        $codes = array();
        foreach ($res as $row) {
            $codes[$row['keyword_code']] = $row['count'];
        }

        return $codes;
    }

    public static function getDishKeywordUserCount($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(user_id) as count, keyword_code', self::$table)
                       ->where('dish_id', $dishId)
                       ->group('keyword_code')
                       ->findList();

        $codes = array();
        foreach ($res as $row) {
            $codes[$row['keyword_code']] = $row['count'];
        }

        return $codes;
    }

    public static function getDishTotalUserCount($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(DISTINCT user_id) as count', self::$table)
                       ->where('dish_id', $dishId)
                       ->find();

        return $res['count'];
    }
}
?>