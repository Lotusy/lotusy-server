<?php
class GetUserFollowingsHandler extends UnauthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['userid'] = $params['userid'];

        $validator = new GetUserFollowingsValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        } 

        $userIds = FollowerDao::getFollowingIds($params['userid'], $json['start'], $json['size']);

        $response = array();
        $response['status'] = 'success';
        $response['users'] = array();

        global $base_host, $base_uri;

        foreach ($userIds as $userId) {
            $user = new UserDao($userId);
            if ($user->isFromDatabase()) {
                $userArr = array();
                $userArr['id'] = $userId;
                $userArr['nickname'] = $user->getNickname();
                $userArr['profile_pic'] = $base_host.$base_uri.'/image/user/'.$userId.'/profile/display';

                array_push($response['users'], $userArr);
            }
        }

        return $response;
    }
}