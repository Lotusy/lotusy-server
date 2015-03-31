<?php
class GetLocationDishHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        global $base_image_host;
        $json = $_GET;

        $validator = new GetLocationDishValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $numberOfBusiness = 100;
        $numberOfDishes = 200;
        $deltaPerBusiness = 5;

        $isMiles = $json['is_miles'] == 'true';
        $ids = BusinessDao::getBusinessIdsWithin( $json['lat'], 
                                                  $json['lng'], 
                                                  $json['radius'], 
                                                  0,
                                                  $numberOfBusiness,
                                                  $isMiles );

        $response = array();
        $response['status'] = 'success';
        $response['dishes'] = array();

        $dishes = array();
        $index = 0;
        foreach ($ids as $id) {
            $dishes[$index] = DishDao::getBusinessDishes($id['id'], 0, $numberOfDishes);
            $index++;
        }

        $counter = -1;
        for ($ii=0; $ii<$numberOfDishes; $ii=$ii+$deltaPerBusiness) {
            for ($jj=0; $jj<$numberOfBusiness; $jj++) {
                for ($kk=$ii; $kk<$ii+$deltaPerBusiness; $kk++) {
                    if (isset($dishes[$jj]) && isset($dishes[$jj][$kk])) {
                        $counter++;
                        if ($counter<$json['start']) {
                            continue;
                        }
                        if ($counter>=$json['start']+$json['size']) {
                            return $response;
                        }
    
                        $dishArr = $dishes[$jj][$kk]->toArray(array('create_time'));
                        $dishArr['image'] = $base_image_host.'/rest/image/dish/'.$dishArr['id'].'/profile/display';
                        array_push($response['dishes'], $dishArr);
                    }
                }
            }
        }

        return $response;
    }
}
?>