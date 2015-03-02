<?php
class Logger {
	const GENERAL = 0;
	const DB = 1;

	public static function info($message, $type=Logger::GENERAL) {
		global $log_level;
		if ($log_level>3) { Logger::log($message, 4, $type); }
	}

	public static function warn($message, $type=Logger::GENERAL) {
		global $log_level;
		if ($log_level>2) { Logger::log($message, 3, $type); }
	}

	public static function error($message, $type=Logger::GENERAL) {
		global $log_level;
		if ($log_level>1) { Logger::log($message, 2, $type); }
	}

	public static function fatal($message, $type=Logger::GENERAL) {
		global $log_level;
		if ($log_level>0) { Logger::log($message, 1, $type); }
	}

	private static function log($message, $level=0, $type) {
		global $log_file, $database_log;

		if ($type==Logger::GENERAL) {
			$output_file = $log_file;
		} else if ($type==Logger::DB) { 
			$output_file = $database_log;
		}

		$slevel = '';

		switch ($level) {
			case 4:
				$slevel = "INFO - ";
				break;
			case 3:
				$slevel = "WARN - ";
				break;
			case 2:
				$slevel = "ERROR - ";
				break;
			case 1:
				$slevel = "FATAL - ";
				break;
		}

		if (isset($output_file) && !empty($output_file))	{
			$log = fopen($output_file, 'a');
			fwrite($log, '['.date('Y-m-d H:i:s').'] '.$slevel.$message.PHP_EOL);
			fclose($log);
		}
		else {
			error_log($message);
		}
	}

	public static function access($message) {
		global $access_log;

		if (isset($access_log) && !empty($access_log))	{
			$body = '{  "REMOTE_ADDR":"'.        Logger::getServerParam('REMOTE_ADDR').
					'", "HTTP_X_FORWARDED_FOR":"'.Logger::getServerParam('HTTP_X_FORWARDED_FOR').
					'", "HTTP_CLIENT_IP":"'.     Logger::getServerParam('HTTP_CLIENT_IP').
					'", "REQUEST":"'.            $message.'"  }';
			$access = fopen($access_log, 'a');
			fwrite($access, '['.date('Y-m-d H:i:s').'] '.$body.PHP_EOL);
			fclose($access);
		}
		else {
			Logger::warn('No access log file provided ...');
		}
	}

	private static function getServerParam($paramName) {
		return (isset($_SERVER[$paramName]) ? $_SERVER[$paramName] : '');
	}
}