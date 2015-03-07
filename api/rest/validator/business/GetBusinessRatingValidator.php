<?php
class GetBusinessRatingValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $indexes = array('businessid');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        if ($valid) {
            $business = new BusinessDao($json['businessid']);
            $valid = $business->isFromDatabase();
            if (!$valid) {
                header('HTTP/1.0 404 Not Found');
                $this->setErrorMessage('business_not_found');
            }
        }

        return $valid;
    }
}
?>