<?php
class Business extends Model {

    public function getLineInfoArray() {
        $rv = array();

        $rv['name'] = $this->dao->getName($language);
        $rv['lat'] = $this->dao->getLat();
        $rv['lng'] = $this->dao->getLng();
        $rv['street'] = $this->dao->getStreet();
        $rv['city'] = $this->dao->getCity();
        $rv['state'] = $this->dao->getState();
        $rv['price'] = $this->dao->getPrice();

        return $rv;
    }

// ==================================================================== override

    public function init() {
        $this->dao = new BusinessDao();    
    }

    public function init_with_id($id) {
        $this->dao = new BusinessDao($id);    
    }
}
?>