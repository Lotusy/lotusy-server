<?php
class GetProfileRankingHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host,$base_url;

        $language = $this->getLanguage();
        $meId = $this->getUserId();
        $userId = $params['userid'];

        $me = User::alloc()->init_with_id($meId);
        $user = User::alloc()->init_with_id($userId);

        $response = array('status'=>'success');

        $response['static'] = ItermDao::getUserRanksMap($language);

        $response['me'] = array('rank'=>$me->getRank(),
                                'image'=>$base_host.$base_url.'/image/user/'.$meId.'/profile/display',
                                'nickname'=>$me->getNickname(),
                                'count'=>$me->getCollectedDishCount());

        $response['user'] = array('rank'=>$user->getRank(),
                                  'image'=>$base_host.$base_url.'/image/user/'.$userId.'/profile/display',
                                  'nickname'=>$user->getNickname(),
                                  'count'=>$user->getCollectedDishCount());

        return $response;
    }
}
?>