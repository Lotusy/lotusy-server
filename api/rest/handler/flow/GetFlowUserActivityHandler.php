<?php
class GetFlowUserActivityHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $params['userid'];

        $user = User::alloc()->initWithId($userId);

        $response = array('status'=>'success');

        $now = date('Y-m-d');
        $startTime = strtotime("- 4 days", strtotime($now));
        $start = date("Y-m-d", $startTime);

        $response['counts'] = $user->getUserRecentActivityCountArray($start, $now);

        $userId = $this->getUserId();
        $language = $this->getLanguage();

        $list = $user->getUserRecentActivitiesArray(0, 10, $language);

        $response['activities'] = $list;

        return $response;
    }
}
?>