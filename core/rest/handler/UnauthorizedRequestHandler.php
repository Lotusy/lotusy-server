<?php
abstract class UnauthorizedRequestHandler implements RequestHandler {

	public function execute($params) {

		$response = $this->handle($params);

		return json_encode($response);

	}

	abstract public function handle($params);
}
?>