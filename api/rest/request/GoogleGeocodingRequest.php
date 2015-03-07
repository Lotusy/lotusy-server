<?php
class GoogleGeocodingRequest extends RestRequest {

    private $street, $city, $state;

    public function __construct($street, $city, $state) {
        parent::__construct();
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
    }

    protected function getUrl() {
        $street = str_replace(' ', '+', $this->street);
        $city = str_replace(' ', '+', $this->city);
        $state = str_replace(' ', '+', $this->state);
        $address = $street.',+'.$city.',+'.$state;

        return 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';
    }

    protected function getMethod() {
        return 'GET';
    }

    protected function parseResponse($response) {
        $resArr = json_decode($response, true);

        $atReturn = array();
        if ($resArr['status']=='OK') {
            $result = reset($resArr['results']);
            $geometry = $result['geometry'];
            if (isset($geometry['location'])) {
                $atReturn['status'] = 'success';
                $atReturn['lat'] = $geometry['location']['lat'];
                $atReturn['lng'] = $geometry['location']['lng'];
                Logger::info('GoogleGeocodingRequest - '.$this->street.', '.$this->city.', '.$this->state.' = ['.$atReturn['lat'].','.$atReturn['lng'].']');
            } else {
                Logger::warn('GoogleGeocodingRequest - ['.$this->lat.','.$this->lng.'] = Result DO NOT have location.');
                $atReturn['discription'] = $atReturn['status'];
                $atReturn['status'] = 'error';
            }
        } else {
            Logger::warn('GoogleGeocodingRequest - ['.$this->lat.','.$this->lng.'] = '.$resArr['status']);
            $atReturn['discription'] = $atReturn['status'];
            $atReturn['status'] = 'error';

            if ($resArr['status']=='OVER_QUERY_LIMIT') {
                usleep(rand(10000, 50000));
                $request = new GoogleGeocodingRequest($this->street, $this->city, $this->state);
                $atReturn = $request->execute();
            }
        }

        return $atReturn;
    }

}
?>