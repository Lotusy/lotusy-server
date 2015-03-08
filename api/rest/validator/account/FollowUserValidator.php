<?php
class FollowUserValidator extends Validator {

    public function validate() {
        if ($valid) {
            $json = $this->getObjectToBeValidated();

            $valid = $json['userid']!=$json['user_id'];
            if (!$valid) {
                header('HTTP/1.0 409 Conflict');
                $this->setErrorMessage('cannot_follower_oneself');
            }
        }

        return $valid;
    }
}
?>