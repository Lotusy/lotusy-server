<?php
class GetFlowUserActivityHandler extends AuthorizedRequestHandler {

    public function handle($params) {
        $userId = $this->getUserId();
    }
}
?>