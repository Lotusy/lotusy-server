<?php
class FollowUserHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $params['user_id'] = $userId;

        $validator = new FollowUserValidator($params);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $following = new FollowerDao();
        $following->setUserId($userId);
        $following->setFollowerId($params['userid']);
        $following->save();

        $userActivity = new UserActivityDao();
        $userActivity->setUserId($params['userid']);
        $userActivity->setType(UserActivityDao::TYPE_USER_FOLLOW);
        $data = array('user_id'=>$userId);
        $userActivity->setData(json_encode($data));
        $userActivity->save();

        $response = array();
        $response['status'] = 'success';

        return $response;
    }
}
?>