<?php
class GetBusinessDishesHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        global $base_image_host;

        $json = $_GET;

        $validator = new GetBusinessDishesValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $dishes = DishDao::getBusinessDishes($params['businessid'], $json['start'], $json['size']);

        $response = array();
        $response['status'] = 'success';
        $response['dishes'] = array();
        foreach ($dishes as $dish) {
            $dishArr = $dish->toArray(array('create_time'));
            $dishArr['image'] = $base_image_host.'/image/dish/'.$dishArr['id'].'/profile/display';
            array_push($response['dishes'], $dishArr);
        }

        return $response;
    }
}
?>