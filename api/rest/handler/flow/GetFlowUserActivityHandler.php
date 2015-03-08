<?php
class GetFlowUserActivityHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();

        $response = array('status'=>'success');

        $now = date('Y-m-d');
        $startTime = strtotime("- 4 days", strtotime($now));
        $start = date("Y-m-d", $startTime);

        $counts = DishActivityDao::getUserActivityCounts($userId, $start, $now);

        for ($ii=0; $ii<$json['length']; $ii++) {
            $date = strtotime("+".$ii." days", $startTime);
            $date = date("Y-m-d", $date);
            if (!isset($counts[$date])) {
                $counts[$date] = 0;
            }
        }

        $response['counts'] = $counts;

        $userId = $this->getUserId();
        $headers = apache_request_headers();
        $language = $headers['language'];

        $user = User::alloc()->init_with_id($userId);

        $list = $user->getUserRecentActivitiesArray(0, 10, $language);

        $response['activities'] = $list;

        return $response;
    }
}
?>