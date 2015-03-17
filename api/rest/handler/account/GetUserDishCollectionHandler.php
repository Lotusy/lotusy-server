<?php
class GetUserDishCollectionHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = array_merge($_GET, $params);
        $validator = new GetUserDishCollectionValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $language = $this->getLanguage();

        $user = User::alloc()->initWithId($params['userid']);

        $like = isset($json['like']) ? $like : null;

        $dishes = $user->getCollectedDishes($json['start'], $json['size'], $language, $like);
        $count = $user->getCollectedDishCount($like);

        $response = array();
        $response['status'] = 'success';
        $response['dishes'] = $dishes;
        $response['count'] = $count;

        return $response;
    }
}
?>