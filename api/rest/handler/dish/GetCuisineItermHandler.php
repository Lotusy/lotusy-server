<?php
class GetCuisineItermHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $terms = ItermDao::getTypeLanguageCodeDescriptionMap(ItermDao::TYPE_CUISINE, $params['language']);

        $response = array();
        $response['status'] = 'success';
        $response['terms'] = $terms;

        return $response;
    }
}
?>