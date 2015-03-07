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

        $response = array('status' => 'success');

        return $response;
    }
}
?>