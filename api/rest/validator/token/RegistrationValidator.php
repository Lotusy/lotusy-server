<?php
class RegistrationValidator extends Validator {

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $valid = $this->nonEmpty($json, 'missing request body');
        if ($valid) {
            $indexes = array('id', 'nickname', 'username', 'profile_pic');
            $valid = $this->nonEmptyArrayIndex($indexes, $json);
        }

        if ($valid) {
            $valid = isset(UserExternalDao::$TYPEARRAY[$json['external_type']]);
            if (!$valid) {
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('invalid_external_type'); 
            }
        }

        if ($valid) {
            $valid = !UserExternalDao::isExternalRefExist($json['external_type'], $json['id']);
            if (!$valid) {
                header('HTTP/1.0 409 Conflict');
                $this->setErrorMessage('user_already_exist'); 
            }
        }

        return $valid;
    }
}
?>