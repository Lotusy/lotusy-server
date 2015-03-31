<?php
class GetDishDetailHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host, $base_uri;

        $dish = new DishDao($params['dishid']);

        $response = array();
        $response['status'] = 'success';

        $dishArr = $dish->toArray(array('create_time'));
        $dishArr['image'] = $base_host.$base_uri.'/image/dish/'.$dishArr['id'].'/profile/display';

        $preference = DishUserLikeDao::getUserResponseOnDish($this->getUserId(), $params['dishid']);

        if (isset($preference)) {
            $dishArr['like'] = $preference->getIsLike()=='Y' ? true : false;
        } 

        $response['dish'] = $dishArr;

        return $response;
    }
}
?>