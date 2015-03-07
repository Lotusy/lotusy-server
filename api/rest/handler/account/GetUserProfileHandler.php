<?php
class GetUserProfileHandler extends UnauthorizedRequestHandler {

    public function handle($params) {

        $validator = new GetUserProfileValidator($params);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $user = $validator->getUser();

        $response = $user->toArray();

        $followerCount = FollowerDao::getUserFollowerCount($validator->getUserId());
        $response['follower_count'] = (int)$followerCount;

        $dishCount = DishActivityDao::getUserCollectedDishCount($validator->getUserId());
        $response['dish_collection_count'] = (int)$dishCount;

        $now = strtotime('now');
        $last = strtotime($response['last_login']);
        $response['last_login'] = $now - $last;

        $response['status'] = 'success';

        return $response;
    }
}
?>