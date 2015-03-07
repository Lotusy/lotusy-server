<?php
class PostBusinessRatingHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = Utility::getJsonRequestData();
        $json['business_id'] = $params['businessid'];

        $validator = new PostBusinessRatingValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $userId = $this->getUserId();

        $rating = BusinessRatingDao::getRatingWithBusinessAndUserIds($json['business_id'], $userId);
        if (!isset($rating)) {
            $rating = new BusinessRatingDao();
        }
        $rating->setBusinessId($json['business_id']);
        $rating->setUserId($userId);
        $rating->setFood($json['food']);
        $rating->setServ($json['serv']);
        $rating->setEnv($json['env']);
        $rating->setOverall($json['overall']);

        $response = array();
        if (!$rating->save()) {
            $response['status'] = 'error';
            header('HTTP/1.0 500 Internal Server Error');
            $response['description'] = 'internal_server_error';
        } else {
            $response['status'] = 'success';
            $response['rating'] = $rating->toArray();
        }

        return $response;
    }
}
?>