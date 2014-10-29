<?php
abstract class BusinessDaoGenerated extends LotusyDaoParent {

    protected static $table = 'business';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['external_id'] = null;
        $this->var['external_type'] = null;
        $this->var['user_id'] = null;
        $this->var['name_zh'] = null;
        $this->var['name_tw'] = null;
        $this->var['name_en'] = null;
        $this->var['category'] = null;
        $this->var['image'] = null;
        $this->var['street'] = null;
        $this->var['city'] = null;
        $this->var['state'] = null;
        $this->var['country'] = null;
        $this->var['zip'] = null;
        $this->var['lat'] = null;
        $this->var['lng'] = null;
        $this->var['price'] = null;
        $this->var['hours'] = null;
        $this->var['cash_only'] = null;
        $this->var['verified'] = null;
        $this->var['tel'] = null;
        $this->var['website'] = null;
        $this->var['social'] = null;

        $this->update['id'] = false;
        $this->update['external_id'] = false;
        $this->update['external_type'] = false;
        $this->update['user_id'] = false;
        $this->update['name_zh'] = false;
        $this->update['name_tw'] = false;
        $this->update['name_en'] = false;
        $this->update['category'] = false;
        $this->update['image'] = false;
        $this->update['street'] = false;
        $this->update['city'] = false;
        $this->update['state'] = false;
        $this->update['country'] = false;
        $this->update['zip'] = false;
        $this->update['lat'] = false;
        $this->update['lng'] = false;
        $this->update['price'] = false;
        $this->update['hours'] = false;
        $this->update['cash_only'] = false;
        $this->update['verified'] = false;
        $this->update['tel'] = false;
        $this->update['website'] = false;
        $this->update['social'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setExternalId($external_id) {
        if ($this->var['external_id'] != $external_id) {
            $this->var['external_id'] = $external_id;
            $this->update['external_id'] = true;
        }
    }
    public function getExternalId() {
        return $this->var['external_id'];
    }

    public function setExternalType($external_type) {
        if ($this->var['external_type'] != $external_type) {
            $this->var['external_type'] = $external_type;
            $this->update['external_type'] = true;
        }
    }
    public function getExternalType() {
        return $this->var['external_type'];
    }

    public function setUserId($user_id) {
        if ($this->var['user_id'] != $user_id) {
            $this->var['user_id'] = $user_id;
            $this->update['user_id'] = true;
        }
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setNameZh($name_zh) {
        if ($this->var['name_zh'] != $name_zh) {
            $this->var['name_zh'] = $name_zh;
            $this->update['name_zh'] = true;
        }
    }
    public function getNameZh() {
        return $this->var['name_zh'];
    }

    public function setNameTw($name_tw) {
        if ($this->var['name_tw'] != $name_tw) {
            $this->var['name_tw'] = $name_tw;
            $this->update['name_tw'] = true;
        }
    }
    public function getNameTw() {
        return $this->var['name_tw'];
    }

    public function setNameEn($name_en) {
        if ($this->var['name_en'] != $name_en) {
            $this->var['name_en'] = $name_en;
            $this->update['name_en'] = true;
        }
    }
    public function getNameEn() {
        return $this->var['name_en'];
    }

    public function setCategory($category) {
        if ($this->var['category'] != $category) {
            $this->var['category'] = $category;
            $this->update['category'] = true;
        }
    }
    public function getCategory() {
        return $this->var['category'];
    }

    public function setImage($image) {
        if ($this->var['image'] != $image) {
            $this->var['image'] = $image;
            $this->update['image'] = true;
        }
    }
    public function getImage() {
        return $this->var['image'];
    }

    public function setStreet($street) {
        if ($this->var['street'] != $street) {
            $this->var['street'] = $street;
            $this->update['street'] = true;
        }
    }
    public function getStreet() {
        return $this->var['street'];
    }

    public function setCity($city) {
        if ($this->var['city'] != $city) {
            $this->var['city'] = $city;
            $this->update['city'] = true;
        }
    }
    public function getCity() {
        return $this->var['city'];
    }

    public function setState($state) {
        if ($this->var['state'] != $state) {
            $this->var['state'] = $state;
            $this->update['state'] = true;
        }
    }
    public function getState() {
        return $this->var['state'];
    }

    public function setCountry($country) {
        if ($this->var['country'] != $country) {
            $this->var['country'] = $country;
            $this->update['country'] = true;
        }
    }
    public function getCountry() {
        return $this->var['country'];
    }

    public function setZip($zip) {
        if ($this->var['zip'] != $zip) {
            $this->var['zip'] = $zip;
            $this->update['zip'] = true;
        }
    }
    public function getZip() {
        return $this->var['zip'];
    }

    public function setLat($lat) {
        if ($this->var['lat'] != $lat) {
            $this->var['lat'] = $lat;
            $this->update['lat'] = true;
        }
    }
    public function getLat() {
        return $this->var['lat'];
    }

    public function setLng($lng) {
        if ($this->var['lng'] != $lng) {
            $this->var['lng'] = $lng;
            $this->update['lng'] = true;
        }
    }
    public function getLng() {
        return $this->var['lng'];
    }

    public function setPrice($price) {
        if ($this->var['price'] != $price) {
            $this->var['price'] = $price;
            $this->update['price'] = true;
        }
    }
    public function getPrice() {
        return $this->var['price'];
    }

    public function setHours($hours) {
        if ($this->var['hours'] != $hours) {
            $this->var['hours'] = $hours;
            $this->update['hours'] = true;
        }
    }
    public function getHours() {
        return $this->var['hours'];
    }

    public function setCashOnly($cash_only) {
        if ($this->var['cash_only'] != $cash_only) {
            $this->var['cash_only'] = $cash_only;
            $this->update['cash_only'] = true;
        }
    }
    public function getCashOnly() {
        return $this->var['cash_only'];
    }

    public function setVerified($verified) {
        if ($this->var['verified'] != $verified) {
            $this->var['verified'] = $verified;
            $this->update['verified'] = true;
        }
    }
    public function getVerified() {
        return $this->var['verified'];
    }

    public function setTel($tel) {
        if ($this->var['tel'] != $tel) {
            $this->var['tel'] = $tel;
            $this->update['tel'] = true;
        }
    }
    public function getTel() {
        return $this->var['tel'];
    }

    public function setWebsite($website) {
        if ($this->var['website'] != $website) {
            $this->var['website'] = $website;
            $this->update['website'] = true;
        }
    }
    public function getWebsite() {
        return $this->var['website'];
    }

    public function setSocial($social) {
        if ($this->var['social'] != $social) {
            $this->var['social'] = $social;
            $this->update['social'] = true;
        }
    }
    public function getSocial() {
        return $this->var['social'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}