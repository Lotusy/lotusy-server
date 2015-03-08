<?php
class GetFlowUserActivityHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();

        $user = User::alloc()->init_with_id($userId);

        $response = array('status'=>'success');

        $now = date('Y-m-d');
        $startTime = strtotime("- 4 days", strtotime($now));
        $start = date("Y-m-d", $startTime);

        $response['counts'] = $user->getUserRecentActivityCountArray($start, $now);

        $userId = $this->getUserId();
        $headers = apache_request_headers();
        $language = $headers['language'];

        $list = $user->getUserRecentActivitiesArray(0, 10, $language);

        $response['activities'] = $list;

        return $response;
    }
}
?>