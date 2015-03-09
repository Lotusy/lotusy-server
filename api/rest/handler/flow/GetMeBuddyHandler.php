<?php
class GetMeBuddyHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->init_with_id($userId);

        $userRankArr = $user->getUserRankAmoungFollowingArray(2);
        $similarUsers = $user->getUsersWithSimilarTast(5, false);

        $followerArr = $user->getFollowerUserArray(0, 4);
        $followingArr = $user->getFollowingUserArray(0, 4);

        $response = array('status'=>'success');
        $response['rank'] = $userRankArr;
        $response['similar'] = $similarUsers;
        $response['follwer'] = $followerArr;
        $response['following'] = $followingArr;

        return $response;
    }
}
?>