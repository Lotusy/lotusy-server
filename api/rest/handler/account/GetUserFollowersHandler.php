<?php
class GetUserFollowersHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['userid'] = $params['userid'];

        $validator = new GetUserFollowersValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $user = User::alloc()->init_with_id($params['userid']);
        $followers = $user->getFollowerUsers($json['start'], $json['size']);

        $response = array();
        $response['status'] = 'success';
        $response['users'] = array();
        foreach ($followers as $userId=>$follower) {
            $response['users'] = $follower;
            $isFollowing = FollowerDao::isFollower($userId, $this->getUserId());
            $response['users']['following'] = $isFollowing;
        }

        return $response;
    }
}