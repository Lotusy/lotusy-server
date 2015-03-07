<?php
class FollowUserValidator extends AccessTokenValidator {

    public function validate() {
        $valid = $this->isAccessTokenValid();

        if ($valid) {
            $json = $this->getObjectToBeValidated();

            $valid = $json['userid']!=$this->getUserId();
            if (!$valid) {
                header('HTTP/1.0 409 Conflict');
                $this->setErrorMessage('cannot_follower_oneself');
            }
        }

        return $valid;
    }
}
?>