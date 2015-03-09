<?php
class User extends Model {

    const ACTIVITY_TYPE_DISH = 1;
    const ACTIVITY_TYPE_USER = 2;

    private static $RANKS = array(
        array(0, 9) => UserDao::RANK_01,
    	array(10, 49) => UserDao::RANK_02,
    	array(50, 149) => UserDao::RANK_03,
    	array(150, 299) => UserDao::RANK_04,
    	array(300, 499) => UserDao::RANK_05,
    	array(500, 999) => UserDao::RANK_06,
    	array(1000, 1499) => UserDao::RANK_07,
    	array(1500, 2499) => UserDao::RANK_08,
    	array(2500, 4999) => UserDao::RANK_09,
    	array(5000, 9999) => UserDao::RANK_10
    );

    public function getUserRecentActivitiesArray($start, $size, $language) {
        $activities = UserActivityDao::getUserActivities($this->getId(), $start, $end);

        global $base_host, $base_url;
        $rv = array();
        $now = strtotime('now');
        foreach ($activities as $activity) {
            $type = $activity->getType();
            $data = json_decode($activity->getData(), true);
            $time = strtotime($activity->getCreateTime());

            if ($type = UserActivityDao::TYPE_DISH_COLLECT) {
                $dishId = $data['dish_id'];
                $like = $data['like'];
                $dishDao = new DishDao($dishId);
                $businessDao = new BusinessDao($dishDao->getBusinessId());
                $rv[$now-$time] = array('type'=>USER::ACTIVITY_TYPE_DISH, 
                                        'like'=>$like, 
                                        'dish'=>$dishDao->getName($language), 
                                        'business'=>$businessDao->getName($language), 
                                        'image'=>$base_host.$base_url.'/image/dish/'.$dishId.'/profile/display');
            } else {
                $userId = $data['user_id'];
                $userDao = new UserDao($userId);
                $rv[$now-$time] = array('type'=>USER::ACTIVITY_TYPE_USER,
                                        'name'=>$userDao->getNickname(), 
                                        'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display');
            }
        }

        return $rv;
    }

    public function getUserRecentActivityCountArray($start, $end) {
        $counts = DishActivityDao::getUserActivityCounts($this->getId(), $start, $end);

        for ($ii=0; $ii<$json['length']; $ii++) {
            $date = strtotime("+".$ii." days", strtotime($start));
            $date = date("Y-m-d", $date);
            if (!isset($counts[$date])) {
                $counts[$date] = 0;
            }
        }

        return $counts;
    }

    public function getLikeFoodScore() {
        $total = DishUserLikeDao::getUserDishCount($this->getId());
        $liked = DishUserLikeDao::getUserLikedDishCount($this->getId());

        return round($liked/$total);
    }

    public function adjustRank() {
        $rank = $this->dao->getRank();

        $count = DishActivityDao::getUserCollectedDishCount($this->getId());
        $newRank = self::lookupRank($count);

        if (!$newRank) { return -1; }

        if ($newRank!=$rank) {
            $this->dao->saveRank($newRank);
            $this->dao->save();
        
            if ($newRank>$rank) { 
                return 1;
            } else {
                return 2;
            }
        }

        return -1;
    }

    private function lookupRank($count) {
        foreach (self::$RANKS as $lookup=>$rank) {
            if ($count>=$lookup[0] && $count<=$lookup[1]) {
                return $rank;
            }
        }

        return FALSE;
    }

    public function getUsersWithSimilarTast($size, $nonFollowing) {
        $total = DishUserLikeDao::getUserDishCount($userId);

        $userId = $this->getId();

        $likeUsers = DishUserLikeDao::getSimilarLikeUsers($userId, 2*$size, $nonFollowing);
        $dislikeUsers = DishUserLikeDao::getSimilarDislikeUsers($userId, 2*$size, $nonFollowing);

        $combined = $likeUsers;
        foreach ($dislikeUsers as $userId=>$count) {
            if (isset($combined[$userId])) {
                $combined[$userId] = $combined[$userId]+$count;
            } else {
                $combined[$userId] = $count;
            }
        }
        $combined = arsort($combined);

        $rv = 0;
        $index = 0;
        foreach ($combined as $userId=>$count) {
            if (!$nonFollowing) {
                $isFollowing = FollowerDao::isFollower($userId, $this->getId());
            } else {
                $isFollowing = false;
            }
            $rv[$userId] = array('likeratio' => round(100*$count/$total),
                                 'following' => $isFollowing);
        }

        return $rv;
    }

    public function getUserRankAmoungFollowingArray($size) {
        $count = DishActivityDao::getUserCollectedDishCount($this->getId());
        $rank = DishActivityDao::getUserCollectionCountRank($this->getId(), $count);
        $more = DishActivityDao::getUsersCollectionCountCompareTo($this->getId(), $count, $size, true);
        $less = DishActivityDao::getUsersCollectionCountCompareTo($this->getId(), $count, $size, false);

        $rv = $more;
        $rv[$this->getId()] = $count;
        $rv = $rv+$less;

        global $base_host,$base_url;
        $rv = arsort($rv);
        foreach ($rv as $userId=>$count) {
            $userDao = new UserDao($userId);
            $rv[$userId] = array('count'=>$count,
                                 'nickname'=>$userDao->getNickname(),
                                 'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display');
            if ($userId==$this->getId()) {
                $rv[$userId]['rank'] = $rank;
            }
        }

        return $rv;
    }

    public function getFollowerUserArray($start, $size) {
        $followerIds = FollowerDao::getFollowerIds($this->getId(), $start, $size);
        $userDaos = UserDao::getRange($followerIds);

        global $base_host,$base_url;
        $list = array();
        foreach ($userDaos as $userDao) {
            $isFollowing = FollowerDao::isFollower($userId, $this->getId());
            $list[$userDao->getId()] = array('nickname'=>$userDao->getNickname(),
                                             'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                             'following'=>$isFollowing);
        }

        $rv = array();
        $rv['count'] = FollowerDao::getUserFollowerCount($this->getId());
        $rv['list'] = $list;

        return $rv;
    }

    public function getFollowingUserArray($start, $size) {
        $followingIds = FollowerDao::getFollowingIds($this->getId(), $start, $size);
        $userDaos = UserDao::getRange($followingIds);

        global $base_host,$base_url;
        $list = array();
        foreach ($userDaos as $userDao) {
            $list[$userDao->getId()] = array('nickname'=>$userDao->getNickname(),
                                             'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display');
        }

        $rv = array();
        $rv['count'] = FollowerDao::getUserFollowingCount($this->getId());
        $rv['list'] = $list;

        return $rv;
    }

// ==================================================================== override

    public function init() {
        $this->dao = new UserDao();    
    }

    public function init_with_id($id) {
        $this->dao = new UserDao($id);    
    }
}
?>