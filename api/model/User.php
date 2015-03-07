<?php
class User extends Model {

    public function getNewFollowerArray($startTime, $size) {
        $followerMap = FollowerDao::getRecentFollowers($this->getId(), $startTime, $size);
        $activityMap = DishActivityDao::getRecentActivities($this->getId(), $startTime, $size);
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