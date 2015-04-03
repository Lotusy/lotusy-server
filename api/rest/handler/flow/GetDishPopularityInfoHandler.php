<?php
class GetDishPopularityInfoHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host,$base_url;

        $userId = $this->getUserId();
        $dishId = $params['dishid'];

        $dish = Dish::alloc()->initWithId($dishId);

        if ($dish->getId() <= 0) {
            $response = array();
            $response['status'] = 'error';
            $response['description'] = 'cannot_find_dish';
            header('HTTP/1.0 404 Not Found');
        }

        $response = array();
        $response['status'] = 'success';

        $response['dish'] = array();
        $response['dish']['image'] = $base_host.$base_url.'/rest/display/dish/'.$dishArr['id'].'/default';
        $response['dish']['name'] = $dish->getName($this->getLanguage());

        $followingIds = FollowerDao::getFollowingIds($userId, 0, 1000);

        $response['dish']['popularity'] = $dish->getPopularityArray($this->getUserId(), $followingIds, $this->getLanguage());

        return $response;
    }
}
?>