<?php
class CreateBusinessHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = Utility::getJsonRequestData();

        $validator = new CreateBusinessValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $profile = Utility::getCurrentUserProfile();

        $verified = ($profile['status']=='success') ? $profile['superuser'] : 'N';

        $business = new BusinessDao();
        $business->setCashOnly(isset($json['cash_only']) ? $json['cash_only'] : '');
        $business->setCity($json['city']);
        $business->setCountry($json['country']);
        $business->setHours(isset($json['hours']) ? json_encode($json['hours']) : '');
        $business->setLat($json['lat']);
        $business->setLng($json['lng']);
        $business->setNameEn(isset($json['name_en']) ? $json['name_en'] : '');
        $business->setNameTw(isset($json['name_tw']) ? $json['name_tw'] : '');
        $business->setNameZh(isset($json['name_zh']) ? $json['name_zh'] : '');
        $business->setPrice(isset($json['price']) ? $json['price'] : '');
        $business->setSocial(isset($json['social']) ? $json['social'] : '');
        $business->setState($json['state']);
        $business->setStreet($json['street']);
        $business->setTel(isset($json['tel']) ? $json['tel'] : '');
        $business->setWebsite(isset($json['website']) ? $json['website'] : '');
        $business->setZip(isset($json['zip']) ? $json['zip'] : '');
        $business->setUserId($this->getUserId());
        $business->setVerified($verified);

        $atReturn = array();
        if ($business->save()) {
            $atReturn = $business->toArray();
            $atReturn['status'] = 'success';
        } else {
            header('HTTP/1.0 500 Internal Server Error');
            $atReturn['status'] = 'error';
            $atReturn['description'] = 'Internal Server Error';
        }

        return $atReturn;
    }
}
?>