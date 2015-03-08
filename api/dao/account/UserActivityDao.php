<?php
class UserActivityDao extends UserActivityDaoGenerated {

    const TYPE_DISH_COLLECT = 1;
    const TYPE_USER_FOLLOW = 2;

    public static function getUserActivities($userId, $start, $end) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                        ->where('user_id', $userId)
                        ->limit($start, $size)
                        ->findList();

        return self::makeObjectsFromSelectListResult($res, 'UserActivityDao');
    }

    public static function getUserActivitiesByIdAndType($userId, $type) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                        ->where('user_id', $userId)
                        ->where('type', $type)
                        ->find();

        return self::makeObjectFromSelectResult($res, 'UserActivityDao');
    }

// ======================================================================================== override

    protected function beforeInsert() {
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }

    protected function beforeUpdate() {
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }
}
?>