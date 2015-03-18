<?php
class VUserActivityDao extends VUserActivityDaoGenerated {

    const TYPE_DISH_COLLECT = 1;
    const TYPE_USER_FOLLOW = 2;

    public static function getUserActivities($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                        ->where('user_id', $userId)
                        ->limit($start, $size)
                        ->findList();

        return self::makeObjectsFromSelectListResult($res, 'VUserActivityDao');
    }
}
?>