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

        // get images links
        $response['images'] = $dish->getProfileImageLinks();

        // get business name and location
        $response['business'] = $business->getLineInfoArray();

        // get popularity
        $response['popularity'] = $dish->getPopularityArray($userId, $followingIds);

        // get infograph
        $response['infograph'] = $dish->getInfoGraphArray();

        // get keywords
        $response['keywords'] = $dish->getUserKeywordArray($userId, $language);

        // get comment
        $response['comment'] = Comment::getDishCommentArray($dishId, 0, 10, $followingIds);

        return $response;
    }
}
?>