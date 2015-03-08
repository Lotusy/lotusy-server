<?php
class User extends Model {

    const ACTIVITY_TYPE_DISH = 1;
    const ACTIVITY_TYPE_USER = 2;

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

// ==================================================================== override

    public function init() {
        $this->dao = new UserDao();    
    }

    public function init_with_id($id) {
        $this->dao = new UserDao($id);    
    }
}
?>