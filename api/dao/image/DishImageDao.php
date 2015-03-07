<?php
class DishImageDao extends ImageDishDaoGenerated {

//========================================================================================== public

    public static function getImagesByDishId($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('is_deleted', 'N')
                       ->findList();

        return self::makeObjectsFromSelectListResult($res, 'DishImageDao');
    }

    public static function getImagesByUserId($userId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('user_id', $userId)
                       ->where('is_deleted', 'N')
                       ->findList();

        return self::makeObjectsFromSelectListResult($res, 'DishImageDao');
    }

    public static function getDishImageById($dishId, $id) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('id', $id)
                       ->find();

        return self::makeObjectFromSelectResult($res, 'DishImageDao');
    }

    public static function getDishDefaultImage($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('is_default', 'Y')
                       ->where('is_deleted', 'N')
                       ->find();

        return self::makeObjectFromSelectResult($res, 'DishImageDao');
    }

    public static function DishHasDefaultImage($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('is_default', 'Y')
                       ->where('is_deleted', 'N')
                       ->find();

        return $res['count']>0;
    }

    public static function deleteUserDishImage($userId, $dishId) {
        $builder = new QueryMaster();
        $res = $builder->update(array('is_deleted'=>'Y'),self::$table)
                       ->where('dish_id', $dishId)
                       ->where('user_id', $userId)
                       ->query();
        return $res;
    }

// ============================================ override functions ==================================================

    protected function beforeInsert() {
        $date = date('Y-m-d H:i:s');
        $this->setCreateTime($date);
        $this->setIsDeleted('N');
    }
}
?>