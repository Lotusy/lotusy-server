<?php
class GetUserRecentActivitiesHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['user_id'] = $params['userid'];

        $validator = new GetUserRecentActivitiesValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $map = DishActivityDao::getUserRecentDishes($json['user_id'], $json['start'], $json['size']);
        $dishIds = array_keys($map['dish_ids']); 

        $disheDaos = DishDao::getRange($dishIds);

        $dishes = array();

        foreach ($disheDaos as $dishDao) {
            $dishes[$dishDao->getId()] = $dishDao->toArray();
        }

        unset($map['dish_ids']);

        $response = array('status'=>'success');

        $response['activities'] = array();
        foreach ($map as $time=>$dishList) {
            $activity = $dishes[$dishList['dish_id']];
            $activity['type'] = ($dishList['list']==DishActivityDao::LIST_COLLECTION) ? 'collection' : 'hitlist';

            $commentDao = CommentDao::getUserDishComment($dishList['dish_id'], $json['user_id']);
            if (isset($commentDao)) {
                $activity['comment'] = $commentDao->toArray();
            }

            $now = strtotime('now');
            $activityTime = strtotime($time);
            $time = $now - $activityTime;

            $response['activities'][$time] = $activity;
        }

        return $response;
    }
}
?>