<?php
class GetOtherProfileHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host, $base_url;

        $language = $this->getLanguage();
        $meId = $this->getUserId();
        $userId = $params['userid'];

        $user = User::alloc()->init_with_id($userId);
        $me = User::alloc()->init_with_id($meId);

        $name = $user->getNickname();
        $image = $base_host.$base_url.'/image/user/'.$userId.'/profile/display';

        $dishCount = $user->getCollectedDishCount();
        $rank = $user->getRank();
        $followerCount = $user->getFollowerCount();

        $likeScore = $user->getLikeFoodScore();

        $meDishCount = $me->getCollectedDishCount();
        $userDishCount = $user->getCollectedDishCount();
        $dishCountDiff = $meDishCount - $userDishCount;

        $cuisines = $user->getUserCuisinePieArray();

        $isFollowing = $me->isFollowing($userId);

        if ($isFollowing) {
            $commonBuddies = $me->getCommonFollowings($user->getId(), 0, 4);
            $commonBuddyCount = $me->getCommonFollowingCount($user->getId());

            $commonHitlist = $me->getCommonHitlistDishes($user->getId(), 0, 4, $language);
            $commonHitlistCount = $me->getCommonHitlistCount($user->getId());

            $commonLike = $me->getCommonCollectedDishes($userId, $start, $size, $language, true);
            $commonLikeCount = $me->getCommonDishFeelingCount($userId, true);

            $commonDislike = $me->getCommonCollectedDishes($userId, $start, $size, $language, false);
            $commonDislikeCount = $me->getCommonDishFeelingCount($userId, false);
        } else {
            $hitlist = $user->getHitlistDishes(0, 4, $language);
            $hitlistCount = $user->getHitlistCount();

            $followings = $user->getFollowingUsers(0, 4);
            $followingCount = $user->getFollowingCount();
        }

        $response = array('status'=>'success');
        $response['is_following'] = $isFollowing;
        $response['user'] = array('name' => $name,
                                  'image' => $image);
        $response['stat'] = array('dish' => $dishCount,
                                  'rank' => $rank,
                                  'follower' => $followerCount);
        $response['like_score'] = $likeScore;
        $response['dish_count_diff'] = $dishCountDiff;
        if ($isFollowing) {
           $response['common_buddy'] = array('list'=>$commonBuddies, 'count'=>$commonBuddyCount);
           $response['common_hitlist'] = array('list'=>$commonHitlist, 'count'=>$commonHitlistCount);
           $response['common_like'] = array('list'=>$commonLike, 'count'=>$commonLikeCount);
           $response['common_dislike'] = array('list'=>$commonDislike, 'count'=>$commonDislikeCount);
        } else {
            $response['buddies'] = array('list'=>$followings, 'count'=>$followingCount);
            $response['hitlist'] = array('list'=>$hitlist, 'count'=>$hitlistCount);
        }

        $response['cuisine'] = array();
        $total = array_sum($cuisines);
        $codes = array_keys($cuisines);
        $discriptions = ItermDao::getCodeDescriptionArray($codes, ItermDao::TYPE_CUISINE, $language);
        foreach ($cuisines as $code=>$count) {
            $response['cuisine'][$discriptions[$code]] = 100*$count/$total;
        }

        return $response;
    }
}
?>