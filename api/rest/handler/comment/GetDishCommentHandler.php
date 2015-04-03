<?php
class GetDishCommentHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['dish_id'] = $params['dishid'];

        $validator = new GetDishCommentValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $comments = CommentDao::getCommentsByDishId ( 
                        $json['dish_id'], $json['start'], $json['size'] );

        $response = array();
        $response['status'] = 'success';
        $response['comments'] = array();

        $commentIds = array();
        $userIds = array();
        foreach ($comments as $comment) {
            array_push($commentIds, $comment->getId());
            array_push($userIds, $comment->getUserId());
        }

        global $base_host, $base_uri;

        $now = strtotime('now');

        $userDaos = UserDao::getRange($userIds, true);

        global $base_host,$base_url;
        foreach ($comments as $comment) {
            $commentArr = $comment->toArray();
            $commentArr['user_pic_url'] = $base_host.$base_url.'/image/user/'.$comment->getUserId().'/profile/display';

            $preference = DishUserLikeDao::getUserResponseOnDish($comment->getUserId(), $params['dishid']);

            if (isset($preference)) {
                $commentArr['like'] = $preference->getIsLike()=='Y' ? true : false;
            }

            $userDao = $userDaos[$comment->getUserId()];
            $commentArr['user_nickname'] = $userDao->getNickname();

            $last = strtotime($commentArr['create_time']);
            $commentArr['create_time'] = $now - $last;

            array_push($response['comments'], $commentArr);
        }

        return $response;
    }
}
?>