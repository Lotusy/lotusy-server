<?php
class UpdateCurrentBusinessProfileValidator extends Validator {

    private $business = null;

    public function validate() {
        $json = $this->getObjectToBeValidated();
        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $this->business = new BusinessDao($json['business_id']);
            $valid = $this->business->isFromDatabase();
            if (!$valid) {
                header('HTTP/1.0 404 Not Found');
                $this->setErrorMessage('business_not_found');
            }
        }

        return $valid;
    }

    public function getBusiness() {
        return $this->business;
    }
}
?>