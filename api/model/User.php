<?php
class User extends Model {

    const ACTIVITY_TYPE_DISH = 1;
    const ACTIVITY_TYPE_USER = 2;

    private static $RANKS = array(
        array(0, 0) => UserDao::RANK_00,
        array(1, 9) => UserDao::RANK_01,
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
                                        'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                        'rank'=>$userDao->getRank());
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


    public function getUsersWithSimilarTaste($start, $size, $nonFollowing) {
        $total = DishUserLikeDao::getUserDishCount($userId);

        $userId = $this->getId();

        $likeUsers = DishUserLikeDao::getSimilarLikeUsers($userId, $start, 2*$size, $nonFollowing);
        $dislikeUsers = DishUserLikeDao::getSimilarDislikeUsers($userId, $start, 2*$size, $nonFollowing);

        $combined = $likeUsers;
        foreach ($dislikeUsers as $userId=>$count) {
            if (isset($combined[$userId])) {
                $combined[$userId] = $combined[$userId]+$count;
            } else {
                $combined[$userId] = $count;
            }
        }
        $combined = arsort($combined);

        $userDaos = UserDao::getRange(array_keys($combined), true);

        $rv = array();
        $index = 0;
        foreach ($combined as $userId=>$count) {
            $userDao = $userDaos[$userId];
            if (!$nonFollowing) {
                $isFollowing = FollowerDao::isFollower($userId, $this->getId());
            } else {
                $isFollowing = false;
            }
            $rv[$userId] = array('nickname'=>$userDao->getNickname(),
                                 'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                 'rank'=>$userDao->getRank(),
                                 'likeratio' => round(100*$count/$total),
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
                                 'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                 'rank'=>$userDao->getRank());
            if ($userId==$this->getId()) {
                $rv[$userId]['rank'] = $rank;
            }
        }

        return $rv;
    }


    public function getFollowerUsers($start, $size) {
        $followerIds = FollowerDao::getFollowerIds($this->getId(), $start, $size);
        $userDaos = UserDao::getRange($followerIds);

        global $base_host,$base_url;
        $rv = array();
        foreach ($userDaos as $userDao) {
            $isFollowing = FollowerDao::isFollower($userId, $this->getId());
            $rv[$userDao->getId()] = array('nickname'=>$userDao->getNickname(),
                                           'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                           'following'=>$isFollowing,
                                           'rank'=>$userDao->getRank());
        }
        return $rv;
    }


    public function getFollowingUsers($start, $size) {
        $followingIds = FollowerDao::getFollowingIds($this->getId(), $start, $size);
        $userDaos = UserDao::getRange($followingIds);

        global $base_host,$base_url;
        $rv = array();
        foreach ($userDaos as $userDao) {
            $rv[$userDao->getId()] = array('nickname'=>$userDao->getNickname(),
                                           'image'=>$base_host.$base_url.'/image/user/'.$userDao->getId().'/profile/display',
                                           'rank'=>$userDao->getRank());
        }
        return $rv;
    }


    public function getUserCuisinePieArray() {
    	$dishCount = DishActivityDao::getUserBusinessDishCount($this->getId());
    	$cuisineArr = BusinessDao::getBusinessCuisineInRange($businessIds);

    	$cuisines = array();
    	foreach ($cuisineArr as $businessId=>$cuisine) {
    		if (isset($cuisines[$cuisine])) {
    			$cuisines[$cuisine] = $cuisines[$cuisine]+$dishCount[$businessId];
    		} else {
    			$cuisines[$cuisine] = $dishCount[$businessId];
    		}
    	}

    	return $cuisines;
    }


    public function getUsersWithSimilarFollowing($start, $size) {
        $userMap = FollowerDao::getFollowingSimilarUsers($this->getId(), $start, $size);
        $userDaos = UserDao::getRange(array_keys($userMap));

        global $base_host,$base_url;
        $list = array();
        foreach ($userDaos as $userDao) {
            $list[$userDao->getId()] = array('nickname'=>$userDao->getNickname(),
                                             'image'=>$base_host.$base_url.'/image/user/'.$userDao->getId().'/profile/display',
                                             'rank'=>$userDao->getRank(),
                                             'count'=>$userMap[$userDao->getId()]);
        }
    }


    public function getCommonFollowings($userId, $start, $size) {
        $userIds = FollowerDao::getCommonFollowingIds($userId, $this->getId(), $start, $size);
        $userDaos = UserDao::getRange($userIds);

        global $base_host,$base_url;
        $rv = array();
        foreach ($userDaos as $userDao) {
            $rv[$userDao->getId()] = array('nickname'=>$userDao->getNickname(),
                                           'image'=>$base_host.$base_url.'/image/user/'.$userDao->getId().'/profile/display',
                                           'rank'=>$userDao->getRank());
        }

        return $rv;
    }


    public function getCommonCollectedDishes($userId, $start, $size, $language, $like=null) {
        $dishIds = DishUserLikeDao::getCommonDishIds($userId, $this->getId(), $start, $size, $like);
        $rv = Dish::getDishesDetails($dishIds, $language);

        return $rv;
    }


    public function getCommonHitlistDishes($userId, $start, $size, $language) {
        $dishIds = DishActivityDao::getCommonHitlistIds($userId, $this->getId(), $start, $size);
        $rv = Dish::getDishesDetails($dishIds, $language);

        return $rv;
    }


    public function getHitlistDishes($start, $end, $language) {
        $dishIds = DishActivityDao::getHitlistedDishes($this->getId(), $start, $end);
        $rv = Dish::getDishesDetails($dishIds, $language);

        return $rv;
    }


    private function lookupRank($count) {
        foreach (self::$RANKS as $lookup=>$rank) {
            if ($count>=$lookup[0] && $count<=$lookup[1]) {
                return $rank;
            }
        }

        return FALSE;
    }

// =============================================================== getter/setter

    public function getRank()  {
    	return $this->dao->getRank();
    }

    public function getNickname() {
    	return $this->dao->getNickname();
    }

    public function updateLastLogin() {
        $this->dao->setLastLogin(date('Y-m-d H:i:s'));
        $this->dao->save();
    }

    public function getCollectedDishCount() {
        $count = DishActivityDao::getUserCollectedDishCount($this->getId());
        return $count;
    }

    public function isFollowing($user) {
        $isFollowing = FollowerDao::isFollower($userId, $this->getId());
        return $isFollowing;
    }

    public function getFollowerCount() {
    	$count = FollowerDao::getUserFollowerCount($this->getId());
    	return $count;
    }

    public function getFollowingCount() {
    	$count = FollowerDao::getUserFollowingCount($this->getId());
    	return $count;
    }

    public function getCommonFollowingCount($userId) {
        $count = FollowerDao::getCommonFollowingCount($userId, $this->getId());
        return $count;
    }

    public function getCommonDishFeelingCount($userId, $like=null) {
        $count = DishUserLikeDao::getCommonDishCount($userId, $this->getId(), $like);
        return $count;
    }

    public function getCommonHitlistCount($userId) {
        $count = DishActivityDao::getCommonHitlistCount($userId, $this->getId());
        return $count;
    }

    public function getHitlistCount() {
        $count = DishActivityDao::getHitlistedCount($this->getId());
        return $count;
    }

// ====================================================================== static

    public static function getRanksMap($language) {
        $ranks = ItermDao::getTypeLanguageCodeDescriptionMap(ItermDao::TYPE_USERRANK, $language);

        $rv = array();
        foreach (self::$RANKS as $range=>$code) {
            $rv[$ranks[$code]] = $range[1];
        }

        return $rv;
    }

// ==================================================================== override

    public function init() {
        $this->dao = new UserDao();    
    }

    public function init_with_id($id) {
        $this->dao = new UserDao($id);    
    }

    public function init_with_external($type, $reference) {
        $userId = UserExternalDao::getUserIdByExternalTypeAndReference($type, $reference);
        if ($userId>0) {
            $this->dao = new UserDao($userId);  
        } else {
            $this->dao = new UserDao();
        }
    }
}
?>