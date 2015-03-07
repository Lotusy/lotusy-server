<?php
class DishUserImageDao extends DishUserImageDaoGenerated {

    public static function getUserDishImage($userId, $dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('user_id', $userId)
                       ->find();

        return self::makeObjectFromSelectResult($res, 'DishUserImageDao');
    }
}
?>