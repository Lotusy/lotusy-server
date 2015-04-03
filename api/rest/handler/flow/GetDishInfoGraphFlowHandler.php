<?php
class GetDishInfoGraphFlowHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $language = $this->getLanguage();

        $dishId = $params['dishid'];
        $userId = $this->getUserId();

        $dish = Dish::alloc()->initWithId($dishId);
        $business = Business::alloc()->initWithId($dish->getBusinessId());
        $followingIds = FollowerDao::getFollowingIds($userId, 0, 10000);

        $response = array('status'=>'success');

        $response['detail'] = array();

        // get images links
        $response['detail']['images'] = $dish->getProfileImageLinks();

        // get business name and location
        $response['detail']['business'] = $business->getLineInfoArray();

        // get popularity
        $response['detail']['popularity'] = $dish->getPopularityArray($userId, $followingIds, $this->getLanguage());

        // get infograph
        $response['detail']['infograph'] = array(
                'all' => $dish->getInfoGraphArray(),
                'me' => $dish->getUserInfoGraphArray($userId)
        );

        // get keywords
        $response['detail']['keywords'] = $dish->getUserKeywordArray($userId, $language);

        // get comment
        $response['detail']['comment'] = Comment::getDishCommentArray($dishId, 0, 10, $followingIds);

        return $response;
    }
}
?>