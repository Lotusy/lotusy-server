<?php
class GetLocationDishHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_host,$base_url;
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
    
                        $dishArr = $dishes[$jj][$kk]->toArray(array('name_zh', 'name_tw', 'name_en', 'create_time'));

                        $likeDao = DishUserLikeDao::getUserResponseOnDish($this->getUserId(), $dishArr['id']);
                        if (isset($likeDao)) {
                        	$dishArr['like'] = $likeDao->getIsLike()=='Y';
                        	$dishArr['type'] = 'collection';
                        } else if (DishActivityDao::isDishHitlisted($dishArr['id'], $this->getUserId())) {
	                       	$dishArr['like'] = null;
	                       	$dishArr['type'] = 'hitlist';
                       	} else {
	                       	$dishArr['like'] = null;
	                       	$dishArr['type'] = null;
                        }

                        $dishArr['name'] = $dishes[$jj][$kk]->getName($this->getLanguage());
                        $business = new BusinessDao($dishArr['business_id']);
                        $dishArr['business'] = $business->getName($this->getLanguage());
                        $dishArr['image'] = $base_host.$base_url.'/rest/image/dish/'.$dishArr['id'].'/profile/display';
                        array_push($response['dishes'], $dishArr);
                    }
                }
            }
        }

        return $response;
    }
}
?>