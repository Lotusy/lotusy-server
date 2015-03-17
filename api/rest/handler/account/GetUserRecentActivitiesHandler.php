<?php
class GetUserRecentActivitiesHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $json['language'] = $this->getLanguage();

        $validator = new GetFlowUserActivityValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $userId = $this->getUserId();
        $start = $_GET['start'];
        $size = $_GET['size'];
        $language = $json['language'];

        $user = User::alloc()->initWithId($userId);

        $list = $user->getUserRecentActivitiesArray($start, $size, $language);

        $response = array('status'=>'success');
        $response['activities'] = $list;

        return $response;
    }
}
?>