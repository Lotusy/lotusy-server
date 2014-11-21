<?php
class DishInfographDao extends DishInfographDaoGenerated {

// =============================================== public function =================================================

    public static function getDishInfograph($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('AVG(item_value) as item_value, 
                                 AVG(portion_size) as portion_size, 
                                 AVG(presentation) as presentation, 
                                 AVG(uniqueness) as uniqueness', self::$table)
                       ->where('dish_id', $dishId)
                       ->fine();
        return $res;
    }

    public static function getUserDishInfograph($dishId, $userId) {
        $builder = new QueryMaster();
        $res = $builder->select('item_value, portion_size, presentation, uniqueness', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('user_id', $userId)
                       ->fine();
        return $res;
    }

    public static function getUserDishInfographDao($dishId, $userId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('user_id', $userId)
                       ->fine();

		$rv = self::makeObjectFromSelectResult($res, 'DishInfographDao');
        if (!isset($rv)) {
        	$rv = new DishInfographDao();
        }

        return $rv;
    }

// ============================================== override function ================================================

}
?>