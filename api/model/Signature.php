<?php
class Signature extends Model {

    public static function createUserSignatureImages($userId) {
        
    }

// ==================================================================== override

    public function init() {
        $this->dao = new SignatureImageDao();    
    }

    public function init_with_id($id) {
        $this->dao = new SignatureImageDao($id);    
    }
}
?>