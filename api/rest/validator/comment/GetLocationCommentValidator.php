<?php
class GetLocationCommentValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $indexes = array('lat', 'lng', 'radius', 'start', 'size');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        return $valid;
    }
}
?>