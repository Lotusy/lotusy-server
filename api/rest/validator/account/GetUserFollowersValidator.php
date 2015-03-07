<?php
class GetUserFollowersValidator extends AccessTokenValidator {

    public function validate() {
        $valid = $this->isAccessTokenValid();

        $json = $this->getObjectToBeValidated();

        if ($valid) {
            $indexes = array('start', 'size');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        return $valid;
    }
}
?>