<?php
class GetDishCommentCountHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['dish_id'] = $params['dishid'];

        $count = CommentDao::getCommentCountByDishId($json['dish_id']);

        $response = array();
        $response['status'] = 'success';
        $response['count'] = $count;

        return $response;
    }
}
?>