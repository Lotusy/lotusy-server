<?php
class GetLocationDishHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        global $base_image_host;
        $json = $_GET;

        $validator = new GetLocationDishValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $isMiles = $json['is_miles'] == 'true';
        $ids = BusinessDao::getBusinessIdsWithin( $json['lat'], 
                                                  $json['lng'], 
                                                  $json['radius'], 
                                                  0,
                                                  10000,
                                                  $isMiles );

        $response = array();
        $response['status'] = 'success';
        $response['dishes'] = array();

        $counter = -1;
        foreach ($ids as $id) {
            $dishes = DishDao::getBusinessDishes($id['id'], 0, 2000);

            foreach ($dishes as $dish) {
                $counter++;
                if ($counter<$json['start']) {
                    continue;
                }
                if ($counter>=$json['start']+$json['size']) {
                    return $response;
                }

                $dishArr = $dish->toArray(array('create_time'));
                $dishArr['image'] = $base_image_host.'/rest/image/dish/'.$dishArr['id'].'/profile/display';
                array_push($response['dishes'], $dishArr);
            }
        }

        return $response;
    }
}
?>