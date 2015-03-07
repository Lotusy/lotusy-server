<?php
class GetUserActivitiesCountHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['user_id'] = $params['userid'];

        $validator = new GetUserActivitiesCountValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $date = strtotime("+".$json['length']." days", strtotime($json['start']));
        $end = date("Y-m-d", $date);

        $counts = DishActivityDao::getUserActivityCounts($json['user_id'], $json['start'], $end);

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