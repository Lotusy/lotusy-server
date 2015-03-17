<?php
class Comment extends Model {

    public static function getDishCommentArray($dishId, $start, $end, $followingIds=array()) {
        $rv = array();
    
        $commentDaos = CommentDao::getCommentsByDishId($dishId, $start, $end);
        $commentIds = array();
        $userIds = array();
        foreach ($commentDaos as $commentDao) {
            array_push($commentIds, $commentDao->getId());
            array_push($userIds, $commentDao->getUserId());
        }
        global $base_host, $base_uri;
        $now = strtotime('now');
        $userDaos = UserDao::getRange($userIds, true);
        foreach ($commentDaos as $commentDao) {
            $commentArr = $commentDao->toArray();
            $commentArr['profile_pic'] = $base_host.$base_uri.'/image/user/'.$commentDao->getUserId().'/profile/display';
            $preference = DishUserLikeDao::getUserResponseOnDish($commentDao->getUserId(), $dishId);
            if (isset($preference)) {
                $commentArr['like'] = $preference->getIsLike()=='Y' ? true : false;
            }
            $userDao = $userDaos[$commentDao->getUserId()];
            $commentArr['nickname'] = $userDao->getNickname();
            $last = strtotime($commentArr['create_time']);
            $commentArr['create_time'] = $now - $last;
            $commentArr['following'] = in_array($commentDao->getUserId(), $followingIds);
            $rv[] = $commentArr;
        }

        return $rv;
    }

// ==================================================================== override

    public function init() {
        $this->dao = new CommentDao();

        return $this;
    }

    public function initWithId($id) {
        $this->dao = new CommentDao($id);

        return $this;
    }
}
?>