<?php
class HitlistDishHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $params['userid'] = $this->getUserId();

        $validator = new HitlistDishValidator($params);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $dishDao = new DishDao($params['dishid']);

        $lookup = new DishActivityDao();
        $lookup->setDishId($params['dishid']);
        $lookup->setBusinessId($dishDao->getBusinessId());
        $lookup->setUserId($validator->getUserId());
        $lookup->setActivity(DishActivityDao::LIST_HITLIST);
        $lookup->save();

        $response = array();
        $response['status'] = 'success';

        return $response;
    }
}
?>