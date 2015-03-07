<?php
abstract class UnauthorizedRequestHandler implements RequestHandler {

    public function execute($params) {
        $response = $this->handle($params);

        if (!empty($response)) {
            $response = json_encode($response);
        }

        return $response;
    }

    abstract public function handle($params);
}
?>