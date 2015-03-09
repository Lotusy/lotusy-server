<?php
class GetMeBuddyAddHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->init_with_id($userId);

        $response = $user->getFollowingUserArray(0, 15);
        $response['status'] = 'success';

        return $response;
    }
}
?>