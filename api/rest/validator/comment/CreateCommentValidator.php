<?php
class CreateCommentValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $indexes = array('lat', 'lng', 'message');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        if ($valid) {
            $valid = (!empty($json['business_id']) || !empty($json['dish_id']));
            if (!$valid) {
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('missing_business_or_dish');
            }
        }

        return $valid;
    }
}
?>