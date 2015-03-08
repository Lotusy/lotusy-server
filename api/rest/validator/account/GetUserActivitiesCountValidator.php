<?php
class GetUserActivitiesCountValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $indexes = array('user_id', 'start', 'length');
        $valid = $this->nonEmptyArrayIndex($indexes, $json);

        return $valid;
    }

}
?>