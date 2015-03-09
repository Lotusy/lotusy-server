<?php
class FollowerDao extends FollowerDaoGenerated {

// ========================================================================================== public

    public static function getFollowerIds($userId, $start, $size) {
        $builder = new QueryMaster();
        $res = $builder->select('follower_id', self::$table)
                        ->where('user_id', $userId)
                        ->order('create_time', true)
                        ->limit($start, $size)
                        ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['follower_id']);
        }

        return $ids;
    }

    public static function getUserFollowerCount($userId) {
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
                        ->order('create_time', true)
                        ->limit($start, $size)
                        ->findList();
        $ids = array();
        foreach ($res as $row) {
            array_push($ids, $row['user_id']);
        }

        return $ids;
    }

    public static function getUserFollowingCount($userId) {
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

    public static function isFollower($userId, $followerId) {
        $builder = new QueryMaster();
        $res = $builder->select('COUNT(*) as count', self::$table)
                       ->where('user_id', $userId)
                       ->where('follower_id', $followerId)
                       ->find();

        return $res['count']>0;
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

    public static function getFollowingSimilarUsers($userId, $start, $size) {
        $builder = new QueryMaster();
        $subSelect = "SELECT user_id FROM ".self::$table." WHERE follower_id=$userId";
        $query = "SELECT follower_id, COUNT(*) as count FROM ".self::$table.
                 " WHERE user_id IN ($subSelect) AND follower_id NOT IN ($subSelect) AND follower_id<>$userId".
                 " GROUP BY follower_id ORDER BY count DESC LIMIT $start, $size";
        $res = $builder->adhocQuery($query)->findList();

        $idMap = array();
        foreach ($res as $row) {
            $idMap[$row['follower_id']] = $row['count'];
        }

        return $idMap;
    }


// ======================================================================================== override

    protected function beforeInsert() {
        $this->setCreateTime(date('Y-m-d H:i:s'));
    }
}
?>