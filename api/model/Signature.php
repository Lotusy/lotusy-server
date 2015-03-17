<?php
class Signature extends Model {

    public static function createUserSignatureImages($userId) {
        
    }

// ==================================================================== override

    public function init() {
        $this->dao = new SignatureImageDao();

        return $this;
    }

    public function initWithId($id) {
        $this->dao = new SignatureImageDao($id);   

        return $this; 
    }
}
?>