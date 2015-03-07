<?php
class User extends Model {

    const ACTIVITY_TYPE_DISH = 1;
    const ACTIVITY_TYPE_USER = 2;

    public function getNewFollowerArray($startTime, $size, $language) {
        $followerMap = FollowerDao::getRecentFollowers($this->getId(), $startTime, $size);
        $activityMap = DishUserLikeDao::getRecentActivities($this->getId(), $startTime, $size);

        $timeMap = array();
        $count = 0;

        while ($count<$size) {
            $res1 = reset($followerMap);
            $time1 = $res1!==FALSE ? key($followerMap) : null;
            $res2 = reset($activityMap);
            $time2 = $res2!==FALSE ? key($activityMap) : null;

            if ($time1&&!$time2 || $time1>$time2) {
                $timeMap[$time1] = current($followerMap);
                unset($followerMap[$time1]);
            } else if ($time2&&!$time1 || $time2>=$time1) {
                $timeMap[$time2] = current($activityMap);
                unset($activityMap[$time2]);
            }

            $count++;
        }

        global $base_host, $base_url;
        $rv = array();
        $now = strtotime('now');
        foreach ($timeMap as $time=>$obj) {
            if (is_array($obj)) {
                $dishId = $obj['dish'];
                $like = $obj['like'];
                $dishDao = new DishDao($dishId);
                $businessDao = new BusinessDao($dishDao->getBusinessId());
                $rv[$now-$time] = array('type'=>USER::ACTIVITY_TYPE_DISH, 
                						'like'=>$like, 
                						'dish'=>$dishDao->getName($language), 
                						'business'=>$businessDao->getName($language), 
                						'image'=>$base_host.$base_url.'/image/dish/'.$dishId.'/profile/display');
            } else {
                $userId = $obj;
                $userDao = new UserDao($userId);
                $rv[$now-$time] = array('type'=>USER::ACTIVITY_TYPE_USER,
                						'name'=>$userDao->getNickname(), 
                						'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display');
            }
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
}
?>