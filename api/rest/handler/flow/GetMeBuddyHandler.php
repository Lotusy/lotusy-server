<?php
class GetMeBuddyHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->initWithId($userId);

        $userRankArr = $user->getUserRankAmoungFollowingArray(2);
        $similarUsers = $user->getUsersWithSimilarTaste(0, 5, false);

        $followers = $user->getFollowerUsers(0, 4);
        $followerCount = $user->getFollowerCount();

        $followings = $user->getFollowingUsers(0, 4);
        $followingCount = $user->getFollowingCount();

        $response = array('status'=>'success');
        $response['rank'] = $userRankArr;
        $response['similar'] = $similarUsers;
        $response['follwer'] = array('total'=>$followerCount, 'list'=>$followers);
        $response['following'] = array('total'=>$followingCount, 'list'=>$followings);

        return $response;
    }
}
?>