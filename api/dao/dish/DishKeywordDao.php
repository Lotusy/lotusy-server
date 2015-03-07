<?php
class DishKeywordDao extends DishKeywordDaoGenerated {

// =============================================== public function =================================================

    public static function getDishKeywords($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('keyword_code', self::$table)
                       ->where('dish_id', $dishId)
                       ->findList();

        $codes = array();
        foreach ($res as $row) {
            $codes[] = $row['keyword_code'];
        }

        return $codes;
    }

// ============================================ override functions ==================================================

}
?>