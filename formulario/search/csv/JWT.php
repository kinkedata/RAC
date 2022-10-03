<?php
class JWT{
	private $header = [];
	private $payload = [];
	private static $algos = array(
		'HS256' => 'sha256',
		'HS384' => 'sha384',
		'HS512' => 'sha512',
		'HMD05' => 'md5'
	);
	private static $statusCodes = array(
		'JWT000' => 'Bearer token not be empty',
		'JWT001' => 'Key may not be empty',
		'JWT002' => 'Wrong number of segments',
		'JWT003' => 'Invalid header encoding',
		'JWT004' => 'Invalid claims encoding',
		'JWT005' => 'Invalid signature encoding',
		'JWT006' => 'Empty algorithm',
		'JWT007' => 'Signature verification failed',
		'JWT008' => 'Expired token'
	);

	public function __construct(){}

	public static function encode($payload, $secret, $alg = 'HS256'){
		$header = array('typ' => 'JWT', 'alg' => $alg);
		$segments = array();
		$segments[] = static::urlsafeB64Encode(static::jsonEncode($header));
		$segments[] = static::urlsafeB64Encode(static::jsonEncode($payload));
		$load = implode('.', $segments);
		$signature = static::hash(static::$algos[$alg], $load, $secret);
		$segments[] = static::urlsafeB64Encode($signature);
		return implode('.', $segments);
	}

	public static function decode($token, $secret, $validateHeader = true){
		if($validateHeader && is_null(static::getBearerToken())){
			return static::setError('JWT000');
		}
		$tks = explode('.', $token);
		if(empty($secret)){
			return static::setError('JWT001');
		}
		if(count($tks) != 3){
			return static::setError('JWT002');
		}
		list($headb64, $bodyb64, $cryptob64) = $tks;
		if(null === $header = static::jsonDecode(static::urlsafeB64Decode($headb64))){
			return static::setError('JWT003');
		}
		if(null === $payload = static::jsonDecode(static::urlsafeB64Decode($bodyb64))){
			return static::setError('JWT004');
		}
		if(false === ($signature = static::urlsafeB64Decode($cryptob64))){
			return static::setError('JWT005');
		}
		if(empty($header['alg'])){
			return static::setError('JWT006');
		}
		if(!static::verify("$headb64.$bodyb64", $signature, $secret, $header['alg'])){
			return static::setError('JWT007');
		}
		if(isset($payload['exp']) && time() >= $payload['exp']){
			return static::setError('JWT008');
		}
		return $payload;
	}

	public static function getBearerToken(){
		$headers = static::getAuthorizationHeader();
		if(!empty($headers) && preg_match('/Bearer\s((.*)\.(.*)\.(.*))/', $headers, $matches)){
			return $matches[1];
		}
		return null;
	}

	private static function getAuthorizationHeader(){
		$headers = null;
		if(isset($_SERVER['Authorization'])){
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['HTTP_AUTHORIZATION'])){ 
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')){
			$requestHeaders = apache_request_headers();
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			if (isset($requestHeaders['Authorization'])){
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		return $headers;
	}

	private static function setError($err){
		return array('error' => $err, 'description' => static::$statusCodes[$err]);
	}

	private static function verify($msg, $signature, $secret, $alg){
		$algorithm = static::$algos[$alg];
		$hash = self::hash($algorithm, $msg, $secret);
		return $hash === $signature;
	}

	private static function jsonEncode($jsonArray){
		return json_encode($jsonArray);
	}

	private static function jsonDecode($json){
		return json_decode($json, true);
	}

	private static function urlsafeB64Encode($toEncode){
		return static::toBase64Url(base64_encode($toEncode));
	}

	private static function urlsafeB64Decode($toDecode){
		return base64_decode(static::addPadding(static::toBase64($toDecode)), true);
	}

	private static function hash($algorithm, $toHash, $secret){
		return hash_hmac($algorithm, $toHash, $secret, true);
	}

	private static function toBase64Url($base64){
		return str_replace(['+', '/', '='], ['-', '_', ''], $base64);
	}

	private static function toBase64($urlString){
		return str_replace(['-', '_'], ['+', '/'], $urlString);
	}

	private static function addPadding($base64String){
		if(strlen($base64String) % 4 !== 0) {
			return static::addPadding($base64String . '=');
		}
		return $base64String;
	}
}