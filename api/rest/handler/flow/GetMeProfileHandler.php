<?php
class GetMeProfileHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
        $user = User::alloc()->init_with_id($userId);
    }
}
?>