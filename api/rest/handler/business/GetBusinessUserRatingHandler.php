<?php
class GetBusinessUserRatingHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $businessId = $params['businessid'];
        $userId = $params['userid'];

        $rating = BusinessRatingDao::getRatingWithBusinessAndUserIds($businessId, $userId);

        $response = array();
        if (!isset($rating)) {
            header('HTTP/1.0 404 Not Found');
            $response['status'] = 'error';
            $response['description'] = 'rating_not_found';
        } else {
            $response = $rating->toArray();
            $now = strtotime('now');
            $last = strtotime($response['create_time']);
            $response['create_time'] = $now - $last;
            $response['status'] = 'success';
        }

        return $response;
    }
}
?>