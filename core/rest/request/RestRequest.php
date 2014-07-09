<?php
abstract class RestRequest {

	private $curl = null;
	private $url = '';
	private $setHeader = FALSE;
	private $code = 0;
	private $transactionDao = null;

	public function __construct() {
		$this->curl = curl_init();
//		$this->transactionDao = new HttpTransactionDao();
	}

	public function setUri($uri) {
		$this->url = $uri;
		curl_setopt($this->curl, CURLOPT_URL, $uri);
	}

	public function setBody($body, $isJson=TRUE) {
		$this->modifyBody($body);
		if ($isJson) {
			$body = json_encode($body);
		} else {
			$body = http_build_query($body);
		}

//		$this->transactionDao->var[HttpTransactionDao::REQUEST] = $body;

		curl_setopt($this->curl, CURLOPT_POSTFIELDS,  $body);
	}

	public function setHeader($header=array()) {
		$this->modifyHeader($header);
		$headers = array();
		foreach ($header as $key=>$val) {
			array_push($headers, $key.': '.$val);
		}
		$this->setHeader = true;
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
	}

	public function execute() {
		if (empty($this->url)) {
			$this->url = $this->getUrl();
			curl_setopt($this->curl, CURLOPT_URL, $this->url);
		}

		$method = $this->getMethod();

		if (isset($method)) {
			if ($method=='POST') {
				curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'POST');
			}
			elseif ($method=='PUT') {
				curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
			}
			elseif ($method=='DELETE') {
				curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
			}
		}

		if (!$this->setHeader) { $this->setHeader(); }

		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($this->curl, CURLOPT_TIMEOUT, 30);

		$this->preExecute();
//		$this->transactionDao->var[HttpTransactionDao::URL] = $this->url;
//		$this->transactionDao->var[HttpTransactionDao::METHOD] = $method;

		$start = microtime(TRUE)*1000;
		$response = curl_exec($this->curl);
//		$this->transactionDao->var[HttpTransactionDao::DURATION] = microtime(TRUE)*1000-$start;
//		$this->transactionDao->var[HttpTransactionDao::RESPONSE] = $response;

		$this->code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
//		$this->transactionDao->var[HttpTransactionDao::CODE] = $this->code;

		curl_close($this->curl);

		$response = $this->parseResponse($response);

////		$this->transactionDao->save();

		return $response;
	}

	public function setUser($username, $password) {
		curl_setopt($this->curl, CURLOPT_USERPWD, $username.':'.$password); 
	}

	protected function getResponseCode() {
		return $this->code;
	}

	protected function setTransactionDaoType($type) {
//		$this->transactionDao->var[HttpTransactionDao::TYPE] = $type;
	}

	protected function setTransactionDaoCode($code) {
//		$this->transactionDao->var[HttpTransactionDao::CODE] = $code;
	}

//====================================================================== method could be overrided.

	protected function modifyHeader(&$header) {}
	protected function modifyBody(&$body) {}
	protected function preExecute() {}

	abstract protected function getUrl();
	abstract protected function getMethod();
	abstract protected function parseResponse($response);
}
?>