<?php
class AuthenticationValidator extends Validator {

    private $user = null;

    public function validate() {
        $json = $this->getObjectToBeValidated();

        $this->user = UserDao::getUserDaoByExternalRef($json['type'], $json['id']);

        $valid = isset($this->user);
        if (!$valid) {
            header('HTTP/1.0 404 Not Found');
            $this->setErrorMessage('user_not_found');
        }

        return $valid;
    }

    public function getUser() {
        return $this->user;
    }
}
?>