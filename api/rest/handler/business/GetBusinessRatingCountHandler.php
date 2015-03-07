<?php
class GetBusinessRatingCountHandler extends AuthorizedRequestHandler {
    
    public function handle($params) {
        $validator = new GetBusinessRatingCountValidator($params);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $count = BusinessRatingDao::getBusinessRatingCount($params['businessid']);

        $response = array();
        $response['status'] = 'success';
        $response['count'] = $count;

        return $response;
    }
}
?>