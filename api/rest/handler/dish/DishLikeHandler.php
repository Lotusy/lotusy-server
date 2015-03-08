<?php
class DishLikeHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $dishId = $params['dishid'];

        $history = DishUserLikeDao::getUserResponseOnDish($userId, $dishId);

        if (isset($history)) {
            $like = $history->getIsLike()=='Y';

            if (!$like) {
                $history->setIsLike('Y');
                $history->save();

                $dish = new DishDao($dishId);
                $dish->dislike(false);
                $dish->like();
            }
        } else {
            $history = new DishUserLikeDao();
            $history->setDishId($dishId);
            $history->setUserId($userId);
            $history->setIsLike('Y');
            $history->save();

            $dish = new DishDao($dishId);
            $dish->like();
        }

        $userId = $this->getUserId();
        $type = UserActivityDao::TYPE_DISH_COLLECT;

        $userActivity = UserActivityDao::getUserActivitiesByIdAndType($userId, $type);
        if (!isset($userActivity)) {
            $userActivity = new UserActivityDao();
            $userActivity->setUserId($userId);
            $userActivity->setType($type);
        }
        $data = array('dish_id'=>$params['dishid'], 'like'=>true);
        $userActivity->setData(json_encode($data));
        $userActivity->save();

        $response = array('status' => 'success');

        return $response;
    }
}
?>