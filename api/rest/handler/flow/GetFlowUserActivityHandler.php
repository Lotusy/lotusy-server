<?php
class GetFlowUserActivityHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $json = $_GET;
        $headers = apache_request_headers();
        $json['language'] = $headers['language'];

        $validator = new GetFlowUserActivityValidator($json);
        if (!$validator->validate()) {
            return $validator->getMessage();
        }

        $userId = $this->getUserId();
        $startTime = $_GET['start_time'];
        $size = $_GET['size'];
        $language = $headers['language'];

        $user = User::alloc()->init_with_id($userId);

        $list = $user->getNewFollowerArray($startTime, $size, $language);

        $response = array('status'=>'success');
        $response['activities'] = $list;

        return $response;
    }
}
?>