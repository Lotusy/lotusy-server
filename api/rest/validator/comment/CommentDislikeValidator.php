<?php
class CommentDislikeValidator extends Validator {

	private $comment = null;

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('commentid');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		if ($valid) {
			$this->comment = new CommentDao($json['commentid']);
			$valid = $this->comment->isFromDatabase();
			if (!$valid) {
				header('HTTP/1.0 404 Not Found');
				$this->setErrorMessage('comment_not_found');
			}
		}

		return $valid;
	}

	public function getComment() {
		return $this->comment;
	}
}
?>