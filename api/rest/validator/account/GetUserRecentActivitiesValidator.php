<?php
class GetUserRecentActivitiesValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $indexes = array('start', 'size', 'language');
        $valid = $this->nonEmptyArrayIndex($indexes, $json);

        return $valid;
    }
}
?>