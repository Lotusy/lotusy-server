<?php
class GetUserRecentActivitiesValidator extends AccessTokenValidator {

    private $user = null;

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $indexes = array('user_id', 'start', 'size');
        $valid = $this->nonEmptyArrayIndex($indexes, $json);

        if ($valid) {
            $this->user = new UserDao($json['user_id']);

            $valid = $this->user->isFromDatabase();
            if (!$valid) {
                header('HTTP/1.0 404 Not Found');
                $this->setErrorMessage('user_not_found');
            }
        }

        return $valid;
    }

    public function getUser() {
        return $this->user;
    }
}
?>