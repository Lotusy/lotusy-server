<?php
class GetCuisineItermHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $terms = ItermDao::getTypeLanguageCodeDescriptionMap(ItermDao::TYPE_CUISINE, $this->getLanguage());

        $response = array();
        $response['status'] = 'success';
        $response['terms'] = $terms;

        return $response;
    }
}
?>