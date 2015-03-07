<?php
class PostBusinessRatingValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $indexes = array('business_id', 'overall', 'food', 'serv', 'env');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        if ($valid) {
            $business = new BusinessDao($json['business_id']);
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