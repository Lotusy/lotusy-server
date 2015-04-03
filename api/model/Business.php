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

// =============================================================== getter/setter

    public function getName($language) {
        return $this->dao->getName($language);
    }

// ==================================================================== override

    public function init() {
        $this->dao = new BusinessDao();

        return $this;
    }

    public function initWithId($id) {
        $this->dao = new BusinessDao($id);

        return $this;
    }
}
?>