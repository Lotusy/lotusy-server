<?php
class GetUserDishKeywordHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $userId = $params['userid'];
        $dishId = $params['dishid'];
        $language = $params['language'];

        $codes = DishUserKeywordDao::getUserDishKeywords($userId, $dishId);

        $descriptions = ItermDao::getCodeDescriptionArray($codes, ItermDao::TYPE_KEYWORD, $language);

        $response = array();
        $response['status'] = 'success';
        $response['descriptions'] = $descriptions;

        return $response;
    }
}
?>