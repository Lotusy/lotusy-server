<?php
class CreateReplyValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $indexes = array('comment_id', 'nickname', 'message');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        return $valid;
    }
}
?>