<?php
class GetMeBuddyHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->init_with_id($userId);

        $userRankArr = $user->getUserRankAmoungFollowingArray(2);
        $similarUsers = $user->getUsersWithSimilarTaste(0, 5, false);

        $followers = $user->getFollowerUsers(0, 4);
        $followerCount = $user->getFollowerCount();

        $followings = $user->getFollowingUsers(0, 4);
        $followingCount = $user->getFollowingCount();

        $response = array('status'=>'success');
        $response['rank'] = $userRankArr;
        $response['similar'] = $similarUsers;
        $response['follwer'] = array('list'=>$followers, 'count'=>$followerCount);
        $response['following'] = array('list'=>$followings, 'count'=>$followingCount);

        return $response;
    }
}
?>