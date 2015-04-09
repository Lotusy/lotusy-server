<?php
class GetCommentInfoHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host,$base_url;
        $comment = new CommentDao($params['commentid']);

        if ($comment->isFromDatabase()) {
            $response = $comment->toArray();
            $response['user_pic_url'] = $base_host.$base_url.'/image/user/'.$comment->getUserId().'/profile/display';

            $user = new UserDao($comment->getUserId());

            $response['user_nickname'] = $user->getNickname();

            $now = strtotime('now');
            $last = strtotime($response['create_time']);
            $response['create_time'] = $now - $last;

            $response['status'] = 'success';
        } else {
            header('HTTP/1.0 404 Not Found');
            $response = array();
            $response['status'] = 'error';
            $response['description'] = 'comment_not_found';
        }

        return $response;
    }
}
?>