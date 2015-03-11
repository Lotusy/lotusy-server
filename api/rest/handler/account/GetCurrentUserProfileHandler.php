<?php
class GetCurrentUserProfileHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $language = $this->getLanguage();

        $userDao = new UserDao($validator->getUserId());

        $response = $userDao->toArray();

        $followerCount = FollowerDao::getUserFollowerCount($validator->getUserId());
        $response['follower_count'] = (int)$followerCount;

        $dishCount = DishActivityDao::getUserCollectedDishCount($validator->getUserId());
        $response['dish_collection_count'] = (int)$dishCount;

        $now = strtotime('now');
        $last = strtotime($response['last_login']);
        $response['last_login'] = $now - $last;

        $rankDesc = ItermDao::getDescriptionWithCodeAndType($userDao->getRank(), ItermDao::TYPE_USERRANK, $language);
        $response['rank'] = $rankDesc; 

        $response['status'] = 'success';

        return $response;
    }
}
?>