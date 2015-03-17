<?php
class GetMeBuddyAddHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->initWithId($userId);

        $followings = $user->getFollowingUsers(0, 15);
        $followingCount = $user->getFollowingCount();

        $response['status'] = 'success';
        $response['list'] = $followings;
        $response['count'] = $followingCount;

        return $response;
    }
}
?>