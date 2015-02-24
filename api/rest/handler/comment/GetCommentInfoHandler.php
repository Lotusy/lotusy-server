<?php
class GetCommentInfoHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$comment = new CommentDao($params['commentid']);

		if ($comment->isFromDatabase()) {
			$response = $comment->toArray();
			$response['user_pic_url'] = $base_image_host.'/display/user/'.$comment->getUserId();

			$user = new UserDao($comment->getUserId());

			$response['user_nickname'] = $user->getNickname();

			$count = ReplyDao::getReplyCountByCommentId($params['commentid']);

			$lookupDaos = FastImageDao::getLookupDaosByCommentId($params['commentid']);
			
			global $base_host, $base_uri;

			$links = array();
			foreach ($lookupDaos as $lookupDao) {
				$link = $base_host.$base_uri.'/display/comment/'.$params['commentid'].'/'.$lookupDao->getFastId();
				array_push($links, $link);
			}

			$response['reply_count'] = (int)$count;
			$response['image_links'] = $links;

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