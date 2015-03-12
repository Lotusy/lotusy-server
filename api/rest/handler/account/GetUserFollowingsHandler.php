<?php
class GetUserFollowingsHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['userid'] = $params['userid'];

        $validator = new GetUserFollowingsValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $user = User::alloc()->init_with_id($params['userid']);
        $followings = $user->getFollowingUsers($json['start'], $json['size']);

        $response = array();
        $response['status'] = 'success';
        $response['users'] = array();
        foreach ($followings as $userId=>$following) {
            $response['users'] = $following;
            $isFollowing = FollowerDao::isFollower($userId, $this->getUserId());
            $response['users']['following'] = $isFollowing;
        }

        return $response;
    }
}