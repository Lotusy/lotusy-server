<?php
class FollowerDao extends FollowerDaoGenerated {

// ========================================================================================== public

    public static function getFollowerIds($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('follower_id', self::$table)
                        ->where('user_id', $userId)
                        ->limit($start, $size)
                        ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['follower_id']);
        }

        return $ids;
    }

    public static function getUserFollowerCount($user) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('user_id', $userId)
                       ->find();

        return $res['count'];
    }

    public static function getFollowingIds($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('user_id', self::$table)
                        ->where('follower_id', $userId)
                        ->limit($start, $size)
                        ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['user_id']);
        }

        return $ids;
    }

    public static function getUserFollowingCount($user) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('follower_id', $userId)
                       ->find();

        return $res['count'];
    }

    public static function isUserFollowings($userId, $followingIds) {
        $builder = new QueryMaster();
        $res = $builder->select('*', self::$table)
                       ->where('follower_id', $userId)
                       ->in('user_id', $followingIds)
                       ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['user_id']);
        }

        return $ids;
    }

    public static function removeFollowing($followerId, $userId) {
        $builder = new QueryMaster();
        $res = $builder->delete(self::$table)
                       ->where('user_id', $userId)
                       ->where('follower_id', $followerId)
                       ->query();
        return $res;
    }

    public static function getRecentFollowers($userId, $startTime, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('follower_id, create_time', self::$table)
                       ->where('user_id', $userId)
                       ->where('create_time', $startTime, '<')
                       ->order('create_time')
                       ->limit(0, $size)
                       ->findList();

        $idMap = array();
        foreach ($res as $row) {
            $time = strtotime($row['create_time']);
            $idMap[$time] = $row['follower_id'];
        }

        return $idMap;
    }


// ======================================================================================== override

    protected function beforeInsert() {
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }
}
?>