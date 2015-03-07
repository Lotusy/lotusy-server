<?php
class CollectCommentValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $indexes = array('commentid');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        return $valid;
    }
}
?>