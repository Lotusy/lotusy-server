<?php
class DishActivityDao extends DishActivityDaoGenerated {

    const LIST_COLLECTION = '0';
    const LIST_HITLIST = '1';

// ========================================================================================== public

    public static function getUsersRecentDishes($userIds, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                        ->in('user_id', $userIds)
                        ->order('create_time', true)
                        ->limit($start, $size)
                        ->findList();

        $rv = array();
        $rv['dish_ids'] = array();
        foreach ($res as $row) {
            $rv[$row['create_time']] = array();
            $rv[$row['create_time']] = array('user_id'=>$row['user_id'], 'dish_id'=>$row['dish_id'], 'list'=>$row['activity']);

            if (!isset($rv['dish_ids'][$row['dish_id']])) {
                $rv['dish_ids'][$row['dish_id']] = 1;
            }
        }

        return $rv;
    }

    public static function getUserRecentDishes($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                        ->where('user_id', $userId)
                        ->order('create_time', true)
                        ->limit($start, $size)
                        ->findList();
        $rv = array();
        $rv['dish_ids'] = array();
        foreach ($res as $row) {
            $rv[$row['create_time']] = array();
            $rv[$row['create_time']] = array('dish_id'=>$row['dish_id'], 'list'=>$row['activity']);

            if (!isset($rv['dish_ids'][$row['dish_id']])) {
                $rv['dish_ids'][$row['dish_id']] = 1;
            }
        }

        return $rv;
    }

    public static function getUserActivityCounts($userId, $start, $end) {
        $builder = new QueryMaster();
        $res = $builder->select('create_time', self::$table)
                        ->where('user_id', $userId)
                        ->where('create_time', $start, '>=')
                        ->where('create_time', $end, '<')
                        ->findList();
        $rv = array();
        foreach ($res as $row) {
            $createTimes = substr($row['create_time'], 0, 10);
            if (!isset($rv[$createTimes])) {
                $rv[$createTimes] = 1;
            } else {
                $rv[$createTimes] = $rv[$createTimes]+1;
            }
        }

        return $rv;
    }

    public static function getUserCollectedDishCount($userId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('user_id', $userId)
                       ->where('activity', self::LIST_COLLECTION)
                       ->find();

        return $res['count'];
    }

    public static function getCollectedDishes($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('dish_id', self::$table)
                       ->where('user_id', $userId)
                       ->where('activity', self::LIST_COLLECTION)
                       ->limit($start, $size)
                       ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['dish_id']);
        }

        return $ids;
    }

    public static function deleteUserDishHitlist($userId, $dishId) {
        $builder = new QueryMaster();
        $res = $builder->update(array('is_deleted'=>'Y'), self::$table)
                       ->where('user_id', $userId)
                       ->where('dish_id', $dishId)
                       ->where('activity', self::LIST_HITLIST)
                       ->query();
        return $res;
    }

    public static function getHitlistedDishes($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('dish_id', self::$table)
                       ->where('user_id', $userId)
                       ->where('is_deleted', 'N')
                       ->where('activity', self::LIST_HITLIST)
                       ->limit($start, $size)
                       ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['dish_id']);
        }

        return $ids;
    }

    public static function getDishTwoUserCollected($dishId, $userIds) {
        $builder = new QueryMaster();
        $res = $builder->select('user_id', self::$table)
                       ->where('dish_id', $dishId)
                       ->in('user_id', $userIds)
                       ->where('activity', self::LIST_COLLECTION)
                       ->limit(0, 2)
                       ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['user_id']);
        }

        return $ids;
    }

    public static function getDishUserCount($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table) 
                       ->where('dish_id', $dishId)
                       ->where('activity', self::LIST_COLLECTION)
                       ->find();
        return $res['count'];
    }

    public static function isDishCollected($dishId, $userId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table) 
                       ->where('user_id', $userId)
                       ->where('dish_id', $dishId)
                       ->where('activity', self::LIST_COLLECTION)
                       ->find();

        return $res['count']>0;
    }

    public static function getUsersDishCollectedCount($userIds) {
        $builder = new QueryMaster();
        $res = $builder->select('user_id, COUNT(*) as count', self::$table) 
                       ->in('user_id', $userId)
                       ->where('activity', self::LIST_COLLECTION)
                       ->group('user_id')
                       ->find();

        $counts = array();
        foreach ($res as $row) {
            $counts[$row['user_id']] = $row['count'];
        }
        $counts = arsort($counts);

        return $counts;
    }

// ======================================================================================== override

    protected function beforeInsert() {
        $this->setIsDeleted('N');
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }
}
?>