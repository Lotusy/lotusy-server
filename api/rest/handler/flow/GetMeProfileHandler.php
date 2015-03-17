<?php
class GetMeProfileHandler extends AuthorizedRequestHandler {

    public function handle($params) {
    	global $base_host, $base_url;

        $language = $this->getLanguage();

    	$userId = $this->getUserId();
    	$user = User::alloc()->initWithId($userId);

    	$name = $user->getNickname();
    	$image = $base_host.$base_url.'/image/user/'.$userId.'/profile/display';

    	$dishCount = $user->getCollectedDishCount();
    	$rank = $user->getRank();
    	$followerCount = $user->getFollowerCount();

    	$likeScore = $user->getLikeFoodScore();

    	$cuisines = $user->getUserCuisinePieArray();

    	$response = array('status'=>'success');
    	$response['user'] = array(
    			'name' => $name,
                'image' => $image
    	);

    	$response['stat'] = array(
    			'dish' => $dishCount,
    			'rank' => $rank,
    			'follower' => $followerCount
    	);

    	$response['like_score'] = $likeScore;

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