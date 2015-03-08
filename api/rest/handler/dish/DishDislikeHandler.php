<?php
class DishDislikeHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $dishId = $params['dishid'];

        $history = DishUserLikeDao::getUserResponseOnDish($userId, $dishId);

        if (isset($history)) {
            $like = $history->getIsLike()=='Y';

            if ($like) {
                $history->setIsLike('N');
                $history->save();

                $dish = new DishDao($dishId);
                $dish->like(false);
                $dish->dislike();
            }
        } else {
            $history = new DishUserLikeDao();
            $history->setDishId($dishId);
            $history->setUserId($userId);
            $history->setIsLike('N');
            $history->save();

            $dish = new DishDao($dishId);
            $dish->dislike();
        }

        $userId = $this->getUserId();
        $type = UserActivityDao::TYPE_DISH_COLLECT;

        $userActivity = UserActivityDao::getUserActivitiesByIdAndType($userId, $type);
        if (!isset($userActivity)) {
            $userActivity = new UserActivityDao();
            $userActivity->setUserId($userId);
            $userActivity->setType($type);
        }
        $data = array('dish_id'=>$params['dishid'], 'like'=>false);
        $userActivity->setData(json_encode($data));
        $userActivity->save();

        $response = array('status' => 'success');

        return $response;
    }
}
?>