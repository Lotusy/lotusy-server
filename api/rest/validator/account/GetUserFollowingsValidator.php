<?php
class GetUserFollowingsValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        if ($valid) {
            $indexes = array('start', 'size');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        return $valid;
    }
}
?>