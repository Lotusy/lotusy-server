<?php
class User extends Model {

    const ACTIVITY_TYPE_DISH = 1;
    const ACTIVITY_TYPE_USER = 2;

    public static $RANKS = array(
        UserDao::RANK_00 => array(0, 1),
        UserDao::RANK_01 => array(1, 9),
    	UserDao::RANK_02 => array(10, 49),
    	UserDao::RANK_03 => array(50, 149),
    	UserDao::RANK_04 => array(150, 299),
    	UserDao::RANK_05 => array(300, 499),
    	UserDao::RANK_06 => array(500, 999),
    	UserDao::RANK_07 => array(1000, 1499),
    	UserDao::RANK_08 => array(1500, 2499),
    	UserDao::RANK_09 => array(2500, 4999),
    	UserDao::RANK_10 => array(5000, 9999)
    );


    public function getUserRecentActivitiesArray($start, $size, $language) {
        $activities = VUserActivityDao::getUserActivities($this->getId(), $start, $size);

        global $base_host, $base_url;
        $rv = array();
        $now = strtotime('now');
        foreach ($activities as $activity) {
            $type = $activity->getType();
            $otherId = $activity->getOtherId();
            $time = strtotime($activity->getCreateTime());

            if ($type == VUserActivityDao::TYPE_DISH_COLLECT) {
                $like = $activity->getData();
                $dishDao = new DishDao($otherId);
                $businessDao = new BusinessDao($dishDao->getBusinessId());
                $rv[] = array('time'=>$now-$time,
                              'type'=>USER::ACTIVITY_TYPE_DISH, 
                              'like'=>$like, 
                              'dish'=>$dishDao->getName($language),
                		      'dish_id'=>$dishDao->getId(),
                              'business'=>$businessDao->getName($language), 
                              'image'=>$base_host.$base_url.'/image/dish/'.$otherId.'/profile/display');
            } else {
                $userDao = new UserDao($otherId);
                $rv[] = array('time'=>$now-$time,
                              'type'=>USER::ACTIVITY_TYPE_USER,
                              'name'=>$userDao->getNickname(),
                              'user_id'=>$userDao->getId(),
                              'image'=>$base_host.$base_url.'/image/user/'.$otherId.'/profile/display',
                              'rank'=>$userDao->getRank());
            }
        }

        return $rv;
    }


    public function getUserRecentActivityCountArray($start, $end, $numberOfDays) {
        $counts = DishActivityDao::getUserActivityCounts($this->getId(), $start, $end);

        for ($ii=0; $ii<$numberOfDays; $ii++) {
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

        return round(100*$liked/$total);
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
        $userId = $this->getId();

        $total = DishUserLikeDao::getUserDishCount($userId);

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
        arsort($combined);

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
            $rv[] = array('user_id' =>$userId,
                          'nickname' =>$userDao->getNickname(),
                          'image' =>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                          'rank' =>$userDao->getRank(),
                          'likeratio' => round(100*$count/$total),
                          'following' => $isFollowing);
        }

        return $rv;
    }


    public function getUserRankAmoungFollowingArray($size) {
        $count = DishActivityDao::getUserCollectedDishCount($this->getId());
        $position = DishActivityDao::getUserCollectionCountRank($this->getId(), $count);
        $more = DishActivityDao::getUsersCollectionCountCompareTo($this->getId(), $count, $size, true);
        $less = DishActivityDao::getUsersCollectionCountCompareTo($this->getId(), $count, $size, false);

        $rv = $more;
        $rv[$this->getId()] = $count;
        $rv = $rv+$less;

        global $base_host,$base_url;
        arsort($rv);
        foreach ($rv as $userId=>$count) {
            $userDao = new UserDao($userId);
            $rv[$userId] = array('count'=>$count,
                                 'nickname'=>$userDao->getNickname(),
                                 'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                 'rank'=>$userDao->getRank());
            if ($userId==$this->getId()) {
                $rv[$userId]['position'] = $position;
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
            $rv[] = array('user_id' => $userDao->getId(),
                          'nickname' => $userDao->getNickname(),
                          'image' => $base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                          'following' => $isFollowing,
                          'rank' => $userDao->getRank());
        }
        return $rv;
    }


    public function getFollowingUsers($start, $size) {
        $followingIds = FollowerDao::getFollowingIds($this->getId(), $start, $size);
        $userDaos = UserDao::getRange($followingIds);

        global $base_host,$base_url;
        $rv = array();
        foreach ($userDaos as $userDao) {
            $rv[] = array('user_id' => $userDao->getId(),
                          'nickname' => $userDao->getNickname(),
                          'image' => $base_host.$base_url.'/image/user/'.$userDao->getId().'/profile/display',
                          'rank' => $userDao->getRank());
        }
        return $rv;
    }


    public function getUserCuisinePieArray() {
    	$dishCount = DishActivityDao::getUserBusinessDishCount($this->getId());
    	$businessIds = array_keys($dishCount);
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
            $list[] = array('user_id' => $userDao->getId(),
                            'nickname'=>$userDao->getNickname(),
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
            $rv[] = array('user_id' => $userDao->getId(),
                          'nickname' => $userDao->getNickname(),
                          'image' => $base_host.$base_url.'/image/user/'.$userDao->getId().'/profile/display',
                          'rank' => $userDao->getRank());
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


    public function getCollectedDishes($start, $end, $language, $like=null) {
        if (!isset($like)) {
            $dishIds = DishActivityDao::getUserCollectedDishes($this->getId(), $start, $end);
        } else {
            $dishIds = DishUserLikeDao::getUserDishes($start, $end, $language, $like);
        }
        $rv = Dish::getDishesDetails($dishIds, $language);

        return $rv;
    }


    public function getExternalLinkProfiles() {
        $links = UserExternalDao::getUserExternalLinks($this->getId());
        $rv = array();

        foreach ($links as $link) {
            $type = UserExternalDao::$TYPEARRAYREV[$link->getType()];
            $rv[$type] = array('image' => $link->getProfilePic(),
                               'name' => $link->getUsername());
        }

        return $rv;
    }


    private function lookupRank($count) {
        foreach (self::$RANKS as $rank=>$lookup) {
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

    public function isFollowing($userId) {
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

    public function getCollectedDishCount($like=null) {
        if (!isset($like)) {
            $count = DishActivityDao::getUserCollectedDishCount($this->getId());
        } else {
            $count = DishUserLikeDao::getUserLikedDishCount($userId, $like);
        }
        return $count;
    }

    public function getActiveAlertCodes() {
        $codes = UserAlertDao::getUserAlertCodes($this->getId());
        return $codes;
    }

// ==================================================================== override

    public function init() {
        $this->dao = new UserDao();    
    }

    public function initWithId($id) {
        $this->dao = new UserDao($id);

        return $this;
    }

    public function initWithExternal($type, $reference) {
        $userId = UserExternalDao::getUserIdByExternalTypeAndReference($type, $reference);
        if ($userId>0) {
            $this->dao = new UserDao($userId);  
        } else {
            $this->dao = new UserDao();
        }

        return $this;
    }
}
?>