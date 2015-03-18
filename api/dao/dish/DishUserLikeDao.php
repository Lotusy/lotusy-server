<?php
class DishUserLikeDao extends DishUserLikeDaoGenerated {

// =============================================== public function =================================================

    public static function getUserResponseOnDish($userId, $dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('user_id', $userId)
                       ->where('dish_id', $dishId)
                       ->find();

        return self::makeObjectFromSelectResult($res, 'DishUserLikeDao');
    }

    public static function getResponsesOnDish($dishId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('dish_id', $dishId)
                       ->limit($start, $size)
                       ->findList();

        return self::makeObjectsFromSelectListResult($res, 'DishUserLikeDao');
    }

    public static function getDishLikedCount($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('dish_id', $dishId)
                       ->where('is_like', 'Y')
                       ->find();

        return $res['count'];
    }

    public static function getDishCount($dishId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('dish_id', $dishId)
                       ->find();

        return $res['count'];
    }

    public static function getDishUsersInRange($userIds, $dishId, $limit) {
        $builder = new QueryMaster();
        $res = $builder->select('user_id', self::$table)
                       ->where('dish_id', $dishId)
                       ->in('user_id', $userIds)
                       ->limit(0, $limit)
                       ->findList();
        $ids = array();
        foreach ($res as $row) {
            $ids[] = $row['user_id'];
        }

        return $ids;
    }

    public static function getRecentActivities($userId, $startTime, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('dish_id, is_like, create_time', self::$table)
                       ->where('user_id', $userId)
                       ->where('create_time', $startTime, '<')
                       ->order('create_time')
                       ->limit(0, $size)
                       ->findList();

        $activityMap = array();
        foreach ($res as $row) {
            $time = strtotime($row['create_time']);
            $like = $row['is_like']=='Y';
            $activityMap[$time] = array('like'=>$like, 'dish'=>$row['dish_id']);
        }

        return $activityMap;
    }

    public static function getUserDishCount($userId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('$userId', $userId)
                       ->find();

        return $res['count'];
    }

    public static function getUserLikedDishCount($userId, $like=true) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('$userId', $userId)
                       ->where('is_like', $like ? 'Y' : 'N')
                       ->find();

        return $res['count'];
    }

    public static function getSimilarLikeUsers($userId, $start, $size, $nonFollowing=false) {
        $additional = '';
        if ($nonFollowing) {
            $additional = " AND user_id NOT IN (SELECT user_id FROM ".FollowerDao::getTableName()." WHERE follower_id=$userId) ";
        }

        $builder = new QueryMaster();
        $query = "SELECT user_id, COUNT(*) as count FROM ".self::$table.
                 " WHERE dish_id IN (SELECT dish_id FROM ".self::$table.
                     " WHERE user_id=$userId) AND is_like='Y'".$additional." GROUP BY user_id LIMIT $start, $size";
        $res = $builder->adhocQuery($query)->findList();

        $counts = array();
        foreach ($res as $row) {
            $counts[$row['user_id']] = $count;
        }

        return $counts;
    }

    public static function getSimilarDislikeUsers($userId, $start, $size, $nonFollowing=false) {
        $additional = '';
        if ($nonFollowing) {
            $additional = " AND user_id NOT IN (SELECT user_id FROM ".FollowerDao::getTableName()." WHERE follower_id=$userId) ";
        }

        $builder = new QueryMaster();
        $query = "SELECT user_id, COUNT(*) as count FROM ".self::$table.
                 " WHERE dish_id IN (SELECT dish_id FROM ".self::$table.
                     " WHERE user_id=$userId) AND is_like='N'".$additional." GROUP BY user_id LIMIT $start, $size";
        $res = $builder->adhocQuery($query)->findList();

        $counts = array();
        foreach ($res as $row) {
            $counts[$row['user_id']] = $count;
        }

        return $counts;
    }

    public static function getCommonDishIds($userId1, $userId2, $start, $size, $like=NULL) {
        $builder = new QueryMaster();
        $builder->select('dish_id, COUNT(*) as count', self::$table)->in('user_id', array($userId1, $userId2));
        if (isset($like)) {
            $builder->where('is_like', $like ? 'Y' : 'N');
        }
        $res = $builder->group('dish_id')->having('count', 1, '>')->order('id', true)->limit($start, $size)->findList();

        $ids = array();
        foreach ($res as $row) {
            $ids[] = $row['user_id'];
        }
        return $ids;
    }

    public static function getCommonDishCount($userId1, $userId2, $like=NULL) {
        $builder = new QueryMaster();
        $builder->select('dish_id, COUNT(*) as count', self::$table)->in('user_id', array($userId1, $userId2));
        if (isset($like)) {
            $builder->where('is_like', $like ? 'Y' : 'N');
        }
        $res = $builder->group('dish_id')->having('count', 1, '>')->findList();

        return count($res);
    }

    public static function getUserDishes($userId, $start, $size, $like=true) {
        $builder = new QueryMaster();
        $res = $builder->select('dish_id', self::$table)
                       ->where('user_id', $userId)
                       ->where('is_like', $like ? 'Y' : 'N')
                       ->order('id', true)
                       ->limit($start, $size)
                       ->findList();
        $ids = array();
        foreach ($res as $row) {
            $ids[] = $row['dish_id'];
        }
        return $ids;
    }

// ============================================ override functions ==================================================

    protected function beforeInsert() {
        $this->setIsDeleted('N');
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }
}
?>