<?php
class GetFollowingRecentDishesHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $validator = new GetFollowingRecentDishesValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        } 

        $user = new UserDao($this->getUserId());

        $userIds = FollowerDao::getFollowingIds($user->getId(), 0, 100000);

        $map = DishActivityDao::getUsersRecentDishes($userIds, $json['start'], $json['size']);

        $dishIds = array_keys($map['dish_ids']);
        $userIds = array_keys($map['user_ids']); 
        $bussIds = array_keys($map['business_ids']); 

        $dishDaos = DishDao::getRange($dishIds, true);
        $userDaos = UserDao::getRange($userIds, true);
        $bussDaos = BusinessDao::getRange($bussIds, true);

        unset($map['dish_ids']);
        unset($map['user_ids']);
        unset($map['business_ids']);

        $dishes = array();
        foreach ($dishDaos as $dishDao) {
            $dishes[$dishDao->getId()] = $dishDao->toArray();
        }

        $users = array();
        foreach ($userDaos as $userDao) {
            $users[$userDao->getId()] = array('id'=>$userDao->getId(), 'name'=>$userDao->getNickname());
        }

        $businesses = array();
        foreach ($bussDaos as $bussDao) {
            $businesses[$bussDao->getId()] = array('id'=>$bussDao->getId(), 'name'=>$bussDao->getName($this->getLanguage()));
        }

        $response = array('status'=>'success');

        $response['activities'] = array();
        foreach ($map as $time=>$userDishBusiness) {
            $activity = array();
            $activity['user'] = $users[$userDishBusiness['user_id']];
            $activity['dish'] = $dishes[$userDishBusiness['dish_id']];
            $activity['business'] = $businesses[$userDishBusiness['business_id']];
            $activity['type'] = ($userDishBusiness['list']==DishActivityDao::LIST_COLLECTION) ? 'collection' : 'hitlist';

            if ($userDishBusiness['list']==DishActivityDao::LIST_COLLECTION) {
                $preference = DishUserLikeDao::getUserResponseOnDish($userDishBusiness['user_id'], $userDishBusiness['dish_id']);
                if (isset($preference)) {
                    $activity['like'] = $preference->getIsLike()=='Y' ? true : false;
                }
            }
/*
            $commentDao = CommentDao::getUserDishComment($userDishBusiness['dish_id'], $userDishBusiness['user_id']);
            if (isset($commentDao)) {
                $activity['comment'] = $commentDao->toArray();
            }
*/
            $now = strtotime('now');
            $activityTime = strtotime($time);
            $time = $now - $activityTime;

            $response['activities'][$time] = $activity;
        }

        return $response;
    }
}
?>