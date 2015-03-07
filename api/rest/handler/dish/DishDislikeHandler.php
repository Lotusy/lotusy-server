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

        $response = array('status' => 'success');

        return $response;
    }
}
?>