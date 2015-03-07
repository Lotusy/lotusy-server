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
            $ids[] = $rwo['user_id'];
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

// ============================================ override functions ==================================================

}
?>