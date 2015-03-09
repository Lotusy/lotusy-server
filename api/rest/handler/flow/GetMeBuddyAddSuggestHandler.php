<?php
class GetMeBuddyAddSuggestHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->init_with_id($userId);

        $followingSuggest = $user->getUsersWithSimilarFollowing(0, 5);
        $dishSuggest = $user->getUsersWithSimilarTaste(5, true);

        $list = $followingSuggest;
        foreach ($dishSuggest as $userId=>$detail) {
            if (isset($list[$userId])) {
                $list[$userId] = $list[$userId] + $detail;
            } else {
                $list[$userId] = $detail;
            }
        }

        $response = array('status'=>'success');
        $response['list'] = $list;

        return $response;
    }
}
?>