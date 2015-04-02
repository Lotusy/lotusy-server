<?php
class GetDishPopularityInfoHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host;

        $userId = $this->getUserId();
        $dishId = $params['dishid'];

        $dish = new DishDao($dishId);

        if ($dish->getId() <= 0) {
            $response = array();
            $response['status'] = 'error';
            $response['description'] = 'cannot_find_dish';
            header('HTTP/1.0 404 Not Found');
        }

        $response = array();
        $response['status'] = 'success';

        $dishArr = $dish->toArray(array('create_time'));
        $dishArr['image'] = $base_host.'/rest/display/dish/'.$dishArr['id'].'/default';
        $response['dish'] = $dishArr;

        $likes = DishUserLikeDao::getDishLikedCount($dishId);
        $total = DishUserLikeDao::getDishCount($dishId);
        if ($total>0) {
            $response['popularity'] = round(100*$likes/$total);
        } else {
            $response['popularity'] = null;
        }

        $dao = DishUserLikeDao::getUserResponseOnDish($userId, $dishId);
        if (isset($dao)) {
            $response['preference'] = $dao->getIsLike()=='Y';
        } else {
            $response['preference'] = null;
        }

        return $response;
    }
}
?>