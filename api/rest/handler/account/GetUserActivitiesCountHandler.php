<?php
class GetUserActivitiesCountHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['user_id'] = $this->getUserId();

        $validator = new GetUserActivitiesCountValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $date = strtotime("-".$json['length']." days", strtotime($json['start']));
        $start = date("Y-m-d", $date);

        $counts = DishActivityDao::getUserActivityCounts($json['user_id'], $start, $json['start']);

        for ($ii=0; $ii<$json['length']; $ii++) {
            $date = strtotime("+".$ii." days", strtotime($json['start']));
            $date = date("Y-m-d", $date);
            if (!isset($counts[$date])) {
                $counts[$date] = 0;
            }
        }

        $response = array('status'=>'success', 'counts'=>$counts);

        return $response;
    }
}
?>