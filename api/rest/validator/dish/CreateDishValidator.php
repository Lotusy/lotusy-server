<?php
class CreateDishValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');

        if ($valid) {
            $valid = (!empty($json['name_zh']) || !empty($json['name_tw']) || !empty($json['name_en']));
            if (!$valid) {
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('missing_name');
            }
        }

        return $valid;
    }
}
?>