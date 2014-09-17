<?php
abstract class BusinessDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['external_id'] = '';
        $this->var['external_type'] = '';
        $this->var['user_id'] = '';
        $this->var['name_zh'] = '';
        $this->var['name_tw'] = '';
        $this->var['name_en'] = '';
        $this->var['image'] = '';
        $this->var['street'] = '';
        $this->var['city'] = '';
        $this->var['state'] = '';
        $this->var['country'] = '';
        $this->var['zip'] = '';
        $this->var['lat'] = '';
        $this->var['lng'] = '';
        $this->var['price'] = '';
        $this->var['hours'] = '';
        $this->var['cash_only'] = '';
        $this->var['verified'] = '';
        $this->var['tel'] = '';
        $this->var['website'] = '';
        $this->var['social'] = '';

        $this->update['id'] = false;
        $this->update['external_id'] = false;
        $this->update['external_type'] = false;
        $this->update['user_id'] = false;
        $this->update['name_zh'] = false;
        $this->update['name_tw'] = false;
        $this->update['name_en'] = false;
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

    public function setExternalId($externalId) {
        $this->var['external_id'] = $externalId;
        $this->update['external_id'] = true;
    }
    public function getExternalId() {
        return $this->var['external_id'];
    }

    public function setExternalType($externalType) {
        $this->var['external_type'] = $externalType;
        $this->update['external_type'] = true;
    }
    public function getExternalType() {
        return $this->var['external_type'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setNameZh($nameZh) {
        $this->var['name_zh'] = $nameZh;
        $this->update['name_zh'] = true;
    }
    public function getNameZh() {
        return $this->var['name_zh'];
    }

    public function setNameTw($nameTw) {
        $this->var['name_tw'] = $nameTw;
        $this->update['name_tw'] = true;
    }
    public function getNameTw() {
        return $this->var['name_tw'];
    }

    public function setNameEn($nameEn) {
        $this->var['name_en'] = $nameEn;
        $this->update['name_en'] = true;
    }
    public function getNameEn() {
        return $this->var['name_en'];
    }

    public function setImage($image) {
        $this->var['image'] = $image;
        $this->update['image'] = true;
    }
    public function getImage() {
        return $this->var['image'];
    }

    public function setStreet($street) {
        $this->var['street'] = $street;
        $this->update['street'] = true;
    }
    public function getStreet() {
        return $this->var['street'];
    }

    public function setCity($city) {
        $this->var['city'] = $city;
        $this->update['city'] = true;
    }
    public function getCity() {
        return $this->var['city'];
    }

    public function setState($state) {
        $this->var['state'] = $state;
        $this->update['state'] = true;
    }
    public function getState() {
        return $this->var['state'];
    }

    public function setCountry($country) {
        $this->var['country'] = $country;
        $this->update['country'] = true;
    }
    public function getCountry() {
        return $this->var['country'];
    }

    public function setZip($zip) {
        $this->var['zip'] = $zip;
        $this->update['zip'] = true;
    }
    public function getZip() {
        return $this->var['zip'];
    }

    public function setLat($lat) {
        $this->var['lat'] = $lat;
        $this->update['lat'] = true;
    }
    public function getLat() {
        return $this->var['lat'];
    }

    public function setLng($lng) {
        $this->var['lng'] = $lng;
        $this->update['lng'] = true;
    }
    public function getLng() {
        return $this->var['lng'];
    }

    public function setPrice($price) {
        $this->var['price'] = $price;
        $this->update['price'] = true;
    }
    public function getPrice() {
        return $this->var['price'];
    }

    public function setHours($hours) {
        $this->var['hours'] = $hours;
        $this->update['hours'] = true;
    }
    public function getHours() {
        return $this->var['hours'];
    }

    public function setCashOnly($cashOnly) {
        $this->var['cash_only'] = $cashOnly;
        $this->update['cash_only'] = true;
    }
    public function getCashOnly() {
        return $this->var['cash_only'];
    }

    public function setVerified($verified) {
        $this->var['verified'] = $verified;
        $this->update['verified'] = true;
    }
    public function getVerified() {
        return $this->var['verified'];
    }

    public function setTel($tel) {
        $this->var['tel'] = $tel;
        $this->update['tel'] = true;
    }
    public function getTel() {
        return $this->var['tel'];
    }

    public function setWebsite($website) {
        $this->var['website'] = $website;
        $this->update['website'] = true;
    }
    public function getWebsite() {
        return $this->var['website'];
    }

    public function setSocial($social) {
        $this->var['social'] = $social;
        $this->update['social'] = true;
    }
    public function getSocial() {
        return $this->var['social'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'business';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_business';
    }
}
?>